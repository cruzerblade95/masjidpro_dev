<div class="breadcrumbs">
    <div class="col-sm-8">
        <div class="page-header float-left">
            <div class="page-title">
                <h3>Senarai Jawatankuasa Pegawai</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Senarai Jawatankuasa Pegawai Masjid</li>
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
                    <form name="tahun" method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ;?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <?php

                                            $sqly = "SELECT YEAR(tarikh_lantikan) 'lama' FROM rekod_organisasi GROUP BY YEAR(tarikh_lantikan) ORDER BY `lama` DESC ";
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

        $sql_search = "SELECT rekod_organisasi.id, rekod_organisasi.id_rekod , rekod_organisasi.nama_penuh, rekod_organisasi.no_pengenalan, rekod_organisasi.no_telefon, rekod_organisasi.emel, rekod_organisasi.tarikh_lantikan,
                       jawatankuasa_organisasi.kat_jawatankuasa, jawatankuasa_organisasi.jawatan, jawatankuasa_organisasi.ajk_biro      
                       FROM rekod_organisasi LEFT JOIN jawatankuasa_organisasi ON rekod_organisasi.id_jawatankuasa = jawatankuasa_organisasi.id_jawatankuasa
                       WHERE rekod_organisasi.kategori_jawatankuasa = 'pegawai' AND rekod_organisasi.id_masjid = $id_masjid AND rekod_organisasi.tarikh_lantikan BETWEEN STR_TO_DATE('$tahun1', '%Y-%m-%d') AND STR_TO_DATE('$tahun2', '%Y-%m-%d') ORDER BY rekod_organisasi.tarikh_lantikan ASC;";
        $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Senarai Jawatankuasa Pegawai Masjid
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="post" id="ajkmasjid" action="" enctype="multipart/form-data">
                                <table id="senarai_jawatankuasa_pegawai" width="100%" data-order="[]" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th><div align="center">No</div></th>
                                        <th><div align="center">Nama</div></th>
                                        <th><div align="center">No Pengenalan</div></th>
                                        <th><div align="center">No.Telefon</div></th>
                                        <th><div align="center">Jawatan</div></th>
                                        <th><div align="center"></div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $x=1;
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        ?>
                                        <!--                                            --><?php
//                                            $date1 = $row['tarikh_lantikan'];
//                                            $date2 = $row['tarikh_perletakan'];
//
//                                            $date1a = new DateTime($date1);
//                                            $date2a = new DateTime($date2);
//
//                                            $interval = $date1a->diff($date2a);
//                                            $yearsInMonths = $interval->format('%r%y') * 12;
//                                            $months = $interval->format('%r%m');
//                                            $totalMonths = $yearsInMonths + $months;
//                                            ?>
                                        <tr>
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row['no_pengenalan']; ?></div></td>
                                            <td><div align="center"><?php echo $row['no_telefon']; ?></div></td>
                                            <td><div align="center"><?php if ($row['ajk_biro'] != NULL) { echo strtoupper($row['jawatan']) . ' ' . strtoupper($row['ajk_biro']);} else {echo strtoupper($row['jawatan']);} ?></div></td>
                                            <td><div align="center">
                                                    <div class="row">
                                                        <a href="utama.php?view=admin&action=view_jawatankuasa&id_organisasi=<?php echo $row['id']; ?>&nokuasa=2&sideMenu=organisasi">
                                                            <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Papar">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </a>
                                                        <a href="utama.php?view=admin&action=edit_jawatankuasa&id_organisasi=<?php echo $row['id']; ?>&nokuasa=2&sideMenu=organisasi">
                                                            <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Kemaskini">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <form name="delete" method="POST" action="admin/del_jawatankuasa.php">
                                                            <input type="hidden" name="del" id="del" value="<?php echo $row['id']; ?>">
                                                            <input type="hidden" name="nokuasa" id="nokuasa" value="2">
                                                            <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')"><i class="fa fa-times"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
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
        meja_akaun('#senarai_jawatankuasa_pegawai', 'Senarai Jawatankuasa Pegawai Masjid', [ 0, 1, 2, 3, 4, 5 ]);
    });
</script>


