@extends('master')
@section('title') BikeShop | รายการประเภทสินค้า @stop

@section('content')

    <div class="container">
        <h1>รายการประเภทสินค้า</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><strong>รายการ</strong></div>
            </div>
            <div class="panel-body">
                <!-- search form -->
                <form action="{{ URL::to('category/search') }}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <input type="text" name="q" class="form-control" placeholder="พิมพ์รหัสหรือชื่อเพื่อค้นหา">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>

                    <a href="{{ URL::to('category/edit') }}" class="btn btn-success pull-right">เพิ่มสินค้า</a>
                </form>
            </div>

            <table class="table table-bordered bs-table">
                <thead>
                    <tr>
                        <th>รหัสประเภทสินค้า </th>
                        <th>ชื่อประเภทสินค้า</th>
                        <th>การทํางาน</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ตัวแปร products ที่ถูกส่งมาจาก controller ไงครับ --}}
                    @foreach ($categorys as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->name }}</td>
                            <td class="bs-center">
                                <a href="{{ URL::to('category/edit/' . $c->id) }}" class="btn btn-info"><i
                                        class="fa fa-edit"></i> แก้ไข</a>
                                <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $c->id }}"><i
                                        class="fa fa-trash"></i> ลบ</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="panel-footer">
                <span>แสดงข้อมูลจํานวน {{ count($categorys) }} รายการ</span>
            </div>
        </div>

        {{ $categorys->links() }}
    </div>


    <script>
        // ใช้เทคนิค jQuery
        $('.btn-delete').on('click', function() {
            if (confirm("คุณต้องการลบข้อมูลประเภทสินค้าหรือไม่?")) {
                var url = "{{ URL::to('category/remove') }}" + '/' + $(this).attr('id-delete');
                window.location.href = url;
            }
        });
    </script>

@endsection
