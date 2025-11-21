
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}


function openCreateModalPenanganan(nis) {
    const nisInput = document.getElementById('nis');
    if (nisInput) nisInput.value = nis;

    openModal('modal-create-penanganan');
}


function openCreateModalPenghargaan(nis) {
    const nisInput = document.getElementById('nis');
    const aspekSelect = document.getElementById('id_aspekpenilaian_penghargaan');
    const skorInput = document.getElementById('skor');

    if (nisInput) nisInput.value = nis;
    if (aspekSelect) aspekSelect.value = '';
    if (skorInput) skorInput.value = '';

    openModal('modal-create-penghargaan');
}


function openCreateModalPelanggaran(nis) {
   
    const modal = document.getElementById('modal-create-pelanggaran');
    if (modal) {
        openModal('modal-create-pelanggaran');
    } else {
        alert('Modal Tambah Pelanggaran belum dibuat — NIS: ' + nis);
    }
}

function updateSkor(select, targetId) {
    const selectedOption = select.options[select.selectedIndex];
    const skor = selectedOption ? selectedOption.dataset.skor || '' : '';
    const skorInput = document.getElementById(targetId);
    if (skorInput) {
        skorInput.value = skor;
    }
}


function openfilterModal() { openModal('modal-filter'); }

function openpenghargaanModal(nis) {
    document.getElementById('id_penghargaan').value = '';
    openModal('modal-penghargaan');
}

function openperingatanModal(nis) {
    document.getElementById('id_sp').value = '';
    openModal('modal-peringatan');
}

function opencatatanmodal(nis) {
    document.getElementById('judul_catatan').value = '';
    document.getElementById('isi_catatan').value = '';
    openModal('modal-catatan');
}

function openEditModal(nis, nama_siswa, id_kelas) {
    document.getElementById('edit_nis').value = nis;
   
    document.getElementById('edit_nama_siswa').value = nama_siswa;
    document.getElementById('edit_id_kelas').value = id_kelas;
    document.getElementById('form-edit').action = `/siswa/${nis}/update`;
    openModal('modal-edit');
}

function openCreateModal() {
    document.getElementById('nis').value = '';
    document.getElementById('nama_siswa').value = '';
    document.getElementById('id_kelas').value = '';
    openModal('modal-create');
}

function openDeleteModal(nis, nama_siswa) {
    document.getElementById('delete-nama-siswa').innerText = nama_siswa;
    document.getElementById('form-delete').action = `/siswa/${nis}`;
    openModal('modal-delete');
}

function openDeletePenghargaanModal(nis, id, nama_penghargaan) {
    document.getElementById('delete-nama-penghargaan').innerText = nama_penghargaan;
    document.getElementById('form-delete-penghargaan').action = `/siswa/${nis}/penghargaan/${id}`;
    openModal('modal-delete-penghargaan');
}

function openDeletePeringatanModal(nis, id, nama_peringatan) {
    document.getElementById('delete-nama-peringatan').innerText = nama_peringatan;
    document.getElementById('form-delete-peringatan').action = `/siswa/${nis}/peringatan/${id}`;
    openModal('modal-delete-peringatan');
}

// Close modal saat klik luar atau tekan Escape
document.addEventListener('click', e => {
    const modalIds = ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter', 'modal-penghargaan', 'modal-peringatan', 'modal-delete-penghargaan', 'modal-delete-peringatan', 'modal-create-penghargaan', 'modal-create-pelanggaran', 'modal-create-penanganan'];
    modalIds.forEach(id => {
        const modal = document.getElementById(id);
        if (modal && !modal.classList.contains('hidden') && e.target === modal) {
            closeModal(id);
        }
    });
});

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        const modalIds = ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter', 'modal-penghargaan', 'modal-peringatan', 'modal-delete-penghargaan', 'modal-delete-peringatan', 'modal-create-penghargaan', 'modal-create-pelanggaran', 'modal-create-penanganan'];
        modalIds.forEach(id => {
            const modal = document.getElementById(id);
            if (modal && !modal.classList.contains('hidden')) closeModal(id);
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("inputSearch");
    const tableBody = document.getElementById("tableBody");
    const pagination = document.getElementById("pagination");

    let debounceTimer = null;
    let lastPageUrl = window.location.href;

    // Ambil URL dasar sesuai role (dinamis)
    const baseUrl = window.location.pathname; 

    function fetchData(url) {
        fetch(url)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");

                if (tableBody) tableBody.innerHTML = doc.querySelector("#tableBody")?.innerHTML || '';
                if (pagination) pagination.innerHTML = doc.querySelector("#pagination")?.innerHTML || '';

                activatePaginationLinks();
            })
            .catch(err => console.error("ERR:", err));
    }

    function activatePaginationLinks() {
        document.querySelectorAll("#pagination a").forEach(link => {
            link.addEventListener("click", e => {
                e.preventDefault();
                lastPageUrl = link.href;
                fetchData(link.href);
            });
        });
    }

    activatePaginationLinks();

    if (input) {
        input.addEventListener("keyup", () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const query = input.value.trim();

                if (query.length === 0) {
                    fetchData(lastPageUrl);
                } else {
                    // Gunakan url halaman sekarang + search
                    const searchUrl = `${baseUrl}?search=${encodeURIComponent(query)}`;
                    fetchData(searchUrl);
                }
            }, 200);
        });
    }
});
