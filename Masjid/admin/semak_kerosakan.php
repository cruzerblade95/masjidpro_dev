<?php 

	include("connection/connection.php"); 

	$idd = $_GET['id_kerosakan'];
	
	//sql view selenggara
	$sql_search="SELECT id_kerosakan, CAST(date_added AS DATE) as tarikh_lapor, CAST(date_added AS TIME) as masa_lapor, 
                 tarikh_kerosakan, masa_kerosakan, id_peralatan, id_penyelenggara, kuantiti, kuantiti_unit, lokasi_kerosakan,
                 id_pengesah, id_statuskerosakan, catatan FROM sej6x_data_kerosakkan WHERE id_kerosakan='".$idd."' ";
	$result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error());
    $row = mysqli_fetch_assoc($result);
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Maklumat Kerosakan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=maklumatkerosakan">Laporan Kerosakan</a></li>
					<li class="active">Maklumat Kerosakan</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Maklumat Kerosakan</div>
                <div class="card-body">
                    <form method="POST" action="admin/update_kerosakkan.php" name="kerosakan">
                        <div class="row">
                            <div class="col-lg-6">
                                <!--TARIKH LAPOR & MASA-->
                                <div class="form-group">
                                    <label>Tarikh & Masa Laporan</label>
                                    <br>
                                    <input class="form-control" type="date" name="tarikh_kerosakan" style="width:237px" value="<?php echo $row['tarikh_lapor'];?>">
                                    &nbsp;
                                    <input class="form-control" type="time" name="masa_kerosakan" style="width:237px" value="<?php echo $row['masa_lapor'];?>">
                                </div>
                                <!--KOD PERALATAN-->
                                <div class="form-group">
                                    <label>Kod Peralatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Peralatan</label>
                                    <br>
                                    <select class="form-control" name="id_peralatan" id="id_peralatan" style="width:237px">
                                        <option value="">Sila Pilih Peralatan</option>
                                        <?php
                                        $sql = "SELECT id_inventori, kod_peralatan, nama_peralatan, jenis_peralatan FROM sej6x_data_inventori WHERE id_masjid = $id_masjid";
                                        $list_kod = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
                                        ?>
                                        <?php
                                        $id_peralatan = $row['id_peralatan'];
                                        while($row_list_kod = mysqli_fetch_assoc($list_kod))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_kod['id_inventori']); ?>" <?php if($id_peralatan==$row_list_kod['id_inventori']) { echo "selected"; } ?>><?php echo($row_list_kod['kod_peralatan']); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    &nbsp;
                                    <select class="form-control" name="nama_peralatan" id="nama_peralatan" style="width:237px">
                                        <option value="">Sila Pilih Peralatan</option>
                                        <?php
                                        $sql = "SELECT id_inventori, kod_peralatan, nama_peralatan, jenis_peralatan FROM sej6x_data_inventori WHERE id_masjid = $id_masjid";
                                        $list_kod = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
                                        ?>
                                        <?php
                                        $id_peralatan = $row['id_peralatan'];
                                        while($row_list_kod = mysqli_fetch_assoc($list_kod))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_kod['id_inventori']); ?>" <?php if($id_peralatan==$row_list_kod['id_inventori']) { echo "selected"; } ?>><?php echo $row_list_kod['nama_peralatan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--NAMA PERALATAN (DISPLAY)-->
