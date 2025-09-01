function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        function openCreateModal() {
            
            openModal('modal-create');
        }

        function openEditModal(nip, nama, jurusan, username) {
            document.getElementById('edit_nip').value = nip;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_jurusan').value = jurusan;
            document.getElementById('username').value = username;

            document.getElementById('form-edit').action = `/kaprog/${nip}/${username}/update`;
            openModal('modal-edit');
        }


        function openDeleteModal(nip, nama) {
            document.getElementById('delete-nama-ketua').innerText = nama;
            document.getElementById('form-delete').action = `/kaprog/${nip}`;
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
    const searchInput = document.querySelector("#searchKaprog input");
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