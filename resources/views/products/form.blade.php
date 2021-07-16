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
                            <label >Jenis Kategori</label>
                            <select name="jenis_id" id="jenis_id" class="form-control" enable onChange="changeTextBox();">
                                <option value="">Pilih Jenis Kategori</option>
                                @foreach ($products as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                                <span class="help-block with-errors"></span>
                            </select>
                        </div>
                        <script type="text/javascript">
                            function changeTextBox() {
                                        comp = document.getElementById('jenis_id');
                                            if(comp.value == 1) {
                                                document.getElementById('qty').disabled=true;
                                            } else if(comp.value == 2) {
                                                document.getElementById('qty').disabled=false;
                                            }
                                    }
                            </script>
                        <div class="form-group">
                            <label >Nama Kategori</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option>Pilih Nama Kategori</option>
                                <span class="help-block with-errors"></span>
                                </select>

                                <script type="text/javascript">
                                    jQuery(document).ready(function ()
                                    {
                                            jQuery('select[name="jenis_id"]').on('change',function(){
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
                                                        jQuery('select[name="category_id"]').empty();
                                                        jQuery.each(data, function(key,value){
                                                           $('select[name="category_id"]').append('<option id="category_id" name="category_id" value="'+ key +'">'+ value +'</option>');
                                                        });
                                                     }
                                                  });
                                               }
                                               else
                                               {
                                                  $('select[name="category_id"]').empty();
                                               }
                                            });
                                    });
                                    </script>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" class="form-control" id="nama" name="nama"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Quantity</label>
                            <input type="text" class="form-control" id="qty" name="qty">
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
