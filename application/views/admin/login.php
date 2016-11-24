<?php $basedata = base_url() . 'public/'; ?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login Apps</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo $basedata ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo $basedata ?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo $basedata ?>dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo $basedata ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Silakan login</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username" id="username" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                                    </div>
                                    <!-- start field -->
                                    <div class="form-group">
                                        <label class="" for="loginas">Pilih role</label>
                                        <select id="loginas" name="loginas"  onchange="loginAs()">
                                            <?php
                                            foreach ($default['loginas'] as $row) {
                                                ?>

                                                <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?></option>
                                            <?php } ?>
                                        </select>                                       
                                        <span id="err_loginas"></span>
                                    </div>
                                    <!-- end field -->
                                    <!-- start field -->
                                    <div class="form-group"  id="content_kelas">
                                        <label class="" for="kelas_id">Kelas</label>
                                        <select id="kelas_id" name="kelas_id" >
                                            <?php
                                            foreach ($default['kelas_id'] as $row) {
                                                ?>

                                                <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?></option>
                                            <?php } ?>
                                        </select>                                       
                                        <span id="err_kelas_id"></span>
                                    </div>
                                    <!-- end field -->
                                    <!-- start field -->
                                    <div class="form-group"  id="content_matpel">
                                        <label class="" for="matapelajaran_id">Pelajaran</label>
                                        <select id="matapelajaran_id" name="matapelajaran_id" >
                                            <?php
                                            foreach ($default['matapelajaran_id'] as $row) {
                                                ?>

                                                <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?></option>
                                            <?php } ?>
                                        </select>                                       
                                        <span id="err_matapelajaran_id"></span>
                                    </div>
                                    <!-- end field -->
                                    <!-- start field -->
                                    <div class="form-group" id="content_tahunajaran">
                                        <label class="" for="tahunajaran_id">Tahun Ajaran</label>
                                        <select id="tahunajaran_id" name="tahunajaran_id" >
                                            <?php
                                            foreach ($default['tahunajaran_id'] as $row) {
                                                ?>

                                                <option value="<?php echo (isset($row['value'])) ? $row['value'] : ''; ?>" 
                                                    <?php echo (isset($row['selected'])) ? $row['selected'] : ''; ?> >
                                                <?php echo (isset($row['display'])) ? $row['display'] : ''; ?></option>
                                            <?php } ?>
                                        </select>                                       
                                        <span id="err_tahunajaran_id"></span>
                                    </div>
                                    <!-- end field -->
                                    <!-- Change this to a button or input when using this as a form -->
                                 <input id="login" type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?php echo $basedata ?>vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo $basedata ?>vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo $basedata ?>vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo $basedata ?>dist/js/sb-admin-2.js"></script>

    </body>

</html>

<script type="text/javascript">
    var kelas,tahunajaran,matpel,loginas,url_post;
    
    url_post = '<?php echo $url_post; ?>';     
    $("#content_matpel").hide();
    $("#content_kelas").hide();
    $("#content_tahunajaran").hide();
    
    function loginAs(){
        loginas = $("#loginas").val();
        switch (loginas){
            case '1':
                $("#content_matpel").hide();
                $("#content_kelas").hide();
                $("#content_tahunajaran").hide();
            break;    
            case '2':
                $("#content_matpel").show();
                $("#content_kelas").show();
                $("#content_tahunajaran").show();
            break;    
            case '3':
                $("#content_matpel").show();
                $("#content_kelas").show();
                $("#content_tahunajaran").show();
            break; 
            
        }
        
    }
    
    
    $(document).ready(function ()
    {
        
   
    $('#login').click(
                function ()
                {
                    $.ajax(
                            {
                                type: "POST",
                                url: url_post,
                                dataType: "json",                                 
                                data: {
                                    username: $("#username").val(),
                                    password: $("#password").val(),
                                    kelas_id: $("#tahunajaran_id").val(),
                                    loginas: $("#tahunajaran_id").val(),
                                    tahunajaran_id: $("#tahunajaran_id").val(),
                                    matapelajaran_id: $("#matapelajaran_id").val()
                                   
                                },
                                cache: false,
                                success:
                                        function (data, text)
                                        {
                                            if (data.hasil == 'true') {
                                             
                                            } else {
                                               
                                              
                                            }
                                        },
                                error: function (request, status, error) {
                                    alert(request.responseText + " " + status + " " + error);
                                }
                            });
                    return false;


                });
                });
    
    
</script>    
