<?php

	require_once('../connection/connection.php');
	// Connect to server and select database.

	$negeri=intval($_GET['id_negeri']);

?>
<label class="control-label text-right col-md-3">Daerah</label>
<div class="col-md-9">
	<select name="id_daerah" class="form-control" required>
		<option value="">Sila Pilih:-</option>
		<?php 
		$sql_daerah = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
		$query_daerah = mysqli_query($bd2,$sql_daerah);
		echo mysqli_num_rows($query_daerah);
		
		while($data_daerah = mysqli_fetch_array($query_daerah))
		{
		?>
		<option value="<?php echo $data_daerah['id_daerah']; ?>" <?php if($data4['id_daerah']==$data_daerah['id_daerah']) { ?>selected="selected"<?php } ?>><?php echo $data_daerah['nama_daerah']; ?></option>
		<? 
		} 
		?>
	</select>
</div>

