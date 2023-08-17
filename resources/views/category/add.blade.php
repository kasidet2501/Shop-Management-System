@extends('master')
@section('title') BikeShop | เพิ่มรายการประเภทสินค้า @stop

@section('content')


    <div class="container">
        <h1>เพิ่มรายการประเภทสินค้า </h1>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('category') }}">หน้าแรก</a></li>
            <li class="active">เพิ่มประเภทสินค้า </li>
        </ul>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>เพิ่มประเภทสินค้า </strong>
                </div>
            </div>
            <div class="panel-body">


                {!! Form::model($category, [
                    'action' => 'App\Http\Controllers\CategoryController@insert',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ]) !!}


                <table>
                    <tr>
                        <td>{{ Form::label('name', 'ชื่อประเภทสินค้า ') }}</td>
                        <td>{{ Form::text('name', '', ['class' => 'form-control']) }}</td>
                    </tr>
                </table>

            </div>
            <div class="panel-footer">
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> บันทึก</button>
            </div>
        </div>
    </div>

    {!! Form::close() !!}


@endsection
