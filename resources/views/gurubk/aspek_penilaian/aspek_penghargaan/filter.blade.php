<!-- Modal Filter -->
<div id="modal-filter" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95"
        id="modal-content">

        <!-- Header -->
        <div
            class="flex items-center justify-between p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="bi bi-funnel text-blue-600"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Filter Aspek Penghargaan
                </h2>
            </div>
            <button onclick="closeModal('modal-filter')"
                class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-all duration-200">
                <i class="bi bi-x-lg text-lg"></i>
            </button>
        </div>

        <!-- Form -->
        <form method="GET" action="{{ route('aspek_penghargaanBK.index') }}" class="p-6 space-y-6">

            <!-- Kategori -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-buildings text-gray-500"></i>
                    Kategori
                </label>
                <select id="kategori" name="kategori"
                    class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoriList as $kategori)
                        <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-100">
                <button type="button" onclick="closeModal('modal-filter')"
                    class="px-6 py-3 text-sm font-medium rounded-xl border-2 border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 flex items-center justify-center gap-2">
                    <i class="bi bi-x-circle"></i>
                    Batal
                </button>

                <button type="button" onclick="resetFilter()"
                    class="px-6 py-3 text-sm font-medium rounded-xl border-2 border-orange-200 text-orange-600 hover:bg-orange-50 hover:border-orange-300 transition-all duration-200 flex items-center justify-center gap-2">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </button>

                <button type="submit"
                    class="px-6 py-3 text-sm font-medium rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <i class="bi bi-check-circle"></i>
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>
</div>



<script>
    // Modal Functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('modal-open');
            
            // Add animation
            setTimeout(() => {
                const modalContent = modal.querySelector('#modal-content');
                if (modalContent) {
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                }
            }, 10);
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            const modalContent = modal.querySelector('#modal-content');
            if (modalContent) {
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
            }
            
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('modal-open');
            }, 200);
        }
    }

    function openFilterModal() {
        openModal('modal-filter');
    }

    // Reset filter function
    function resetFilter() {
        // Reset form fields
        document.getElementById('kategori').value = '';
        
        // Redirect to page without filter parameters
        window.location.href = "{{ route('aspek_penghargaanBK.index') }}";
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        ['modal-filter'].forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                closeModal(modalId);
            }
        });
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            ['modal-filter'].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden')) {
                    closeModal(modalId);
                }
            });
        }
    });

    // Form validation before submit
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.querySelector('#modal-filter form');
        if (filterForm) {
            filterForm.addEventListener('submit', function(e) {
                const kategori = document.getElementById('kategori').value;
                
                // If no filter selected, prevent submission
                if (!kategori) {
                    e.preventDefault();
                    alert('Silakan pilih kategori terlebih dahulu.');
                    return false;
                }
            });
        }
    });
</script>

<style>
    /* Prevent body scroll when modal is open */
    .modal-open {
        overflow: hidden;
    }
    
    /* Modal animation */
    #modal-content {
        transition: transform 0.2s ease-out;
    }
    
    /* Smooth select dropdown */
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.25em 1.25em;
        padding-right: 2.5rem;
    }
</style>