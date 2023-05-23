<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Butiran Jawatan Pegawai Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li><a href="utama.php?view=admin&action=daftar_pegawai">Daftar Pegawai Masjid</a></li>
                    <li class="active">Butiran Jawatan</li>
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
                    Maklumat Jawatan
                </div>
                <?php

                include("connection/connection.php");

                if(isset($_GET['id_data'])){
                    $idd = $_GET['id_data'];

                    if(strpos($idd, 'A-') !== true) {
                        $sql_search="SELECT a.id_data, a.nama_penuh, a.no_ic, a.umur, a.alamat_terkini, a.no_hp, b.pekerjaan
FROM sej6x_data_peribadi a LEFT JOIN pekerjaan b ON a.pekerjaan = b.id_pekerjaan WHERE a.id_data='".$idd."' ";
                    }
                    if(strpos($idd, 'A-') !== false) {
                        $idd = str_replace('A-', '', $idd);
                        $sql_search="SELECT CONCAT('A-', ID) 'id_data', nama_penuh, no_ic, umur, NULL 'alamat_terkini', NULL 'no_hp', pekerjaan FROM sej6x_data_anakqariah WHERE ID='".$idd."' ";
                    }
                    $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <div class="card-body">
                        <form action="admin/add_pegawai.php" method='post' enctype="multipart/form-data">
                            <div class="row">
                                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Nama Pegawai Masjid:</label> <?php echo $row['nama_penuh'];?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>No K/P:</label> <?php echo $row['no_ic'];?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Pekerjaan:</label> <?php echo $row['pekerjaan'];?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Jawatan</label>
                                            <select class="form-control" name="jawatan" id="jawatan" required>
                                                <option>Sila Pilih</option>
                                                <option value="Imam">Imam </option>
                                                <!-- <option value="Imam Tambah">Imam Tambah</option> -->
                                                <option value="Bilal">Bilal </option>
                                                <!-- <option value="Bilal Tambah">Bilal Tambah </option> -->
                                                <option value="Siak">Siak </option>
                                                <!-- <option value="Siak Tambah">Siak Tambah </option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div id="lantikkanContainer" class="col-12 col-md-4" style="display: none">
                                        <div class="form-group">
                                            <label>Lantikkan Oleh</label>
                                            <select class="form-control" name="lantikkan" id="lantikkan">
                                                <option value="">Sila Pilih</option>
                                                <option value="MAIP">MAIP </option>
                                                <option value="Masjid">Masjid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Lantikan</label>
                                            <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" requiredX>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Muat-Naik Gambar</label>
                                            <input id="gambar" name="gambar" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')">
                                            <img class="img-fluid p-3" id="output1" src="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <center>
                                            <div class="form-group">
                                                <br>
                                                <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
                                                <input type="hidden" name="id_pegawai" value="<?php echo $row['id_data']; ?>">
                                                <input type="submit"  value="Simpan" class="btn btn-primary">
                                            </div>
                                        </center>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                    <?php
                }
                else if(!isset($_GET['id_data'])){
                    ?>
                    <div class="card-body">
                        <form action="admin/add_pegawai.php" method='post' enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Nama Pegawai Masjid:</label>
                                        <input type="text" name="nama_penuh" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No K/P:</label>
                                        <input type="text" name="no_ic" minlength="12" maxlength="12" value="<?php echo $_GET['no_ic']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>No Telefon:</label>
                                        <input type="text" name="no_tel" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Pekerjaan:</label>
                                        <select id="pekerjaan" name="pekerjaan" required class="form-control">
                                            <option value="">Sila Pilih:-</option>
                                            <option value="Kerajaan">Kerajaan</option>
                                            <option value="Swasta">Swasta</option>
                                            <option value="Bekerja Sendiri / Berniaga">Bekerja Sendiri / Berniaga</option>
                                            <option value="Pencen">Pencen</option>
                                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                                            <option value="Pelajar">Pelajar</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Jawatan</label>
                                        <select class="form-control" name="jawatan" id="jawatan" required>
                                            <option>Sila Pilih</option>
                                            <option value="Imam">Imam </option>
                                            <!-- <option value="Imam Tambah">Imam Tambah</option> -->
                                            <option value="Bilal">Bilal </option>
                                            <!-- <option value="Bilal Tambah">Bilal Tambah </option> -->
                                            <option value="Siak">Siak </option>
                                            <!-- <option value="Siak Tambah">Siak Tambah </option> -->
                                        </select>
                                    </div>
                                </div>
                                <div id="lantikkanContainer" class="col-12 col-md-4" style="display: none">
                                    <div class="form-group">
                                        <label>Lantikkan Oleh</label>
                                        <select class="form-control" name="lantikkan" id="lantikkan">
                                            <option value="">Sila Pilih</option>
                                            <option value="MAIP">MAIP </option>
                                            <option value="Masjid">Masjid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tarikh Lantikan</label>
                                        <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" requiredX>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Muat-Naik Gambar</label>
                                        <input id="gambar" name="gambar" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')">
                                        <img class="img-fluid p-3" id="output1" src="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                        <div class="form-group">
                                            <br>
                                            <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
                                            <input type="hidden" name="id_pegawai" value="<?php echo $row['id_data']; ?>">
                                            <input type="submit"  value="Simpan" class="btn btn-primary">
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
