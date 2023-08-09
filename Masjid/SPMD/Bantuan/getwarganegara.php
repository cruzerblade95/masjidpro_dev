<?php
	include ('connection/connection.php');
	
	$warganegara = $_GET['warganegara'];
	$id = $_GET['id'];
	if($warganegara==1) {
?>
		<span class="label-input100">No Kad Pengenalan:</span>
		<input class="input100" type="text" name="no_ic" placeholder="Masukkan No Kad Pengenalan '-'" required minlength=12 maxlength="12" value="<?php echo($id); ?>">
		<input type="hidden" name="warganegara" value="<?php echo $warganegara; ?>">
	
<?php
	}
	else if($warganegara==2)
	{
?>
		<span class="label-input100">No Passport:</span>
		<input class="input100" type="text" name="no_passport" placeholder="Masukkan No Passport" required value="<?php echo($id); ?>">
		<input type="hidden" name="warganegara" value="<?php echo $warganegara; ?>">

<?php
	}
?>