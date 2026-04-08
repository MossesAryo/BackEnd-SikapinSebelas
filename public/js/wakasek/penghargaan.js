
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        function openCreateModal() {
            document.getElementById('level_penghargaan').value = '';
            document.getElementById('alasan').value = '';
            openModal('modal-create');
        }

        function openEditModal(id_penghargaan, level_penghargaan, alasan) {
            document.getElementById('edit_level_penghargaan').value = level_penghargaan;
            document.getElementById('edit_alasan').value = alasan;
            document.getElementById('form-edit').action = `/penghargaan/${id_penghargaan}/update`;
            openModal('modal-edit');
        }


        function openDeleteModal(id_penghargaan, nama) {
            document.getElementById('delete-penghargaan').innerText = nama;
            document.getElementById('form-delete').action = `/penghargaan/${id_penghargaan}`;
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
    const input = document.getElementById("searchApresiasi");
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

                document.querySelectorAll("#pagination a").forEach(link => {
                    link.addEventListener("click", function (e) {
                        e.preventDefault();
                        lastPageUrl = this.href;
                        fetchData(this.href);
                    });
                });
            })
            .catch(err => console.error("Fetch error:", err));
    }

    input.addEventListener("keyup", function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const query = this.value.trim();

            if (query === "") {
                fetchData(lastPageUrl);
                return;
            }

            const url = `/penghargaan?search=${encodeURIComponent(query)}`;
            fetchData(url);
        }, 300);
    });
});