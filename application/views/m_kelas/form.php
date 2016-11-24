<!-- Modal -->
<div id="modalMkelas" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <form id="Formdata" class="form-horizontal" role="form">                    
                    <input type="hidden" name="url_add" value="<?php echo $url_add ?>">
                    <input type="hidden" name="url_getdata" value="<?php echo $url_getdata ?>">
                    <input type="hidden" name="url_edit" value="<?php echo $url_edit ?>">
                    <input type="hidden" name="url_delete" value="<?php echo $url_delete ?>">
                    <input type="hidden" name="kelas_id">
                    
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nama">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" id="nama" class="form-control"  placeholder="Masukan Nama Kelas ">
                            <span id="err_nama"></span>
                        </div>
                    </div>                     
                </form>          
            </div>
  
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" action="submit">Submit</button>
                <button type="button" class="btn btn-default" action="cancel" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>