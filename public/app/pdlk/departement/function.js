function departement_buildSearchData() {
    var obj = {
        // departemen_id: $("#Formdata input[name=departemen_id]").val()
    };
    return obj;
}

var pdlkDepartementFunc = {
    editdata: function (id) {
        var url;
        $('#modalMasterDepartement').modal('show');
        url = $("#modalMasterDepartement form input[name=url_getdata]").val();
        $("#modalMasterDepartement form input[name=departemen_id]").val(id);

        $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                departemen_id: id
            },
            success: function (data) {
                $("#modalMasterDepartement form input[name=kode]").val(data.kode);
                $("#modalMasterDepartement form input[name=nama]").val(data.nama);
            }
        });
    },
    deletedata: function (id) {
        $('#confirmDeleteModalDepartement').modal('show');
        $("#confirmDeleteModalDepartement  input[name=departemen_id]").val(id);

    }
}

$(function () {
    // KONFIGURASI
    $('#gridDataDepartement').DataTable({
        "ajax": {
            "url": $('#gridDataDepartement').attr("url"),
            "type": 'POST',
            // "data": departemen_buildSearchData
        },
        "bFilter": false, //for hide text search
        "columns": [
            {"data": "kode"},
            {"data": "nama"},
            {
                "data": "departemen_id", "width": "100px", "sClass": "left",
                "bSortable": false,
                "mRender": function (data, type, row) {
                    var btn = "";
                    btn = btn + "<div class='btn-group'>";
                    btn = btn + " <button onClick='pdlkDepartementFunc.editdata(" + row.departemen_id + ")' class='btn btn-xs btn-info' type='button'>Edit</button>";
                    btn = btn + " <button onClick='pdlkDepartementFunc.deletedata(" + row.departemen_id + ")' class='btn btn-xs btn-info' type='button'>Delete</button>";
                    btn = btn + "</div>";
                    return btn;
                }
            }
        ]
    });
    // END KONFIGURASI

  //=============START SEARCH DATA=========================================

    //start button search
    $("table#search_departement #search").click(function () {
        var kode, name, url = '';
        
        url = $('table#search_departement').attr("url");
        kode = $("table#search_departement tr input[name=kode]").val();
        name = $("table#search_departement tr input[name=nama]").val();
        
        if (name == '') { name = 0;}
        if (kode == '') { kode = 0;}
        
        $('#gridDataDepartement').dataTable().fnReloadAjax(url + '/' + kode + '/' + name);

    });
    //end button search

    //start button reset
    $("table#search_departement #clear").click(function () {
        $("table#search_departement tr input[name=kode]").val('');
        $("table#search_departement tr input[name=nama]").val('');
        $('#gridDataDepartement').dataTable().fnReloadAjax($('#gridDataDepartement').attr("url"));
    });
    //end button reset     

 //================END SEARCH DATA==============================================================



    // SHOW MODAL SECTION
    //tambah baru
    $("a.departement[action=add_new]").click(function () {        
        $('#modalMasterDepartement').modal('show');
        // $("#Formdata input[name=iddata]").val(0);
        //  $("#Formdata input[name=parameter]").val('add_data');
    });

    $("a.departement[action=add_new]").click(function () {
        $('#modalMasterDepartement').modal('show');
        // $("#Formdata input[name=iddata]").val(0);
        //  $("#Formdata input[name=parameter]").val('add_data');
    });

    // END SHOW MODAL SECTION
    $("#modalMasterDepartement button[action=submit]").click(function () {
        var form, urlEdit, urlAdd, id, kode, nama;

        form = "#modalMasterDepartement form";
        urlEdit = $(form + " input[name=url_edit]").val();
        urlAdd = $(form + " input[name=url_add]").val();
        id = $(form + " input[name=departemen_id]").val();
        kode = $(form + " input[name=kode]").val();
        nama = $(form + " input[name=nama]").val();

        $.ajax({
            url: $(form + " input[name=departemen_id]").val() > 0 ? urlEdit : urlAdd,
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                departemen_id: id,
                kode: kode,
                nama: nama
            },
            success: function (data) {
                if (data.hasil == 'true') {
                    $('#modalMasterDepartement').modal('hide');
                    $('#gridDataDepartement').dataTable().fnReloadAjax();
                } else {
                    $('#err_kode').html(data.err_kode);
                    $('#err_nama').html(data.err_nama);
                }
            }
        });

    });
    
    $('#modalMasterDepartement').on('hide', function (e) {
        alert('test');
         $('#modalMasterDepartement')
        .find("span,input,textarea,select").val('').end()
        .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();  
        
    });


    $("#confirmDeleteModalDepartement button[action=delete]").click(function () {
        var url;

        url = $("#modalMasterDepartement form input[name=url_delete]").val();
        $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                departemen_id: $("#confirmDeleteModalDepartement input[name=departemen_id]").val()
            },
            success: function (data) {
                $('#confirmDeleteModalDepartement').modal('hide');
                $('#gridDataDepartement').dataTable().fnReloadAjax();
            }
        });
    });
});
