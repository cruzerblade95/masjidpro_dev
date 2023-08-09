<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Maklumat Anak Yatim & Piatu</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li class="active">Senarai Anak Yatim & Piatu</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php


include("connection/connection.php");

$idd = $_GET['id_data'];

$sql_search = "SELECT b.id_data,c.nama_penuh as nama_anakqariah,c.no_ic as ic_anakqariah,b.nama_penuh as NamaQariah,b.no_ic,
                            b.umur as umurQariah,b.alamat_terkini as alamat_qariah,c.tarikh_lahir as tlahir_anak,b.no_hp,c.no_tel as noTelefon_anak,
                            b.poskod,b.pendapatan,b.pekerjaan,b.majikan,b.id_negeri,b.id_daerah,b.tahap_pendidikan,
                            b.status_perkahwinan,b.bangsa,b.jantina,b.warganegara,b.tempoh_tinggal,b.zon_qariah,c.hubungan,c.status_oku,
							c.status_kahwin,c.status_sakitkronik,c.status_asnaf,a.id_anakqariah
						    FROM sej6x_data_anakyatim a inner join sej6x_data_peribadi b on a.id_qariah=b.id_data
                            inner join sej6x_data_anakqariah c on a.id_anakqariah=c.ID
						    WHERE a.id_anakqariah='$idd'";


