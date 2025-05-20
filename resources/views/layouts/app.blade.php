<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Hotel Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="text-gray-800 font-inter">
    @include('layouts.sidebar')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">
        <!-- navbar -->
        @include('layouts.navigation')
        <!-- end navbar -->

        <!-- Content -->
        <div class="p-6">
            @if ($errors->any())
                <div class = "absolute z-40 top-10 w-auto  right-2  p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                    role="alert">
                    <span class = "font-medium">Danger alert!</span> {{ implode(' | ', $errors->all()) }}

                </div>
            @endif
            @if (session('status'))
                <div class = "  absolute z-40 top-10 w-auto right-2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert">
                    <span class = "font-medium">Success ! {{ session('status') }}</span>

                </div>
            @endif
            {{ $slot }}
        </div>
        <!-- End Content -->
    </main>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // start: Sidebar

        $('select').addClass(
            ' w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 '
        );
        @if (!request()->routeIs('dashboard'))

            const table = $('#invoice-table');

            if (!table.length) {
                console.warn("Table not found.");
            }

            // Initialize DataTable
            const dataTable = table.DataTable({
                "scrollX": true,
                // stateSave: false,
                // dom: 'Bfrtip',
                // buttons: [
                //     'print', 'excel', 'pdf', 'csv', 'copy',
                // ]
            }); // DataTables instance

            // Get number of columns
            const columnCount = dataTable.columns().header().length;

            // Create filters before the table
            const filterContainer = $('<div id="filters" class="flex flex-wrap gap-4 m-4"></div>');
            $('#invoice-table_wrapper').before(filterContainer);

            // Loop through each column except the last
            for (let colIdx = 0; colIdx < columnCount - 1; colIdx++) {
                // Get the column header name
                const columnName = $(dataTable.column(colIdx).header()).text().trim();

                // Create a wrapper for the label and select
                const $wrapper = $('<div class="flex flex-col text-sm"></div>');

                // Create label
                const $label = $(`<label class="mb-1 font-medium text-gray-700">${columnName}</label>`);

                // Create select
                const $select = $(`<select class="border px-2 py-1 rounded text-sm">
                                        <option value="">All</option>
                                    </select>`);

                // Get unique values from the column
                const cellValues = new Set();
                $('#invoice-table tbody tr').each(function() {
                    const cell = $(this).find('td').eq(colIdx);
                    const text = cell.text().trim();
                    if (text) {
                        cellValues.add(text);
                    }
                });

                // Sort and append options
                Array.from(cellValues).sort().forEach(value => {
                    $select.append(`<option value="${value}">${value}</option>`);
                });

                // Append label and select to wrapper, then wrapper to filter container
                $wrapper.append($label).append($select);
                filterContainer.append($wrapper);

                // Filter on change
                $select.on('change', function() {
                    const val = $.fn.dataTable.util.escapeRegex($(this).val());
                    dataTable.column(colIdx).search(val ? '^' + val + '$' : '', true, false).draw();
                });
            }
        @endif
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('input[type="password"]').forEach(function(input) {
                // Create eye icon wrapper
                const wrapper = document.createElement('div');
                wrapper.classList.add('relative');

                // Clone the input and insert into wrapper
                const clonedInput = input.cloneNode(true);
                input.replaceWith(wrapper);
                wrapper.appendChild(clonedInput);

                // Create the toggle icon
                const toggleIcon = document.createElement('span');
                toggleIcon.innerHTML = '👁️'; // You can use a better SVG/icon if needed
                toggleIcon.classList.add(
                    'absolute', 'right-2', 'top-1/2', '-translate-y-1/2', 'cursor-pointer'
                );
                wrapper.appendChild(toggleIcon);

                // Toggle logic
                toggleIcon.addEventListener('click', () => {
                    if (clonedInput.type === 'password') {
                        clonedInput.type = 'text';
                        toggleIcon.innerHTML = '🙈'; // icon changes when visible
                    } else {
                        clonedInput.type = 'password';
                        toggleIcon.innerHTML = '👁️';
                    }
                });
            });
        });

        const navigationbutton = document.querySelector('.navigationbutton')
        const sidebarToggle = document.querySelector('.sidebarbutton')

        const sidebarOverlay = document.querySelector('.sidebar-overlay')
        const sidebarMenu = document.querySelector('.sidebar-menu')
        const main = document.querySelector('.main')
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault()
            main.classList.toggle('active')
            sidebarOverlay.classList.toggle('hidden')
            sidebarMenu.classList.toggle('-translate-x-full')
        })
        sidebarOverlay.addEventListener('click', function(e) {
            e.preventDefault()
            main.classList.add('active')
            sidebarOverlay.classList.add('hidden')
            sidebarMenu.classList.add('-translate-x-full')
        })
        document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault()
                const parent = item.closest('.group')
                if (parent.classList.contains('selected')) {
                    parent.classList.remove('selected')
                } else {
                    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(i) {
                        i.closest('.group').classList.remove('selected')
                    })
                    parent.classList.add('selected')
                }
            })
        })
        navigationbutton.addEventListener('click', function(e) {
            e.preventDefault()
            main.classList.toggle('active')
            sidebarOverlay.classList.toggle('hidden')
            sidebarMenu.classList.toggle('-translate-x-full')
        })
        // end: Sidebar



        // start: Popper
        const popperInstance = {}
        document.querySelectorAll('.dropdown').forEach(function(item, index) {
            const popperId = 'popper-' + index
            const toggle = item.querySelector('.dropdown-toggle')
            const menu = item.querySelector('.dropdown-menu')
            menu.dataset.popperId = popperId
            popperInstance[popperId] = Popper.createPopper(toggle, menu, {
                modifiers: [{
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                    {
                        name: 'preventOverflow',
                        options: {
                            padding: 24,
                        },
                    },
                ],
                placement: 'bottom-end'
            });
        })
        document.addEventListener('click', function(e) {
            const toggle = e.target.closest('.dropdown-toggle')
            const menu = e.target.closest('.dropdown-menu')
            if (toggle) {
                const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
                const popperId = menuEl.dataset.popperId
                if (menuEl.classList.contains('hidden')) {
                    hideDropdown()
                    menuEl.classList.remove('hidden')
                    showPopper(popperId)
                } else {
                    menuEl.classList.add('hidden')
                    hidePopper(popperId)
                }
            } else if (!menu) {
                hideDropdown()
            }
        })

        function hideDropdown() {
            document.querySelectorAll('.dropdown-menu').forEach(function(item) {
                item.classList.add('hidden')
            })
        }

        function showPopper(popperId) {
            popperInstance[popperId].setOptions(function(options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        {
                            name: 'eventListeners',
                            enabled: true
                        },
                    ],
                }
            });
            popperInstance[popperId].update();
        }

        function hidePopper(popperId) {
            popperInstance[popperId].setOptions(function(options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        {
                            name: 'eventListeners',
                            enabled: false
                        },
                    ],
                }
            });
        }
        // end: Popper



        // start: Tab
        document.querySelectorAll('[data-tab]').forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault()
                const tab = item.dataset.tab
                const page = item.dataset.tabPage
                const target = document.querySelector('[data-tab-for="' + tab + '"][data-page="' + page +
                    '"]')
                document.querySelectorAll('[data-tab="' + tab + '"]').forEach(function(i) {
                    i.classList.remove('active')
                })
                document.querySelectorAll('[data-tab-for="' + tab + '"]').forEach(function(i) {
                    i.classList.add('hidden')
                })
                item.classList.add('active')
                target.classList.remove('hidden')
            })
        })
        // end: Tab



        // start: Chart
        @if (Route::current()->getName() == 'dashboard')
            new Chart(document.getElementById('order-chart'), {
                type: 'line',
                data: {
                    labels: generateNDays(7),
                    datasets: [{
                            label: 'Active',
                            data: generateRandomData(7),
                            borderWidth: 1,
                            fill: true,
                            pointBackgroundColor: 'rgb(59, 130, 246)',
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgb(59 130 246 / .05)',
                            tension: .2
                        },
                        {
                            label: 'Completed',
                            data: generateRandomData(7),
                            borderWidth: 1,
                            fill: true,
                            pointBackgroundColor: 'rgb(16, 185, 129)',
                            borderColor: 'rgb(16, 185, 129)',
                            backgroundColor: 'rgb(16 185 129 / .05)',
                            tension: .2
                        },
                        {
                            label: 'Canceled',
                            data: generateRandomData(7),
                            borderWidth: 1,
                            fill: true,
                            pointBackgroundColor: 'rgb(244, 63, 94)',
                            borderColor: 'rgb(244, 63, 94)',
                            backgroundColor: 'rgb(244 63 94 / .05)',
                            tension: .2
                        },
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            function generateNDays(n) {
                const data = []
                for (let i = 0; i < n; i++) {
                    const date = new Date()
                    date.setDate(date.getDate() - i)
                    data.push(date.toLocaleString('en-US', {
                        month: 'short',
                        day: 'numeric'
                    }))
                }
                return data
            }

            function generateRandomData(n) {
                const data = []
                for (let i = 0; i < n; i++) {
                    data.push(Math.round(Math.random() * 10))
                }
                return data
            }
        @endif



        // end: Chart
    </script>
    <script>
        function exportToExcel() {
            const table = document.getElementById("invoice-table"); // adjust ID
            const workbook = XLSX.utils.table_to_book(table, {
                sheet: "Invoice"
            });
            XLSX.writeFile(workbook, "invoice.xlsx");
        }
    </script>
    <script>
        async function exportToPDF(htmlString) {
            const {
                jsPDF
            } = window.jspdf;
            const pdf = new jsPDF();

            // Create a temporary container
            const tempDiv = document.createElement('div');

            tempDiv.style.position = 'fixed'; // keep it offscreen
            tempDiv.style.left = '-9999px';
            tempDiv.style.padding = '10px';
            tempDiv.style.display = 'flex';
            tempDiv.style.alignItems = 'center';
            tempDiv.style.justifyContent = 'center';
            tempDiv.style.flexDirection = 'column';
            tempDiv.style.width = '900px';

            tempDiv.innerHTML = htmlString;

            // Append to body so styles apply (optional but recommended)
            document.body.appendChild(tempDiv);

            // Select the element to convert (e.g. the whole invoice)
            const invoiceElement = tempDiv.querySelector('html') || tempDiv;



            // Use html2canvas on this element
            await html2canvas(invoiceElement).then(canvas => {
                const imgData = canvas.toDataURL("image/png");
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth() - 10;
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save("invoice.pdf");
            });

            // Clean up
            document.body.removeChild(tempDiv);
        }

        function setEqualColumnWidths(tableHtml) {
            const tempContainer = document.createElement('div');
            tempContainer.innerHTML = tableHtml;

            const table = tempContainer.querySelector('table');
            const headerRow = table.querySelector('tr');
            const colCount = headerRow ? headerRow.children.length : 0;

            if (colCount > 0) {
                const colWidth = 800 / colCount;
                table.style.width = '100%';
                table.style.tableLayout = 'fixed';

                table.querySelectorAll('th, td').forEach(cell => {
                    cell.style.width = `${colWidth}px`;
                    cell.style.wordWrap = 'break-word';
                    cell.style.whiteSpace = 'normal';
                    cell.style.padding = '6px';
                    cell.style.fontSize = '12px';
                    cell.style.border = '1px solid #ccc';
                });
            }

            return table.outerHTML;
        }
    </script>
    <script>
        document.querySelectorAll('.generate-pdf').forEach(e => {

            e.addEventListener('click', function() {
                const elementId = this.getAttribute('data-id');
                const type = this.getAttribute('data-type');

                const element = document.querySelector(`#${elementId}`);
                if (!element) return alert("Element not found");

                let contentHtml = '';
                let colWidth = 800;

                if (type === 'table') {
                    const clonedTable = element.cloneNode(true);

                    // Remove styles and classes
                    clonedTable.querySelectorAll('*').forEach(el => {
                        el.removeAttribute('style');
                        el.removeAttribute('class');
                    });

                    // Remove last column
                    clonedTable.querySelectorAll('tr').forEach(row => {
                        const cells = row.querySelectorAll('th, td');
                        if (cells.length > 1) {
                            row.removeChild(cells[cells.length - 1]);
                        }
                    });

                    // Calculate and set column width
                    const firstRow = clonedTable.querySelector('tr');
                    const colCount = firstRow ? firstRow.children.length : 1;
                    colWidth = 800 / colCount;

                    clonedTable.querySelectorAll('th, td').forEach(cell => {
                        cell.style.width = `${colWidth}px`;
                        cell.style.wordWrap = 'break-word';
                        cell.style.whiteSpace = 'normal';
                    });

                    contentHtml = clonedTable.outerHTML;
                } else {
                    // Use the raw div/html content without modifications
                    contentHtml = element.outerHTML;
                }

                const formData = new FormData();
                formData.append('table_html', contentHtml);
                formData.append('name', 'Test Customer');
                formData.append('adress', 'Hurghada, Egypt');
                formData.append('invoiceid', 'INV-123');
                formData.append('invoicedate', new Date().toISOString().slice(0, 10));
                formData.append('total', '150.00');
                formData.append('col_width', colWidth);
                formData.append('type', type);

                fetch('{{ url('/invoice/generate') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData,
                    })
                    .then(response => response.text())
                    .then(html => {
                        console.log(html);
                        exportToPDF(html);
                    })
                    .catch(console.error);
            });
        })
    </script>

    {{-- <script>
        document.getElementById('generate-pdf').addEventListener('click', function() {
            const table = document.querySelector('#invoice-table'); // Adjust selector
            if (!table) {
                alert("Table not found");
                return;
            }

            const removeCols = 1;

            // Clone the table to safely modify it without changing the original
            const clonedTable = table.cloneNode(true);

            // Loop through each row (thead, tbody, tfoot if any)
            [...clonedTable.rows].forEach(row => {
                for (let i = 0; i < removeCols; i++) {
                    row.deleteCell(-1); // Remove last column
                }
            });

            // Convert the cleaned table to HTML
            const tableHtml = clonedTable.outerHTML;

            const formData = new FormData();
            formData.append('name', 'Test Hotel');
            formData.append('adress', 'Hurghada, Egypt');
            formData.append('invoiceid', 'AJAX001');
            formData.append('invoicedate', new Date().toISOString().slice(0, 10));
            formData.append('total', '100.00');
            formData.append('table_html', tableHtml); // send the modified table only

            fetch("{{ url('/generate-invoice-pdf') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => response.blob())
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = "invoice.pdf";
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                })
                .catch(error => {
                    console.error("PDF generation failed:", error);
                });
        });
    </script> --}}
</body>

</html>
