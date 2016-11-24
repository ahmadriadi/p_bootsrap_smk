
<div class="panel panel-success">
    <div class="panel-heading">&nbsp;</div>
    <br/>
    <ul class="nav nav-pills">
        <li class="active"><a class="mkelas" href="#" action="add_new">Add New</a></li>         
    </ul>
    <div class="panel-body">        
        <table id="gridMkelas" url="<?php echo $url_grid ?>" class="table table-bordered table-hover table-striped">
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
<script>
    var MkelasFunc = {
            editdata: function (id) {
                var url;
                $('#modalMkelas').modal('show');
                url = $("#modalMkelas form input[name=url_getdata]").val();
                $("#modalMkelas form input[name=kelas_id]").val(id);

                $.ajax({
                    url: url,
                    type: "post",
                    dataType: "json",
                    cache: false,
                    data: {
                        kelas_id: id
                    },
                    success: function (data) {
                        $("#modalMkelas form input[name=nama]").val(data.nama);
                    }
                });
            },
            deletedata: function (id) {
                $('#confirmMkelas').modal('show');
                $("#confirmMkelas  input[name=kelas_id]").val(id);

            }
        }
        
     function clearform(){
         $('#modalMkelas').find("span,input,textarea,select").val('').end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
     }   
        
    $(document).ready(function () {
        // KONFIGURASI ke Grid Data
        $('#gridMkelas').DataTable({
            "ajax": {
                "url": $('#gridMkelas').attr("url"),
                "type": 'POST',
            },
            "bFilter": true, //for hide text search
            "columns": [
                {"data": "nama"},
                {
                    "data": "kelas_id", "width": "100px", "sClass": "left",
                    "bSortable": false,
                    "mRender": function (data, type, row) {
                        var btn = "";
                        btn = btn + "<div class='btn-group'>";
                        btn = btn + " <button onClick='MkelasFunc.editdata(" + row.kelas_id + ")' class='btn btn-xs btn-info' type='button'>Edit</button>";
                        btn = btn + " <button onClick='MkelasFunc.deletedata(" + row.kelas_id + ")' class='btn btn-xs btn-info' type='button'>Delete</button>";
                        btn = btn + "</div>";
                        return btn;
                    }
                }
            ]
        });
        // END KONFIGURASI grid data



        //start untuk tambah baru
        $("a.mkelas[action=add_new]").click(function () {
            $('#modalMkelas').modal('show');
        });
        //end untuk tambah baru
        

        // start proses untuk form input data
        $("#modalMkelas button[action=submit]").click(function () {
            var form, urlEdit, urlAdd, id, kode, nama;

            form = "#modalMkelas form";
            urlEdit = $(form + " input[name=url_edit]").val();
            urlAdd = $(form + " input[name=url_add]").val();
            id = $(form + " input[name=kelas_id]").val();
            nama = $(form + " input[name=nama]").val();

            $.ajax({
                url: $(form + " input[name=kelas_id]").val() > 0 ? urlEdit : urlAdd,
                type: "post",
                dataType: "json",
                cache: false,
                data: {
                    kelas_id: id,
                    nama: nama
                },
                success: function (data) {                    
                    if (data.hasil == 'true') {
                        $('#modalMkelas').modal('hide');
                        $('#gridMkelas').dataTable().fnReloadAjax();                        
                    } else {
                        $('#err_nama').html(data.err_nama);
                    }
                }
            });

        });
        // end proses untuk form input data

         // start cancel untuk form input data
        $("#modalMkelas button[action=cancel]").click(function () {
            clearform();
        });   
        // end cancel untuk form input data

        //start bersihkan form
        $('#modalMkelas').on('hide', function (e) {
            clearform();
        });
        //end bersihkan form



        //start delete data
        $("#confirmMkelas button[action=delete]").click(function () {
            var url;
            url = $("#modalMkelas form input[name=url_delete]").val();
            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                cache: false,
                data: {
                    kelas_id: $("#confirmMkelas input[name=kelas_id]").val()
                },
                success: function (data) {
                    $('#confirmMkelas').modal('hide');
                    $('#gridMkelas').dataTable().fnReloadAjax();
                }
            });
        });
        //end delete data

    });


</script>




