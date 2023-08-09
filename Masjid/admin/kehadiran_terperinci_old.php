<style type="text/css">
@media print {
    #printbtn {
        display :  none;
    }
}
</style>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Kehadiran Pegawai Masjid</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kehadiran">Menu Kehadiran</a></li>
					<li class="active">Kehadiran Pegawai Masjid</li>
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
							<form id="kehadiran_terperinci" name="kehadiran_terperinci" method="POST" action="<?php echo $PHP_SELF;?>">                              
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
									<input class="form-control" placeholder="Contoh: 2018" name="tahun" id="tahun" required>                                          
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
	<div class="row">
        <div class="col-lg-12">
            <div class="card">
			<div class="card-header">
				Rekod Kehadiran
				<button id="printbtn" onclick="myFunction()" class="btn btn-info">Cetak</button>
				<!-- <script>
				function myFunction() {
				window.print();
				}
				</script> -->
                <script type="text/javascript">
                    function myFunction() {
                        var printContents = document.getElementById('div_print').innerHTML;
                        var originalContents = document.body.innerHTML;
                        document.body.innerHTML = printContents;
                        window.print();
                        document.body.innerHTML = originalContents;
                    }
                </script>
			</div>
			<!-- /.panel-heading -->
			<div class="card-body" id="div_print">
			  <div class="table-responsive">
				
				 <?php 
			  include("connection/connection.php");
			  include("connection/connection_kehadiran.php");
			   if(isset($_POST['search']))
			  { 
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
				
				$id = $_GET['id_pegawai'];
				$sql_search="SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', a.id_fingerprint 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', c.id_fingerprint 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID";
			  
			  $result = mysql_query($sql_search,$bd) or die ("Error :".mysql_error());
			  ?>
			  <table width="400" border="0" cellspacing="0" cellpadding="5" align="center">
				<tr>
				<th colspan="2" align="center"><br />
				<div align="center">Maklumat Pegawai Masjid</div><br /></th>
				</tr>
				<?php $row = mysql_fetch_array($result); ?>
				<tr>
				<td align="left"><strong>Nama</strong></td>
				<td>  <?php echo $row['nama_penuh']; ?></td>
				</tr>
				<tr>
				<td align="left"><strong>Jawatan</strong></td>
				<td>  <?php echo $row['jawatan']; ?></td>
				</tr>
				<tr>
				<td align="left"><strong>Bulan</strong></td>
				<td>  <?php echo $bulan2; ?></td>
				</tr>
				 <tr>
				<td align="left"><strong>Tahun</strong></td>
				<td>  <?php echo $tahun; ?></td>
				</tr>
				<?php $DIN=$row['id_fingerprint'];?>
			</table><br />  
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
						?>
						<?php while($row = mysql_fetch_assoc($result2)){ ?>
							  <th><div align="center"><?php echo $row['Perkara']; ?></div></th>
						<?php } ?>
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
					
						?>
					   
						<?php $x=1; ?>
					 
						<tr>
						   <td style="display:none"><?php echo $x; ?></td>
						   <td align="center"><?php echo $tarikh; ?></td>
						   <?php
						   
						   $sqljadual = "SELECT * FROM sej6x_data_jadual WHERE id_pegawai='$id' AND tarikh='$tarikh' AND solat='Subuh'";
						   $query_jadual = mysql_query($sqljadual,$bd);
						   $row_jadual=mysql_num_rows($query_jadual);
						   if($row_jadual>0)
						   {
						   
						   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Subuh'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1==0)
							{
								echo "<td bgcolor='#FF3232' align='center'></td>";
							}
							elseif($row1>0)
							{
								echo "<td align='center'>".$data1['Waktu Hadir']."</td>";
							}
						   }
						   elseif($row_jadual==0)
						   {
							   
							   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Subuh'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1>0)
							{
								echo "<td bgcolor='#44FF62' align='center'>".$data1['Waktu Hadir']."</td>";
							}
							else if($row1==0)
							{
								echo "<td align='center'></td>";
							}
						   }
						   ?>
						   <?php
						   
						   $sqljadual = "SELECT * FROM sej6x_data_jadual WHERE id_pegawai='$id' AND tarikh='$tarikh' AND solat='Zohor'";
						   $query_jadual = mysql_query($sqljadual,$bd);
						   $row_jadual=mysql_num_rows($query_jadual);
						   if($row_jadual>0)
						   {
						   
						   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Zohor'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1==0)
							{
								echo "<td bgcolor='#FF3232' align='center'></td>";
							}
							elseif($row1>0)
							{
								echo "<td align='center'>".$data1['Waktu Hadir']."</td>";
							}
						   }
						   elseif($row_jadual==0)
						   {
							   
							   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Zohor'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1>0)
							{
								echo "<td bgcolor='#44FF62' align='center'>".$data1['Waktu Hadir']."</td>";
							}
							else if($row1==0)
							{
								echo "<td align='center'></td>";
							}
						   }
						   ?>
						   <?php
						   
						   $sqljadual = "SELECT * FROM sej6x_data_jadual WHERE id_pegawai='$id' AND tarikh='$tarikh' AND solat='Asar'";
						   $query_jadual = mysql_query($sqljadual,$bd);
						   $row_jadual=mysql_num_rows($query_jadual);
						   if($row_jadual>0)
						   {
						   
						   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Asar'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1==0)
							{
								echo "<td bgcolor='#FF3232' align='center'></td>";
							}
							elseif($row1>0)
							{
								echo "<td align='center'>".$data1['Waktu Hadir']."</td>";
							}
						   }
						   elseif($row_jadual==0)
						   {
							   
							   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Asar'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1>0)
							{
								echo "<td bgcolor='#44FF62' align='center'>".$data1['Waktu Hadir']."</td>";
							}
							else if($row1==0)
							{
								echo "<td align='center'></td>";
							}
						   }
						   ?>
						   <?php
						   
						   $sqljadual = "SELECT * FROM sej6x_data_jadual WHERE id_pegawai='$id' AND tarikh='$tarikh' AND solat='Maghrib'";
						   $query_jadual = mysql_query($sqljadual,$bd);
						   $row_jadual=mysql_num_rows($query_jadual);
						   if($row_jadual>0)
						   {
						   
						   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Maghrib'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1==0)
							{
								echo "<td bgcolor='#FF3232' align='center'></td>";
							}
							elseif($row1>0)
							{
								echo "<td align='center'>".$data1['Waktu Hadir']."</td>";
							}
						   }
						   elseif($row_jadual==0)
						   {
							   
							   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Maghrib'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1>0)
							{
								echo "<td bgcolor='#44FF62' align='center'>".$data1['Waktu Hadir']."</td>";
							}
							else if($row1==0)
							{
								echo "<td align='center'></td>";
							}
						   }
						   ?>
						   <?php
						   
						   $sqljadual = "SELECT * FROM sej6x_data_jadual WHERE id_pegawai='$id' AND tarikh='$tarikh' AND solat='Isya'";
						   $query_jadual = mysql_query($sqljadual,$bd);
						   $row_jadual=mysql_num_rows($query_jadual);
						   if($row_jadual>0)
						   {
						   
						   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Isyak'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1==0)
							{
								echo "<td bgcolor='#FF3232' align='center'></td>";
							}
							elseif($row1>0)
							{
								echo "<td align='center'>".$data1['Waktu Hadir']."</td>";
							}
						   }
						   elseif($row_jadual==0)
						   {
							   
							   $sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a WHERE perkara='Solat Isyak'";
							$resultspecial = mysql_query($sql_waktu2,$bd) or die ("Error :".mysql_error());
						   $waktu_solat=mysql_fetch_array($resultspecial);
							$waktu_mula=$tarikh." ".$waktu_solat['Waktu Mula'];
						   $waktu_tamat=$tarikh." ".$waktu_solat['Waktu Tamat'];
						   
							$sql1= "SELECT DATE_FORMAT(Clock, '%r') 'Waktu Hadir' FROM $kod_masjid WHERE DIN='$DIN' AND Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s') GROUP BY year(Clock), month(Clock), day(Clock), hour(Clock)";
							$sqlquery1=mysql_query($sql1,$conn);
							$row1=mysql_num_rows($sqlquery1);
							$data1=mysql_fetch_array($sqlquery1);
							if($row1>0)
							{
								echo "<td bgcolor='#44FF62' align='center'>".$data1['Waktu Hadir']."</td>";
							}
							else if($row1==0)
							{
								echo "<td align='center'></td>";
							}
						   }
						   ?>
						</tr>

			<?php $i++; } while ($i <= $hari);
			
		
			}
				
			?>
		   
			</tbody>

				  </table>

				</div>
				<!-- /.table-responsive -->
			 <div class="well">
					   
		   <strong>Pengesahan Pengerusi Masjid,</strong>
			
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		   
		   <strong>---------------------------------------------</strong>
			<br>
   
					</div>     
				
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
</div>           
             