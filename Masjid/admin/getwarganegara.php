<?php
	include ('../connection/connection.php');
	
	$warganegara = $_GET['warganegara'];
	
	if($warganegara==1)
	{
?>
	<div class="col-4 form-group" align="left">
		<label>Masukkan No Kad Pengenalan:</label>
		<input class="form-control" name="no_ic" id="no_ic" maxlength="12" required value="<?php echo($no_ic); ?>">
		<input type="hidden" name="warganegara" value="<?php echo $warganegara; ?>">
	</div>
<?php
	}
	else if($warganegara==2)
	{
?>
	<div class="col-4 form-group" align="left">
		<label>Masukkan No Passport:</label>
		<input class="form-control" name="no_passport" id="no_passport" required value="<?php echo($no_passport); ?>">
		<input type="hidden" name="warganegara" value="<?php echo $warganegara; ?>">
	</div>
<?php
	}
?>