<?php

include('../connection/connection.php');

$id_5s=$_GET['id_5s'];

$sql0="SELECT * FROM majlis_5S WHERE id_5s='$id_5s'";
$sqlquery0=mysqli_query($bd2,$sql0);
$data0=mysqli_fetch_array($sqlquery0);

$id_masjid=$data0['id_masjid'];

$sql_masjid="SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
$query_masjid=mysqli_query($bd2,$sql_masjid);
$data_masjid=mysqli_fetch_array($query_masjid);

$sql = "SELECT * FROM 5S WHERE id_5s='$id_5s'";
$aspek1 = " AND aspek='1'";
$aspek2 = " AND aspek='2'";
$komponen1 = " AND komponen='1'";
$komponen2 = " AND komponen='2'";
$komponen3 = " AND komponen='3'";
$komponen4 = " AND komponen='4'";
$komponen5 = " AND komponen='5'";
$komponen6 = " AND komponen='6'";
$menu1 = " AND menu='1'";
$menu2 = " AND menu='2'";
$menu3 = " AND menu='3'";
$menu4 = " AND menu='4'";
$menu5 = " AND menu='5'";
$menu6 = " AND menu='6'";
$menu7 = " AND menu='7'";
$menu8 = " AND menu='8'";
$menu9 = " AND menu='9'";
$menu10 = " AND menu='10'";

?>
<html>
<head>
    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
    <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>-->
    <!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.css" integrity="sha512-Mg1KlCCytTmTBaDGnima6U63W48qG1y/PnRdYNj3nPQh3H6PVumcrKViACYJy58uQexRUrBqoADGz2p4CdmvYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.js" integrity="sha512-XQoeBcMhSbY8p1wDZWtaQZMOgqIb7QuGmh/8/EwA/xTzoREW+tcOvm5wPU4WnbAEX19LFkMXQh8YKzrIJfg9zQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.js" integrity="sha512-nw7zwODD4UD9u/C/CO+03s7jXvOZDomBNFX3oOq7Xv0stAyxsxhJzVlxsRTgH3AxK3sK2ijMQou2aSIaorp19g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #aaaaaa;
            text-align: left;
            padding: 8px;
        }

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
    </style>
    <script>
        $(document).ready(function () {

            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');
            allBackBtn = $('.backBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            allBackBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;


                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });


            $('div.setup-panel div a.btn-primary').trigger('click');
        });
    </script>
