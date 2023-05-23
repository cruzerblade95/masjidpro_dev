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

    $sql = "SELECT * FROM Pentadbiran WHERE id_5s='$id_5s'";
    $sql1 = "SELECT * FROM majlis_pentadbiran WHERE id_5s='$id_5s'";
    $aspek1 = " AND aspek='1'";
    $komponen1 = " AND komponen='1'";
    $komponen2 = " AND komponen='2'";
    $menu1 = " AND menu='1'";
    $menu2 = " AND menu='2'";
    $menu3 = " AND menu='3'";
    $menu4 = " AND menu='4'";
    $menu5 = " AND menu='5'";
    $menu6 = " AND menu='6'";
    $menu7 = " AND menu='7'";
    $menu8 = " AND menu='8'";

?>
<html>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
<center>
    <br>
    <div class="row">
        <h2>Rekod Pentadbiran <?php echo $data0['tahun']; ?><br><?php echo $data_masjid['nama_masjid']; ?></h2>
    </div>
    <div class="container">
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
            </div>
        </div>
            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <div style="overflow-x:auto;">
                            <table align="center">
                                <tr>
                                    <th colspan="8"> ASPEK 1 : PENGURUSAN DAN PENTADBIRAN </th>
                                </tr>
                                <tr>
                                    <th width="4%">1.</th>
                                    <th colspan="4"> KOMPONEN : PENGURUSAN PENTADBIRAN MASJID </th>
                                    <th width="5%"> SKOR </th>
                                    <th width="9%"> SKOR PENUH </th>
                                    <th width="10%"> SKOR DIPEROLEH </th>
                                </tr>
                                <tr>
                                    <th rowspan="8" width="4%"></th>
                                    <th width="4%" rowspan="8">A.</th>
                                    <th rowspan="8" width="10%"> Perancangan Pengurusan </th>
                                    <th width="4%">1.</th>
                                    <td>Mempunyai visi </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="8" width="10%"><center>8</center></th>
                                    <th rowspan="8" width="10%">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
                                            $sql_menu = $sql.$aspek1.$komponen1.$menu1;
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
                                    <th>2.</th>
                                    <td>Mempunyai Misi.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>3.</th>
                                    <td>Mempunyai Objektif.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>4.</th>
                                    <td>Logo Masjid.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>5.</th>
                                    <td>Deskripsi logo masjid.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>6.</th>
                                    <td>visi, misi dan objektif dipamer kepada jemaah.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>7.</th>
                                    <td>Aktiviti dan program dirancang selari dengan visi, misi dan objektif.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>8.</th>
                                    <td>Video Korporat.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="8"></th>
                                    <th width="4%" rowspan="8">B.</th>
                                    <th rowspan="8"> Latar Belakang Organisasi </th>
                                    <th width="4%">1.</th>
                                    <td> Carta organisasi dipamer. </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="8"><center>13</center></th>
                                    <th rowspan="8">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
                                            $sql_menu = $sql.$aspek1.$komponen1.$menu2;
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
                                    <th>2.</th>
                                    <td>Gambar lengkap di carta organisasi.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>3.</th>
                                    <td>No. telefon semua jawatankuasa/ pegawai masjid dipamer.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>4.</th>
                                    <td>Penubuhan: <br>
                                        1-2 Biro (1mata) <br>
                                        3-5 Biro (2mata)
                                    </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>5.</th>
                                    <td>Latar Belakang Pendidikan Pengerusi: <br>
                                        PMR - SPM (1mata) <br>
                                        STPM- Ijazah (2mata)
                                    </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>6.</th>
                                    <td>Latar Belakang Pendidikan Setiausaha : <br>
                                        PMR - SPM (1mata)<br>
                                        STPM- Ijazah (2mata)
                                    </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>7.</th>
                                    <td>Latar Belakang Pendidikan Bendahari : <br>
                                        PMR - SPM (1mata)<br>
                                        STPM- Ijazah (2mata)
                                    </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>8.</th>
                                    <td>Latar Belakang Pendidikan Imam Masjid : <br>
                                        1 orang Imam Hafiz/Guru Agama (1mata) <br>
                                        2 orang Imam Hafiz/Guru Agama (2mata)
                                    </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu2." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="10"></th>
                                    <th width="4%" rowspan="10">C.</th>
                                    <th rowspan="10"> Pembudayaan Latihan & Kecemerlangan Organisasi* <br>
                                        <br>
                                        *Bagi komponen<br>
                                        ini penyataan<br>
                                        kehadiran kursus<br>
                                        beserta sijil <br>
                                        melayakkan <br>
                                        untuk <br>
                                        memperoleh <br>
                                        skor penuh</th>
                                    <th width="4%">1.</th>
                                    <td> Kursus Pemantapan Pengurusan dan <br>
                                        Pentadbiran Kariah (Pengerusi) </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="10"><center>15</center></th>
                                    <th rowspan="10">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
                                            $sql_menu = $sql.$aspek1.$komponen1.$menu3;
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
                                    <th>2.</th>
                                    <td> Kursus Pemantapan Pengurusan dan <br>
                                        Pentadbiran Kariah (Setiausaha) </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>3.</th>
                                    <td>Kursus Pengurusan Kewangan Kariah <br>
                                        (Bendahari)
                                    </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>4.</th>
                                    <td>Lain-lain kursus/program dihadiri Pengerusi<br>
                                        (2 mata) <br>
                                        Nyatakan: <br>
                                        a.  <?php $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='4a'"; $sqlquery=mysqli_query($bd2,$sub_menu); $data=mysqli_fetch_array($sqlquery); echo $data['detail']; ?><br>
                                        b.  <?php $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='4b'"; $sqlquery=mysqli_query($bd2,$sub_menu); $data=mysqli_fetch_array($sqlquery); echo $data['detail']; ?></td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>5.</th>
                                    <td>Lain-lain kursus/program dihadiri Setiausaha<br>
                                        (2 mata) <br>
                                        Nyatakan: <br>
                                        a.  <?php
                                            $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='5a'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?><br>
                                        b.  <?php
                                            $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='5b'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?></td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>6.</th>
                                    <td>Lain-lain kursus/program dihadiri Bendahari<br>
                                        (2 mata) <br>
                                        Nyatakan: <br>
                                        a.  <?php
                                            $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='6a'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?><br>
                                        b.  <?php
                                            $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='6b'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?></td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>7.</th>
                                    <td>Kursus Tahsin al-Quran (Imam) </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>8.</th>
                                    <td>Lain-lain kursus/program dihadiri oleh Imam<br>
                                        (2 mata) <br>
                                        Nyatakan: <br>
                                        a.  <?php
                                            $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='8a'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?><br>
                                        b.  <?php
                                            $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='8b'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?></td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>9.</th>
                                    <td>Kursus/program dihadiri Oleh Bilal<br>
                                        (2 mata) <br>
                                        Nyatakan: <br>
                                        a.  <?php
                                            $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='9a'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?><br>
                                        b.  <?php
                                            $sub_menu = $sql1.$aspek1.$komponen1.$menu3." AND sub_menu='9b'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?></td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>10.</th>
                                    <td>Perangkap lantai mencukupi</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu3." AND sub_menu='10'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-2">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <div style="overflow-x:auto;">
                            <table align="center">
                                <tr>
                                    <th rowspan="5" width="4%"></th>
                                    <th width="4%" rowspan="5">D.</th>
                                    <th rowspan="5" width= "10%" > Pengurusan Cadangan dan Aduan </th>
                                    <td width="4%">1.</td>
                                    <th> Peti cadangan diwujudkan </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="5" width="10%"><center>5</center></th>
                                    <th rowspan="5" width="10%">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
                                            $sql_menu = $sql.$aspek1.$komponen1.$menu4;
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
                                    <th>Medium Khas aduan melalui media sosial<br>
                                        seperti facebook, SMS, Whatsapp dll.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <th>Aduan direkod dan difail.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <th>Analisa cadangan dan aduan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <th>Tindakan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="5"></th>
                                    <th width="4%" rowspan="5">E.</th>
                                    <th rowspan="5"> Pengurusan Mesyuarat</th>
                                    <td width="4%">1.</td>
                                    <th> Kekerapan mesyuarat jawatankuasa dalam setahun:<br>
                                        1-2 kali (1mata)<br>
                                        3-4 kali (2mata)<br>
                                        5-6 kali (3mata)<br>
                                        7 kali dan ke atas (4mata) </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu5." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="5"><center>9</center></th>
                                    <th rowspan="5">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
                                            $sql_menu = $sql.$aspek1.$komponen1.$menu5;
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
                                    <th>Notis panggilan mesyuarat 7 hari sebelum.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu5." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <th>Minit mesyuarat dalam fail khas.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu5." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <th>Minit Mesyuarat dihantar ke Pejabat Agama Daerah.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu5." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <th>Mesyuarat Agung Tahunan dijalankan. <br>
                                        (2 mata) </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu5." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="8"></th>
                                    <th width="4%" rowspan="8">F.</th>
                                    <th rowspan="8"> Pengurusan Fail</th>
                                    <td width="4%">1.</td>
                                    <th> Wujud fail surat menyurat. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu6." AND sub_menu='1'";
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
                                            $skor_menu = 0;
                                            $sql_menu = $sql.$aspek1.$komponen1.$menu6;
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
                                    <th> Wujud fail kewangan. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu6." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <th> Wujud fail aktiviti. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu6." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <th> Wujud fail biro. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu6." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <th> Wujud fail cadangan/aduan. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu6." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <th> Kandungan fail diselenggara dengan baik. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu6." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <th> Fail-Fail diselenggara dengan baik </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu6." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <th> Fail-fail disimpan di masjid </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu6." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="10"></th>
                                    <th width="4%" rowspan="10">G.</th>
                                    <th rowspan="10"> Pengurusan Tanah Perkuburan dan Khairat Kematian </th>
                                    <td width="4%">1.</td>
                                    <th> Biro Khas. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="10"><center>10</center></th>
                                    <th rowspan="10">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
                                            $sql_menu = $sql.$aspek1.$komponen1.$menu7;
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
                                    <th> Tanah perkuburan bersih dan rapi </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <th> Tanah Perkuburan berpagar sempurna </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <th> Tanah perkuburan tersusun atur kemas</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <th> Penggali kubur kariah sendiri </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <th> Ada pengurus jenazah sendiri (lelaki) </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <th> Ada pengurus jenazah sendiri (wanita) </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <th> Badan khairat kematian berdaftar dengan <br>
                                        ROS atau Biro dibawah jawatankuasa kariah.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>9.</td>
                                    <th> Kutipan khairat kematian direkodkan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <th> Ada mesyuarat agung khairat kematian. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu7." AND sub_menu='10'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="2"></th>
                                    <th width="4%" rowspan="2">H.</th>
                                    <th rowspan="2"> Pengurusan Landskap </th>
                                    <td width="4%">1.</td>
                                    <th> landskap yang cantik. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu8." AND sub_menu='1'";
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
                                            $sql_menu = $sql.$aspek1.$komponen1.$menu8;
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
                                    <th> Terurus </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu8." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6"><center><h4>SKOR PENGURUSAN PENTADBIRAN MASJID</h4></center></th>
                                    <th><center>70</center></th>
                                    <th>
                                        <div id="dis_komponen1">
                                            <center>
                                                <?php
                                                $skor_komponen = 0;
                                                $sql_komponen = $sql.$aspek1.$komponen1;
                                                $sqlquery=mysqli_query($bd2,$sql_komponen);
                                                while($data=mysqli_fetch_array($sqlquery))
                                                {
                                                    $skor_komponen = $skor_komponen + $data['skor'];
                                                }
                                                echo $skor_komponen;
                                                ?>
                                            </center>
                                        </div>
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-3">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <div style="overflow-x:auto;">
                            <table align="center">
                                <tr>
                                    <th colspan="8"> ASPEK 1 : PENGURUSAN DAN PENTADBIRAN </th>
                                </tr>
                                <tr>
                                    <th width="4%">2.</th>
                                    <th colspan="4"> KOMPONEN : PENGURUSAN PRASANA </th>
                                    <th width="5%"> SKOR </th>
                                    <th width="9%"> SKOR PENUH </th>
                                    <th width="10%"> SKOR DIPEROLEH </th>
                                </tr>
                                <tr>
                                    <th rowspan="15"></th>
                                    <th width="4%" rowspan="15">A.</th>
                                    <th rowspan="15" width="10%"> Kemudahan Dewan Solat </th>
                                    <td width="4%">1.</td>
                                    <th> Alat siaraya yang baik. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="15"><center>15</center></th>
                                    <th rowspan="15">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
                                            $sql_menu = $sql.$aspek1.$komponen2.$menu1;
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
                                    <th>Mimbar.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <th>Tempat letak buku khutbah di mimbar.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <th>Karpet atau sejadah disediakan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <th>Bilangan kipas/penghawa dingin yang mencukupi.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <th>Rak Al-Quran yang sesuai dan di kedudukan bersesuaian.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <th>Pakaian seragam imam disediakan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <th>Kain pelikat disediakan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>9.</td>
                                    <th>Telekong disediakan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <th>Paparan waktu solat ada dan berfungsi.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='10'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>11.</td>
                                    <th>Tabung statik disediakan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='11'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>12.</td>
                                    <th>Ruang solat berasingan lelaki dan wanita.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='12'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>13.</td>
                                    <th>kerusi solat OKU/uzur disediakan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='13'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>14.</td>
                                    <th>Sistem multimedia disediakan.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='14'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>15.</td>
                                    <th>Ruang solat wanita boleh diakses terus dari tempat wuduk/tandas wanita.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu1." AND sub_menu='15'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="17"></th>
                                    <th width="4%" rowspan="17">B.</th>
                                    <th rowspan="17"> Pengurusan Kebersihan dan Keceriaan Dewan solat dan yang berkaitan </th>
                                    <td width="4%">1.</td>
                                    <th> Mimbar bersih dan suci. </th>
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
                                    <th rowspan="17"><center>17</center></th>
                                    <th rowspan="17">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
                                            $sql_menu = $sql.$aspek1.$komponen2.$menu2;
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
                                    <th> Dewan solat bersih, suci dan kemas. </th>
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
                                    <th> Sudut-sudut tepi dewan solat bersih dan suci. </th>
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
                                    <th> Dewan solat tidak bersawang. </th>
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
                                    <th> Al-quran dan buku-buku surah tersusun. </th>
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
                                <tr>
                                    <td>6.</td>
                                    <th> Ada label saranan menyusun kembali Al-quran dan buku-buku surah. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <th> Kipas/Penghawa dingin bersih. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <th> Hiasan khat dan ayat Al-quran. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>9.</td>
                                    <th> Karpet atau sejadah bersih dan tidak berbau. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <th> Pakaian seragam imam bersih dan tidak berbau. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='10'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>11.</td>
                                    <th> Kain pelikat bersih dan tidak berbau. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='11'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>12.</td>
                                    <th> Kain pelikat digantung dan tersusun. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='12'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>13.</td>
                                    <th> Telekong bersih dan tidak berbau. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='13'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>14.</td>
                                    <th> Telekong digantung dan tersusun. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='14'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>15.</td>
                                    <th> Ada label saranan menyusun dan menggantung kembali pakaian solat. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='15'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>16.</td>
                                    <th> Pencahayaan semula jadi yang baik. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='16'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>17.</td>
                                    <th> Balai lintang bersih dan tidak berbau. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='17'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="10"></th>
                                    <th width="4%" rowspan="10">C.</th>
                                    <th rowspan="10"> Kemudahan Pentadbiran </th>
                                    <td width="4%">1.</td>
                                    <th> Pejabat Masjid. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="10"><center>10</center></th>
                                    <th rowspan="10">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
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
                                    <td>2.</td>
                                    <th> Bilik imam/bilal. </th>
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
                                    <td>3.</td>
                                    <th> Papan kenyataan/catatan. </th>
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
                                    <td>4.</td>
                                    <th> Mesin fotostat. </th>
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
                                    <td>5.</td>
                                    <th> Kemudahan komputer dan pencetak. </th>
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
                                    <td>6.</td>
                                    <th> Kemudahan internet. </th>
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
                                    <td>7.</td>
                                    <th> Kemudahan telefon. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <th> Kemudahan faksimili. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>9.</td>
                                    <th> Bilik mesyuarat. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <th> Setor. </th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu3." AND sub_menu='10'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="4"></th>
                                    <th width="4%" rowspan="4">D.</th>
                                    <th rowspan="4"> Kecerian kemudahan Pentadbiran </th>
                                    <td width="4%">1.</td>
                                    <th> Pejabat masjid kemas dan tersusun. </th>
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
                                            $skor_menu = 0;
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
                                    <td>2.</td>
                                    <th> Bilik imam kemas dan tersusun. </th>
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
                                    <td>3.</td>
                                    <th> Susun atur bahan paparan dipapan kenyataan teratur. </th>
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
                                    <td>4.</td>
                                    <th> Bilik mesyuarat kemas dan tersusun. </th>
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
                            </table>
                        </div>
                        <br>
                        <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-4">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <div style="overflow-x:auto;">
                            <table align="center">
                                <tr>
                                    <th rowspan="7" width="4%"></th>
                                    <th width="4%" rowspan="7">E.</th>
                                    <th rowspan="7" width= "10%" > Kemudahan Keilmuan </th>
                                    <td width="4%">1.</td>
                                    <th> Bilik/Dewan Kuliah </th>
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
                                    <th rowspan="7" width="10%"><center>7</center></th>
                                    <th rowspan="7" width="10%">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
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
                                    <td>2.</td>
                                    <th>Sistem multimedia di bilik/dewan kuliah.</th>
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
                                    <td>3.</td>
                                    <th>Siaraya yang baik di bilik/dewan kuliah.</th>
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
                                    <td>4.</td>
                                    <th>Pusat sumber/Sudut bacaan am.</th>
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
                                    <td>5.</td>
                                    <th>Tadika/Taska.</th>
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
                                    <td>6.</td>
                                    <th>Sekolah Rendah Agama.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu5." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <th>Wifi.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu5." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="23" width="4%"></th>
                                    <th width="4%" rowspan="23">F.</th>
                                    <th rowspan="23" width= "10%" > Kemudahan Umum </th>
                                    <td width="4%">1.</td>
                                    <th> Tanda-tanda arah yang jelas.</th>
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
                                    <th rowspan="23" width="10%"><center>23</center></th>
                                    <th rowspan="23" width="10%">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
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
                                    <td>2.</td>
                                    <th>Rak kasut.</th>
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
                                    <td>3.</td>
                                    <th>Peti/rak simpanan barang jemaah.</th>
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
                                    <td>4.</td>
                                    <th>Kemudahan tempat sukan belia/dewasa.</th>
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
                                    <td>5.</td>
                                    <th>Kemudahan permainan kanak-kanak.</th>
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
                                    <td>6.</td>
                                    <th>Kemudahan peralatan sukan.</th>
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
                                    <td>7.</td>
                                    <th>Bilik pengurusan jenazah.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <th>Peralatan jenazah.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>9.</td>
                                    <th>Kenderaan jenazah.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <th>Tempat rehat/wakaf.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='10'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>11.</td>
                                    <th>Parkir kereta dan motosikal bertar.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='11'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>12.</td>
                                    <th>Ada petak-petak parkir.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='12'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>13.</td>
                                    <th>Bilangan parkir mencukupi.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='13'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>14.</td>
                                    <th>Parkir khas pegawai masjid/jk masjid.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='14'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>15.</td>
                                    <th>Parkir khas OKU.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='15'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>16.</td>
                                    <th>Parkir khas penceramah.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='16'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>17.</td>
                                    <th>Tiang bendera beserta bendera negeri dan negara.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='17'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>18.</td>
                                    <th>Kemera litar tertutup.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='18'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>19.</td>
                                    <th>Alat pemadam api.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='19'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>20.</td>
                                    <th>First Aid.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='20'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>21.</td>
                                    <th>Laluan-laluan OKU menyeluruh.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='21'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>22.</td>
                                    <th>Setor khas menyimpan barang-barang.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='22'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <td>23.</td>
                                    <th>Dapur dan kelengkapan pinggan mangkuk.</th>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu6." AND sub_menu='23'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6"><center><h4>SKOR PENGURUSAN PRASANA</h4></center></th>
                                    <th><center> 76 </th>
                                    <th>
                                        <div id="dis_komponen2">
                                            <center>
                                                <?php
                                                $skor_komponen = 0;
                                                $sql_komponen = $sql.$aspek1.$komponen2;
                                                $sqlquery=mysqli_query($bd2,$sql_komponen);
                                                while($data=mysqli_fetch_array($sqlquery))
                                                {
                                                    $skor_komponen = $skor_komponen + $data['skor'];
                                                }
                                                echo $skor_komponen
                                                ?>
                                            </center>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6"><center><h4>JUMLAH SKOR KESELURUHAN</h4></center></th>
                                    <th><center>146</center></th>
                                    <th>
                                        <div id="dis_total">
                                            <center>
                                                <?php
                                                $skor_aspek = 0;
                                                $sql_aspek = $sql.$aspek1;
                                                $sqlquery=mysqli_query($bd2,$sql_aspek);
                                                while($data=mysqli_fetch_array($sqlquery))
                                                {
                                                    $skor_aspek = $skor_aspek + $data['skor'];
                                                }
                                                echo $skor_aspek;
                                                ?>
                                            </center>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            </table>
                            <br>
                            <table align="center" style="display:none">
                                <tr>
                                    <th colspan=2>PENEMUAN-PENEMUAN LAIN YANGYANG MENARIK DAN BAGUS</th>
                                    <th width="5%"> SKOR DIPEROLEH </th>
                                </tr>

                                <tr>
                                    <th width=5% >1.</th>
                                    <th>
			<textarea style="resize: none;" rows="5" cols="75" name="txt1" id="txt1" >
			</textarea></th>
                                    <th><input type="number" name="num1" id="num1"></th>
                                </tr>

                                <tr>
                                    <th>2.</th>
                                    <th>
			<textarea style="resize: none;" rows="5" cols="75" name="txt2" id="txt2" >
			</textarea></th>
                                    <th><input type="number" name="num2" id="num2"></th>
                                </tr>

                                <tr>
                                    <th>3.</th>
                                    <th>
			<textarea style="resize: none;" rows="5" cols="75" name="txt3" id="txt3" >
			</textarea>
                                    </th>
                                    <th><input type="number" name="num3" id="num3"></th>
                                </tr>

                                <tr>
                                    <th>4.</th>
                                    <th>
			<textarea style="resize: none;" rows="5" cols="75" name="txt4" id="txt4" >
			</textarea>
                                    </th>
                                    <th><input type="number" name="num4" id="num4"></th>
                                </tr>

                                <tr>
                                    <th>5.</th>
                                    <th>
			<textarea style="resize: none;" rows="5" cols="75" name="txt5" id="txt5" >
			</textarea></th>
                                    <th><input type="number" name="num5" id="num5"></th>
                                </tr>

                                <tr>
                                    <th></th>
                                    <th><P align="right">JUMLAH</p></th>
                                    <th><center><div id="dis_jumlah"></div></center><input type="hidden" name="jumlah" id="jumlah"></th>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <input type="hidden" name="id_masjid" value="<?php echo $_GET['id_masjid']; ?>">
                        <input type="hidden" name="tahun" value="<?php echo $_GET['tarikh']; ?>">
                        <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
                    </div>
                </div>
            </div>
    </div>
</center>
</body>
</html>