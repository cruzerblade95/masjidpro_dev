<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Rekod Tahunan Organisasi Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li class="active">Rekod Tahunan Organisasi Masjid</li>
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
                    Carian Mengikut Tahun
                </div>
                <div class="card-body">
                    <form name="ibu_tunggal" method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ;?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <?php

                                                $sqly = "SELECT YEAR(tarikh_lantikan) 'lama' FROM rekod_organisasi GROUP BY YEAR(tarikh_lantikan) ORDER BY `lama` ASC ";
                                                $resulty = mysqli_query($bd2, $sqly) or die ("Error :".mysqli_error($bd2));
                                            ?>
                                            <label>Tahun Mula</label>
                                            <select name="tahun1" id="tahun1" class="form-control">
                                                <?php
                                                while ($row = mysqli_fetch_assoc($resulty)) {
                                                    $year = $row['lama'];
                                                    echo "<option value='$year-01-01'>$year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php

                                                $sqlz = "SELECT YEAR(tarikh_lantikan) 'baru' FROM rekod_organisasi GROUP BY YEAR(tarikh_lantikan) ORDER BY `baru` DESC ";
                                                $resultz = mysqli_query($bd2, $sqlz) or die ("Error :".mysqli_error($bd2));
                                            ?>
                                            <label>Sehingga Tahun</label>
                                            <select name="tahun2" id="tahun2" class="form-control">
                                                <?php
                                                while ($row = mysqli_fetch_assoc($resultz)) {
                                                    $year = $row['baru'];
                                                    echo "<option value='$year-12-31'>$year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <br>
                                        <input type="submit" name="search" value="Carian" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php

    if(isset($_POST['search']))
    {

        $tahun1 = $_POST['tahun1'];
        $tahun2 = $_POST['tahun2'];


        include("connection/connection.php");

        $sql_search = "SELECT id, id_rekod , nama_penuh, no_pengenalan, no_telefon, jawatan, tarikh_lantikan, tarikh_perletakan FROM rekod_organisasi 
                        WHERE id_masjid = $id_masjid AND tarikh_lantikan BETWEEN STR_TO_DATE('$tahun1', '%Y-%m-%d') AND STR_TO_DATE('$tahun2', '%Y-%m-%d') ORDER BY tarikh_lantikan ASC;";
        $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
        $bil = mysqli_num_rows($result);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Rekod Tahunan Organisasi Masjid
                    </div>
                    <div class="card-body">
                        <?php if($bil>0){ ?>
                            <div class="table-responsive">
                                <form method="post" id="ajkmasjid" action="" enctype="multipart/form-data">
                                    <table id="rekod_tahun_org" width="100%" data-order="[]" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No K/P</div></th>
                                            <th><div align="center">Tarikh Lantikan</div></th>
                                            <th><div align="center">Jawatan</div></th>
                                            <th><div align="center">Tempoh Jawatan</div></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $x=1;
                                        while($row = mysqli_fetch_assoc($result))
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
                                                <td><?php echo $row['nama_penuh']; ?></td>
                                                <td><div align="center"><?php echo $row['no_pengenalan']; ?></div></td>
                                                <td><div align="center"><?php echo $row['tarikh_lantikan']; ?></div></td>
                                                <td><div align="center"><?php echo $row['jawatan']; ?></div></td>
                                                <td><div align="center"><?php echo $totalMonths; ?> bulan</div></td>
                                            </tr>
                                            <?php
                                            $x++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <!-- /.table-responsive -->
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <?php
    }
    ?>
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#rekod_tahun_org', 'Rekod Tahunan Organisasi Masjid', [ 0, 1, 2, 3, 4, 5 ]);
    });
</script>

