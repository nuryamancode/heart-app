<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.png') }}" />
</head>

<body style="background-color: #f7f5f5">
    <div class="main-wrapper">
        @include('admin.base.sidebar')
        <div class="page-wrapper">
            @include('admin.base.navbar')
            <div class="page-content">
                @yield('page-content')
            </div>
            @include('admin.base.footer')
        </div>
    </div>
    @include('sweetalert::alert')
    <script src="{{ asset('assets/admin/vendors/core/core.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net/dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>
    <script src="{{ asset('assets/admin/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/admin/js/chat.js') }}"></script>

</body>

</html>
