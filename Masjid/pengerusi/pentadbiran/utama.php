<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Pengurusan Masjid</title>

   <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</head>

<body>
<style>

.background {
  background-image: url("muka_depan.jpg"); /* The image used */
  background-color: #cccccc; /* Used if the image is unavailable */
  height: 500px; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */
}
</style>
</head>





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
                <a class="navbar-brand" href="index.html">SISTEM PENGURUSAN MASJID</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

     <!-- MENU SECTION -->
       <?php 
      include("Connections/billing_connect.php"); 
      include("sidebar/sedebar.php"); 
      ?>
        <!--END MENU SECTION -->


        <!-- Page Content -->
        <div id="page-wrapper">
            <?php 
        $view = $_GET["view"];

         if ($view=="home")
        {
          include("home/home.php");
        }
         elseif ($view=="pendaftaran")   //DAFTAR QARIAH
        {
          include("pendaftaran/pendaftaran_dashboard.php");
		}
        elseif ($view=="pendaftaran_ahli_qariah")   //DAFTAR QARIAH
        {
          include("pendaftaran/daftar_qariah.php");
        }
		  elseif ($view=="view_ahliqariah")   // VIEW DAFTAR QARIAH
        {
          include("pendaftaran/view_ahliqariah.php");
        }
		elseif ($view=="edit_ahliqariah")   // EDIT DAFTAR QARIAH
        {
          include("pendaftaran/edit_ahliqariah.php");
        }
        elseif ($view=="pendaftaran_layak_mengundi")   //DAFTAR LAYAK MENGUNDI
        {
          include("pendaftaran/daftar_layak_undi.php");
		}
        elseif ($view=="pendaftaran_kematian")   //DAFTAR KEMATIAN
        {
          include("pendaftaran/daftar_kematian.php");
        }
         elseif ($view=="pendaftaran_zakat")   //DAFTAR ZAKAT
        {
          include("pendaftaran/daftar_zakat.php");
        }
         elseif ($view=="pendaftaran_anak_yatim")   //DAFTAR ANAK YATIM
        {
          include("pendaftaran/daftar_anak_yatim.php");
        }
         elseif ($view=="pendaftaran_asnaf")   //DAFTAR ASNAF/FAQIR
        {
          include("pendaftaran/daftar_asnaf.php");
        }

         elseif ($view=="pendaftaran_nikah")   //DAFTAR NIKAH
        {
          include("pendaftaran/daftar_nikah.php");
        }


        elseif ($view=="pendaftaran_cerai")   //DAFTAR CERAI
        {
          include("pendaftaran/daftar_cerai.php");
        }


        elseif ($view=="pendaftaran_ibu_tunggal")   //DAFTAR IBU TUNGGAL
        {
          include("pendaftaran/daftar_ibu_tunggal.php");
        }


        elseif ($view=="pendaftaran_sakit_kronik")   //DAFTAR SAKIT KRONIK
        {
          include("pendaftaran/daftar_sakit_kronik.php");
        }


        elseif ($view=="pendaftaran_oku")   //DAFTAR OKU
        {
          include("pendaftaran/daftar_oku.php");
        }

 		elseif ($view=="pendaftaran_qairat")   
        {
          include("pendaftaran/pakatan_qairat.php");
        }
        elseif ($view=="pendaftaran_warga_emas")   //DAFTAR WARGA EMAS
        {
          include("pendaftaran/daftar_warga_emas.php");
		}
		  elseif ($view=="pendaftaran_pejabatagama")   //PEJABAT AGAMA
        {
          include("pendaftaran/dashboard_pejabat_agama.php");

	    }elseif ($view=="laporanaktiviti") {
          include("pentadbiran/laporanaktiviti.php");  
	    }elseif ($view=="minitmensyuarat") {
          include("pentadbiran/minit_mensyuarat.php");
		}elseif ($view=="suratnotis") {
          include("pentadbiran/surat_notis.php");
		}elseif ($view=="laporanpendapatan") {
          include("pentadbiran/laporan_pendapatan.php");
		  
		}elseif ($view=="penyata2018") {
          include("pentadbiran/laporan_pendapatan2018.php");
        }elseif ($view=="bukutunai") {
          include("pentadbiran/bukuTunai.php");
		}elseif ($view=="penyata") {
          include("pentadbiran/laporan.php");
		}elseif ($view=="terimabayaran") {
          include("pentadbiran/terima_bayaran.php");
	    }elseif ($view=="selenggara") {
          include("pentadbiran/selenggara.php");
		 }elseif ($view=="maklumatselenggara") {
          include("pentadbiran/maklumat_selenggara.php");
		}elseif ($view=="kerosakan") {
          include("pentadbiran/kerosakan.php");
		}elseif ($view=="maklumatkerosakan") {
          include("pentadbiran/maklumat_kerosakan.php");
		}elseif ($view=="sewa") {
          include("pentadbiran/sewa.php");
		}elseif ($view=="maklumatsewa") {
          include("pentadbiran/maklumat_sewa.php");
	    }elseif ($view=="inventori") {
          include("pentadbiran/inventori.php");
		}elseif ($view=="maklumatinventori") {
          include("pentadbiran/maklumat_inventori.php");
		}elseif ($view=="utiliti") {
          include("pentadbiran/utiliti.php");
		}elseif ($view=="maklumatutiliti") {
          include("pentadbiran/maklumat_utiliti.php");
		 }elseif ($view=="kehadiran") {
          include("pentadbiran/kehadiran_keseluruhan.php");
		 }
		 elseif ($view=="kehadiranterperinci") {
          include("pentadbiran/kehadiran_terperinci.php");  //kehadiran terperinci
		 }elseif ($view=="jadual") {
          include("pentadbiran/jadual_ajkmasjid.php");  
		  
		}elseif ($view=="aduan") {
          include("aduan/aduan.php");
		}elseif ($view=="komuniti") {
          include("info/komuniti.php");
		}elseif ($view=="kafa") {
          include("info/kafa.php");
		}elseif ($view=="kemas") {
          include("info/kemas.php");
		}elseif ($view=="sekolah") {
          include("info/sekolah.php");
		}elseif ($view=="pasti") {
          include("info/pasti.php");
		}elseif ($view=="rukuntetangga") {
          include("info/rukuntetangga.php");
		}elseif ($view=="belia") {
          include("info/belia.php");
		}elseif ($view=="balai") {
          include("info/balai.php");
		}elseif ($view=="persatuan") {
          include("info/persatuan.php");
		}elseif ($view=="surau") {
          include("info/surau.php");
		}elseif ($view=="klinik") {
          include("info/klinik.php");
		}elseif ($view=="hebahan") {
          include("info/hebahan.php");
		}elseif ($view=="rumahibadat") {
          include("info/rumah_ibadat.php");
		  
	    }elseif ($view=="ajkmasjid") {
          include("tetapan/ajk_masjid.php");
		}

		 //REPORTS


         elseif  ($view=="laporan")
        {
          include("laporan/laporan_dashboard.php");
        }


        elseif ($view=="laporan_tabung_bergerak")   //TABUNG BERGERAK
        {
          include("laporan/tabung_bergerak.php");
        }

        elseif ($view=="laporan_tabung_am")   //TABUNG AM
        {
          include("laporan/tabung_am.php");
        }

        elseif ($view=="laporan_tabung_kebajikan")   //DAFTAR KEBAJIKAN
        {
          include("laporan/tabung_kebajikan.php");
        }

        elseif ($view=="laporan_tabung_kematian")   //DAFTAR KEMATIAN
        {
          include("laporan/tabung_kematian.php");
        }

        elseif ($view=="laporan_tabung_kenduri")   //DAFTAR KENDURI
        {
          include("laporan/tabung_kenduri.php");
        }

        elseif ($view=="laporan_tabung_wakaf")   //DAFTAR WAKAF
        {
          include("laporan/tabung_wakaf.php");
        }

        elseif ($view=="laporan_tlk_wakaf_kubur")   //DAFTAR WAKAF KUBUR
        {
          include("laporan/tabung_tlk_wakaf_kubur.php");
        }

        elseif ($view=="laporan_tlk_wakaf_masjid")   //DAFTAR WAKAF MASJID
        {
          include("laporan/tabung_tlk_wakaf_masjid.php");
		  
         }elseif ($view=="solatjumaat") {
          include("laporan/solat_jumaat.php");
		  
		 }elseif ($view=="pengurusanjenazah") {
          include("laporan/penyata_perbelanjaan.php");
		  
		  }elseif ($view=="carian") {
          include("carian/carian.php");



}
      ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    
    

</body>

</html>

