<!--sidenav -->

<div class="fixed left-0 top-0 w-64 h-full bg-[rgb(255,255,255)] p-4 z-50 sidebar-menu transition-transform">
    <div class="flex justify-between items-center"><a href="#" class="flex items-center pb-4 border-b-gray-800">

            <h2 class="font-bold text-2xl">{{ env('APP_NAME', 'الشعار الابيض') }}</h2>
        </a>
        <button type="button" class="text-lg text-gray-900 lg:hidden sidebarbutton font-semibold sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
    </div>
    <ul class="mt-4">
        <span class="text-gray-400 font-bold">الإدارة</span>
        <li class="mb-1 group">
            <a href="{{ route('dashboard') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">لوحة التحكم</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('admin.branches.index') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <span class="text-sm">الفروع</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="{{ route('admin.branches.index') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">الكل</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.branches.create') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">إنشاء</a>
                </li>
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('admin.couriers.index') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <span class="text-sm">المندوبين</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="{{ route('admin.couriers.index') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">الكل</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.couriers.create') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">إنشاء</a>
                </li>
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('admin.hotels.index') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <span class="text-sm">الفنادق</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="{{ route('admin.hotels.index') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">الكل</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.hotels.create') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">إنشاء</a>
                </li>
            </ul>
        </li>
        <li class="mb-1 group">
            <div
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <span class="text-sm">التصنيفات</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </div>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="{{ route('admin.categories.index') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">الكل</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.categories.create') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">إنشاء</a>
                </li>
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('admin.products.index') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <span class="text-sm">المنتجات</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="{{ route('admin.products.index') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">الكل</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.products.create') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">إنشاء</a>
                </li>
            </ul>
        </li>

        <li class="mb-1 group">
            <a href="{{ route('admin.parcels.index') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <span class="text-sm">الشحنات</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="{{ route('admin.parcels.index') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">الكل</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('admin.parcels.create') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">إنشاء</a>
                </li>
            </ul>
        </li>

        <!--<span class="text-gray-400 font-bold">الشخصي</span>-->
        <!--<li class="mb-1 group">-->
        <!--    <a href=""-->
        <!--        class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">-->
        <!--        <i class='bx bx-bell mr-3 text-lg'></i>-->
        <!--        <span class="text-sm">الإشعارات</span>-->
        <!--        <span-->
        <!--            class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>-->
        <!--    </a>-->
        <!--</li>-->
        <!--<li class="mb-1 group">-->
        <!--    <a href=""-->
        <!--        class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">-->
        <!--        <i class='bx bx-envelope mr-3 text-lg'></i>-->
        <!--        <span class="text-sm">الرسائل</span>-->
        <!--        <span-->
        <!--            class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-green-600 bg-green-200 rounded-full">2-->
        <!--            جديد</span>-->
        <!--    </a>-->
        <!--</li>-->
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<!-- end sidenav -->
