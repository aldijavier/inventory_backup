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
    
    /* html { margin: 0px} */

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
        <th>Nomor Form</th>
        <th>Jenis Kategori</th>
        <th>Nama Kategori</th>
        <th>Nama Barang</th>
        <th>Tanggal Keluar</th>
        <th>Lokasi Pengambilan</th>
        <th>Lokasi Pemasangan</th>
        <th>Departement</th>
        <th>Departement PIC</th>
        <th>SPK</th>
        <th>Project Form</th>
        <th>Quantity</th>
        <th>Serial Number</th>
        <th>Remarks</th>
        <th>PIC</th>
    </tr>
    </thead>
    @foreach($product_keluar as $p)
        <tbody>
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nomor_form }}</td>
            <td> @if ($p->jenis_kategori === 1)
                <span>Asset</span>
            @else
                <span>Consumable</span>
            @endif</td>
            <td>{{ $p->nama_kategori }}</td>
            <td>{{ $p->product->nama }}</td>
            <td>{{ $p->tanggal_keluar }}</td>
            <td>{{ $p->lokasi_pengambilan }}</td>
            <td>{{ $p->lokasi_pemasangan }}</td>
            <td>{{ $p->departement }}</td>
            <td>{{ $p->departement_pic }}</td>
            <td>{{ $p->spk }}</td>
            <td>{{ $p->pform }}</td>
            <td>{{ $p->qty }}</td>
            <td>{{ $p->serial_number }}</td>
            <td>{{ $p->remarks }}</td>
            <td>{{ $p->pic }}</td>
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


