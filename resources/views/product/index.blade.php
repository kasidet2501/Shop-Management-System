@extends("master")
@section('title') BikeShop | รายการสินค้า @stop

@section('content')

    <div class="container">
        <table class="table table-bordered bs-table">
            <thead>
                <tr>
                    <th>รูปสินค้า </th>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า </th>
                    <th>ประเภท</th>
                    <th>คงเหลือ</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>การทํางาน</th>
                </tr>
            </thead>
            <tbody>
             {{-- ตัวแปร products ที่ถูกส่งมาจาก controller ไงครับ --}}
            @foreach($products as $p) 
                <tr> 
                    <td>{{ $p->image_url }}</td>
                    <td>{{ $p->code }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category->name }}</td>
                    <td class="bs-price">{{ number_format($p->stock_qty, 0) }}</td>
                    <td class="bs-price">{{ number_format($p->price, 2) }}</td>
                    <td class="bs-center">
                        <a href="#" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
                    </td>
                </tr> 
                @endforeach
                <tfoot>
                    <tr>
                        <th colspan="4">รวม</th>
                        <th class="bs-price">{{ number_format($products->sum('stock_qty'), 0) }}</th>
                        <th class="bs-price">{{ number_format($products->sum('price'), 2) }}</th>
                    </tr>
                </tfoot>
            </tbody>
        </table>


@endsection