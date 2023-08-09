<?php
$sql = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
$list_ajk = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
?>
<?php
$sqll = "SELECT id_penyelenggara, nama_penyelenggara, kat_penyelenggara FROM penyelenggara WHERE id_masjid = $id_masjid GROUP BY nama_penyelenggara";
$list_penyelenggara = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
?>
<?php
$sqlll = "SELECT id_jenisinventori, jenis_inventori FROM sej6x_data_jenisinventori WHERE id_masjid = '$id_masjid'";
$list_peralatan = mysqli_query($bd2, $sqlll) or die(mysqli_error($bd2));
?>
<?php
if($_GET['action']=="inventori")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Inventori</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Fasiliti</a></li>
					<li class="active">Daftar Inventori</li>
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
					Maklumat Inventori
				</div>
				<div class="card-body">
					<form method="POST" action="admin/add_inventori.php" name="inventori">
					<div class="row">
						<div class="col-lg-6">
                            <!--Nama Peralatan-->
                            <div class="form-group">
                                <label>Nama Peralatan</label>
                                <input class="form-control" name="nama_peralatan" id="nama_peralatan" oninput="this.value = this.value.toUpperCase()" required>
                            </div>
                            <!-- kategori peralatan-->
                            <div class="form-group">
                                <label>Kategori Peralatan</label><br>
                                <select class="form-control" name="kat_peralatan" id="kat_peralatan"  required>
                                    <option value="">Sila Pilih Kategori</option>
                                    <?php
                                    while($row_list_peralatan = mysqli_fetch_assoc($list_peralatan))
                                    {
                                        ?>
                                        <option value="<?php echo($row_list_peralatan['id_jenisinventori']); ?>"><?php echo strtoupper($row_list_peralatan['jenis_inventori']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--Nama Pegawai-->
							<div class="form-group">
								<label>Nama Pegawai</label>
								<select class="form-control" name="nama_pegawai" id="nama_pegawai" required>
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
                            <!--Kuantiti & Unit Kuantiti-->
                            <div class="form-group">
                                <label>Kuantiti & Unit Kuantiti</label>
                                <br>
                                <input type="text" class="form-control" name="kuantiti_belian" id="kuantiti_belian" placeholder="Kuantiti" style="width:250px" required>
                                &nbsp;
                                <select class="form-control" name="kuantiti_unit" id="kuantiti_unit" style="width:225px" required>
                                    <option>Unit Kuantiti</option>
                                    <option value="Batang">Batang</option>
                                    <option value="Berkas">Berkas</option>
                                    <option value="Bidang">Bidang</option>
                                    <option value="Biji">Biji</option>
                                    <option value="Bilah">Bilah</option>
                                    <option value="Buah">Buah</option>
                                    <option value="Buku">Buku</option>
                                    <option value="Ekor">Ekor</option>
                                    <option value="Gelung">Gelung</option>
                                    <option value="Gulung">Gulung</option>
                                    <option value="Helai">Helai</option>
                                    <option value="Ikat">Ikat</option>
                                    <option value="Kampit">Kampit</option>
                                    <option value="Keping">Keping</option>
                                    <option value="Kotak">Kotak</option>
                                    <option value="Papan">Papan</option>
                                </select>
                            </div>
                            <!--Harga Belian & Per Unit-->
                            <div class="form-group">
                                <label>Harga Belian/Per Unit(RM)</label>
                                <input class="form-control" placeholder="Contoh: 30.00 " name="harga_belian" id="harga_belian">
                            </div>
                            <!--Lokasi-->
                            <div class="form-group">
                                <label>Lokasi Peralatan</label>
                                <input class="form-control" name="lokasi" id="lokasi" oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
						<!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <!--Kod Peralatan-->
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-6">
                                    <label>Jana Kod Peralatan Secara Automatik?</label>
                                    <div class="row">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="ya" name="customRadio" class="custom-control-input" value="1" required onClick="displayRujukan(this.value)">
                                            <label class="custom-control-label" for="ya">Ya</label>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="tidak" name="customRadio" class="custom-control-input" value="2" onClick="displayRujukan(this.value)">
                                            <label class="custom-control-label" for="tidak">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="display: none" id="rujukan_manual">
                                <div class="col-lg-12 col-md-6">
                                    <label>Kod Peralatan</label>
                                    <input class="form-control" id="kod_peralatan_manual" name="kod_peralatan_manual" type="text" oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="form-group row" style="display: none" id="rujukan_auto">
                                <div class="col-lg-12 col-md-6">
                                    <label>Kod Peralatan (Akan Dijana Automatik):</label>
                                    <input class="form-control" id="kod_peralatan_auto" name="kod_peralatan_auto" readonly>
                                </div>
                            </div>

<!--                            <div class="form-group">-->
<!--                                <label>Kod Peralatan</label>-->
<!--                                <input class="form-control" name="kod_peralatan" id="kod_peralatan">-->
<!--                                <small style="font-weight: bold">*Sila biarkan ruang ini kosong jika ingin kod peralatan dijana secara automatik.</small>-->
<!--                            </div>-->
                            <!--Tarikh Belian/Terima-->
                            <div class="form-group">
                                <label>Tarikh Belian/Terima</label>
                                <input class="form-control" name="tarikh_belian" id="tarikh_belian" type="date">
                            </div>
                            <!--Nama Penyelenggara-->
                            <div class="form-group" id="namaPenyelenggaraDiv">
                                <label>Nama Penyelenggara Yang Bertanggunjawab</label>
                                <select class="form-control" name="nama_penyelenggara" id="nama_penyelenggara" disabled>
<!--                                    <option value="">Sila Pilih</option>-->
<!--                                    --><?php
//                                    while($row_list_penyelenggara = mysqli_fetch_assoc($list_penyelenggara))
//                                    {
//                                        ?>
<!--                                        <option value="--><?php //echo($row_list_penyelenggara['id_penyelenggara']); ?><!--">--><?php //echo($row_list_penyelenggara['nama_penyelenggara']); ?><!-- - --><?php //echo strtoupper(($row_list_penyelenggara['kat_penyelenggara'])); ?><!-- </option>-->
<!--                                        --><?php
//                                    }
//                                    ?>
                                </select>
                            </div>
                            <!--Pembekal Peralatan-->
                            <div class="form-group">
                                <label>Pembekal Peralatan</label>
                                <select class="form-control" name="jenis_pembekal" id="jenis_pembekal" onchange="showForm()">
                                    <option value="">Sila Pilih</option>
                                    <option value="sewa">Sewa</option>
                                    <option value="belian">Belian</option>
                                    <option value="sumbangan">Sumbangan</option>
                                    <option value="wakaf">Wakaf</option>
                                </select>
                            </div>
                            <!--Bila select jenis pembekal peralatan akan display maklumat untuk isi detail setiap jenis-->
                            <!--SEWA -->
                            <div id="sewa-form" style="display: none" class="form-group">
                                <label>Nama Pembekal</label></br>
                                <input type="text" name="nama_sewa" id="nama_sewa" placeholder="Sila masukkan nama pembekal" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </br>
                                <label>No. Telefon Pembekal</label></br>
                                <input type="text" name="no_sewa" id="no_sewa" placeholder="Sila masukkan no. telefon pembekal" class="form-control">
                                </br>
                                <label>Jenis Sewaan</label></br>
                                <select class="form-control" name="jenis_sewaan" id="jenis_sewaan">
                                    <option value="">Sila Pilih</option>
                                    <option value="harian">Harian</option>
                                    <option value="mingguan">Mingguan</option>
                                    <option value="bulanan">Bulanan</option>
                                    <option value="tahunan">Tahunan</option>
                                </select>
                            </div>
                            <!--BELIAN-->
                            <div id="belian-form" style="display: none" class="form-group">
                                <label>Nama Pembekal</label></br>
                                <input type="text" name="nama_beli" id="nama_beli" placeholder="Sila masukkan nama pembekal" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </br>
                                <label>No. Telefon Pembekal</label></br>
                                <input type="text" name="no_beli" id="no_beli" placeholder="Sila masukkan no. telefon pembekal" class="form-control">
                            </div>
                            <!--SUMBANGAN-->
                            <div id="sumbangan-form" style="display: none" class="form-group">
                                <label>Nama Penyumbang</label></br>
                                <input type="text" name="nama_sumbang" id="nama_sumbang" placeholder="Sila masukkan nama penyumbang" class="form-control" oninput="this.value = this.value.toUpperCase()">
                            </div>
                            <!--WAKAF-->
                            <div id="wakaf-form" style="display: none" class="form-group">
                                <label>Wakaf</label></br>
                                <select class="form-control" name="kat_wakaf" id="kat_wakaf">
                                    <option value="">Sila Pilih</option>
                                    <option value="individu">Individu</option>
                                    <option value="awam">Orang Ramai / Awam</option>
                                </select>
                            </div>
                            <!--Catatan-->
                            </br>
							<div class="form-group">
								<label>Catatan</label>
								<textarea class="form-control" rows="2" name="catatan"></textarea>
							</div>
						</div>
						<div class="col-lg-12" align="center">
							<button type="submit" class="btn btn-success">Simpan</button>
 							<button type="reset" class="btn btn-danger">Set Semula</button>
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
<!--<script>-->
<!--    function toggleInput(selectBox) {-->
<!--        var otherInput = document.getElementById("otherInput");-->
<!---->
<!--        if (selectBox.value === "other") {-->
<!--            document.getElementById("inputContainer").style.display = "block";-->
<!--            otherInput.value = "";-->
<!--        } else {-->
<!--            document.getElementById("inputContainer").style.display = "none";-->
<!--        }-->
<!--    }-->
<!--</script>-->
<script>
    function showForm() {
        var selectBox = document.getElementById("jenis_pembekal");
        var selectedOption = selectBox.options[selectBox.selectedIndex].value;

        document.getElementById("sewa-form").style.display = "none";
        document.getElementById("belian-form").style.display = "none";
        document.getElementById("sumbangan-form").style.display = "none";
        document.getElementById("wakaf-form").style.display = "none";


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
<script>
    function displayRujukan(str){
        var jenis_rujukan = str;

        if(jenis_rujukan==1){
            document.getElementById('rujukan_auto').style.display = "block";
            document.getElementById('rujukan_manual').style.display = "none";

            document.getElementById('no_rujukan').required = false;
        }
        else if(jenis_rujukan==2){
            document.getElementById('rujukan_manual').style.display = "block";
            document.getElementById('rujukan_auto').style.display = "none";

            document.getElementById('no_rujukan').required = true;
        }
    }
    addTinyMCE();
</script>
<script>

    $(document).ready(function() {
        $('#kat_peralatan').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption !== '') {
                // Make an AJAX request to retrieve the options for the dynamic select box
                $.ajax({
                    url: './admin/ajax_daftarinventori.php',
                    type: 'POST',
                    data: { "option": selectedOption },
                    // contentType: "application/json;charset=utf-8",
                    // dataType: "json",
                    success: function(response) {
                        // Assuming the response is an array of options
                        console.log(response);
                        var options = JSON.parse(response);

                        // Clear the dynamic select box
                        $('#nama_penyelenggara').empty();

                        // Add the new options
                        // $('#kuantiti_unit').append('<option value=""></option>'); // Empty option

                        for (var i = 0; i < options.length; i++) {
                            var optionValue = options[i].value;
                            var optionLabel = options[i].value2;

                            var displayLabel = '';


                            $('#nama_penyelenggara').append('<option value="' + optionValue + '" selected>' + optionLabel + '</option>');
                        }

                        // Show the dynamic select box
                        $('#namaPenyelenggaraDiv').show();
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Handle the error appropriately
                    }
                });
            } else {
                // Hide the dynamic select box if no option is selected
                $('#namaPenyelenggaraDiv').hide();
            }
        });
    });
</script>


