<div id="musicCutter" class="p-6 max-w-3xl mx-auto rounded-3xl shadow-xl text-gray-900 bg-white border border-gray-300">

    <h2 class="text-2xl font-semibold mb-4 flex items-center gap-2 text-gray-900">
        🎶 <span>Music Cutter</span>
    </h2>

    <div id="dropArea"
         class="border-2 border-dashed rounded-2xl p-8 text-center transition-all border-gray-400 bg-gray-50 hover:bg-gray-100">

        <p class="mb-2 text-gray-600 text-sm">Tarik & letakkan lagu di sini</p>
        <p class="text-xs text-gray-500">atau</p>

        <input id="fileInput" name="audio_file" type="file" accept="audio/*" @if(isset($required) && $required) required @endif
               class="mt-3 block w-full text-gray-900 p-2 rounded-md bg-white border border-gray-300 cursor-pointer shadow-inner" />
    </div>

    <div class="mt-5">
        <canvas id="waveCanvas" class="w-full h-28 rounded-lg cursor-pointer shadow-inner border border-gray-400"></canvas>
    </div>

    <div class="mt-4 flex flex-col sm:flex-row items-center gap-3">
        <div class="flex flex-col items-center gap-1">
            <label class="text-sm text-gray-600">Mulai</label>
            <span id="startTime" class="text-xs font-mono text-gray-500">00:00</span>
        </div>
        <input id="startRange" type="range" min="0" step="0.01"
               class="flex-1 accent-blue-400" />
        <div class="flex flex-col items-center gap-1">
            <label class="text-sm text-gray-600">Akhir</label>
            <span id="endTime" class="text-xs font-mono text-gray-500">00:00</span>
        </div>
        <input id="endRange" type="range" min="0" step="0.01"
               class="flex-1 accent-yellow-400" />
    </div>

    <div class="flex gap-3 mt-5">
        <button id="playBtn" type="button"
                class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 transition-all font-medium shadow-md active:scale-95 text-white">
            ▶️ Play
        </button>

        <button id="editBtn" type="button"
                class="px-5 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-400 transition-all font-medium shadow-md active:scale-95 text-white">
            ✂️ Potong
        </button>

        <button id="resetBtn" type="button"
                class="px-5 py-2.5 rounded-xl bg-gray-600 hover:bg-gray-500 transition-all font-medium shadow-md active:scale-95 text-white">
            🔄 Reset
        </button>
    </div>

    <div id="info" class="text-sm text-gray-600 mt-4 space-y-1"></div>
</div>

{{-- Success Popup --}}
<div id="success-popup" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 shadow-xl w-80 text-center animate-fadeIn">

        <div class="mx-auto mb-3 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <p class="font-semibold text-green-700" id="success-message"></p>

        <div class="flex justify-center mt-4">
            <button type="button" onclick="closeSuccessPopup()"
                    class="px-6 py-2 rounded-lg bg-gray-400 text-white hover:bg-gray-500">
                OK
            </button>
        </div>
    </div>
</div>

{{-- Edit Mode Popup --}}
<div id="edit-popup" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl p-6 shadow-xl w-96">
        <h3 class="text-lg font-bold mb-4 text-gray-800">Edit Waktu Pemotongan</h3>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai (detik)</label>
                <input type="number" id="edit-start-time" step="0.01" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-800">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Akhir (detik)</label>
                <input type="number" id="edit-end-time" step="0.01" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-800">
            </div>
        </div>

        <div class="flex justify-end gap-2 mt-6">
            <button onclick="closeEditPopup()"
                    class="px-4 py-2 rounded-lg bg-gray-400 text-white hover:bg-gray-500">
                Batal
            </button>
            <button onclick="applyEdit()"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Terapkan
            </button>
        </div>
    </div>
</div>


