<div class="panel panel-success">
    <div class="panel-heading">&nbsp;</div>   
    <div class="panel-body">        
        <table id="gridData" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>                        
                    <th>NIS</th>
                    <th>Nama</th>                    
                    <th>Jenis Kelamin</th>                    
                    <th>Tempat Lahir</th>                    
                    <th>Tanggal Lahir</th>                    
                    <th>Agama</th>                    
                    <th>Jurusan</th>                    
                    <th>Hobi</th>                    
                    <th>Ayah</th>                    
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
<script>

    var ParamFunc = {
        editdata: function (id) {
            load_dialog('<?php echo $url_edit; ?>'+'/'+id, 'Create');
        },
        deletedata: function (id) {
            $('#confirmMsiswa').modal('show');
            $("#confirmMsiswa  input[name=siswa_id]").val(id);
        }
    }

   


    $(document).ready(function () {
        // KONFIGURASI ke Grid Data
        $('#gridData').DataTable({
            "ajax": {
                "url": '<?php echo $url_grid; ?>',
                "type": 'POST',
            },
            dom: 'Bfrtip',
            "bRetrieve": true,
            "bDestroy": true,
            "order": [[2, "asc"]],
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                // 'pageLength',
                // 'colvis',
                {
                    text: '+ Add',
                    key: '1',
                    action: function (e, dt, node, config) {
                        load_dialog('<?php echo $url_add; ?>', 'Create');
                    }
                },
                {
                    extend: 'print',
                    key: '2',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    key: '3',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    key: '4',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'copy',
                    key: '4',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
            "bFilter": true, //for hide text search
            "columns": [
                {"data": "nis"},
                {"data": "nama"},
                {"data": "jk"},
                {"data": "tempatlahir"},
                {"data": "tanggallahir"},
                {"data": "agama"},
                {"data": "jurusan"},              
                {"data": "hobi"},              
                {"data": "nama_ayah"},
                {
                    "data": "siswa_id", "width": "100px", "sClass": "left",
                    "bSortable": false,
                    "mRender": function (data, type, row) {
                        var btn = "";
                        btn = btn + "<div class='btn-group'>";
                        btn = btn + " <button onClick='ParamFunc.editdata(" + row.siswa_id + ")' class='btn btn-xs btn-info' type='button'>Edit</button>";
                        btn = btn + " <button onClick='ParamFunc.deletedata(" + row.siswa_id + ")' class='btn btn-xs btn-info' type='button'>Delete</button>";
                        btn = btn + "</div>";
                        return btn;
                    }
                }
            ]
        });
        // END KONFIGURASI grid data
        
        
        //start delete data
        $("#confirmMsiswa button[action=delete]").click(function () {
            var url;
            url = '<?php echo $url_delete ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                cache: false,
                data: {
                    siswa_id: $("#confirmMsiswa input[name=siswa_id]").val()
                },
                success: function (data) {
                    $('#confirmMsiswa').modal('hide');
                    $('#gridData').dataTable().fnReloadAjax();
                }
            });
        });
        //end delete data



    });



    function load_dialog(url, title) {
        var content;
        content = $("#contentdata");
        content.fadeOut("slow", "linear");
        content.load(url);
        content.fadeIn("slow");

    }


</script>




