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

        function openFilterModal() { 
       openModal('modal-filter'); }

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
            ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter'].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                ['modal-create', 'modal-edit', 'modal-delete', 'modal-filter'].forEach(modalId => {
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

                lastPageUrl = this.href;

                fetchData(this.href);
            });
        });
    }

    activatePaginationLinks();

    input.addEventListener("keyup", function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            const query = input.value.trim();

            if (query.length === 0) {
                fetchData(lastPageUrl);
                return;
            }

            const url = `/kaprog?search=${query}`;
            fetchData(url);

        }, 200);
    });
});
