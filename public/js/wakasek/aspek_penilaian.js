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

        function openEditModal(id, jenis, indikator, uraian) {
            document.getElementById('edit_id_aspekpenilaian').value = id;
            document.getElementById('edit_jenis_poin').value = jenis;
            document.getElementById('edit_indikator_poin').value = indikator;
            document.getElementById('edit_uraian').value = uraian;
            document.getElementById('edit_form-edit').action = `/aspekpenilaian/${id}/update`;
            openModal('modal-edit');
        }


        function openDeleteModal(id) {
            document.getElementById('delete-nama-ketua').innerText = id;
            document.getElementById('form-delete').action = `/aspekpenilaian/${id}/destroy`;
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