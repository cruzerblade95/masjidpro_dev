<?php

	include("connection/connection.php");

	if(isset($_GET['jenis_baucer']))
	{
		$jenis_baucer=$_GET['jenis_baucer'];
	}

	$sql_tunai="SELECT * FROM baucer_bayaran WHERE id_masjid='$id_masjid' AND jenis_baucer='1'";
	$query_tunai=mysql_query($sql_tunai,$bd);
	$row_tunai=mysql_num_rows($query_tunai);

	$bil_tunai=$row_tunai+1;
	$tunai_baucer = str_pad($bil_tunai, 7, '0', STR_PAD_LEFT);
	
	$sql_bank="SELECT * FROM baucer_bayaran WHERE id_masjid='$id_masjid' AND jenis_baucer='2'";
	$query_bank=mysql_query($sql_bank,$bd);
	$row_bank=mysql_num_rows($query_bank);

	$bil_bank=$row_bank+1;
	$bank_baucer = str_pad($bil_bank, 7, '0', STR_PAD_LEFT);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<style>
table.baucer td{
border:1px solid grey;

}
</style>
<div id="test">
</div>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Baucer Bayaran</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kewangan">Menu Kewangan</a></li>
					<li><a href="utama.php?view=admin&action=senarai_baucer">Menu Baucer Bayaran</a></li>
					<li class="active">Baucer Bayaran</li>
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
					Jenis Baucer Bayaran
				</div>
				<div class="card-body">
					<div class="row" align="center">
						<div class="col-lg-12">
							<select class="form-control" style="width:150px;" name="jenis_baucer" onChange="document.location.href='utama.php?view=admin&action=baucerbayaran&jenis_baucer='+this.value">
								<option>Sila Pilih:-</option>
								<option value="1">Tunai</option>
								<option value="2">Bank/Cek</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if(isset($_GET['jenis_baucer']))
	{
		$jenis_baucer=$_GET['jenis_baucer'];
		if($jenis_baucer==1)
		{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Baucer Bayaran
				</div>
				<div class="card-body">
				<form action="admin/add_baucer.php" method="POST">
					<div class="row" align="center">
						<div class="col-lg-12">
							<h3><b><u>BAUCER BAYARAN</u></b></h3>
							<br>
							<?php echo $nama_masjid; ?>
						</div>
					</div>
					<br>
					<div class="row" align="right">
						<div class="col-lg-12">
							<table border="0">
								<tr>
									<td>NO BAUCER</td><td>:</td><td><input type="text" name="no_baucer" value="TUNAI<?php echo $tunai_baucer; ?>" style="width:150px" readonly></td>
								</tr>
								<tr>
									<td>TARIKH</td><td>:</td><td><input type="date" name="tarikh" style="width:150px" required></td>
								</tr>
							</table>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
							<table border="0" width="100%">
								<tr>
									<td>BAYAR KEPADA</td>
									<td>:</td>
									<td width="78%">
										<select required name="bayar_kepada" id="bayar_kepada" class="form-control" width="100%" onChange="document.location.href='utama.php?view=admin&action=baucerbayaran&jenis_baucer=<?php echo $jenis_baucer; ?>&id_pembekal='+this.value">
											<option></option>
											<?php
											$sql3="SELECT * FROM sej6x_data_pembekal WHERE id_masjid='$id_masjid'";
											$sqlquery3=mysql_query($sql3,$bd);
											
											while($data3=mysql_fetch_array($sqlquery3))
											{
											?>	
											<option value="<?php echo $data3['id_pembekal']; ?>" <?php if($data3['id_pembekal']==$_GET['id_pembekal']) { ?>selected<?php } ?>><?php echo $data3['nama_pembekal']; ?></option>
											<?php
											}
											?>
										</select>
									</td>
								</tr>
								<?php
								$sql_pembekal="SELECT* FROM sej6x_data_pembekal WHERE id_pembekal='$id_pembekal'";
								$query_pembekal=mysql_query($sql_pembekal,$bd);
								$pembekal=mysql_fetch_array($query_pembekal);
								?>
								<tr>
									<td>ALAMAT</td>
									<td>:</td>
									<td width="78%">
										<input type="text" readonly class="form-control" width="100%" value="<?php echo $pembekal['alamat']; ?>">
									</td>
								</tr>
								<?php
								if(isset($_GET['id_pembekal']))
								{
								?>
								<tr>
									<td>JENIS PEMBAYARAN</td>
									<td>:</td>
									<td width="78%">
										<select required name="id_bayaran" id="id_bayaran" class="form-control" width="100%">
											<option></option>
											<?php
											$sql4="SELECT * FROM sej6x_data_jenisbayaran WHERE id_masjid='$id_masjid' ORDER BY kategori ASC";
											$sqlquery4=mysql_query($sql4,$bd);
											
											while($data4=mysql_fetch_array($sqlquery4))
											{
											?>
											<option value="<?php echo $data4['id_bayaran']; ?>"><?php echo $data4['nama_bayaran']; ?></option>
											<?php
											}
											?>
										</select>
									</td>
								</tr>
								<?php
								}
								?>
							</table>
						</div>
					</div>
					<br>
					<?php 
					if(isset($_GET['id_pembekal']))
					{
					?>
					<div class="row">
						<div class="col-lg-12">
							<table border="0px" id="baucer" class="baucer" width="100%">
								<tr>
									<td style="border:1px solid grey" align="center" width="20%"><b>TARIKH<br>BEKALAN/PERKHIDMATAN</b></td>
									<td style="border:1px solid grey" align="center" width="13%"><b>INVOICE NO</b></td>
									<td style="border:1px solid grey" align="center" width="50%"><b>BUTIR-BUTIR BAYARAN</b></td>
									<td style="border:1px solid grey" align="center" width="13%"><b>JUMLAH(RM)</b></td>
									<td style="border:0px" width="4%"></td>
								</tr>
								<tr>
									<td style="border:1px solid grey" align="center"><input type="date" name="tarikh_baucer[]" style="width:100%" required></td>
									<td style="border:1px solid grey" align="center"><input type="text" name="invoice_baucer[]" style="width:100%" required></td>
									<td style="border:1px solid grey" align="center"><input type="text" name="butir_baucer[]" style="width:100%" required></td>
									<td style="border:1px solid grey" align="center"><input type="text" name="jumlah_baucer[]" style="width:100%" required onKeyup="addTotal()"></td>
									<td style="border:0px"><button class="btn btn-secondary btn-sm" onClick="insertRow()"><i class="fas fa-plus"></i></button></td>
								</tr>
							</table>
							<table border="0" width="100%">
								<tr>
									<td width="33%"></td>
									<td style="border:1px solid grey" width="50%"><b>JUMLAH BAYARAN (RM)</b></td>
									<td style="border:1px solid grey" width="13%"><div id="div_jumlah"></div></td>
									<td width="4%"></td>
								</tr>
							</table>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12" align="justify">
							Dengan ini di akui bahawa barangan/perkhidmatan yang tersebut di atas telah dibekalkan/disempurnakan
							mengikut spesifikasi dan bayaran berjumlah <b>RM</b> <b id="dis_jumlah"></b> sahaja adalah betul dan benar dan telah dibelanjakan.
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
							<table border="1" style="border:2px solid black" width="100%">
								<tr>
									<td align="center" width="33.33%">Disahkan Oleh:</td>
									<td align="center" width="33.33%">Pembayaran Oleh:</td>
									<td align="center" width="33.33%">Penerima Wang Tunai/Cek</td>
								</tr>
								<tr>
									<td><br><br><br><br>Tandatangan:</td>
									<td><br><br><br><br>Tandatangan:</td>
									<td><br><br><br><br>Tandatangan:</td>
								</tr>
								<tr>
									<td>
									<?php
									$sql1="SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_ajk=b.id_data AND a.jawatan='Pengerusi'";
									$sqlquery1=mysql_query($sql1,$bd);
									$data1=mysql_fetch_array($sqlquery1);
									echo $data1['nama_penuh'];
									echo "<br>";
									echo $data1['jawatan'];
									?>
									</td>
									<td>
									<?php
									$sql2="SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_ajk=b.id_data AND a.jawatan='Bendahari'";
									$sqlquery2=mysql_query($sql2,$bd);
									$data2=mysql_fetch_array($sqlquery2);
									echo $data2['nama_penuh'];
									echo "<br>";
									echo $data2['jawatan'];
									?>
									</td>
									<td></td>
								</tr>
							</table>
						</div>	
					</div>
					<br>
					<br>
					<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
					<input type="hidden" name="jenis_baucer" value="<?php echo $jenis_baucer; ?>">
					<input type="hidden" name="total_baucer" id="total_baucer">
					<div class="col-lg-12" align="center">
						<input type="submit" class="btn btn-success" value="Submit">
					</div>
					<?php
					}
					?>
				</form>
				</div>
			</div>
		</div>
	</div>
	<?php
		}
		else if($jenis_baucer==2)
		{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Baucer Bayaran
				</div>
				<div class="card-body">
				<form action="admin/add_baucer.php" method="POST">
					<div class="row" align="center">
						<div class="col-lg-12">
							<h3><b><u>BAUCER BAYARAN</u></b></h3>
							<br>
							<?php echo $nama_masjid; ?>
						</div>
					</div>
					<br>
					<div class="row" align="right">
						<div class="col-lg-12">
							<table border="0">
								<tr>
									<td>NO BAUCER</td><td>:</td><td><input type="text" name="no_baucer" value="BIMB<?php echo $bank_baucer; ?>" style="width:150px" readonly></td>
								</tr>
								<tr>
									<td>TARIKH</td><td>:</td><td><input type="date" name="tarikh" style="width:150px" required></td>
								</tr>
							</table>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
							<table border="0" width="100%">
								<tr>
									<td>BAYAR KEPADA</td>
									<td>:</td>
									<td width="78%">
										<select name="bayar_kepada" id="bayar_kepada" class="form-control" width="100%" onChange="document.location.href='utama.php?view=admin&action=baucerbayaran&jenis_baucer=<?php echo $jenis_baucer; ?>&id_pembekal='+this.value">
											<option></option>
											<?php
											$sql3="SELECT * FROM sej6x_data_pembekal WHERE id_masjid='$id_masjid'";
											$sqlquery3=mysql_query($sql3,$bd);
											
											while($data3=mysql_fetch_array($sqlquery3))
											{
											?>	
											<option value="<?php echo $data3['id_pembekal']; ?>" <?php if($data3['id_pembekal']==$_GET['id_pembekal']) { ?>selected<?php } ?>><?php echo $data3['nama_pembekal']; ?></option>
											<?php
											}
											?>
										</select>
									</td>
								</tr>
								<?php
								$sql_pembekal="SELECT* FROM sej6x_data_pembekal WHERE id_pembekal='$id_pembekal'";
								$query_pembekal=mysql_query($sql_pembekal,$bd);
								$pembekal=mysql_fetch_array($query_pembekal);
								?>
								<tr>
									<td>ALAMAT</td><td>:</td><td width="78%"><input type="text" readonly class="form-control" width="100%" value="<?php echo $pembekal['alamat']; ?>"></td>
								</tr>
								<?php
								if(isset($_GET['id_pembekal']))
								{
								?>
								<tr>
									<td>JENIS PEMBAYARAN</td>
									<td>:</td>
									<td width="78%">
										<select required name="id_bayaran" id="id_bayaran" class="form-control" width="100%">
											<option></option>
											<?php
											$sql4="SELECT * FROM sej6x_data_jenisbayaran WHERE id_masjid='$id_masjid' ORDER BY kategori ASC";
											$sqlquery4=mysql_query($sql4,$bd);
											
											while($data4=mysql_fetch_array($sqlquery4))
											{
											?>
											<option value="<?php echo $data4['id_bayaran']; ?>"><?php echo $data4['nama_bayaran']; ?></option>
											<?php
											}
											?>
										</select>
									</td>
								</tr>
								<?php
								}
								?>
							</table>
						</div>
					</div>
					<br>
					<?php
					if(isset($_GET['id_pembekal']))
					{
					?>
					<div class="row">
						<div class="col-lg-12">
							<table border="0px" id="baucer" class="baucer" width="100%">
								<tr>
									<td style="border:1px solid grey" align="center" width="20%"><b>TARIKH<br>BEKALAN/PERKHIDMATAN</b></td>
									<td style="border:1px solid grey" align="center" width="8%"><b>INVOICE NO</b></td>
									<td style="border:1px solid grey" align="center" width="8%"><b>SLIP BANK/NO CEK</b></td>
									<td style="border:1px solid grey" align="center" width="50%"><b>BUTIR-BUTIR BAYARAN</b></td>
									<td style="border:1px solid grey" align="center" width="10%"><b>JUMLAH(RM)</b></td>
									<td style="border:0px" width="4%"></td>
								</tr>
								<tr>
									<td style="border:1px solid grey" align="center"><input type="date" name="tarikh_baucer[]" style="width:100%" required></td>
									<td style="border:1px solid grey" align="center"><input type="text" name="invoice_baucer[]" style="width:100%" required></td>
									<td style="border:1px solid grey" align="center"><input type="text" name="cek_baucer[]" style="width:100%" required></td>
									<td style="border:1px solid grey" align="center"><input type="text" name="butir_baucer[]" style="width:100%" required></td>
									<td style="border:1px solid grey" align="center"><input type="text" name="jumlah_baucer[]" style="width:100%" required onKeyup="addTotal()"></td>
									<td style="border:0px"><button class="btn btn-secondary btn-sm" onClick="insertRow()"><i class="fas fa-plus"></i></button></td>
								</tr>
							</table>
							<table border="0" width="100%">
								<tr>
									<td width="36%"></td>
									<td style="border:1px solid grey" width="50%"><b>JUMLAH BAYARAN (RM)</b></td>
									<td style="border:1px solid grey" width="10%"><div id="div_jumlah"></div></td>
									<td width="4%"></td>
								</tr>
							</table>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12" align="justify">
							Dengan ini di akui bahawa barangan/perkhidmatan yang tersebut di atas telah dibekalkan/disempurnakan
							mengikut spesifikasi dan bayaran berjumlah <b>RM</b> <b id="dis_jumlah"></b> sahaja adalah betul dan benar dan telah dibelanjakan.
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
							<table border="1" style="border:2px solid black" width="100%">
								<tr>
									<td align="center" width="33.33%">Disahkan Oleh:</td>
									<td align="center" width="33.33%">Pembayaran Oleh:</td>
									<td align="center" width="33.33%">Penerima Wang Tunai/Cek</td>
								</tr>
								<tr>
									<td><br><br><br><br>Tandatangan:</td>
									<td><br><br><br><br>Tandatangan:</td>
									<td><br><br><br><br>Tandatangan:</td>
								</tr>
								<tr>
									<td>
									<?php
									$sql1="SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_ajk=b.id_data AND a.jawatan='Pengerusi'";
									$sqlquery1=mysql_query($sql1,$bd);
									$data1=mysql_fetch_array($sqlquery1);
									echo $data1['nama_penuh'];
									echo "<br>";
									echo $data1['jawatan'];
									?>
									</td>
									<td>
									<?php
									$sql2="SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_ajk=b.id_data AND a.jawatan='Bendahari'";
									$sqlquery2=mysql_query($sql2,$bd);
									$data2=mysql_fetch_array($sqlquery2);
									echo $data2['nama_penuh'];
									echo "<br>";
									echo $data2['jawatan'];
									?>
									</td>
									<td></td>
								</tr>
							</table>
						</div>	
					</div>
					<br>
					<br>
					<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
					<input type="hidden" name="jenis_baucer" value="<?php echo $jenis_baucer; ?>">
					<input type="hidden" name="total_baucer" id="total_baucer">
					<div class="col-lg-12" align="center">
						<input type="submit" class="btn btn-success" value="Submit">
					</div>
					<?php
					}
					?>
				</form>
				</div>
			</div>
		</div>
	</div>
	<?php
		}
	}
	?>
