
<?php
$sql = "SELECT id_inventori, kod_peralatan, nama_peralatan, jenis_peralatan FROM sej6x_data_inventori WHERE id_masjid = $id_masjid";
$list_kod = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
?>
<?php
$sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
$list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
?>
<?php
$sqlll = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
$list_ajk = mysqli_query($bd2, $sqlll) or die(mysqli_error($bd2));
?>
<?php
if($_GET['action']=="kerosakan")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Borang Kerosakan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
					<li class="active">Borang Kerosakan</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
				   Maklumat Kerosakan
				</div>
				<div class="card-body">
					<div class="panel-body">
						<form method="POST" action="admin/add_kerosakan.php" name="kerosakan" id="kerosakan">
						<div class="row">
							<div class="col-lg-6">
                            <!--KOD PERALATAN-->
                                <div class="form-group">
                                    <label>Maklumat Peralatan</label>
                                    <select class="form-control" name="id_peralatan" id="id_peralatan" required>
                                        <option value="">Sila Pilih Peralatan</option>
                                        <?php
                                        while($row_list_kod = mysqli_fetch_assoc($list_kod))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_kod['id_inventori']); ?>"><?php echo($row_list_kod['kod_peralatan']); ?> - <?php echo $row_list_kod['nama_peralatan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="kuantiti_unitDiv">
                                    <label>Kuantiti & Unit Kuantiti</label>
                                    <br>
                                    <input type="text" class="form-control" name="kuantiti" id="kuantiti" placeholder="Kuantiti" style="width:237px" required>
                                    &nbsp;
                                    <select class="form-control" name="kuantiti_unit" id="kuantiti_unit" style="width:237px" disabled>
<!--                                        <option>Unit Kuantiti</option>-->
<!--                                        <option value="Batang">Batang</option>-->
<!--                                        <option value="Berkas">Berkas</option>-->
<!--                                        <option value="Bidang">Bidang</option>-->
<!--                                        <option value="Biji">Biji</option>-->
<!--                                        <option value="Bilah">Bilah</option>-->
<!--                                        <option value="Buah">Buah</option>-->
<!--                                        <option value="Buku">Buku</option>-->
<!--                                        <option value="Ekor">Ekor</option>-->
<!--                                        <option value="Gelung">Gelung</option>-->
<!--                                        <option value="Gulung">Gulung</option>-->
<!--                                        <option value="Helai">Helai</option>-->
<!--                                        <option value="Ikat">Ikat</option>-->
<!--                                        <option value="Kampit">Kampit</option>-->
<!--                                        <option value="Keping">Keping</option>-->
<!--                                        <option value="Kotak">Kotak</option>-->
<!--                                        <option value="Papan">Papan</option>-->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Penyelenggara Yang Bertanggunjawab</label>
                                    <select class="form-control" name="id_penyelenggara" id="id_penyelenggara" disabled>
<!--                                        <option value="">Sila Pilih</option>-->
<!--                                        --><?php
//                                        while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
//                                        {
//                                            ?>
<!--                                            <option value="--><?php //echo($row_list_penyelenggara['id_penyelenggara']); ?><!--">--><?php //echo($row_list_penyelenggara['nama_penyelenggara']); ?><!-- - --><?php //echo strtoupper(($row_list_penyelenggara['kat_penyelenggara'])); ?><!-- </option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
                                    </select>
                                </div>
                            <!--TAHAP KEROSAKAN-->
                                <div class="form-group">
                                    <label>Tahap Kerosakan</label>
                                    <select class="form-control" name="tahap_kerosakan" id="tahap_kerosakan" required>
                                        <option>Sila Pilih Tahap Kerosakan</option>
                                        <option value="Segera">Perlu Perhatian Segera</option>
                                        <option value="Biasa">Kerosakan Biasa</option>
                                    </select>
                                </div>
							</div>
							<div class="col-lg-6">
                                <!--TARIKH KEROSAKAN & MASA-->
                                <div class="form-group">
                                    <label>Tarikh & Masa Kerosakan</label>
                                    <br>
                                    <input class="form-control" type="date" name="tarikh_kerosakan" style="width:237px" required>
                                    &nbsp;
                                    <input class="form-control" type="time" name="masa_kerosakan" style="width:237px" required>
                                </div>
                                <!--LOKASI PERALATAN-->
                                <div class="form-group">
                                    <label>Lokasi Peralatan</label>
                                    <input class="form-control" name="lokasi_kerosakan" id="lokasi_kerosakan" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                                <!--PENGESAHAN KEROSAKAN-->
                                <div class="form-group">
                                    <label>Pengesahan Kerosakan Oleh</label>
                                    <select class="form-control" name="id_pengesah" id="id_pengesah" required>
                                        <option value="">Sila Pilih Pegawai</option>
                                        <?php
                                        while($row_list_ajk = mysqli_fetch_assoc($list_ajk))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_ajk['id_dataajk']); ?>"><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--CATATAN-->
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea class="form-control" rows="2" name="catatan"></textarea>
                                </div>
							</div>
							<div class="col-lg-12" align="center">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-danger">Set Semula</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>

    $(document).ready(function() {
        $('#id_peralatan').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption !== '') {
                // Make an AJAX request to retrieve the options for the dynamic select box
                $.ajax({
                    url: './admin/ajax_daftarkerosakan.php',
                    type: 'POST',
                    data: { "option": selectedOption },
                    // contentType: "application/json;charset=utf-8",
                    // dataType: "json",
                    success: function(response) {
                        // Assuming the response is an array of options
                        console.log(response);
                        var options = JSON.parse(response);

                        // Clear the dynamic select box
                        $('#kuantiti_unit').empty();

                        // Add the new options
                        // $('#kuantiti_unit').append('<option value=""></option>'); // Empty option

                        for (var i = 0; i < options.length; i++) {
                            var optionValue = options[i].value;
                            var optionValue2 = options[i].value2;
                            var optionValue3 = options[i].value3;

                            var displayLabel = '';


                            $('#kuantiti_unit').append('<option value="' + optionValue + '" selected>' + optionValue + '</option>');

                            $('#id_penyelenggara').append('<option value="' + optionValue2 + '" selected>' + optionValue3 + '</option>');
                        }

                        // Show the dynamic select box
                        $('#kuantiti_unitDiv').show();
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Handle the error appropriately
                    }
                });
            } else {
                // Hide the dynamic select box if no option is selected
                $('#kuantiti_unitDiv').hide();
            }
        });
    });
</script>







