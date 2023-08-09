<div class="row">
	<div class="col-lg-12">
		<h2 align="center" class="page-header">DAFTAR KARIAH (ANAK TANGGUNGAN)</h2>
	</div>
	<!-- /.col-lg-12 -->
</div>
<?php 
	include("connection/connection.php");

	$id = $_GET['id'];

	$sql_search="SELECT a.ID 'ID', a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', a.hubungan 'hubungan', a.tarikh_lahir 'tarikh_lahir', b.id_data 'id_data', b.nama_penuh 'nama_kariah', b.no_ic 'ic_kariah' FROM sej6x_data_anakqariah a, sej6x_data_peribadi b WHERE a.id_qariah=b.id_data AND a.ID='$id' AND a.id_masjid='$id_masjid'";
	$r = mysql_query($sql_search,$bd);
	
	if($r)
	{
		while($row=mysql_fetch_array($r))
	{
		$ID=$row['ID'];

	//untuk sql negeri
	$sql_negeri="SELECT id_negeri,name FROM negeri"; 
	$result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
	
	//untuk sql daerah
	$sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='$negeri_masjid'"; 
	$result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
	mysql_num_rows($result2);

	//untuk sql zon kariah 
	$sql_zonkariah="SELECT id_zonqariah,id_masjid,nama_zon,no_huruf FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; 	                      
	$sql_zon=mysql_query($sql_zonkariah) or die ("Error :".mysql_error());

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
					<li class="active">Daftar Kariah(Anak Tanggungan)</li>
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
					Maklumat Kariah
				</div>
				<div class="card-body">
				<form method="post" action="pendaftaran/add_anakqariah.php">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="alert alert-info">
									<div align="center">  
										<label><b>Nama Kariah :</b></label> <?php echo $row['nama_kariah'];?>
									</div>
									<div align="center"> 
										<label><b>No K/P Kariah:</b></label> <?php echo $row['ic_kariah'];?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<h4 align="center"><u>Maklumat Anak Tanggungan</u></h4>
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
								<input type="text" name="no_hp" class="form-control" required>
							</div>


							<div class="form-group">
								<label><b>Umur</b></label>
								<input type="text" name="umur" class="form-control" required>
							</div>

							<div class="form-group">
								<label><b>Tarikh Lahir</b></label>
								<input type="date" name="tarikh_lahir" class="form-control" value="<?php echo $row['tarikh_lahir'];?>" required>
							</div>

							<div class="form-group">
								<label><b>Jantina</b></label>
								<select class="form-control" name="jantina" id="jantina">
								<option>Sila Pilih</option>
								<option value="1">Lelaki</option>
								<option value="2">Perempuan</option>
								</select>
							</div>
						</div>
						<!-- /.col-lg-4 (nested) -->

						<div class="col-lg-4">	
							<div class="form-group">
								<label><b>Bangsa</b></label>
								<select class="form-control" name="bangsa" id="bangsa">
								<option>Sila Pilih</option>

								<option value="1">Melayu</option>
								<option value="2">Cina</option>
								<option value="3">India</option>
								<option value="4">Lain-lain</option>
								</select>
							</div>

							<div class="form-group">
								<label><b>Warganegara</b></label>
								<select class="form-control" name="warganegara" id="warganegara">
								<option>Sila Pilih</option>							
								<option value="1">Warganegara</option>
								<option value="2">Bukan Warganegara</option>
								</select>
							</div>

							<div class="form-group">
								<label><b>Status Perkahwinan</b></label>
								<select class="form-control" name="status_perkahwinan" id="status_perkahwinan" required>
								<option value=>Sila Pilih</option>
								<option value="1">Bujang</option>
								<option value="2">Berkahwin</option>
								<option value="3">Duda</option>
								<option value="4">Janda</option>
								</select>
							</div>

							<div class="form-group">
								<label><b>Pekerjaan</b></label>
								<input class="form-control" name="pekerjaan" id="pekerjaan">	                  
							</div> 

							<div class="form-group">
								<label><b>Tempoh Tinggal Di Kariah</b></label>
								<input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal"/>
							</div> 

							<div class="form-group">
								<label><b>Zon Kariah</b></label>
								<select class="form-control" name="zon_qariah" id="zon_qariah" required>
								<option value="default">Sila Pilih</option>                                                         
								<?php   while($row2=mysql_fetch_array($sql_zon))
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
								<option value="<?php echo $id;?>"> <?php echo $caption2 ?>:<?php echo $caption ?></option>
								<?php       } ?>                       
								</select>
							</div>
						</div>
						<!-- /.col-lg-4 (nested) -->

						<div class="col-lg-4">
							<div class="form-group">
								<label><b>No Rumah (Alamat Terkini)</b></label>
								<input type="text" name="alamat_terkini" class="form-control" required>
							</div>

							<div class="form-group">
								<label><b>Negeri</b></label>
								<select class="form-control" name="id_negeri" id="id_negeri" onChange="showDaerah(this.value)"required>
								<option value="default">Sila Pilih</option>                                                         
								<?php   while($row2=mysql_fetch_array($result1))
								{
								$id_negeri=$row['id_negeri'];
								$caption = $row2['name'];
								$id = $row2['id_negeri'];
								$sel_select= "";
								if ($id_negeri==$id){
								$sel_select= "SELECTED=SELECTED"; 
								}                                
								?>                                                                                              
								<option value="<?php echo $id;?>"> <?php echo $caption ?></option>
								<?php       } ?>                       
								</select>
							</div>		

							<div class="form-group" id="daerah">
							</div>

							<div class="form-group">
								<label><b>Poskod</b></label>
								<input type="text" name="poskod" class="form-control" required>
							</div>
						</div>
						<!-- /.col-lg-4 (nested) -->
						
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-12">
							<h4 align="center"><u>Catatan Masjid</u></h4>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label style="color: red">*</b></label><b>Warga Emas</b>
								<select class="form-control" name="warga_emas" id="warga_emas" required>
									<option value="0">Sila Pilih</option>
									<option value="1">Ya</option>
									<option value="2">Tidak</option>
								</select>	            
							</div>
						</div>
						<!-- /.col-lg-4 (nested) -->
						<div class="col-lg-4">	
							<div class="form-group">
								<label style="color: red">*</b></label><b>Wajib Solat Jumaat</b>
								<select class="form-control" name="solat_jumaat" id="solat_jumaat" required>
									<option value="0">Sila Pilih</option>
									<option value="1">Ya</option>
									<option value="2">Tidak</option>
								</select>	            
							</div>
						</div>
						<!-- /.col-lg-4 (nested) -->
						<div class="col-lg-4">	
							<div class="form-group">
								<label style="color: red">*</b></label><b>OKU</b>
								<select class="form-control" name="oku" id="oku" required>
									<option value="0">Sila Pilih</option>
									<option value="1">Ya</option>
									<option value="2">Tidak</option>
								</select>	            
							</div>
						</div>
						<!-- /.col-lg-4 (nested) -->
					</div>					
					<div class="row">
						<div class="col-lg-12">
						<center>
							<div class="form-group">
								<input type="hidden" name="id" value="<?php echo $ID; ?>">
								<input type="hidden" name="view" value="<?php echo $view; ?>">
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $datastaff['user_id'];?>">
								<input type="submit" name="submit" id="submit" value="Daftar Kariah" class="btn btn-success" />            
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
			cell1.innerHTML = "<input class='form-control' type='text' name='ic_tanggungan[]' placeholder='Contoh: 001223011234' minlength='12' maxlength='12' required>";
			
			cell1=row.insertCell(3);
			cell1.innerHTML = "<input class='form-control' type='date' name='tarikh_lahir_tanggungan[]' required>";
			
			cell1=row.insertCell(4);
			cell1.innerHTML = "<input class='form-control' type='text' name='hubungan_tanggungan[]' required>";
			
			cell1=row.insertCell(5);
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
echo mysql_error();
}
?>
