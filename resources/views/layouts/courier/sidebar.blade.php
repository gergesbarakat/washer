 <!--sidenav -->

 <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
     <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">

         <h2 class="font-bold text-2xl">Washer </h2>
     </a>
     <ul class="mt-4">
         <span class="text-gray-400 font-bold">courier</span>
         <li class="mb-1 group">
             <a href="{{ route('dashboard') }}"
                 class="flex {{ request()->routeIs('dashboard') ? 'text-white bg-gray-950' : '' }} font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                 <i class="ri-home-2-line mr-3 text-lg"></i>
                 <span class="text-sm">Dashboard</span>
             </a>
         </li>



         <span class="text-gray-400 font-bold">PERSONAL</span>
         <li class="mb-1 group">
             <a href=""
                 class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                 <i class='bx bx-bell mr-3 text-lg'></i>
                 <span class="text-sm">Notifications</span>
                 <span
                     class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
             </a>
         </li>
         {{-- <li class="mb-1 group">
             <a href=""
                 class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                 <i class='bx bx-envelope mr-3 text-lg'></i>
                 <span class="text-sm">Messages</span>
                 <span
                     class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-green-600 bg-green-200 rounded-full">2
                     New</span>
             </a>
         </li> --}}
     </ul>
 </div>
 <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
 <!-- end sidenav -->
