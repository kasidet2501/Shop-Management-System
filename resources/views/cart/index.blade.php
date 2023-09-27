@extends('master') @section('title') BikeShop | ตะกร้าสินค้า @stop
@section('content')
    <div class="container-fluid">
        <h1>สินค้าในตะกร้า</h1>
        <div class="breadcrumb">
            <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
            <li class="active">สินค้าในตะกร้า</li>
        </div>

        <div class="panel panel-default">
            @if (count($cart_items))
                <?php $sum_price = 0; ?>
                <?php $sum_qty = 0; ?>

                <table class="table bs-table">
                    <thead>
                        <tr>
                            <th width="100px">รูปสินค้า </th>
                            <th width="100px">รหัส</th>
                            <th width="500px">ชื่อสินค้า </th>
                            <th width="200px">จํานวน</th>
                            <th width="100px">ราคา</th>
                            <th width="50px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart_items as $c)
                            <tr>
                                <td>
                                    <center><img src="{{ asset($c['image_url']) }}" height="40"></center>
                                </td>
                                <td>{{ $c['code'] }}</td>
                                <td>{{ $c['name'] }}</td>
                                <td><input type="text" class="form-control form-control-sm" value="{{ $c['qty'] }}"
                                        onKeyUp="updateCart({{ $c['id'] }}, this)"></td>
                                {{-- updateCart ในที่นี้ไม่ได้ไปที่ Controller แต่จะไปที่ script ที่ด้านล่างโดยจะส่ง parameterไป 2 ตัว --}}
                                {{-- this คือค่าใน tag นั้นๆ ในที่นี้คือ value="{{ $c['qty'] }} --}}
                                <td>{{ number_format($c['price'], 0) }}</td>

                                <td>
                                    <a href="{{ URL::to('cart/delete/' . $c['id']) }}" class="btn btn-danger"><i
                                            class="fa fa-times"></i></a>
                                </td>

                            </tr>
                            <?php $sum_price += $c['price']; ?>
                            <?php $sum_qty += $c['qty']; ?>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">รวม</th>
                            <th>{{ number_format($sum_qty, 0) }}</th>
                            <th>{{ number_format($sum_price, 0) }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            @else
                <div class="panel-body"><strong>ไม่พบรายการสินค้า !</strong></div>
            @endif
        </div>

        <!-- buttons -->
        <a href="{{ URL::to('/home') }}" class="btn btn-default">ย้อนกลับ </a>

        <div class="pull-right">
            <a href="{{ URL::to('cart/checkout') }}" class="btn btn-primary">ชําระเงิน <i
                    class="fa fa-chevron-right"></i></a>
        </div>

    </div>

    <script>
        function updateCart(id, qty) {
            window.location.href = '/cart/update/' + id + '/' + qty.value;
        }
    </script>


@endsection
