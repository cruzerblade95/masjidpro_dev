<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Butiran Rekod Organisasi Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li><a href="utama.php?view=admin&action=daftar_rekod_organisasi">Daftar Rekod Organisasi Masjid</a></li>
                    <li class="active">Butiran Rekod Organisasi Masjid</li>
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
                    Maklumat Rekod
                </div>
                <?php

                include("connection/connection.php");

                if(isset($_GET['idrekod'])){
                    $id_rekod = $_GET['idrekod']; //tukar bagi pakai ic

                    $sql_search = "SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_peribadi ON data_ajkmasjid.id_ajk = sej6x_data_peribadi.id_data WHERE data_ajkmasjid.id_dataajk = '$id_rekod' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_peribadi ON data_pegawai_masjid.id_pegawai = sej6x_data_peribadi.id_data WHERE data_pegawai_masjid.id_datapegawai = '$id_rekod' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan WHERE data_pengurusan_masjid.id_pengurusan = '$id_rekod' AND data_pengurusan_masjid.id_masjid = $id_masjid
                       UNION
                       SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_anakqariah ON data_ajkmasjid.id_ajk2 = sej6x_data_anakqariah.ID WHERE data_ajkmasjid.id_dataajk = '$id_rekod' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_anakqariah ON data_pegawai_masjid.id_pegawai2 = sej6x_data_anakqariah.ID WHERE data_pegawai_masjid.id_datapegawai = '$id_rekod' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan WHERE data_pengurusan_masjid.id_pengurusan = '$id_rekod' AND data_pengurusan_masjid.id_masjid = $id_masjid";


                    $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <div class="card-body">
                        <form action="admin/add_rekod_organisasi.php" method='post' enctype="multipart/form-data">
                            <div class="row">
                                <?php if($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Nama Penuh</label>
                                                <input type="text" name="nama_penuh" value="<?php echo $row['nama_penuh']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>No K/P</label>
                                                <input type="text" name="no_ic" minlength="12" maxlength="12" value="<?php echo $row['no_ic']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>No Telefon</label>
                                                <input type="text" name="no_tel" value="<?php echo $row['no_tel']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Jawatan</label>
                                                <input type="text" name="jawatan" value="<?php echo $row['jawatan']; ?>" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Tarikh Lantikan</label>
                                                <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Tarikh Perletakan Jawatan</label>
                                                <input class="form-control" type="date" name="tarikh_perletakan" id="tarikh_perletakan" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Sebab</label>
                                                <input type="text" name="sebab_perletakan" class="form-control"  oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <center>
                                                <div class="form-group">
                                                    <br>
                                                    <input type="hidden" name="id_rekod" value="<?php echo $row['idrekod']; ?>">
                                                    <input type="hidden" name="ada_rekod" value="1">
                                                    <input type="submit"  value="Simpan" class="btn btn-primary">
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                    <?php
                                }
                                else {
                                ?>
                                    <div class="card-body">
                                        <form action="admin/add_rekod_organisasi.php" method='post' enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Nama Penuh</label>
                                                        <input type="text" name="nama_penuh" class="form-control"  oninput="this.value = this.value.toUpperCase()" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>No K/P</label>
                                                        <input type="text" name="no_ic" minlength="12" maxlength="12" value="<?php echo $id_rekod; ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>No Telefon</label>
                                                        <input type="text" name="no_tel" class="form-control"  oninput="this.value = this.value.toUpperCase()" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Jawatan</label>
                                                        <input type="text" name="jawatan" class="form-control"  oninput="this.value = this.value.toUpperCase()" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Tarikh Lantikan</label>
                                                        <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Tarikh Perletakan Jawatan</label>
                                                        <input class="form-control" type="date" name="tarikh_perletakan" id="tarikh_perletakan" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Sebab</label>
                                                        <input type="text" name="sebab_perletakan" class="form-control"  oninput="this.value = this.value.toUpperCase()">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <center>
                                                        <div class="form-group">
                                                            <br>
                                                            <input type="hidden" name="id_rekod" value="<?php echo $row['idrekod']; ?>">
                                                            <input type="hidden" name="ada_rekod" value="0">
                                                            <input type="submit"  value="Simpan" class="btn btn-primary">
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
