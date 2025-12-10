<div id="videoCutter" class="p-6 max-w-3xl mx-auto rounded-3xl shadow-xl text-white bg-[rgba(30,41,59,0.55)] backdrop-blur-xl border border-white/10">

    <h2 class="text-2xl font-semibold mb-4 flex items-center gap-2">
        🎬 <span>Video Cutter (Upload Lokal)</span>
    </h2>

    <div class="mb-3 text-sm text-gray-300">Pilih file video lokal, pangkas bagian yang diinginkan lalu klik <strong>✂ Potong</strong>. Hasil trim akan dimasukkan ke formulir sebagai file yang dikirim ke server.</div>

    <div class="mb-4 flex items-center gap-3">
      <input id="vc_fileInput" type="file" accept="video/*" class="hidden" />
      <button id="vc_chooseBtn" type="button" class="px-4 py-2 rounded-xl bg-[#FEDA60] text-[#2E2E2E] font-semibold shadow">Pilih Video</button>
      <div id="vc_filename" class="text-sm text-gray-300">Belum ada file dipilih</div>
    </div>

    <video id="vc_videoPreview" controls style="width:100%; border-radius:8px; display:none; background:black;"></video>

    <div class="relative mt-2" style="height:96px;">
      <canvas id="vc_timeline" class="timeline-canvas"></canvas>
      <div id="vc_selectionArea" class="selection-area hidden"></div>
      <div id="vc_handleLeft" class="selection-handle hidden"></div>
      <div id="vc_handleRight" class="selection-handle hidden"></div>
    </div>

    <div class="flex gap-3 items-center mt-3">
      <div>
        <label class="text-sm text-slate-300">Start</label>
        <div id="vc_startText" class="font-mono text-slate-200">0.00s</div>
      </div>
      <div>
        <label class="text-sm text-slate-300">End</label>
        <div id="vc_endText" class="font-mono text-slate-200">0.00s</div>
      </div>

      <div class="ml-auto flex gap-2">
        <button id="vc_playSel" type="button" class="px-4 py-2 rounded bg-emerald-500 text-black font-medium">▶️ Play Sel</button>

        <button id="vc_cutBtn" type="button" class="px-4 py-2 rounded bg-amber-400 text-black font-medium">✂ Potong</button>
        <button id="vc_resetBtn" type="button" class="px-4 py-2 rounded bg-gray-500 text-white">↩ Reset</button>
      </div>
    </div>

    <div id="vc_status" class="text-sm text-slate-300 mt-3"></div>

    <!-- This hidden input should exist in the parent form. If not, component will create one. -->
</div>

<!-- Load MediaRecorder for video capture -->
<script src="https://cdn.jsdelivr.net/npm/mp4-box@0.2.5/dist/index.umd.js"></script>

