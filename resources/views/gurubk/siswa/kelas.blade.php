@extends('layouts.gurubk.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/gurubk/kelas.css') }}">
    <style>
        .filter-btn.active {
            background-color: #ffffff;
            color: #2563eb;
        }
        .class-item {
            transition: all 0.3s ease;
        }
        .class-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endpush

@section('content')
<div class="content-wrapper">
   
          <!-- Search and Filter -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <div class="flex flex-col md:flex-row gap-2 items-center justify-between">
                <div id="searchWalikelas" class="relative w-full md:w-64">
                    <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
                    <input type="text" placeholder="Cari Kelas..."
                        class="pl-10 pr-4 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full">
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                   <button
                    id="exportImportBtn" class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1.5">
                    <i class="bi bi-download"></i> Export / Import
                </button>
                </div>
            </div>
        </div>
        <br>

    <!-- Class List Content -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Kelas</h2>
            
            <div id="classList" class="space-y-4">
                <!-- RPL -->
                
                            <a href="{{ route('gurubk.siswa')}}">
                <div class="class-item bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-all duration-200 cursor-pointer" 
                     data-category="it">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-1 h-12 bg-green-400 rounded-full mr-4"></div>
                            <div class="mr-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-code text-green-600 text-xl"></i>
                                </div>
                            </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">RPL 1</h3>
                                    <p class="text-gray-500">Rekayasa Perangkat Lunak</p>

                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-400 mr-2">45 Siswa</span>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </a>
<br>

                       <a href="{{ route('gurubk.siswa')}}">
                            <div class="class-item bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-all duration-200 cursor-pointer" 
                     data-category="it">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-1 h-12 bg-green-400 rounded-full mr-4"></div>
                            <div class="mr-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-code text-green-600 text-xl"></i>
                                </div>
                            </div>

                     
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">RPL 2</h3>
                                    <p class="text-gray-500">Rekayasa Perangkat Lunak</p>

                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-400 mr-2">45 Siswa</span>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </a>

<br>


                 <a href="{{ route('gurubk.siswa')}}">
                            <div class="class-item bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-all duration-200 cursor-pointer" 
                     data-category="it">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-1 h-12 bg-green-400 rounded-full mr-4"></div>
                            <div class="mr-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-code text-green-600 text-xl"></i>
                                </div>
                            </div>

                           
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">RPL 3</h3>
                                    <p class="text-gray-500">Rekayasa Perangkat Lunak</p>

                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-400 mr-2">45 Siswa</span>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </a>
               

            <!-- Empty State -->
            <div id="emptyState" class="text-center py-12 hidden">
                <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-search text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ditemukan</h3>
                <p class="text-gray-500">Kelas yang Anda cari tidak ditemukan.</p>
            </div>
        </div>
    </div>

   <br>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const classItems = document.querySelectorAll('.class-item');
    const searchInput = document.getElementById('searchInput');
    const emptyState = document.getElementById('emptyState');

    // Filter button functionality
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-white', 'text-blue-600');
                btn.classList.add('bg-blue-400', 'text-white');
            });
            
            // Add active class to clicked button
            button.classList.add('active', 'bg-white', 'text-blue-600');
            button.classList.remove('bg-blue-400', 'text-white');
            
            const filter = button.getAttribute('data-filter');
            filterItems(filter);
        });
    });

    // Search functionality
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        
        if (searchTerm === '') {
            // If search is empty, apply current filter
            const activeFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
            filterItems(activeFilter);
        } else {
            // Search through all items
            let hasResults = false;
            classItems.forEach(item => {
                const title = item.querySelector('h3').textContent.toLowerCase();
                const description = item.querySelector('p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    showItem(item);
                    hasResults = true;
                } else {
                    hideItem(item);
                }
            });
            
            toggleEmptyState(!hasResults);
        }
    });

    // Filter items based on category
    function filterItems(filter) {
        let hasResults = false;
        
        classItems.forEach(item => {
            if (filter === 'semua') {
                showItem(item);
                hasResults = true;
            } else {
                const category = item.getAttribute('data-category');
                if (category === filter) {
                    showItem(item);
                    hasResults = true;
                } else {
                    hideItem(item);
                }
            }
        });
        
        toggleEmptyState(!hasResults);
    }

    // Show item with animation
    function showItem(item) {
        item.style.display = 'block';
        setTimeout(() => {
            item.classList.add('fade-in');
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 50);
    }

    // Hide item with animation
    function hideItem(item) {
        item.style.opacity = '0';
        item.style.transform = 'translateY(-10px)';
        item.classList.remove('fade-in');
        setTimeout(() => {
            item.style.display = 'none';
        }, 300);
    }

    // Toggle empty state
    function toggleEmptyState(show) {
        if (show) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    // Add click animation to class items
    classItems.forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 100);
            
            // Add your navigation logic here
            console.log('Navigating to:', this.querySelector('h3').textContent);
        });
    });

    // Initialize styles
    classItems.forEach((item, index) => {
        item.style.transition = 'all 0.3s ease';
        item.style.opacity = '1';
        item.style.transform = 'translateY(0)';
    });
});
</script>
@endpush
@endsection