
        

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
                    <label class="control-label col-xs-3" for="siswa_id">Siswa</label>
                    <div class="col-xs-9">
                        <select id="siswa_id" name="siswa_id" >
                        <?php foreach ($default['siswa_id'] as $row) { ?>
                            <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?>                                    </option>
                        <?php } ?>
                    </select>
                        <span id="err_siswa"></span>
                    </div>
                </div>
                <!-- end field -->   
                
                  <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="kelas_id">Kelas</label>
                    <div class="col-xs-9">
                        <select id="kelas_id" name="kelas_id" >
                        <?php foreach ($default['kelas_id'] as $row) { ?>
                            <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?>                                    </option>
                        <?php } ?>
                    </select>
                        <span id="err_kelas_id"></span>
                    </div>
                </div>
                <!-- end field -->   
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="guru_id">Wali Kelas</label>
                    <div class="col-xs-9">
                        <select id="guru_id" name="guru_id" >
                        <?php foreach ($default['guru_id'] as $row) { ?>
                            <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?>                                    </option>
                        <?php } ?>
                    </select>
                        <span id="err_guru_id"></span>
                    </div>
                </div>
                <!-- end field -->               
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="tahunajaran_id">Tahun ajaran</label>
                    <div class="col-xs-9">
                        <select id="tahunajaran_id" name="tahunajaran_id" >
                        <?php foreach ($default['tahunajaran_id'] as $row) { ?>
                            <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?>                                    </option>
                        <?php } ?>
                    </select>
                        <span id="err_tahunajaran"></span>
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
                                    guru_id: $("#guru_id").val(),
                                    kelas_id: $("#kelas_id").val(),
                                    siswa_id: $("#siswa_id").val(),
                                    tahunajaran_id: $("#tahunajaran_id").val()
                                   
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
                                                $("#err_siswa").html(data.err_siswa).fadeIn('slow');
                                                $("#err_tahunajaran").html(data.err_tahunajaran).fadeIn('slow');
                                              
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

