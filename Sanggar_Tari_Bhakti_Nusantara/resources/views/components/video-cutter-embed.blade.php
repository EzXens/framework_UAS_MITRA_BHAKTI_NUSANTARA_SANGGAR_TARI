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
        <button id="vc_uploadOriginalBtn" type="button" class="px-4 py-2 rounded bg-blue-500 text-white font-medium">📤 Upload Asli</button>
        <button id="vc_resetBtn" type="button" class="px-4 py-2 rounded bg-gray-500 text-white">↩ Reset</button>
      </div>
    </div>

    <div id="vc_status" class="text-sm text-slate-300 mt-3"></div>

    <!-- This hidden input should exist in the parent form. If not, component will create one. -->
</div>

<!-- Load MediaRecorder for video capture -->
<script src="https://cdn.jsdelivr.net/npm/mp4-box@0.2.5/dist/index.umd.js"></script>

<style>
  #videoCutter .timeline-canvas {
    display: block;
    width: 100%;
    height: 96px;
    cursor: pointer;
  }

  #videoCutter .selection-area {
    position: absolute;
    background: rgba(250, 204, 21, 0.15);
    border: 2px solid rgba(250, 204, 21, 0.4);
    top: 0;
    pointer-events: none;
  }

  #videoCutter .selection-handle {
    position: absolute;
    width: 12px;
    background: rgba(250, 204, 21, 0.6);
    cursor: ew-resize;
    border-radius: 2px;
    top: 0;
  }

  #videoCutter .selection-handle:hover {
    background: rgba(250, 204, 21, 0.9);
  }