</div>
<?php
if($jenis_baucer==1)
{
?>
<script>
function insertRow(){
	var table=document.getElementById("baucer");
	var row=table.insertRow(table.rows.length);
	var bil=(table.rows.length)-1;

	var cell1=row.insertCell(0);
	cell1.innerHTML = "<input type='date' name='tarikh_baucer[]' style='width:100%' required>";

	cell1=row.insertCell(1);
	cell1.innerHTML = "<input type='text' name='invoice_baucer[]' style='width:100%' required></td>";

	cell1=row.insertCell(2);
	cell1.innerHTML = "<input type='text' name='butir_baucer[]' style='width:100%' required>";
	
	cell1=row.insertCell(3);
	cell1.innerHTML = "<input type='text' name='jumlah_baucer[]' style='width:100%' required onKeyup='addTotal()'>";

	cell1=row.insertCell(4);
	cell1.innerHTML = "<button class='btn btn-danger btn-sm' onclick='removeRow(this);'><i class='fas fa-minus-circle'></i></button>"; 
}
function removeRow(src){
	var oRow = src.parentElement.parentElement;  
	document.all("baucer").deleteRow(oRow.rowIndex);
} 
function addTotal(){
	var total=0;
	var jumlah=document.getElementsByName('jumlah_baucer[]');
	var bil=jumlah.length;
	//document.getElementById('test').innerHTML = jumlah.length;
	
	var i;
	for(i=0;i<bil;i++)
	{
		var nilai = document.getElementsByName('jumlah_baucer[]')[i].value;
		//document.getElementById('test').innerHTML = nilai;
		if(nilai=="")
		{
			nilai=0;
		}
		parseTotal = parseFloat(total).toFixed(2)*1;
		parseNilai = parseFloat(nilai).toFixed(2)*1;
		total = parseTotal + parseNilai;
	}
	
	document.getElementById('div_jumlah').innerHTML = parseFloat(total).toFixed(2);
	document.getElementById('dis_jumlah').innerHTML = parseFloat(total).toFixed(2);
	document.getElementById('total_baucer').value = parseFloat(total).toFixed(2);
}
$(document).ready(function () {
      $('bayar_kepada').selectize({
          sortField: 'text'
      });
  });
</script>
<?php
}
else if($jenis_baucer==2)
{
?>
<script>
function insertRow(){
	var table=document.getElementById("baucer");
	var row=table.insertRow(table.rows.length);
	var bil=(table.rows.length)-1;

	var cell1=row.insertCell(0);
	cell1.innerHTML = "<input type='date' name='tarikh_baucer[]' style='width:100%' required>";

	cell1=row.insertCell(1);
	cell1.innerHTML = "<input type='text' name='invoice_baucer[]' style='width:100%' required></td>";

	cell1=row.insertCell(1);
	cell1.innerHTML = "<input type='text' name='cek_baucer[]' style='width:100%' required></td>";
	
	cell1=row.insertCell(3);
	cell1.innerHTML = "<input type='text' name='butir_baucer[]' style='width:100%' required>";
	
	cell1=row.insertCell(4);
	cell1.innerHTML = "<input type='text' name='jumlah_baucer[]' style='width:100%' required onKeyup='addTotal()'>";

	cell1=row.insertCell(5);
	cell1.innerHTML = "<button class='btn btn-danger btn-sm' onclick='removeRow(this);'><i class='fas fa-minus-circle'></i></button>"; 
}
function removeRow(src){
	var oRow = src.parentElement.parentElement;  
	document.all("baucer").deleteRow(oRow.rowIndex);
} 
function addTotal(){
	var total=0;
	var jumlah=document.getElementsByName('jumlah_baucer[]');
	var bil=jumlah.length;
	//document.getElementById('test').innerHTML = jumlah.length;
	
	var i;
	for(i=0;i<bil;i++)
	{
		var nilai = document.getElementsByName('jumlah_baucer[]')[i].value;
		//document.getElementById('test').innerHTML = nilai;
		if(nilai=="")
		{
			nilai=0;
		}
		parseTotal = parseFloat(total).toFixed(2)*1;
		parseNilai = parseFloat(nilai).toFixed(2)*1;
		total = parseTotal + parseNilai;
	}
	
	document.getElementById('div_jumlah').innerHTML = parseFloat(total).toFixed(2);
	document.getElementById('dis_jumlah').innerHTML = parseFloat(total).toFixed(2);
	document.getElementById('total_baucer').value = parseFloat(total).toFixed(2);
}
$(document).ready(function () {
      $('bayar_kepada').selectize({
          sortField: 'text'
      });
  });
</script>
<?php
}
?>