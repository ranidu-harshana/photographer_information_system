<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}"> --}}
    <title></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/calendar.css') }}">
</head>

<body>
    <div class="main-wrapper">
        <x-admin-top-nav></x-admin-top-nav>
        <x-admin-side-bar></x-admin-side-bar>
        <div class="page-wrapper">
            <div class="content">
                @yield('content')
            </div>
            
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>     
    <script>
        $(document).ready(function() {
            $('#all-items-datatable').DataTable();
        } );

        $(document).ready(function() {
            $('#all-packages-datatable').DataTable();
        } );

        // $(document).ready(function() {
        //     $('#all_items_datatable').DataTable();
        // } );

        // $(document).ready(function() {
        //     $('#all_reserved_items_datatable').DataTable({
        //         "order": [[ 0, "desc" ]]
        //     });
        // } );
    </script>
    <div class="sidebar-overlay" data-reff=""></div>
	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>
</html>