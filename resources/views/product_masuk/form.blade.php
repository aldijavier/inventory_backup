<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="box-body">
                        <div class="form-group">
                            <label >PIC</label>
                            <input type="text" class="form-control" id="pic" name="pic" value="{{Auth::user()->name}}" readonly required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label >Jenis Kategori</label>
                            <select name="jenis_kategori" id="jenis_kategori" class="form-control" required enable onChange="changeTextBox();">
                                <option value="">Pilih Jenis Kategori</option>
                                @foreach ($productsz as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                                <span class="help-block with-errors"></span>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Nama Kategori</label>
                            <select name="nama_kategori" id="nama_kategori" class="form-control" required>
                                <option>Pilih Nama Kategori</option>
                                <span class="help-block with-errors"></span>
                                </select>

                                <script type="text/javascript">
                                    jQuery(document).ready(function ()
                                    {
                                            jQuery('select[name="jenis_kategori"]').on('change',function(){
                                               var countryID = jQuery(this).val();
                                               if(countryID)
                                               {
                                                  jQuery.ajax({
                                                     url : 'dropdownlist/getstates/' +countryID,
                                                     type : "GET",
                                                     dataType : "json",
                                                     success:function(data)
                                                     {
                                                        console.log(data);
                                                        jQuery('select[name="nama_kategori"]').empty();
                                                        jQuery.each(data, function(key,value){
                                                           $('select[name="nama_kategori"]').append('<option id="nama_kategori" name="nama_kategori" value="'+ key +'">'+ value +'</option>');
                                                        });
                                                     }
                                                  });
                                               }
                                               else
                                               {
                                                  $('select[name="nama_barang"]').empty();
                                               }
                                            });
                                            jQuery('select[name="nama_kategori"]').on('change',function(){
                                               var countryID = jQuery(this).val();
                                               if(countryID)
                                               {
                                                  jQuery.ajax({
                                                     url : 'dropdownlist/getstates1/' +countryID,
                                                     type : "GET",
                                                     dataType : "json",
                                                     success:function(data)
                                                     {
                                                        console.log(data);
                                                        jQuery('select[name="product_id"]').empty();
                                                        jQuery.each(data, function(key,value){
                                                           $('select[name="product_id"]').append('<option id="product_id" name="product_id" value="'+ key +'">'+ value +'</option>');
                                                        });
                                                     }
                                                  });
                                               }
                                               else
                                               {
                                                  $('select[name="product_id"]').empty();
                                               }
                                            });
                                    });
                                    </script>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label >Nama Barang</label>
                            <select name="product_id" id="product_id" class="form-control" required>
                                <option>Pilih Nama Kategori</option>
                                <span class="help-block with-errors"></span>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Tanggal Terima</label>
                            {!! Form::input('date','start_date',date('Y-m-d'),['class' => 'form-control', 'id'=> 'tanggal_terima', 'name'=> 'tanggal_terima', 'required']) !!}
                            {{-- <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tanggal" name="tanggal"   required> --}}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Lokasi Terima</label>
                            {!! Form::select('lokasi', $location, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Kategori --',  'id'=> 'lokasi_terima', 'name'=> 'lokasi_terima', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">PO</label>
                                <input class="form-control" type="file" id="po" name="po" required>
                              </div>
                              <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label >PO Text</label>
                            <input type="text" class="form-control" id="po_string" name="po_string" required></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">DO</label>
                                <input class="form-control" type="file" id="do" name="do" required>
                              </div>
                              <span class="help-block with-errors"></span>
                        </div>
                        {{-- <input type="text" class="form-control" id="qty" name="qty" required> --}}
                        <div class="form-group">
                            <label >Quantity</label>
                            <input type="number" id="qty" class="form-control" name="qty"><br>
                            {{-- <span class="help-block with-errors"></span> --}}
                        </div>
                        <script type="text/javascript">
                            function changeTextBox() {
                                        comp = document.getElementById('jenis_kategori');
                                            if(comp.value == 1) {
                                                document.getElementById('serial_number').disabled=false;
                                                document.getElementById('qty').disabled=true;
                                                document.getElementById('qty').value=1;
                                            } else if(comp.value == 2) {
                                                document.getElementById('qty').disabled=false;
                                                document.getElementById('serial_number').disabled=true;
                                            }
                                    }
                            </script>  
                        <div class="form-group" id="name-container-list">
                            <label >Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number"></textarea>
                            {{-- <span class="help-block with-errors"></span> --}}
                        </div>
                        <div class="form-group">
                            <label >Spesifikasi</label>
                            <textarea type="text" class="form-control" id="spesifikasi" name="spesifikasi" required></textarea>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Remarks</label>
                            <textarea type="text" class="form-control" id="remarks" name="remarks" required></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label >Created Date</label>
                            <div id="time"
                                        style="background-color: #ecf0f1; border: 1px dashed grey; height: auto; margin: 1px 0px; padding: 3px; text-align: left; width: auto;">
                                    </div>
                            <span class="help-block with-errors"></span>
                        </div>
                        <script type="text/javascript">
                            function showTime() {
                                var date = new Date(),
                                    utc = new Date(Date(
                                        date.getFullYear(),
                                        date.getMonth(),
                                        date.getDate(),
                                        date.getHours(),
                                        date.getMinutes(),
                                        date.getSeconds()
                                    ));
                                document.getElementById('time').innerHTML = utc.toLocaleString();
                                //   document.getElementById('time').innerHTML = utc.toLocaleTimeString();
                            }
                            setInterval(showTime, 1000);
                        </script>
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