<!--                                <div class="form-group">-->
<!--                                    <label>Nama Peralatan</label>-->
<!--                                    <select class="form-control" name="nama_peralatan" id="nama_peralatan" readonly >-->
<!--                                        <option value="">Sila Pilih Peralatan</option>-->
<!--                                        --><?php
//                                        $sql = "SELECT id_inventori, kod_peralatan, nama_peralatan, jenis_peralatan FROM sej6x_data_inventori WHERE id_masjid = $id_masjid";
//                                        $list_kod = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
//                                        ?>
<!--                                        --><?php
//                                        $id_peralatan = $row['id_peralatan'];
//                                        while($row_list_kod = mysqli_fetch_assoc($list_kod))
//                                        {
//                                            ?>
<!--                                            <option value="--><?php //echo($row_list_kod['id_inventori']); ?><!--" --><?php //if($id_peralatan==$row_list_kod['id_inventori']) { echo "selected"; } ?><!--><?php //echo $row_list_kod['nama_peralatan']; ?><!--</option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>-->
                                <!--KATEGORI PERALATAN (DISPLAY)-->
                                <div class="form-group">
                                    <label>Kategori Peralatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kategori Penyelenggara</label>
                                    <br>
                                    <select class="form-control" name="kat_peralatan" id="kat_peralatan" style="width:237px">
                                        <option value="">Sila Pilih Peralatan</option>
                                        <?php
                                        $sql = "SELECT a.id_inventori, a.kod_peralatan, a.nama_peralatan, b.jenis_inventori FROM sej6x_data_inventori a LEFT JOIN sej6x_data_jenisinventori b ON a.jenis_peralatan = b.id_jenisinventori WHERE a.id_masjid = $id_masjid";
                                        $list_kod = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
                                        ?>
                                        <?php
                                        $id_peralatan = $row['id_peralatan'];
                                        while($row_list_kod = mysqli_fetch_assoc($list_kod))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_kod['id_inventori']); ?>" <?php if($id_peralatan==$row_list_kod['id_inventori']) { echo "selected"; } ?>><?php echo $row_list_kod['jenis_inventori']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    &nbsp;
                                    <select class="form-control" name="kat_penyelenggara" id="kat_penyelenggara" style="width:237px">
                                        <option value="">Sila Pilih</option>
                                        <?php
                                        $sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
                                        $list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
                                        ?>
                                        <?php
                                        $id_penyelenggara = $row['id_penyelenggara'];
                                        while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_penyelenggara['id_penyelenggara']); ?>" <?php if($id_penyelenggara==$row_list_penyelenggara['id_penyelenggara']) { echo "selected"; } ?>><?php echo strtoupper(($row_list_penyelenggara['kat_penyelenggara'])); ?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--Nama Penyelenggara-->
                                <div class="form-group">
                                    <label>Nama Penyelenggara&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kategori Penyelenggara</label>
                                    <br>
                                    <select class="form-control" name="id_penyelenggara" id="id_penyelenggara" style="width:237px">
                                        <option value="">Sila Pilih</option>
                                        <?php
                                        $sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
                                        $list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
                                        ?>
                                        <?php
                                        $id_penyelenggara = $row['id_penyelenggara'];
                                        while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_penyelenggara['id_penyelenggara']); ?>" <?php if($id_penyelenggara==$row_list_penyelenggara['id_penyelenggara']) { echo "selected"; } ?>><?php echo($row_list_penyelenggara['nama_penyelenggara']); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    &nbsp;
                                    <select class="form-control" name="kat_penyelenggara" id="kat_penyelenggara" style="width:237px">
                                        <option value="">Sila Pilih</option>
                                        <?php
                                        $sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara, no_telefon FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
                                        $list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
                                        ?>
                                        <?php
                                        $id_penyelenggara = $row['id_penyelenggara'];
                                        while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_penyelenggara['id_penyelenggara']); ?>" <?php if($id_penyelenggara==$row_list_penyelenggara['id_penyelenggara']) { echo "selected"; } ?>><?php echo $row_list_penyelenggara['no_telefon']; ?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--Kategori Penyelenggara-->
<!--                                <div class="form-group">-->
<!--                                    <label>Kategori Penyelenggara</label>-->
<!--                                    <select class="form-control" name="kat_penyelenggara" id="kat_penyelenggara" readonly>-->
<!--                                        <option value="">Sila Pilih</option>-->
<!--                                        --><?php
//                                        $sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
//                                        $list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
//                                        ?>
<!--                                        --><?php
//                                        $id_penyelenggara = $row['id_penyelenggara'];
//                                        while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
//                                        {
//                                            ?>
<!--                                            <option value="--><?php //echo($row_list_penyelenggara['id_penyelenggara']); ?><!--" --><?php //if($id_penyelenggara==$row_list_penyelenggara['id_penyelenggara']) { echo "selected"; } ?><!--><?php //echo strtoupper(($row_list_penyelenggara['kat_penyelenggara'])); ?><!-- </option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>-->
                                <!--NOTEL Penyelenggara-->
