<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Video Cutter — Timeline + Drag Selection</title>

  <!-- No external dependencies needed for Canvas-based cutting -->

  <style>
    /* kecilkan pointer events pada overlay agar input tetap responsif */
    .timeline-canvas { width:100%; height:96px; border-radius:8px; background:#0b1220; cursor:crosshair; }
    .bar { background:#2dd4bf; }
    .selection-handle { width:12px; height:96px; background:transparent; cursor:ew-resize; position:absolute; top:0; }
    .selection-area { position:absolute; top:0; height:96px; background:rgba(250,204,21,0.18); border:2px solid rgba(250,204,21,0.35); border-radius:6px; cursor:move; }
  </style>
</head>
<body class="bg-slate-900 text-slate-100 p-6">

  <div class="max-w-4xl mx-auto bg-slate-800 p-6 rounded-2xl shadow-lg">
    <h1 class="text-2xl font-semibold mb-4">🎬 Video Cutter — Timeline + Drag Selection</h1>

    <div class="space-y-4">
      <input id="videoInput" type="file" accept="video/*" class="block w-full text-slate-900 p-2 rounded-md bg-white" />

      <video id="videoPreview" controls style="width:100%; border-radius:8px; display:none; background:black;"></video>

      <!-- Timeline container -->
      <div class="relative mt-2" style="height:96px;">
        <canvas id="timeline" class="timeline-canvas"></canvas>
        <!-- selection overlay -- will be positioned absolutely -->
        <div id="selectionArea" class="selection-area hidden"></div>
        <div id="handleLeft" class="selection-handle hidden"></div>
        <div id="handleRight" class="selection-handle hidden"></div>
      </div>

      <div class="flex gap-3 items-center">
        <div>
          <label class="text-sm text-slate-300">Start</label>
          <div id="startText" class="font-mono text-slate-200">0.00s</div>
        </div>
        <div>
          <label class="text-sm text-slate-300">End</label>
          <div id="endText" class="font-mono text-slate-200">0.00s</div>
        </div>

        <div class="ml-auto flex gap-2">
          <button id="playSel" class="px-4 py-2 rounded bg-emerald-500 text-black font-medium">▶️ Play Sel</button>
            <button id="cutBtn" class="px-4 py-2 rounded bg-amber-400 text-black font-medium">✂ Potong</button>
          <button id="resetBtn" class="px-4 py-2 rounded bg-gray-500 text-white">↩ Reset</button>
        </div>
      </div>

      <div id="status" class="text-sm text-slate-300 mt-2"></div>

    </div>
  </div>

<script>
/* =========================================
   Variables & DOM
   ========================================= */
const videoInput = document.getElementById('videoInput');
const videoPreview = document.getElementById('videoPreview');
const timelineCanvas = document.getElementById('timeline');
const ctx = timelineCanvas.getContext('2d');
const selectionArea = document.getElementById('selectionArea');
const handleLeft = document.getElementById('handleLeft');
const handleRight = document.getElementById('handleRight');

const startText = document.getElementById('startText');
const endText = document.getElementById('endText');
const playSelBtn = document.getElementById('playSel');
const cutBtn = document.getElementById('cutBtn');
const resetBtn = document.getElementById('resetBtn');
 
const status = document.getElementById('status');

let originalFile = null;
let currentBlob = null;

let duration = 0;
let sampleCount = 160; // jumlah sample bars di timeline (auto-adjusted)
let samples = [];      // array brightness [0..1]

let startSec = 0;
let endSec = 0;

let dragging = { left:false, right:false, move:false, offset:0 };
let pixelRatio = devicePixelRatio || 1;

/* FFmpeg */
let ffmpeg = null;
let ffmpegReady = false;

/* =========================================
   Helpers
   ========================================= */
function fmt(s) {
  if (isNaN(s)) return '0.00s';
  return s.toFixed(2) + 's';
}

function setStatus(text, tone='info') {
  status.textContent = text || '';
}

/* =========================================
   Resize canvas helper
   ========================================= */
function resizeCanvas() {
  const rect = timelineCanvas.getBoundingClientRect();
  timelineCanvas.width = Math.max(600, rect.width) * pixelRatio;
  timelineCanvas.height = 96 * pixelRatio;
  drawTimeline(); // redraw
}
window.addEventListener('resize', () => {
  // throttle via rAF
  window.requestAnimationFrame(resizeCanvas);
});

/* =========================================
   Load video & generate timeline samples
   ========================================= */
videoInput.addEventListener('change', async (e) => {
  const file = e.target.files[0];
  if (!file) return;
  originalFile = file;
  currentBlob = null;
  await loadVideo(file);
});

async function loadVideo(file) {
  setStatus('⏳ Memuat video dan membuat timeline — mohon tunggu...');
  const url = URL.createObjectURL(file);
  videoPreview.src = url;
  videoPreview.style.display = 'block';

  // wait metadata
  await new Promise((res) => {
    videoPreview.onloadedmetadata = () => res();
  });

  duration = videoPreview.duration;
  // pick a smaller initial sample count and progressively refine timeline
  sampleCount = Math.min(220, Math.max(48, Math.floor(Math.min(150, duration * 2))));
  startSec = 0; endSec = duration; updateSelectionUI();
  samples = await progressiveCaptureFrames(videoPreview, sampleCount);
  setStatus('✅ Timeline siap (' + samples.length + ' samples).');
  resizeCanvas();
}

/* =========================================
   Capture frame brightness samples
   - seek video to specific times one-by-one
   - draw to offscreen canvas and compute avg luminance
   ========================================= */
// progressive capture: quick pass then background refinement to keep UI responsive
async function progressiveCaptureFrames(videoEl, nSamples){
  const off = document.createElement('canvas');
  const ow = 128, oh = 72; off.width = ow; off.height = oh; const octx = off.getContext('2d');
  const makeTimes = (count)=>{ const t=[]; for(let i=0;i<count;i++) t.push((i/count)*Math.max(0.0001, videoEl.duration)); return t; };

  const quickCount = Math.min(64, Math.max(24, Math.floor(nSamples/3)));
  const quickTimes = makeTimes(quickCount);
  const quickResults = [];
  for(let i=0;i<quickTimes.length;i++){
    const t = quickTimes[i]; await seekVideo(videoEl, t);
    try{ octx.drawImage(videoEl,0,0,ow,oh); const id=octx.getImageData(0,0,ow,oh).data; let sum=0,cnt=0; for(let p=0;p<id.length;p+=4){ sum += 0.2126*id[p] + 0.7152*id[p+1] + 0.0722*id[p+2]; cnt++; } quickResults.push((sum/cnt)/255); }
    catch(e){ quickResults.push(0.1); }
    setStatus(`⏳ Membuat timeline (cepat): ${i+1}/${quickTimes.length}...`);
    await new Promise(r=>setTimeout(r,8));
  }

  // interpolate quick results to full length for immediate rendering
  const interim = new Array(nSamples).fill(0);
  for(let i=0;i<nSamples;i++){ const srcIdx = Math.floor((i/nSamples)*quickResults.length); interim[i] = quickResults[Math.min(srcIdx, quickResults.length-1)]; }
  samples = interim; drawTimeline();

  // background full sampling in chunks
  const fullTimes = makeTimes(nSamples);
  const fullResults = new Array(nSamples);
  const chunk = 12;
  for(let offset=0; offset<fullTimes.length; offset+=chunk){
    const end = Math.min(fullTimes.length, offset+chunk);
    for(let i=offset;i<end;i++){
      const t = fullTimes[i]; await seekVideo(videoEl, t);
      try{ octx.drawImage(videoEl,0,0,ow,oh); const id = octx.getImageData(0,0,ow,oh).data; let sum=0,cnt=0; for(let p=0;p<id.length;p+=4){ sum += 0.2126*id[p] + 0.7152*id[p+1] + 0.0722*id[p+2]; cnt++; } fullResults[i] = (sum/cnt)/255; }
      catch(e){ fullResults[i] = 0.1; }
    }
    const done = Math.min(offset+chunk, fullTimes.length);
    setStatus(`⏳ Menyempurnakan timeline: ${done}/${fullTimes.length} frame sampled...`);
    for(let i=offset;i<end;i++) samples[i] = fullResults[i];
    drawTimeline();
    await new Promise(r=>setTimeout(r,20));
  }
  await seekVideo(videoEl, startSec || 0);
  setStatus('✅ Timeline lengkap.');
  return samples;
} 

function seekVideo(videoEl, time) {
  return new Promise((resolve) => {
    const onSeeked = () => { videoEl.removeEventListener('seeked', onSeeked); resolve(); };
    videoEl.addEventListener('seeked', onSeeked);
    try{ videoEl.currentTime = Math.min(videoEl.duration - 0.001, Math.max(0, time)); }catch(e){}
    // shorter timeout to avoid long hangs
    setTimeout(() => { videoEl.removeEventListener('seeked', onSeeked); resolve(); }, 1200);
  });
}

/* =========================================
   Draw timeline bars & selection overlay
   ========================================= */
function drawTimeline() {
  const w = timelineCanvas.width;
  const h = timelineCanvas.height;
  ctx.clearRect(0,0,w,h);

  // background
  ctx.fillStyle = '#071025';
  ctx.fillRect(0,0,w,h);

  if (!samples || samples.length === 0) {
    // placeholder
    ctx.fillStyle = '#0f1724';
    ctx.fillRect(0,0,w,h);
    return;
  }

  // draw bars
  const barW = w / samples.length;
  for (let i = 0; i < samples.length; i++) {
    const v = samples[i]; // 0..1
    const barH = Math.max(2, v * h * 0.95);
    const x = i * barW;
    const y = h - barH;
    // color gradient
    ctx.fillStyle = (v > 0.6) ? '#22c55e' : (v > 0.35) ? '#06b6d4' : '#60a5fa';
    ctx.fillRect(x, y, Math.max(1, barW - 1), barH);
  }

  // draw selection overlay (convert time to px)
  const rect = timelineCanvas.getBoundingClientRect();
  const canvasW = w;
  const sX = (startSec / duration) * canvasW;
  const eX = (endSec / duration) * canvasW;
  // semi transparent overlay
  ctx.fillStyle = 'rgba(250,204,21,0.12)';
  ctx.fillRect(sX, 0, Math.max(2, eX - sX), h);
  // border
  ctx.strokeStyle = 'rgba(250,204,21,0.28)';
  ctx.lineWidth = 2 * pixelRatio;
  ctx.strokeRect(sX + 1, 1, Math.max(1, eX - sX - 2), h - 2);

  // update absolute DOM overlay for accurate pointer events & handle placement
  const containerRect = timelineCanvas.getBoundingClientRect();
  const scale = containerRect.width / canvasW;

  // show selectionArea & handles
  selectionArea.style.display = 'block';
  handleLeft.style.display = 'block';
  handleRight.style.display = 'block';
  selectionArea.classList.remove('hidden');
  handleLeft.classList.remove('hidden');
  handleRight.classList.remove('hidden');

  const leftPx = sX * scale + containerRect.left - containerRect.left; // relative
  const widthPx = (eX - sX) * scale;
  selectionArea.style.left = `${leftPx}px`;
  selectionArea.style.width = `${Math.max(8, widthPx)}px`;
  selectionArea.style.top = `${containerRect.top - containerRect.top}px`; // always 0 relative
  selectionArea.style.height = `${containerRect.height}px`;

  // handles (12px wide)
  const handleW = 12;
  handleLeft.style.left = `${leftPx - (handleW/2)}px`;
  handleLeft.style.top = '0px';
  handleLeft.style.height = `${containerRect.height}px`;

  handleRight.style.left = `${leftPx + widthPx - (handleW/2)}px`;
  handleRight.style.top = '0px';
  handleRight.style.height = `${containerRect.height}px`;

  // update start/end texts
  startText.textContent = fmt(startSec);
  endText.textContent = fmt(endSec);
}

/* =========================================
   Pointer interactions for dragging selection
   ========================================= */
function clientXToTime(clientX) {
  const rect = timelineCanvas.getBoundingClientRect();
  const rel = Math.max(0, Math.min(1, (clientX - rect.left) / rect.width));
  return rel * duration;
}

timelineCanvas.addEventListener('mousedown', (ev) => {
  if (!duration) return;
  const rect = timelineCanvas.getBoundingClientRect();
  const x = ev.clientX;
  const t = clientXToTime(x);

  // positions in px on canvas
  const sPx = (startSec / duration) * rect.width + rect.left;
  const ePx = (endSec / duration) * rect.width + rect.left;

  const tol = Math.max(8, rect.width * 0.01); // tolerance in px

  if (Math.abs(x - sPx) <= tol) {
    dragging.left = true;
  } else if (Math.abs(x - ePx) <= tol) {
    dragging.right = true;
  } else if (x > sPx + tol && x < ePx - tol) {
    // drag move whole selection
    dragging.move = true;
    dragging.offset = t - startSec; // keep offset
  }
});

window.addEventListener('mousemove', (ev) => {
  if (!duration) return;
  if (!dragging.left && !dragging.right && !dragging.move) return;

  const t = clientXToTime(ev.clientX);

  if (dragging.left) {
    startSec = Math.max(0, Math.min(t, endSec - 0.01));
  } else if (dragging.right) {
    endSec = Math.min(duration, Math.max(t, startSec + 0.01));
  } else if (dragging.move) {
    let newStart = t - dragging.offset;
    let segmentLen = endSec - startSec;
    if (newStart < 0) newStart = 0;
    let newEnd = newStart + segmentLen;
    if (newEnd > duration) {
      newEnd = duration;
      newStart = newEnd - segmentLen;
    }
    startSec = newStart;
    endSec = newEnd;
  }

  drawTimeline();
});

window.addEventListener('mouseup', () => {
  dragging.left = dragging.right = dragging.move = false;
  dragging.offset = 0;
});

/* Also allow clicking on timeline to set start or end quickly (shift for end) */
timelineCanvas.addEventListener('click', (ev) => {
  if (!duration) return;
  if (ev.shiftKey) {
    // set end
    endSec = Math.max(startSec + 0.01, clientXToTime(ev.clientX));
  } else {
    // set start
    const t = clientXToTime(ev.clientX);
    if (t >= endSec) {
      // if clicked after end, move both
      const seg = endSec - startSec;
      startSec = Math.max(0, t - seg);
      endSec = t;
    } else {
      startSec = Math.min(t, endSec - 0.01);
    }
  }
  drawTimeline();
});

/* =========================================
   Play selection preview
   ========================================= */
let playingSelection = false;
let playOnEndHandler = null;

playSelBtn.addEventListener('click', () => {
  if (!videoPreview.src) return;
  if (!playingSelection) {
    videoPreview.currentTime = startSec + 0.0001;
    videoPreview.play();
    playingSelection = true;
    playSelBtn.textContent = '⏹ Stop';
    // stop at endSec
    playOnEndHandler = () => {
      if (videoPreview.currentTime >= endSec - 0.05) {
        videoPreview.pause();
        playingSelection = false;
        playSelBtn.textContent = '▶️ Play Sel';
        videoPreview.removeEventListener('timeupdate', playOnEndHandler);
      }
    };
    videoPreview.addEventListener('timeupdate', playOnEndHandler);
  } else {
    videoPreview.pause();
    playingSelection = false;
    playSelBtn.textContent = '▶️ Play Sel';
    if (playOnEndHandler) videoPreview.removeEventListener('timeupdate', playOnEndHandler);
  }
});

/* =========================================
   FFmpeg init (lazy) with error handling & CDN fallback
   ========================================= */
// async function ensureFFmpeg() {
//   if (ffmpegReady) return;
//   setStatus('⏳ Memuat FFmpeg (webassembly)...');
//   try {
//     if (!window.FFmpeg) {
//       throw new Error('FFmpeg library tidak tersedia. Coba refresh halaman.');
//     }
//     const { createFFmpeg, fetchFile } = FFmpeg;
//     ffmpeg = createFFmpeg({ log: false }); // disable verbose log
//     const loadPromise = ffmpeg.load();
//     // timeout fallback setelah 30 detik
//     const timeoutPromise = new Promise((_, reject) => 
//       setTimeout(() => reject(new Error('FFmpeg load timeout (30s). Server CDN mungkin lambat. Coba lagi.')), 30000)
//     );
//     await Promise.race([loadPromise, timeoutPromise]);
//     ffmpegReady = true;
//     setStatus('✅ FFmpeg siap. Klik ✂ Potong untuk memotong video.');
//   } catch (err) {
//     console.error('FFmpeg load error:', err);
//     setStatus(`❌ Gagal memuat FFmpeg: ${err.message}. Coba refresh halaman atau gunakan browser lain.`);
//     ffmpeg = null;
//     ffmpegReady = false;
//     throw err;
//   }
// }

let ffmpeg = null;
let ffmpegReady = false;
let ffmpegLoading = false;

// Canvas-based video cutting without FFmpeg
async function cutVideoWithCanvas() {
    if (!originalFile && !currentBlob) {
        setStatus("❌ Tidak ada file untuk dipotong.");
        return null;
    }

    setStatus("✂ Mulai pemotongan video (ini membutuhkan waktu)...");
    
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
        attachBlobToForm(outputBlob, originalFile.name.replace(/\.[^/.]+$/, "") + "_trim.webm");
        
        return outputBlob;
    } catch (err) {
        console.error('Cutting error:', err);
        setStatus(`❌ Error: ${err.message}`);
        return null;
    }
}

// load otomatis di background
setTimeout(loadFFmpegSilent, 300);


/* =========================================
   Cutting with ffmpeg.wasm
   ========================================= */
// preloadBtn.addEventListener('click', async () => {
//   if (ffmpegReady) { setStatus('✅ FFmpeg sudah siap.'); return; }
//   preloadBtn.disabled = true;
//   try {
//     await ensureFFmpeg();
//     preloadBtn.textContent = '✅ FFmpeg Siap';
//   } catch (err) {
//     preloadBtn.textContent = '⚙️ Siapkan FFmpeg';
//     preloadBtn.disabled = false;
//   }
// });

cutBtn.addEventListener('click', async () => {
  if (!originalFile && !currentBlob) { setStatus('❌ Tidak ada file untuk dipotong.'); return; }
  try {
    await cutVideoWithCanvas();
  } catch (err) {
    // cutVideoWithCanvas reports errors via setStatus
  }
});

async function exportTrim() {
    if (!originalFile && !currentBlob) {
        setStatus("❌ Tidak ada file untuk dipotong.");
        return null;
    }
    
    return await cutVideoWithCanvas();
}


/* =========================================
   Reset to original file (undo trim)
   ========================================= */
resetBtn.addEventListener('click', async () => {
  if (!originalFile) { setStatus('❌ Tidak ada file asli.'); return; }
  // revoke previous blob URL if any
  if (currentBlob) {
    try { URL.revokeObjectURL(videoPreview.src); } catch {}
  }
  currentBlob = null;
  await loadVideo(originalFile);
  setStatus('↩ Reset: kembali ke video asli.');
});

/* =========================================
   Init draw loop & resize
   ========================================= */
function updateSelectionUI() {
  // update DOM strings
  startText.textContent = fmt(startSec);
  endText.textContent = fmt(endSec);
  // draw timeline if samples exist
  drawTimeline();
}

// initial canvas sizing
(function init() {
  // set style width to computed width to get rect width
  timelineCanvas.style.width = '100%';
  timelineCanvas.style.height = '96px';
  resizeCanvas();
})();

</script>
</body>
</html>
