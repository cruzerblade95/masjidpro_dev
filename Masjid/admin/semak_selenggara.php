<?php 

	include("connection/connection.php"); 

	$idd = $_GET['id_selenggara'];

	//sql view selenggara
	$sql_search="SELECT * FROM sej6x_data_selenggara WHERE id_selenggara='$idd'";
	$result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error());
	$row = mysqli_fetch_assoc($result);
?> 
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Semak Selenggara</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=maklumatselenggara">Laporan Selenggara</a></li>
					<li class="active">Semak Selenggara</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Maklumat Selenggara</div>
				<div class="card-body">
					<form method="POST" action="admin/update_selenggara.php" name="selenggara">
					<div class="row">
						<div class="col-lg-12" align="center">
							<h4>JENIS SELENGGARA</h4>
						</div>
						<hr>
						<div class="col-lg-6">
							<div class="form-group">
                                <?php
                                if($row['id_vendor']!="")
                                {
                                ?>
								<label>Vendor</label>
								<select class="form-control" name="vendor_selenggara" required>
									<option>Sila Pilih:-</option>
									<?php

									$id_vendor=$row['id_vendor'];
									
									$sql1="SELECT * FROM kew_vendor WHERE id_masjid='$id_masjid' AND jenis_vendor='5'";
									$sqlquery1=mysqli_query($bd2,$sql1);
									
									while($data1=mysqli_fetch_array($sqlquery1))
									{
									?>
									<option value="<?php echo $data1['id_vendor']; ?>" <?php if($id_vendor==$data1['id_vendor']) { echo "selected"; } ?>><?php echo $data1['nama_vendor']; ?></option>
									<?php
									}
									?>
								</select>
                                <?php
                                }
                                else if($row['id_dataajk']!="")
                                {
                                ?>
                                <label>AJK Masjid</label>
                                <select class="form-control" name="ajk_selenggara">
                                <?php

                                $id_dataajk=$row['id_dataajk'];

                                $sql3="SELECT a.nama_penuh, a.no_ic, a.no_hp, a.alamat_terkini, a.id_data FROM sej6x_data_peribadi a, data_ajkmasjid b WHERE b.id_dataajk='$id_dataajk' AND a.id_data=b.id_ajk";
                                $sqlquery3=mysqli_query($bd2,$sql3);
                                $data3=mysqli_fetch_array($sqlquery3);

                                $sql2="SELECT a.nama_penuh,b.id_dataajk FROM sej6x_data_peribadi a, data_ajkmasjid b WHERE b.id_masjid='$id_masjid' AND a.id_data=b.id_ajk";
                                $sqlquery2=mysqli_query($bd2,$sql2);

                                while($data2=mysqli_fetch_array($sqlquery2))
                                {
                                ?>
                                <option value="<?php echo $data2['id_dataajk']; ?>" <?php if($id_dataajk==$data2['id_dataajk']) { echo "selected"; } ?>><?php echo $data2['nama_penuh']; ?></option>
                                <?php
                                }
                                ?>
                                </select>
                                <?php
                                }
                                ?>
							</div>
							<div class="form-group">
								<label>Tarikh Selenggara</label>
								<input type="date" class="form-control" name="tarikh_selenggara" value="<?php echo $row['tarikh_selenggara'] ?>" required>	            
							</div>
							<div class="form-group">
								<label>Masa Selenggara</label>
								<input type="time" class="form-control" name="masa_selenggara" value="<?php echo $row['masa_selenggara'] ?>" required>	            
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Pilihan Selenggara</label>
								<select class="form-control" name="pilihan_selenggara" id="pilihan_selenggara">
									<option>Sila Pilih:-</option>
									<option value="1" <?php if($row["pilihan_selenggara"]=='1') { echo "selected"; } ?>>Fasiliti</option>
									<option value="2" <?php if($row["pilihan_selenggara"]=='2') { echo "selected"; } ?>>Elektrik</option>
									<option value="3" <?php if($row["pilihan_selenggara"]=='3') { echo "selected"; } ?>>Air</option>
									<option value="4" <?php if($row["pilihan_selenggara"]=='4') { echo "selected"; } ?>>Komunikasi</option>
									<option value="5" <?php if($row["pilihan_selenggara"]=='5') { echo "selected"; } ?>>Perkakasan</option>
								</select>
							</div>
							<div class="form-group">
								<label>Catatan</label>
								<textarea class="form-control" rows="3" name="catatan"><?php echo $row['catatan'] ?></textarea>
							</div>
							<div class="form-group">  
								<input type="hidden" name="id_selenggara" value="<?php echo $row['id_selenggara']; ?>">                    
								<input type="hidden" name="id_pic" <?php if($row['id_vendor']!="") { ?>value="1"<?php } else if($row['id_dataajk']!="") { ?>value="2"<?php } ?>>
							</div>
						</div>
                        <div class="col-lg-12" align="center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Kemaskini</button>
                            </div>
                        </div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>