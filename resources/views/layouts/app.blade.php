<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sarpras | @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    {{-- @vite(['resources/css/app/css', 'resources/js/app.js']) --}}

    <!-- ======= Link css ======= -->
    @include('layouts.link-css')
    <!--End link css -->

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <style>
        .hover {
            transition: transform .2s;
            /* Animation */
        }

        .hover:hover {
            transform: scale(0.9, 1);
            background-color: rgb(250, 250, 250);

        }

        .popover {
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .popover-close {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }

        .popover-btn {
            position: relative;
        }

        #popoverContent {
            position: absolute;
            top: 30px;
            /* Sesuaikan dengan jarak yang diinginkan */
            left: 30px;
            /* Sesuaikan dengan jarak yang diinginkan */
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .button-penguji {
            border: none;
            border-bottom: dashed 1px rgb(100, 100, 243);
            background: 0 0"

        }

        .popup-hidden {
            display: none;
        }
    </style>

</head>

<body>

    <!-- ======= Header ======= -->
    @include('layouts.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('layouts.sidebar')
    <!-- End Sidebar-->

    <!-- #content -->
    @yield('content')
    <!-- End #content -->

    <!-- ======= Footer ======= -->
    {{-- @include('layouts.footer') --}}
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- ======= Link js ======= -->
    @include('layouts.link-js')
    <!-- End link js -->

</body>

</html>
