
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }
        function openCreateModal() {
            document.getElementById('nip_walikelas').value = '';
            document.getElementById('nama_walikelas').value = '';
            document.getElementById('id_kelas').value = '';
            openModal('modal-create');
        }


        function openEditModal(nip_walikelas, username, nama_walikelas, id_kelas) {
            document.getElementById('edit_nip_walikelas').value = nip_walikelas;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_nama_walikelas').value = nama_walikelas;
            document.getElementById('edit_id_kelas').value = id_kelas;
            document.getElementById('form-edit').action = `/walikelas/${nip_walikelas}/${username}/update`;
            openModal('modal-edit');
        }


        function openDeleteModal(nip_walikelas, nama_walikelas) {
            document.getElementById('delete-nama-walikelas').innerText = nama_walikelas;
            document.getElementById('form-delete').action = `/walikelas/${nip_walikelas}`;
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
        
       document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("inputSearch");
    const tableBody = document.getElementById("tableBody");
    const pagination = document.getElementById("pagination");

    let debounceTimer = null;

    // Simpan halaman terakhir sebelum search
    let lastPageUrl = window.location.href;

    function fetchData(url) {
        fetch(url)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");

                tableBody.innerHTML = doc.querySelector("#tableBody").innerHTML;
                pagination.innerHTML = doc.querySelector("#pagination").innerHTML;

                activatePaginationLinks();
            })
            .catch(err => console.error("ERR:", err));
    }

    function activatePaginationLinks() {
        const links = document.querySelectorAll("#pagination a");

        links.forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();

                // Simpan page terakhir sebelum search
                lastPageUrl = this.href;

                fetchData(this.href);
            });
        });
    }

    activatePaginationLinks();

    // Auto search
    input.addEventListener("keyup", function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            const query = input.value.trim();

            if (query.length === 0) {
                // User hapus search → kembali ke page terakhir
                fetchData(lastPageUrl);
                return;
            }

            // Search selalu mulai dari page 1
            const url = `/walikelas?search=${query}`;
            fetchData(url);

        }, 200);
    });
});
