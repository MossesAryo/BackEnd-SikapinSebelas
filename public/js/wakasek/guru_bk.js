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
        
         document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector("#searchGurubk input");
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