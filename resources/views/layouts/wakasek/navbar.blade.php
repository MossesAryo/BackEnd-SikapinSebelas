 <div class="bg-white border-b border-gray-200 px-6 py-4">
     <div class="flex items-center justify-between">
         <div>
             <h1 class="text-2xl font-bold text-gray-900">SIKAPIN SEBELAS</h1>
             <p class="text-gray-600">Selamat datang di Sistem Skoring Sikapin</p>
         </div>
         <div class="flex items-center gap-4">
              <a href="{{ route('notifikasi.index') }}" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                 <i class="bi bi-bell text-xl"></i>
             </a>
             <a href="{{ route('wakasek.profile.profilewakasek') }}"
                 class="flex items-center gap-3 hover:bg-gray-100 px-2 py-1 rounded-lg">
                 <div
                     class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                        {{ strtoupper(substr(Auth::user()->wakasek->nama_wakasek, 0, 1)) }}
                 </div>
                 <span class="text-gray-700">@auth
                         {{ Auth::user()->wakasek->nama_wakasek }}
                     @endauth
                 </span>
             </a>
         </div>
     </div>
 </div>
