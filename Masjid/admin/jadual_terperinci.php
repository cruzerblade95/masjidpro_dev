<?php
if(isset($_POST['search']))
{
	$bulan = $_POST['month'];
	$year = $_POST['tahun'];
	
	$month=date_format((date_create($date)),"F");

	$id_bulan = $_POST['month'];
	$tahun = $_POST['tahun'];
	//Bulan 

	$hari = date("t", mktime(0,0,0,$id_bulan,1,$tahun));
	$bulan3 = date("m", mktime(0,0,0,$id_bulan,1,$tahun));
	$bulan2 = date("F", mktime(0,0,0,$id_bulan,1,$tahun));

	$j = 1;
	$bil_cuti = 0;
	do { 
	$z=mktime(00, 00, 00, $bulan3, $j, $tahun);
	$namahari = date("w", $z);
	$j++;
	} while ($j <= $hari);
}
?>
<style>
table.calendar {
  table-layout: fixed;
}
td {
    padding: 0.5rem;
    border: 1px solid #dedede;
}
.button4 {
  background-color: white;
  color: black;
  border: 2px solid #e7e7e7;
}

.button4:hover {
	background-color: #e7e7e7;
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border-radius:25px;
  border: 1px solid #888;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
}

.modal-body {
	padding: 2px 16px;
}

