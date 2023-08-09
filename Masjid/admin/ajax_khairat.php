<?php
include("../connection/connection.php");
$get_pakej = $_GET['id_pakej'];
$id_data = $_GET['id_data'];

if($get_pakej==1 OR $get_pakej==4)
{
$query_list_nama = "SELECT * FROM sej6x_data_khairat WHERE id_data = $id_data AND pakej = $get_pakej";
	$list_nama = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
	$row_list_nama = mysqli_fetch_assoc($list_nama);
	$totalRows_list_nama = mysqli_num_rows($list_nama);
	
	$sql="SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_data' AND (hubungan='ANAK' OR hubungan='ISTERI' OR hubungan='SUAMI')";
	$sqlquery=mysqli_query($bd2,$sql);
	$row=mysqli_num_rows($sqlquery);
}
else if($get_pakej==2 OR $get_pakej==3 OR $get_pakej==5 OR $get_pakej==6)
{
$query_list_nama = "SELECT * FROM sej6x_data_khairat WHERE id_data = $id_data AND pakej = $get_pakej";
	$list_nama = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
	$row_list_nama = mysqli_fetch_assoc($list_nama);
	$totalRows_list_nama = mysqli_num_rows($list_nama);

	$sql="SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_data' AND NOT (hubungan='ANAK' OR hubungan='ISTERI' OR hubungan='SUAMI')";
	$sqlquery=mysqli_query($bd2,$sql);
	$row=mysqli_num_rows($sqlquery);
}
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js"></script>
<center>
<div id="tajuk" class="row">
    <div class="col-lg-12"><div class="form-group"><label><div align="center">*Maklumat Perlu Didaftar/DiKemaskini Dahulu Sebelum Daftar Khairat*</div></label></div></div>   
                            
    <!--div class="col-lg-2"> <div class="form-group"><div align="center"><button type="button" name="add" id="add_input">Tambah Input</button></div></div></div -->
</div>
<div id="borang_dinamik">
	<div id="display_nama">
		<div class="col-lg-10">
			<select class="form-control" name="nama" id="nama" onChange="selectNama()" required>
				<option>Sila Pilih:-</option>
				<?php
				while($data=mysqli_fetch_array($sqlquery))
				{
				?>
				<option value="<?php echo $data['ID'];?>"><?php echo $data['nama_penuh'];?></option>
				<?php
				}
				?>
			</select>
		</div>
	</div>
	<div id="display_maklumat" style="display:none">
	<?php
	$i=1;
	$sql2="SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_data'";
	$sqlquery2=mysqli_query($bd2,$sql2);
	while($data2=mysqli_fetch_array($sqlquery2))
	{
	?>
	<div id="<?php echo("row".$i); ?>" class="row">
		<input type="hidden" name="pakej" value="<?php echo $get_pakej; ?>" />
		<input type="hidden" name="id_tanggungan" value="<?php echo $data2['ID'];?>" />
		<div class="col-lg-3"><div class="form-group"><input type="text" value="<?php echo $data2['nama_penuh']; ?>" class="form-control" name="nama[]" disabled></div></div>                     
		<div class="col-lg-2"><div class="form-group">
		<input type="text" class="form-control" name="hubungan[]" disabled value="<?php echo $data2['hubungan'];?>" />
		</div></div>      
		<div class="col-lg-3"><div class="form-group">
		<input value="<?php echo $data2['tarikh_lahir']; ?>" class="form-control" name="tarikh_lahir[]" disabled></div></div>   
		   
		<div class="col-lg-2"> <div class="form-group"><input name="no_ic[]" class="form-control" value="<?php echo $data2['no_ic']; ?>" disabled></div></div>
		
		<div class="col-lg-2"> <div class="form-group">
		<button type="button" name="remove" id="<?php echo($i); ?>" class="btn_remove" onclick="padamKhairat(<?php echo $data2['ID']; ?>)">-</button>
		</div></div>
	</div>
	<?php
	$i++;
	}
	?>
	</div>
</div>
</center>
<?php
mysqli_close($bd2);
?>