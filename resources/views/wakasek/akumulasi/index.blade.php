 @extends('layouts.wakasek.app')


 @push('css')
     <style>
         .table-hover tbody tr:hover {
             background-color: rgba(59, 130, 246, 0.05);
             transform: translateY(-1px);
             transition: all 0.2s ease;
         }

         .action-btn {
             transition: all 0.2s ease;
         }

         .action-btn:hover {
             transform: scale(1.1);
         }

         .modal-overlay {
             z-index: 9999 !important;
         }

         body.modal-open {
             overflow: hidden;
         }
     </style>
 @endpush

 @section('content')
     <div class="space-y-6">
         <!-- Header -->
         <div class="flex justify-between items-center">
             <div>
                 <h1 class="text-2xl font-bold gradient-text">Data Akumulasi</h1>
                 <p class="text-gray-600 mt-1">Kelola data Akumulasi</p>
             </div>
         </div>

         @if (session('success'))
             <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                 <p class="text-sm font-semibold flex items-center gap-2">
                     <i class="bi bi-check-circle-fill text-green-600"></i>
                     {{ session('success') }}
                 </p>
             </div>
         @endif

         @if (session('error'))
             <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                 <p class="text-sm font-semibold flex items-center gap-2">
                     <i class="bi bi-exclamation-triangle-fill text-red-600"></i>
                     {{ session('error') }}
                 </p>
             </div>
         @endif

         <!-- Search and Filter -->
         <div class="bg-white p-6 rounded-xl shadow-sm border">
             <div class="flex flex-col md:flex-row gap-2 items-center justify-between">
                 <div class="relative w-full md:w-64">
                     <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                     <input type="text" placeholder="Cari Akumulasi.."
                         class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                 </div>
                 <div class="flex gap-2">
                     <button onclick="openfilterModal()"
                         class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                         <i class="bi bi-funnel"></i> Filter
                     </button>
                     <button onclick="openModal('exportImportModal')"
                         class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                         <i class="bi bi-download"></i> Export
                     </button>
                 </div>
             </div>
         </div>

         <!-- Data Table -->
         <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
             <div class="px-6 py-4 border-b border-gray-200">
                 <h3 class="text-lg font-semibold text-gray-900">Akumulasi</h3>
             </div>

             <div class="overflow-x-auto">
                 <table class="w-full">
                     <thead class="bg-gray-50 border-b border-gray-200">
                         <tr>

                             <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                 No</th>
                             <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                 NIS</th>
                             <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                 Nama Siswa</th>
                             <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                 Kelas</th>
                             <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                 Skor Pelanggaran</th>
                             <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                 Skor Penghargaan</th>
                             <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                 Akumulasi</th>
                         </tr>
                     </thead>

                     <tbody class="bg-white divide-y divide-gray-100">
                         @forelse ($siswa as $item)
                             <tr class="hover:bg-gray-50 group">
                                 <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                 <td class="px-6 py-4 whitespace-nowrap">{{ $item->nis }}</td>
                                 <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_siswa }}</td>
                                 <td class="px-6 py-4 whitespace-nowrap">{{ $item->kelas->nama_kelas }}</td>
                                 <td class="px-6 py-4 whitespace-nowrap">{{ $item->poin_pelanggaran ?? 0 }}</td>
                                 <td class="px-6 py-4 whitespace-nowrap">{{ $item->poin_apresiasi ?? 0 }}</td>
                                 <td class="px-6 py-4 whitespace-nowrap">{{ $item->poin_total ?? 0 }}</td>
                             </tr>
                         @empty
                             <tr>
                                 <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                     Belum ada data Akumulasi
                                 </td>
                             </tr>
                         @endforelse
                     </tbody>
                 </table>
             </div>

             <!-- PAGINATION -->
             <div class="px-6 py-4 border-t border-gray-200 bg-white">
                 @include('layouts.wakasek.pagination', ['data' => $siswa])
             </div>
         </div>

     </div>
     @include('wakasek.akumulasi.filter')
     @include('wakasek.akumulasi.modalExportImport')
 @endsection

 @push('js')
     <script>
         // Modal management
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
             ['modal-filter', 'exportImportModal'].forEach(modalId => {
                 const modal = document.getElementById(modalId);
                 if (modal && !modal.classList.contains('hidden') && event.target === modal) {
                     closeModal(modalId);
                 }
             });
         });

         document.addEventListener('keydown', function(event) {
             if (event.key === 'Escape') {
                 ['modal-filter', 'exportImportModal'].forEach(modalId => {
                     const modal = document.getElementById(modalId);
                     if (modal && !modal.classList.contains('hidden')) {
                         closeModal(modalId);
                     }
                 });
             }
         });

         document.addEventListener("DOMContentLoaded", () => {
             const table = document.querySelector("table");
             const headers = table.querySelectorAll("th");
             const tbody = table.querySelector("tbody");

             headers.forEach((header, index) => {
                 header.classList.add("cursor-pointer", "select-none");
                 header.innerHTML += ` <i class="bi bi-chevron-expand opacity-50 text-xs ml-1"></i>`;

                 header.addEventListener("click", () => {
                     const rows = Array.from(tbody.querySelectorAll("tr"))
                         .filter(row => row.querySelectorAll("td").length > 0);

                     // Detect numeric or text column
                     const firstValue = rows[0]?.querySelectorAll("td")[index]?.innerText.trim() ||
                         "";
                     const isNumeric = !isNaN(parseFloat(firstValue.replace(",", ".")));

                     // Toggle sort direction
                     const currentSort = header.dataset.sort || (isNumeric ? "desc" : "asc");
                     const newSort = currentSort === "asc" ? "desc" : "asc";

                     headers.forEach(h => {
                         h.dataset.sort = "";
                         h.querySelector("i").className =
                             "bi bi-chevron-expand opacity-50 text-xs ml-1";
                     });

                     header.dataset.sort = newSort;
                     header.querySelector("i").className =
                         newSort === "asc" ?
                         "bi bi-chevron-up text-blue-600 text-xs ml-1" :
                         "bi bi-chevron-down text-blue-600 text-xs ml-1";

                     // Sort logic
                     const sortedRows = rows.sort((a, b) => {
                         const aText = a.querySelectorAll("td")[index].innerText.trim();
                         const bText = b.querySelectorAll("td")[index].innerText.trim();

                         if (isNumeric) {
                             const aNum = parseFloat(aText.replace(",", ".")) || 0;
                             const bNum = parseFloat(bText.replace(",", ".")) || 0;
                             return newSort === "asc" ? aNum - bNum : bNum - aNum;
                         } else {
                             return newSort === "asc" ?
                                 aText.localeCompare(bText) :
                                 bText.localeCompare(aText);
                         }
                     });

                     // Rebuild tbody
                     tbody.innerHTML = "";
                     sortedRows.forEach(row => tbody.appendChild(row));
                 });
             });
         });
     </script>
 @endpush