<script>
(function(){
  // scoped IDs prefixed with vc_
  const fileInput = document.getElementById('vc_fileInput');
  const chooseBtn = document.getElementById('vc_chooseBtn');
  const filenameEl = document.getElementById('vc_filename');
  const videoPreview = document.getElementById('vc_videoPreview');
  const timelineCanvas = document.getElementById('vc_timeline');
  const ctx = timelineCanvas.getContext('2d');
  const selectionArea = document.getElementById('vc_selectionArea');
  const handleLeft = document.getElementById('vc_handleLeft');
  const handleRight = document.getElementById('vc_handleRight');
  const startText = document.getElementById('vc_startText');
  const endText = document.getElementById('vc_endText');
  const playSelBtn = document.getElementById('vc_playSel');
  const cutBtn = document.getElementById('vc_cutBtn');
  const resetBtn = document.getElementById('vc_resetBtn');
  const status = document.getElementById('vc_status');

  let originalFile = null; let currentBlob = null; let duration = 0;
  let startSec = 0; let endSec = 0; let samples = []; let sampleCount = 160; let dragging = {left:false,right:false,move:false,offset:0};
  let pixelRatio = devicePixelRatio || 1;

  function setStatus(t){ status.textContent = t || ''; }
  function fmt(s){ if(isNaN(s)) return '0.00s'; return s.toFixed(2)+'s'; }

  fileInput.addEventListener('change', async (e)=>{ const f = e.target.files[0]; if(f){ filenameEl.textContent = f.name; await loadVideo(f); } });
  chooseBtn.addEventListener('click', ()=> fileInput.click());

  async function loadVideo(file){
    originalFile = file; currentBlob = null; setStatus('⏳ Memuat video...');
    const url = URL.createObjectURL(file); videoPreview.src = url; videoPreview.style.display='block';
    await new Promise(r=>{ videoPreview.onloadedmetadata = ()=> r(); });
    duration = videoPreview.duration; startSec = 0; endSec = duration; startText.textContent = fmt(startSec); endText.textContent = fmt(endSec);
      // pick a smaller, faster initial sample count and progressively refine
      sampleCount = Math.min(220, Math.max(48, Math.floor(Math.min(150, duration * 2))));
      samples = await progressiveCaptureFrames(videoPreview, sampleCount);
      setStatus('✅ Timeline siap.'); resizeCanvas();
  }

  function resizeCanvas(){ const rect = timelineCanvas.getBoundingClientRect(); timelineCanvas.width = Math.max(600, rect.width) * pixelRatio; timelineCanvas.height = 96 * pixelRatio; drawTimeline(); }
  window.addEventListener('resize', ()=> requestAnimationFrame(resizeCanvas));

  // progressive capture: quick pass for immediate feedback, then refine in background
  async function progressiveCaptureFrames(videoEl, nSamples){
    const off = document.createElement('canvas'); const ow=128, oh=72; off.width=ow; off.height=oh; const octx=off.getContext('2d');
    const makeTimes = (count)=>{ const t=[]; for(let i=0;i<count;i++) t.push((i/count)*Math.max(0.0001, videoEl.duration)); return t; };

    // quick pass: sample fewer frames for immediate timeline
    const quickCount = Math.min(64, Math.max(24, Math.floor(nSamples/3)));
    const quickTimes = makeTimes(quickCount);
    const quickResults = [];
    for(let i=0;i<quickTimes.length;i++){
      const t = quickTimes[i]; await seekVideo(videoEl, t);
      try{ octx.drawImage(videoEl,0,0,ow,oh); const id=octx.getImageData(0,0,ow,oh).data; let sum=0,cnt=0; for(let p=0;p<id.length;p+=4){ sum += 0.2126*id[p] + 0.7152*id[p+1] + 0.0722*id[p+2]; cnt++; } quickResults.push((sum/cnt)/255); }
      catch(e){ quickResults.push(0.1); }
      setStatus(`⏳ Membuat timeline (cepat): ${i+1}/${quickTimes.length}...`);
      // yield to UI
      await new Promise(r=>setTimeout(r,8));
    }

    // show quick timeline immediately (interpolate to nSamples length for drawing)
    const interim = new Array(nSamples).fill(0);
    for(let i=0;i<nSamples;i++){ const srcIdx = Math.floor((i/nSamples)*quickResults.length); interim[i] = quickResults[Math.min(srcIdx, quickResults.length-1)]; }
    // update global samples so drawTimeline renders a quick result
    samples = interim; drawTimeline();

    // background full pass in chunks to refine
    const fullTimes = makeTimes(nSamples);
    const fullResults = new Array(nSamples);
    const chunk = 12; // frames per chunk
    for(let offset=0; offset<fullTimes.length; offset+=chunk){
      const end = Math.min(fullTimes.length, offset+chunk);
      for(let i=offset;i<end;i++){
        const t = fullTimes[i]; await seekVideo(videoEl, t);
        try{ octx.drawImage(videoEl,0,0,ow,oh); const id=octx.getImageData(0,0,ow,oh).data; let sum=0,cnt=0; for(let p=0;p<id.length;p+=4){ sum += 0.2126*id[p] + 0.7152*id[p+1] + 0.0722*id[p+2]; cnt++; } fullResults[i] = (sum/cnt)/255; }
        catch(e){ fullResults[i] = 0.1; }
      }
      // update progress and interim visualization
      const done = Math.min(offset+chunk, fullTimes.length);
      setStatus(`⏳ Menyempurnakan timeline: ${done}/${fullTimes.length} frame sampled...`);
      // merge into samples for smoother update
      for(let i=offset;i<end;i++) samples[i] = fullResults[i];
      drawTimeline();
      // yield to allow UI/other tasks
      await new Promise(r=>setTimeout(r,20));
    }

    // restore currentTime
    await seekVideo(videoEl, startSec||0);
    setStatus('✅ Timeline lengkap.');
    return samples;
  }

  function seekVideo(videoEl, time){ return new Promise((resolve)=>{ const onSeeked=()=>{ videoEl.removeEventListener('seeked', onSeeked); resolve(); }; videoEl.addEventListener('seeked', onSeeked); try{ videoEl.currentTime = Math.min(videoEl.duration-0.001, Math.max(0, time)); }catch(e){} // some browsers may throw for invalid seeks
    // timeout fallback shorter to avoid long hangs
    setTimeout(()=>{ videoEl.removeEventListener('seeked', onSeeked); resolve(); }, 1200);
  }); }

  function drawTimeline(){ const w = timelineCanvas.width, h = timelineCanvas.height; ctx.clearRect(0,0,w,h); ctx.fillStyle='#071025'; ctx.fillRect(0,0,w,h); if(!samples || samples.length===0){ ctx.fillStyle='#0f1724'; ctx.fillRect(0,0,w,h); return; }
    const barW = w/samples.length; for(let i=0;i<samples.length;i++){ const v=samples[i]; const barH=Math.max(2, v*h*0.95); const x=i*barW; const y=h-barH; ctx.fillStyle = (v>0.6)?'#22c55e':(v>0.35)?'#06b6d4':'#60a5fa'; ctx.fillRect(x,y,Math.max(1,barW-1),barH); }
    const sX = (startSec/duration)*w; const eX = (endSec/duration)*w; ctx.fillStyle='rgba(250,204,21,0.12)'; ctx.fillRect(sX,0,Math.max(2,eX-sX),h); ctx.strokeStyle='rgba(250,204,21,0.28)'; ctx.lineWidth = 2*pixelRatio; ctx.strokeRect(sX+1,1,Math.max(1,eX-sX-2),h-2);
    const containerRect = timelineCanvas.getBoundingClientRect(); const scale = containerRect.width / w; selectionArea.style.display='block'; handleLeft.style.display='block'; handleRight.style.display='block'; selectionArea.classList.remove('hidden'); handleLeft.classList.remove('hidden'); handleRight.classList.remove('hidden'); const leftPx = sX*scale; const widthPx = (eX-sX)*scale; selectionArea.style.left = `${leftPx}px`; selectionArea.style.width = `${Math.max(8,widthPx)}px`; selectionArea.style.top = `0px`; selectionArea.style.height = `${containerRect.height}px`; const handleW=12; handleLeft.style.left = `${leftPx - (handleW/2)}px`; handleLeft.style.top='0px'; handleLeft.style.height=`${containerRect.height}px`; handleRight.style.left = `${leftPx + widthPx - (handleW/2)}px`; handleRight.style.top='0px'; handleRight.style.height=`${containerRect.height}px`; startText.textContent = fmt(startSec); endText.textContent = fmt(endSec);
  }

  function clientXToTime(clientX){ const rect = timelineCanvas.getBoundingClientRect(); const rel = Math.max(0, Math.min(1, (clientX - rect.left)/rect.width)); return rel*duration; }

  timelineCanvas.addEventListener('mousedown', (ev)=>{ if(!duration) return; const rect = timelineCanvas.getBoundingClientRect(); const x = ev.clientX; const t = clientXToTime(x); const sPx = (startSec/duration)*rect.width + rect.left; const ePx = (endSec/duration)*rect.width + rect.left; const tol = Math.max(8, rect.width*0.01); if(Math.abs(x - sPx) <= tol){ dragging.left = true; } else if(Math.abs(x - ePx) <= tol){ dragging.right = true; } else if(x > sPx + tol && x < ePx - tol){ dragging.move = true; dragging.offset = t - startSec; } });

  window.addEventListener('mousemove', (ev)=>{ if(!duration) return; if(!dragging.left && !dragging.right && !dragging.move) return; const t = clientXToTime(ev.clientX); if(dragging.left){ startSec = Math.max(0, Math.min(t, endSec - 0.01)); } else if(dragging.right){ endSec = Math.min(duration, Math.max(t, startSec + 0.01)); } else if(dragging.move){ let newStart = t - dragging.offset; let segmentLen = endSec - startSec; if(newStart < 0) newStart = 0; let newEnd = newStart + segmentLen; if(newEnd > duration){ newEnd = duration; newStart = newEnd - segmentLen; } startSec = newStart; endSec = newEnd; } drawTimeline(); });

  window.addEventListener('mouseup', ()=>{ dragging.left = dragging.right = dragging.move = false; dragging.offset = 0; });

  timelineCanvas.addEventListener('click', (ev)=>{ if(!duration) return; if(ev.shiftKey){ endSec = Math.max(startSec + 0.01, clientXToTime(ev.clientX)); } else { const t = clientXToTime(ev.clientX); if(t >= endSec){ const seg = endSec - startSec; startSec = Math.max(0, t - seg); endSec = t; } else { startSec = Math.min(t, endSec - 0.01); } } drawTimeline(); });

  let playingSelection=false; let playOnEndHandler=null;
  playSelBtn.addEventListener('click', ()=>{ if(!videoPreview.src) return; if(!playingSelection){ videoPreview.currentTime = startSec + 0.0001; videoPreview.play(); playingSelection = true; playSelBtn.textContent = '⏹ Stop'; playOnEndHandler = ()=>{ if(videoPreview.currentTime >= endSec - 0.05){ videoPreview.pause(); playingSelection=false; playSelBtn.textContent='▶️ Play Sel'; videoPreview.removeEventListener('timeupdate', playOnEndHandler); } }; videoPreview.addEventListener('timeupdate', playOnEndHandler); } else { videoPreview.pause(); playingSelection=false; playSelBtn.textContent='▶️ Play Sel'; if(playOnEndHandler) videoPreview.removeEventListener('timeupdate', playOnEndHandler); } });

  // Canvas-based video cutting without FFmpeg
  async function cutVideoWithCanvas() {
    if (!originalFile && !currentBlob) {
      setStatus('❌ Tidak ada file untuk dipotong.');
      return null;
    }

    setStatus('✂ Mulai pemotongan video (ini membutuhkan waktu)...');
    
    try {
      const srcFile = currentBlob || originalFile;
      const FPS = 24; // Frame per second (lower = faster)
      const frameInterval = 1000 / FPS;
      
      // Create temporary video element for frame extraction
      const tempVideo = document.createElement('video');
      tempVideo.src = URL.createObjectURL(srcFile);
      tempVideo.crossOrigin = 'anonymous';
      
      // Wait for video to load metadata
      await new Promise(r => { tempVideo.onloadedmetadata = r; });
      
      setStatus(`⏳ Mengekstrak frame (${startSec}s - ${endSec}s)...`);
      
      // Create canvas for frame capture
      const canvas = document.createElement('canvas');
      canvas.width = tempVideo.videoWidth;
      canvas.height = tempVideo.videoHeight;
      const ctx = canvas.getContext('2d', { willReadFrequently: true });
      
      // Collect frames
      const frames = [];
      let currentTime = startSec;
      let frameCount = 0;
      
      while (currentTime < endSec) {
        tempVideo.currentTime = currentTime;
        
        // Wait for frame to be ready
        await new Promise(r => {
          tempVideo.onseeked = r;
          setTimeout(r, 100);
        });
        
        // Draw frame to canvas
        ctx.drawImage(tempVideo, 0, 0);
        
        // Convert canvas to blob and store
        const canvasBlob = await new Promise(resolve => canvas.toBlob(resolve, 'image/jpeg', 0.8));
        frames.push(canvasBlob);
        
        frameCount++;
        currentTime += frameInterval;
        
        // Show progress
        if (frameCount % 10 === 0) {
          const progress = ((currentTime - startSec) / (endSec - startSec) * 100).toFixed(0);
          setStatus(`⏳ Mengekstrak frame... ${progress}%`);
        }
      }
      
      setStatus(`⏳ Membuat video dari ${frames.length} frame...`);
      
      // Create video from frames using MediaRecorder
      const recordedChunks = [];
      const canvasRecord = document.createElement('canvas');
      canvasRecord.width = tempVideo.videoWidth;
      canvasRecord.height = tempVideo.videoHeight;
      const ctxRecord = canvasRecord.getContext('2d');
      
      const stream = canvasRecord.captureStream(FPS);
      const mediaRecorder = new MediaRecorder(stream, {
        mimeType: 'video/webm'
      });
      
      mediaRecorder.ondataavailable = (e) => recordedChunks.push(e.data);
      mediaRecorder.start();
      
      // Draw frames to canvas at FPS rate - SEQUENTIAL with proper waiting
      for (let frameIndex = 0; frameIndex < frames.length; frameIndex++) {
        const frameBlob = frames[frameIndex];
        const img = new Image();
        
        // Wait for image to load
        await new Promise(r => {
          img.onload = () => {
            ctxRecord.drawImage(img, 0, 0);
            r();
          };
          img.onerror = () => {
            console.error('Failed to load frame', frameIndex);
            r();
          };
          img.src = URL.createObjectURL(frameBlob);
        });
        
        // Wait for frame interval before drawing next frame
        await new Promise(r => setTimeout(r, frameInterval));
        
        if (frameIndex % 10 === 0) {
          const progress = (frameIndex / frames.length * 100).toFixed(0);
          setStatus(`⏳ Encoding... ${progress}%`);
        }
      }
      
      // Stop recording after all frames are drawn
      mediaRecorder.stop();
      
      // Wait for MediaRecorder to finish
      await new Promise(r => {
        mediaRecorder.onstop = r;
      });
      
      // Create blob from recorded video
      const outputBlob = new Blob(recordedChunks, { type: 'video/webm' });
      currentBlob = outputBlob;
      
      // Preview result
      const url = URL.createObjectURL(outputBlob);
      videoPreview.src = url;
      videoPreview.play().catch(() => {});
      
      // Attach to form
      const duration = (endSec - startSec).toFixed(1);
      setStatus(`✅ Berhasil! (${duration}s). Siap upload.`);
      attachBlobToForm(outputBlob, originalFile ? originalFile.name.replace(/\.[^/.]+$/, '') + '_trim.webm' : 'trimmed.webm');
      
      return outputBlob;
    } catch (err) {
      console.error('Cutting error:', err);
      setStatus(`❌ Error: ${err.message}`);
      return null;
    }
  }

  function attachBlobToForm(blob, filename){ // find closest form ancestor
    const parentForm = document.querySelector('form');
    if(!parentForm){ setStatus('⚠️ Tidak menemukan formulir untuk melampirkan file.'); return; }
    let input = parentForm.querySelector('input[name="video_file"]');
    if(!input){ input = document.createElement('input'); input.type = 'file'; input.name = 'video_file'; input.style.display='none'; parentForm.appendChild(input); }
    // create File and set to input via DataTransfer
    const file = new File([blob], filename, { type: blob.type });
    const dt = new DataTransfer(); dt.items.add(file); input.files = dt.files;
    setStatus('📎 File trim siap di-upload ('+filename+'). Pastikan menyimpan formulir untuk mengirim.');
  }

  cutBtn.addEventListener('click', async ()=>{ await cutVideoWithCanvas(); });

  resetBtn.addEventListener('click', async ()=>{ if(!originalFile){ setStatus('❌ Tidak ada file asli.'); return; } if(currentBlob) try{ URL.revokeObjectURL(videoPreview.src); }catch{} currentBlob=null; await loadVideo(originalFile); setStatus('↩ Reset: kembali ke video asli.'); });

  // No need to pre-load anything anymore - init basic sizing
  (function init(){ timelineCanvas.style.width='100%'; timelineCanvas.style.height='96px'; resizeCanvas(); })();

})();
</script>
