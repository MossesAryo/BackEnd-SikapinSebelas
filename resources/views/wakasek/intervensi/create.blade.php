<div id="modal-create"
    class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl mx-4 flex flex-col max-h-[90vh]">

        {{-- Header --}}
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 sticky top-0 bg-white z-10 rounded-t-xl">
            <h2 class="text-lg font-semibold text-gray-800">Tambah Penanganan</h2>
            <button type="button" onclick="closeModal('modal-create')"
                class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:text-gray-600 hover:bg-gray-50 text-xl leading-none">&times;</button>
        </div>

        <form action="{{ route('intervensi.store') }}" method="POST" enctype="multipart/form-data"
            id="form-create" class="overflow-y-auto">
            @csrf
            <div class="px-6 py-5 space-y-4">

                {{-- Pilih Siswa --}}
                <div>
                    <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">Pilih Siswa</label>
                    <select id="nis" name="nis" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Siswa</option>
                        @foreach ($siswa as $item)
                            <option value="{{ $item->nis }}">{{ $item->nama_siswa }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Nama Penanganan --}}
                <div>
                    <label for="nama_intervensi" class="block text-sm font-medium text-gray-700 mb-1">Nama Penanganan</label>
                    <input type="text" id="nama_intervensi" name="nama_intervensi" required
                        placeholder="Contoh: Penindak Lanjutan Kehadiran Siswa"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                {{-- Isi Penanganan --}}
                <div>
                    <label for="isi_intervensi" class="block text-sm font-medium text-gray-700 mb-1">Isi Penanganan</label>
                    <textarea id="isi_intervensi" name="isi_intervensi" rows="3" required
                        placeholder="Contoh: Memberikan bimbingan khusus kepada siswa yang sering absen..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y"></textarea>
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Binaan Khusus">Binaan Khusus</option>
                        <option value="Dalam Binaan">Dalam Binaan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                {{-- Tanggal --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="tanggal_Mulai_Perbaikan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" id="tanggal_Mulai_Perbaikan" name="tanggal_Mulai_Perbaikan" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="tanggal_Selesai_Perbaikan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                        <input type="date" id="tanggal_Selesai_Perbaikan" name="tanggal_Selesai_Perbaikan" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                {{-- File Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Bukti Pendukung
                        <span class="font-normal text-gray-400">(Opsional — JPG, PNG, PDF, maks 5 MB/file)</span>
                    </label>

                    {{-- Drop Zone --}}
                    <div id="drop-zone"
                        class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer
                               hover:border-blue-400 hover:bg-blue-50 transition-all duration-150"
                        onclick="document.getElementById('file-input').click()"
                        ondragover="event.preventDefault(); this.classList.add('border-blue-400','bg-blue-50');"
                        ondragleave="this.classList.remove('border-blue-400','bg-blue-50');"
                        ondrop="handleFileDrop(event)">

                        <input type="file" id="file-input" name="file[]" multiple
                            accept=".jpg,.jpeg,.png,.pdf" class="hidden">

                        <svg class="mx-auto w-9 h-9 text-gray-300 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                        </svg>
                        <p class="text-sm font-medium text-gray-600">Seret &amp; lepas file di sini</p>
                        <p class="text-xs text-gray-400 mt-1">atau</p>
                        <span class="mt-2 inline-block px-3 py-1.5 text-xs font-medium border border-gray-300 rounded-lg text-gray-500 bg-white">
                            Pilih File
                        </span>
                    </div>

                    {{-- Preview Grid --}}
                    <div id="preview-area" class="hidden mt-3">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">File dipilih</p>
                            <span id="file-count-badge"
                                class="text-xs font-medium text-blue-600 bg-blue-50 rounded-full px-2.5 py-0.5">0 file</span>
                        </div>
                        <div id="preview-grid" class="grid grid-cols-3 sm:grid-cols-4 gap-2"></div>

                        {{-- Size progress bar --}}
                        <div class="mt-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs text-gray-400">Total ukuran</span>
                                <span id="total-size-label" class="text-xs text-gray-500">0 KB</span>
                            </div>
                            <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div id="size-progress-bar"
                                    class="h-full rounded-full bg-blue-500 transition-all duration-300"
                                    style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-2 px-6 py-4 border-t border-gray-200 sticky bottom-0 bg-white rounded-b-xl">
                <button type="button" onclick="closeModal('modal-create')"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-600 hover:bg-gray-50">Batal</button>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-sm text-white font-medium hover:bg-blue-700 transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- File Preview Modal (Lightbox) --}}
<div id="file-preview-modal"
    class="fixed inset-0 bg-black bg-opacity-80 z-[60] hidden items-center justify-center"
    onclick="closeFilePreview(event)">
    <div class="relative max-w-3xl max-h-[85vh] w-full mx-4 flex items-center justify-center">
        <button onclick="closeFilePreviewDirect()"
            class="absolute -top-10 right-0 text-white text-sm hover:text-gray-300 flex items-center gap-1">
            <span>Tutup</span>
            <span class="text-lg leading-none">&times;</span>
        </button>
        <img id="preview-modal-img" src="" alt=""
            class="max-w-full max-h-[80vh] rounded-lg object-contain hidden shadow-2xl">
        <div id="preview-modal-pdf"
            class="hidden bg-white rounded-xl p-8 text-center shadow-2xl">
            <svg class="w-16 h-16 text-red-400 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <p id="preview-modal-pdf-name" class="text-gray-700 font-medium text-sm mb-1"></p>
            <p id="preview-modal-pdf-size" class="text-gray-400 text-xs"></p>
        </div>
    </div>
</div>

{{-- Tom Select --}}
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

<script>
document.addEventListener('DOMContentLoaded', function () {

    new TomSelect('#nis', {
        create: false,
        sortField: { field: 'text', direction: 'asc' }
    });

    const dropZone        = document.getElementById('drop-zone');
    const fileInput       = document.getElementById('file-input');
    const previewArea     = document.getElementById('preview-area');
    const previewGrid     = document.getElementById('preview-grid');
    const countBadge      = document.getElementById('file-count-badge');
    const sizeProgressBar = document.getElementById('size-progress-bar');
    const totalSizeLabel  = document.getElementById('total-size-label');

    let uploadedFiles = [];

    const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'application/pdf'];
    const MAX_SIZE_PER_FILE = 5 * 1024 * 1024; // 5 MB per file

    // ── Drag events ──────────────────────────────────────────
    fileInput.addEventListener('change', () => {
        addFiles(Array.from(fileInput.files));
        fileInput.value = '';
    });

    function addFiles(newFiles) {
        newFiles.forEach(file => {
            if (!ALLOWED_TYPES.includes(file.type)) {
                showToast(`"${file.name}" — tipe file tidak didukung.`, 'error');
                return;
            }
            if (file.size > MAX_SIZE_PER_FILE) {
                showToast(`"${file.name}" melebihi batas 5 MB.`, 'error');
                return;
            }
            const isDuplicate = uploadedFiles.some(f => f.name === file.name && f.size === file.size);
            if (!isDuplicate) uploadedFiles.push(file);
        });
        syncFileInput();
        renderPreviews();
    }

    // Expose to inline ondrop handler
    window.handleFileDrop = function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-blue-400', 'bg-blue-50');
        addFiles(Array.from(e.dataTransfer.files));
    };

    function removeFile(index) {
        const f = uploadedFiles[index];
        if (f._previewUrl) URL.revokeObjectURL(f._previewUrl);
        uploadedFiles.splice(index, 1);
        syncFileInput();
        renderPreviews();
    }

    function syncFileInput() {
        const dt = new DataTransfer();
        uploadedFiles.forEach(f => dt.items.add(f));
        fileInput.files = dt.files;
    }

    function formatSize(bytes) {
        if (bytes < 1024)        return bytes + ' B';
        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
    }

    function renderPreviews() {
        previewGrid.innerHTML = '';

        if (uploadedFiles.length === 0) {
            previewArea.classList.add('hidden');
            return;
        }

        previewArea.classList.remove('hidden');
        countBadge.textContent = uploadedFiles.length + (uploadedFiles.length === 1 ? ' file' : ' file');

        // Update total size progress bar (max reference: 5MB × file count)
        const totalBytes = uploadedFiles.reduce((acc, f) => acc + f.size, 0);
        const maxBytes   = MAX_SIZE_PER_FILE * uploadedFiles.length;
        const pct        = Math.min(100, Math.round((totalBytes / maxBytes) * 100));
        sizeProgressBar.style.width = pct + '%';
        sizeProgressBar.className = 'h-full rounded-full transition-all duration-300 '
            + (pct > 80 ? 'bg-red-400' : pct > 50 ? 'bg-yellow-400' : 'bg-blue-500');
        totalSizeLabel.textContent = formatSize(totalBytes);

        uploadedFiles.forEach((file, index) => {
            const isImage = file.type.startsWith('image/');
            const item    = document.createElement('div');
            item.className = 'relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-50 aspect-square cursor-pointer';

            if (isImage) {
                const url = file._previewUrl || (file._previewUrl = URL.createObjectURL(file));
                item.innerHTML = `
                    <img src="${url}" alt="${file.name}"
                        class="w-full h-full object-cover block transition-transform duration-200 group-hover:scale-105">
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent px-2 pb-2 pt-5">
                        <p class="text-white text-[9px] truncate leading-tight">${file.name}</p>
                        <p class="text-white/70 text-[9px]">${formatSize(file.size)}</p>
                    </div>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-150 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-150 drop-shadow-lg"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </div>`;
                // Click to preview
                item.addEventListener('click', (e) => {
                    if (e.target.closest('button')) return;
                    openFilePreview(file, 'image');
                });
            } else {
                item.innerHTML = `
                    <div class="w-full h-full flex flex-col items-center justify-center gap-1 p-2">
                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center mb-1">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                        </div>
                        <p class="text-[10px] text-gray-600 text-center break-all leading-tight line-clamp-2 px-1">${file.name}</p>
                        <p class="text-[9px] text-gray-400">${formatSize(file.size)}</p>
                    </div>
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-150 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-500 opacity-0 group-hover:opacity-100 transition-opacity duration-150"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>`;
                item.addEventListener('click', (e) => {
                    if (e.target.closest('button')) return;
                    openFilePreview(file, 'pdf');
                });
            }

            // Remove button
            const removeBtn = document.createElement('button');
            removeBtn.type      = 'button';
            removeBtn.title     = 'Hapus file';
            removeBtn.className = 'absolute top-1.5 right-1.5 w-5 h-5 rounded-full bg-black/50 hover:bg-red-500 '
                + 'flex items-center justify-center text-white text-[10px] opacity-0 group-hover:opacity-100 '
                + 'transition-all z-10';
            removeBtn.innerHTML = '&#x2715;';
            removeBtn.addEventListener('click', e => { e.stopPropagation(); removeFile(index); });

            item.appendChild(removeBtn);
            previewGrid.appendChild(item);
        });
    }

    // ── File preview lightbox ─────────────────────────────────
    window.openFilePreview = function(file, type) {
        if (type === 'image') {
            // Show image in modal
            const modal   = document.getElementById('file-preview-modal');
            const img     = document.getElementById('preview-modal-img');
            const pdfBox  = document.getElementById('preview-modal-pdf');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            img.src = file._previewUrl || (file._previewUrl = URL.createObjectURL(file));
            img.classList.remove('hidden');
            pdfBox.classList.add('hidden');
        } else {
            // Open PDF in new tab
            const pdfUrl = file._previewUrl || URL.createObjectURL(file);
            window.open(pdfUrl, '_blank');
        }
    };

    window.closeFilePreview = function(e) {
        if (e.target === document.getElementById('file-preview-modal')) {
            closeFilePreviewDirect();
        }
    };

    window.closeFilePreviewDirect = function() {
        const modal = document.getElementById('file-preview-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    window.closeFilePreview = function(e) {
        if (e.target === document.getElementById('file-preview-modal')) {
            closeFilePreviewDirect();
        }
    };

    window.closeFilePreviewDirect = function() {
        const modal = document.getElementById('file-preview-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    // Close lightbox with Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeFilePreviewDirect();
    });

    // ── Toast notification ────────────────────────────────────
    function showToast(message, type = 'info') {
        const existing = document.getElementById('upload-toast');
        if (existing) existing.remove();

        const toast = document.createElement('div');
        toast.id    = 'upload-toast';
        const colors = {
            error:   'bg-red-50 border-red-200 text-red-700',
            success: 'bg-green-50 border-green-200 text-green-700',
            info:    'bg-blue-50 border-blue-200 text-blue-700',
        };
        toast.className = `fixed bottom-6 right-6 z-[70] px-4 py-3 rounded-xl border text-sm shadow-lg
                           transition-all duration-300 ${colors[type] || colors.info}`;
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(8px)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    // Form submit handler to ensure files are synced before submit
    const formCreate = document.getElementById('form-create');
    if (formCreate) {
        formCreate.addEventListener('submit', function(e) {
            // First sync files to input
            const dt = new DataTransfer();
            uploadedFiles.forEach(f => dt.items.add(f));
            fileInput.files = dt.files;
            
            // Debug log
            console.log('Form submit - files count:', fileInput.files.length);
            
            if (uploadedFiles.length > 0 && fileInput.files.length === 0) {
                e.preventDefault();
                alert('File upload error. Please try again.');
            }
        });
    }
});
</script>