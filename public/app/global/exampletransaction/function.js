function buildSearchData() {
    var obj = {
        purchase_id: $("#formHeader input[name=purchase_id]").val()
    };
    return obj;
}


$(function () {
    $("#modalHeader button[action=submit]").click(function () {
        // var x = $("#formHeader input[name=email]").val();
        var tanggal = "23-01-2013";
        var total = 1000;
        var t = $('#gridHeader').DataTable();

        var gridDetail = $('#gridDetail').DataTable();
        var data = gridDetail.data();

        var allDetail = [];
        gridDetail.data().each(function (value, index) {
            allDetail.push(value);

        });

        $.ajax({
            method: "POST",
            url: $("#formHeader input[name=url_post]").val(),
            data: {
                tanggal: tanggal,
                total: total,
                details: JSON.stringify(allDetail)
            }
        }).done(function (msg) {
            $('#modalHeader').modal('hide');
            t.row.add([tanggal, total, null]).draw(false);
        });



    });

    //tambah baru
    $("a[action=add_new]").click(function () {
        $('#modalHeader').modal('show');
        $("#formHeader input[name=purchase_id]").val(0);
        $('#gridDetail').DataTable().ajax.reload();
    });

    // hapus data
    $("#gridHeader button[action=delete_row]").click(function () {

        $('#confirmDeleteModal').modal('show');

        return;

        var t = $('#gridHeader').DataTable();
        var idPurchase = $(this).attr("data_id");

        $.post($("#formHeader input[name=url_delete]").val(), {
            purchase_id: idPurchase
        }, function (data, status) {
            t.row("#tr_" + idPurchase).remove().draw(false);
        });

    });

    // view data
    $("#gridHeader button[action=view_row]").click(function () {
        var t = $('#gridHeader').DataTable();
        var idPurchase = $(this).attr("data_id");
        $('#modalHeader').modal('show');
        $("#formHeader input[name=purchase_id]").val(idPurchase);
        $('#gridDetail').DataTable().ajax.reload();

    });

    $("#myModalDetail button[action=submit]").click(function () {
        $('#myModalDetail').modal('hide');
        var x = $("#formDetail input[name=harga]").val();
        var y = $("#formDetail input[name=nama_barang]").val();
        var t = $('#gridDetail').DataTable();
        // t.row.add([ x, y ]).draw(false);
        t.row.add({
            nama_barang: y,
            harga: x
        }).draw(false);
    });

});