<script>
let fileName = null;
let audioBuffer = null;
let originalAudioBuffer = null;
let duration = 0;
let originalDuration = 0;
let startSec = 0;
let endSec = 0;
let isPlaying = false;
let isDragging = false;

const dropArea = document.getElementById("dropArea");
const fileInput = document.getElementById("fileInput");
const canvas = document.getElementById("waveCanvas");
const ctx2d = canvas.getContext("2d");
const startRange = document.getElementById("startRange");
const endRange = document.getElementById("endRange");
const startTime = document.getElementById("startTime");
const endTime = document.getElementById("endTime");
const playBtn = document.getElementById("playBtn");
const editBtn = document.getElementById("editBtn");
const resetBtn = document.getElementById("resetBtn");
const info = document.getElementById("info");

let audioCtx = null;
let sourceNode = null;
let dragMove = false;
let dragOffset = 0;





// ==================== LOAD FILE ====================
async function loadFile(file) {
    fileName = file.name;
    info.innerHTML = "⏳ Mendekode audio...";

    const arrayBuffer = await file.arrayBuffer();

    if (!audioCtx)
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();

    try {
        const decoded = await audioCtx.decodeAudioData(arrayBuffer);

        audioBuffer = decoded;
        originalAudioBuffer = decoded;
        duration = decoded.duration;
        originalDuration = decoded.duration;

        startSec = 0;
        endSec = duration;

        startRange.max = duration;
        endRange.max = duration;
        startRange.value = 0;
        endRange.value = duration;

        info.innerHTML = "✅ Audio dimuat: " + file.name;

        updateTimeDisplays();
        drawWaveform();
    } catch (e) {
        info.innerHTML = "❌ Error memuat audio.";
    }
}

fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) loadFile(file);
});

// ==================== DRAG & DROP ====================
dropArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropArea.classList.add("border-blue-400", "bg-blue-50");
});

dropArea.addEventListener("dragleave", (e) => {
    dropArea.classList.remove("border-blue-400", "bg-blue-50");
});

dropArea.addEventListener("drop", (e) => {
    e.preventDefault();
    dropArea.classList.remove("border-blue-400", "bg-blue-50");

    const file = e.dataTransfer.files[0];
    if (file) loadFile(file);
});

// ==================== DRAW WAVEFORM ====================
function drawWaveform() {
    if (!audioBuffer) return;

    const width = canvas.width = canvas.clientWidth * devicePixelRatio;
    const height = canvas.height = 140 * devicePixelRatio;

    const data = audioBuffer.getChannelData(0);
    const step = Math.floor(data.length / width);
    const amp = height / 2;

    ctx2d.clearRect(0, 0, width, height);
    ctx2d.fillStyle = "#1e293b";
    ctx2d.fillRect(0, 0, width, height);

    ctx2d.strokeStyle = "#22d3ee";
    ctx2d.beginPath();

    for (let i = 0; i < width; i++) {
        let min = 1, max = -1;
        for (let j = 0; j < step; j++) {
            const sample = data[(i * step) + j];
            min = Math.min(min, sample);
            max = Math.max(max, sample);
        }

        ctx2d.moveTo(i, (1 + min) * amp);
        ctx2d.lineTo(i, (1 + max) * amp);
    }
    ctx2d.stroke();

    // highlight crop area
    const s = (startSec / duration) * width;
    const e = (endSec / duration) * width;
    ctx2d.fillStyle = "rgba(253, 230, 138, 0.35)";
    ctx2d.fillRect(s, 0, e - s, height);
}

