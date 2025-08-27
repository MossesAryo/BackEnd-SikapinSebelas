
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        function openCreateModal() {
            document.getElementById('id_penghargaan').value = '';
            document.getElementById('tanggal_penghargaan').value = '';
            document.getElementById('level_penghargaan').value = '';
            document.getElementById('alasan').value = '';
            openModal('modal-create');
        }

        function openEditModal(id_penghargaan, tanggal_penghargaan, level_penghargaan, alasan) {
            document.getElementById('edit_id_penghargaan').value = id_penghargaan;
            document.getElementById('edit_tanggal_penghargaan').value = tanggal_penghargaan;
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
   
