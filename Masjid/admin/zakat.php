<?php

include("connection/connection.php");

?>
<!--script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script-->

<script>
    $(document).ready(function() {
        $('#table_display').DataTable();
    } );
</script>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Senarai Penerima Zakat</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Senarai Penerima Zakat</li>
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
                    Senarai Penerima Zakat&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                </div>
                <div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<div style="background-color:#9AFF33">
								<div class="card-body" align="center">
								SAGUHATI HARI RAYA
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div style="background-color:#FCFF33">
								<div class="card-body" align="center">
								SARA HIDUP
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div style="background-color:#FFB133">
								<div class="card-body" align="center">
								PROGRAM NUR RAMADHAN
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div style="background-color:#F98716">
								<div class="card-body" align="center">
								PERMULAAN KE IPT
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<div style="background-color:#304CE0">
								<div class="card-body" align="center">
								BIASISWA
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div style="background-color:#DAC5AC">
								<div class="card-body" align="center">
								PENINGKATAN TARAF HIDUP
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div style="background-color:#D6F1FD">
								<div class="card-body" align="center">
								KESIHATAN
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div style="background-color:#8869DF">
								<div class="card-body" align="center">
								BANTUAN KECEMASAN
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<div style="background-color:#848288">
								<div class="card-body" align="center">
								BAYARAN FIDYAH
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div style="background-color:#E03730">
								<div class="card-body" align="center">
								BANTUAN AWAL PERSEKOLAHAN
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div style="background-color:#3A94AB">
								<div class="card-body" align="center">
								TAWAQQUF-BANTUAN KHAS(COVID-19)
								</div>
							</div>
						</div>
					</div>
					<br>
					<center>
					<select style="width:250px" class="form-control" name="pilih_zakat" onChange="document.location.href='utama.php?view=admin&action=zakat&pilih_zakat='+this.options[this.selectedIndex].value">
						<option>Carian Jenis Zakat:-</option>
						<option value="SEMUA" <?php if(isset($_GET['pilih_zakat'])){ if($_GET['pilih_zakat']=="SEMUA") { echo "seleceted"; } } ?>>SEMUA</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="SAGUHATI HARI RAYA") { echo "seleceted"; } } ?> value="SAGUHATI HARI RAYA">SAGUHATI HARI RAYA</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="SARA HIDUP") { echo "seleceted"; } } ?> value="SARA HIDUP">SARA HIDUP</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="PROGRAM NUR RAMADHAN") { echo "seleceted"; } } ?> value="PROGRAM NUR RAMADHAN">PROGRAM NUR RAMADHAN</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="PERMULAAN KE IPT") { echo "seleceted"; } } ?> value="PERMULAAN KE IPT">PERMULAAN KE IPT</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="BIASISWA") { echo "seleceted"; } } ?> value="BIASISWA">BIASISWA</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="PENINGKATAN TARAF HIDUP") { echo "seleceted"; } } ?> value="PENINGKATAN TARAF HIDUP">PENINGKATAN TARAF HIDUP</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="KESIHATAN") { echo "seleceted"; } } ?> value="KESIHATAN">KESIHATAN</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="BANTUAN KECEMASAN") { echo "seleceted"; } } ?> value="BANTUAN KECEMASAN">BANTUAN KECEMASAN</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="BAYARAN FIDYAH") { echo "seleceted"; } } ?> value="BAYARAN FIDYAH">BAYARAN FIDYAH</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="BANTUAN AWAL PERSEKOLAHAN") { echo "seleceted"; } } ?> value="BANTUAN AWAL PERSEKOLAHAN">BANTUAN AWAL PERSEKOLAHAN</option>
						<option style="background-color:#" <?php if(isset($_GET['pilih_zakat'])) { if($_GET['pilih_zakat']=="TAWAQQUF-BANTUAN KHAS (COVID-19)") { echo "seleceted"; } } ?> value="TAWAQQUF-BANTUAN KHAS (COVID-19)">TAWAQQUF-BANTUAN KHAS(COVID-19)</option>
					</select>
					</center>
					<br>
                    <div class="table-responsive">
                        <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered display nowrap margin-top-10 w-p100">
                            <thead>
                            <!-- <tr>
                                <th width="5%" rowspan="2"><div align="center">No</div></th>
                                <th rowspan="2"><div align="center">Nama</div></th>
                                <th rowspan="2"><div align="center">No Kad Pengenalan</div></th>
                                <th colspan="5"><div align="center">Jenis Zakat</div></th>
                                <th rowspan="2"><div align="center">Tindakan</div></th>
                            </tr>
                            <tr>
                                <th><div align="center">1</div></th>
                                <th><div align="center">2</div></th>
                                <th><div align="center">3</div></th>
                                <th><div align="center">4</div></th>
                                <th><div align="center">5</div></th>
								<th><div align="center">6</div></th>
								<th><div align="center">7</div></th>
								<th><div align="center">8</div></th>
								<th><div align="center">9</div></th>
								<th><div align="center">10</div></th>
								<th><div align="center">11</div></th>
                            </tr> -->
							<tr>
								<?php
								if(($_GET['pilih_zakat']==NULL) OR ($_GET['pilih_zakat']=="SEMUA")){
								?>
                                <th width="5%"><div align="center">No</div></th>
                                <th width="20%"><div align="center">Nama</div></th>
                                <th width="10%"><div align="center">No Kad Pengenalan</div></th>
                                <th width="5%" bgcolor="9AFF33"><div align="center">1</div></th>
                                <th width="5%" bgcolor="FCFF33"><div align="center">2</div></th>
                                <th width="5%" bgcolor="FFB133"><div align="center">3</div></th>
								<th width="5%" bgcolor="F98716"><div align="center">4</div></th>
                                <th width="5%" bgcolor="304CE0"><div align="center">5</div></th>
								<th width="5%" bgcolor="DAC5AC"><div align="center">6</div></th>
								<th width="5%" bgcolor="D6F1FD"><div align="center">7</div></th>
								<th width="5%" bgcolor="8869DF"><div align="center">8</div></th>
								<th width="5%" bgcolor="848288"><div align="center">9</div></th>
								<th width="5%" bgcolor="E03730"><div align="center">10</div></th>
								<th width="5%" bgcolor="3A94AB"><div align="center">11</div></th>
                                <th width="10%"><div align="center">Tindakan</div></th>
								<?php
								}
								else{
								?>
								<th><div align="center">No</div></th>
								<th><div align="center">Nama</div></th>
                                <th><div align="center">No Kad Pengenalan</div></th>
								<th><div align="center"><?php echo "Zakat ".$_GET['pilih_zakat']; ?></div></th>
								<th><div align="center">Tindakan</div></th>
								<?php
								}
								?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            //$sql = "SELECT a.nama_penuh, a.no_ic, a.no_hp FROM sej6x_data_peribadi a, data_zakat b WHERE a.id_masjid=b.id_masjid AND a.no_ic=b.no_ic GROUP BY a.no_ic";
                            
							if(($_GET['pilih_zakat']==NULL) OR ($_GET['pilih_zakat']=="SEMUA")){
							$sql = "SELECT * FROM sej6x_data_zakat WHERE id_masjid='$id_masjid' GROUP BY no_ic";
                            $sqlquery = mysqli_query($bd2,$sql);

                            $i=1;
                            while($data = mysqli_fetch_array($sqlquery))
                            {
								$no_ic1 = $data['no_ic'];
								$no_ic = str_replace("-","",$no_ic1);
								//$jenis_zakat=$data['jenis_zakat'];
                                $sql1 = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic' AND id_masjid='$id_masjid'";
                                $sqlquery1 = mysqli_query($bd2,$sql1);
                                $row1 = mysqli_num_rows($sqlquery1);
                                $data1 = mysqli_fetch_array($sqlquery1);
	
								$sql4 = "SELECT * FROM sej6x_data_zakat WHERE id_masjid='$id_masjid' AND no_ic='$no_ic1'";
								//$sqlquery4 = mysqli_query($bd2,$sql4);
                                if($row1==0) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $i; ?></td>
                                        <td align="center" bgcolor='#FC5858'><?php echo $data['nama_penuh']."<br>".$data['alamat1'].",".$data['alamat2']; ?></td>
                                        <td align="center" bgcolor='#FC5858'><?php echo $data['no_ic']; ?></td>
                                        <td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='SAGUHATI HARI RAYA'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='SARA HIDUP'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='PROGRAM NUR RAMADHAN'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='PERMULAAN KE IPT'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='BIASISWA'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='PENINGKATAN TARAF HIDUP'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='KESIHATAN'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='BANTUAN KECEMASAN'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='BAYARAN FIDYAH'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='BANTUAN AWAL PERSEKOLAHAN'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='TAWAQQUF-BANTUAN KHAS (COVID-19)'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
                                        <td align="center"><a href="daftar_online/pendaftaran.php?id_masjid=<?php echo $id_masjid; ?>" target="_blank" class="btn btn-danger">Daftar</a></td>
									</tr>
								   <?php
                                }
                                else if($row1>0){
                                    ?>
                                    <tr>
										<td align="center"><?php echo $i; ?></td>
										<td align="center" bgcolor='#228b22'><?php echo $data1['nama_penuh']."<br>".$data1['alamat_terkini']; ?></td>
										<td align="center" bgcolor='#228b22'><?php echo $data['no_ic']; ?></td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='SAGUHATI HARI RAYA'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='SARA HIDUP'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='PROGRAM NUR RAMADHAN'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='BANTUAN AWAL PERSEKOLAHAN'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='BIASISWA'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='PENINGKATAN TARAF HIDUP'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='KESIHATAN'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='BANTUAN KECEMASAN'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='BAYARAN FIDYAH'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='PERMULAAN KE IPT'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<?php
											$sql3 = $sql4." AND jenis_zakat='TAWAQQUF-BANTUAN KHAS (COVID-19)'";
											$sqlquery3 = mysqli_query($bd2,$sql3);
											$row = mysqli_num_rows($sqlquery3);
											if($row>0)
											{
												echo $row;
												//echo "<i class='fas fa-check'></i>";
											}
											?>
										</td>
										<td align="center">
											<form target="_blank" action="daftar_online/pendaftaran.php?id_masjid=<?php echo $id_masjid; ?>" method="POST">
												<input type="hidden" name="no_ic" value="<?php echo $no_ic; ?>">
												<input type="hidden" name="semak" id="semak" value="1">
												<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
												<button type="submit" class="btn btn-success" name="simpan" id="simpan  ">Kemaskini</button>
											</form>
										</td>
									</tr>
                                    <?php
                                }
                                $i++;
                            }
							}
							else{
							$pilih_zakat = $_GET['pilih_zakat'];
							$sql = "SELECT * FROM sej6x_data_zakat WHERE id_masjid='$id_masjid' AND jenis_zakat='$pilih_zakat' GROUP BY no_ic";
                            $sqlquery = mysqli_query($bd2,$sql);

                            $i=1;
                            while($data = mysqli_fetch_array($sqlquery))
                            {
								$no_ic1 = $data['no_ic'];
								$no_ic = str_replace("-","",$no_ic1);
								//$jenis_zakat=$data['jenis_zakat'];
                                $sql1 = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic' AND id_masjid='$id_masjid'";
                                $sqlquery1 = mysqli_query($bd2,$sql1);
                                $row1 = mysqli_num_rows($sqlquery1);
                                $data1 = mysqli_fetch_array($sqlquery1);

								$sql4 = "SELECT * FROM sej6x_data_zakat WHERE id_masjid='$id_masjid' AND no_ic='$no_ic1' AND jenis_zakat='$pilih_zakat'";
								$sqlquery4 = mysqli_query($bd2,$sql4);
                                if($row1==0) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $i; ?></td>
                                        <td align="center" bgcolor='#FC5858'><?php echo $data['nama_penuh']."<br>".$data['alamat1'].",".$data['alamat2']; ?></td>
                                        <td align="center" bgcolor='#FC5858'><?php echo $data['no_ic']; ?></td>
                                        <td align="center"><?php echo mysqli_num_rows($sqlquery4); ?></td>
										<td align="center"><a href="daftar_online/pendaftaran.php?id_masjid=<?php echo $id_masjid; ?>" target="_blank" class="btn btn-danger">Daftar</a></td>
									</tr>
								   <?php
                                }
                                else if($row1>0){
                                    ?>
                                    <tr>
										<td align="center"><?php echo $i; ?></td>
										<td align="center" bgcolor='#228b22'><?php echo $data1['nama_penuh']."<br>".$data1['alamat_terkini']; ?></td>
										<td align="center" bgcolor='#228b22'><?php echo $data['no_ic']; ?></td>
										<td align="center"><?php echo mysqli_num_rows($sqlquery4); ?></td>
										</td>
										<td align="center">
											<form target="_blank" action="daftar_online/pendaftaran.php?id_masjid=<?php echo $id_masjid; ?>" method="POST">
												<input type="hidden" name="no_ic" value="<?php echo $no_ic; ?>">
												<input type="hidden" name="semak" id="semak" value="1">
												<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
												<button type="submit" class="btn btn-success" name="simpan" id="simpan  ">Kemaskini</button>
											</form>
										</td>
									</tr>
                                    <?php
                                }
                                $i++;
                            }
							}
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Penerima Zakat', [ 0, 1, 2, 3]);
    });
</script>
