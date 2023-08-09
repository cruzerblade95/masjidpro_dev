<?php

$idd = $_GET['id_inventori'];
$sql = "SELECT a.id_inventori, a.id_masjid, a.nama_peralatan, a.kod_peralatan, a.jenis_peralatan, a.tarikh_belian, a.id_pegawai, a.id_penyelenggara,
        a.kuantiti_belian, a.kuantiti_unit, a.harga_belian, a.lokasi, a.id_pembekal, a.catatan, b.id_pembekal, b.jenis_pembekal, b.nama_sewa, b.no_sewa, b.jenis_sewaan, b.nama_beli, b.no_beli, b.nama_sumbang, b.kat_wakaf
        FROM sej6x_data_inventori a 
        LEFT JOIN sej6x_data_pembekal b on a.id_pembekal = b.id_pembekal
        WHERE a.id_masjid = $id_masjid AND a.id_inventori = $idd";
$result = mysqli_query($bd2, $sql) or die ("Error :".mysqli_error($bd2));
$row = mysqli_fetch_assoc($result);

?>
<?php
$sql = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
$list_ajk = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
?>
<?php
$sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
$list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
?>
<?php
$sqlll = "SELECT id_jenisinventori, jenis_inventori FROM sej6x_data_jenisinventori WHERE id_masjid = '0' OR id_masjid='$id_masjid'";
$list_peralatan = mysqli_query($bd2, $sqlll) or die(mysqli_error($bd2));
?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kemaskini Inventori</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
                    <li class="active">Kemaskini Inventori</li>
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
                    Kemaskini Inventori
                </div>
                <div class="card-body">
                    <form method="POST" action="admin/update_inventori.php" name="inventori">
                        <div class="row">
                            <div class="col-lg-6">
                                <!--Nama Peralatan-->
                                <div class="form-group">
                                    <label>Nama Peralatan</label>
                                    <input class="form-control" name="nama_peralatan" id="nama_peralatan" oninput="this.value = this.value.toUpperCase()" required value="<?php echo $row['nama_peralatan']; ?>">
                                </div>
                                <!--Jenis Peralatan-->
                                <div class="form-group">
                                    <label>Kategori Peralatan</label>
                                    <select class="form-control" name="jenis_peralatan" id="jenis_peralatan" onchange="toggleInput(this)" required>
                                        <option value="">Sila Pilih Kategori Peralatan</option>
                                        <?php
                                        $jenis_peralatan=$row['jenis_peralatan'];
                                        while($row_list_peralatan = mysqli_fetch_assoc($list_peralatan))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_peralatan['id_jenisinventori']); ?>" <?php if($jenis_peralatan==$row_list_peralatan['id_jenisinventori']) { echo "selected"; } ?>><?php echo($row_list_peralatan['jenis_inventori']); ?></option>
                                            <?php
                                        }
                                        ?>
                                        <option value="other">Lain-Lain</option>
                                    </select>
                                </div>
                                <!--Bila select Lain-lain keluar div -->
                                <div id="inputContainer" class="form-group" style="display: none">
                                    <label for="otherInput">Sila masukkan kategori</label></br>
                                    <input type="text" class="form-control" name="otherInput" id="otherInput" oninput="this.value = this.value.toUpperCase()" >
                                </div>
                                <!--Nama Pegawai-->
                                <div class="form-group">
                                    <label>Nama Pegawai</label>
                                    <select class="form-control" name="nama_pegawai" id="nama_pegawai" required>
                                        <option value="">Sila Pilih Pegawai</option>
                                        <?php
                                        $nama_pegawai=$row['id_pegawai'];
                                        while($row_list_ajk = mysqli_fetch_assoc($list_ajk))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_ajk['id_dataajk']); ?>" <?php if($nama_pegawai==$row_list_ajk['id_dataajk']) { echo "selected"; } ?>><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--Kuantiti & Unit Kuantiti-->
                                <div class="form-group">
                                    <label>Kuantiti & Unit Kuantiti</label>
                                    <br>
                                    <input type="text" class="form-control" name="kuantiti_belian" id="kuantiti_belian" placeholder="Kuantiti" style="width:250px" required value="<?php echo $row['kuantiti_belian']; ?>">
                                    &nbsp;
                                    <select class="form-control" name="kuantiti_unit" id="kuantiti_unit" style="width:225px" required>
                                        <option>Unit Kuantiti</option>
                                        <option value="Batang" <?php if($row['kuantiti_unit']=='Batang') { echo "selected"; } ?>>Batang</option>
                                        <option value="Berkas" <?php if($row['kuantiti_unit']=='Berkas') { echo "selected"; } ?>>Berkas</option>
                                        <option value="Bidang" <?php if($row['kuantiti_unit']=='Bidang') { echo "selected"; } ?>>Bidang</option>
                                        <option value="Biji" <?php if($row['kuantiti_unit']=='Biji') { echo "selected"; } ?>>Biji</option>
                                        <option value="Bilah" <?php if($row['kuantiti_unit']=='Bilah') { echo "selected"; } ?>>Bilah</option>
                                        <option value="Buah" <?php if($row['kuantiti_unit']=='Buah') { echo "selected"; } ?>>Buah</option>
                                        <option value="Buku" <?php if($row['kuantiti_unit']=='Buku') { echo "selected"; } ?>>Buku</option>
                                        <option value="Ekor" <?php if($row['kuantiti_unit']=='Ekor') { echo "selected"; } ?>>Ekor</option>
                                        <option value="Gelung" <?php if($row['kuantiti_unit']=='Gelung') { echo "selected"; } ?>>Gelung</option>
                                        <option value="Gulung" <?php if($row['kuantiti_unit']=='Gulung') { echo "selected"; } ?>>Gulung</option>
                                        <option value="Helai" <?php if($row['kuantiti_unit']=='Helai') { echo "selected"; } ?>>Helai</option>
                                        <option value="Ikat" <?php if($row['kuantiti_unit']=='Ikat') { echo "selected"; } ?>>Ikat</option>
                                        <option value="Kampit" <?php if($row['kuantiti_unit']=='Kampit') { echo "selected"; } ?>>Kampit</option>
                                        <option value="Keping" <?php if($row['kuantiti_unit']=='Keping') { echo "selected"; } ?>>Keping</option>
                                        <option value="Kotak" <?php if($row['kuantiti_unit']=='Kotak') { echo "selected"; } ?>>Kotak</option>
                                        <option value="Papan" <?php if($row['kuantiti_unit']=='Papan') { echo "selected"; } ?>>Papan</option>
                                    </select>
                                </div>
                                <!--Harga Belian & Per Unit-->
                                <div class="form-group">
                                    <label>Harga Belian/Per Unit(RM)</label>
                                    <input class="form-control" placeholder="Contoh: 30.00 " name="harga_belian" id="harga_belian" value="<?php echo $row['harga_belian']; ?>">
                                </div>
                                <!--Lokasi-->
                                <div class="form-group">
                                    <label>Lokasi Peralatan</label>
                                    <input class="form-control" name="lokasi" id="lokasi" oninput="this.value = this.value.toUpperCase()" value="<?php echo $row['lokasi']; ?>">
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <!--Kod Peralatan-->
                                <div class="form-group">
                                    <label>Kod Peralatan</label>
                                    <input class="form-control" name="kod_peralatan" id="kod_peralatan" value="<?php echo $row['kod_peralatan']; ?>">
                                </div>
                                <!--Tarikh Belian/Terima-->
                                <div class="form-group">
                                    <label>Tarikh Belian/Terima</label>
                                    <input class="form-control" name="tarikh_belian" id="tarikh_belian" type="date" value="<?php echo $row['tarikh_belian']; ?>">
                                </div>
                                <!--Nama Penyelenggara-->
                                <div class="form-group">
                                    <label>Nama Penyelenggara Yang Bertanggunjawab</label>
                                    <select class="form-control" name="nama_penyelenggara" id="nama_penyelenggara" required>
                                        <option value="">Sila Pilih</option>
                                        <?php
                                        $nama_penyelenggara=$row['id_penyelenggara'];
                                        while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_penyelenggara['id_penyelenggara']); ?>" <?php if($nama_penyelenggara==$row_list_penyelenggara['id_penyelenggara']) { echo "selected"; } ?>><?php echo($row_list_penyelenggara['nama_penyelenggara']); ?> - <?php echo strtoupper(($row_list_penyelenggara['kat_penyelenggara'])); ?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--Pembekal Peralatan-->
                                <div class="form-group">
                                    <label>Pembekal Peralatan</label>
                                    <select class="form-control" name="jenis_pembekal" id="jenis_pembekal" onchange="showForm()">
                                        <option value="">Sila Pilih</option>
                                        <option value="sewa" <?php if($row['jenis_pembekal']=='sewa') { echo "selected"; } ?>>Sewa</option>
                                        <option value="belian" <?php if($row['jenis_pembekal']=='belian') { echo "selected"; } ?>>Belian</option>
                                        <option value="sumbangan" <?php if($row['jenis_pembekal']=='sumbangan') { echo "selected"; } ?>>Sumbangan</option>
                                        <option value="wakaf" <?php if($row['jenis_pembekal']=='wakaf') { echo "selected"; } ?>>Wakaf</option>
                                    </select>
                                </div>
                                <!--Bila select jenis pembekal peralatan akan display maklumat untuk isi detail setiap jenis-->
                                <!--SEWA -->
                                <div id="sewa-form" style="display: none" class="form-group">
                                    <label>Nama Pembekal</label></br>
                                    <input type="text" name="nama_sewa" id="nama_sewa" placeholder="Sila masukkan nama pembekal" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $row['nama_sewa']; ?>">
                                    </br>
                                    <label>No. Telefon Pembekal</label></br>
                                    <input type="text" name="no_sewa" id="no_sewa" placeholder="Sila masukkan no. telefon pembekal" class="form-control" value="<?php echo $row['no_sewa']; ?>">
                                    </br>
                                    <label>Jenis Sewaan</label></br>
                                    <select class="form-control" name="jenis_sewaan" id="jenis_sewaan">
                                        <option value="">Sila Pilih</option>
                                        <option value="harian" <?php if($row['jenis_sewaan']=='harian') { echo "selected"; } ?>>Harian</option>
                                        <option value="mingguan" <?php if($row['jenis_sewaan']=='mingguan') { echo "selected"; } ?>>Mingguan</option>
                                        <option value="bulanan" <?php if($row['jenis_sewaan']=='bulanan') { echo "selected"; } ?>>Bulanan</option>
                                        <option value="tahunan" <?php if($row['jenis_sewaan']=='tahunan') { echo "selected"; } ?>>Tahunan</option>
                                    </select>
                                </div>
                                <!--BELIAN-->
                                <div id="belian-form" style="display: none" class="form-group">
                                    <label>Nama Pembekal</label></br>
                                    <input type="text" name="nama_beli" id="nama_beli" placeholder="Sila masukkan nama pembekal" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $row['nama_beli']; ?>">
                                    </br>
                                    <label>No. Telefon Pembekal</label></br>
                                    <input type="text" name="no_beli" id="no_beli" placeholder="Sila masukkan no. telefon pembekal" class="form-control" value="<?php echo $row['no_beli']; ?>">
                                </div>
                                <!--SUMBANGAN-->
                                <div id="sumbangan-form" style="display: none" class="form-group">
                                    <label>Nama Penyumbang</label></br>
                                    <input type="text" name="nama_sumbang" id="nama_sumbang" placeholder="Sila masukkan nama penyumbang" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $row['nama_sumbang']; ?>">
                                </div>
                                <!--WAKAF-->
                                <div id="wakaf-form" style="display: none" class="form-group">
                                    <label>Wakaf</label></br>
                                    <select class="form-control" name="kat_wakaf" id="kat_wakaf">
                                        <option value="">Sila Pilih</option>
                                        <option value="individu" <?php if($row['kat_wakaf']=='individu') { echo "selected"; } ?>>Individu</option>
                                        <option value="awam" <?php if($row['kat_wakaf']=='awam') { echo "selected"; } ?>>Orang Ramai / Awam</option>
                                    </select>
                                </div>
                                <!--Catatan-->
                                </br>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea class="form-control" rows="2" name="catatan"><?php echo $row['catatan']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12" align="center">
                                <div class="form-group">
                                    <input type="hidden" value="<?php echo $row['id_pembekal']; ?>" name="id_pembekal">
                                    <input type="hidden" value="<?php echo $id_masjid; ?>" name="id_masjid">
                                    <input type="hidden" value="<?php echo $row['id_inventori']; ?>" name="id_inventori">
                                    <input type="submit" value="Kemaskini" class="btn btn-success">
                                </div>
                            </
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleInput(selectBox) {
        var otherInput = document.getElementById("otherInput");

        if (selectBox.value === "other") {
            document.getElementById("inputContainer").style.display = "block";
            otherInput.value = "";
        } else {
            document.getElementById("inputContainer").style.display = "none";
        }
    }
</script>
<script>
    var selectBox = document.getElementById("jenis_pembekal");
    var selectedOption = selectBox.value;
    console.log(selectedOption);

    viewForm(selectedOption);

    function showForm() {
        var selectBox = document.getElementById("jenis_pembekal");
        var selectedOption = selectBox.options[selectBox.selectedIndex].value;

        document.getElementById("sewa-form").style.display = "none";
        document.getElementById("belian-form").style.display = "none";
        document.getElementById("sumbangan-form").style.display = "none";
        document.getElementById("wakaf-form").style.display = "none";

        viewForm(selectedOption);

    }

    function viewForm(selectedOption){
        if (selectedOption === "sewa") {
            document.getElementById("sewa-form").style.display = "block";
        } else if (selectedOption === "belian") {
            document.getElementById("belian-form").style.display = "block";
        } else if (selectedOption === "sumbangan") {
            document.getElementById("sumbangan-form").style.display = "block";
        } else if (selectedOption === "wakaf") {
            document.getElementById("wakaf-form").style.display = "block";
        }
    }
</script>




