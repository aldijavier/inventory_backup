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
                        {{-- <div class="form-group">
                            <label >Products</label>
                            {!! Form::select('product_id', $products, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Product --', 'id' => 'product_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Customer</label>
                            {!! Form::select('customer_id', $customers, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Customer --', 'id' => 'customer_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div> --}}

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
                        <script type="text/javascript">
                            function changeTextBox() {
                                        comp = document.getElementById('jenis_kategori');
                                            if(comp.value == 1) {
                                                document.getElementById('serial_number').disabled=false;
                                                document.getElementById('qty').value = 1;
                                            } else if(comp.value == 2) {
                                                document.getElementById('qty').disabled=false;
                                                document.getElementById('serial_number').disabled=true;
                                            }
                                    }
                            </script>
                        <?php
                            $ambildatastock = \DB::select("select * from products where qty < minimal_qty and jenis_id = 2");
                        ?>  
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
                                                     url : 'dropdownlist/getstates3/' +countryID,
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
                            <label >Tanggal Pengembalian Barang</label>
                            {!! Form::input('date','start_date',date('Y-m-d'),['class' => 'form-control', 'id'=> 'tanggal_keluar', 'name'=> 'tanggal_keluar', 'required', 'readonly']) !!}
                            {{-- <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tanggal" name="tanggal"   required> --}}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Lokasi Barang dikembalikan</label>
                            {!! Form::select('lokasi', $location, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Kategori --', 'id' => 'lokasi_pengambilan', 'name' => 'lokasi_pengambilan', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Lokasi Pemasangan</label>
                            <input type="text" class="form-control" id="lokasi_pemasangan" name="lokasi_pemasangan" required>
                            <span class="help-block with-errors"></span>
                        </div>
                        
                        <div class="form-group">
                            <label >Departement</label>
                            <select name="departement" id="departement" class="form-control" required>
                                <option value="">Pilih Departement</option>
                                @foreach ($departements as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                                <span class="help-block with-errors"></span>
                            </select>
                        </div>

                        <div class="form-group">
                            <label >Departement PIC</label>
                            <select name="departement_pic" id="departement_pic" class="form-control" required>
                                <option>Pilih Nama PIC</option>
                                <span class="help-block with-errors"></span>
                                </select>

                                <script type="text/javascript">
                                    jQuery(document).ready(function ()
                                    {
                                            jQuery('select[name="departement"]').on('change',function(){
                                               var countryID = jQuery(this).val();
                                               if(countryID)
                                               {
                                                  jQuery.ajax({
                                                     url : 'dropdownlist/getstates2/' +countryID,
                                                     type : "GET",
                                                     dataType : "json",
                                                     success:function(data)
                                                     {
                                                        console.log(data);
                                                        jQuery('select[name="departement_pic"]').empty();
                                                        jQuery.each(data, function(key,value){
                                                           $('select[name="departement_pic"]').append('<option id="departement_pic" name="departement_pic" value="'+ key +'">'+ value +'</option>');
                                                        });
                                                     }
                                                  });
                                               }
                                               else
                                               {
                                                  $('select[name="departement_pic"]').empty();
                                               }
                                            });
                                    });
                                    </script>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">SPK</label>
                                <input class="form-control" type="file" id="spk" name="spk" required>
                              </div>
                              <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                             <div class="mb-3">
                                <label for="formFile" class="form-label">Project Form</label>
                                <input class="form-control" type="file" id="pform" name="pform" required>
                              </div>
                              <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >qty</label>
                            <input type="text" class="form-control" id="qty" name="qty" required>
                            <span class="help-block with-errors"></span>
                        </div>

                        {{-- <div class="form-group">
                            <label >Kondisi Barang</label>
                            {!! Form::select('product_id', $products, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Kategori --', 'id' => 'product_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div> --}}

                        <div class="form-group">
                            <label>Kondisi Barang<span style="color:red"> *</span></label>
                                    <select name="kondisibarang" id="kondisibarang" class="form-control">
                                        <option value="">- Pilih Kondisi -</option>
                                        <option value="rusak"
                                            {{ old('kondisibarang') == "Rusak" ? 'selected' : '' }}>
                                            Rusak</option>
                                        <option value="reuse"
                                            {{ old('kondisibarang') == "Re-use" ? 'selected' : '' }}>Re-use
                                    </select>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $("#rusakondisi").closest("div").hide();
                                $("#reusekondisi").closest("div").hide();
                                $("#kondisibarang").on("change", function(){
                                var v = $(this).val();
                                    if(v=="rusak"){
                                        $("#rusakondisi").closest("div").show();
                                        $("#reusekondisi").closest("div").hide();
                                    }else{
                                        $("#reusekondisi").closest("div").show();
                                        $("#rusakondisi").closest("div").hide();
                                    } 
                                });
                            });
                        </script>

                        <div class="form-group">
                            <label>Kondisi Rusak<span style="color:red"> *</span></label>
                                    <select name="rusakondisi" id="rusakondisi" class="form-control">
                                        <option value="">- Pilih Kondisi Barang Rusak -</option>
                                        <option value="penuh"
                                            {{ old('rusakondisi') == "penuh" ? 'selected' : '' }}>
                                            Kerusakan Penuh</option>
                                        <option value="perbaikan"
                                            {{ old('rusakondisi') == "perbaikan" ? 'selected' : '' }}>Diperbaiki
                                    </select>
                        </div>
                        <div class="form-group">
                            <label >Kondisi Re-use</label>
                            <textarea type="text" class="form-control" id="reusekondisi" name="qty" required ></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
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
