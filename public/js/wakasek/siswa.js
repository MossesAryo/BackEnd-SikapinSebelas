
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }
         function openfilterModal() {

            openModal('modal-filter');
        }
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

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }
        function openCreateModal() {
            document.getElementById('nis').value = '';
            document.getElementById('nama_siswa').value = '';
            document.getElementById('id_kelas').value = '';
            openModal('modal-create');
        }
        function openEditModal(nis, nama_siswa, id_kelas) {
            document.getElementById('edit_nis').value = nis;
            document.getElementById('edit_nama_siswa').value = nama_siswa;
            document.getElementById('edit_id_kelas').value = id_kelas;
            document.getElementById('form-edit').action = `/siswa/${nis}/update`;
            openModal('modal-edit');
        } 
        function openDeleteModal(nis, nama_siswa) {
            document.getElementById('delete-nama-siswa').innerText = nama_siswa;
            document.getElementById('form-delete').action = `/siswa/${nis}`;
            openModal('modal-delete');
        }
        function openDeletePenghargaanModal(nis,id,nama_penghargaan) {
              document.getElementById('delete-nama-penghargaan').innerText = nama_penghargaan;
              document.getElementById('form-delete-penghargaan').action = `/siswa/${nis}/penghargaan/${id}`;
              openModal('modal-delete-penghargaan');
           }
        function openDeletePeringatanModal(nis,id,nama_peringatan) {
              document.getElementById('delete-nama-peringatan').innerText = nama_peringatan;
              document.getElementById('form-delete-peringatan').action = `/siswa/${nis}/peringatan/${id}`;
              openModal('modal-delete-peringatan');
           }

        document.addEventListener('click', function(event) {
            ['modal-create', 'modal-edit', 'modal-delete','modal-filter','modal-penghargaan','modal-peringatan','modal-delete-penghargaan','modal-delete-peringatan','modal-catatan'].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                ['modal-create', 'modal-edit', 'modal-delete','modal-filter','modal-penghargaan','modal-peringatan','modal-delete-penghargaan','modal-delete-peringatan','modal-catatan'].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });
  
  // Search functionality
  document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector("#searchSiswa input");
    const tableRows = document.querySelectorAll("tbody tr");

    searchInput.addEventListener("keyup", function () {
        const searchText = this.value.toLowerCase();

        tableRows.forEach(row => {
            
            if (row.querySelector("td[colspan]")) {
                row.style.display = searchText === "" ? "" : "none";
                return;
            }

            const rowText = row.innerText.toLowerCase();
            if (rowText.includes(searchText)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});

    