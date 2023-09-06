@extends('master')
@section('title')
    BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง
@endsection

@section('content')
    {{-- <div class="container" ng-app="app" ng-controller="ctrl">
        <h1>@{ helloMessage }</h1>
        <input type="text" class="form-control" ng-model="helloMessage">
    </div> --}}
    <div class="container" ng-app="app" ng-controller="ctrl">
        <table class="table table-bordered" ng-if="products.length">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า </th>
                    <th>ราคาขาย</th>
                    <th>คงเหลือ</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tr ng-repeat="p in products">
                <td>@{p.code}</td>
                <td>@{p.name}</td>
                <td>@{p.price|number:2}</td>
                <td>@{p.qty|number:0}</td>
                <td>
                    <span ng-if="p.qty >= 5" ng-class="{'label label-primary': p.qty >= 5}">สินค้าเหลือเยอะเลย</span>
                    <span ng-if="p.qty > 0 && p.qty < 5"
                        ng-class="{'label label-warning': p.qty > 0 && p.qty < 5}">สินค้าใกล้หมด</span>
                    <span ng-if="p.qty == 0" ng-class="{'label label-danger': p.qty == 0}">สินค้าหมด</span>
                </td>
            </tr>
        </table>
        <h3 ng-if="!products.length">ไม่พบข้อมูลสินค้า </h3>

        <h1>@{ helloMessage }</h1>
    </div>
    {{-- <div class="container" ng-app="apple" ng-controller="ctrl2">
        <h1>@{ helloMessage }</h1>
        <input type="text" class="form-control" ng-model="helloMessage">
    </div> --}}

    {{-- <script type="text/javascript">
        var apple = angular.module('apple', []).config(function($interpolateProvider) {
            $interpolateProvider.startSymbol('@{').endSymbol('}');
        });
        apple.controller('ctrl2', function($scope) {
            $scope.helloMessage = 'Created By Mikey';
        });
    </script> --}}

    <script type="text/javascript">
        var app = angular.module('app', []).config(function($interpolateProvider) {
            $interpolateProvider.startSymbol('@{').endSymbol('}');
        });
        app.controller('ctrl', function($scope) {
            $scope.products = [{
                    'code': 'P001',
                    'name': 'ชุดแข่งสีดา Size L',
                    'price': 1500.00,
                    'qty': 5
                },
                {
                    'code': 'P002',
                    'name': 'หมวกันน็อกรุ่น SM-220',
                    'price': 1400.00,
                    'qty': 0
                },
                {
                    'code': 'P003',
                    'name': 'มิเตอร์วัดความเร็ว',
                    'price': 1450.00,
                    'qty': 2
                },
            ];
            $scope.helloMessage = 'Created By Mikey';
        });
    </script>
@endsection
