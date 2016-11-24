function tiket_buildSearchData() {
    var obj = {
        // departemen_id: $("#Formdata input[name=tiket_h_id]").val()
    };
    return obj;
}

function tiketDetailSearchData() {
    var obj = {
        tiket_h_id: $("#modalMasterTiket form input[name=tiket_h_id]").val()
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
                $("#modalMasterTiket form input[name=tiket_h_id]").val(data.tiket_h_id);
                $('#gridDetailUser').dataTable().fnReloadAjax();
                $("#modalMasterTiket form input[name=nomor]").val(data.nomor);
                $("#modalMasterTiket form input[name=tanggal_transaksi]").val(data.tanggal_transaksi);
            }
        });

    },
    deletedata: function(id) {
        $('#confirmDeleteModalTiket').modal('show');



        $("#confirmDeleteModalTiket  input[name=tiket_h_id]").val(id);

    },
    editdataDetail: function(id) {
        $('#myModalDetailUser').modal('show');
        $('#myModalDetailUser').attr("mode_form", "update");
        $.ajax({
            url: $('#myModalDetailUser').attr("url_data"),
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                tiketuser_d_id: id
            },
            success: function(data) {
                $('#myModalDetailUser form input[name=catatan]').val(data.catatan);
            }
        });




    },
    deletedataDetail: function(id) {
        alert("delete");

    },
}


$(document).ready(function() {

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
    // KONFIGURASI



    $('#gridDetailUser').DataTable({
        "ajax": {
            "url": $('#gridDetailUser').attr("url"),
            "type": 'POST',
            "data": tiketDetailSearchData
        },
        "columns": [
            {"data": "catatan"},
            {
                "data": "tiketuser_d_id", "width": "100px", "sClass": "left",
                "bSortable": false,
                "mRender": function(data, type, row) {
                    var btn = "";
                    btn = btn + "<div class='btn-group'>";
                    btn = btn + " <button onClick='pdlkTiketFunc.editdataDetail(" + row.tiketuser_d_id + ")' class='btn btn-xs btn-info' type='button'>Edit</button>";
                    btn = btn + " <button onClick='pdlkTiketFunc.deletedataDetail(" + row.tiketuser_d_id + ")' class='btn btn-xs btn-info' type='button'>Delete</button>";
                    // btn = btn + " <button btn='delete' class='btn btn-xs btn-info' type='button'>Delete</button>";
                    btn = btn + "</div>";
                    return btn;
                }
            },
        ]

    });

    /*
     $.fn.dataTableExt.sErrMode = 'throw';
     var tableuser = $('#gridDetailUser').DataTable({
     "ajax": {
     "url": $('#gridDetailUser').attr("url")+'/'+$("#modalMasterTiket form input[name=tiket_h_id]").val(),
     "type": 'POST',
     },
     "columns": [
     {"data": "catatan"},
     {
     "data": "tiketuser_d_id", "width": "100px", "sClass": "left",
     "bSortable": false,
     "mRender": function (data, type, row) {
     var btn = "";
     btn = btn + "<div class='btn-group'>";
     btn = btn + " <button btn='delete' class='btn btn-xs btn-info' type='button'>Delete</button>";
     btn = btn + "</div>";
     return btn;
     }
     },
     ]
     
     });
     */


    //Grid User Button Function
    $("#gridDetailUser tbody").on('click', 'button', function() {
        var btn = $(this).attr("btn");
        if (btn == 'delete') {
            tableuser.row($(this).parents('tr')).remove().draw();

        }

    });
    //Grid User Button Function



    $('#tanggal_transaksi').datepicker({
        dateFormat: "yy-mm-dd"
    });
    // END KONFIGURASI

    // SHOW MODAL SECTION
    //tambah baru
    $("a.tiket[action=add_new]").click(function() {
        $('#modalMasterTiket').modal('show');

    });

    // END SHOW MODAL SECTION


    $("#modalMasterTiket button[action=submit]").click(function() {
        var form, urlEdit, urlAdd, id, nomor, tanggal;

        form = "#modalMasterTiket form";
        urlEdit = $(form + " input[name=url_edit]").val();
        urlAdd = $(form + " input[name=url_add]").val();
        id = $(form + " input[name=tiket_h_id]").val();
        nomor = $(form + " input[name=nomor]").val();
        tanggal = $(form + " input[name=tanggal_transaksi]").val();

        var gridDetailUser = $('#gridDetailUser').DataTable();
        var allDetailUser = [];
        gridDetailUser.data().each(function(value, index) {
            allDetailUser.push(value);
        });

        $.ajax({
            url: $(form + " input[name=tiket_h_id]").val() > 0 ? urlEdit : urlAdd,
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                tiket_h_id: id,
                nomor: nomor,
                tanggal_transaksi: tanggal,
                datadetailuser: JSON.stringify(allDetailUser),
            },
            success: function(data) {
                $('#modalMasterTiket').modal('hide');
                $('#gridDataTiket').dataTable().fnReloadAjax();

            }
        });
    });

    $("#myModalDetailUser button[action=submit]").click(function() {
        $modeForm = $('#myModalDetailUser').attr("mode_form");
        if ($modeForm == "update") {

            $('#myModalDetailUser').attr("mode_form", "");
            
            $('#myModalDetailUser').modal('hide');
            var catatan = $("#formDetail input[name=catatan").val();
            var table = $('#gridDetailUser').DataTable();
            table.fnUpdate('X', "xx", 4);

            $("#formDetail input[name=catatan").val('');
            
        } else {
            $('#myModalDetailUser').modal('hide');
            var catatan = $("#formDetail input[name=catatan").val();
            var table = $('#gridDetailUser').DataTable();
            table.row.add({
                catatan: catatan,
            }).draw(false);

            $("#formDetail input[name=catatan").val('');
        }

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
                tiket_h_id: $("#confirmDeleteModalTiket input[name=tiket_h_id]").val()
            },
            success: function(data) {
                $('#confirmDeleteModalTiket').modal('hide');
                $('#gridDataTiket').dataTable().fnReloadAjax();

            }
        });

    });
    $("#confirmDeleteModalTiketDetail button[action=delete]").click(function() {
        $("#gridDetailUser tr#" + $("#confirmDeleteModalTiketDetail input[name=tiketuser_d_id]").val() + "").remove();

    });

});
