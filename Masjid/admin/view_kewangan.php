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

    $sql = "SELECT * FROM Kewangan WHERE id_5s='$id_5s'";
    $aspek1 = " AND aspek='1'";
    $komponen1 = " AND komponen='1'";
    $komponen2 = " AND komponen='2'";
    $komponen3 = " AND komponen='3'";
    $komponen4 = " AND komponen='4'";
    $menu1 = " AND menu='1'";
    $menu2 = " AND menu='2'";
    $menu3 = " AND menu='3'";
    $menu4 = " AND menu='4'";
    $menu5 = " AND menu='5'";

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
        <h2>Rekod Kewangan <?php echo $data0['tahun']; ?><br><?php echo $data_masjid['nama_masjid']; ?></h2>
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
            </div>
        </div>
            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <div style="overflow-x:auto;">
                            <table align="center">
                                <tr>
                                    <th colspan="8"><h3>ASPEK PENGURUSAN KEWANGAN</h3></th>
                                </tr>
                                <tr>
                                    <th>1.</th>
                                    <th colspan="4">KOMPONEN: PENGERUSAN PUNGUTAN DAN TERIMAAN</th>
                                    <th width="5%">SKOR</th>
                                    <th width="7%">SKOR PENUH</th>
                                    <th width="9%">SKOR DIPEROLEH</th>
                                </tr>
                                <tr>
                                    <th rowspan="2"></th>
                                    <th rowspan="2">A.</th>
                                    <th rowspan="2">Pentadbiran pengurusan terimaan</th>
                                    <td>1.</td>
                                    <th>Wujud penurunan kuasa kepada individu terlibat dengan hal ehwal terimaan.</th>
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
                                    <th rowspan="2"><center>2</center></th>
                                    <th rowspan="2">
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
                                    <td>2.</td>
                                    <th>Tandatangan individu berkenaan disimpan.</th>
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
                                    <th rowspan="4"></th>
                                    <th rowspan="4">B.</th>
                                    <th rowspan="4">Kawalan Resit</th>
                                    <td>1.</td>
                                    <th>Disimpan ditempat selamat.</th>
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
                                    <th rowspan="4"><center>4</center></th>
                                    <th rowspan="4">
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
                                    <td>2.</td>
                                    <th>Disusun dan digunakan mengikut nombor siri.</th>
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
                                    <td>3.</td>
                                    <th>Wujud daftar kawalan resit(DKR).</th>
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
                                    <td>4.</td>
                                    <th>Pergerakan buku resit dicatat dalam DKR.</th>
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
                                    <th rowspan="9"></th>
                                    <th rowspan="9">C.</th>
                                    <th rowspan="9">Pengurusan Resit</th>
                                    <td>1.</td>
                                    <th>Resit rasmi digunakan.</th>
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
                                    <th rowspan="9"><center>9</center></th>
                                    <th rowspan="9">
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
                                    <td>2.</td>
                                    <th>Resit berbentuk 2 salinan berkarbon.</th>
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
                                    <td>3.</td>
                                    <th>Nombor resit wujud.</th>
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
                                    <td>4.</td>
                                    <th>Tarikh terimaan dicatat pada resit.</th>
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
                                    <td>5.</td>
                                    <th>Tujuan terimaan dicatat pada resit.</th>
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
                                    <td>6.</td>
                                    <th>Pemberi sumbangan dicatat pada resit.</th>
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
                                    <td>7.</td>
                                    <th>Jumlah sumbangan dicatat pada resit.</th>
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
                                    <td>8.</td>
                                    <th>Tandatangan pemegang buku resit pada resit.</th>
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
                                    <td>9.</td>
                                    <th>Setiap pengeluaranresit dicatat pada buku tunai.</th>
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
                                    <th rowspan="6"></th>
                                    <th rowspan="6">D.</th>
                                    <th rowspan="6">Pengeluaran Resit</th>
                                    <td rowspan="4">1.</td>
                                    <th>Semua terimaan dikeluarkan resit.(5 mata)</th>
                                    <th rowspan="4">
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu4." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="6"><center>7</center></th>
                                    <th rowspan="6">
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
                                    <th>Hanya 1-5 terimaan tidak dikeluarkan resit.(3 mata)</th>
                                </tr>
                                <tr>
                                    <th>6 ke atas terimaan tidak dikeluarkan resit.(1 mata)</th>
                                </tr>
                                <tr>
                                    <th>Tiada pengeluaran resit langsung.(0 mata)</th>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <th>Mengikut no siri.</th>
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
                                    <th>Setiap pengeluaran resit dicatitkan dalam buku tunai.</th>
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
                                    <th rowspan="4"></th>
                                    <th rowspan="4">E.</th>
                                    <th rowspan="4">Pengurusan Tabung</th>
                                    <td>1.</td>
                                    <th>Petugas/Pegawai dilantik diperturunkan kuasa secara bertulis.</th>
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
                                    <th rowspan="4"><center>4</center></th>
                                    <th rowspan="4">
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
                                    <th>Dibuka di masjid sahaja.</th>
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
                                    <th>Kiraan dan lain-lain nilaian berharga direkodkan dan disahkan.</th>
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
                                    <th>Kiraan tabung dikeluarkan resit.</th>
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
                                    <th colspan="6"><center><h4>SKOR PENGURUSAN PUNGUTAN DAN TERIMAAN</h4></center></th>
                                    <th><center>26</center></th>
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
                                    <th>2.</th>
                                    <th colspan="4"><h3>KOMPONEN: PENGERUSAN BAYARAN</h3></th>
                                    <th width="5%">SKOR</th>
                                    <th width="7%">SKOR PENUH</th>
                                    <th width="9%">SKOR DIPEROLEH</th>
                                </tr>
                                <tr>
                                    <th rowspan="8"></th>
                                    <th rowspan="8">A.</th>
                                    <th rowspan="8">Pengurusan Baucar</th>
                                    <th>1.</th>
                                    <td>Nombor baucar diwujudkan.</td>
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
                                    <th rowspan="8"><center>8</center></th>
                                    <th rowspan="8">
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
                                    <th>2.</th>
                                    <td>Tarikh bayaran dicatatkan.</td>
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
                                    <th>3.</th>
                                    <td>Tujuan bayaran dicatatkan.</td>
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
                                    <th>4.</th>
                                    <td>Dibayar kepada dicatatkan.</td>
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
                                    <th>5.</th>
                                    <td>Kuantiti: kiraan dan kadar dicatatkan.</td>
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
                                    <th>6.</th>
                                    <td>Tandatangan penerima bayaran.</td>
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
                                    <th>7.</th>
                                    <td>Baucar bernilai lebih RM500 ditandatangani bersama bendahari dan pengerusi.</td>
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
                                    <th>8.</th>
                                    <td>Setiap pengeluaran baucar dicatatkan dalam buku tunai.</td>
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
                                    <th rowspan="4"></th>
                                    <th rowspan="4">B.</th>
                                    <th rowspan="4">Penyediaan Baucar</th>
                                    <th rowspan="4">1.</th>
                                    <td>Setiap bayaran dikenakan baucar.(5 mata)</td>
                                    <th rowspan="4">
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu2." AND sub_menu='1'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                    <th rowspan="4"><center>5</center></th>
                                    <th rowspan="4">
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
                                    <td>Hanya 1-5 bayaran tidak dikenakan baucar.(3 mata)</td>
                                </tr>
                                <tr>
                                    <td>6 ke atas bayaran tidak disediakan baucar.(1 mata)</td>
                                </tr>
                                <tr>
                                    <td>Tiada baucar langsung.(0 mata)</td>
                                </tr>
                                <tr>
                                    <th colspan="6"><center><h4>SKOR PENGURUSAN BAYARAN</h4></center></th>
                                    <th><center>13</center></th>
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
                                                echo $skor_komponen;
                                                ?>
                                            </center>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th>3.</th>
                                    <th colspan="4"><h3>KOMPONEN: PENGURUSAN LAPORAN</h3></th>
                                    <th width="5%">SKOR</th>
                                    <th width="7%">SKOR PENUH</th>
                                    <th width="9%">SKOR DIPEROLEH</th>
                                </tr>
                                <tr>
                                    <th rowspan="8"></th>
                                    <th rowspan="8">A.</th>
                                    <th rowspan="8">Penyelenggaraan Buku Tunai</th>
                                    <th>1.</th>
                                    <td>Buku tunai diwujudkan.</td>
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
                                    <th rowspan="8"><center>8</center></th>
                                    <th rowspan="8">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
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
                                    <th>2.</th>
                                    <td>Secara bulanan.</td>
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
                                    <th>3.</th>
                                    <td>Baki di bank pada 31hb bulan sebelumnya dicatatkan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>4.</th>
                                    <td>Sebab terimaan dan tujuan bayaran dicatatkan.</td>
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
                                    <th>5.</th>
                                    <td>Amaun diterima dan dibayar dicatatkan.</td>
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
                                    <th>6.</th>
                                    <td>No. laporan_bulan dan No. Baucar dicatatkan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>7.</th>
                                    <td>No. Slip bank in dinyatakan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>8.</th>
                                    <td>Baki atas buku tunai bagi bulan semasa dicatatkan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='8'";
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
                                    <th rowspan="4">Penyata Penyesuaian Bank(PPB)</th>
                                    <th>1.</th>
                                    <td>PPB disediakan secara bulanan.</td>
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
                                    <th rowspan="4"><center>4</center></th>
                                    <th rowspan="4">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
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
                                    <th>2.</th>
                                    <td>Disertakan bersama-sama penyata bank.</td>
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
                                    <th>3.</th>
                                    <td>Perbezaan Buku Tunai dan Penyata Bank diperjelaskan dalam PPB.</td>
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
                                    <th>4.</th>
                                    <td>PBB ditandatangani oleh Bendahari.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu2." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="5"></th>
                                    <th rowspan="5">C.</th>
                                    <th rowspan="5">Laporan Bulanan</th>
                                    <th>1.</th>
                                    <td>Laporan bulanan disediakan.</td>
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
                                    <th rowspan="5"><center>5</center></th>
                                    <th rowspan="5">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
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
                                    <th>2.</th>
                                    <td>Ditandatangani oleh Bendahari.</td>
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
                                    <th>3.</th>
                                    <td>Dibentang dalam mesyuarat jawatankuasa kariah.</td>
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
                                    <th>4.</th>
                                    <td>Dipamerkan kepada anak kariah.</td>
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
                                    <th>5.</th>
                                    <td>Disemak dan disahkan oleh Pemeriksa Kira-kira sekurang-kurangnya pada setiap 6 bulan.</td>
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
                                    <th rowspan="3"></th>
                                    <th rowspan="3">D.</th>
                                    <th rowspan="3">Laporan Tahunan</th>
                                    <th> 1. </th>
                                    <td> Laporan tahunan disediakan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu4." AND sub_menu='1'";
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
                                            $sql_menu = $sql.$aspek1.$komponen3.$menu4;
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
                                    <td>Ditandatangani oleh Bendahari dan Pengerusi.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu4." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 3. </th>
                                    <td>Disemak dan disahkan oleh Pemeriksa Kira-kira.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu4." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan=6><center><h4>SKOR PENGURUSAN LAPORAN</h4></center></th>
                                    <th><center>20</center></th>
                                    <th>
                                        <div id="dis_komponen3">
                                            <center>
                                                <?php
                                                $skor_komponen = 0;
                                                $sql_komponen = $sql.$aspek1.$komponen3;
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
                                    <th>4.</th>
                                    <th colspan="4"><h3>KOMPONEN: PENGURUSAN HARTA MASJID BOLEH ALIH</h3></th>
                                    <th width="5%">SKOR</th>
                                    <th width="7%">SKOR PENUH</th>
                                    <th width="9%">SKOR DIPEROLEH</th>
                                </tr>
                                <tr>
                                    <th rowspan="4"></th>
                                    <th rowspan="4">A.</th>
                                    <th rowspan="4">Pengurusan Harta Masjid Boleh Alih</th>
                                    <th>1.</th>
                                    <td>Daftar Harta Masjid Boleh Alih (DHMBA) diwujudkan.</td>
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
                                            $skor_menu = 0;
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
                                    <td>Setiap harta masjid boleh alih direkodkan dalam DHMBA.</td>
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
                                    <td>Setiap harta masjid boleh alih dilabel/diberi nombor rujukan.</td>
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
                                    <td>DHMBA diselenggara dan diperiksa pada setiap hujung tahun.</td>
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
                                    <th colspan="6"><center><h4>SKOR PENGURUSAN HARTA MASJID BOLEH ALIH</h4></center></th>
                                    <th><center>4</center></th>
                                    <th>
                                        <div id="dis_komponen4">
                                            <center>
                                                <?php
                                                $skor_komponen = 0;
                                                $sql_komponen = $sql.$aspek1.$komponen4;
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
                                <tr>
                                    <th colspan="6"><center><h4>JUMLAH SKOR KESELURUHAN</h4></center></th>
                                    <th><center>63</center></th>
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
                                    </th>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <table align="center" style="display: none">
                                <tr>
                                    <th colspan="2"><center>PENEMUAN-PENEMUAN LAIN YANGYANG MENARIK DAN BAGUS</center></th>
                                    <th width="5%"><center>SKOR</center></th>
                                </tr>
                                <tr>
                                    <th width="5%">1.</th>
                                    <th><textarea rows="5" cols="100" name="txt1" id="txt1"></textarea></th>
                                    <th><input type="number" name="num1" id="num1"></th>
                                </tr>
                                <tr>
                                    <th>2.</th>
                                    <th><textarea rows="5" cols="100" name="txt2" id="txt2" ></textarea></th>
                                    <th><input type="number" name="num2" id="num2"></th>
                                </tr>
                                <tr>
                                    <th>3.</th>
                                    <th><textarea rows="5" cols="100" name="txt3" id="txt3" ></textarea></th>
                                    <th><input type="number" name="num3" id="num3"></th>
                                </tr>
                                <tr>
                                    <th>4.</th>
                                    <th><textarea rows="5" cols="100" name="txt4" id="txt4" ></textarea></th>
                                    <th><input type="number" name="num4" id="num4"></th>
                                </tr>
                                <tr>
                                    <th>5.</th>
                                    <th><textarea rows="5" cols="100" name="txt5" id="txt5" ></textarea></th>
                                    <th><input type="number" name="num5" id="num5"></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th><center><h4>JUMLAH</h4></center></th>
                                    <th><center><div id="dis_jumlah"></div></center><input type="hidden" name="jumlah" id="jumlah"></th>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <input type="hidden" name="tahun" value="<?php echo $_GET['tarikh']; ?>">
                        <input type="hidden" name="id_masjid" value="<?php echo $_GET['id_masjid']; ?>">
                        <button class="btn btn-warning backBtn btn-lg pull right" type="button">Kembali</button>
                    </div>
                </div>
            </div>
    </div>
</center>
</body>
</html>