<?php $basedata = base_url() . 'public/'; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SMK N 1 KABUPATEN TANGERANG</title>    

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo $basedata ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>public/DataTables-1.10.11/media/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/DataTables-1.10.11/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="<?php echo $basedata ?>vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?php echo $basedata ?>vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo $basedata ?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo $basedata ?>dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?php echo $basedata ?>vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo $basedata ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>public/jquery-ui/css/smoothness/jquery-ui.min.css" rel="stylesheet">

        <!-- jQuery -->

        <script src="<?php echo $basedata ?>js/jquery-3.1.1.min.js"></script>
        <script src="<?php echo $basedata ?>jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo $basedata ?>vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo $basedata ?>vendor/metisMenu/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo $basedata ?>dist/js/sb-admin-2.js"></script>

        <script src="<?php echo base_url(); ?>public/DataTables-1.10.11/media/js/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>public/DataTables-1.10.11/media/js/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>public/DataTables-1.10.11/media/api/fnReloadAjax.js"></script>
        <script src="<?php echo base_url(); ?>public/DataTables-1.10.11/media/api/fnStandingRedraw.js"></script>
        <script src="<?php echo base_url(); ?>public/DataTables-1.10.11/extensions/Buttons/js/dataTables.buttons.js"></script>
        <script src="<?php echo base_url(); ?>public/DataTables-1.10.11/extensions/Buttons/js/buttons.flash.js"></script>
        <script src="<?php echo base_url(); ?>public/DataTables-1.10.11/extensions/Buttons/js/buttons.html5.js"></script>
        <script src="<?php echo base_url(); ?>public/DataTables-1.10.11/extensions/Buttons/js/buttons.print.js"></script>
        <script src="<?php echo base_url(); ?>public/DataTables-1.10.11/extensions/Buttons/js/buttons.colVis.js"></script>



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <script type="text/javascript">
        var ROOT = {
            'site_url': '<?php echo site_url(); ?>',
            'base_url': '<?php echo base_url(); ?>',
            'controller': null,

        };</script>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $basedata ?>">SMK N 1 Kab. Tangerang</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">                                              

                            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <!-- disini untuk navigasi -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">                       
                            <li>
                                <a href="#"><i class="fa fa-dashboard fa-fw"></i> DASHBOARD</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i>MASTER DATA<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">                                   
                                    <li>
                                        <a onclick="ToController('Magama', 'Data Master Agama')">Agama</a>
                                    </li>
                                    <li>
                                        <a onclick="ToController('Mguru', 'Data Master Guru')">Guru</a>
                                    </li>
                                    <li>
                                        <a onclick="ToController('Msiswa', 'Data Master Siswa')">Siswa</a>
                                    </li>
                                    <li>
                                        <a onclick="ToController('Mkelas', 'Data Master Kelas')">Kelas</a>
                                    </li>
                                    <li>
                                        <a onclick="ToController('Mjurusan', 'Data Master Jurusan')">Jurusan</a>
                                    </li>
                                    <li>
                                        <a onclick="ToController('Mtahunajaran', 'Data Master Tahun Ajaran')">Tahun Ajaran</a>
                                    </li>
                                    <li>
                                        <a onclick="ToController('Mpelajaran', 'Data Master Pelajaran')">Mata Pelajaran</a>
                                    </li>

                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i>TRANSAKSI<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a onclick="ToController('tguru', 'Data Transaksi Guru')">Data Guru</a>
                                    </li>
                                    <li>
                                        <a onclick="ToController('tsiswa', 'Data Transaksi Siswa')">Data Siswa</a>
                                    </li>                                    
                                    <li>
                                        <a onclick="ToController('tabsen', 'Data Absensi')">Data Absensi</a>
                                    </li>
                                </ul>
                                </div>
                                <!-- /.sidebar-collapse -->
                                </div>
                                <!-- /.navbar-static-side -->
                                </nav>

                                <div id="page-wrapper">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h1 class="page-header"><span id='title'>Dashboard</span></h1>
                                        </div>
                                        <!-- /.col-lg-12 -->
                                        <div id='contentdata'>
                                            <!-- for content in here -->
                                        </div>  
                                    </div>

                                </div>
                                <!-- /#page-wrapper -->

                                </div>

                                </body>

                                </html>

                                <script type="text/javascript">
                                    var Component;

                                    function ToController(controller, title) {                                        
                                        var content = $('#contentdata');
                                        var url = ROOT.site_url + '/' + controller;
                                        ROOT.controller =  controller;
                                         
                                        $("#title").html(title);
                                        content.fadeOut("slow", "linear");
                                        content.load(url);
                                        content.fadeIn("slow");
                                        return false;
                                        url.empty();
                                    }
                                    
                                    Component = {
                                        formid: ROOT.controller,
                                        gridid: ROOT.controller,
                                        headerform: null,
                                        contentform: null,
                                        GenerateForm: function () {
                                            var me, html, btncancel, btnsave;
                                            me = this;

                                            html = '<div id="' + me.formid + '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
                                            html += '<div class="modal-dialog">';
                                            html += '<div class="modal-content">';
                                            html += '<div class="modal-header">';
                                            html += '<a class="close" data-dismiss="modal">×</a>';
                                            html += '<h4>' + me.headerform + '</h4>'
                                            html += '</div>';
                                            html += '<div class="modal-body">';
                                            html += me.contentform;
                                            html += '</div>';
                                            html += '<div class="modal-footer">';
                                            html += '<span  class="btn btn-primary" >Save</span>';
                                            html += '<span  class="btn btn-danger" onClick="Component.Cancel()" >Cancel</span>';
                                            html += '</div>';  // content
                                            html += '</div>';  // dialog
                                            html += '</div>';  // footer
                                            html += '</div>';  // modalWindow
                                            $('body').append(html);
                                            $("#" + me.formid).modal();
                                            $("#" + me.formid).modal('show');

                                            $("#" + me.formid).on('hidden.bs.modal', function (e) {
                                                $("#" + me.formid).remove();
                                                console.log('remove form');
                                            });

                                        },
                                        Cancel: function () {
                                            var me;
                                            me = this;
                                            $("#" + me.formid).modal('hide');
                                        },
                                        Save: function () {
                                             var me;
                                            me = this;

                                        },
                                        
                                    };



                                </script>