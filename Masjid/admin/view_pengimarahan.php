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

    $sql = "SELECT * FROM Pengimarahan WHERE id_5s='$id_5s'";
    $sql1 = "SELECT * FROM majlis_pengimarahan WHERE id_5s='$id_5s'";
    $aspek1 = " AND aspek='1'";
    $komponen1 = " AND komponen='1'";
    $komponen2 = " AND komponen='2'";
    $komponen3 = " AND komponen='3'";
    $komponen4 = " AND komponen='4'";
    $komponen5 = " AND komponen='5'";
    $menu1 = " AND menu='1'";
    $menu2 = " AND menu='2'";
    $menu3 = " AND menu='3'";
    $menu4 = " AND menu='4'";
    $menu5 = " AND menu='5'";
    $menu6 = " AND menu='6'";
    $menu7 = " AND menu='7'";
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
        <h2>Rekod Pengimarahan <?php echo $data0['tahun']; ?><br><?php echo $data_masjid['nama_masjid']; ?></h2>
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
                                    <th colspan=8> ASPEK PENGURUSAN PENGIMARAHAN</th>
                                </tr>
                                <tr>
                                    <th>1.</th>
                                    <th colspan=4> KOMPONEN: PENGURUSAN IBADAH SOLAT</th>
                                    <th> SKOR</th>
                                    <th><center>SKOR PENUH</center></th>
                                    <th><center>SKOR DIPEROLEH</center></th>
                                </tr>
                                <tr>
                                    <th rowspan="14"></th>
                                    <th rowspan="14">A.</th>
                                    <th rowspan="14"><center>Ibadah Solat</center></th>
                                    <th> 1. </th>
                                    <td> Solat fardhu berjamaah pada setiap waktu (3 mata) </td>
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
                                    <th rowspan="14"><center>23</center></th>
                                    <th rowspan="14">
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
                                    <th> 2. </th>
                                    <td>Jadual tugas imam disediakan.</td>
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
                                    <th> 3. </th>
                                    <td>Imam 1 bertugas mengikut jadual.</td>
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
                                    <th> 4. </th>
                                    <td>Imam 2 bertugas mengikut jadual.</td>
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
                                    <th> 5. </th>
                                    <td>Borang kehadiran bertugas dilaksanakan imam.</td>
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
                                    <th> 6. </th>
                                    <td>Azan pada setiap dan awal waktu.(3 mata)</td>
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
                                    <th> 7. </th>
                                    <td>Jadual tugas bilal disediakan.</td>
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
                                    <th> 8. </th>
                                    <td>Bilal 1 bertugas mengikut jadual.</td>
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
                                    <th> 9. </th>
                                    <td>Bilal 2 bertugas mengikut jadual.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 10. </th>
                                    <td>Borang kehadiran bertugas dilaksanakan bilal.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='10'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 11. </th>
                                    <td>Kehadiran jemaah solat subuh.:<br>1 saf (1 mata)<br>2 saf (2 mata)<br>3 saf (3 mata)<br>4 saf ke atas (4 mata)</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='11'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 12. </th>
                                    <td>Kehadiran jemaah solat maghrib/isyak.:<br>1-2 saf (1 mata)<br>3-4 saf (2 mata)<br>5-6 saf (3 mata)</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='12'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 13. </th>
                                    <td>Ada jadual khatib, imam dan bilal bertugas.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='13'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 14. </th>
                                    <td>Khatib, imam dan bilal bertugas ikut jadual.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen1.$menu1." AND sub_menu='14'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6"><center><h4>SKOR PENGURUSAN IBADAH SOLAT</h4></center></th>
                                    <th><center>23</center></th>
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
                                <tr>
                                    <th>2.</th>
                                    <th colspan=4> KOMPONEN: <br>PENGURUSAN MAJLIS RASMI/PERISTIWA PENTING KALENDAR HIJRAH</th>
                                    <th> SKOR</th>
                                    <th><center>SKOR PENUH</center></th>
                                    <th><center>SKOR DIPEROLEH</center></th>
                                </tr>
                                <tr>
                                    <th rowspan="5"></th>
                                    <th rowspan="5">A.</th>
                                    <th rowspan="5"><center>SAMBUTAN MAAL HIJRAH <br> <i>*Pernyataan berserta <br> bukti melayakkan <br>memperoleh skor penuh</i></center></th>
                                    <th> 1. </th>
                                    <td> Majlis bacaan doa awal tahun dan akhir tahun. </td>
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
                                    <th rowspan="5"><center>6</center></th>
                                    <th rowspan="5">
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
                                    <th> 2. </th>
                                    <td>Anugerah Tokoh Maal Hijrah Peringkat Daerah.</td>
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
                                    <th> 3. </th>
                                    <td>Ceramah/Forum.</td>
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
                                    <th> 4. </th>
                                    <td>Jamuan/Kenduri.</td>
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
                                    <th> 5. </th>
                                    <td>Lain-lain*(Nyatakan)(2 mata)<br>
                                        i.<?php
                                            $sub_menu = $sql1.$aspek1.$komponen2.$menu1." AND sub_menu='5a'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?><br>
                                        ii.<?php
                                            $sub_menu = $sql1.$aspek1.$komponen2.$menu1." AND sub_menu='5b'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?></td>
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
                                    <th rowspan="5"></th>
                                    <th rowspan="5">B.</th>
                                    <th rowspan="5"><center>SAMBUTAN MAULIDUR RASUL <br> <i>*Pernyataan berserta <br> bukti melayakkan <br>memperoleh skor penuh</i></center></th>
                                    <th> 1. </th>
                                    <td> Perarakan Selawat. </td>
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
                                    <th rowspan="5"><center>6</center></th>
                                    <th rowspan="5">
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
                                    <th> 2. </th>
                                    <td>Marhaban/Berzanji/Qasidah.</td>
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
                                    <th> 3. </th>
                                    <td>Ceramah/Forum.</td>
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
                                    <th> 4. </th>
                                    <td>Jamuan.</td>
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
                                    <th> 5. </th>
                                    <td>Lain-lain*(Nyatakan)(2 mata)<br>
                                        i.<?php
                                            $sub_menu = $sql1.$aspek1.$komponen2.$menu2." AND sub_menu='5a'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?><br>
                                        ii.<?php
                                            $sub_menu = $sql1.$aspek1.$komponen2.$menu2." AND sub_menu='5b'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?></td>
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
                                    <th rowspan="3"></th>
                                    <th rowspan="3">C.</th>
                                    <th rowspan="3"><center>Isra' Mikraj <br> <i>*Pernyataan berserta <br> bukti melayakkan <br>memperoleh skor penuh</i></center></th>
                                    <th> 1. </th>
                                    <td> Ceramah/Forum. </td>
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
                                    <th rowspan="3"><center>4</center></th>
                                    <th rowspan="3">
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
                                    <th> 2. </th>
                                    <td>Jamuan.</td>
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
                                    <td>Lain-lain*(Nyatakan)(2 mata)<br>
                                        i.<?php
                                            $sub_menu = $sql1.$aspek1.$komponen2.$menu3." AND sub_menu='3a'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?><br>
                                        ii.<?php
                                            $sub_menu = $sql1.$aspek1.$komponen2.$menu3." AND sub_menu='3b'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?></td>
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
                                    <th rowspan="10"></th>
                                    <th rowspan="10">D.</th>
                                    <th rowspan="10"><center>Ihya' Ramadan <br> <i>*Pernyataan berserta <br> bukti melayakkan <br>memperoleh skor penuh</i></center></th>
                                    <th> 1. </th>
                                    <td> Ambang Ramadan. </td>
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
                                    <th rowspan="10"><center>11</center></th>
                                    <th rowspan="10">
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
                                    <th> 2. </th>
                                    <td>Berbuka Puasa.</td>
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
                                    <td>Solat Terawih.</td>
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
                                    <td>Makan Sahur.</td>
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
                                    <th> 5. </th>
                                    <td>Tadarus Al-Quran.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 6. </th>
                                    <td>Qiyamullail 10 malam terakhir.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 7. </th>
                                    <td>Program Nuzul al-Quran.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 8. </th>
                                    <td>Bubur Lambuk.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 9. </th>
                                    <td>Ziarah Faqir Miskin.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 10. </th>
                                    <td>Lain-lain*(Nyatakan)(2 mata)<br>
                                        i.<?php
                                            $sub_menu = $sql1.$aspek1.$komponen2.$menu4." AND sub_menu='10a'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?><br>
                                        ii.<?php
                                            $sub_menu = $sql1.$aspek1.$komponen2.$menu4." AND sub_menu='10b'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['detail'];
                                            ?></td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen2.$menu4." AND sub_menu='10'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="3"></th>
                                    <th rowspan="3">E.</th>
                                    <th rowspan="3"><center>Aidil Fitri</center></th>
                                    <th> 1. </th>
                                    <td> Solat Sunat Aidil Fitri. </td>
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
                                    <th rowspan="3"><center>3</center></th>
                                    <th rowspan="3">
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
                                    <th> 2. </th>
                                    <td>Program Ziarah.</td>
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
                                    <td>Sumbangan duit raya kanak-kanak.</td>
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
                                    <th rowspan="3"></th>
                                    <th rowspan="3">F.</th>
                                    <th rowspan="3"><center>Aidil Adha</center></th>
                                    <th> 1. </th>
                                    <td> Solat Sunat Aidil Adha. </td>
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
                                    <th rowspan="3"><center>3</center></th>
                                    <th rowspan="3">
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
                                    <th> 2. </th>
                                    <td>Ibadah korban.</td>
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
                                    <td>Program Ziarah.</td>
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
                                    <th colspan="6"><center>SKOR PENGURUSAN<br>MAJLIS RASMI/PERISTIWA PENTING KALENDAR HIJRAH</center></th>
                                    <th><center>33</center></th>
                                    <th>
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
                                    </th>
                                </tr>
                                <tr>
                                    <th>3.</th>
                                    <th colspan=4> KOMPONEN: PENGURUSAN AKTIVITI ILMU</th>
                                    <th> SKOR</th>
                                    <th><center>SKOR PENUH</center></th>
                                    <th><center>SKOR DIPEROLEH</center></th>
                                </tr>
                                <tr>
                                    <th rowspan="10"></th>
                                    <th rowspan="10">A.</th>
                                    <th rowspan="10"><center>Kuliah Maghrib </center></th>
                                    <th> 1. </th>
                                    <td> i. Setiap hari (5 mata)<br>ii. 6 kali seminggu (4 mata)<br>iii. 4-5 kali seminggu (3 mata)<br> iv. 3 kali seminggu (2 mata)<br>
                                        v. 1-2 kali seminggu (1 mata)<br> vi. Tiada langsung (Tiada mata) </td>
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
                                    <th rowspan="10"><center>14</center></th>
                                    <th rowspan="10">
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
                                    <th> 2. </th>
                                    <td>Berkitab/bertajuk.</td>
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
                                    <td>Tafsir.</td>
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
                                    <th> 4. </th>
                                    <td>Hadis.</td>
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
                                    <td>Al-Quran dan Tajwid.</td>
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
                                    <th> 6. </th>
                                    <td>Fekah.</td>
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
                                    <th> 7. </th>
                                    <td>Tasawuf.</td>
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
                                    <th> 8. </th>
                                    <td>Sirah.</td>
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
                                    <th> 9. </th>
                                    <td>Disiplin ilmu selain agama.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 10. </th>
                                    <td>Kuliah umum sekali sebulan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu1." AND sub_menu='10'";
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
                                    <th rowspan="2"><center>Kuliah Subuh</center></th>
                                    <th> 1. </th>
                                    <td> i. 3 kali dan ke atas seminggu (2 mata)<br>
                                        ii. 1-2 kali seminggu (1 mata)<br> vi. Tiada langsung (Tiada mata) </td>
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
                                    <th rowspan="2"><center>3</center></th>
                                    <th rowspan="2">
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
                                    <th> 2. </th>
                                    <td>Berkitab/bertajuk.</td>
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
                                    <th rowspan="2"></th>
                                    <th rowspan="2">C.</th>
                                    <th rowspan="2"><center>Kuliah Dhuha</center></th>
                                    <th> 1. </th>
                                    <td> i. 2 kali seminggu. (2 mata)<br>
                                        ii. 1 kali seminggu. (1 mata)<br> vi. Tiada langsung. (Tiada mata) </td>
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
                                    <th rowspan="2"><center>3</center></th>
                                    <th rowspan="2">
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
                                    <th> 2. </th>
                                    <td>Berkitab/bertajuk.</td>
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
                                    <th rowspan="3"></th>
                                    <th rowspan="3">D.</th>
                                    <th rowspan="3"><center>Pengajian Wanita</center></th>
                                    <th> 1. </th>
                                    <td> i. 2 kali seminggu. (2 mata)<br>
                                        ii. 1 kali seminggu. (1 mata)<br> vi. Tiada langsung. (Tiada mata) </td>
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
                                    <th rowspan="3"><center>4</center></th>
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
                                    <td>Berkitab/bertajuk.</td>
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
                                    <td>Kelas kemahiran. (Jahitan, sulaman, gubahan, masakan dll) </td>
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
                                    <th rowspan="9"></th>
                                    <th rowspan="9">E.</th>
                                    <th rowspan="9"><center>Keilmuan dan Kemahiran Remaja</center></th>
                                    <th> 1. </th>
                                    <td> Kelas Al-Quran </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu5." AND sub_menu='1'";
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
                                            $sql_menu = $sql.$aspek1.$komponen3.$menu5;
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
                                    <td>Kelas agama dan fardhu ain.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu5." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 3. </th>
                                    <td>Kursus Pemantapan Aqidah dan Akhlak/ Benkel Aqil <br> Baligh/ Kursus Bina Insan/ Kem Solat. </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu5." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 4. </th>
                                    <td>Kursus Kerjaya/usahawan/ICT.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu5." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 5. </th>
                                    <td>Kelas Tambahan. (UPSR/PT3/SPM/STPM/STAM)</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu5." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 6. </th>
                                    <td>Kelas Bahasa.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu5." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 7. </th>
                                    <td>Program kesenian. (Marhaban, Berzanji, Nasyid, <br> Kompang/ Teater Islam dll)</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu5." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 8. </th>
                                    <td>Seni mempertahankan diri.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu5." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 9. </th>
                                    <td>Aktiviti Sukan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu5." AND sub_menu='9'";
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
                                    <th rowspan="6"><center>Keilmuan dan Kemahiran Kanak-kanak</center></th>
                                    <th> 1. </th>
                                    <td> Kelas Iqra' dan Al-Quran </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu6." AND sub_menu='1'";
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
                                            $sql_menu = $sql.$aspek1.$komponen3.$menu6;
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
                                    <td>Kelas agama dan fardhu ain.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu6." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 3. </th>
                                    <td>Kelas Tambahan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu6." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 4. </th>
                                    <td>Program kesenian. (Marhaban, Berzanji, Nasyid, <br> Kompang/ Teater Islam dll)</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu6." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 5. </th>
                                    <td>Seni mempertahankan diri.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu6." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 6. </th>
                                    <td>Aktiviti Sukan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu6." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th rowspan="4"></th>
                                    <th rowspan="4">G.</th>
                                    <th rowspan="4"><center>Program Saudara Baru</center></th>
                                    <th> 1. </th>
                                    <td> Kelas Iqra' dan Al-Quran </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu7." AND sub_menu='1'";
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
                                            $sql_menu = $sql.$aspek1.$komponen3.$menu7;
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
                                    <td>Kelas agama dan fardhu ain.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu7." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 3. </th>
                                    <td>Kelas Pemantapan Aqidah.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu7." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 4. </th>
                                    <td>Kelas Kemahiran</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen3.$menu7." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6"><center><h4>SKOR PENGURUSAN AKTIVITI ILMU</h4></center></th>
                                    <th><center>43</center></th>
                                    <th>
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
                                    </th>
                                </tr>
                                <tr>
                                    <th>4.</th>
                                    <th colspan=4> KOMPONEN: PENGURUSAN KHIDMAT MASYARAKAT</th>
                                    <th>SKOR</th>
                                    <th><center>SKOR PENUH</center></th>
                                    <th><center>SKOR DIPEROLEH</center></th>
                                </tr>
                                <tr>
                                    <th rowspan="11"></th>
                                    <th rowspan="11">A.</th>
                                    <th rowspan="11"><center>Ziarah/Sumbangan Kebajikan</center></th>
                                    <th> 1. </th>
                                    <td> Tabung kebajikan diwujudkan </td>
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
                                    <th rowspan="11"><center>11</center></th>
                                    <th rowspan="11">
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
                                    <td>Ibu tunggal.</td>
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
                                    <td>Orang sakit.</td>
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
                                    <td>OKU.</td>
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
                                    <th> 5. </th>
                                    <td>Faqir Miskin.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='5'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 6. </th>
                                    <td>Warga Emas.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 7. </th>
                                    <td>Saudara Baru.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 8. </th>
                                    <td>Bukan Islam.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='8'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 9. </th>
                                    <td>Pelajar Cemerlang.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='9'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 10. </th>
                                    <td>Bantuan Persekolahan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='10'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 11. </th>
                                    <td>Bencana alam.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu1." AND sub_menu='11'";
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
                                    <th rowspan="3"></th>
                                    <th rowspan="3">B.</th>
                                    <th rowspan="3"><center>Aktiviti Riadah/Rekreasi</center></th>
                                    <th> 1. </th>
                                    <td> Sukan dewasa. </td>
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
                                    <th rowspan="3"><center>3</center></th>
                                    <th rowspan="3">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
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
                                    <td>Hari Keluarga.</td>
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
                                    <td> Lawatan Sambil Belajar. </td>
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
                                    <th rowspan="3"></th>
                                    <th rowspan="3">C.</th>
                                    <th rowspan="3"><center>Sukarelawan Masjid</center></th>
                                    <th> 1. </th>
                                    <td> Pasukan sukarelawan berorganisasi. </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu3." AND sub_menu='1'";
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
                                            $sql_menu = $sql.$aspek1.$komponen4.$menu3;
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
                                    <td>Aktif.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu3." AND sub_menu='2'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 3. </th>
                                    <td> Peruntukan khas atau inisiatif kepada organisasi dan ahli. </td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen4.$menu3." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6"><center><h4>SKOR PENGURUSAN KHIDMAT MASYARAKAT</h4></center></th>
                                    <th><center>17</center></th>
                                    <th>
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
                                    </th>
                                </tr>
                                <tr>
                                    <th>5.</th>
                                    <th colspan=4> KOMPONEN: PENGURUSAN PROMOSI/HEBAHAN DAN PAPARAN AKTIVITI</th>
                                    <th> SKOR</th>
                                    <th><center>SKOR PENUH</center></th>
                                    <th><center>SKOR DIPEROLEH</center></th>
                                </tr>
                                <tr>
                                    <th rowspan="8"></th>
                                    <th rowspan="8">A.</th>
                                    <th rowspan="8"><center>Promosi dan Hebahan</center></th>
                                    <th> 1. </th>
                                    <td> Pasukan khas promosi/hebahan </td>
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
                                    <th rowspan="8"><center>8</center></th>
                                    <th rowspan="8">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
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
                                    <td>Terancang dan berstrategi.</td>
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
                                    <td>Banner dan poster.</td>
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
                                    <td>Design/Warna standard banner dan poster.</td>
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
                                    <td>Kumpulan media sosial anak kariah.(fb/wsp/tgr dll).</td>
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
                                    <th> 6. </th>
                                    <td>Hebahan dalam media sosal anak kariah.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen5.$menu1." AND sub_menu='6'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 7. </th>
                                    <td>Peruntukan khas promosi/hebahan.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen5.$menu1." AND sub_menu='7'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 8. </th>
                                    <td>Paparan Digital.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen5.$menu1." AND sub_menu='8'";
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
                                    <th rowspan="4"><center>Paparan Aktiviti</center></th>
                                    <th> 1. </th>
                                    <td> Petugas/pasukan khas </td>
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
                                    <th rowspan="4"><center>4</center></th>
                                    <th rowspan="4">
                                        <center>
                                            <?php
                                            $skor_menu = 0;
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
                                    <td>Galeri aktiviti.</td>
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
                                <tr>
                                    <th> 3. </th>
                                    <td>Teratur dan tersusun.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen5.$menu2." AND sub_menu='3'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th> 4. </th>
                                    <td>Dikemaskini secara berkala.</td>
                                    <th>
                                        <center>
                                            <?php
                                            $sub_menu = $sql.$aspek1.$komponen5.$menu2." AND sub_menu='4'";
                                            $sqlquery=mysqli_query($bd2,$sub_menu);
                                            $data=mysqli_fetch_array($sqlquery);
                                            echo $data['skor'];
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6"><center><h4>SKOR PENGURUSAN PROMOSI/HEBAHAN DAN PAPARAN AKTIVITI</h4></center></th>
                                    <th><center>12</center></th>
                                    <th>
                                        <center>
                                            <?php
                                            $skor_komponen = 0;
                                            $sql_komponen = $sql.$aspek1.$komponen5;
                                            $sqlquery=mysqli_query($bd2,$sql_komponen);
                                            while($data=mysqli_fetch_array($sqlquery))
                                            {
                                                $skor_komponen = $skor_komponen + $data['skor'];
                                            }
                                            echo $skor_komponen;
                                            ?>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6"><center><h4>JUMLAH SKOR KESELURUHAN</h4></th>
                                    <th><center>128</center></th>
                                    <th>
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
                                    </th>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <table align="center" style="display:none">
                                <tr>
                                    <th colspan=2>PENEMUAN-PENEMUAN LAIN YANGYANG MENARIK DAN BAGUS</th>
                                    <th width=5%> SKOR DIPEROLEH </th>
                                </tr>
                                <tr>
                                    <th width=5% >1.</th>
                                    <th>
                                        <textarea rows="5" cols="75" name="txt1" id="txt1" >
                                        </textarea></th>
                                    <th><input type="number" name="num1" id="num1"</th>
                                </tr>
                                <tr>
                                    <th>2.</th>
                                    <th>
                                        <textarea rows="5" cols="75" name="txt2" id="txt2" >
                                        </textarea></th>
                                    <th><input type="number" name="num2" id="num2"</th>
                                </tr>

                                <tr>
                                    <th>3.</th>
                                    <th>
			<textarea rows="5" cols="75" name="txt3" id="txt3" >
			</textarea>
                                    </th>
                                    <th><input type="number" name="num3" id="num3"</th>
                                </tr>

                                <tr>
                                    <th>4.</th>
                                    <th>
			<textarea rows="5" cols="75" name="txt4" id="txt4" >
			</textarea>
                                    </th>
                                    <th><input type="number" name="num4" id="num4"</th>
                                </tr>

                                <tr>
                                    <th>5.</th>
                                    <th>
			<textarea rows="5" cols="75" name="txt5" id="txt5" >
			</textarea></th>
                                    <th><input type="number" name="num5" id="num5"</th>
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