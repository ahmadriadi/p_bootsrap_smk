
        

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
                    <label class="control-label col-xs-3" for="guru">Guru</label>
                    <div class="col-xs-9">
                        <select id="guru" name="guru" >
                        <?php foreach ($default['guru'] as $row) { ?>
                            <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?>                                    </option>
                        <?php } ?>
                    </select>
                        <span id="err_guru"></span>
                    </div>
                </div>
                <!-- end field -->               
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="kelas">Kelas</label>
                    <div class="col-xs-9">
                        <select id="kelas" name="kelas" >
                        <?php foreach ($default['kelas'] as $row) { ?>
                            <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?>                                    </option>
                        <?php } ?>
                    </select>
                        <span id="err_kelas"></span>
                    </div>
                </div>
                <!-- end field -->               
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="matpel">Mata Pelajaran</label>
                    <div class="col-xs-9">
                        <select id="matpel" name="matpel" >
                        <?php foreach ($default['matpel'] as $row) { ?>
                            <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?>                                    </option>
                        <?php } ?>
                    </select>
                        <span id="err_matpel"></span>
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
                                    guru: $("#guru").val(),
                                    kelas: $("#kelas").val(),
                                    matpel: $("#matpel").val(),
                                   
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
                                                $("#err_guru").html(data.err_guru).fadeIn('slow');
                                                $("#err_kelas").html(data.err_kelas).fadeIn('slow');
                                                $("#err_matpel").html(data.err_matpel).fadeIn('slow');
                                              
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

