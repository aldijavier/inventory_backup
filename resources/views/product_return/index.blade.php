@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Data Products Return</h3>
        </div>

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-primary" >Add Products Return</a>
            <a href="{{ route('exportPDF.productKeluarAll') }}" class="btn btn-danger">Export PDF</a>
            <a href="{{ route('exportExcel.productKeluarAll') }}" class="btn btn-success">Export Excel</a>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="products-out-table" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nomor Form</th>
                    <th>Jenis Kategori</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Keluar</th>
                    <th>Lokasi Pengambilan</th>
                    <th>Lokasi Pemasangan</th>
                    <th>Departement PIC</th>
                    <th>Serial Number</th>
                    <th>PIC</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>



    <div class="box col-md-6">

        {{-- <div class="box-header">
            <h3 class="box-title">Export Invoice</h3>
        </div> --}}

        {{--<div class="box-header">--}}
            {{--<a onclick="addForm()" class="btn btn-primary" >Add Products Out</a>--}}
            {{--<a href="{{ route('exportPDF.productKeluarAll') }}" class="btn btn-danger">Export PDF</a>--}}
            {{--<a href="{{ route('exportExcel.productKeluarAll') }}" class="btn btn-success">Export Excel</a>--}}
        {{--</div>--}}

        <!-- /.box-header -->
        {{-- <div class="box-body">
            <table id="invoice" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Products</th>
                    <th>Customer</th>
                    <th>QTY</th>
                    <th>Tanggal Pembelian</th>
                    <th>Export Invoice</th>
                </tr>
                </thead>

                @foreach($invoice_data as $i)
                    <tbody>
                        <td>{{ $i->id }}</td>
                        <td>{{ $i->product->nama }}</td>
                        <td>{{ $i->customer->nama }}</td>
                        <td>{{ $i->qty }}</td>
                        <td>{{ $i->tanggal }}</td>
                        <td>
                            <a href="{{ route('exportPDF.productKeluar', [ 'id' => $i->id ]) }}" class="btn btn-sm btn-danger">Export PDF</a>
                        </td>
                    </tbody>
                @endforeach
            </table>
        </div> --}}
        <!-- /.box-body -->
    </div>

    @include('product_return.form')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>


    <!-- InputMask -->
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    <script>
    $(function () {
    // $('#items-table').DataTable()
    $('#invoice').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    'processing'  : true,
    // 'serverSide'  : true
    })
    })
    </script>

    <script>
        $(function () {

            //Date picker
            $('#tanggal').datepicker({
                autoclose: true,
                // dateFormat: 'yyyy-mm-dd'
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        })
    </script>

    <script type="text/javascript">
        var table = $('#products-out-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.productsReturn') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nomor_form', name: 'nomor_form'},
                {data: 'jenis_kategori', name: 'jenis_kategori',
                "render": function (data, type, row) {
                        if ( row.jenis_kategori === '1') {
                            return 'Asset';
                        }
                        else{
                            return 'Consumable';
                        }
                    }
                },
                {data: 'products_name', name: 'products_name'},
                {data: 'tanggal_keluar', name: 'tanggal_keluar'},
                {data: 'lokasi_pengambilan', name: 'lokasi_pengambilan'},
                {data: 'lokasi_pemasangan', name: 'lokasi_pemasangan'},
                {data: 'departement_pic', name: 'departement_pic'},
                {data: 'serial_number', name: 'serial_number'},
                {data: 'pic', name: 'pic'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Products');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('productsReturn') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Products');

                    $('#id').val(data.id);
                    $('#jenis_kategori').val(data.jenis_kategori).change();
                    $('#nama_kategori').val(data.nama_kategori);
                    $('#product_id').val(data.product_id);
                    $('#lokasi_pengambilan').val(data.lokasi_pengambilan);
                    $('#tanggal_keluar').val(data.tanggal_keluar);
                    $('#lokasi_pemasangan').val(data.lokasi_pemasangan);
                    $('#departement').val(data.departement).change();
                    $('#departement_pic').val(data.departement_pic);
                    $('#qty').val(data.qty);
                    $('#serial_number').val(data.serial_number);
                    $('#remarks').val(data.remarks);
                },
                error : function() {
                    alert("Nothing Data");
                }
            });
        }

        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('productsReturn') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('productsReturn') }}";
                    else url = "{{ url('productsReturn') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Serial number sudah digunakan',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
    </script>

@endsection
