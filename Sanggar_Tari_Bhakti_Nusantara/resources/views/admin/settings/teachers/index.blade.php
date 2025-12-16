@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- Main Content -->
        <main class="flex-1 lg:ml-0 p-6 lg:p-10">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-[#2E2E2E] mb-2">Tim Pengajar</h1>
                        <p class="text-[#4F4F4F]">Kelola data instruktur dan pengajar sanggar</p>
                    </div>
                    <a href="{{ route('admin.teachers.create') }}" class="px-6 py-3 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-xl hover:shadow-lg transition-all duration-300 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Pengajar
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <div id="data-content">
                    @include('admin.settings.teachers._grid', ['teachers' => $teachers])
                </div>
                <div id="pagination-container" class="mt-6">
                    @include('components.pagination', ['paginator' => $teachers])
                </div>
                @include('components.ajax-pagination-script')
                
                <div class="mt-6 bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-[#E6D8A1]/40 p-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="flex items-center gap-2">
                            <button id="btn-move-up" class="px-4 py-2 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-xl hover:shadow-lg text-sm transition-all duration-300" aria-label="Pindah ke atas">Move Up</button>
                            <button id="btn-move-down" class="px-4 py-2 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-xl hover:shadow-lg text-sm transition-all duration-300" aria-label="Pindah ke bawah">Move Down</button>
                        </div>
                        <button id="btn-load-all" class="px-4 py-2 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-xl hover:shadow-lg text-sm transition-all duration-300">Reorder Semua</button>
                        <div class="flex items-center gap-2">
                            <label class="text-sm text-gray-700">Posisi:</label>
                            <input id="target-position" type="number" min="0" class="w-24 px-3 py-2 border rounded-lg text-sm" placeholder="0">
                            <button id="btn-move-to" class="px-4 py-2 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-xl hover:shadow-lg text-sm transition-all duration-300">Pindah</button>
                        </div>
                        <div class="flex items-center gap-2">
                            <label class="text-sm text-gray-700">Sort:</label>
                            <select id="sort-select" class="px-3 py-2 border rounded-lg text-sm">
                                <option value="">Default</option>
                                <option value="name-asc">Nama A→Z</option>
                                <option value="name-desc">Nama Z→A</option>
                                <option value="created-asc">Tanggal Lama→Baru</option>
                                <option value="created-desc">Tanggal Baru→Lama</option>
                            </select>
                        </div>
                        <div class="ml-auto flex items-center gap-2">
                            <button id="btn-undo" class="px-3 py-2 bg-yellow-200 rounded-lg hover:bg-yellow-300 text-sm">Undo</button>
                            <button id="btn-redo" class="px-3 py-2 bg-yellow-200 rounded-lg hover:bg-yellow-300 text-sm">Redo</button>
                            <button id="btn-save" class="px-4 py-2 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-lg hover:shadow-lg text-sm">Simpan Urutan</button>
                        </div>
                    </div>
                    <p id="reorder-feedback" class="mt-3 text-sm" aria-live="polite"></p>
                </div>
                <!-- Modal Konfirmasi Status -->
                <div id="status-modal" class="fixed inset-0 z-50 hidden">
                    <div class="absolute inset-0 bg-black/40"></div>
                    <div class="relative max-w-md mx-auto mt-32 bg-white rounded-xl shadow-xl p-6">
                        <p id="modal-text" class="text-[#2E2E2E] text-sm mb-4">Anda yakin ingin mengubah status pengajar ini?</p>
                        <div class="flex items-center gap-3">
                            <button id="modal-confirm" class="px-5 py-2.5 text-black font-semibold rounded-xl shadow-lg ring-2 ring-[#E6D8A1]/60 transition-all duration-300">Konfirmasi</button>
                            <button id="modal-cancel" class="px-5 py-2.5 bg-gray-300 text-[#2E2E2E] font-semibold rounded-xl shadow hover:brightness-105 transition-all duration-300">Batal</button>
                            <div id="modal-spinner" class="ml-auto hidden">
                                <div class="w-5 h-5 border-2 border-[#FEDA60] border-t-transparent rounded-full animate-spin"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    let grid = document.getElementById('teacher-grid');
                    const csrfToken = '{{ csrf_token() }}';
                    let historyStack = [];
                    let redoStack = [];
                    let statusTarget = null;
                    
                    function currentSequence() {
                        return Array.from(grid.children).map(el => el.dataset.id);
                    }
                    function pushHistory() {
                        historyStack.push(currentSequence());
                        if (historyStack.length > 100) historyStack.shift();
                        redoStack = [];
                    }
                    function applySequence(seq) {
                        const map = {};
                        Array.from(grid.children).forEach(el => map[el.dataset.id] = el);
                        seq.forEach(id => grid.appendChild(map[id]));
                    }
                    function computeOrders() {
                        return Array.from(grid.children).map((el, idx) => ({ id: parseInt(el.dataset.id), order: idx }));
                    }
                    function setFeedback(msg, ok=true) {
                        const fb = document.getElementById('reorder-feedback');
                        fb.textContent = msg;
                        fb.className = 'mt-3 text-sm ' + (ok ? 'text-green-600' : 'text-red-600');
                    }
                    function selectedEls() {
                        return Array.from(grid.children).filter(el => el.querySelector('.select-item')?.checked);
                    }
                    function moveSelected(delta) {
                        const items = Array.from(grid.children);
                        const selectedIds = new Set(selectedEls().map(el => el.dataset.id));
                        let seq = items.map(el => el.dataset.id);
                        const indexes = seq.map((id, idx) => selectedIds.has(id) ? idx : -1).filter(i => i >= 0);
                        if (!indexes.length) { setFeedback('Pilih item terlebih dahulu', false); return; }
                        // Edge cases
                        if (delta < 0 && indexes.some(i => i === 0)) { setFeedback('Item teratas tidak bisa dipindah ke atas', false); return; }
                        if (delta > 0 && indexes.some(i => i === seq.length - 1)) { setFeedback('Item terbawah tidak bisa dipindah ke bawah', false); return; }
                        pushHistory();
                        if (delta < 0) {
                            indexes.forEach(i => {
                                if (i + delta >= 0) {
                                    const id = seq.splice(i,1)[0];
                                    seq.splice(i+delta,0,id);
                                }
                            });
                        } else {
                            indexes.reverse().forEach(i => {
                                if (i + delta < seq.length) {
                                    const id = seq.splice(i,1)[0];
                                    seq.splice(i+delta,0,id);
                                }
                            });
                        }
                        applySequence(seq);
                        // Visual feedback animation
                        selectedEls().forEach(el => {
                            el.classList.add('transition-transform','duration-300');
                            el.style.transform = 'scale(1.02)';
                            setTimeout(() => { el.style.transform = ''; }, 300);
                        });
                        updateMoveButtons();
                    }
                    function moveSelectedToPosition(pos) {
                        const items = Array.from(grid.children);
                        const selected = selectedEls();
                        if (!selected.length) return;
                        const seq = items.map(el => el.dataset.id);
                        const selectedIds = selected.map(el => el.dataset.id);
                        pushHistory();
                        // Remove selected from sequence
                        selectedIds.forEach(id => {
                            const idx = seq.indexOf(id);
                            if (idx >= 0) seq.splice(idx, 1);
                        });
                        // Clamp position
                        const target = Math.max(0, Math.min(pos, seq.length));
                        // Insert block at target preserving relative order
                        seq.splice(target, 0, ...selectedIds);
                        applySequence(seq);
                    }
                    function sortBy(key, dir='asc') {
                        pushHistory();
                        const items = Array.from(grid.children);
                        items.sort((a,b) => {
                            let va = a.dataset[key] ?? '';
                            let vb = b.dataset[key] ?? '';
                            if (key === 'created') {
                                va = new Date(va).getTime() || 0;
                                vb = new Date(vb).getTime() || 0;
                            } else {
                                va = va.toLowerCase();
                                vb = vb.toLowerCase();
                            }
                            return dir === 'asc' ? (va>vb?1:(va<vb?-1:0)) : (va>vb?-1:(va<vb?1:0));
                        });
                        items.forEach(el => grid.appendChild(el));
                    }
                    function enableDnD() {
                        let dragged = null;
                        Array.from(grid.children).forEach(el => {
                            el.addEventListener('dragstart', e => {
                                dragged = el;
                                e.dataTransfer.effectAllowed = 'move';
                                el.classList.add('ring-2','ring-[#F5B347]');
                                pushHistory();
                            });
                            el.addEventListener('dragover', e => {
                                e.preventDefault();
                                e.dataTransfer.dropEffect = 'move';
                                el.classList.add('bg-[#FFF9E5]');
                            });
                            el.addEventListener('dragleave', () => {
                                el.classList.remove('bg-[#FFF9E5]');
                            });
                            el.addEventListener('drop', e => {
                                e.preventDefault();
                                el.classList.remove('bg-[#FFF9E5]');
                                if (dragged && dragged !== el) {
                                    const children = Array.from(grid.children);
                                    const from = children.indexOf(dragged);
                                    const to = children.indexOf(el);
                                    if (from < to) {
                                        grid.insertBefore(dragged, el.nextSibling);
                                    } else {
                                        grid.insertBefore(dragged, el);
                                    }
                                }
                                if (dragged) dragged.classList.remove('ring-2','ring-[#F5B347]');
                                dragged = null;
                            });
                        });
                    }
                    function moveOneById(id, delta) {
                        const items = Array.from(grid.children);
                        const seq = items.map(el => el.dataset.id);
                        const idx = seq.indexOf(String(id));
                        if (idx === -1) return;
                        if (delta < 0 && idx === 0) { setFeedback('Item teratas tidak bisa dipindah ke atas', false); return; }
                        if (delta > 0 && idx === seq.length - 1) { setFeedback('Item terbawah tidak bisa dipindah ke bawah', false); return; }
                        pushHistory();
                        const idStr = seq.splice(idx,1)[0];
                        seq.splice(idx+delta,0,idStr);
                        applySequence(seq);
                        const el = Array.from(grid.children).find(child => child.dataset.id === String(id));
                        if (el) {
                            el.classList.add('transition-transform','duration-300');
                            el.style.transform = 'scale(1.02)';
                            setTimeout(() => { el.style.transform = ''; }, 300);
                        }
                    }
                    function bindPerItemMove() {
                        document.querySelectorAll('.btn-item-up').forEach(btn => {
                            btn.addEventListener('click', () => moveOneById(btn.dataset.id, -1));
                        });
                        document.querySelectorAll('.btn-item-down').forEach(btn => {
                            btn.addEventListener('click', () => moveOneById(btn.dataset.id, 1));
                        });
                    }
                    function saveOrders() {
                        const payload = computeOrders();
                        fetch('{{ route('admin.teachers.reorder') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ orders: payload })
                        }).then(r => r.json()).then(res => {
                            if (res.success) setFeedback('Urutan berhasil disimpan', true);
                            else setFeedback(res.message || 'Gagal menyimpan urutan', false);
                        }).catch(() => setFeedback('Terjadi kesalahan jaringan', false));
                    }
                    function loadAll() {
                        const contentContainer = document.getElementById('data-content');
                        const url = `${window.location.href.split('?')[0]}?reorder=1`;
                        contentContainer.style.opacity = '0.5';
                        fetch(url, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                        }).then(r => r.json()).then(data => {
                            contentContainer.innerHTML = data.html;
                            contentContainer.style.opacity = '1';
                            grid = document.getElementById('teacher-grid');
                            enableDnD();
                            bindStatusButtons();
                            setFeedback('Mode reorder semua aktif', true);
                        }).catch(() => {
                            contentContainer.style.opacity = '1';
                            setFeedback('Gagal memuat semua item', false);
                        });
                    }
                    document.getElementById('btn-move-up').addEventListener('click', () => moveSelected(-1));
                    document.getElementById('btn-move-down').addEventListener('click', () => moveSelected(1));
                    document.getElementById('btn-move-to').addEventListener('click', () => {
                        const pos = parseInt(document.getElementById('target-position').value || '0', 10);
                        moveSelectedToPosition(pos);
                    });
                    document.getElementById('btn-load-all').addEventListener('click', loadAll);
                    document.getElementById('sort-select').addEventListener('change', (e) => {
                        const val = e.target.value;
                        if (!val) return;
                        const [key, dir] = val.split('-');
                        sortBy(key, dir);
                    });
                    document.getElementById('btn-save').addEventListener('click', saveOrders);
                    // Keyboard navigation
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'ArrowUp') { e.preventDefault(); moveSelected(-1); }
                        if (e.key === 'ArrowDown') { e.preventDefault(); moveSelected(1); }
                    });
                    function updateMoveButtons() {
                        const items = Array.from(grid.children);
                        const seq = items.map(el => el.dataset.id);
                        const indexes = seq.map((id, idx) => selectedEls().some(el => el.dataset.id === id) ? idx : -1).filter(i => i>=0);
                        const up = document.getElementById('btn-move-up');
                        const down = document.getElementById('btn-move-down');
                        const atTop = indexes.some(i => i === 0);
                        const atBottom = indexes.some(i => i === seq.length - 1);
                        up.disabled = atTop;
                        down.disabled = atBottom;
                        up.classList.toggle('opacity-50', atTop);
                        up.classList.toggle('cursor-not-allowed', atTop);
                        down.classList.toggle('opacity-50', atBottom);
                        down.classList.toggle('cursor-not-allowed', atBottom);
                    }
                    updateMoveButtons();
                    document.getElementById('btn-undo').addEventListener('click', () => {
                        if (!historyStack.length) return;
                        const prev = historyStack.pop();
                        redoStack.push(currentSequence());
                        applySequence(prev);
                    });
                    document.getElementById('btn-redo').addEventListener('click', () => {
                        if (!redoStack.length) return;
                        const next = redoStack.pop();
                        historyStack.push(currentSequence());
                        applySequence(next);
                    });
                    enableDnD();
                    document.addEventListener('ajaxPaginationLoaded', () => {
                        grid = document.getElementById('teacher-grid');
                        enableDnD();
                        bindStatusButtons();
                    });
                    function openStatusModal(targetEl) {
                        statusTarget = targetEl;
                        const confirmBtn = document.getElementById('modal-confirm');
                        const modalText = document.getElementById('modal-text');
                        const active = parseInt(targetEl.dataset.active || '0', 10);
                        const nextIsActivate = active === 0;
                        confirmBtn.classList.remove('bg-[#4CAF50]','bg-[#F44336]');
                        confirmBtn.classList.add(nextIsActivate ? 'bg-[#4CAF50]' : 'bg-[#F44336]');
                        confirmBtn.textContent = nextIsActivate ? 'Aktifkan' : 'Nonaktifkan';
                        modalText.textContent = nextIsActivate 
                            ? 'Anda yakin ingin mengaktifkan pengajar ini?' 
                            : 'Anda yakin ingin menonaktifkan pengajar ini?';
                        document.getElementById('status-modal').classList.remove('hidden');
                    }
                    function closeStatusModal() {
                        document.getElementById('status-modal').classList.add('hidden');
                        statusTarget = null;
                        document.getElementById('modal-spinner').classList.add('hidden');
                    }
                    function bindStatusButtons() {
                        document.querySelectorAll('.status-toggle').forEach(btn => {
                            btn.addEventListener('click', () => openStatusModal(btn));
                        });
                    }
                    bindStatusButtons();
                    document.getElementById('modal-cancel').addEventListener('click', closeStatusModal);
                    document.getElementById('modal-confirm').addEventListener('click', () => {
                        if (!statusTarget) return;
                        const id = statusTarget.dataset.id;
                        const active = parseInt(statusTarget.dataset.active || '0', 10);
                        const newStatus = active ? 0 : 1;
                        document.getElementById('modal-spinner').classList.remove('hidden');
                        fetch('{{ route('admin.teachers.status', ['teacher' => 'ID_REPLACE']) }}'.replace('ID_REPLACE', id), {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ status: newStatus })
                        }).then(r => r.json()).then(res => {
                            document.getElementById('modal-spinner').classList.add('hidden');
                            if (res.success) {
                                setFeedback('Status pengajar berhasil diperbarui', true);
                                // Update button appearance and badge
                                statusTarget.dataset.active = String(newStatus);
                                if (newStatus === 1) {
                                    statusTarget.classList.remove('bg-[#4CAF50]');
                                    statusTarget.classList.add('bg-[#F44336]');
                                    statusTarget.querySelector('span span')?.remove();
                                    statusTarget.querySelector('span').insertAdjacentHTML('beforeend', '<span class="text-sm md:text-xs">Nonaktifkan</span>');
                                    const badge = statusTarget.closest('.p-6')?.querySelector('.text-xs.px-2.py-1.rounded');
                                    if (badge) { badge.textContent = 'Aktif'; badge.className = 'text-xs px-2 py-1 rounded bg-[#FFF6D5] text-[#8C6A08]'; }
                                } else {
                                    statusTarget.classList.remove('bg-[#F44336]');
                                    statusTarget.classList.add('bg-[#4CAF50]');
                                    statusTarget.querySelector('span span')?.remove();
                                    statusTarget.querySelector('span').insertAdjacentHTML('beforeend', '<span class="text-sm md:text-xs">Aktifkan</span>');
                                    const badge = statusTarget.closest('.p-6')?.querySelector('.text-xs.px-2.py-1.rounded');
                                    if (badge) { badge.textContent = 'Nonaktif'; badge.className = 'text-xs px-2 py-1 rounded bg-gray-200 text-gray-600'; }
                                }
                                closeStatusModal();
                            } else {
                                setFeedback(res.message || 'Gagal memperbarui status', false);
                            }
                        }).catch(() => {
                            document.getElementById('modal-spinner').classList.add('hidden');
                            setFeedback('Terjadi kesalahan jaringan', false);
                        });
                    });
                </script>
            </div>
        </main>
    </div>
</div>
@endsection
