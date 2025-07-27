<!DOCTYPE html>
<html lang="en">


<head>
    <title>Company Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/frontend/images/logo-light.png') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="{{ asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet">
    <link class="main-css" href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body>

    @include('companydashboard.layouts.header')

    @include('companydashboard.layouts.sidebar')

    <main>
        @yield('content')
    </main>

    @include('companydashboard.layouts.footer')


</body>

</html>