<!--                                <div class="form-group">-->
<!--                                    <label>No. Telefon Penyelenggara</label>-->
<!--                                    <select class="form-control" name="kat_penyelenggara" id="kat_penyelenggara" readonly>-->
<!--                                        <option value="">Sila Pilih</option>-->
<!--                                        --><?php
//                                        $sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara, no_telefon FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
//                                        $list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
//                                        ?>
<!--                                        --><?php
//                                        $id_penyelenggara = $row['id_penyelenggara'];
//                                        while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
//                                        {
//                                            ?>
<!--                                            <option value="--><?php //echo($row_list_penyelenggara['id_penyelenggara']); ?><!--" --><?php //if($id_penyelenggara==$row_list_penyelenggara['id_penyelenggara']) { echo "selected"; } ?><!--><?php //echo $row_list_penyelenggara['no_telefon']; ?><!-- </option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>-->
                                <!--STATUS PERALATAN-->
                                <div class="form-group">
                                    <label>Status </label>
                                    <select class="form-control" name="id_statuskerosakan" id="id_statuskerosakan">
                                        <option>Sila Pilih Status Semasa</option>
                                        <?php
                                        $sqllq = "SELECT id_status, status_kerosakan FROM sej6x_data_statuskerosakan";
                                        $list_status = mysqli_query($bd2, $sqllq) or die(mysqli_error($bd2));
                                        ?>
                                        <?php
                                        $id_status = $row['id_statuskerosakan'];
                                        while($row_list_status = mysqli_fetch_assoc($list_status))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_status['id_status']); ?>" <?php if($id_status==$row_list_status['id_status']) { echo "selected"; } ?>><?php echo $row_list_status['status_kerosakan']; ?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!--TARIKH KEROSAKAN & MASA-->
                                <div class="form-group">
                                    <label>Tarikh & Masa Kerosakan</label>
                                    <br>
                                    <input class="form-control" type="date" name="tarikh_kerosakan" style="width:237px" value="<?php echo $row['tarikh_kerosakan'];?>">
                                    &nbsp;
                                    <input class="form-control" type="time" name="masa_kerosakan" style="width:237px" value="<?php echo $row['masa_kerosakan'];?>">
                                </div>
                                <!--LOKASI PERALATAN-->
                                <div class="form-group">
                                    <label>Lokasi Peralatan</label>
                                    <input class="form-control" name="lokasi_kerosakan" id="lokasi_kerosakan" oninput="this.value = this.value.toUpperCase()" value="<?php echo $row['lokasi_kerosakan'];?>">
                                </div>
                                <!--KUANTITI & UNIT KUANTITI-->
                                <div class="form-group">
                                    <label>Kuantiti & Unit Kuantiti</label>
                                    <br>
                                    <input type="text" class="form-control" name="kuantiti" id="kuantiti" placeholder="Kuantiti" style="width:237px" value="<?php echo $row['kuantiti']; ?>">
                                    &nbsp;
                                    <select class="form-control" name="kuantiti_unit" id="kuantiti_unit" style="width:237px" >
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
                                <!--PENGESAHAN KEROSAKAN-->
                                <div class="form-group">
                                    <label>Pengesahan Kerosakan Oleh</label>
                                    <select class="form-control" name="id_pengesah" id="id_pengesah" required>
                                        <option value="">Sila Pilih Pegawai</option>
                                        <?php
                                        $sqlll = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
                                        $list_ajk = mysqli_query($bd2, $sqlll) or die(mysqli_error($bd2));
                                        ?>
                                        <?php
                                        $id_pengesah = $row['id_pengesah'];
                                        while($row_list_ajk = mysqli_fetch_assoc($list_ajk))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_ajk['id_dataajk']); ?>" <?php if($id_pengesah==$row_list_ajk['id_dataajk']) { echo "selected"; } ?>><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--CATATAN-->
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea class="form-control" rows="2" name="catatan"><?php echo $row['catatan'];?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12" align="center">
                                <input type="hidden" value="<?php echo $row['id_kerosakan']; ?>" name="id_kerosakan">
                                <button type="submit" class="btn btn-primary">Kemaskini</button>
                                <button onclick="myFunction()" class="btn btn-info">Cetak</button>
                                <script>
                                    function myFunction() {
                                        window.print();
                                    }
                                </script>
                            </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>