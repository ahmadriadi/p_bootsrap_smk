
        

<div class="panel panel-success">
    <div class="panel panel-success">
        <div class="panel-heading">Form Data</div>        
        <div class="panel-body">        
            <form class="form-horizontal">    
                <!-- start parameter id data-->
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                <!-- start parameter id data-->              
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="nama">NAMA</label>
                    <div class="col-xs-9">
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="INPUT NAMA"
                               value="<?php echo (isset($default['nama'])) ? $default['nama'] : ''; ?>"
                               <?php echo (isset($default['readonly_nama'])) ? $default['readonly_nama'] : ''; ?>
                               size="10" />
                        <span id="err_nama"></span>
                    </div>
                </div>
                <!-- end field -->      
                <br>
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                        <input id="submit" type="submit" class="btn btn-primary" value="Submit">
                        <input id="cancel" type="reset" class="btn btn-default" value="Reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function ()
    {
        var buttonsave, buttoncancel, urlpost, urlindex, content;

        //$("#tanggallahir").datepicker({dateFormat: "dd-mm-yy"});

        buttonsave = $('#submit');
        buttoncancel = $('#cancel');
        urlpost = '<?php echo $url_post; ?>';
        urlindex = '<?php echo $url_index; ?>';
        content = $("#contentdata");


        buttonsave.click(
                function ()
                {
                    
                    $.ajax(
                            {
                                type: "POST",
                                url: urlpost,
                                dataType: "json",                                 
                                data: {
                                    id: $("#id").val(),
                                    nama: $("#nama").val(),                                   
                                },
                                cache: false,
                                success:
                                        function (data, text)
                                        {
                                            if (data.hasil == 'true') {
                                                content.fadeOut("slow", "linear");
                                                content.load(urlindex);
                                                content.fadeIn("slow");
                                            } else {
                                                $("#err_nama").html(data.err_nama).fadeIn('slow');
                                               
                                            }
                                        },
                                error: function (request, status, error) {
                                    alert(request.responseText + " " + status + " " + error);
                                }
                            });
                    return false;


                });




        buttoncancel.click(
                function ()
                {
                    content.fadeOut("slow", "linear");
                    content.load(urlindex);
                    content.fadeIn("slow");

                });




    });

</script>

