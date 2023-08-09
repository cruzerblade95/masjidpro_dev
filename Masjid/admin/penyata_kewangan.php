<?php

	include("connection/connection.php");

	if(isset($_GET['tahun']))
	{
		$tahun=$_GET['tahun'];
		
		$tarikh_awal=$tahun."-01-01";
		$tarikh_akhir=$tahun."-12-31";
	}
	if(isset($_GET['bulan']))
	{
		$bulan=$_GET['bulan'];
		$date=$tahun."-".$bulan;
		$date=date_create($date);
		$month=date_format($date,"F");
		
		$total_days=cal_days_in_month(CAL_GREGORIAN,$bulan,$tahun);
		
		$tarikh_awal=$tahun."-".$bulan."-01";
		$tarikh_akhir=$tahun."-".$bulan."-".$total_days;
	}
	
	$sql1="SELECT * FROM sej6x_data_jenistabung WHERE id_masjid='$id_masjid' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
	$sqlquery1=mysql_query($sql1,$bd);
	$row1=mysql_num_rows($sqlquery1);
	
	$sql5="SELECT * FROM sej6x_data_jeniskutipan WHERE id_masjid='$id_masjid' AND kategori='1'";
	$sqlquery5=mysql_query($sql5,$bd);
	$row5=mysql_num_rows($sqlquery5);
	
	$row_a1=$row1+$row5;
	
	$sql2="SELECT * FROM sej6x_data_jeniskutipan WHERE id_masjid='$id_masjid' AND kategori='2'";
	$sqlquery2=mysql_query($sql2,$bd);
	$row2=mysql_num_rows($sqlquery2);
	
	$sql8="SELECT * FROM sej6x_data_jeniskutipan WHERE id_masjid='$id_masjid' AND kategori='3'";
	$sqlquery8=mysql_query($sql8,$bd);
	$row8=mysql_num_rows($sqlquery8);
	
	$sql3="SELECT * FROM sej6x_data_jenisbayaran WHERE id_masjid='$id_masjid' AND kategori='1'";
	$sqlquery3=mysql_query($sql3,$bd);
	$row3=mysql_num_rows($sqlquery3);
	
	$sql10="SELECT * FROM sej6x_data_jenisbayaran WHERE id_masjid='$id_masjid' AND kategori='2'";
	$sqlquery10=mysql_query($sql10,$bd);
	$row10=mysql_num_rows($sqlquery10);
	
	$row_ultiliti=$row3+$row10;
	
	$sql12="SELECT * FROM sej6x_data_jenisbayaran WHERE id_masjid='$id_masjid' AND kategori='3'";
	$sqlquery12=mysql_query($sql12,$bd);
	$row12=mysql_num_rows($sqlquery12);
	
	$sql14="SELECT * FROM sej6x_data_jenisbayaran WHERE id_masjid='$id_masjid' AND kategori='4'";
	$sqlquery14=mysql_query($sql14,$bd);
	$row14=mysql_num_rows($sqlquery14);
	
	$sql18="SELECT * FROM sej6x_data_jenisbayaran WHERE id_masjid='$id_masjid' AND kategori='5'";
	$sqlquery18=mysql_query($sql18,$bd);
	$row18=mysql_num_rows($sqlquery18);
	
	$sql16="SELECT * FROM sej6x_data_jenisbayaran WHERE id_masjid='$id_masjid' AND kategori='6'";
	$sqlquery16=mysql_query($sql16,$bd);
	$row16=mysql_num_rows($sqlquery16);
	
	$row_baki=$row18+$row16+4;
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Penyata Kewangan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=kewangan">Menu Kewangan</a></li>
					<li class="active">Penyata Kewangan</li>
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
									<label>Tahun</label>
									<input class="form-control" placeholder="Contoh: 2018" name="tahun" id="tahun" <?php if(isset($_GET['tahun'])) { ?> value="<?php echo $tahun; ?>" <?php } ?> required onChange="document.location.href='utama.php?view=admin&action=penyata_kewangan&tahun='+this.value">                                          
								</div>
							</div>
							<?php 
							if(isset($_GET['tahun']))
							{
							?>								
							<div class="col-lg-3">                                   
								<div class="form-group">
									<label>Bulan</label>
									<select class="form-control" name="month" id="month" onChange="document.location.href='utama.php?view=admin&action=penyata_kewangan&tahun=<?php echo $tahun; ?>&bulan='+this.value">
										<option>Sila Pilih Bulan</option>
										<option value="01" <?php if ($bulan=="01"){echo "selected='SELECTED'";}?>>Januari</option>
										<option value="02" <?php if ($bulan=="02"){echo "selected='SELECTED'";}?>>Februari</option>   
										<option value="03" <?php if ($bulan=="03"){echo "selected='SELECTED'";}?>>Mac</option>   
										<option value="04" <?php if ($bulan=="04"){echo "selected='SELECTED'";}?>>April</option>   
										<option value="05" <?php if ($bulan=="05"){echo "selected='SELECTED'";}?>>Mei</option>   
										<option value="06" <?php if ($bulan=="06"){echo "selected='SELECTED'";}?>>Jun</option>   
										<option value="07" <?php if ($bulan=="07"){echo "selected='SELECTED'";}?>>Julai</option>   
										<option value="08" <?php if ($bulan=="08"){echo "selected='SELECTED'";}?>>Ogos</option>   
										<option value="09" <?php if ($bulan=="09"){echo "selected='SELECTED'";}?>>September</option>   
										<option value="10" <?php if($bulan=="10"){echo "selected='SELECTED'";}?>>Oktober</option>   
										<option value="11" <?php if($bulan=="11"){echo "selected='SELECTED'";}?>>November</option>   
										<option value="12" <?php if($bulan=="12"){echo "selected='SELECTED'";}?>>Disember</option>   
									</select>                                                                                                                            
								</div>    
							</div>
							<?php
							}
							?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if(isset($_GET['tahun']))
	{
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Penyata Kewangan
				</div>
				<div class="card-body">
					<div class="row" align="center">
						<div class="col-lg-12">
							<h4><b>LAPORAN KEWANGAN <?php echo $nama_masjid; ?><br>
							<?php
							if(isset($_GET['tahun']) AND isset($_GET['bulan']))
							{
							?>
							BAGI TEMPOH 01 <?php echo $month." ".$tahun; ?> HINGGA <?php echo $total_days." ".$month." ".$tahun; ?></b></h4>
							<?php
							}
							else if(isset($_GET['tahun']))
							{
							?>
							BAGI TEMPOH 01 JANUARY <?php echo $tahun; ?> HINGGA 31 DECEMBER <?php echo $tahun ; ?></b></h4>
							<?php	
							}
							?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12">
							<table border="1" width="100%">
								<tr>
									<td width="50%">
										<table border="1" width="100%">
											<tr>
												<td align="center" width="6%"></td>
												<td align="center" width="74%">PENDAPATAN</td>
												<td align="center" width="20%">JUMLAH<br>(RM)</td>
											</tr>
											<!-- <tr>
												<td align="center" width="6%"></td>
												<td align="center" width="74%">Baki Tabung <?php echo $nama_masjid; ?> 01.01.<?php echo $tahun; ?></td>
												<td align="center" width="20%"></td>
											</tr> -->	
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" width="6%">A</td>
												<td width="74%">&nbsp;<i>Tabung-Tabung dan Kutipan</i></td>
												<td align="center" width="20%"></td>
											</tr>
											<?php
											$a=1;
											while($data1=mysql_fetch_array($sqlquery1))
											{
											?>
											<tr>
												<td align="center" width="6%"><?php echo $a; ?></td>
												<td width="74%">&nbsp;<?php echo $data1['nama_tabung']; ?></td>
												<td width="20%" align="center"><?php echo $data1['amaun_tabung']; ?></td>
											</tr>
											<?php
											$a++;
											}
											$b=$row1+1;
											
											while($data5=mysql_fetch_array($sqlquery5))
											{
											?>
											<tr>
												<td align="center" width="6%"><?php echo $b; ?></td>
												<td width="74%">&nbsp;<?php echo $data5['nama_kutipan']; ?></td>
												<td width="20%" align="center">
													<?php
													$amaun_kutipan=0;
													$id_kutipan=$data5['id_kutipan'];
													
													$sql6="SELECT * FROM sej6x_data_resit WHERE id_masjid='$id_masjid' AND id_jeniskutipan='$id_kutipan'  AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
													$sqlquery6=mysql_query($sql6,$bd);
													while($data6=mysql_fetch_array($sqlquery6))
													{
														$amaun_kutipan=$amaun_kutipan+$data6['amaun'];
													}
													echo $amaun_kutipan=number_format($amaun_kutipan,2,'.','');
													?>
												</td>
											</tr>
											<?php
											$b++;
											}
											for($a1=$row_a1;$a1<$row_ultiliti;$a1++)
											{
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<?php
											}
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" width="6%">B</td>
												<td width="74%">&nbsp;<i>Aktiviti Ekonomi</i></td>
												<td align="center" width="20%"></td>
											</tr>
											<?php
											$b=1;
											while($data2=mysql_fetch_array($sqlquery2))
											{
											?>
											<tr>
												<td width="6%" align="center"><?php echo $b; ?></td>
												<td width="74%">&nbsp;<?php echo $data2['nama_kutipan']; ?></td>
												<td width="20%" align="center">
													<?php
													$id_kutipan=$data2['id_kutipan'];
													
													$sql7="SELECT * FROM sej6x_data_resit WHERE id_masjid='$id_masjid' AND id_jeniskutipan='$id_kutipan' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
													$sqlquery7=mysql_query($sql7,$bd);
													
													$amaun_ekonomi=0;
													
													while($data7=mysql_fetch_array($sqlquery7))
													{
														$amaun_ekonomi=$amaun_ekonomi+$data7['amaun'];
													}
													
													echo $amaun_ekonomi=number_format($amaun_ekonomi,2,'.','');
													?>
												</td>
											</tr>
											<?php
											$b++;
											}
											?>
											<?php
											for($b1=$row2;$b1<$row12;$b1++)
											{
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<?php
											}
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" width="6%">C</td>
												<td width="74%">&nbsp;<i>Lain-Lain Pendapatan</i></td>
												<td align="center" width="20%"></td>
											</tr>
											<?php
											$c=1;
											while($data8=mysql_fetch_array($sqlquery8))
											{
											?>
											<tr>
												<td width="6%" align="center"><?php echo $c; ?></td>
												<td width="74%">&nbsp;<?php echo $data8['nama_kutipan']; ?></td>
												<td width="20%" align="center">
													<?php
													$id_kutipan=$data8['id_kutipan'];
													
													$sql9="SELECT * FROM sej6x_data_resit WHERE id_masjid='$id_masjid' AND id_jeniskutipan='$id_kutipan' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
													$sqlquery9=mysql_query($sql9,$bd);
													
													$amaun_lain=0;
													
													while($data9=mysql_fetch_array($sqlquery9))
													{
														$amaun_lain=$amaun_lain+$data9['amaun'];
													}
													
													echo $amaun_lain=number_format($amaun_lain,2,'.','');
													?>
												</td>
											</tr>
											<?php
											$c++;
											}
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<?php
											for($z=0;$z<$row_baki;$z++)
											{
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74&">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<?php
											}
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74&">&nbsp;<i>Jumlah Pendapatan</i></td>
												<td width="20%" align="center">&nbsp;</td>
											</tr>
										</table>
									</td>
									<td width="50%">
										<table border="1" width="100%">
											<tr>
												<td align="center" width="6%"></td>
												<td align="center" width="74%">BERBELANJAAN</td>
												<td align="center" width="20%">JUMLAH<br>(RM)</td>
											</tr>
											<!-- <tr>
												<td align="center" width="3%"></td>
												<td align="center" width="37%">Baki dibank/tangan Tabung Masjid 31.12.<?php echo $tahun; ?></td>
												<td align="center" width="10%"></td>
											</tr> -->
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" width="6%">A</td>
												<td width="74%">&nbsp;<i>Utiliti dan Penyelenggaraan</i></td>
												<td align="center" width="20%"></td>
											</tr>
											<?php
											$d=1;
											while($data3=mysql_fetch_array($sqlquery3))
											{
											?>
											<tr>
												<td align="center" width="6%"><?php echo $d; ?></td>
												<td width="74%">&nbsp;<?php echo $data3['nama_bayaran']; ?></td>
												<td align="center" width="20%">
												<?php
												$id_bayaran=$data3['id_bayaran'];
												$sql4="SELECT * FROM sej6x_data_baucer WHERE id_bayaran='$id_bayaran' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
												$sqlquery4=mysql_query($sql4,$bd);
												$jumlah4=0;
												while($data4=mysql_fetch_array($sqlquery4))
												{
													$jumlah4=$jumlah4+$data4['jumlah'];
												}
												echo $jumlah4=number_format($jumlah4,2,'.','');
												?>	
												</td>
											</tr>
											<?php
											$d++;
											}
											$e=$row3+1;
											while($data10=mysql_fetch_array($sqlquery10))
											{
											?>
											<tr>
												<td align="center" width="6%"><?php echo $e; ?></td>
												<td width="74%">&nbsp;<?php echo $data10['nama_bayaran']; ?></td>
												<td align="center" width="20%">
												<?php
												$id_bayaran=$data10['id_bayaran'];
												$sql11="SELECT * FROM sej6x_data_baucer WHERE id_bayaran='$id_bayaran' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
												$sqlquery11=mysql_query($sql11,$bd);
												$jumlah11=0;
												while($data11=mysql_fetch_array($sqlquery11))
												{
													$jumlah11=$jumlah11+$data11['jumlah'];
												}
												echo $jumlah11=number_format($jumlah11,2,'.','');
												?>	
												</td>
											</tr>
											<?php
											$e++;
											}
											for($e1=$row_ultiliti;$e1<$row_a1;$e1++)
											{
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<?php
											}
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" width="6%">B</td>
												<td width="74%">&nbsp;<i>Pengurusan</i></td>
												<td align="center" width="20%"></td>
											</tr>
											<?php
											$f=1;
											while($data12=mysql_fetch_array($sqlquery12))
											{
											?>
											<tr>
												<td align="center" width="6%"><?php echo $f; ?></td>
												<td width="74%">&nbsp;<?php echo $data12['nama_bayaran']; ?></td>
												<td width="20%" align="center">
												<?php
												$id_bayaran=$data12['id_bayaran'];
												
												$sql13="SELECT * FROM sej6x_data_baucer WHERE id_bayaran='$id_bayaran' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
												$sqlquery13=mysql_query($sql13,$bd);
												$jumlah13=0;
												while($data13=mysql_fetch_array($sqlquery13))
												{
													$jumlah13=$jumlah13+$data13['jumlah'];
												}
												echo $jumlah13=number_format($jumlah13,2,'.','');
												?>	
												</td>
											</tr>
											<?php
											}
											?>
											<?php
											for($f1=1;$f1<$row2;$f1++)
											{
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<?php
											}
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" width="6%">C</td>
												<td width="74%">&nbsp;<i>Aktiviti Pengimarahan</i></td>
												<td align="center" width="20%"></td>
											</tr>
											<?php
											$g=1;
											
											while($data14=mysql_fetch_array($sqlquery14))
											{
											?>
											<tr>
												<td align="center" width="6%"><?php echo $g; ?></td>
												<td width="74%">&nbsp;<?php echo $data14['nama_bayaran']; ?></td>
												<td align="center">
												<?php
												$id_bayaran=$data14['id_bayaran'];
												
												$sql15="SELECT * FROM sej6x_data_baucer WHERE id_bayaran='$id_bayaran' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
												$sqlquery15=mysql_query($sql15,$bd);
												$jumlah15=0;
												while($data15=mysql_fetch_array($sqlquery15))
												{
													$jumlah15=$jumlah15+$data15['jumlah'];
												}
												echo $jumlah15=number_format($jumlah15,2,'.','');
												?>
												</td>
											</tr>
											<?php
											$g++;
											}
											?>
											<?php
											for($g1=$row14;$g1<$row8;$g1++)
											{
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<?php
											}
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" width="6%">D</td>
												<td width="74%">&nbsp;<i>Peralatan & Aset</i></td>
												<td align="center" width="20%"></td>
											</tr>
											<?php
											$i=1;
											
											while($data18=mysql_fetch_array($sqlquery18))
											{
											?>
											<tr>
												<td align="center" width="6%"><?php echo $i; ?></td>
												<td width="74%">&nbsp;<?php echo $data18['nama_bayaran']; ?></td>
												<td width="20%" align="center">
												<?php
												$id_bayaran=$data18['id_bayaran'];
												
												$sql19="SELECT * FROM sej6x_data_baucer WHERE id_bayaran='$id_bayaran' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
												$sqlquery19=mysql_query($sql19,$bd);
												$jumlah19=0;
												while($data19=mysql_fetch_array($sqlquery19))
												{
													$jumlah19=$jumlah19+$data19['jumlah'];
												}
												echo $jumlah19=number_format($jumlah19,2,'.','');
												?>
												</td>
											<tr>
											<?php
											$i++;
											}
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<tr>
												<td align="center" width="6%">E</td>
												<td width="74%">&nbsp;<i>Lain-Lain Perbelanjaan</i></td>
												<td align="center" width="20%"></td>
											</tr>
											<?php
											$j=1;
											
											while($data16=mysql_fetch_array($sqlquery16))
											{
											?>
											<tr>
												<td align="center" width="6%"><?php echo $j; ?></td>
												<td width="74&">&nbsp;<?php echo $data16['nama_bayaran']; ?></td>
												<td align="center" width="20%">
												<?php
												$id_bayaran=$data16['id_bayaran'];
												
												$sql17="SELECT * FROM sej6x_data_baucer WHERE id_bayaran='$id_bayaran' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
												$sqlquery17=mysql_query($sql17,$bd);
												$jumlah17=0;
												while($data17=mysql_fetch_array($sqlquery17))
												{
													$jumlah17=$jumlah17+$data17['jumlah'];
												}
												echo $jumlah17=number_format($jumlah17,2,'.','');
												?>
												</td>
											</tr>
											<?php
											$j++;
											}											
											?>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;</td>
												<td width="20%">&nbsp;</td>
											</tr>
											<tr>
												<td width="6%">&nbsp;</td>
												<td width="74%">&nbsp;<i>Jumlah Perbelanjaan</i></td>
												<td width="20%" align="center" id="jumlah_belanja"></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
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
<script>
//Perbelanjaan
<?php 
$sql_belanja="SELECT b.jumlah 'jumlah' FROM baucer_bayaran a, sej6x_data_baucer b WHERE a.id_masjid='$id_masjid' AND a.id_baucer=b.id_baucer AND b.tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir'";
$query_belanja=mysql_query($sql_belanja,$bd);
$jumlah_belanja=0;
while($belanja=mysql_fetch_array($query_belanja))
{
	$jumlah_belanja=$jumlah_belanja+$belanja['jumlah'];
}
$jumlah_belanja=number_format($jumlah_belanja,2,'.','');
?>
	var belanja = <?php echo $jumlah_belanja; ?>;
	
	var jumlah_belanja = belanja.toFixed(2);
	
	document.getElementById('jumlah_belanja').innerHTML = jumlah_belanja;
</script>