</head>
<body>
<div class="container" align="center">
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-12"><h2>Rekod 5S <?php echo $data0['tahun']; ?><br><?php echo $data_masjid['nama_masjid']; ?></h2></div>
    </div>
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                <p>Step 1</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p>Step 2</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p>Step 3</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p>Step 4</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                <p>Step 5</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
                <p>Step 6</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">7</a>
                <p>Step 7</p>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <table align="center" border="1">
                    <tr>
                        <th colspan="8"> ASPEK 1 : PENGURUSAN BILIK AIR </th>
                    </tr>
                    <tr>
                        <th width="4%">1.</th>
                        <th colspan="4"> KOMPONEN : KEADAAN PERSEKITARAN </th>
                        <th width="5%"> SKOR </th>
                        <th width="9%"> SKOR PENUH </th>
                        <th width="10%"> SKOR DIPEROLEH </th>
                    </tr>
                    <tr>
                        <th rowspan="6"></th>
                        <th width="4%" rowspan="6">A.</th>
                        <th rowspan="6"> Lokasi </th>
                        <td width="4%">1.</td>
                        <th> Bekalan air yang bersih </th>
                        <th>
                            <center>
                                <?php
                                $sub_menu1 = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu1);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="6"><center>6</center></th>
                        <th rowspan="6">
                            <center>
                                <div id="dis_lokasi">
                                    <?php
                                    $skor_menu1=0;
                                    $sql_menu1=$sql.$aspek1.$komponen1.$menu1;
                                    $sqlquery=mysqli_query($bd2,$sql_menu1);
                                    while($data=mysqli_fetch_array($sqlquery))
                                    {
                                        $skor_menu1=$skor_menu1+$data['skor'];
                                    }
                                    echo $skor_menu1;
                                    ?>
                                </div>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Bekalan air yang mencukupi</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu2 = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu2);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Bekalan air tidak berbau</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu3 = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu3);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Tekanan air yang baik</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu4 = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu4);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <th>Tangki air berfungsi dengan baik</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu5 = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu5);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <th>Sistem perpaipan berfungsi dengan baik</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu6 = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu6);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="4"></th>
                        <th width="4%" rowspan="4">B.</th>
                        <th rowspan="4"> Tangki Septik </th>
                        <td width="4%">1.</td>
                        <th> Berfungsi dengan baik </th>
                        <th>
                            <center>
                                <?php
                                $sub_menu1 = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu1);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="4"><center>4</center></th>
                        <th rowspan="4">
                            <center>
                                <div id="dis_tangki">
                                    <?php
                                    $skor_menu2=0;
                                    $sql_menu2 = $sql.$aspek1.$komponen1.$menu2;
                                    $sqlquery=mysqli_query($bd2,$sql_menu2);
                                    while($data=mysqli_fetch_array($sqlquery))
                                    {
                                        $skor_menu2=$skor_menu2+$data['skor'];
                                    }
                                    echo $skor_menu2;
                                    ?>
                                </div>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Mempunyai rekod kekerapan penyelenggaraan</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu2 = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu2);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Bertutup</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu3 = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu3);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Mudah diselenggara</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu4 = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu4);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th width="4%" rowspan="5">C.</th>
                        <th rowspan="5"> Pengudaraan </th>
                        <td width="4%">1.</td>
                        <th> Mempunyai kipas penyedut udara/ Mempunyai Kipas siling </th>
                        <th>
                            <center>
                                <?php
                                $sub_menu1 = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu1);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <div id="dis_pengudaraan">
                                    <?php
                                    $skor_menu3=0;
                                    $sql_menu3 = $sql.$aspek1.$komponen1.$menu3;
                                    $sqlquery=mysqli_query($bd2,$sql_menu3);
                                    while($data=mysqli_fetch_array($sqlquery))
                                    {
                                        $skor_menu3 = $skor_menu3 + $data['skor'];
                                    }
                                    echo $skor_menu3;
                                    ?>
                                </div>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Kipas penyedut udara berfungsi/ Kipas siling berfungsi</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu2 = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu2);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Mempunyai tingkap/ ruangan bukaan kekal.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu3 = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu3);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Tingkap/ruangan bukaan kekal mencukupi</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu4 = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu4);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <th>Bilik air tidak berbau busuk</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu5 = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu5);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th width="4%" rowspan="5">D.</th>
                        <th rowspan="5"> Pencahayaan </th>
                        <td width="4%">1.</td>
                        <th> Mempunyai lampu yang mencukupi </th>
                        <th>
                            <center>
                                <?php
                                $sub_menu1 = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu1);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <div id="dis_pencahayaan">
                                    <?php
                                    $skor_menu4=0;
                                    $sql_menu4 = $sql.$aspek1.$komponen1.$menu4;
                                    $sqlquery=mysqli_query($bd2,$sql_menu4);
                                    while($data=mysqli_fetch_array($sqlquery))
                                    {
                                        $skor_menu4 = $skor_menu4 + $data['skor'];
                                    }
                                    echo $skor_menu4;
                                    ?>
                                </div>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Lampu menerangi bilik air</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu2 = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu2);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Mempunyai tingkap telus cahaya</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu3 = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu3);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Semua lampu berfungsi dengan baik</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu4 = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu4);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <th>Semua suis lampu berfungsi dengan baik</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu5 = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu5);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th width="4%">2.</th>
                        <th colspan="4"> KOMPONEN : STRUKTUR DAN PENYELENGGARAAN </th>
                        <th width="5%"> SKOR </th>
                        <th width="9%"> SKOR PENUH </th>
                        <th width="10%"> SKOR DIPEROLEH </th>
                    </tr>
                    <tr>
                        <th rowspan="10"></th>
                        <th width="4%" rowspan="10">A.</th>
                        <th rowspan="10"> Lantai </th>
                        <td width="4%">1.</td>
                        <th> Bertile </th>
                        <th>
                            <center>
                                <?php
                                $sub_menu1 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu1);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="10"><center>10</center></th>
                        <th rowspan="10">
                            <center>
                                <div id="dis_lantai">
                                    <?php
                                    $skor_menu1=0;
                                    $sql_menu1 = $sql.$aspek1.$komponen2.$menu1;
                                    $sqlquery=mysqli_query($bd2,$sql_menu1);
                                    while($data=mysqli_fetch_array($sqlquery))
                                    {
                                        $skor_menu1 = $skor_menu1 + $data['skor'];
                                    }
                                    echo $skor_menu1;
                                    ?>
                                </div>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Bewarna Gelap</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu2 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu2);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Tidak retak atau pecah</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu3 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu3);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Bersih daripada sampah</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu4 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu4);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <th>Tidak Berdaki dan berlumut</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu5 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu5);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <th>Tidak berdebu dan berpasir</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu6 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu6);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <th>Tidak Licin</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu7 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='7'";
                                $sqlquery=mysqli_query($bd2,$sub_menu7);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <th>Mempunyai kecuraman lantai yang baik</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu8 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='8'";
                                $sqlquery=mysqli_query($bd2,$sub_menu8);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <th>Tidak memasang pelapik lantai</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu9 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='9'";
                                $sqlquery=mysqli_query($bd2,$sub_menu9);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <th>Perangkap lantai mencukupi</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu10 = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='10'";
                                $sqlquery=mysqli_query($bd2,$sub_menu10);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th width="4%" rowspan="5">B.</th>
                        <th rowspan="5"> Mangkuk Tandas </th>
                        <td width="4%">1.</td>
                        <th> Tidak retak dan sumbing </th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <div id="dis_mangkuk">
                                    <?php
                                    $skor_menu=0;
                                    $sql_menu = $sql.$aspek1.$komponen2.$menu2;
                                    $sqlquery=mysqli_query($bd2,$sql_menu);
                                    while($data=mysqli_fetch_array($sqlquery))
                                    {
                                        $skor_menu = $skor_menu + $data['skor'];
                                    }
                                    echo $skor_menu;
                                    ?>
                                </div>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Tiada kesan najis</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Diperbuat daripada seramik yang mudah dicuci</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Sistem flush berfungsi</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <th>Tidak berlumut</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                </table>
                <br>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <table align="center" border="1">
                    <tr>
                        <th rowspan="6" width="4%"></th>
                        <th rowspan="6" width="4%">C.</th>
                        <td rowspan="6">Dinding</td>
                        <th width="4%"> 1. </th>
                        <td> Jubin berkilat. </td>
                        <th width="5%">
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="6" width="9%"><center>6</center></th>
                        <th rowspan="6" width="10%">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen2.$menu3;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Jubin bersih.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Kalis air. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Berjubin sepenuhnya atau separuh.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td> Tidak retak atau pecah. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 6. </th>
                        <td> Warna cat yang terang. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="4"></th>
                        <th rowspan="4">D.</th>
                        <td rowspan="4">Siling</td>
                        <th> 1. </th>
                        <td> Bersih dari kesan kotoran. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="4"><center>4</center></th>
                        <th rowspan="4">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen2.$menu4;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Tidak bersawang.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Tidak rosak/pecah/retak. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Warna terang.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th rowspan="5">E.</th>
                        <td rowspan="5">Sinki</td>
                        <th> 1. </th>
                        <td> Tidak retak. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu5." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen2.$menu5;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Tidak rosak.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu5." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Sentiasa bersih. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu5." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Pili air berfungsi.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu5." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Tidak tersumbat.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu5." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="6"></th>
                        <th rowspan="6">F.</th>
                        <td rowspan="6">Pintu</td>
                        <th> 1. </th>
                        <td> Dalam keadaan baik. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="6"><center>6</center></th>
                        <th rowspan="6">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen2.$menu6;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Kalis air.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Bukaan pintu ke dalam. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Bersih dari kesan kotoran.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Tiada kesan contengan.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 6. </th>
                        <td>Mempunyai selak yang berfungsi.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th rowspan="5">G.</th>
                        <td rowspan="5">Saliran permukaan longkang</td>
                        <th> 1. </th>
                        <td> Tidak berlumut. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu7." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen2.$menu7;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Tiada sampah.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu7." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Tidak berbau busuk. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu7." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Tidak tersumbat.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu7." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Saliran lancar dan sempurna.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu7." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="6"></th>
                        <th rowspan="6">H.</th>
                        <td rowspan="6">Pili Air/Hos</td>
                        <th> 1. </th>
                        <td> Mempunyai pili air. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu8." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="6"><center>6</center></th>
                        <th rowspan="6">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen2.$menu8;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Mempunyai hos.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu8." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Berfungsi dengan baik. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu8." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Mempunyai penyangkut hos air.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu8." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Label arahan menyangkut kembali hos.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu8." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 6. </th>
                        <td>Tidak rosak.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu8." AND sub_menu='7'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">I.</th>
                        <td rowspan="2">Keluasan Bilik Air</td>
                        <th> 1. </th>
                        <td> Tidak kurang 3 kaki lebar. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu9." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="2"><center>2</center></th>
                        <th rowspan="2">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen2.$menu9;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Tidak kurang 5 kaki panjang.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu9." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th rowspan="5">J.</th>
                        <td rowspan="5">Sistem flush</td>
                        <th> 1. </th>
                        <td> Mempunyai penutup. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu10." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen2.$menu10;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Tidak retak.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu10." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Berfungsi dengan baik. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu10." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Tidak melimpah.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu10." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Air tidak menitik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen2.$menu10." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                </table>
                <br>
                <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <table align="center" border="1">
                    <tr>
                        <th width="4%">3</th>
                        <th colspan=4> KOMPONEN: ALAT KEMUDAHAN SANITASI </th>
                        <th width="5%"> SKOR </th>
                        <th width="9%"> SKOR PENUH </th>
                        <th width="10%"> SKOR DIPEROLEH </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th rowspan="5" width="4%">A.</th>
                        <th rowspan="5">Bekas Sabun</th>
                        <th width="4%"> 1. </th>
                        <td> Berdekatan dengan sinki </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen3.$menu1;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Berfungsi dengan baik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Bekalan sabun mencukupi. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Bersih.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td> Sabun jenis cecair. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="3"></th>
                        <th rowspan="3">B.</th>
                        <th rowspan="3">Tisu Tandas/Alat Pengering Tangan</th>
                        <th> 1. </th>
                        <td> Berdekatan sinki. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="3"><center>3</center></th>
                        <th rowspan="3">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen3.$menu2;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Berkeadaan elok/Berfungsi dengan baik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Bekalan tisu mencukupi. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu2." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="6"></th>
                        <th rowspan="6">C.</th>
                        <th rowspan="6">Tong Sampah/Tong Sanitasi</th>
                        <th> 1. </th>
                        <td> Mempunyai penutup. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu3." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="6"><center>6</center></th>
                        <th rowspan="6">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen3.$menu3;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Mempunyai karung plastik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu3." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>

                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Mencukupi. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu3." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Diselenggara setiap hari.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu3." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td> Tong sampah dan penutup bersih. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu3." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 6. </th>
                        <td> Lokasi yang sesuai. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen3.$menu3." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th>4</th>
                        <th colspan=4> KOMPONEN: PENUNJUK ARAH, LABEL DAN NOTIS-NOTIS.</th>
                        <th> SKOR</th>
                        <th> SKOR PENUH </th>
                        <th> SKOR DIPEROLEH </th>
                    </tr>
                    <tr>
                        <th rowspan="4"></th>
                        <th rowspan="4">A.</th>
                        <th rowspan="4">Penunjuk Arah dan Label</th>
                        <th> 1. </th>
                        <td> Mempunyai label bilik air lelaki/perempuan. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="4"><center>4</center></th>
                        <th rowspan="4">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen4.$menu1;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Mempunyai label bilik air OKU.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Mempunyai penunjuk arah yang jelas. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Kedudukan penunjuk arah yang strategik..</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="8"></th>
                        <th rowspan="8">B.</th>
                        <th rowspan="8">Notis-notis</th>
                        <th> 1. </th>
                        <td> Notis doa masuk dan keluar tandas diluar tandas </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="8"><center>8</center></th>
                        <th rowspan="8">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen4.$menu2;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Notis menjimatkan air.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Notis flush kembali selepas guna. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu2." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Notis menggantung hos selepas guna.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu2." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Notis menggunakan selipar khas sahaja.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu2." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 6. </th>
                        <td> Mudah dilihat dan difahami. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu2." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 7. </th>
                        <td>Disediakan dalam keadaan seragam.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu2." AND sub_menu='7'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 8. </th>
                        <td>Disediakan dalam keadaan kemas.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen4.$menu2." AND sub_menu='8'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th>5</th>
                        <th colspan=4> KOMPONEN: AKTIVITI PEMBERSIHAN.</th>
                        <th> SKOR</th>
                        <th> SKOR PENUH </th>
                        <th> SKOR DIPEROLEH </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th rowspan="5">A.</th>
                        <th rowspan="5">Jadual Pembersihan/Cucian</th>
                        <th> 1. </th>
                        <td> Mempunyai jadual.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen5.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen5.$menu1;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Jadual sentiasa dipatuhi.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen5.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Aktiviti pembersihan direkod. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen5.$menu1." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Mempunyai kekerapan pencucian.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen5.$menu1." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Diselia.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen5.$menu1." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">B.</th>
                        <th rowspan="2">Setor Barang Cucian</th>
                        <th> 1. </th>
                        <td> Setor khas.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen5.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="2"><center>2</center></th>
                        <th rowspan="2">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen5.$menu2;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Peralatan tersusun dan kemas.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen5.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                </table>
                <br>
                <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-4">
        <div class="col-xs-12">
            <div class="col-md-12">
                <table align="center" border="1">
                    <tr>
                        <th >6.</th>
                        <th colspan="4">KOMPONEN: KEMUDAHAN TAMBAHAN</th>
                        <th width="5%">SKOR</th>
                        <th width="7%">SKOR PENUH</th>
                        <th width="9%">SKOR DIPEROLEH</th>
                    </tr>
                    <tr>
                        <th rowspan="7"></th>
                        <th rowspan="7">A.</th>
                        <th rowspan="7">Tandas Orang Kelainan Upaya</th>
                        <td>1.</td>
                        <th>Tidak retak dan sumbing.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="7"><center>7</center></th>
                        <th rowspan="7">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen6.$menu1;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Tiada kesan tompokan air kencing/najis.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Diperbuat dari bahan seramik yang mudah dicuci.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu1." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Sistem flush berfungsi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu1." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <th>Tidak berlumut.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu1." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <th>Laluan khas OKU.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu1." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <th>Mempunyai besi pengadang.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu1." AND sub_menu='7'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">B.</th>
                        <th rowspan="2">Pewangi</th>
                        <td>1.</td>
                        <th>Mempunyai pewangi biasa/automatik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="2"><center>2</center></th>
                        <th rowspan="2">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen6.$menu2;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Berfungsi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="3"></th>
                        <th rowspan="3">C.</th>
                        <th rowspan="3">Cermin Muka</th>
                        <td>1.</td>
                        <th>Mempunyai cermin muka di lokasi yang sesuai.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu3." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="3"><center>3</center></th>
                        <th rowspan="3">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen6.$menu3;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Dalam keadaan baik dan tidak retak.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu3." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Cermin Muka.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu3." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">D.</th>
                        <th rowspan="2">Penyangkut Pakaian</th>
                        <td>1.</td>
                        <th>Mempunyai penyangkut pakaian di setiap unit bilik air.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu4." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="2"><center>2</center></th>
                        <th rowspan="2">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen6.$menu4;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Semua dalam keadaan baik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu4." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">E.</th>
                        <th rowspan="2">Hiasan</th>
                        <td>1.</td>
                        <th>Mempunyai hiasan bunga/lain-lain hiasan yang menarik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu5." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="2"><center>2</center></th>
                        <th rowspan="2">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen6.$menu5;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Tidak berhabuk dan sentiasa bersih.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu5." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="3"></th>
                        <th rowspan="3">F.</th>
                        <th rowspan="3">Selipar/Terompah</th>
                        <td>1.</td>
                        <th>Mempunyai selipar/terompah yang sejuk.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu6." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="3"><center>3</center></th>
                        <th rowspan="3">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek1.$komponen6.$menu6;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Mempunyai rak khas.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu6." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Dalam keadaan baik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu6." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="1"></th>
                        <th rowspan="1">G.</th>
                        <th rowspan="1">Ruang Pencuci Kaki</th>
                        <td>1.</td>
                        <th>Mempunyai paip pencuci kaki yang berfungsi berhampiran pintu keluar.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu7." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="1"><center>1</center></th>
                        <th rowspan="1">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen6.$menu7;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="3"></th>
                        <th rowspan="3">H.</th>
                        <th rowspan="3">Bilik Mandi</th>
                        <td>1.</td>
                        <th>Mampunyai bilik mandi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu8." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="3"><center>3</center></th>
                        <th rowspan="3">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek1.$komponen6.$menu8;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Mempunyai pancuran mandi yang sempurna dan tidak rosak/patah.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu8." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Pancuran mandi berfungsi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek1.$komponen6.$menu8." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="6"><center>SKOR PENGURUSAN BILIK AIR</center></th>
                        <th><center>130</center></th>
                        <th>
                            <center>
                                <?php
                                $skor_aspek=0;
                                $sql_aspek = $sql.$aspek1;
                                $sqlquery=mysqli_query($bd2,$sql_aspek);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_aspek = $skor_aspek + $data['skor'];
                                }
                                echo $skor_aspek;
                                ?>
                            </center>
                        </th>
                    </tr>
                </table>
                <br>
                <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-5">
        <div class="col-xs-12">
            <div class="col-md-12">
                <table align="center" border="1">
                    <tr>
                        <td colspan="8"><h2>ASPEK 2: PENGURUSAN TEMPAT WUDUK</h2></td>
                    </tr>
                    <tr>
                        <th >1.</th>
                        <th colspan="4">KOMPONEN: LOKASI DAN KEADAAN PERSEKITARAN</th>
                        <th width="5%">SKOR</th>
                        <th width="7%">SKOR PENUH</th>
                        <th width="9%">SKOR DIPEROLEH</th>
                    </tr>
                    <tr>
                        <th rowspan="4"></th>
                        <th rowspan="4">A.</th>
                        <th rowspan="4">Lokasi</th>
                        <td>1.</td>
                        <th>Tempat wuduk lelaki mudah diakses ke ruang solat lelaki.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="4"><center>4</center></th>
                        <th rowspan="4">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek2.$komponen1.$menu1;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Tempat wuduk wanita mudah diakses ke ruang solat wanita.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Tempat wuduk wanita bertutup.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu1." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Tempat wuduk wanita boleh diakses terus ke ruang solat wanita tanpa menutup aurat.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu1." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="6"></th>
                        <th rowspan="6">B.</th>
                        <th rowspan="6">Bekalan Air</th>
                        <td>1.</td>
                        <th>Bekalan air yang bersih.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="6"><center>6</center></th>
                        <th rowspan="6">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen1.$menu2;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Bekalan air yang mencukupi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Bekalan air tidak berbau.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu2." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Tekanan air yang baik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu2." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <th>Tangki air berfungsi dengan baik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu2." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <th>Sistem perpaipan berfungsi dengan baik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu2." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="3"></th>
                        <th rowspan="3">C.</th>
                        <th rowspan="3">Pengudaraan</th>
                        <td>1.</td>
                        <th>Mempunyai tingkap/ruangan bukaan kekal.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu3." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="3"><center>3</center></th>
                        <th rowspan="3">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek2.$komponen1.$menu3;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Mempunyai tingkap/ruangan bukaan kekal yang mencukupi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu3." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Mempunyai kipas siling.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu3." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="3"></th>
                        <th rowspan="3">D.</th>
                        <th rowspan="3">Pencahayaan</th>
                        <td>1.</td>
                        <th>Pencahayaan Semula jadi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu4." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="3"><center>3</center></th>
                        <th rowspan="3">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek2.$komponen1.$menu4;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Mempunyai lampu yang mencukupi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu4." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Semua lampu berfungsi dengan baik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen1.$menu4." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th >2.</th>
                        <th colspan="4">KOMPONEN: STRUKTUR DAN PENYELENGGARAAN</th>
                        <th width="5%">SKOR</th>
                        <th width="7%">SKOR PENUH</th>
                        <th width="9%">SKOR DIPEROLEH</th>
                    </tr>
                    <tr>
                        <th rowspan="4"></th>
                        <th rowspan="4">A.</th>
                        <th rowspan="4">Kolah</th>
                        <td>1.</td>
                        <th>Tidak berlumut.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="4"><center>4</center></th>
                        <th rowspan="4">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek2.$komponen2.$menu1;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Air yang jernih..</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Air tidak berbau.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu1." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Sistem perpaipan masuk automatik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu1." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="4"></th>
                        <th rowspan="4">B.</th>
                        <th rowspan="4">Pili Air</th>
                        <td>1.</td>
                        <th>Mempunyai pili air mencukupi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="4"><center>4</center></th>
                        <th rowspan="4">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek2.$komponen2.$menu2;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Semua berfungsi dengan baik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Jarak antara pili yang sesuai.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu2." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Kettinggian pili yang sesuai.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu2." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="4"></th>
                        <th rowspan="4">C.</th>
                        <th rowspan="4">Siling</th>
                        <td>1.</td>
                        <th>Bersih dari kotoran..</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu3." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="4"><center>4</center></th>
                        <th rowspan="4">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek2.$komponen2.$menu3;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Tidak bersawang.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu3." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>tidak rosak/pecah/retak.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu3." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Warna terang.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu3." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="9"></th>
                        <th rowspan="9">D.</th>
                        <th rowspan="9">Lantai</th>
                        <td>1.</td>
                        <th>Bertile.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu4." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="9"><center>9</center></th>
                        <th rowspan="9">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek2.$komponen2.$menu4;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <th>Tidak pecah/retak.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu4." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <th>Bersih daripada sampah.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu4." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <th>Tidak berdaki dan berlumur.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu4." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <th>Tidak berdebu dan berpasir.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu4." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <th>Tidak licin.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu4." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <th>Mempunyai kecuraman lantai yang baik.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu4." AND sub_menu='7'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <th>Tidak memasang pelapik lantai.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu4." AND sub_menu='8'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <th>Perangkap lantai yang mencukupi.</th>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu4." AND sub_menu='9'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                </table>
                <br>
                <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-6">
        <div class="col-xs-12">
            <div class="col-md-12">
                <table border="1" align="center">
                    <tr>
                        <th rowspan="5"></th>
                        <th rowspan="5">E.</th>
                        <td rowspan="5">Dinding</td>
                        <th> 1. </th>
                        <td> Jubin berkilat. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu5." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek2.$komponen2.$menu5;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Jubin bersih.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu5." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Kalis air. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu5." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Berjubin sepenuhnya atau separuh.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu5." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td> Tidak retak atau pecah. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu5." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th rowspan="5">F.</th>
                        <td rowspan="5">Saliran Longkang</td>
                        <th> 1. </th>
                        <td> Tidak berlumut. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu6." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <?php
                                $skor_menu=0;
                                $sql_menu = $sql.$aspek2.$komponen2.$menu6;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Tiada sampah.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu6." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Tidak berbau busuk. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu6." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Tidak tersumbat.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu6." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Saliran lancar dan sempurna.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu6." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="6"></th>
                        <th rowspan="6">G.</th>
                        <td rowspan="6">Tong Sampah/Sanitasi</td>
                        <th> 1. </th>
                        <td> Mempunyai penutup. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu7." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="6"><center>6</center></th>
                        <th rowspan="6">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen2.$menu7;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Mempunyai karung plastik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu7." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Mencukupi. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu7." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Diselenggara setiap hari.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu7." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Tong sampah dan penutup yang bersih.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu7." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 6. </th>
                        <td>Lokasi yang sesuai.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen2.$menu7." AND sub_menu='6'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th>3.</th>
                        <th colspan=4> KOMPONEN: PENUNJUK ARAH,LABEL DAN NOTIS</th>
                        <th> SKOR</th>
                        <th> SKOR PENUH </th>
                        <th> SKOR DIPEROLEH </th>
                    </tr>
                    <tr>
                        <th rowspan="3"></th>
                        <th rowspan="3">A.</th>
                        <td rowspan="3">Penunjuk Arah dan Label</td>
                        <th> 1. </th>
                        <td> Mempunyai label tempat wuduk lelaki dan perempuan. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen3.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="3"><center>3</center></th>
                        <th rowspan="3">
                            <center>
                                <?php
                                $skor_menu=0;
                                $skor_menu = $sql.$aspek2.$komponen3.$menu1;
                                $sqlquery=mysqli_query($bd2,$skor_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Mempunyai penunjuk arah yang jelas.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen3.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Kedudukan penunjuk arah yang strategik. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen3.$menu1." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th rowspan="5">B.</th>
                        <td rowspan="5">Notis-notis</td>
                        <th> 1. </th>
                        <td> Notis menjimatkan air. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen3.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen3.$menu2;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Notis doa-doa.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen3.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Mudah dilihat dan difahami. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen3.$menu2." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Disediakan dalam keadaan seragam.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen3.$menu2." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Disediakan dalam keadaan kemas.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen3.$menu2." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th>4.</th>
                        <th colspan=4> KOMPONEN: AKTIVITI PEMBERSIHAN</th>
                        <th> SKOR</th>
                        <th> SKOR PENUH </th>
                        <th> SKOR DIPEROLEH </th>
                    </tr>
                    <tr>
                        <th rowspan="5"></th>
                        <th rowspan="5">A.</th>
                        <td rowspan="5">Jadual Pembersihan</td>
                        <th> 1. </th>
                        <td> Mempunyai jadual. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen4.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="5"><center>5</center></th>
                        <th rowspan="5">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen4.$menu1;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Mempunyai sentiasa dipatuhi.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen4.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td> Aktiviti pembersihan direkod. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen4.$menu1." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 4. </th>
                        <td>Mempunyai kekerapan pencucian.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen4.$menu1." AND sub_menu='4'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 5. </th>
                        <td>Jadual disedia.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen4.$menu1." AND sub_menu='5'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                </table>
                <br>
                <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-7">
        <div class="col-xs-12">
            <div class="col-md-12">
                <table border="1" align="center">
                    <tr>
                        <th>5.</th>
                        <th colspan=4> KOMPONEN: KEMUDAHAN TAMBAHAN</th>
                        <th> SKOR</th>
                        <th> SKOR PENUH </th>
                        <th> SKOR DIPEROLEH </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">A.</th>
                        <th rowspan="2">Orang Kelainan Upaya(OKU)</th>
                        <th> 1. </th>
                        <td> Tempat wuduk khas untuk OKU. </td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu1." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="2"><center>2</center></th>
                        <th rowspan="2">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen5.$menu1;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Laluan khas ke tempat wuduk oku.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu1." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">B.</th>
                        <th rowspan="2">Pewangi</th>
                        <th> 1. </th>
                        <td> Mempunyai pewangi biasa/automatik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu2." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="2"><center>2</center></th>
                        <th rowspan="2">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen5.$menu2;
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Berfungsi.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu2." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="3"></th>
                        <th rowspan="3">C.</th>
                        <th rowspan="3">Cermin Muka</th>
                        <th> 1. </th>
                        <td> Mempunyai cermin muka di lokasi sesuai.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu3." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="3"><center>3</center></th>
                        <th rowspan="3">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen5.$menu3;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Dalam keadaan baik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu3." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td>Bersih.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu3." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">D.</th>
                        <th rowspan="2">Tempat Letak Pakaian</th>
                        <th> 1. </th>
                        <td> Mempunyai tempat letak songkok/tudung.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu4." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="2"><center>2</center></th>
                        <th rowspan="2">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen5.$menu4;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Dalam keadaan baik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu4." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">E.</th>
                        <th rowspan="2">Hiasan</th>
                        <th> 1. </th>
                        <td> Mempunyai hiasan bunga/lain-lain hiasan yang menarik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu5." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="2"><center>2</center></th>
                        <th rowspan="2">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen5.$menu5;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Tidak berhabuk dan bersih.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu5." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="3"></th>
                        <th rowspan="3">F.</th>
                        <th rowspan="3">Pengelap Kaki</th>
                        <th> 1. </th>
                        <td> Mempunyai pengelap kaki di hadapan pintu di hadapan pintu tempat wuduk.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu6." AND sub_menu='1'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                        <th rowspan="3"><center>3</center></th>
                        <th rowspan="3">
                            <center>
                                <?php
                                $skor_menu = 0;
                                $sql_menu = $sql.$aspek2.$komponen5.$menu6;
                                $sqlquery=mysqli_query($bd2,$sql_menu);
                                while($data=mysqli_fetch_array($sqlquery))
                                {
                                    $skor_menu = $skor_menu + $data['skor'];
                                }
                                echo $skor_menu;
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 2. </th>
                        <td>Dalam keadaan baik.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu6." AND sub_menu='2'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th> 3. </th>
                        <td>Bersih.</td>
                        <th>
                            <center>
                                <?php
                                $sub_menu = $sql.$aspek2.$komponen5.$menu6." AND sub_menu='3'";
                                $sqlquery=mysqli_query($bd2,$sub_menu);
                                $data=mysqli_fetch_array($sqlquery);
                                echo $data['skor'];
                                ?>
                            </center>
                        </th>
                    </tr>
                    <tr>
                        <th colspan=6><p align="right">SKOR PENGURUSAN TEMPAT WUDUK</p></th>
                        <th><center>80</center></th>
                        <th>
                            <center>
                                <div id="dis_aspek2">
                                    <center>
                                        <?php
                                        $skor_aspek2 = 0;
                                        $sql_aspek2 = $sql.$aspek2;
                                        $sqlquery=mysqli_query($bd2,$sql_aspek2);
                                        while($data=mysqli_fetch_array($sqlquery))
                                        {
                                            $skor_aspek2 = $skor_aspek2 + $data['skor'];
                                        }
                                        echo $skor_aspek2;
                                        ?>
                                    </center>
                                </div>
                            </center>
                        </th>
                    </tr>
                </table>
                <br>
                <br>
                <table style="display:none" align="center" border="1" cellspacing="0" cellpadding="10">
                    <tr>
                        <th></th>
                        <th>PENEMUAN-PENEMUAN LAIN YANGYANG MENARIK DAN BAGUS</th>
                        <th width=15%> SKOR DIPEROLEH </th>
                    </tr>
                    <tr>
                        <th width=5% >1.</th>
                        <th>
						<textarea rows="5" cols="100" name="txt1" id="txt1" >
						</textarea></th>
                        <th><input type="number" name="num1" id="num1" style="width:70px"></th>
                    </tr>
                    <tr>
                        <th>2.</th>
                        <th>
						<textarea rows="5" cols="100" name="txt2" id="txt2" >
						</textarea></th>
                        <th><input type="number" name="num2" id="num2" style="width:70px"></th>
                    </tr>
                    <tr>
                        <th>3.</th>
                        <th>
						<textarea rows="5" cols="100" name="txt3" id="txt3" >
						</textarea>
                        </th>
                        <th><input type="number" name="num3" id="num3" style="width:70px"></th>
                    </tr>
                    <tr>
                        <th>4.</th>
                        <th>
						<textarea rows="5" cols="100" name="txt4" id="txt4" >
						</textarea>
                        </th>
                        <th><input type="number" name="num4" id="num4" style="width:70px"></th>
                    </tr>
                    <tr>
                        <th>5.</th>
                        <th>
						<textarea rows="5" cols="100" name="txt5" id="txt5" >
						</textarea></th>
                        <th><input type="number" name="num5" id="num5" style="width:70px"></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th><p align="right">JUMLAH</p></th>
                        <th><center><div id="dis_jumlah"></div></center><input type="hidden" name="jumlah" id="jumlah"></th>
                    </tr>
                </table>
                <br>
                <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>