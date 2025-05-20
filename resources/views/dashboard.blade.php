<x-App-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- بطاقة الفنادق -->
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">2</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">الفنادق</div>
                </div>
                <div class="dropdown relative">
                    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i
                            class="ri-more-fill"></i></button>
                    <ul
                        class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px] absolute right-0 mt-2">
                        <li><a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الملف
                                الشخصي</a>
                        </li>
                        <li><a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الإعدادات</a>
                        </li>
                        <li><a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">تسجيل
                                الخروج</a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="/gebruikers" class="text-[#f84525] font-medium text-sm hover:text-red-800">عرض</a>
        </div>

        <!-- بطاقة المندوبين -->
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">a</div>
                        <div
                            class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">
                            +30%</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">المندوبين</div>
                </div>
                <div class="dropdown relative">
                    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i
                            class="ri-more-fill"></i></button>
                    <ul
                        class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px] absolute right-0 mt-2">
                        <li><a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الملف
                                الشخصي</a>
                        </li>
                        <li><a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الإعدادات</a>
                        </li>
                        <li><a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">تسجيل
                                الخروج</a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="a" class="text-[#f84525] font-medium text-sm hover:text-red-800">عرض</a>
        </div>

        <!-- بطاقة الطرود -->
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ count($parcels) }}</div>
                    <div class="text-sm font-medium text-gray-400">الطرود</div>
                </div>
                <div class="dropdown relative">
                    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i
                            class="ri-more-fill"></i></button>
                    <ul
                        class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px] absolute right-0 mt-2">
                        <li><a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الملف
                                الشخصي</a>
                        </li>
                        <li><a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الإعدادات</a>
                        </li>
                        <li><a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">تسجيل
                                الخروج</a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('user.parcels.index') }}"
                class="text-[#f84525] font-medium text-sm hover:text-red-800">عرض</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- جدول الفنادق -->
        <div
            class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
            <div class="rounded-t mb-0 px-0 border-0">
                <div class="flex flex-wrap items-center px-4 py-2">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">الفنادق</h3>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    الدور
                                </th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    العدد
                                </th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-gray-700 dark:text-gray-100">
                                <th
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    المسؤول
                                </th>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    1
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2">70%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                <div style="width: 70%"
                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-100">
                                <th
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    مستخدم
                                </th>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    6
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2">40%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                <div style="width: 40%"
                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-100">
                                <th
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    ضيف
                                </th>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    12
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2">60%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                <div style="width: 60%"
                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-400">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-100">
                                <th
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    محرر
                                </th>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    a
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                        <span class="mr-2">10%</span>
                                        <div class="relative w-full">
                                            <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                <div style="width: 10%"
                                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-700">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- جدول الأنشطة -->
        <div
            class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
            <div class="rounded-t mb-0 px-0 border-0">
                <div class="flex flex-wrap items-center px-4 py-2">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">الأنشطة</h3>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    المستخدم
                                </th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    الدور
                                </th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    النشاط
                                </th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    الوقت
                                </th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    الإجراءات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-gray-700 dark:text-gray-100">
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    جين كوبر
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    المسؤول
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    أنشأ مستخدم جديد
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    2023-08-28 12:54
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="dropdown relative">
                                        <button
                                            class="dropdown-toggle block w-full bg-white hover:bg-gray-100 text-gray-600 border border-gray-200 rounded-md px-3 py-1 text-left text-sm"
                                            type="button" id="actions-menu-1" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px] absolute right-0 mt-2"
                                            aria-labelledby="actions-menu-1" role="menu">
                                            <li>
                                                <a href="#"
                                                    class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50"
                                                    role="menuitem">تعديل</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50"
                                                    role="menuitem">حذف</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <tr class="text-gray-700 dark:text-gray-100">
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    كودي فيشر
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    مستخدم
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    تسجيل دخول
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    2023-08-28 10:32
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="dropdown relative">
                                        <button
                                            class="dropdown-toggle block w-full bg-white hover:bg-gray-100 text-gray-600 border border-gray-200 rounded-md px-3 py-1 text-left text-sm"
                                            type="button" id="actions-menu-2" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px] absolute right-0 mt-2"
                                            aria-labelledby="actions-menu-2" role="menu">
                                            <li>
                                                <a href="#"
                                                    class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50"
                                                    role="menuitem">تعديل</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50"
                                                    role="menuitem">حذف</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Basic dropdown toggle script
        document.querySelectorAll('.dropdown-toggle').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const menu = button.nextElementSibling;
                if (!menu) return;
                menu.classList.toggle('hidden');
                const expanded = button.getAttribute('aria-expanded') === 'true';
                button.setAttribute('aria-expanded', !expanded);
            });
        });

        // Optional: Close dropdowns when clicking outside
        window.addEventListener('click', e => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.classList.contains('hidden') && !menu.contains(e.target) && !menu
                    .previousElementSibling.contains(e.target)) {
                    menu.classList.add('hidden');
                    menu.previousElementSibling.setAttribute('aria-expanded', 'false');
                }
            });
        });
    </script>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">إحصائيات الطلبات</div>
                <div class="dropdown">
                    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i
                            class="ri-more-fill"></i></button>
                    <ul
                        class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الملف
                                الشخصي</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الإعدادات</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">تسجيل
                                خروج</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <div class="rounded-md border border-dashed border-gray-200 p-4">
                    <div class="flex items-center mb-0.5">
                        <div class="text-xl font-semibold">
                            {{ count($parcels->whereIn('status', ['pending', 'in_transit'])) }}</div>
                        <span
                            class="p-1 rounded text-[12px] font-semibold bg-blue-500/10 text-blue-500 leading-none ml-1">$80</span>
                    </div>
                    <span class="text-gray-400 text-sm">نشط</span>
                </div>
                <div class="rounded-md border border-dashed border-gray-200 p-4">
                    <div class="flex items-center mb-0.5">
                        <div class="text-xl font-semibold">{{ count($parcels->where('status', 'delivered')) }}</div>
                        <span
                            class="p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">+$469</span>
                    </div>
                    <span class="text-gray-400 text-sm">مكتمل</span>
                </div>
                <div class="rounded-md border border-dashed border-gray-200 p-4">
                    <div class="flex items-center mb-0.5">
                        <div class="text-xl font-semibold">{{ count($parcels->where('status', 'canceled')) }}</div>
                        <span
                            class="p-1 rounded text-[12px] font-semibold bg-rose-500/10 text-rose-500 leading-none ml-1">-$130</span>
                    </div>
                    <span class="text-gray-400 text-sm">ملغى</span>
                </div>
            </div>
            <div>
                <canvas id="order-chart"></canvas>
            </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">الأرباح</div>
                <div class="dropdown">
                    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i
                            class="ri-more-fill"></i></button>
                    <ul
                        class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الملف
                                الشخصي</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">الإعدادات</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">تسجيل
                                خروج</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[460px]">
                    <thead>
                        <tr>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                الخدمة</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                الربح</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <img src="https://placehold.co/32x32" alt=""
                                        class="w-8 h-8 rounded object-cover block">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">إنشاء
                                        صفحة هبوط</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-emerald-500">+$235</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="inline-block p-1 rounded bg-emerald-500/10 text-emerald-500 font-medium text-[12px] leading-none">معلق</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <img src="https://placehold.co/32x32" alt=""
                                        class="w-8 h-8 rounded object-cover block">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">إنشاء
                                        صفحة هبوط</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-rose-500">-$235</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="inline-block p-1 rounded bg-rose-500/10 text-rose-500 font-medium text-[12px] leading-none">تم
                                    السحب</span>
                            </td>
                        </tr>
                        <!-- نفس تكرار الصفوف كما هو -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </x-AdminApp-layout>