// ==================== TIME FORMATTING ====================
function formatTime(seconds) {
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

function updateTimeDisplays() {
    startTime.textContent = formatTime(startSec);
    endTime.textContent = formatTime(endSec);
}

// ==================== RANGE INPUTS ====================
startRange.addEventListener("input", () => {
    startSec = Math.min(parseFloat(startRange.value), endSec - 0.01);
    updateTimeDisplays();
    drawWaveform();
});

endRange.addEventListener("input", () => {
    endSec = Math.max(parseFloat(endRange.value), startSec + 0.01);
    updateTimeDisplays();
    drawWaveform();
});

// ==================== PLAY PREVIEW ====================
function playPreview() {
    if (!audioBuffer) return;

    if (!audioCtx)
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();

    if (sourceNode) {
        try { sourceNode.stop(); } catch {}
        sourceNode.disconnect();
    }

    sourceNode = audioCtx.createBufferSource();
    sourceNode.buffer = audioBuffer;
    sourceNode.connect(audioCtx.destination);

    sourceNode.start(0, startSec, endSec - startSec);

    playBtn.innerHTML = "⏹ Stop";
    isPlaying = true;

    sourceNode.onended = () => {
        isPlaying = false;
        playBtn.innerHTML = "▶️ Play";
    };
}

function stopPreview() {
    if (sourceNode) {
        try { sourceNode.stop(); } catch {}
        sourceNode.disconnect();
    }

    playBtn.innerHTML = "▶️ Play";
    isPlaying = false;
}

playBtn.addEventListener("click", () => {
    if (isPlaying) stopPreview();
    else playPreview();
});

editBtn.addEventListener("click", trimAudio);
resetBtn.addEventListener("click", resetAudio);

// Handle form submission to use trimmed audio file
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (window.trimmedAudioFile) {
                const input = form.querySelector('input[name="audio_file"]');
                if (input) {
                    const dt = new DataTransfer();
                    dt.items.add(window.trimmedAudioFile);
                    input.files = dt.files;
                    window.trimmedAudioFile = null; // Clear after use
                }
            }
        });
    }
});

// ==================== POPUP FUNCTIONS ====================
function showSuccessPopup(message) {
    document.getElementById('success-message').textContent = message;
    document.getElementById('success-popup').classList.remove('hidden');
    document.getElementById('success-popup').classList.add('flex');
}

function closeSuccessPopup() {
    document.getElementById('success-popup').classList.add('hidden');
    document.getElementById('success-popup').classList.remove('flex');
}

function showEditPopup() {
    document.getElementById('edit-start-time').value = startSec.toFixed(2);
    document.getElementById('edit-end-time').value = endSec.toFixed(2);
    document.getElementById('edit-popup').classList.remove('hidden');
    document.getElementById('edit-popup').classList.add('flex');
}

function closeEditPopup() {
    document.getElementById('edit-popup').classList.add('hidden');
    document.getElementById('edit-popup').classList.remove('flex');
}

function applyEdit() {
    const newStart = parseFloat(document.getElementById('edit-start-time').value);
    const newEnd = parseFloat(document.getElementById('edit-end-time').value);

    if (isNaN(newStart) || isNaN(newEnd) || newStart < 0 || newEnd > duration || newStart >= newEnd) {
        alert("❌ Waktu tidak valid. Pastikan waktu mulai < akhir dan dalam rentang yang benar.");
        return;
    }

    startSec = newStart;
    endSec = newEnd;

    startRange.value = startSec;
    endRange.value = endSec;

    updateTimeDisplays();
    drawWaveform();

    closeEditPopup();
    showSuccessPopup("✅ Waktu pemotongan berhasil diperbarui!");
}

