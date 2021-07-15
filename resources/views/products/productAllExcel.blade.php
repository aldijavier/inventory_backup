{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta name="viewport"--}}
          {{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    {{--<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">--}}
    {{--<!-- Font Awesome -->--}}
    {{--<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">--}}
    {{--<!-- Ionicons -->--}}
    {{--<link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">--}}

    {{--<title>Product Masuk Exports All PDF</title>--}}
{{--</head>--}}
{{--<body>--}}
    <style>
        #product-masuk {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #product-masuk td, #product-masuk th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #product-masuk tr:nth-child(even){background-color: #f2f2f2;}

        #product-masuk tr:hover {background-color: #ddd;}

        #product-masuk th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>

<table id="product-masuk" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Jenis Kategori</th>
            <th>Nama Kategori</th>
            <th>Nama Barang</th>
            <th>QTY</th>
        </tr>
    </thead>
    @foreach($products as $p)
        <tbody>
        <tr>
            <td>{{ $p->id }}</td>
            <td> @if ($p->jenis_id === 1)
                <span>Asset</span>
            @elseif($p->jenis_id === 2)
                <span>Consumable</span>
            @endif</td>
            <td>{{ $p->category_id }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->qty }}</td>
        </tr>
        </tbody>
    @endforeach

</table>


    {{--<!-- jQuery 3 -->--}}
    {{--<script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script>--}}
    {{--<!-- Bootstrap 3.3.7 -->--}}
    {{--<script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>--}}
    {{--<!-- AdminLTE App -->--}}
    {{--<script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}


