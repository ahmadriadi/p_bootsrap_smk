function tiket_buildSearchData() {
    var obj = {
        // departemen_id: $("#Formdata input[name=tiket_h_id]").val()
    };
    return obj;
}


var pdlkTiketFunc = {  
    editdata: function(id) {
        var url;
        
        $('#modalMasterTiket').modal('show');
        $("#modalMasterTiket form input[name=parameter]").val('edit_data');
        
        url = $("#modalMasterTiket form input[name=url_getdata]").val();
        
        $("#modalMasterTiket form input[name=tiket_h_id]").val(id);
        
        $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                tiket_h_id: id
            },
            success: function(data) {
                $("#modalMasterTiket form input[name=nomor]").val(data.nomor);
                $("#modalMasterTiket form input[name=tanggal_transaksi]").val(data.tanggal_transaksi);
            }
        });
    },
    deletedata: function(id) {
        $('#confirmDeleteModalTiket').modal('show');
        $("#confirmDeleteModalTiket  input[name=tiket_h_id]").val(id);

    }
}

$(function() {

    // KONFIGURASI
    $('#gridDataTiket').DataTable({
        "ajax": {
            "url": $('#gridDataTiket').attr("url"),
            "type": 'POST',
            // "data": tiket_buildSearchData
        },
        "columns": [
            {"data": "tanggal_transaksi"},
            {"data": "nomor"},
            {
                "data": "tiket_h_id", "width": "100px", "sClass": "left",
                "bSortable": false,
                "mRender": function(data, type, row) {
                    var btn = "";
                    btn = btn + "<div class='btn-group'>";
                    btn = btn + " <button onClick='pdlkTiketFunc.editdata(" + row.tiket_h_id + ")' class='btn btn-xs btn-info' type='button'>Edit</button>";
                    btn = btn + " <button onClick='pdlkTiketFunc.deletedata(" + row.tiket_h_id + ")' class='btn btn-xs btn-info' type='button'>Delete</button>";
                    btn = btn + "</div>";
                    return btn;
                }
            }
        ]
    });
    
    $('#tanggal_transaksi').datepicker({
        dateFormat: "yy-mm-dd"
    });
    // END KONFIGURASI

    // SHOW MODAL SECTION
    //tambah baru
    $("a.tiket[action=add_new]").click(function() {
        $('#modalMasterTiket').modal('show');
        // $("#Formdata input[name=iddata]").val(0);
        //  $("#Formdata input[name=parameter]").val('add_data');
    });

    // END SHOW MODAL SECTION


    $("#modalMasterTiket button[action=submit]").click(function() {
        var form,urlEdit,urlAdd,id,nomor,tanggal;
        
         form = "#modalMasterTiket form";
         urlEdit = $(form + " input[name=url_edit]").val();
         urlAdd = $(form + " input[name=url_add]").val();
         id = $(form + " input[name=tiket_h_id]").val();
         nomor = $(form + " input[name=nomor]").val();
         tanggal = $(form + " input[name=tanggal_transaksi]").val();
  
        $.ajax({
            url: $(form + " input[name=tiket_h_id]").val() > 0?urlEdit:urlAdd,
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                tiket_h_id:id,
                nomor: nomor,
                tanggal_transaksi: tanggal
            },
            success: function(data) {
                $('#modalMasterTiket').modal('hide');
                $('#gridDataTiket').dataTable().fnReloadAjax();

            }
        });



    });

    $("#confirmDeleteModalTiket button[action=delete]").click(function() {
       var url;
       
        url = $("#modalMasterTiket form input[name=url_delete]").val();
        $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                tiket_h_id:$("#confirmDeleteModalTiket input[name=tiket_h_id]").val()
            },
            success: function(data) {
                $('#confirmDeleteModalTiket').modal('hide');
                $('#gridDataTiket').dataTable().fnReloadAjax();

            }
        });

    });







});
