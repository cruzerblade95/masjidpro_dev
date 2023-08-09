<?php 

    include("connection/connection.php");
						  
	$idd = $_GET['id'];

	$sql_search="SELECT 
	id,id_masjid, nama_pengurus, no_tel,nama_balai,bil_anggota, alamat, negeri, 
	daerah,poskod
	FROM sej6x_data_balai
	WHERE id='".$idd."' ";

	$r = mysql_query("$sql_search",$bd);
	if($r)
	{
		while($row=mysql_fetch_array($r))
		{
			$id_data=$row['id_data'];

			//untuk sql negeri
			$sql_negeri="SELECT id_negeri,name FROM negeri"; 
			$result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());

			//untuk sql zon kariah 
			$sql_zonkariah="SELECT id_zonqariah,id_masjid,nama_zon,no_huruf FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; 
			$sql_zon=mysql_query($sql_zonkariah) or die ("Error :".mysql_error());						
?>		   
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Semak Balai</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=komuniti">Menu Komuniti</a></li>
					<li><a href="utama.php?view=admin&action=balai">Balai</a></li>
					<li class="active">Semak Balai</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Maklumat Balai</div> 
					<div class="card-body">
						<form method="post" action="admin/update_balai.php" name="balai">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Nama Pengurus</label>
									<input class="form-control" name="nama_pengurus" id="nama_pengurus" value="<?php echo $row['nama_pengurus'];?>" required />
								</div>
								<div class="form-group">
									<label>No Telefon Pengurus</label>
									<input class="form-control" name="no_tel" id="no_tel" value="<?php echo $row['no_tel'];?>" required />
								</div>
								<div class="form-group">
									<label>Bilangan Anggota</label>
									<input class="form-control" name="bil_anggota" id="bil_anggota" value="<?php echo $row['bil_anggota'];?>" required />
								</div>
								<div class="form-group">
									<label>Nama Balai</label>
									<input class="form-control" name="nama_balai" id="nama_balai" value="<?php echo $row['nama_balai'];?>" required />
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Alamat Balai</label>
									<input class="form-control" name="alamat" id="alamat" value="<?php echo $row['alamat'];?>"/>
								</div>
								<div class="form-group">
									<label>Negeri</label>                       
									<select class="form-control" name="negeri" id="negeri" requiredX>
										<option>Sila Pilih</option>                                                         
										<?php   
										while($row2=mysql_fetch_array($result1))
										{
											$negeri=$row['negeri'];
											$caption = $row2['name'];
											$id = $row2['id_negeri'];
											$sel_select= "";
											if ($negeri==$id)
											{
												$sel_select= "SELECTED=SELECTED"; 
											}                                
										 ?>                                                                                              
										<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption ?></option>
										<?php   
										} 
										?>                       
									</select>
								</div>
								<div class="form-group">
									<label>Daerah</label>
									<select class="form-control" name="daerah" id="daerah" requiredX>
										<option>Sila Pilih</option>  
										<?php
										$id_negeri=$row['negeri'];
										$id_daerah=$row['daerah'];
										
										$sql1="SELECT * FROM daerah WHERE id_negeri='$id_negeri'";
										$sqlquery1=mysql_query($sql1,$bd);
										
										while($data1=mysql_fetch_array($sqlquery1))
										{
										?>
										<option value="<?php echo $data1['id_daerah']; ?>" <?php if($id_daerah==$data1['id_daerah']) { echo "selected"; } ?>><?php echo $data1['nama_daerah']; ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Poskod</label>
									<input class="form-control" id="poskod" name="poskod" value="<?php echo $row['poskod'];?>" required/>
								</div>
							</div>
							<div class="col-lg-12">
								<center>
									<div class="form-group">
									   <input type="hidden" name="id" id="id"  value="<?php echo $row['id'];?>"  />
									   <input type="hidden" name="id_masjid" id="id_masjid" value="<?php echo $id_masjid; ?>" />
										<input type="submit" name="update" id="update" value="Kemaskini" class="btn btn-success" /> 
									</div>
								</center>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  
		}
	}
	else
	{
		echo mysql_error();
	}
	?>         
