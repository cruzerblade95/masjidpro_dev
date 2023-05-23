<?php
include("connection/connection.php");
$result= mysqli_query($bd2,"SELECT id_masjid,kod_masjid,nama_masjid,alamat_masjid FROM sej6x_data_masjid WHERE kod_masjid='$jname'") or die("SELECT Error: ".mysql_error());
$namamasjid = mysqli_fetch_assoc($result);
?>


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Utama</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard&qariah=semua">Statistik Ahli Kariah</a></li>
                    <li><a href="utama.php?view=admin&action=dashboard_payment">Statistik Bayaran</a></li>
                    <li class="active">Statistik Bayaran</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css"-->

<script id="pilih_jquery" src="js/jquery-3.4.1.js"></script>
<script id="pilih_ui" src="js/jquery-ui.js"></script>
<script>
    //function semak() {
    //    var dari = $('#dari').val();
    //    var hingga = $('#hingga').val();
    //    document.location.href='utama.php?view=admin&action=dashboard_payment&dari='+dari+'&hingga='+hingga
    //}
    $(document).ready(function () {
        $( "#datepicker" ).datepicker({
            altField: "#dari",
            altFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
        $( "#datepicker1" ).datepicker({
            altField: "#hingga",
            altFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<div class="content mt-3">
    <div class="row" style="display:none">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php
                    if(isset($_GET['dari']) AND isset($_GET['hingga']))
                    {
                        ?>
                        <div class="col-lg-3">
                        </div>
                        <div class="col-lg-6" align="center">
                            <a href="utama.php?view=admin&action=dashboard_payment" class="btn btn-primary">Carian Tarikh</a>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <form enctype="multipart/form-data" id="rekod_bayaran" name="rekod_bayaran" action="utama.php" method="GET" style="display:none">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="hidden" name="view" value="admin">
                                    <input type="hidden" name="action" value="dashboard_payment">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    Dari : <input type="date" id="datepicker" name="dari">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    Hingga : <input type="date" id="datepicker1" name="hingga">
                                </div>
                            </div>
                            <div class="col-lg-12" align="center">
                                <div class="form-group">
                                    <!-- <input type="hidden" name="dari" id="dari">
                                    <input type="hidden" name="hingga" id="hingga">
                                    <input type="button" class="btn btn-primary" onclick="semak();" value="Papar"> -->
                                    <input type="submit" class="btn btn-primary" value="Papar">
                                </div>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    //$tarikh_awal = "".$_GET['dari']."";
    $tarikh_awal = $_GET['dari'];
    $tarikh_awal=str_replace("'","",$tarikh_awal);
    $tarikh_awal=str_replace("/","-",$tarikh_awal);
    $year_awal=substr($tarikh_awal, 0, 4);
    $month_awal=substr($tarikh_awal, 5, 2);
    $day_awal=substr($tarikh_awal, 8,2);
    $tarikh_awal=$year_awal."-".$month_awal."-".$day_awal;

    //$tarikh_akhir = "".$_GET['hingga']."";
    $tarikh_akhir = $_GET['hingga'];
    $tarikh_akhir=str_replace("'","",$tarikh_akhir);
    $tarikh_akhir=str_replace("/","-",$tarikh_akhir);
    $year_akhir=substr($tarikh_akhir, 0, 4);
    $month_akhir=substr($tarikh_akhir, 5, 2);
    $day_akhir=substr($tarikh_akhir, 8,2);
    $tarikh_akhir=$year_akhir."-".$month_akhir."-".$day_akhir;

    $q_main = "SELECT SUM(amaun) 'amaun' FROM sej6x_data_bantuan WHERE id_masjid = $id_masjid AND status_bantuan = '1'";
    $sql_main = "SELECT * FROM sej6x_data_bantuan WHERE id_masjid='$id_masjid' AND status_bantuan='1'";

    if($_GET['dari'] != NULL && $_GET['hingga'] != NULL) $q_main .= " AND tarikh_bayaran BETWEEN CAST('$tarikh_awal 00:00:00' AS DATETIME) AND CAST('$tarikh_akhir 23:59:59' AS DATETIME)";
    if($_GET['dari'] != NULL && $_GET['hingga'] != NULL) $sql_main .= " AND tarikh_bayaran BETWEEN CAST('$tarikh_awal 00:00:00' AS DATETIME) AND CAST('$tarikh_akhir 23:59:59' AS DATETIME)";

    //Bekalan Asas
    $sql = "$sql_main AND jenis_bantuan = 'Bekalan Asas'";
    $sqlquery = mysqli_query($bd2, $sql);
    $row5 = mysqli_num_rows($sqlquery);

    //Kewangan
    $sql1 = "$sql_main AND jenis_bantuan = 'Kewangan'";
    $sqlquery1 = mysqli_query($bd2, $sql1);
    $row6 = mysqli_num_rows($sqlquery1);

    //Kesihatan
    $sql2 = "$sql_main AND jenis_bantuan = 'Kesihatan'";
    $sqlquery2 = mysqli_query($bd2, $sql2);
    $row7 = mysqli_num_rows($sqlquery2);

    //Kecemasan
    $sql3 = "$sql_main AND jenis_bantuan = 'Kecemasan'";
    $sqlquery3 = mysqli_query($bd2, $sql3);
    $row8 = mysqli_num_rows($sqlquery3);

    //Bencana
    $sql4 = "$sql_main AND jenis_bantuan = 'Bencana'";
    $sqlquery4 = mysqli_query($bd2, $sql4);
    $row9 = mysqli_num_rows($sqlquery4);

    //Lain-Lain
    $sql5 = "$sql_main AND jenis_bantuan = 'Lain-Lain'";
    $sqlquery5 = mysqli_query($bd2, $sql5);
    $row10 = mysqli_num_rows($sqlquery5);
    ?>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script>

        $(function() {

            new Chart(document.getElementById("chart"),
                {
                    "type":"bar",
                    "data":{"labels":["Bekalan Asas","Kewangan","Kesihatan","Kecemasan","Bencana","Lain-Lain"],
                        "datasets":[{
                            "label":"Jumlah Bantuan",
                            "data":[<?php echo $row5; ?>,<?php echo $row6; ?>,<?php echo $row7; ?>,<?php echo $row8; ?>,<?php echo $row9; ?>,<?php echo $row10; ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
                    "options":{
                        "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
                    }
                });
        });
    </script>
    <?php
    if(isset($_GET['dari']) AND isset($_GET['hingga']))
    {
        ?>
        <div class="row">
            <div class="col-lg-12" align="center">
                <h4>Carian Tarikh Dari <?php echo $tarikh_awal; ?> Sehingga <?php echo $tarikh_akhir; ?></h4>
            </div>
        </div>
        <br>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistik Bantuan</h4>
                    <div>
                        <canvas id="chart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered display nowrap margin-top-10 w-p100">
                            <thead>
                            <tr>
                                <th><div align="center">#</div></th>
                                <th><div align="center">Nama</div></th>
                                <th><div align="center">No K/P</div></th>
                                <th><div align="center">Jenis Bantuan</div></th>
                                <!-- <th><div align="center">Jumlah Amaun Bayaran</div></th>
                                <th><div align="center">Caj Pengurusan</div></th>
                                <th><div align="center">Jumlah Amaun Bersih</div></th>
                                <th><div align="center">Senarai Nama</div></th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $j = 1;
                            $kuiri = "SELECT * FROM sej6x_data_bantuan WHERE id_masjid='$id_masjid' AND status_bantuan='1'";
                            $kuirirun = mysqli_query($bd2,$kuiri);

                            while($run = mysqli_fetch_array($kuirirun))
                            {
                                $no_ic = $run['no_ic'];
                                ?>
                                <tr>
                                    <td align="center"><?php echo $j; ?></td>
                                    <td align="center">
                                        <?php
                                        $kuiri1 = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
                                        $kuirirun1 = mysqli_query($bd2,$kuiri1);

                                        if(mysqli_num_rows($kuirirun1)==0)
                                        {
                                            $kuiri1 = "SELECT * FROM sej6x_data_anakqariah WHERE no_ic='$no_ic'";
                                            $kuirirun1 = mysqli_query($bd2,$kuiri1);
                                        }
                                        $run1 = mysqli_fetch_array($kuirirun1);
                                        echo $run1['nama_penuh'];
                                        ?>
                                    </td>
                                    <td align="center"><?php echo $no_ic; ?></td>
                                    <td align="center"><?php echo $run['jenis_bantuan']; ?></td>
                                </tr>
                                <?php
                                $j++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Maklumat Bantuan', [ 0, 1, 2, 3]);
    });
</script>