$r = mysql_query("$sql_search", $bd);
if ($r) {
	while ($row = mysql_fetch_array($r)) {
		$id_data = $row['id_data'];

		//untuk sql negeri
		$sql_negeri = "SELECT id_negeri,name FROM negeri";
		$result1 = mysql_query($sql_negeri) or die("Error :" . mysql_error());

		//untuk sql daerah
		$sql_daerah = "SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='" . $row['id_negeri'] . "'";
		$result2 = mysql_query($sql_daerah) or die("Error :" . mysql_error());

		//untuk sql zon kariah 
		$sql_zonkariah = "SELECT id_zonqariah,id_masjid,nama_zon,no_huruf FROM sej6x_data_zonqariah";
		$sql_zon = mysql_query($sql_zonkariah) or die("Error :" . mysql_error());

?>
		<div class="content mt-3">
			<div class="row">
				<div class="col-lg-12">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Maklumat Anak Yatim / Piatu
							</div>

							<div class="panel-body">

								<form method="post" id="anak yatim" action="admin/kemaskini_anakyatim.php">


									<div class="row">


										<div class="col-lg-4 border">

											<div class="form-group">
												<label>Nama Penuh Anak/tanggung jawab Qariah</label> <input type="text" id="nama_penuh_anak" name="nama_penuh_anak" class="form-control" value="<?php echo $row['nama_anakqariah']; ?>">
											</div>

											<div class="form-group">
												<label>No. K/P Anak Qariah</label> <input type="text" name="no_ic_anak" id="no_ic_anak" class="form-control" value="<?php echo $row['ic_anakqariah']; ?>">
											</div>

											<div class="form-group">
												<label>Hubungan</label> <input type="text" name="hubungan" id="hubungan" class="form-control" value="<?php echo $row['hubungan']; ?>">
											</div>

											<div class="form-group">
												<label>No Telefon</label> <input type="text" name="no_hp_anak" id="no_hp_anak" class="form-control" value="<?php echo $row['noTelefon_anak']; ?>">
											</div>
											<div class="form-group">
												<label>Tarikh Lahir</label> <input type="date" name="tarikh_lahir" class="form-control" value="<?php echo $row['tlahir_anak']; ?>" readonly>
											</div>
											<div class="form-group">
												<label>Status Perkahwinan</label> <select class="form-control" name="statuskahwin_anak" id="statuskahwin_anak">
													<option value="0">Sila Pilih</option>
													<option value="1" <?php
																		if ($row["status_kahwin"] == '1') {
																			echo "selected";
																		}
																		?>>Bujang</option>
													<option value="2" <?php
																		if ($row["status_kahwin"] == '2') {
																			echo "selected";
																		}
																		?>>Berkahwin</option>
													<option value="3" <?php
																		if ($row["status_kahwin"] == '3') {
																			echo "selected";
																		}
																		?>>Duda</option>
													<option value="4" <?php
																		if ($row["status_kahwin"] == '4') {
																			echo "selected";
																		}
																		?>>Janda</option>
													<option value="5" <?php
																		if ($row["status_kahwin"] == '5') {
																			echo "selected";
																		}
																		?>>Ibu Tunggal</option>
												</select>
											</div>

											<div class="form-group">
												<label>Status OKU</label> <select class="form-control" name="status_oku" id="status_oku">
													<option value="0">Sila Pilih</option>
													<option value="Y" <?php
																		if ($row["status_oku"] == 'Y') {
																			echo "selected";
																		}
																		?>>Ya</option>
													<option value="N" <?php
																		if ($row["status_oku"] == 'N') {
																			echo "selected";
																		}
																		?>>Tidak</option>
												</select>
											</div>
											<div class="form-group">
												<label>Status Asnaf</label> <select class="form-control" name="status_asnaf" id="status_asnaf">
													<option value="0">Sila Pilih</option>
													<option value="Y" <?php
																		if ($row["status_asnaf"] == 'Y') {
																			echo "selected";
																		}
																		?>>Ya</option>
													<option value="N" <?php
																		if ($row["status_asnaf"] == 'N') {
																			echo "selected";
																		}
																		?>>Tidak</option>
												</select>
											</div>
											<div class="form-group">
												<label>Status Sakit Kronik</label> <select class="form-control" name="status_sakitkronik" id="status_sakitkronik">
													<option value="0">Sila Pilih</option>
													<option value="Y" <?php
																		if ($row["status_sakitkronik"] == 'Y') {
																			echo "selected";
																		}
																		?>>Ya</option>
													<option value="N" <?php
																		if ($row["status_sakitkronik"] == 'N') {
																			echo "selected";
																		}
																		?>>Tidak</option>
												</select>
											</div>

										</div>
										<!-- /.col-lg-4 (nested) -->



										<div class="col-lg-4 border">
											<div class="form-group">
												<label>Nama Penuh Qariah</label> <input type="text" name="nama_qariah" class="form-control" value="<?php echo $row['NamaQariah']; ?>" readonly>
											</div>
											<div class="form-group">
												<label>No KP Qariah</label> <input type="text" name="nokp_qariah" class="form-control" value="<?php echo $row['no_ic']; ?>" readonly>
											</div>

											<div class="form-group">
												<label>Status Perkahwinan</label> <select class="form-control" name="status_perkahwinan" id="status_perkahwinan" readonly>
													<option value=>Sila Pilih</option>
													<option value="1" <?php
																		if ($row["status_perkahwinan"] == '1') {
																			echo "selected";
																		}
																		?>>Bujang</option>
													<option value="2" <?php
																		if ($row["status_perkahwinan"] == '2') {
																			echo "selected";
																		}
																		?>>Berkahwin</option>
													<option value="3" <?php
																		if ($row["status_perkahwinan"] == '3') {
																			echo "selected";
																		}
																		?>>Duda</option>
													<option value="4" <?php
																		if ($row["status_perkahwinan"] == '4') {
																			echo "selected";
																		}
																		?>>Janda</option>
												</select>
											</div>

											<div class="form-group">
												<label>Pekerjaan</label> <input class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo $row['pekerjaan']; ?>" readonly>
											</div>

											<div class="form-group">
												<label>Tempoh Tinggal Di Kariah</label> <input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal" value="<?php echo $row['tempoh_tinggal']; ?>" readonly>
											</div>
											<div class="form-group">
												<label>No. Telefon Qariah</label> <input class="form-control" name="notel_qariah" id="notel_qariah" value="<?php echo $row['no_hp']; ?>" readonly>
											</div>
										</div>
										<!-- /.col-lg-4 (nested) -->

									
											<div class="col-lg-4 border">
												<div class="form-group">
													<label>No Rumah (Alamat Terkini)</label> <input type="text" name="alamat_terkini" class="form-control" value="<?php echo $row['alamat_qariah']; ?>" readonly>
												</div>

												<div class="form-group">
													<label>Negeri</label> <select class="form-control" name="id_negeri" id="id_negeri" readonly>
														<option value="default">Sila Pilih</option>
														<?php while ($row2 = mysql_fetch_array($result1)) {
															$id_negeri = $row['id_negeri'];
															$caption = $row2['name'];
															$id = $row2['id_negeri'];
															$sel_select = "";
															if ($id_negeri == $id) {
																$sel_select = "SELECTED=SELECTED";
															}
														?>
															<option value="<?php echo $id; ?>" <?php echo $sel_select; ?>>
																<?php echo $caption ?></option>
														<?php       } ?>
													</select>
												</div>

												<div class="form-group">
													<label>Daerah</label> <select class="form-control" name="id_daerah" id="id_daerah" readonly>
														<option value="default">Sila Pilih</option>
														<?php while ($row2 = mysql_fetch_array($result2)) {
															$id_daerah = $row['id_daerah'];
															$caption = $row2['nama_daerah'];
															$id = $row2['id_daerah'];
															$sel_select = "";
															if ($id_daerah == $id) {
																$sel_select = "SELECTED=SELECTED";
															}
														?>
															<option value="<?php echo $id; ?>" <?php echo $sel_select; ?>>
																<?php echo $caption ?></option>
														<?php       } ?>
													</select>
												</div>


												<div class="form-group">
													<label>Poskod</label> <input type="text" name="poskod" class="form-control" value="<?php echo $row['poskod']; ?>" readonly>
												</div>

											</div>
										

										<div class="column">
											<div class="col-lg-4">
												<div class="form-group">
													<input type="hidden" name="id_data" value="<?php echo $row['id_anakqariah']; ?>">
													<input type="submit" name="update" id="update" value="Kemaskini" class="btn btn-success" />
												</div>
												<!-- /.col-lg-4 (nested) -->
											</div>
										</div>
								</form>
							</div>
							<!-- /.row (nested) -->
					<?php  }
			} else {
				echo mysql_error();
			}
					?>