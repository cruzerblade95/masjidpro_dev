<?php 
	include("connection/connection.php");

	$idd = $_GET['id_data'];

	$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini,tarikh_lahir,no_hp,poskod,pekerjaan,tempoh_tinggal,id_negeri,id_daerah,status_perkahwinan,bangsa,jantina,warganegara,zon_qariah
				FROM sej6x_data_peribadi
				WHERE id_data=$idd";
	$r = mysqli_query($bd2, $sql_search);
	
	if($r)
	{
		while($row=mysqli_fetch_array($r))
	{
	$id_data=$row['id_data'];
	
	$negeri_masjid=$row['id_negeri'];

	//untuk sql negeri
	$sql_negeri="SELECT id_negeri,name FROM negeri"; 
	$result1 = mysqli_query($bd2, $sql_negeri) or die ("Error :".mysqli_error($bd2));
	
	//untuk sql daerah
	$sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='$negeri_masjid'"; 
	$result2=mysqli_query($bd2, $sql_daerah) or die ("Error :".mysqli_error($bd2));
	mysqli_num_rows($result2);

	//untuk sql zon kariah 
	$sql_zonkariah="SELECT id_zonqariah,id_masjid,nama_zon,no_huruf FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; 	                      
	$sql_zon=mysqli_query($bd2, $sql_zonkariah) or die ("Error :".mysqli_error($bd2));

?>  
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Menu Ahli Kariah</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=pendaftaran_ahli_qariah">Menu Ahli Kariah</a></li>
					<li class="active">Kemaskini Ahli Kariah</li>
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
				Maklumat Ahli Kariah
				</div>

				<div class="card-body">

				<form method="post" id="layak_mengundi" action="pendaftaran/update_ahlikariah.php">

				<div class="row">
					<div class="col-lg-12">
						<center><h4><u>Maklumat Ahli</u></h4></center>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label><b>Nama Penuh</b></label>
							<input type="text" name="nama_penuh" class="form-control" value="<?php echo $row['nama_penuh'];?>" required>
						</div>

						<div class="form-group">
							<label><b>No. K/P</b></label>
							<input type="text" name="no_ic" class="form-control" value="<?php echo $row['no_ic'];?>" required>
						</div>

						<div class="form-group">
							<label><b>No Telefon</b></label>
							<input type="text" name="no_hp" class="form-control" value="<?php echo $row['no_hp'];?>" required>
						</div>


						<div class="form-group">
							<label><b>Umur</b></label>
							<input type="text" name="umur" class="form-control" value="<?php echo $row['umur'];?>" required>
						</div>

						<div class="form-group">
							<label><b>Tarikh Lahir</b></label>
							<input type="date" name="tarikh_lahir" class="form-control" value="<?php echo $row['tarikh_lahir'];?>" required>
						</div>

						<div class="form-group">
							<label><b>Jantina</b></label>
							<select class="form-control" name="jantina" id="jantina">
							<option>Sila Pilih</option>
							<option value="1"
							<?php 
							if($row["jantina"]=='1')
							{
							echo "selected";
							}
							?>
							>Lelaki</option>
							<option value="2"
							<?php 
							if($row["jantina"]=='2')
							{
							echo "selected";
							}
							?>
							>Perempuan</option>
							</select>
						</div>
					</div>
					<!-- /.col-lg-4 (nested) -->

					<div class="col-lg-4">	
						<div class="form-group">
							<label><b>Bangsa</b></label>
							<select class="form-control" name="bangsa" id="bangsa">
							<option>Sila Pilih</option>

							<option value="1"
							<?php 
							if($row["bangsa"]=='1')
							{
							echo "selected";
							}
							?>
							>Melayu</option>
							<option value="2"
							<?php 
							if($row["bangsa"]=='2')
							{
							echo "selected";
							}
							?>
							>Cina</option>
							<option value="3"
							<?php 
							if($row["bangsa"]=='3')
							{
							echo "selected";
							}
							?>
							>India</option>
							<option value="4"
							<?php 
							if($row["bangsa"]=='4')
							{
							echo "selected";
							}
							?>
							>Lain-lain</option>
							</select>
						</div>

						<div class="form-group">
							<label><b>Warganegara</b></label>
							<select class="form-control" name="warganegara" id="warganegara">
							<option>Sila Pilih</option>							
							<option value="1"
							<?php 
							if($row["warganegara"]=='1')
							{
							echo "selected";
							}
							?>
							>Warganegara</option>
							<option value="2"
							<?php 
							if($row["warganegara"]=='2')
							{
							echo "selected";
							}
							?>
							>Bukan Warganegara</option>
							</select>
						</div>

						<div class="form-group">
							<label><b>Status Perkahwinan</b></label>
							<select class="form-control" name="status_perkahwinan" id="status_perkahwinan" required>
							<option value=>Sila Pilih</option>
							<option value="1"
							<?php 
							if($row["status_perkahwinan"]=='1')
							{
							echo "selected";
							}
							?>

							>Bujang</option>
							<option value="2"
							<?php 
							if($row["status_perkahwinan"]=='2')
							{
							echo "selected";
							}
							?>
							>Berkahwin</option>
							<option value="3"
							<?php 
							if($row["status_perkahwinan"]=='3')
							{
							echo "selected";
							}
							?>
							>Duda</option>
							<option value="4"
							<?php 
							if($row["status_perkahwinan"]=='4')
							{
							echo "selected";
							}
							?>
							>Janda</option>
							</select>
						</div>

						<div class="form-group">
							<label><b>Pekerjaan</b></label>
							<input class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo $row['pekerjaan'];?>">	                  
						</div> 

						<div class="form-group">
							<label><b>Tempoh Tinggal Di Kariah</b></label>
							<input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal" value="<?php echo $row['tempoh_tinggal'];?>" />
						</div> 

						<div class="form-group">
							<label><b>Zon Kariah</b></label>
							<select class="form-control" name="zon_qariah" id="zon_qariah" required>
							<option value="default">Sila Pilih</option>                                                         
							<?php   while($row2=mysqli_fetch_array($sql_zon))
							{
							$zon_qariah=$row['zon_qariah'];
							$caption = $row2['nama_zon'];
							$id = $row2['id_zonqariah'];
							$caption2 = $row2['no_huruf'];
							$sel_select= "";
							if ($zon_qariah==$id){
							$sel_select= "SELECTED=SELECTED"; 
							}                                
							?>                                                                                              
							<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption2 ?>:<?php echo $caption ?></option>
							<?php       } ?>                       
							</select>
						</div>
					</div>
					<!-- /.col-lg-4 (nested) -->

					<div class="col-lg-4">
						<div class="form-group">
							<label><b>No Rumah (Alamat Terkini)</b></label>
							<input type="text" name="alamat_terkini" class="form-control" value="<?php echo $row['alamat_terkini'];?>" required>
						</div>

						<div class="form-group">
							<label><b>Negeri</b></label>
							<select class="form-control" name="id_negeri" id="id_negeri" required>
							<option value="default">Sila Pilih</option>                                                         
							<?php   while($row2=mysqli_fetch_array($result1))
							{
							$id_negeri=$row['id_negeri'];
							$caption = $row2['name'];
							$id = $row2['id_negeri'];
							$sel_select= "";
							if ($id_negeri==$id){
							$sel_select= "SELECTED=SELECTED"; 
							}                                
							?>                                                                                              
							<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption ?></option>
							<?php       } ?>                       
							</select>
						</div>		

						<div class="form-group" id="daerah">
							<label><b>Daerah</b></label>
							<select class="form-control" name="id_daerah" id="id_daerah" required>
							<option>Sila Pilih</option>                                                         
							<?php   while($row2=mysqli_fetch_array($result2))
							{
							$id_daerah=$row['id_daerah'];
							
							$caption = $row2['nama_daerah'];
							$id = $row2['id_daerah'];
							$sel_select= "";
							if ($id_daerah==$id){
							$sel_select= "SELECTED=SELECTED"; 
							}                                
							?>                                                                                              
							<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption ?></option>
							<?php       } ?>                       
							</select> 
						</div>

						<div class="form-group">
							<label><b>Poskod</b></label>
							<input type="text" name="poskod" class="form-control" value="<?php echo $row['poskod'];?>" required>
						</div>
					</div>
					<!-- /.col-lg-4 (nested) -->
					
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<center><h4><u>Tanggungan Anak Kariah</u></h4></center>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">  
							<table class="table table-bordered" id="myTable">
								<tr>
									<th align="middle">Bil</th>
									<th>Nama Tanggungan</th>
									<th>No Kad Pengenalan</th>
									<th>Tarikh Lahir</th>
									<th>No Telefon</th>
									<th>Hubungan</th>
									<th></th>
								</tr>
								<?php 
								$sql1="SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_data'";
								$sqlquery1=mysqli_query($bd2, $sql1);
								
								$i=1;
								while($row=mysqli_fetch_array($sqlquery1))
								{
								?>
								<tr>
									<td align="middle"><?php echo $i;?></td>
									<td><input class="form-control" type="text" name="nama_tanggungan[]" value="<?php echo $row['nama_penuh'];?>" placeholder="Nama Penuh" required></td>
									<td><input class="form-control" type="text" name="ic_tanggungan[]" value="<?php echo $row['no_ic'];?>" placeholder="Contoh: 001223011234" minlength="12" maxlength="12"></td>
									<td><input class="form-control" type="date" name="tarikh_lahir_tanggungan[]" value="<?php echo $row['tarikh_lahir'];?>"></td>
									<td><input class="form-control" type="text" name="tel_tanggungan[]" value="<?php echo $row['no_tel'];?>"></td>
									<td><input class="form-control" type="text" name="hubungan_tanggungan[]" value="<?php echo $row['hubungan'];?>" required></td>
									<td>
										<a href="pendaftaran/del_anakqariah.php?&id_tanggungan=<?php echo $row['ID']; ?>">
											<button type="button" name="delete" id="delete" class="form-control" title="Padam">
												<i class="fas fa-user-times" onclick="return confirm('Padam Rekod?');" aria-hidden="true"></i>
											</button>
										</a>
									</td>
								</tr>
								<input type="hidden" name="id_tanggungan[]" value="<?php echo $row['ID']; ?>">
								<?php
									$i++;
								}
								?>
								<input type="hidden" name="id_masjid" value="<?php echo $id_masjid;?>">
							</table>
							<center>
								<button type="button" name="add" id="add" onClick="insertRow()" class="btn btn-success">+</button>
							</center>
						</div> 
					</div>
					<!-- /.col-lg-12 (nested) -->
				</div>
				
				<div class="row">
					<div class="col-lg-12">
					<center>
						<div class="form-group">
							<input type="hidden" name="id_data" value="<?php echo $id_data; ?>">
							<input type="submit" name="update" id="update" value="Kemaskini" class="btn btn-success" />            
						</div>  
					</center>
					</div>
					<!-- /.col-lg-12 (nested) -->
				</div>

				</form>     
			</div>
			
			</div>
			
			</div>
		</div>
	</div>
</div>
<script>
function insertRow(){
			var table=document.getElementById("myTable");
			var row=table.insertRow(table.rows.length);
			var bil=(table.rows.length)-1;
			var cell1=row.insertCell(0);
			cell1.style.textAlign="center";
			cell1.innerHTML = bil;
			
			cell1=row.insertCell(1);
			cell1.innerHTML = "<input class='form-control' type='text' name='nama_tanggungan[]' placeholder='Nama Penuh' required>";
			
			cell1=row.insertCell(2);
			cell1.innerHTML = "<input class='form-control' type='text' name='ic_tanggungan[]' placeholder='Contoh: 001223011234' minlength='12' maxlength='12'>";
			
			cell1=row.insertCell(3);
			cell1.innerHTML = "<input class='form-control' type='date' name='tarikh_lahir_tanggungan[]'>";
			
			cell1=row.insertCell(4);
			cell1.innerHTML = "<input class='form-control' type='text' name='tel_tanggungan[]'>";
			
			cell1=row.insertCell(5);
			cell1.innerHTML = "<input class='form-control' type='text' name='hubungan_tanggungan[]' required>";
			
			cell1=row.insertCell(6);
			cell1.innerHTML = "<button class='btn btn-danger btn_remove'onclick='removeRow(this);'>x</button>"; 
}
function removeRow(src){
			 var oRow = src.parentElement.parentElement;  
			 document.all("myTable").deleteRow(oRow.rowIndex);
} 
function showDaerah(str) {
    if (str == "") {
        document.getElementById("daerah").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("daerah").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","admin/getdaerah.php?negeri="+str,true);
        xmlhttp.send();
    }
}
</script>
<?php  }
}
else
{
echo mysqli_error($bd2);
}
?>
