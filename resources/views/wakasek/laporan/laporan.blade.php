@extends('layouts.wakasek.app')

@push('css')
@endpush

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="javascript:void(0);" onclick="openfilterModal()"
            class="block p-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">
                Akumulasi
            </h5>
            <p class="font-normal">
                Ekspor data akumulasi
            </p>
        </a>

    </div>


    @include('wakasek.laporan.filterAkumulasi')
@endsection

@push('js')
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }


        function openfilterModal() {
            openModal('modal-filter');
        }



        // Event listeners
        document.addEventListener('click', function(event) {
            ['modal-filter'].forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

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
    </script>
@endpush
