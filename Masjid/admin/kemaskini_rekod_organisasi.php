<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kemaskini Rekod Ahli Organisasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li><a href="utama.php?view=admin&action=daftar_rekod_organisasi">Daftar Ahli Organisasi Masjid</a></li>
                    <li class="active">Kemaskini Rekod Ahli Organisasi</li>
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
                    Kemaskini Maklumat Ahli
                </div>
                <?php

                include("connection/connection.php");

                if(isset($_GET['idrekod'])){
                    $id_rekod = $_GET['idrekod']; //tukar bagi pakai ic

                    $sql_search = "SELECT id, id_rekod, id_masjid, nama_penuh, no_pengenalan, no_telefon, jawatan, tarikh_lantikan, tarikh_perletakan, sebab_perletakan 
                                    FROM rekod_organisasi WHERE id_masjid = $id_masjid AND id = $id_rekod ";

                    $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <div class="card-body">
                        <form action="admin/update_rekod_organisasi.php" method='post' enctype="multipart/form-data">
                            <div class="row">
                                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Nama Penuh</label>
                                                <input type="text" name="nama_penuh" value="<?php echo $row['nama_penuh']; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>No K/P</label>
                                                <input type="text" name="no_pengenalan" minlength="12" maxlength="12" value="<?php echo $row['no_pengenalan']; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>No Telefon</label>
                                                <input type="text" name="no_telefon" value="<?php echo $row['no_telefon']; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Jawatan</label>
                                                <input type="text" name="jawatan" value="<?php echo $row['jawatan']; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Tarikh Lantikan</label>
                                                <input type="date" name="tarikh_lantikan" id="tarikh_lantikan" value="<?php echo $row['tarikh_lantikan']; ?>" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Tarikh Perletakan</label>
                                                <input type="date" name="tarikh_perletakan" id="tarikh_perletakan" value="<?php echo $row['tarikh_perletakan']; ?>" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Sebab Perletakan</label>
                                                <input type="text" name="sebab_perletakan" value="<?php echo $row['sebab_perletakan']; ?>" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <center>
                                                <div class="form-group">
                                                    <br>
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <input type="submit"  value="Kemaskini" class="btn btn-primary">
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