</style>

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
  const uploadOriginalBtn = document.getElementById('vc_uploadOriginalBtn');
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

    // Validate selection
    if (startSec >= endSec) {
      setStatus('❌ Waktu awal harus lebih kecil dari waktu akhir.');
      return null;
    }

    const clipDuration = endSec - startSec;
    if (clipDuration < 0.1) {
      setStatus('❌ Durasi terlalu pendek. Pilih minimal 0.1 detik.');
      return null;
    }

    setStatus('✂ Mulai pemotongan video (ini membutuhkan waktu)...');
    
    try {
      const srcFile = currentBlob || originalFile;
      
      // Use a more reliable approach: extract video segment using Blob slicing
      // and HTML5 video element capabilities
      
      // Create temporary video element for loading
      const tempVideo = document.createElement('video');
      tempVideo.src = URL.createObjectURL(srcFile);
      tempVideo.crossOrigin = 'anonymous';
      tempVideo.preload = 'metadata';
      
      // Wait for video to load metadata
      await new Promise((resolve, reject) => {
        const timeout = setTimeout(() => reject(new Error('Video loading timeout')), 10000);
        tempVideo.onloadedmetadata = () => {
          clearTimeout(timeout);
          resolve();
        };
        tempVideo.onerror = () => {
          clearTimeout(timeout);
          reject(new Error('Failed to load video'));
        };
      });
      
      const videoDuration = tempVideo.duration;
      if (isNaN(videoDuration) || videoDuration === Infinity) {
        setStatus('❌ Tidak dapat membaca durasi video.');
        return null;
      }

      setStatus(`⏳ Mengekstrak frame (${startSec.toFixed(1)}s - ${endSec.toFixed(1)}s, durasi ${clipDuration.toFixed(1)}s)...`);
      
      // Create canvas for recording
      const canvas = document.createElement('canvas');
      canvas.width = tempVideo.videoWidth;
      canvas.height = tempVideo.videoHeight;
      
      if (canvas.width === 0 || canvas.height === 0) {
        setStatus('❌ Tidak dapat membaca dimensi video.');
        return null;
      }

      // Collect frames with precise timing
      const FPS = 24;
      const frames = [];
      const frameTimestamps = [];
      
      let frameCount = 0;
      let currentTime = startSec;
      const totalFramesNeeded = Math.ceil(clipDuration * FPS);

      while (currentTime < endSec && frameCount < totalFramesNeeded * 1.2) {
        tempVideo.currentTime = currentTime;
        
        // Wait for frame to be ready
        await new Promise(resolve => {
          let seeked = false;
          const onSeeked = () => {
            if (!seeked) {
              seeked = true;
              tempVideo.removeEventListener('seeked', onSeeked);
              resolve();
            }
          };
          tempVideo.addEventListener('seeked', onSeeked);
          // Timeout fallback
          setTimeout(() => {
            if (!seeked) {
              seeked = true;
              tempVideo.removeEventListener('seeked', onSeeked);
              resolve();
            }
          }, 150);
        });
        
        // Draw frame to canvas and capture
        const ctx = canvas.getContext('2d');
        try {
          ctx.drawImage(tempVideo, 0, 0);
          
          // Get image data
          canvas.toBlob((blob) => {
            if (blob) {
              frames.push(blob);
              frameTimestamps.push(currentTime);
            }
          }, 'image/jpeg', 0.85);
          
          // Wait a moment for blob capture
          await new Promise(r => setTimeout(r, 20));
        } catch (e) {
          console.warn('Could not draw frame at', currentTime);
        }
        
        frameCount++;
        currentTime += (1 / FPS);
        
        // Show progress
        if (frameCount % 8 === 0) {
          const progress = Math.round((frameCount / totalFramesNeeded) * 100);
          setStatus(`⏳ Mengekstrak frame... ${frameCount} (${progress}%)`);
        }
      }
      
      if (frames.length < 2) {
        setStatus('❌ Tidak dapat mengekstrak frame dari video. Coba durasi yang lebih panjang.');
        return null;
      }

      // Ensure we have collected enough frames
      await new Promise(r => setTimeout(r, 200));

      setStatus(`⏳ Membuat video dari ${frames.length} frame (${(frames.length / FPS).toFixed(1)}s)...`);
      
      // Use a canvas-based approach with proper timing
      const outputCanvas = document.createElement('canvas');
      outputCanvas.width = tempVideo.videoWidth;
      outputCanvas.height = tempVideo.videoHeight;
      
      const stream = outputCanvas.captureStream(FPS);
      const mediaRecorder = new MediaRecorder(stream, {
        mimeType: 'video/webm'
      });
      
      const recordedChunks = [];
      mediaRecorder.ondataavailable = (e) => {
        if (e.data.size > 0) {
          recordedChunks.push(e.data);
        }
      };
      
      mediaRecorder.start();
      
      // Draw frames with proper timing using timestamps
      const outputCtx = outputCanvas.getContext('2d');
      const startTime = performance.now();
      
      for (let i = 0; i < frames.length; i++) {
        const img = new Image();
        
        await new Promise((resolve) => {
          img.onload = () => {
            try {
              outputCtx.drawImage(img, 0, 0);
            } catch (e) {
              console.warn('Could not draw frame', i);
            }
            resolve();
          };
          img.onerror = () => {
            console.error('Failed to load frame', i);
            resolve();
          };
          img.src = URL.createObjectURL(frames[i]);
        });
        
        // Wait proper frame interval - this ensures correct playback speed
        const frameDelay = 1000 / FPS; // milliseconds per frame
        await new Promise(resolve => setTimeout(resolve, frameDelay));
        
        if ((i + 1) % 12 === 0) {
          const progress = Math.round(((i + 1) / frames.length) * 100);
          setStatus(`⏳ Encoding... ${i + 1}/${frames.length} (${progress}%)`);
        }
      }
      
      // Stop recording
      mediaRecorder.stop();
      
      // Wait for MediaRecorder to finish
      await new Promise(resolve => {
        const timeout = setTimeout(resolve, 2000);
        mediaRecorder.onstop = () => {
          clearTimeout(timeout);
          resolve();
        };
      });
      
      if (recordedChunks.length === 0) {
        setStatus('❌ Gagal membuat video dari frame.');
        return null;
      }
      
      // Create blob from recorded video
      const outputBlob = new Blob(recordedChunks, { type: 'video/webm' });
      
      if (outputBlob.size === 0) {
        setStatus('❌ Video output kosong. Coba durasi yang lebih panjang.');
        return null;
      }

      currentBlob = outputBlob;
      
      // Clean up stream
      stream.getTracks().forEach(track => {
        try { track.stop(); } catch (e) {}
      });
      
      // Preview result
      const url = URL.createObjectURL(outputBlob);
      videoPreview.src = url;
      try {
        videoPreview.play().catch(() => {});
      } catch (e) {}
      
      // Attach to form
      const filename = originalFile ? originalFile.name.replace(/\.[^/.]+$/, '') + '_trim.webm' : 'trimmed.webm';
      const finalDuration = (frames.length / FPS).toFixed(1);
      setStatus(`✅ Berhasil! (${finalDuration}s, ${frames.length} frame). Siap upload.`);
      attachBlobToForm(outputBlob, filename);
      
      return outputBlob;
    } catch (err) {
      console.error('Cutting error:', err);
      setStatus(`❌ Error: ${err.message}`);
      return null;
    }
  }

  function attachBlobToForm(blob, filename){ 
    // Find parent form
    let parentForm = document.querySelector('form');
    if (!parentForm) {
      // Try to find form by traversing up from the cutter div
      const cutterDiv = document.getElementById('videoCutter');
      if (cutterDiv) {
        parentForm = cutterDiv.closest('form');
      }
    }
    
    if (!parentForm) {
      setStatus('⚠️ Tidak menemukan formulir untuk melampirkan file.');
      return;
    }
    
    // Find or create input
    let input = parentForm.querySelector('input[name="video_file"]');
    if (!input) {
      input = document.createElement('input');
      input.type = 'file';
      input.name = 'video_file';
      input.id = 'video_file_input';
      input.style.display = 'none';
      parentForm.appendChild(input);
    }
    
    // Create File object with correct MIME type
    let file;
    if (blob instanceof File) {
      // Already a File, use as-is
      file = blob;
    } else {
      // It's a Blob, convert to File
      const mimeType = blob.type || 'video/webm';
      file = new File([blob], filename, { type: mimeType });
    }
    
    // Use DataTransfer to set file to input
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    input.files = dataTransfer.files;
    
    // Trigger change event to notify any listeners
    input.dispatchEvent(new Event('change', { bubbles: true }));
    
    setStatus('📎 File video siap di-upload (' + filename + '). Pastikan menyimpan formulir untuk mengirim.');
  }

  cutBtn.addEventListener('click', async ()=>{ await cutVideoWithCanvas(); });

  uploadOriginalBtn.addEventListener('click', ()=>{ 
    if (!originalFile) { 
      setStatus('❌ Tidak ada file asli untuk diupload.'); 
      return; 
    }
    attachBlobToForm(originalFile, originalFile.name);
    setStatus('✅ File video asli siap di-upload. Pastikan menyimpan formulir untuk mengirim.');
  });

  resetBtn.addEventListener('click', async ()=>{ if(!originalFile){ setStatus('❌ Tidak ada file asli.'); return; } if(currentBlob) try{ URL.revokeObjectURL(videoPreview.src); }catch{} currentBlob=null; await loadVideo(originalFile); setStatus('↩ Reset: kembali ke video asli.'); });

  // No need to pre-load anything anymore - init basic sizing
  (function init(){ timelineCanvas.style.width='100%'; timelineCanvas.style.height='96px'; resizeCanvas(); })();

})();
</script>