// ==================== TRIM AUDIO ====================
function trimAudio() {
    if (!audioBuffer) {
        showSuccessPopup("❌ Tidak ada audio yang dimuat. Silakan upload file audio terlebih dahulu.");
        return;
    }

    try {
        const sampleRate = audioBuffer.sampleRate;
        const start = Math.floor(startSec * sampleRate);
        const end = Math.floor(endSec * sampleRate);
        const length = end - start;

        if (length <= 0) {
            showSuccessPopup("❌ Durasi pemotongan tidak valid. Pastikan waktu akhir lebih besar dari waktu awal.");
            return;
        }

        if (startSec >= endSec) {
            showSuccessPopup("❌ Waktu mulai harus lebih kecil dari waktu akhir.");
            return;
        }

        const newBuffer = audioCtx.createBuffer(
            audioBuffer.numberOfChannels,
            length,
            sampleRate
        );

        for (let i = 0; i < audioBuffer.numberOfChannels; i++) {
            const channelData = audioBuffer.getChannelData(i).slice(start, end);
            newBuffer.copyToChannel(channelData, i);
        }

        const wav = bufferToWav(newBuffer);
        const blob = new Blob([wav], { type: "audio/wav" });

        // Create a File object from the blob with proper name
        const originalName = fileName.replace(/\.[^/.]+$/, ""); // Remove extension
        const trimmedFile = new File([blob], originalName + "_trimmed.wav", { type: "audio/wav" });

        // Store the trimmed file temporarily
        window.trimmedAudioFile = trimmedFile;

        // Set the trimmed file to the form input immediately
        const formInput = document.querySelector('input[name="audio_file"]');
        if (formInput) {
            // Clear any existing files first
            formInput.value = '';

            // Create a DataTransfer to set the file
            const dt = new DataTransfer();
            dt.items.add(trimmedFile);
            formInput.files = dt.files;

            // Trigger change event to update UI
            formInput.dispatchEvent(new Event('change', { bubbles: true }));

            console.log("Trimmed file set to form input successfully");
        }

        // Show success popup with details
        const originalDuration = duration.toFixed(2);
        const trimmedDuration = (endSec - startSec).toFixed(2);
        const fileSize = (trimmedFile.size / 1024 / 1024).toFixed(2); // Size in MB

        const message = `Audio berhasil dipotong!\n\nDetail Pemotongan:\n• Durasi asli: ${originalDuration} detik\n• Durasi terpotong: ${trimmedDuration} detik\n• Ukuran file: ${fileSize} MB\n\nFile sudah siap untuk disimpan. Klik tombol "Simpan Musik" atau "Update Musik" di form untuk menyimpan perubahan.`;

        showSuccessPopup(message);

        info.innerHTML = `✅ Audio berhasil dipotong (${trimmedDuration} detik) dan siap disimpan!`;
        console.log("Audio trimmed successfully:", trimmedFile);
    } catch (error) {
        console.error("Error trimming audio:", error);
        showSuccessPopup("❌ Terjadi kesalahan saat memotong audio: " + error.message + "\n\nSilakan coba lagi atau hubungi administrator.");
    }
}

// ==================== UPDATE MUSIC ====================
function updateMusic() {
    if (!window.trimmedAudioFile) {
        showSuccessPopup("❌ Tidak ada audio yang sudah dipotong. Silakan potong audio terlebih dahulu.");
        return;
    }

    // Set the file to the form input
    const formInput = document.querySelector('input[name="audio_file"]');
    if (formInput) {
        // Clear any existing files first
        formInput.value = '';

        // Create a DataTransfer to set the file
        const dt = new DataTransfer();
        dt.items.add(window.trimmedAudioFile);
        formInput.files = dt.files;

        // Verify the file was set correctly
        if (formInput.files.length > 0 && formInput.files[0].size > 0) {
            // Trigger change event to update UI
            formInput.dispatchEvent(new Event('change', { bubbles: true }));

            // Clear the temporary file
            window.trimmedAudioFile = null;

            showSuccessPopup("✅ Audio berhasil diperbarui! File sudah siap untuk disimpan.");

            info.innerHTML = `✅ Audio berhasil diperbarui dan siap disimpan!`;
            console.log("Audio updated successfully");
        } else {
            showSuccessPopup("❌ Gagal menyimpan file terpotong. Silakan coba lagi.");
        }
    } else {
        showSuccessPopup("❌ Input form tidak ditemukan. Pastikan Anda berada di halaman yang benar.");
    }
}

