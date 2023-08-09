<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Daftar Ahli Organisasi Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li class="active">Daftar Ahli Organisasi Masjid</li>
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
                    Carian Ahli Organisasi Masjid
                </div>
                <div class="card-body">
                    <form name="ibu_tunggal" method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ;?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No K/P</label>
                                        <input class="form-control" name="no_ic" id="no_ic" minlength="12" maxlength="12" required>
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

        include("connection/connection.php");

        $sql_search = "SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_peribadi ON data_ajkmasjid.id_ajk = sej6x_data_peribadi.id_data LEFT JOIN rekod_organisasi ON data_ajkmasjid.id_dataajk = rekod_organisasi.id_rekod 
                       WHERE rekod_organisasi.id_rekod IS NULL AND sej6x_data_peribadi.no_ic LIKE '%$no_ic%' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_peribadi ON data_pegawai_masjid.id_pegawai = sej6x_data_peribadi.id_data LEFT JOIN rekod_organisasi ON data_pegawai_masjid.id_datapegawai = rekod_organisasi.id_rekod 
                       WHERE rekod_organisasi.id_rekod IS NULL AND sej6x_data_peribadi.no_ic LIKE '%$no_ic%' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan LEFT JOIN rekod_organisasi ON data_pengurusan_masjid.id_pengurusan = rekod_organisasi.id_rekod 
                       WHERE rekod_organisasi.id_rekod IS NULL AND data_pengurusan_masjid.no_ic LIKE '%$no_ic%' AND data_pengurusan_masjid.id_masjid = $id_masjid
                       UNION
                       SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_anakqariah ON data_ajkmasjid.id_ajk2 = sej6x_data_anakqariah.ID LEFT JOIN rekod_organisasi ON data_ajkmasjid.id_dataajk = rekod_organisasi.id_rekod 
                       WHERE rekod_organisasi.id_rekod IS NULL AND sej6x_data_anakqariah.no_ic LIKE '%$no_ic%' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_anakqariah ON data_pegawai_masjid.id_pegawai2 = sej6x_data_anakqariah.ID LEFT JOIN rekod_organisasi ON data_pegawai_masjid.id_datapegawai = rekod_organisasi.id_rekod 
                       WHERE rekod_organisasi.id_rekod IS NULL AND sej6x_data_anakqariah.no_ic LIKE '%$no_ic%' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan LEFT JOIN rekod_organisasi ON data_pengurusan_masjid.id_pengurusan = rekod_organisasi.id_rekod 
                       WHERE rekod_organisasi.id_rekod IS NULL AND data_pengurusan_masjid.no_ic LIKE '%$no_ic%' AND data_pengurusan_masjid.id_masjid = $id_masjid";

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
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No K/P</div></th>
                                            <th><div align="center">Jawatan</div></th>
                                            <th><div align="center">Butiran Jawatan</div></th>

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
                                                <td><?php echo $row['nama_penuh']; ?></td>
                                                <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                                <td><div align="center"><?php echo $row['jawatan']; ?></div></td>
                                                <td>
                                                    <div align="center">
                                                        <a href="utama.php?view=admin&action=butiran_rekod_organisasi&idrekod=<?php echo $row['idrekod'];?>">
                                                            <input type="button" value="Daftar" class="btn btn-success" />
                                                        </a>
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
                                window.location.href='utama.php?view=admin&action=butiran_rekod_organisasi&idrekod=<?php echo $no_ic; ?>';
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


