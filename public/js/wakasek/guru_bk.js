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