function openEditModal(nip, username, nama) {
            document.getElementById('edit_nip_bk').value = nip;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_nama_guru_bk').value = nama;
            document.getElementById('form-edit').action = `/gurubk/${nip}/update`;
            document.getElementById('modal-edit').classList.remove('hidden');
        }

        function openDeleteModal(nip, nama) {
            document.getElementById('delete-nama-guru').innerText = nama;
            document.getElementById('form-delete').action = `/gurubk/${nip}/destroy`;
            document.getElementById('modal-delete').classList.remove('hidden');
        }
        
        
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
            const url = `/gurubk?search=${query}`;
            fetchData(url);

        }, 200);
    });
});