// ==================== UPDATE MUSIC AND CLOSE ====================
function updateMusicAndClose() {
    updateMusic();
    closeSuccessPopup();
}

// ==================== RESET AUDIO ====================
function resetAudio() {
    if (!originalAudioBuffer) {
        showSuccessPopup("❌ Tidak ada audio asli yang tersimpan.");
        return;
    }

    // Kembalikan buffer ke versi asli
    audioBuffer = originalAudioBuffer;
    duration = originalDuration;

    // Reset range
    startSec = 0;
    endSec = duration;

    startRange.max = duration;
    endRange.max = duration;

    startRange.value = 0;
    endRange.value = duration;

    updateTimeDisplays();
    drawWaveform();

    // Hapus hasil trim sebelumnya
    window.trimmedAudioFile = null;

    showSuccessPopup("🔄 Audio berhasil dikembalikan ke versi asli!");
}


// ==================== WAVEFORM DRAGGING ====================
let dragStart = false;
let dragEnd = false;

canvas.addEventListener("mousedown", (e) => {
    if (!audioBuffer) return;

    const rect = canvas.getBoundingClientRect();
    const clickX = (e.clientX - rect.left) / rect.width * duration;

    const startPos = startSec;
    const endPos = endSec;

    const tolerance = duration * 0.02; // toleransi 2% durasi

    // Drag Start
    if (Math.abs(clickX - startPos) < tolerance) {
        dragStart = true;
        return;
    }

    // Drag End
    if (Math.abs(clickX - endPos) < tolerance) {
        dragEnd = true;
        return;
    }

    // 🔥 DRAG SEMUA BLOK KUNING
    if (clickX > startPos && clickX < endPos) {
        dragMove = true;
        dragOffset = clickX - startSec;
    }
});


canvas.addEventListener("mousemove", (e) => {
    if (!audioBuffer) return;

    const rect = canvas.getBoundingClientRect();
    const x = (e.clientX - rect.left) / rect.width * duration;

    if (dragStart) {
        startSec = Math.max(0, Math.min(x, endSec - 0.01));
    } 
    else if (dragEnd) {
        endSec = Math.min(duration, Math.max(x, startSec + 0.01));
    } 
    else if (dragMove) {
        let newStart = x - dragOffset;
        let newEnd = newStart + (endSec - startSec);

        // Cegah keluar batas
        if (newStart < 0) {
            newStart = 0;
            newEnd = newStart + (endSec - startSec);
        }
        if (newEnd > duration) {
            newEnd = duration;
            newStart = newEnd - (endSec - startSec);
        }

        startSec = newStart;
        endSec = newEnd;
    }

    startRange.value = startSec;
    endRange.value = endSec;

    updateTimeDisplays();
    drawWaveform();
});


canvas.addEventListener("mouseup", () => {
    dragStart = false;
    dragEnd = false;
    dragMove = false;
});

canvas.addEventListener("mouseleave", () => {
    dragStart = false;
    dragEnd = false;
    dragMove = false;
});


// Add global mouseup to ensure dragging stops even if mouse leaves canvas
document.addEventListener("mouseup", () => {
    dragStart = false;
    dragEnd = false;
});

