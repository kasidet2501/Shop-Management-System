<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', 'BikeShop | จําหน่ายอะไหล่จักรยานออนไลน์')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
</head>

<body>

    <nav class="navbar navbar-default navbar-static-top">


        <div class="navbar-header">
            <a class="navbar-brand" href="#"> <i class="fa-sharp fa-solid fa-person-biking fa-bounce fa-2xl"
                    style="color: #005eff;"></i></a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">หน้าแรก</a></li>
                <li><a href="{{ URL::to('product') }}">ข้อมูลสินค้า </a></li>
                <li><a href="{{ URL::to('category') }}">ข้อมูลประเภทสินค้า </a></li>
                <li><a href="#">รายงาน</a></li>
            </ul>
        </div>


    </nav>

    <center>
        <h2><u>นายกษิดิ์เดช บุณยศักดานนท์ 6406021622141</u></h2>
    </center>

    @yield('content')

    <!-- js -->
    @if (session('msg'))
        @if (session('ok'))
            <script>
                toastr.success("{{ session('msg') }}")
            </script>
        @else
            <script>
                toastr.error("{{ session('msg') }}")
            </script>
        @endif
    @endif


    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/4deb1ddbfc.js" crossorigin="anonymous"></script>

    {{-- Bootstrap --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    {{-- <script src="toastr.min.js"></script> --}}

</body>

</html>
