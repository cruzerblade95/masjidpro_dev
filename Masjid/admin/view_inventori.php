<?php

$idd = $_GET['id_inventori'];

$sql = "SELECT a.id_inventori, a.nama_peralatan, a.kod_peralatan, e.jenis_inventori as jenis_peralatan, a.tarikh_belian, c.nama_penuh as nama_pegawai, d.nama_penyelenggara as nama_penyelenggara,
        SUM(a.kuantiti_belian - f.kuantiti) as semasa, a.kuantiti_unit, a.harga_belian as harga_unit, SUM(a.kuantiti_belian*a.harga_belian) as harga_keseluruhan,a.lokasi, a.catatan, CASE WHEN id_statuskerosakan = 2 OR id_statuskerosakan = 3 THEN kuantiti ELSE NULL END AS pembaikan ,
        CASE WHEN id_statuskerosakan = 5 THEN kuantiti ELSE NULL END AS rosak 
        FROM sej6x_data_inventori a 
        LEFT JOIN data_ajkmasjid b ON a.id_pegawai = b.id_dataajk 
        LEFT JOIN sej6x_data_peribadi c ON b.id_ajk = c.id_data 
        LEFT JOIN penyelenggara d ON a.id_penyelenggara = d.id_penyelenggara
        LEFT JOIN sej6x_data_jenisinventori e ON a.jenis_peralatan = e.id_jenisinventori
        LEFT JOIN sej6x_data_kerosakkan f ON a.id_inventori = f.id_peralatan
        WHERE a.id_inventori = '$idd'";
$result = mysqli_query($bd2, $sql) or die ("Error :".mysqli_error($bd2));
$row = mysqli_fetch_assoc($result);
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Maklumat Inventori</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=maklumatinventori">Laporan Inventori</a></li>
                    <li class="active">Maklumat Inventori</li>
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
                    <div class="row">
                        <div class="col-lg-10">
                            Maklumat Inventori
                        </div>
                        <div class="col-lg-2" align="end">
                            <a href="utama.php?view=admin&action=rekod_inventori&id_inventori=<?php echo $row['id_inventori']; ?>&sideMenu=masjid"><button class="btn btn-primary">Rekod Inventori</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <!--Nama Peralatan-->
                            <div class="form-group">
                                <label>Nama Peralatan :</label><br>
                                <label><?php echo $row['nama_peralatan']; ?></label>
                            </div>
                            <!--Jenis Peralatan-->
                            <div class="form-group">
                                <label>Kategori Peralatan :</label><br>
                                <label><?php echo $row['jenis_peralatan']; ?></label>
                            </div>
                            <!--Harga Belian & Per Unit-->
                            <div class="form-group">
                                <label>Harga Belian/Per Unit :</label><br>
                                <label>RM&nbsp;<?php echo $row['harga_unit']; ?></label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!--Kod Peralatan-->
                            <div class="form-group">
                                <label>Kod Peralatan :</label><br>
                                <label><?php echo $row['kod_peralatan']; ?></label>
                            </div>
                            <!--Lokasi-->
                            <div class="form-group">
                                <label>Tempat/Lokasi (Simpan) :</label><br>
                                <label><?php echo $row['lokasi']; ?></label>
                            </div>
                            <!--Harga Keseluruhan-->
                            <div class="form-group">
                                <label>Harga Keseluruhan :</label><br>
                                <label>RM&nbsp;<?php echo $row['harga_keseluruhan']; ?></label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!--Nama Pegawai-->
                            <div class="form-group">
                                <label>Nama Pegawai :</label><br>
                                <label><?php echo $row['nama_pegawai']; ?></label>
                            </div>
                            <!--Tarikh Belian/Terima-->
                            <div class="form-group">
                                <label>Tarikh Belian/Terima :</label><br>
                                <label><?php echo $row['tarikh_belian']; ?></label>
                            </div>
                            <!--Catatan-->
                            <div class="form-group">
                                <label>Catatan :</label><br>
                                <label><?php echo $row['catatan']; ?></label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!--Nama Penyelenggara-->
                            <div class="form-group">
                                <label>Nama Penyelenggara :</label><br>
                                <label><?php echo $row['nama_penyelenggara']; ?></label>
                            </div>
                            <!--Kuantiti & Unit Kuantiti-->
                            <div class="form-group">
                                <label>Kuantiti Semasa :</label><br>
                                <label><?php echo $row['semasa']; ?>&nbsp;<?php echo $row['kuantiti_unit']; ?></label>
                            </div>
                            <!--Status Penyelenggaraan-->
                            <div class="form-group">
                                <label>Status Penyelenggaraan :</label>
                                <br>
                                <label>Pembaikan :&nbsp;<?php echo $row['pembaikan']; ?></label>
                                <br>
                                <label>Rosak & Dilupus :&nbsp;<?php echo $row['rosak']; ?></label>
                            </div>
                        </div>
                        <div class="col-lg-12" align="center">
                            <a href="utama.php?view=admin&action=edit_inventori&id_inventori=<?php echo $row['id_inventori']; ?>"><button class="btn btn-warning">Kemaskini</button></a>
                            <button onclick="myFunction()" class="btn btn-info">Cetak</button>
                            <script>
                                function myFunction() {
                                    window.print();
                                }
                            </script>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
            </div>
        </div>
    </div>
</div>