// ==================== EXPORT WAV ====================
function exportWav() {
    if (!audioBuffer) {
        showSuccessPopup("❌ Tidak ada audio yang dimuat. Silakan upload file audio terlebih dahulu.");
        return;
    }

    try {
        const sampleRate = audioBuffer.sampleRate;
        const start = Math.floor(startSec * sampleRate);
        const end = Math.floor(endSec * sampleRate);
        const length = end - start;

        if (length <= 0) {
            showSuccessPopup("❌ Durasi pemotongan tidak valid. Pastikan waktu akhir lebih besar dari waktu awal.");
            return;
        }

        if (startSec >= endSec) {
            showSuccessPopup("❌ Waktu mulai harus lebih kecil dari waktu akhir.");
            return;
        }

        const newBuffer = audioCtx.createBuffer(
            audioBuffer.numberOfChannels,
            length,
            sampleRate
        );

        for (let i = 0; i < audioBuffer.numberOfChannels; i++) {
            const channelData = audioBuffer.getChannelData(i).slice(start, end);
            newBuffer.copyToChannel(channelData, i);
        }

        const wav = bufferToWav(newBuffer);
        const blob = new Blob([wav], { type: "audio/wav" });

        // Create a File object from the blob with proper name
        const originalName = fileName.replace(/\.[^/.]+$/, ""); // Remove extension
        const trimmedFile = new File([blob], originalName + "_trimmed.wav", { type: "audio/wav" });

        // Set the file to the form input
        const formInput = document.querySelector('input[name="audio_file"]');
        if (formInput) {
            // Clear any existing files first
            formInput.value = '';

            // Create a DataTransfer to set the file
            const dt = new DataTransfer();
            dt.items.add(trimmedFile);
            formInput.files = dt.files;

            // Verify the file was set correctly
            if (formInput.files.length > 0 && formInput.files[0].size > 0) {
                // Trigger change event to update UI
                formInput.dispatchEvent(new Event('change', { bubbles: true }));

                // Show success popup with details
                const originalDuration = duration.toFixed(2);
                const trimmedDuration = (endSec - startSec).toFixed(2);
                const fileSize = (trimmedFile.size / 1024 / 1024).toFixed(2); // Size in MB

                const message = `Audio berhasil dipotong!\n\nDetail Pemotongan:\n• Durasi asli: ${originalDuration} detik\n• Durasi terpotong: ${trimmedDuration} detik\n• Ukuran file: ${fileSize} MB\n\nKlik "Simpan" untuk menyimpan audio yang sudah dipotong.`;

                showSuccessPopup(message);

                info.innerHTML = `✅ Audio berhasil dipotong (${trimmedDuration} detik) dan siap disimpan!`;
                console.log("Audio trimmed successfully:", trimmedFile);
            } else {
                showSuccessPopup("❌ Gagal menyimpan file terpotong. Silakan coba lagi.");
            }
        } else {
            showSuccessPopup("❌ Input form tidak ditemukan. Pastikan Anda berada di halaman yang benar.");
        }
    } catch (error) {
        console.error("Error trimming audio:", error);
        showSuccessPopup("❌ Terjadi kesalahan saat memotong audio: " + error.message + "\n\nSilakan coba lagi atau hubungi administrator.");
    }
}

function bufferToWav(buffer) {
    const numChannels = buffer.numberOfChannels;
    const length = buffer.length * numChannels * 2 + 44;
    const out = new ArrayBuffer(length);
    const view = new DataView(out);

    let pos = 0;

    function writeUint32(data) {
        view.setUint32(pos, data, true); pos += 4;
    }
    function writeUint16(data) {
        view.setUint16(pos, data, true); pos += 2;
    }

    writeUint32(0x46464952);
    writeUint32(length - 8);
    writeUint32(0x45564157);

    writeUint32(0x20746d66);
    writeUint32(16);
    writeUint16(1);
    writeUint16(numChannels);
    writeUint32(buffer.sampleRate);
    writeUint32(buffer.sampleRate * 2 * numChannels);
    writeUint16(numChannels * 2);
    writeUint16(16);

    writeUint32(0x61746164);
    writeUint32(length - pos - 4);

    const channels = [];
    for (let i = 0; i < numChannels; i++)
        channels.push(buffer.getChannelData(i));

    for (let i = 0; i < buffer.length; i++) {
        for (let ch = 0; ch < numChannels; ch++) {
            let sample = Math.max(-1, Math.min(1, channels[ch][i]));
            view.setInt16(pos, sample < 0 ? sample * 0x8000 : sample * 0x7FFF, true);
            pos += 2;
        }
    }

    return out;
}

</script>
