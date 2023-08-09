<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Semak Organisasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Semak Organisasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>alert("Pendaftaran Berjaya!");</script>';

    // Output JavaScript code to remove the success query parameter from the URL
    echo '<script>
        if (typeof window.history.replaceState === "function") {
            var url = window.location.href;
            url = url.replace("&success=1", "");
            window.history.replaceState({}, "", url);
        }
    </script>';
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Semakan Pengenalan Diri
                </div>
                <div class="card-body">
                    <form name="ibu_tunggal" method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ;?>">
                        <div class="row" align="center">
                            <div class="col-lg-12">
                                <div class="row" align="center">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Jenis Pengenalan</label>
                                            <select class="form-control" name="jenisPengenalan" id="jenisPengenalan">
                                                <option></option>
                                                <option value='1'>MyKad</option>
                                                <option value='2'>No Polis/Tentera</option>
                                                <option value='3'>MyPR</option>
                                                <option value='4'>No Passport</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" >
                                        <div class="form-group">
                                            <label>No Pengenalan</label>
                                            <input class="form-control" name="no_ic" id="no_ic" minlength="12" maxlength="12" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
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

        $no_ic = $_POST['no_ic'];
        $jenisPengenalan = $_POST['jenisPengenalan'];

        include("connection/connection.php");

        $sql_search = "SELECT t.id_organisasi, t.idrekod, t.nama_penuh, t.jenisPengenalan, t.no_ic, t.no_tel, t.jawatan, t.tahun
                        FROM (
                            SELECT rekod_organisasi.id AS id_organisasi, data_ajkmasjid.id_dataajk AS idrekod, sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.jenisPengenalan, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp AS no_tel, data_ajkmasjid.jawatan, YEAR(data_ajkmasjid.tarikh_lantikan) AS tahun 
                            FROM data_ajkmasjid
                            LEFT JOIN sej6x_data_peribadi ON data_ajkmasjid.id_ajk = sej6x_data_peribadi.id_data
                            LEFT JOIN rekod_organisasi ON data_ajkmasjid.id_dataajk = rekod_organisasi.id_rekod 
                            WHERE sej6x_data_peribadi.jenisPengenalan = '$jenisPengenalan' AND sej6x_data_peribadi.no_ic LIKE '%$no_ic%' AND sej6x_data_peribadi.id_masjid = '$id_masjid'
                            
                            UNION
                            
                            SELECT rekod_organisasi.id AS id_organisasi, data_pegawai_masjid.id_datapegawai AS idrekod, sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.jenisPengenalan, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp AS no_tel, data_pegawai_masjid.jawatan, YEAR(data_pegawai_masjid.tarikh_lantikan) AS tahun 
                            FROM data_pegawai_masjid
                            LEFT JOIN sej6x_data_peribadi ON data_pegawai_masjid.id_pegawai = sej6x_data_peribadi.id_data
                            LEFT JOIN rekod_organisasi ON data_pegawai_masjid.id_datapegawai = rekod_organisasi.id_rekod 
                            WHERE sej6x_data_peribadi.jenisPengenalan = '$jenisPengenalan' AND sej6x_data_peribadi.no_ic LIKE '%$no_ic%' AND sej6x_data_peribadi.id_masjid = '$id_masjid'
                            
                            UNION
                            
                            SELECT rekod_organisasi.id AS id_organisasi, data_pengurusan_masjid.id_pengurusan AS idrekod, data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.jenisPengenalan, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan, YEAR(data_pengurusan_masjid.tarikh_lantikan) AS tahun 
                            FROM data_pengurusan_masjid
                            LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan
                            LEFT JOIN rekod_organisasi ON data_pengurusan_masjid.id_pengurusan = rekod_organisasi.id_rekod 
                            WHERE data_pengurusan_masjid.jenisPengenalan = '$jenisPengenalan' AND data_pengurusan_masjid.no_ic LIKE '%$no_ic%' AND data_pengurusan_masjid.id_masjid = '$id_masjid'
                            
                            UNION
                            
                            SELECT rekod_organisasi.id AS id_organisasi, data_ajkmasjid.id_dataajk AS idrekod, sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.jenisPengenalan, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_ajkmasjid.jawatan, YEAR(data_ajkmasjid.tarikh_lantikan) AS tahun 
                            FROM data_ajkmasjid
                            LEFT JOIN sej6x_data_anakqariah ON data_ajkmasjid.id_ajk2 = sej6x_data_anakqariah.ID
                            LEFT JOIN rekod_organisasi ON data_ajkmasjid.id_dataajk = rekod_organisasi.id_rekod 
                            WHERE sej6x_data_anakqariah.jenisPengenalan = '$jenisPengenalan' AND sej6x_data_anakqariah.no_ic LIKE '%$no_ic%' AND sej6x_data_anakqariah.id_masjid = '$id_masjid'
                            
                            UNION
                            
                            SELECT rekod_organisasi.id AS id_organisasi, data_pegawai_masjid.id_datapegawai AS idrekod, sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.jenisPengenalan, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_pegawai_masjid.jawatan, YEAR(data_pegawai_masjid.tarikh_lantikan) AS tahun 
                            FROM data_pegawai_masjid
                            LEFT JOIN sej6x_data_anakqariah ON data_pegawai_masjid.id_pegawai2 = sej6x_data_anakqariah.ID
                            LEFT JOIN rekod_organisasi ON data_pegawai_masjid.id_datapegawai = rekod_organisasi.id_rekod 
                            WHERE sej6x_data_anakqariah.jenisPengenalan = '$jenisPengenalan' AND sej6x_data_anakqariah.no_ic LIKE '%$no_ic%' AND sej6x_data_anakqariah.id_masjid = '$id_masjid'
                            
                            UNION
                            
                            SELECT rekod_organisasi.id AS id_organisasi, data_pengurusan_masjid.id_pengurusan AS idrekod, data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.jenisPengenalan, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan, YEAR(data_pengurusan_masjid.tarikh_lantikan) AS tahun 
                            FROM data_pengurusan_masjid
                            LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan
                            LEFT JOIN rekod_organisasi ON data_pengurusan_masjid.id_pengurusan = rekod_organisasi.id_rekod 
                            WHERE data_pengurusan_masjid.jenisPengenalan = '$jenisPengenalan' AND data_pengurusan_masjid.no_ic LIKE '%$no_ic%' AND data_pengurusan_masjid.id_masjid = '$id_masjid'
                            
                            UNION
                            
                            SELECT id AS id_organisasi, id_rekod AS idrekod, nama_penuh, jenisPengenalan, no_pengenalan AS no_ic, no_telefon AS no_tel, jawatan, YEAR(tarikh_lantikan) AS tahun 
                            FROM rekod_organisasi 
                            WHERE jenisPengenalan = '$jenisPengenalan' AND no_pengenalan LIKE '%$no_ic%' AND id_masjid = '$id_masjid'
                        ) AS t WHERE t.tahun = YEAR(CURDATE())ORDER BY t.tahun DESC, t.idrekod DESC ";

        $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
        $bil = mysqli_num_rows($result);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Maklumat Ahli Organisasi Masjid
                    </div>
                    <div class="card-body">
                        <?php if($bil>0){ ?>
                            <div class="table-responsive">
                                <form method="post" id="ajkmasjid" action="" enctype="multipart/form-data">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">No Pengenalan</div></th>
                                            <th><div align="center">Jawatan</div></th>
                                            <th><div align="center">Tahun</div></th>
                                            <th><div align="center"></div></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $x=1;
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            ?>
                                            <tr>
                                                <td><div align="center"><?php echo $x; ?></div></td>
                                                <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                                <td><div align="center"><?php echo $row['jawatan']; ?></div></td>
                                                <td><div align="center"><?php echo $row['tahun']; ?></div></td>
                                                <td>
                                                    <div align="center">
                                                        <?php if(($row['id_organisasi']) != 0) {?>
                                                        <a href="utama.php?view=admin&action=paparorganisasi&idorganisasi=<?php echo $row['id_organisasi'];?>&sideMenu=organisasi">
                                                            <input type="button" value="Papar" class="btn btn-info" />
                                                        </a>
                                                        <?php } else { ?>
                                                        <a href="utama.php?view=admin&action=daftarorganisasi&idrekod=<?php echo $row['idrekod'];?>&sideMenu=organisasi">
                                                            <input type="button" value="Daftar" class="btn btn-success" />
                                                        </a>
                                                        <?php } ?>
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
                        <?php
                        }
                        else if($bil==0) { ?>

                            <script type="text/javascript">
                                window.location.href='utama.php?view=admin&action=daftarorganisasi&jenisPengenalan=<?php echo $jenisPengenalan; ?>&no_ic=<?php echo $no_ic; ?>&sideMenu=organisasi';
                            </script>

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


