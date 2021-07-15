@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-body">
               <div class="table-responsive">
                   <table class="table table-stripped">
                        <tbody>
                            <tr>
                                <th>Barcode</th>
                                <th>:</th>
                                <td>
                                    <img src="data:image/png;base64,
                                    {{\DNS2D::getBarcodePNG($dt->nomor_form, 'QRCODE')}}" alt="barcode" style="width: 80px;" />    
                                </td>
                            </tr>
                            <tr>
                                <th>PIC</th>
                                <td>:</td>
                                <td>{{ $dt->pic }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Form</th>
                                <th>:</th>
                                <td>{{ $dt->nomor_form }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Asset</th>
                                <th>:</th>
                                <td>{{ $dt->nomor_asset }}</td>
                            </tr>
                            <tr> 
                                <th>Jenis Kategori</th>
                                <th>:</th>
                                <td> @if ($dt->jenis_kategori === '1')
                                    <span>Asset</span>
                                @else
                                    <span>Consumable</span>
                                @endif</td>
                            </tr>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>:</th>
                                <td>{{ $dt->nama_kategori }}</td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <th>:</th>
                                <td>{{ $dt->product->nama }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Terima</th>
                                <th>:</th>
                                <td>{{ $dt->tanggal_terima }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi Terima</th>
                                <th>:</th>
                                <td>{{ $dt->lokasi_terima }}</td>
                            </tr>
                            <tr>
                                <th>PO</th>
                                <th>:</th>
                                <td><a href="{{ route('books.download', $dt->id) }}">{{ $dt->po }}</a></td>
                            </tr>
                            <tr>
                                <th>DO</th>
                                <th>:</th>
                                <td><a href="{{ route('books.downloadDO', $dt->id) }}">{{ $dt->do }}</a></td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <th>:</th>
                                <td>{{ $dt->qty }}</td>
                            </tr>
                            <tr>
                                <th>Serial Number</th>
                                <th>:</th>
                                <td>{{ $dt->serial_number }}</td>
                            </tr>
                            <tr>
                                <th>Spesifikasi</th>
                                <th>:</th>
                                <td>{{ $dt->spesifikasi }}</td>
                            </tr>
                            <tr>
                                <th>Remarks</th>
                                <th>:</th>
                                <td>{{ $dt->remarks }}</td>
                            </tr>
                            <tr>
                                <th>Created Date</th>
                                <th>:</th>
                                <td>{{ $dt->created_at }}</td>
                            </tr>

                        </tbody>
                   </table>
               </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection