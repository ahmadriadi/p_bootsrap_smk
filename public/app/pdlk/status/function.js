var commonFunction = {
    approve: function (id) {
        $('#confirmApproveStatus').modal('show');
        $("#confirmApproveStatus  input[name=tiket_h_id]").val(id);
    },
    reject: function (id) {
        $('#confirmRejectStatus').modal('show');
        $("#confirmRejectStatus  input[name=tiket_h_id]").val(id);

    },
}


$(document).ready(function () {
    // KONFIGURASI
    //alert($('#gridDataStatus').attr("url"));
    $('#gridDataStatus').DataTable({
        "ajax": {
            "url": $('#gridDataStatus').attr("url"),
            "type": 'POST',
            // "data": tiket_buildSearchData
        },
        "columns": [
            {"data": "nomor"},
            {"data": "tanggal_transaksi"},
            {"data": "status_id",
                "mRender": function (data, type, row) {
                    var desc, result, classdata = '';
                    if (row.status_id == '0') {
                        desc = 'Waiting';
                        classdata = "waiting";
                    } else if (row.status_id == '1') {
                        desc = 'Approve';
                        classdata = "approve";
                    } else if (row.status_id == '2') {
                        desc = 'Reject';
                        classdata = "reject";
                    }
                    return "<span class='" + classdata + "'>" + desc + "</span>";
                }
            },
            {
                "data": "tiket_h_id", "width": "100px", "sClass": "left",
                "bSortable": false,
                "mRender": function (data, type, row) {
                    var btn = "";
                    if (row.status_id == '0') {
                        btn = btn + "<div class='btn-group'>";
                        btn = btn + " <button onClick='commonFunction.approve(" + row.tiket_h_id + ")' class='btn btn-xs btn-info' type='button'>Approve</button>";
                        btn = btn + " <button onClick='commonFunction.reject(" + row.tiket_h_id + ")' class='btn btn-xs btn-info' type='button'>Reject</button>";
                        btn = btn + "</div>";
                    } else if (row.status_id == '1') {
                        btn = "-";
                    } else if (row.status_id == '2') {
                        btn = "-";
                    }

                    return btn;
                }
            }
        ]
    });
    // KONFIGURASI


$("#confirmApproveStatus button[action=approve]").click(function () {  
    var url;
    url = $("#approve").val();
    $.ajax({
        url: url,
        type: "post",
        dataType: "json",
        cache: false,
        data: {
            tiket_h_id: $("#confirmApproveStatus  input[name=tiket_h_id]").val()
        },
        success: function (data) {
            $('#confirmApproveStatus').modal('hide');
            $('#gridDataStatus').dataTable().fnReloadAjax();

        }
    });

});
$("#confirmRejectStatus button[action=reject]").click(function () {
    var url;
    url = $("#reject").val();
    $.ajax({
        url: url,
        type: "post",
        dataType: "json",
        cache: false,
        data: {
            tiket_h_id: $("#confirmRejectStatus  input[name=tiket_h_id]").val()
        },
        success: function (data) {
            $('#confirmRejectStatus').modal('hide');
            $('#gridDataStatus').dataTable().fnReloadAjax();

        }
    });

});

});