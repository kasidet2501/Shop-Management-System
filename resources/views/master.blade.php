<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield("title", "BikeShop | จําหน่ายอะไหล่จักรยานออนไลน์")</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
</head>
<body>
    
    <nav class="navbar navbar-default navbar-static-top">

        
            <div class="navbar-header">
                <a class="navbar-brand" href="#" > BikeShop</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">หน้าแรก</a></li>
                    <li><a href="#">ข้อมูลสินค้า</a></li>
                    <li><a href="#">รายงาน</a></li>
                </ul>
            </div>

        
    </nav> @yield("content")
    {{-- <div class="container">
        <div class="row">

            <div class="col-md-2">main</div>
            <div class="col-md-10">sidebar</div>

        </div>
    </div> --}}

    
    {{-- <nav class="navbar navbar-default navbar-static-top">

        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#" >BikeShop</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">หน้าแรก</a></li>
                    <li><a href="#">ข้อมูลสินค้า</a></li>
                    <li><a href="#">รายงาน</a></li>
                </ul>
            </div>

        </div>
    </nav>


    <div class="panel panel-danger">

        <div class="panel-heading">
            <div class="panel-title">
                <strong>หัวข้อ</strong>
            </div>
        </div>

        <div class="panel-body">
            ใส่เนื้อหาที่นี่
        </div>

    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>รหัสสินค้า </th>
                <th>ชื่อสินค้า </th>
                <th>ราคาขาย</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>P001</td>
                <td>ชุดจักรยาน ขนาด XL</td>
                <td>2500.00</td>
            </tr>
            <tr>
                <td>P002</td>
                <td>หมวกกันน็อก รุ่น DL330</td>
                <td>1500.00</td>
            </tr>
            <tr>
                <td>P003</td>
                <td>ชุดเกียร์Shimano รุ่น SH-001</td>
                <td>4500.00</td>
            </tr>
        </tbody>
    </table>


    <a href="#" class="btn btn-default">Default</a>
    <a href="#" class="btn btn-primary">Primary</a>
    <a href="#" class="btn btn-info">Info</a>
    <a href="#" class="btn btn-success">Success</a>
    <a href="#" class="btn btn-warning">Warning</a>
    <a href="#" class="btn btn-danger">Danger</a>

    <br><br>

    form-group แนวตั้ง
    <div class="form-group">
        <label>ชื่อ-นามสกุล</label>
        <input type="text" class="form-control">
        <div class="help-block">กรุณากรอกชื่อ-นามสกุล</div>
    </div>
    <div class="form-group">
        <label>ที่อยู่</label>
        <textarea rows="4" class="form-control"></textarea>
        <div class="help-block">กรุณากรอกที่อยู่</div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary">เพิ่มข้อมูล</button>
    </div>

    <br><br>


    การจัดเลย์เอาต์โดยใช้ form-inline แนวนอน

    <div class="form-inline">
        <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" >
        <input type="password" class="form-control" placeholder="รหัสผ่าน">
        <button class="btn btn-primary">เข้าสู่ระบบ</button>
    </div>

    <br><br> --}}
{{-- 
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>Success</strong> ข้อความ
    </div>
    <div class="alert alert-info alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>Info</strong> ข้อความ
    </div>
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>Warning</strong> ข้อความ
    </div>
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>Danger</strong> ข้อความ
    </div> --}}

    {{-- Font awesome --}}
    {{-- <a href="#" class="btn btn-default" ><i class="fa fa-home"></i> หน้าหลัก </a>
    <a href="#" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</a>
    <a href="#" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
    
    
    <button type="button" class="btn btn-danger" id="button"><i class="fa fa-trash"></i>click alert!</button>

    <script>
        $('#button').on('click', function(){
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
                toastr["error"]("Data", "Failed")
        })
    </script> --}}

    {{-- Toastr --}}
    {{-- <script type="text/javascript">
        toastr.success("บันทึกข้อมูลสำเร็จ");
        toastr.error("ไม่สามารถบันทึกข้อมูลได้" );
    </script> --}}


    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/4deb1ddbfc.js" crossorigin="anonymous"></script>
    
    {{-- Bootstrap --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    {{-- <script src="toastr.min.js"></script> --}}

</body>
</html>