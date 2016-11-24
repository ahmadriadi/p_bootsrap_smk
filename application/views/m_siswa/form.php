
        

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
                    <label class="control-label col-xs-3" for="nis">NIS</label>
                    <div class="col-xs-9">
                        <input type="text" name="nis" id="nis"  class="form-control" placeholder="INPUT NIS"
                               value="<?php echo (isset($default['nis'])) ? $default['nis'] : ''; ?>"
                               <?php echo (isset($default['readonly_nis'])) ? $default['readonly_nis'] : ''; ?>
                               size="10" />
                        <span id="err_nis"></span>
                    </div>
                </div>
                <!-- end field -->  
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
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="jk">Jenis Kelamin</label>
                    <div class="col-xs-9">
                        <select id="jk" name="jk" >
                            <?php print_r($default['jk']); foreach ($default['jk'] as $row) { ?>
                                
                                <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                        <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                    <?php echo (isset($row['display'])) ? $row['display'] : ''; ?></option>
                            <?php } ?>
                        </select>                                       
                        <span id="err_jk"></span>
                    </div>
                </div>
                <!-- end field -->  

                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="tempatlahir">Tempat Lahir</label>
                    <div class="col-xs-9">
                        <input type="text" id="tempatlahir" name="tempatlahir" class="form-control" placeholder="INPUT TEMPAT LAHIR"
                               value="<?php echo (isset($default['tempatlahir'])) ? $default['tempatlahir'] : ''; ?>"
                               <?php echo (isset($default['readonly_tempatlahir'])) ? $default['readonly_tempatlahir'] : ''; ?>
                               size="10" />
                        <span id="err_tanggallahir"></span>
                    </div>
                </div>
                <!-- end field -->  
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="tanggallahir">Tanggal Lahir</label>
                    <div class="col-xs-9">
                        <input type="text" id="tanggallahir" name="tanggallahir" class="form-control" placeholder="INPUT TANGGAL LAHIR"
                               value="<?php echo (isset($default['tanggallahir'])) ? $default['tanggallahir'] : ''; ?>"
                               <?php echo (isset($default['readonly_tanggallahir'])) ? $default['readonly_tanggallahir'] : ''; ?>
                               size="10" />
                        <span id="err_tanggallahir"></span>
                    </div>
                </div>
                <!-- end field -->  
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="alamat">Alamat</label>
                    <div class="col-xs-9">
                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="INPUT ALAMAT"
                               value="<?php echo (isset($default['alamat'])) ? $default['alamat'] : ''; ?>"
                               <?php echo (isset($default['readonly_alamat'])) ? $default['readonly_alamat'] : ''; ?>
                               size="10" />
                        <span id="err_alamat"></span>
                    </div>
                </div>
                <!-- end field -->  
                   <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="jurusan_id">Jurusan</label>
                    <div class="col-xs-9">
                        <select id="jurusan_id" name="jurusan_id" >
                            <?php print_r($default['jurusan_id']); foreach ($default['jurusan_id'] as $row) { ?>
                                
                                <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                        <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                    <?php echo (isset($row['display'])) ? $row['display'] : ''; ?></option>
                            <?php } ?>
                        </select>                                       
                        <span id="err_jurusan_id"></span>
                    </div>
                </div>
                <!-- end field -->
                
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="hobi">Hobi</label>
                    <div class="col-xs-9">
                        <input type="text" id="hobi" name="hobi" class="form-control" placeholder="INPUT HOBI"
                               value="<?php echo (isset($default['hobi'])) ? $default['hobi'] : ''; ?>"
                               <?php echo (isset($default['readonly_hobi'])) ? $default['readonly_hobi'] : ''; ?>
                               size="10" />
                        <span id="err_hobi"></span>
                    </div>
                </div>
                <!-- end field -->  
                  <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="agama_id">Agama</label>
                    <div class="col-xs-9">
                        <select id="agama_id" name="agama_id" >
                            <?php print_r($default['agama_id']); foreach ($default['agama_id'] as $row) { ?>
                                
                                <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                        <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                    <?php echo (isset($row['display'])) ? $row['display'] : ''; ?></option>
                            <?php } ?>
                        </select>                                       
                        <span id="err_agama_id"></span>
                    </div>
                </div>
                <!-- end field --> 
                
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="nama_ayah">Nama Ayah</label>
                    <div class="col-xs-9">
                        <input type="text" id="nama_ayah" name="nama_ayah" class="form-control" placeholder="INPUT NAMA AYAH"
                               value="<?php echo (isset($default['nama_ayah'])) ? $default['nama_ayah'] : ''; ?>"
                               <?php echo (isset($default['readonly_nama_ayah'])) ? $default['readonly_nama_ayah'] : ''; ?>
                               size="10" />
                        <span id="err_nama_ayah"></span>
                    </div>
                </div>
                <!-- end field -->  
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="nama_ibu">Nama Ibu</label>
                    <div class="col-xs-9">
                        <input type="text" id="nama_ibu" name="nama_ibu" class="form-control" placeholder="INPUT NAMA IBU"
                               value="<?php echo (isset($default['nama_ibu'])) ? $default['nama_ibu'] : ''; ?>"
                               <?php echo (isset($default['readonly_nama_ibu'])) ? $default['readonly_nama_ibu'] : ''; ?>
                               size="10" />
                        <span id="err_nama_ibu"></span>
                    </div>
                </div>
                <!-- end field -->  

                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="pekerjaan_ayah">Pekerjaan Ayah</label>
                    <div class="col-xs-9">
                        <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-control" placeholder="INPUT PEKERJAAN AYAH"
                               value="<?php echo (isset($default['pekerjaan_ayah'])) ? $default['pekerjaan_ayah'] : ''; ?>"
                               <?php echo (isset($default['readonly_pekerjaan_ayah'])) ? $default['readonly_pekerjaan_ayah'] : ''; ?>
                               size="10" />
                        <span id="err_pekerjaan_ayah"></span>
                    </div>
                </div>
                <!-- end field -->  
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="pekerjaan_ibu">Pekerjaan Ibu</label>
                    <div class="col-xs-9">
                        <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-control" placeholder="INPUT PEKERJAAN AYAH"
                               value="<?php echo (isset($default['pekerjaan_ibu'])) ? $default['pekerjaan_ibu'] : ''; ?>"
                               <?php echo (isset($default['readonly_pekerjaan_ibu'])) ? $default['readonly_pekerjaan_ibu'] : ''; ?>
                               size="10" />
                        <span id="err_pekerjaan_ibu"></span>
                    </div>
                </div>
                <!-- end field -->  
                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="nohp">Nomor Handphone</label>
                    <div class="col-xs-9">
                        <input type="text" name="nohp" id="nohp" class="form-control" placeholder="INPUT NOMOR HANDPHONE"
                               value="<?php echo (isset($default['nohp'])) ? $default['nohp'] : ''; ?>"
                               <?php echo (isset($default['readonly_nohp'])) ? $default['readonly_nohp'] : ''; ?>
                               size="10" />
                        <span id="err_nohp"></span>
                    </div>
                </div>
                <!-- end field -->  

                <!-- start field -->
                <div class="form-group">
                    <label class="control-label col-xs-3" for="email">Email</label>
                    <div class="col-xs-9">
                        <input type="text" name="email" id="email" class="form-control" placeholder="INPUT EMAIL"
                               value="<?php echo (isset($default['email'])) ? $default['email'] : ''; ?>"
                               <?php echo (isset($default['readonly_email'])) ? $default['readonly_email'] : ''; ?>
                               size="10" />
                        <span id="err_email"></span>
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

        $("#tanggallahir").datepicker({dateFormat: "dd-mm-yy"});

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
                                    nis: $("#nis").val(),
                                    nama: $("#nama").val(),
                                    jk: $("#jk").val(),
                                    tempatlahir: $("#tempatlahir").val(),
                                    tanggallahir: $("#tanggallahir").val(),
                                    alamat: $("#alamat").val(),
                                    hobi: $("#hobi").val(),
                                    jurusan_id: $("#jurusan_id").val(),
                                    agama_id: $("#agama_id").val(),
                                    nama_ayah: $("#nama_ayah").val(),
                                    nama_ibu: $("#nama_ibu").val(),
                                    pekerjaan_ayah: $("#pekerjaan_ayah").val(),
                                    pekerjaan_ibu: $("#pekerjaan_ibu").val(),
                                    nohp: $("#nohp").val(),
                                    email: $("#email").val(),
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
                                                $("#err_nis").html(data.err_nis).fadeIn('slow');
                                                $("#err_nama").html(data.err_nama).fadeIn('slow');
                                                $("#err_tempatlahir").html(data.err_tempatlahir).fadeIn('slow');
                                                $("#err_tanggallahir").html(data.err_tanggallahir).fadeIn('slow');
                                                $("#err_nama_ayah").html(data.err_nama_ayah).fadeIn('slow');
                                                $("#err_nama_ibu").html(data.err_nama_ibu).fadeIn('slow');
                                                $("#err_jurusan_id").html(data.err_jurusan_id).fadeIn('slow');
                                                $("#err_agama_id").html(data.err_agama_id).fadeIn('slow');
                                                $("#err_nohp").html(data.err_nohp).fadeIn('slow');
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

