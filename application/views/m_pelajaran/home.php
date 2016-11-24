<div class="panel panel-success">
    <div class="panel-heading">&nbsp;</div>   
     <ul class="nav nav-pills">
         <li class="active"><a onclick="adddata()" >Add New</a></li>         
    </ul>
    <div class="panel-body">        
        <table id="gridMatPel" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>    
                    <th>Nama</th>    
                    <th>Action</th>
                </tr>                
            </thead>    
            <tbody>                
            </tbody>
        </table>
    </div>
    <div class="panel-footer"></div>                           
</div>
<div id="dialog-confirm" title="DELETE REQUEST">
    <p id="textconfirm" style="display:none;">
        Are you sure for delete this data?
    </p>   
</div>

<script type="text/javascript">

 $('#gridMatPel').DataTable({
        "processing": true,
        "serverSide": true,
         "ajax": {
            "url": '<?php echo $url_grid; ?>',
            'type': 'POST',
            "data": function ( d ) {
                //d.start = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            },
            pages: 10 // number of pages to cache        
        },
        "order": [
                    [ 0, "asc" ]    
            ],
        "bFilter": true, //for hide text search
        "columns": [
            {"data": "nama"},
            {
                "data": "matapelajaran_id", "width": "100px", "sClass": "left",
                "bSortable": false,
                "mRender": function (data, type, row) {
                    var btn = "";
                    btn = btn + "<div class='btn-group'>";
                    btn = btn + " <button onClick='ParamFunc.editdata(" + row.matapelajaran_id + ")' class='btn btn-xs btn-info' type='button'>Edit</button>";
                    btn = btn + " <button onClick='ParamFunc.deletedata(" + row.matapelajaran_id + ")' class='btn btn-xs btn-info' type='button'>Delete</button>";
                    btn = btn + "</div>";
                    return btn;
                }
            }
        ]
    });
    // END KONFIGURASI
    
    var ParamFunc = {
        editdata: function (id) {
            load_form('<?php echo $url_edit; ?>'+'/'+id, 'Edit Data');
        },
        deletedata: function (id) {
            $('#confirmMatpel').modal('show');
            $("#confirmMatpel  input[name=matapelajaran_id]").val(id);
        }
    }
    
    //start delete data
        $("#confirmMatpel button[action=delete]").click(function () {
            var url;
            url = '<?php echo $url_delete ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                cache: false,
                data: {
                    matapelajaran_id: $("#confirmMatpel input[name=matapelajaran_id]").val()
                },
                success: function (data) {
                    $('#confirmMatpel').modal('hide');
                    $('#gridMatPel').dataTable().fnReloadAjax();
                }
            });
        });
        //end delete data
    
    function adddata_test(){         
         Component.headerform='test';
         Component.contentform='test';        
         Component.GenerateForm();    
    }
    function adddata(){
        load_form('<?php echo $url_add; ?>','Add Data');
    }
    
    
     function load_form(url, title) {
        var content;
        content = $("#contentdata");
        content.fadeOut("slow", "linear");
        content.load(url);
        content.fadeIn("slow");

    }
</script>