.modal-footer {
  padding: 2px 16px;
}
</style>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Jadual Pegawai Masjid</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kehadiran">Menu Kehadiran</a></li>
					<li class="active">Jadual Pegawai Masjid</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card" id="printbtn">
				<div class="card-header">
					Carian
				</div>

				<div class="card-body">
					<div class="row"> 
						<div class="col-lg-12">
						<form id="jadual_kehadiran" name="jadual_kehadiran" method="POST" action="<?php echo $PHP_SELF;?>">                              
							<div class="col-lg-3">                                   
								<div class="form-group">
									<label>Bulan</label>
									<select class="form-control" name="month" id="month">
										<option value="" selected="selected">Sila Pilih Bulan</option>
										<option value="01" <?php if ($month=="01"){echo "selected='SELECTED'";}?>>Januari</option>
										<option value="02" <?php if ($month=="02"){echo "selected='SELECTED'";}?>>Februari</option>   
										<option value="03" <?php if ($month=="03"){echo "selected='SELECTED'";}?>>Mac</option>   
										<option value="04" <?php if ($month=="04"){echo "selected='SELECTED'";}?>>April</option>   
										<option value="05" <?php if ($month=="05"){echo "selected='SELECTED'";}?>>Mei</option>   
										<option value="06" <?php if ($month=="06"){echo "selected='SELECTED'";}?>>Jun</option>   
										<option value="07" <?php if ($month=="07"){echo "selected='SELECTED'";}?>>Julai</option>   
										<option value="08" <?php if ($month=="08"){echo "selected='SELECTED'";}?>>Ogos</option>   
										<option value="09" <?php if ($month=="09"){echo "selected='SELECTED'";}?>>September</option>   
										<option value="10" <?php if($month=="10"){echo "selected='SELECTED'";}?>>Oktober</option>   
										<option value="11" <?php if($month=="11"){echo "selected='SELECTED'";}?>>November</option>   
										<option value="12" <?php if($month=="12"){echo "selected='SELECTED'";}?>>Disember</option>   
									</select>                                                                                                                            
								</div>    
							</div>

							<div class="col-lg-3">                                    
								<div class="form-group">
									<label>Tahun</label>
                                    <select class="form-control" name="tahun" id="tahun" required>
                                        <?php
                                        $start_year = 2018;
                                        $end_year = date('Y');
                                        for($i=$start_year;$i<=$end_year;$i++)
                                        {
                                            ?>
                                            <option value="<?php echo $i; ?>" <?php if($tahun==$i) { echo "selected='SELECTED'"; } ?>><?php echo $i;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
								</div>
							</div>

							<div class="col-lg-3">
								<div class="form-group">
									<br>
									<input type="submit" name="search" value="Carian" class="btn btn-primary"></input> 
								</div>
								<input type="hidden" name="carisearch" value="1" />
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if(isset($_POST['search']))
	{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Jadual Pegawai Masjid
				</div>
				<div class="card-body">
					<div class="row"> 
						<div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th rowspan="2" style="display:none"><div align="center">Bil</div></th>
											  <th rowspan="2"><div align="center">Tarikh</div></th>
											  <th colspan="5"><div align="center">Butir-butir Kehadiran</div></th>
										</tr>
										<tr>
										<?php
										
										$sql_waktu = "SELECT a.perkara 'Perkara' FROM sej6x_data_perkarakehadiran a";
										$result2 = mysql_query($sql_waktu,$bd) or die ("Error :".mysql_error());
										
										while($row = mysql_fetch_assoc($result2))
										{ 
										?>
											<th><div align="center"><?php echo $row['Perkara']; ?></div></th>
										<?php 
										} 
										?>
										</tr>
									</thead>
									<tbody>
									<?php 
									
									$i = 1; 
									do { 
									$z=mktime(00, 00, 00, $bulan3, $i, $tahun);
									$namahari = date("w", $z);
									$namahari2 = date("D", $z);
									$tarikh = date("Y-m-d",$z);
								
									$x=1; 
									?>
										<tr>
											<td style="display:none"><?php echo $x; ?></td>
											<td align="center"><?php echo $tarikh; ?></td>
											<td align="center"></td>
											<td align="center"></td>
											<td align="center"></td>
											<td align="center"></td>
											<td align="center"></td>
										</tr>
									<?php 
									$i++; } while ($i <= $hari);								
									?>
									</tbody>
								</table>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	?>
</div>
<div id="myModal" class="modal">
<center>
  <div class="modal-content">
    <div class="modal-header">
		<div class="col-lg-10">
      <h2><div align="center" id="hari"></div></h2>
	  </div>
	  <div class="col-lg-2">
      <span class="close">&times;</span>
		</div>
    </div>
    <div class="modal-body">
      <table class="table-responsive table-bordered">
		<tr>
			<td width="50%" align="middle"><h4>Subuh</h4></td>
			<td width="50%">
				<select class="form-control">
					<option value="">Sila Pilih:-</option>
					<option value="Imam">Imam</option>
					<option value="Bilal">Bilal</option>
					<option value="Siak">Siak</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="50%" align="middle"><h4>Zohor</h4></td>
			<td>
				<select class="form-control">
					<option value="">Sila Pilih:-</option>
					<option value="Imam">Imam</option>
					<option value="Bilal">Bilal</option>
					<option value="Siak">Siak</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="50%" align="middle"><h4>Asar</h4></td>
			<td>
				<select class="form-control">
					<option value="">Sila Pilih:-</option>
					<option value="Imam">Imam</option>
					<option value="Bilal">Bilal</option>
					<option value="Siak">Siak</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="50%" align="middle"><h4>Maghrib</h4></td>
			<td>
				<select class="form-control">
					<option value="">Sila Pilih:-</option>
					<option value="Imam">Imam</option>
					<option value="Bilal">Bilal</option>
					<option value="Siak">Siak</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="50%" align="middle"><h4>Isya</h4></td>
			<td>
				<select class="form-control">
					<option value="">Sila Pilih:-</option>
					<option value="Imam">Imam</option>
					<option value="Bilal">Bilal</option>
					<option value="Siak">Siak</option>
				</select>
			</td>
		</tr>
	  </table>
    </div>
    <div class="modal-footer">
      <button class="btn btn-default" onClick="closeModal()">Kembali</button>
    </div>
  </div>
</center>
</div>
<?php

if(isset($_POST['search']))
{
	$bulan = $_POST['month'];
	$year = $_POST['tahun'];

	

$date=$year."-".$bulan;
$month=date_format((date_create($date)),"F");
$strdate = strtoupper($strdate=date_format((date_create($date)),"F Y"));

/* draws a calendar */
function draw_calendar($bulan,$year){

	/* draw table */
	$calendar = '<table width="100%" cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Ahad','Isnin','Selasa','Rabu','Khamis','Jumaat','Sabtu');
	//$calendar.= '<tr class="calendar-row"><td align="middle" colspan="2" class="calendar-day-head" width="14%">'.implode('</td><td align="middle" colspan="2" class="calendar-day-head" width="14%">',$headings).'</td></tr>';
	$calendar.= '<tr class="calendar-row"><td align="middle" class="calendar-day-head" width="14%"><b>'.implode('</b></td><td align="middle" class="calendar-day-head" width="14%"><b>',$headings).'</b></td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$bulan,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$bulan,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		//$calendar.= '<td colspan="2" class="calendar-day-np"> </td>';
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
			
			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			
		$calendar.= '<td width="15%" class="calendar-day">';
		
		$tarikh=$year."-".$bulan."-".$list_day;
		$hari=date_format(date_create($tarikh),"l");
		
		$calendar.= '<div class="day-number"><button class="button button4 form-control" id="myBtn'.$list_day.'" onClick="myFunction(this.value)" value="'.$list_day.'">'.$list_day.'</button></div>';
		
		$calendar.= '</td>';
		
		//$calendar.= '<td width="7.15%" class="calendar-day">';
		
			/* add in the day number */
			//$calendar.= '<div class="day-number">'.$list_day.'</div>';
			
		//$calendar.= '</td>';
		
		//$calendar.= '<td width="7.15%" class="calendar-day">';
			
		//$calendar.= '</td>';
		
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			//$calendar.= '<td colspan="2" class="calendar-day-np"> </td>';
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	$calendar.='
';

	$calendar.='';
	
	/* all done, return result */
	return $calendar;
}

/* sample usages */

//echo '<center>';
//echo '<h2>'.$strdate.'</h2>';
//echo '<br>';
//echo '<table width="50%"><tr><td align="middle" width="50%">Hadir</td><td align="middle" width="50%">Tidak Hadir</td></tr><tr><td bgcolor="#85D84F"></td><td bgcolor="#FF3718"></td></tr></table>';
//echo '<br>';
//echo draw_calendar($bulan,$year);
//echo '</center>';
}
?>
<script>
function myFunction(src){
	
	var month = "<?php echo $month; ?>";
	var year = <?php echo $year; ?>;
	
	document.getElementById('hari').innerHTML = src+" "+month+" "+year;
	
	

var modal = document.getElementById("myModal");

var btn1 = document.getElementById("myBtn1");

var span = document.getElementsByClassName("close")[0];

btn1.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
}
function closeModal(){
	var modal = document.getElementById("myModal").style.display = "none";
}
</script>