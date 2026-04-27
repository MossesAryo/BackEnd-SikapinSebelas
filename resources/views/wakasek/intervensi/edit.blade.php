<div id="modal-edit"
    class="fixed inset-0 bg-black bg-opacity-40 modal-overlay flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl mx-4 flex flex-col max-h-[90vh]">

        {{-- Header --}}
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 sticky top-0 bg-white z-10 rounded-t-xl">
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-semibold text-gray-800">Edit Penanganan</h2>
                <span id="edit-status-chip" class="hidden text-xs font-medium px-2.5 py-1 rounded-full"></span>
            </div>
            <button type="button" onclick="closeModal('modal-edit')"
                class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:text-gray-600 hover:bg-gray-50 text-xl leading-none">&times;</button>
        </div>

        <form id="form-edit" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf
            @method('PUT')

            <div class="px-6 py-5 space-y-4">

                {{-- Info banner --}}
                <div class="flex items-start gap-2.5 bg-blue-50 border border-blue-100 rounded-xl px-4 py-3">
                    <svg class="w-4 h-4 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>
                    <p class="text-xs text-blue-600 leading-relaxed">
                        Data siswa tidak dapat diubah setelah penanganan dibuat.
                    </p>
                </div>

                {{-- Pilih Siswa (read-only) --}}
                <div>
                    <label for="nis_edit" class="block text-sm font-medium text-gray-700 mb-1">Siswa</label>
                    <select id="nis_edit" disabled
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 text-gray-500 cursor-not-allowed">
                        <option value="">Memuat...</option>
                        @foreach ($siswa as $item)
                            <option value="{{ $item->nis }}">{{ $item->nama_siswa }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="nis_hidden_edit" name="nis">
                    <input type="hidden" id="return_to_edit" name="return_to">
                </div>

                {{-- Nama Penanganan --}}
                <div>
                    <label for="nama_intervensi_edit" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Penanganan
                    </label>
                    <input type="text" id="nama_intervensi_edit" name="nama_intervensi" required
                        placeholder="Contoh: Penindak Lanjutan Kehadiran Siswa"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                {{-- Isi Penanganan --}}
                <div>
                    <label for="isi_intervensi_edit" class="block text-sm font-medium text-gray-700 mb-1">
                        Isi Penanganan
                    </label>
                    <textarea id="isi_intervensi_edit" name="isi_intervensi" rows="4" required
                        placeholder="Jelaskan isi penanganan yang dilakukan..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y"></textarea>
                </div>

                {{-- Status --}}
                <div>
                    <label for="status_edit" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status_edit" name="status" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        onchange="onEditStatusChange()">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Binaan Khusus">Binaan Khusus</option>
                        <option value="Dalam Binaan">Dalam Binaan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                {{-- Perubahan Setelah Intervensi (animated) --}}
                <div id="perubahan-field-edit"
                    style="overflow: hidden; max-height: 0; opacity: 0; margin-top: 0;
                           transition: max-height 0.35s ease, opacity 0.25s ease, margin-top 0.25s ease;">
                    <div class="pt-1">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="h-px flex-1 bg-green-100"></div>
                            <span class="text-xs font-medium text-green-600 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Penanganan Selesai
                            </span>
                            <div class="h-px flex-1 bg-green-100"></div>
                        </div>

                        <label for="perubahan_setelah_intervensi_edit"
                            class="block text-sm font-medium text-gray-700 mb-1">
                            Perubahan Setelah Penanganan
                            <span class="font-normal text-gray-400">(wajib diisi)</span>
                        </label>
                        <textarea id="perubahan_setelah_intervensi_edit"
                            name="perubahan_setelah_intervensi" rows="4"
                            placeholder="Jelaskan perubahan yang terjadi pada siswa setelah penanganan selesai dilakukan..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent resize-y"></textarea>
                    </div>
                </div>

                {{-- Tanggal --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="tanggal_Mulai_Perbaikan_edit"
                            class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" id="tanggal_Mulai_Perbaikan_edit" name="tanggal_Mulai_Perbaikan"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="tanggal_Selesai_Perbaikan_edit"
                            class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                        <input type="date" id="tanggal_Selesai_Perbaikan_edit" name="tanggal_Selesai_Perbaikan"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                {{-- File Upload Section --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tambah Bukti Pendukung
                        <span class="font-normal text-gray-400">(Opsional — JPG, PNG, PDF, maks 5 MB/file)</span>
                    </label>

                    {{-- Drop Zone --}}
                    <div id="drop-zone-edit"
                        class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer
                               hover:border-blue-400 hover:bg-blue-50 transition-all duration-150"
                        onclick="document.getElementById('file-input-edit').click()"
                        ondragover="event.preventDefault(); this.classList.add('border-blue-400','bg-blue-50');"
                        ondragleave="this.classList.remove('border-blue-400','bg-blue-50');"
                        ondrop="handleFileDropEdit(event)">

                        <input type="file" id="file-input-edit" name="file[]" multiple
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

                    {{-- Preview Grid (file baru) --}}
                    <div id="preview-area-edit" class="hidden mt-3">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">File baru dipilih</p>
                            <span id="file-count-badge-edit"
                                class="text-xs font-medium text-blue-600 bg-blue-50 rounded-full px-2.5 py-0.5">0 file</span>
                        </div>
                        <div id="preview-grid-edit" class="grid grid-cols-3 sm:grid-cols-4 gap-2"></div>

                        {{-- Size progress bar --}}
                        <div class="mt-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs text-gray-400">Total ukuran</span>
                                <span id="total-size-label-edit" class="text-xs text-gray-500">0 KB</span>
                            </div>
                            <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div id="size-progress-bar-edit"
                                    class="h-full rounded-full bg-blue-500 transition-all duration-300"
                                    style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Existing Files Section --}}
                    <div id="existing-files-section" class="hidden mt-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">File tersimpan</p>
                            <span id="existing-file-count"
                                class="text-xs font-medium text-violet-600 bg-violet-50 rounded-full px-2.5 py-0.5">0 file</span>
                        </div>
                        <div id="existing-files-grid" class="grid grid-cols-3 sm:grid-cols-4 gap-2"></div>
                    </div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="flex justify-between items-center gap-2 px-6 py-4 border-t border-gray-200 sticky bottom-0 bg-white rounded-b-xl">
                <p id="edit-unsaved-hint" class="text-xs text-amber-500 hidden flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                    Ada perubahan yang belum disimpan
                </p>
                <div class="flex gap-2 ml-auto">
                    <button type="button" onclick="closeModal('modal-edit')"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" id="edit-save-btn"
                        class="px-5 py-2 rounded-lg bg-blue-600 text-sm text-white font-medium hover:bg-blue-700 transition-colors flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- File Preview Modal for Edit --}}
<div id="file-preview-modal-edit"
    class="fixed inset-0 bg-black bg-opacity-80 z-[60] hidden items-center justify-center"
    onclick="if(event.target === this) closeFilePreviewEdit()">
    <div class="relative max-w-3xl max-h-[85vh] w-full mx-4 flex items-center justify-center">
        <button onclick="closeFilePreviewEdit()"
            class="absolute -top-10 right-0 text-white text-sm hover:text-gray-300 flex items-center gap-1">
            <span>Tutup</span>
            <span class="text-lg leading-none">&times;</span>
        </button>
        <img id="preview-modal-img-edit" src="" alt=""
            class="max-w-full max-h-[80vh] rounded-lg object-contain hidden shadow-2xl">
        <div id="preview-modal-pdf-edit"
            class="hidden bg-white rounded-xl p-8 text-center shadow-2xl">
            <svg class="w-16 h-16 text-red-400 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <p id="preview-modal-pdf-name-edit" class="text-gray-700 font-medium text-sm mb-1"></p>
            <a id="preview-modal-pdf-link-edit" href="" target="_blank" class="text-blue-600 text-xs hover:underline">Buka di tab baru</a>
        </div>
    </div>
</div>

<script>
// ── Status chip styling ───────────────────────────────────────
const STATUS_CHIP_CLASSES = {
    'Binaan Khusus': 'bg-amber-50 text-amber-700 border border-amber-200',
    'Dalam Binaan':  'bg-blue-50 text-blue-700 border border-blue-200',
    'Selesai':       'bg-green-50 text-green-700 border border-green-200',
};

function onEditStatusChange() {
    const statusEl   = document.getElementById('status_edit');
    const val        = statusEl ? statusEl.value : '';
    const fieldEl    = document.getElementById('perubahan-field-edit');
    const textareaEl = document.getElementById('perubahan_setelah_intervensi_edit');
    const chipEl     = document.getElementById('edit-status-chip');

    if (val === 'Selesai') {
        fieldEl.style.maxHeight  = (fieldEl.scrollHeight + 200) + 'px';
        fieldEl.style.opacity    = '1';
        fieldEl.style.marginTop  = '0';
        if (textareaEl) textareaEl.setAttribute('required', 'required');
    } else {
        fieldEl.style.maxHeight  = '0';
        fieldEl.style.opacity    = '0';
        fieldEl.style.marginTop  = '0';
        if (textareaEl) {
            textareaEl.removeAttribute('required');
            textareaEl.value = '';
        }
    }

    if (chipEl) {
        if (val && STATUS_CHIP_CLASSES[val]) {
            chipEl.className = 'text-xs font-medium px-2.5 py-1 rounded-full ' + STATUS_CHIP_CLASSES[val];
            chipEl.textContent = val;
            chipEl.classList.remove('hidden');
        } else {
            chipEl.classList.add('hidden');
        }
    }

    markUnsaved();
}

// ── Unsaved changes indicator ─────────────────────────────────
function markUnsaved() {
    const hint = document.getElementById('edit-unsaved-hint');
    if (hint) hint.classList.remove('hidden');
}

function clearUnsaved() {
    const hint = document.getElementById('edit-unsaved-hint');
    if (hint) hint.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function () {
    const formEdit = document.getElementById('form-edit');
    if (!formEdit) return;

    formEdit.querySelectorAll('input, textarea, select').forEach(el => {
        el.addEventListener('input',  markUnsaved);
        el.addEventListener('change', markUnsaved);
    });

    formEdit.addEventListener('submit', function () {
        clearUnsaved();
        const btn = document.getElementById('edit-save-btn');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = `
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                Menyimpan...`;
        }
    });
});

// ── File Upload for Edit Modal ────────────────────────────────
// Gunakan window scope agar bisa diakses dari index.blade.php
window.uploadedFilesEdit  = [];
window.existingFilesData  = [];

const ALLOWED_TYPES_EDIT      = ['image/jpeg', 'image/png', 'application/pdf'];
const MAX_SIZE_PER_FILE_EDIT   = 5 * 1024 * 1024;

function handleFileDropEdit(e) {
    e.preventDefault();
    const dropZone = document.getElementById('drop-zone-edit');
    dropZone.classList.remove('border-blue-400', 'bg-blue-50');
    addFilesEdit(Array.from(e.dataTransfer.files));
}

function addFilesEdit(newFiles) {
    newFiles.forEach(file => {
        if (!ALLOWED_TYPES_EDIT.includes(file.type)) {
            showToastEdit('Tipe file tidak didukung (hanya JPG, PNG, PDF)', 'error');
            return;
        }
        if (file.size > MAX_SIZE_PER_FILE_EDIT) {
            showToastEdit('File melebihi batas 5 MB', 'error');
            return;
        }
        const isDuplicate = window.uploadedFilesEdit.some(f => f.name === file.name && f.size === file.size);
        if (!isDuplicate) window.uploadedFilesEdit.push(file);
    });
    syncFileInputEdit();
    renderPreviewsEdit();
}

function removeFileEdit(index) {
    const f = window.uploadedFilesEdit[index];
    if (f && f._previewUrl) URL.revokeObjectURL(f._previewUrl);
    window.uploadedFilesEdit.splice(index, 1);
    syncFileInputEdit();
    renderPreviewsEdit();
}

function syncFileInputEdit() {
    const fileInput = document.getElementById('file-input-edit');
    if (!fileInput) return;
    const dt = new DataTransfer();
    window.uploadedFilesEdit.forEach(f => dt.items.add(f));
    fileInput.files = dt.files;
}

function formatSizeEdit(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
}

function renderPreviewsEdit() {
    const previewArea    = document.getElementById('preview-area-edit');
    const previewGrid    = document.getElementById('preview-grid-edit');
    const countBadge     = document.getElementById('file-count-badge-edit');
    const sizeProgressBar = document.getElementById('size-progress-bar-edit');
    const totalSizeLabel = document.getElementById('total-size-label-edit');

    if (!previewArea || !previewGrid) return;

    previewGrid.innerHTML = '';

    if (window.uploadedFilesEdit.length === 0) {
        previewArea.classList.add('hidden');
        return;
    }

    previewArea.classList.remove('hidden');
    if (countBadge) countBadge.textContent = window.uploadedFilesEdit.length + ' file';

    const totalBytes = window.uploadedFilesEdit.reduce((acc, f) => acc + f.size, 0);
    const maxBytes   = MAX_SIZE_PER_FILE_EDIT * Math.max(window.uploadedFilesEdit.length, 1);
    const pct        = Math.min(100, Math.round((totalBytes / maxBytes) * 100));
    if (sizeProgressBar) {
        sizeProgressBar.style.width = pct + '%';
        sizeProgressBar.className   = 'h-full rounded-full transition-all duration-300 ' +
            (pct > 80 ? 'bg-red-400' : pct > 50 ? 'bg-yellow-400' : 'bg-blue-500');
    }
    if (totalSizeLabel) totalSizeLabel.textContent = formatSizeEdit(totalBytes);

    window.uploadedFilesEdit.forEach((file, index) => {
        const isImage = file.type.startsWith('image/');
        const item    = document.createElement('div');
        item.className = 'relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-50 aspect-square cursor-pointer';

        if (isImage) {
            const url = file._previewUrl || (file._previewUrl = URL.createObjectURL(file));
            item.innerHTML = `
                <img src="${url}" alt="${file.name}" class="w-full h-full object-cover">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent px-2 pb-2 pt-5">
                    <p class="text-white text-[9px] truncate">${file.name}</p>
                </div>`;
            item.addEventListener('click', () => openFilePreviewEdit(file, 'image'));
        } else {
            item.innerHTML = `
                <div class="w-full h-full flex flex-col items-center justify-center gap-1 p-2">
                    <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25"/>
                        </svg>
                    </div>
                    <p class="text-[10px] text-gray-600 text-center break-all line-clamp-2">${file.name}</p>
                </div>`;
            item.addEventListener('click', () => openFilePreviewEdit(file, 'pdf'));
        }

        const removeBtn       = document.createElement('button');
        removeBtn.type        = 'button';
        removeBtn.title       = 'Hapus file';
        removeBtn.className   = 'absolute top-1.5 right-1.5 w-5 h-5 rounded-full bg-black/50 hover:bg-red-500 flex items-center justify-center text-white text-[10px] opacity-0 group-hover:opacity-100 transition-all z-10';
        removeBtn.innerHTML   = '×';
        removeBtn.addEventListener('click', e => { e.stopPropagation(); removeFileEdit(index); });

        item.appendChild(removeBtn);
        previewGrid.appendChild(item);
    });
}

// ── Render existing (saved) files ─────────────────────────────
function renderExistingFiles() {
    const existingSection = document.getElementById('existing-files-section');
    const existingGrid    = document.getElementById('existing-files-grid');
    const countBadge      = document.getElementById('existing-file-count');

    if (!existingSection || !existingGrid) return;

    // Hapus hidden input hapus_file[] dari sebelumnya agar tidak duplikat
    document.querySelectorAll('#form-edit input[name="hapus_file[]"]').forEach(el => el.remove());

    if (!window.existingFilesData || window.existingFilesData.length === 0) {
        existingSection.classList.add('hidden');
        return;
    }

    existingSection.classList.remove('hidden');
    if (countBadge) countBadge.textContent = window.existingFilesData.length + ' file';
    existingGrid.innerHTML = '';

    window.existingFilesData.forEach((file, index) => {
        const isImage = /\.(jpe?g|png)$/i.test(file.path);
        const item    = document.createElement('div');
        item.className = 'relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-50 aspect-square cursor-pointer';

        if (isImage) {
            item.innerHTML = `
                <img src="${file.url}" alt="${file.nama_file || ''}" class="w-full h-full object-cover">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent px-2 pb-2 pt-5">
                    <p class="text-white text-[9px] truncate">${file.nama_file || file.path.split('/').pop()}</p>
                </div>`;
            item.addEventListener('click', () => openExistingFilePreview(file, 'image'));
        } else {
            item.innerHTML = `
                <div class="w-full h-full flex flex-col items-center justify-center gap-1 p-2">
                    <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25"/>
                        </svg>
                    </div>
                    <p class="text-[10px] text-gray-600 text-center break-all line-clamp-2">${file.nama_file || file.path.split('/').pop()}</p>
                </div>`;
            item.addEventListener('click', () => openExistingFilePreview(file, 'pdf'));
        }

        const removeBtn     = document.createElement('button');
        removeBtn.type      = 'button';
        removeBtn.title     = 'Hapus file';
        removeBtn.className = 'absolute top-1.5 right-1.5 w-5 h-5 rounded-full bg-black/50 hover:bg-red-500 flex items-center justify-center text-white text-[10px] opacity-0 group-hover:opacity-100 transition-all z-10';
        removeBtn.innerHTML = '×';
        removeBtn.addEventListener('click', e => {
            e.stopPropagation();
            // Tambahkan hidden input agar server tahu file mana yang perlu dihapus
            const hapusInput   = document.createElement('input');
            hapusInput.type    = 'hidden';
            hapusInput.name    = 'hapus_file[]';
            hapusInput.value   = file.id;
            document.getElementById('form-edit').appendChild(hapusInput);

            // Hapus dari array dan re-render
            window.existingFilesData.splice(index, 1);
            renderExistingFiles();
            markUnsaved();
        });

        item.appendChild(removeBtn);
        existingGrid.appendChild(item);
    });
}

// ── Open edit modal (called from index.blade.php) ─────────────
function openEditModal(data) {
    const form = document.getElementById('form-edit');
    if (!form) return;

    // Set action URL
    form.action = `/intervensi/${data.id}/update`;

    // Helper setter
    const set = (id, val) => {
        const el = document.getElementById(id);
        if (el) el.value = val ?? '';
    };

    set('nis_edit',                          data.nis);
    set('nis_hidden_edit',                   data.nis);
    set('return_to_edit',                    data.return_to ?? '');
    set('nama_intervensi_edit',              data.nama_intervensi);
    set('isi_intervensi_edit',               data.isi_intervensi);
    set('status_edit',                       data.status);
    set('perubahan_setelah_intervensi_edit', data.perubahan_setelah_intervensi ?? '');
    set('tanggal_Mulai_Perbaikan_edit',      data.tanggal_Mulai_Perbaikan);
    set('tanggal_Selesai_Perbaikan_edit',    data.tanggal_Selesai_Perbaikan);

    // Reset file state
    window.uploadedFilesEdit = [];
    window.existingFilesData = [];

    if (data.existing_files && data.existing_files.length > 0) {
        window.existingFilesData = data.existing_files.map(f => ({
            id:        f.id,
            path:      f.path,
            url:       '/storage/' + f.path,
            nama_file: f.nama_file || f.path.split('/').pop()
        }));
    }

    renderExistingFiles();
    renderPreviewsEdit();

    // Trigger status UI (chip + perubahan field)
    onEditStatusChange();

    clearUnsaved();
    openModal('modal-edit');
}

// ── File preview helpers ──────────────────────────────────────
function openFilePreviewEdit(file, type) {
    const modal  = document.getElementById('file-preview-modal-edit');
    const img    = document.getElementById('preview-modal-img-edit');
    const pdfBox = document.getElementById('preview-modal-pdf-edit');
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    if (type === 'image') {
        img.src = file._previewUrl || URL.createObjectURL(file);
        img.classList.remove('hidden');
        pdfBox.classList.add('hidden');
    } else {
        document.getElementById('preview-modal-pdf-name-edit').textContent = file.name;
        img.classList.add('hidden');
        pdfBox.classList.remove('hidden');
    }
}

function openExistingFilePreview(file, type) {
    const modal  = document.getElementById('file-preview-modal-edit');
    const img    = document.getElementById('preview-modal-img-edit');
    const pdfBox = document.getElementById('preview-modal-pdf-edit');
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    if (type === 'image') {
        img.src = file.url;
        img.classList.remove('hidden');
        pdfBox.classList.add('hidden');
    } else {
        document.getElementById('preview-modal-pdf-name-edit').textContent = file.nama_file || file.path.split('/').pop();
        document.getElementById('preview-modal-pdf-link-edit').href        = file.url;
        img.classList.add('hidden');
        pdfBox.classList.remove('hidden');
    }
}

function closeFilePreviewEdit() {
    const modal = document.getElementById('file-preview-modal-edit');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// ── File input change listener ────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('file-input-edit');
    if (fileInput) {
        fileInput.addEventListener('change', () => {
            addFilesEdit(Array.from(fileInput.files));
            fileInput.value = '';
        });
    }
});

// ── Toast notification ────────────────────────────────────────
function showToastEdit(message, type = 'info') {
    const existing = document.getElementById('upload-toast-edit');
    if (existing) existing.remove();

    const toast  = document.createElement('div');
    toast.id     = 'upload-toast-edit';
    const colors = {
        error:   'bg-red-50 border-red-200 text-red-700',
        success: 'bg-green-50 border-green-200 text-green-700',
        info:    'bg-blue-50 border-blue-200 text-blue-700',
    };
    toast.className  = `fixed bottom-6 right-6 z-[70] px-4 py-3 rounded-xl border text-sm shadow-lg transition-all duration-300 ${colors[type] || colors.info}`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity   = '0';
        toast.style.transform = 'translateY(8px)';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>