function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        function openCreateModal() {
            document.getElementById('id_sp').value = '';
            document.getElementById('tanggal_sp').value = '';
            document.getElementById('level_sp').value = '';
            document.getElementById('alasan').value = '';
            openModal('modal-create');
        }

    function openEditModal(id_sp, tanggal_sp, level_sp, alasan) {
            document.getElementById('edit_id_sp').value = id_sp;
            document.getElementById('edit_tanggal_sp').value = tanggal_sp;
            document.getElementById('edit_level_sp').value = level_sp;
            document.getElementById('edit_alasan').value = alasan;
            document.getElementById('form-edit').action = `/peringatan/${id_sp}/update`;
            openModal('modal-edit');
        }


        function openDeleteModal(id_sp, nama) {
            document.getElementById('delete-sp').innerText = nama;
            document.getElementById('form-delete').action = `/peringatan/${id_sp}`;
            openModal('modal-delete');
        }

        document.addEventListener('click', function(event) {
            ['modal-create', 'modal-edit', 'modal-delete'].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                ['modal-create', 'modal-edit', 'modal-delete'].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal && !modal.classList.contains('hidden')) {
                        closeModal(modalId);
                    }
                });
            }
        });

         document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector("#searchPeringatan input");
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
