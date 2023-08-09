<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Butiran Ahli Organisasi Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li><a href="utama.php?view=admin&action=senarai_rekod">Senarai Ahli Organisasi Masjid</a></li>
                    <li class="active">Butiran Ahli Organisasi Masjid</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Maklumat Ahli &nbsp;&nbsp;
                    <button  class="btn btn-info" onclick="history.go(-1);">Kembali </button>
                </div>
                <?php

                include("connection/connection.php");

                $idr = $_GET['id_rekod'];

                $semak_rekod = "SELECT * FROM rekod_organisasi WHERE id = $idr";
                $r_rekod = mysqli_query($bd2, $semak_rekod) or die ("Error :".mysqli_error($bd2));
                $r_result = mysqli_fetch_assoc($r_rekod);

                ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div>
                                <label style="text-align: center; font-size: medium; font-weight: normal">Nama Penuh : <?php echo $r_result['nama_penuh'];?></label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label style="text-align: center; font-size: medium; font-weight: normal">No Pengenalan : <?php echo $r_result['no_pengenalan'];?> </label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <label style="text-align: center; font-size: medium; font-weight: normal">No Telefon : <?php echo $r_result['no_telefon'];?> </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="card-body">
                            <div class="row">
                                <form id="formPilih" enctype="multipart/form-data" method="get">
                                    <?php foreach ($_GET as $key => $val) {
                                        if( $key != "pilihSusun") { ?>
                                            <input type="hidden" name="<?php echo($key); ?>" value="<?php echo($val); ?>">
                                        <?php } } ?>
                                    <div class="row">
                                        <div class="col-6 align-self-center" align="center">
                                            <label for="pilihSusun">Ikut Susunan</label>
                                            <select onchange="$('#formPilih').submit()" id="pilihSusun" name="pilihSusun" class="form-control">
                                                <option></option>
                                                <option value="1" <?php echo $pilihSusun == 1 ? 'selected' : NULL; ?>>Tarikh Lantikan Terkini</option>
                                                <option value="2" <?php echo $pilihSusun == 2 ? 'selected' : NULL; ?>>Tarikh Lantikan Terawal</option>
                                                <option value="3" <?php echo $pilihSusun == 3 ? 'selected' : NULL; ?>>Tarikh Perletakan Terkini</option>
                                                <option value="4" <?php echo $pilihSusun == 4 ? 'selected' : NULL; ?>>Tarikh Perletakan Terawal</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="senarai_semakrekod" width="100%" data-order="[]" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Jawatan</div></th>
                                            <th><div align="center">Tarikh Lantikan</div></th>
                                            <th><div align="center">Tarikh Perletakan</div></th>
                                            <th><div align="center">Tempoh Jawatan</div></th>
                                            <th><div align="center">Sebab Perletakan</div></th>
                                            <th><div align="center"></div></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        foreach ($_GET as $key => $val) {
                                            if($val != NULL ) ${$key} = $val;
                                        }
                                        $susun = "ORDER BY tarikh_lantikan ASC";
                                        if($pilihSusun == 1) $susun = "ORDER BY tarikh_lantikan DESC";
                                        if($pilihSusun == 2) $susun = "ORDER BY tarikh_lantikan ASC";
                                        if($pilihSusun == 3) $susun = "ORDER BY tarikh_perletakan DESC";
                                        if($pilihSusun == 4) $susun = "ORDER BY tarikh_perletakan ASC";


                                        $list_j="SELECT id, jawatan, tarikh_lantikan, tarikh_perletakan, sebab_perletakan FROM rekod_organisasi WHERE id_masjid = $id_masjid AND no_pengenalan LIKE '%$idr2%' $susun ";
                                        $r_list = mysqli_query($bd2, $list_j) or die ("Error :".mysqli_error($bd2));


                                        $x=1;
                                        while($row = mysqli_fetch_assoc($r_list))
                                        {
                                            ?>
                                                <?php
                                                    $date1 = $row['tarikh_lantikan'];
                                                    $date2 = $row['tarikh_perletakan'];

                                                    $date1a = new DateTime($date1);
                                                    $date2a = new DateTime($date2);

                                                    $interval = $date1a->diff($date2a);
                                                    $yearsInMonths = $interval->format('%r%y') * 12;
                                                    $months = $interval->format('%r%m');
                                                    $totalMonths = $yearsInMonths + $months;
                                                ?>
                                            <tr>
                                                <td><div align="center"><?php echo $x; ?></div></td>
                                                <td><div align="center"><?php echo $row['jawatan']; ?></td>
                                                <td><div align="center"><?php echo $row['tarikh_lantikan']; ?></div></td>
                                                <td><div align="center"><?php echo $row['tarikh_perletakan']; ?></div></td>
                                                <td><div align="center"><?php echo $totalMonths ?> bulan</div></td>
                                                <td><div align="center"><?php echo $row['sebab_perletakan']; ?></div></td>
                                                <td><div align="center"><a href="utama.php?view=admin&action=kemaskini_rekod_organisasi&idrekod=<?php echo $row['id'];?>"><input type="button" value="Kemaskini" class="btn btn-primary" /></a></div></td>
                                            </tr>
                                            <?php
                                            $x++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#senarai_semakrekod', 'Butiran Ahli Organisasi Masjid', [ 0, 1, 2, 3, 4, 5 ]);
    });
</script>