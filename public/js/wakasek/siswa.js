
        // Modal management
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        // Create modal
        function openCreateModal() {
            document.getElementById('nis').value = '';
            document.getElementById('nama_siswa').value = '';
            document.getElementById('id_kelas').value = '';
            openModal('modal-create');
        }

        // Edit modal
        function openEditModal(nis, nama_siswa, id_kelas) {
            document.getElementById('edit_nis').value = nis;
            document.getElementById('edit_nama_siswa').value = nama_siswa;
            document.getElementById('edit_id_kelas').value = id_kelas;
            document.getElementById('form-edit').action = `/siswa/${nis}/update`;
            openModal('modal-edit');
        }

        // Delete modal
        function openDeleteModal(nis, nama_siswa) {
            document.getElementById('delete-nama-siswa').innerText = nama_siswa;
            document.getElementById('form-delete').action = `/siswa/${nis}`;
            openModal('modal-delete');
        }

        // Event listeners
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
    