<!-- Sidebar -->
        <div class="w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0 z-10">
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white font-bold">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">Sikapin</h1>
                        <p class="text-xs text-gray-500">Sistem Skoring</p>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="mt-8">
                    <ul class="space-y-2">
                        <li>
                         <a href="{{ route('wakasek.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-blue-600 bg-blue-50 rounded-lg">
                                <i class="bi bi-house"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('siswa.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                                <i class="bi bi-people"></i>
                                <span>Siswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                                <i class="bi bi-award"></i>
                                <span>Apresiasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                                <i class="bi bi-exclamation-triangle"></i>
                                <span>Pelanggaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                                <i class="bi bi-bar-chart"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>