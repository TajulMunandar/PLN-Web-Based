<!doctype html>
<html lang="en">

<head>
    @include('dashboard.layouts.head')
    <title>Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        @include('dashboard.layouts.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <!--  Header Start -->
            @include('dashboard.layouts.navbar')
            <!--  Header End -->

            {{-- Content --}}
            <div class="container pt-5">
                @yield('content')
            </div>
            {{-- End Of Content --}}

        </div>
    </div>


    {{-- Script --}}
    @include('dashboard.layouts.script')
    {{-- End Of Script --}}
    @stack('js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                "scrollX": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search...",
                    "decimal": ",",
                    "thousands": "."
                }
            });
            $(document).ready(function() {
                $('.dataTables_filter input[type="search"]').css({
                    "marginBottom": "10px"
                });
                $('.dataTables_paginate ').css({
                    "marginTop": "10px"
                });
            });
        });
    </script>
</body>

</html>
