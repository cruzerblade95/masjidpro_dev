<?php

include('connection/connection.php');

if(isset($_POST['search']))
{
	$bulan = $_POST['month'];
	$tahun = $_POST['tahun'];
	$year = $_POST['tahun'];
	$id_masjid = $_POST['id_masjid'];
	$date=$year."-".$bulan;
	$month=date_format((date_create($date)),"F");
	$total_days=date_format((date_create($date)),"t");
}
else if(isset($_GET['month']) AND isset($_GET['tahun']))
{
	$bulan = $_GET['month'];
	$tahun = $_GET['tahun'];
	$year = $_GET['tahun'];
	//$id_masjid = $_POST['id_masjid'];
	$date=$year."-".$bulan;
	$month=date_format((date_create($date)),"F");
	$total_days=date_format((date_create($date)),"t");
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
										<option value="01" <?php if ($bulan=="01"){ echo "selected='SELECTED'";}?>>Januari</option>
										<option value="02" <?php if ($bulan=="02"){ echo "selected='SELECTED'";}?>>Februari</option>   
										<option value="03" <?php if ($bulan=="03"){ echo "selected='SELECTED'";}?>>Mac</option>   
										<option value="04" <?php if ($bulan=="04"){ echo "selected='SELECTED'";}?>>April</option>   
										<option value="05" <?php if ($bulan=="05"){ echo "selected='SELECTED'";}?>>Mei</option>   
										<option value="06" <?php if ($bulan=="06"){ echo "selected='SELECTED'";}?>>Jun</option>   
										<option value="07" <?php if ($bulan=="07"){ echo "selected='SELECTED'";}?>>Julai</option>   
										<option value="08" <?php if ($bulan=="08"){ echo "selected='SELECTED'";}?>>Ogos</option>   
										<option value="09" <?php if ($bulan=="09"){ echo "selected='SELECTED'";}?>>September</option>   
										<option value="10" <?php if($bulan=="10"){ echo "selected='SELECTED'";}?>>Oktober</option>   
										<option value="11" <?php if($bulan=="11"){ echo "selected='SELECTED'";}?>>November</option>   
										<option value="12" <?php if($bulan=="12"){ echo "selected='SELECTED'";}?>>Disember</option>   
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
                                        for($i=$end_year;$i>=$start_year;$i--)
                                        {
                                        ?>
                                        <option value="<?php echo $i; ?>" <?php if($tahun==$i) { echo "selected='SELECTED'"; } ?>><?php echo $i;?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
									<!-- <input class="form-control" placeholder="Contoh: 2018" name="tahun" id="tahun" required> -->
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<br>
									<input type="submit" name="search" value="Carian" class="btn btn-primary"></input> 
								</div>
								<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
								<input type="hidden" name="carisearch" value="1" />
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <div class="modal fade" id="modalJadual" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollmodalLabel">Jadual Kehadiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <center>
                                    <button class="btn btn-info form-control" onclick="window.open('admin/printjadual.php?id_masjid=<?php echo $id_masjid; ?>&jenis_pegawai=Imam&tarikh=<?php echo $date; ?>&month=<?php echo $bulan; ?>&tahun=<?php echo $year; ?>')">Imam</button>
                                </center>
                            </div>
                            <div class="col-md-4">
                                <center>
                                    <button class="btn btn-warning form-control" onclick="window.open('admin/printjadual.php?id_masjid=<?php echo $id_masjid; ?>&jenis_pegawai=Bilal&tarikh=<?php echo $date; ?>&month=<?php echo $bulan; ?>&tahun=<?php echo $year; ?>')">Bilal</button>
                                </center>
                            </div>
                            <div class="col-md-4">
                                <center>
                                    <button class="btn btn-success form-control" onclick="window.open('admin/printjadual.php?id_masjid=<?php echo $id_masjid; ?>&jenis_pegawai=Siak&tarikh=<?php echo $date; ?>&month=<?php echo $bulan; ?>&tahun=<?php echo $year; ?>')">Siak</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
	for($i=1;$i<=$total_days;$i++)
	{
?>
<div class="modal fade" id="date<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollmodalLabel"><?php echo $i." ".$month." ".$year; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php
			if($i<10)
			{
				$day="0".$i;
			}
			else
			{
				$day = $i;
			}
			$m=date_format((date_create($date)),"m");
			$t=$year."-".$m."-".$day;
			
			$kuiri="SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t'";
			$kuirirun=mysqli_query($bd2, $kuiri);
			$run=mysqli_num_rows($kuirirun);
			
			?>
			<form <?php if($run==0) { ?>action="admin/add_jadual.php"<?php }else if($run>0) { ?>action="admin/update_jadual.php"<?php } ?> method="POST">
			<div class="modal-body">
				<table class="table table-bordered">
					<tr>
						<td width="10%"></td>
						<td width="30%" align="middle"><h4>Imam</h4></td>
						<td width="30%" align="middle"><h4>Bilal</h4></td>
						<td width="30%" align="middle"><h4>Siak</h4></td>
					</tr>
					<tr>
						<td align="middle"><h4>Subuh</h4></td>
						<td>
							<select name="subuh_imam<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri1="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Subuh' AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri1.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Subuh' AND (d.jawatan='Imam' OR d.jawatan='Imam Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri1.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Subuh' AND (g.jawatan='Imam' OR g.jawatan='Imam Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun1=mysqli_query($bd2, $kuiri1);
								$run1=mysqli_fetch_array($kuirirun1);
								$row1=mysqli_num_rows($kuirirun1);

								$sql_jadual1 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Subuh' AND jawatan='Imam'";
								$query_jadual1 = mysqli_query($bd2,$sql_jadual1);
								$data_jadual1 = mysqli_fetch_array($query_jadual1);
								$bil_jadual1 = mysqli_num_rows($query_jadual1);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql1="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah')";
								$sql1.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Imam' OR c.jawatan='Imam Tambah')";
                                $sql1.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Imam' OR e.jawatan='Imam Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
                                    $sqlquery1=mysqli_query($bd2, $sql1);
								
								while($data1=mysqli_fetch_array($sqlquery1))
								{
								?>
								<option value="<?php echo $data1['id_datapegawai']; ?>" <?php if($run1['id_pegawai']==$data1['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data1['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual1>0) { ?><input type="hidden" name="id_subuh_imam<?php echo $i; ?>" value="<?php echo $data_jadual1['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="subuh_bilal<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri2="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Subuh' AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri2.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Subuh' AND (d.jawatan='Bilal' OR d.jawatan='Bilal Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri2.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Subuh' AND (g.jawatan='Bilal' OR g.jawatan='Bilal Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun2=mysqli_query($bd2, $kuiri2);
								$run2=mysqli_fetch_array($kuirirun2);
								$row2=mysqli_num_rows($kuirirun2);

                                $sql_jadual2 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Subuh' AND jawatan='Bilal'";
                                $query_jadual2 = mysqli_query($bd2,$sql_jadual2);
                                $data_jadual2 = mysqli_fetch_array($query_jadual2);
                                $bil_jadual2 = mysqli_num_rows($query_jadual2);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql2="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah')";
								$sql2.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Bilal' OR c.jawatan='Bilal Tambah')";
                                $sql2.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Bilal' OR e.jawatan='Bilal Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
                                $sqlquery2=mysqli_query($bd2, $sql2);
								while($data2=mysqli_fetch_array($sqlquery2))
								{
								?>
								<option value="<?php echo $data2['id_datapegawai']; ?>" <?php if($run2['id_pegawai']==$data2['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data2['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual2>0) { ?><input type="hidden" name="id_subuh_bilal<?php echo $i; ?>" value="<?php echo $data_jadual2['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="subuh_siak<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri3="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Subuh' AND (a.jawatan='Siak' OR a.jawatan='Siak Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri3.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Subuh' AND (d.jawatan='Siak' OR d.jawatan='Siak Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri3.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Subuh' AND (g.jawatan='Siak' OR g.jawatan='Siak Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun3=mysqli_query($bd2, $kuiri3);
								$run3=mysqli_fetch_array($kuirirun3);
								$row3=mysqli_num_rows($kuirirun3);

                                $sql_jadual3 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Subuh' AND jawatan='Siak'";
                                $query_jadual3 = mysqli_query($bd2,$sql_jadual3);
                                $data_jadual3 = mysqli_fetch_array($query_jadual3);
                                $bil_jadual3 = mysqli_num_rows($query_jadual3);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql3="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Siak' OR a.jawatan='Siak Tambah')";
								$sql3.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Siak' OR c.jawatan='Siak Tambah')";
                                $sql3.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Siak' OR e.jawatan='Siak Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery3=mysqli_query($bd2, $sql3);
								while($data3=mysqli_fetch_array($sqlquery3))
								{
								?>
								<option value="<?php echo $data3['id_datapegawai']; ?>" <?php if($run3['id_pegawai']==$data3['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data3['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual3>0) { ?><input type="hidden" name="id_subuh_siak<?php echo $i; ?>" value="<?php echo $data_jadual3['ID']; ?>"><?php } ?>
						</td>
					</tr>
					<tr>
						<td align="middle"><h4>Zohor</h4></td>
						<td>
							<select name="zohor_imam<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri4="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Zohor' AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri4.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Zohor' AND (d.jawatan='Imam' OR d.jawatan='Imam Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri4.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Zohor' AND (g.jawatan='Imam' OR g.jawatan='Imam Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun4=mysqli_query($bd2, $kuiri4);
								$run4=mysqli_fetch_array($kuirirun4);
								$row4=mysqli_num_rows($kuirirun4);

                                $sql_jadual4 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Zohor' AND jawatan='Imam'";
                                $query_jadual4 = mysqli_query($bd2,$sql_jadual4);
                                $data_jadual4 = mysqli_fetch_array($query_jadual4);
                                $bil_jadual4 = mysqli_num_rows($query_jadual4);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql4="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah')";
								$sql4.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Imam' OR c.jawatan='Imam Tambah')";
                                $sql4.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Imam' OR e.jawatan='Imam Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
                                $sqlquery4=mysqli_query($bd2, $sql4);
								while($data4=mysqli_fetch_array($sqlquery4))
								{
								?>
								<option value="<?php echo $data4['id_datapegawai']; ?>" <?php if($run4['id_pegawai']==$data4['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data4['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual4>0) { ?><input type="hidden" name="id_zohor_imam<?php echo $i; ?>" value="<?php echo $data_jadual4['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="zohor_bilal<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri5="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Zohor' AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri5.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Zohor' AND (d.jawatan='Bilal' OR d.jawatan='Bilal Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri5.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Zohor' AND (g.jawatan='Bilal' OR g.jawatan='Bilal Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun5=mysqli_query($bd2, $kuiri5);
								$run5=mysqli_fetch_array($kuirirun5);
								$row5=mysqli_num_rows($kuirirun5);

                                $sql_jadual5 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Zohor' AND jawatan='Bilal'";
                                $query_jadual5 = mysqli_query($bd2,$sql_jadual5);
                                $data_jadual5 = mysqli_fetch_array($query_jadual5);
                                $bil_jadual5 = mysqli_num_rows($query_jadual5);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql5="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah')";
								$sql5.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Bilal' OR c.jawatan='Bilal Tambah')";
                                $sql5.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Bilal' OR e.jawatan='Bilal Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery5=mysqli_query($bd2, $sql5);
								while($data5=mysqli_fetch_array($sqlquery5))
								{
								?>
								<option value="<?php echo $data5['id_datapegawai']; ?>" <?php if($run5['id_pegawai']==$data5['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data5['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual5>0) { ?><input type="hidden" name="id_zohor_bilal<?php echo $i; ?>" value="<?php echo $data_jadual5['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="zohor_siak<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri6="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Zohor' AND(a.jawatan='Siak' OR a.jawatan='Siak Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri6.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Zohor' AND (d.jawatan='Siak' OR d.jawatan='Siak Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri6.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Zohor' AND (g.jawatan='Siak' OR g.jawatan='Siak Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun6=mysqli_query($bd2, $kuiri6);
								$run6=mysqli_fetch_array($kuirirun6);
								$row6=mysqli_num_rows($kuirirun6);

                                $sql_jadual6 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Zohor' AND jawatan='Siak'";
                                $query_jadual6 = mysqli_query($bd2,$sql_jadual6);
                                $data_jadual6 = mysqli_fetch_array($query_jadual6);
                                $bil_jadual6 = mysqli_num_rows($query_jadual6);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql6="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Siak' OR a.jawatan='Siak Tambah')";
								$sql6.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Siak' OR c.jawatan='Siak Tambah')";
                                $sql6.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Siak' OR e.jawatan='Siak Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery6=mysqli_query($bd2, $sql6);
								while($data6=mysqli_fetch_array($sqlquery6))
								{
								?>
								<option value="<?php echo $data6['id_datapegawai']; ?>" <?php if($run6['id_pegawai']==$data6['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data6['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual6>0) { ?><input type="hidden" name="id_zohor_siak<?php echo $i; ?>" value="<?php echo $data_jadual6['ID']; ?>"><?php } ?>
						</td>
					</tr>
					<tr>
						<td align="middle"><h4>Asar</h4></td>
						<td>
							<select name="asar_imam<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri7="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Asar' AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri7.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Asar' AND (d.jawatan='Imam' OR d.jawatan='Imam Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri7.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Asar' AND (g.jawatan='Imam' OR g.jawatan='Imam Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun7=mysqli_query($bd2, $kuiri7);
								$run7=mysqli_fetch_array($kuirirun7);
								$row7=mysqli_num_rows($kuirirun7);

                                $sql_jadual7 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Asar' AND jawatan='Imam'";
                                $query_jadual7 = mysqli_query($bd2,$sql_jadual7);
                                $data_jadual7 = mysqli_fetch_array($query_jadual7);
                                $bil_jadual7 = mysqli_num_rows($query_jadual7);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql7="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah')";
								$sql7.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Imam' OR c.jawatan='Imam Tambah')";
                                $sql7.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Imam' OR e.jawatan='Imam Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery7=mysqli_query($bd2, $sql7);
								while($data7=mysqli_fetch_array($sqlquery7))
								{
								?>
								<option value="<?php echo $data7['id_datapegawai']; ?>" <?php if($run7['id_pegawai']==$data7['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data7['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual7>0) { ?><input type="hidden" name="id_asar_imam<?php echo $i; ?>" value="<?php echo $data_jadual7['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="asar_bilal<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri8="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Asar' AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri8.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Asar' AND (d.jawatan='Bilal' OR d.jawatan='Bilal Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri8.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Asar' AND (g.jawatan='Bilal' OR g.jawatan='Bilal Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun8=mysqli_query($bd2, $kuiri8);
								$run8=mysqli_fetch_array($kuirirun8);
								$row8=mysqli_num_rows($kuirirun8);

                                $sql_jadual8 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Asar' AND jawatan='Bilal'";
                                $query_jadual8 = mysqli_query($bd2,$sql_jadual8);
                                $data_jadual8 = mysqli_fetch_array($query_jadual8);
                                $bil_jadual8 = mysqli_num_rows($query_jadual8);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql8="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah')";
								$sql8.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Bilal' OR c.jawatan='Bilal Tambah')";
                                $sql8.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Bilal' OR e.jawatan='Bilal Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery8=mysqli_query($bd2, $sql8);
								while($data8=mysqli_fetch_array($sqlquery8))
								{
								?>
								<option value="<?php echo $data8['id_datapegawai']; ?>" <?php if($run8['id_pegawai']==$data8['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data8['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual8>0) { ?><input type="hidden" name="id_asar_bilal<?php echo $i; ?>" value="<?php echo $data_jadual8['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="asar_siak<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri9="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Asar' AND (a.jawatan='Siak' OR a.jawatan='Siak Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri9.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Asar' AND (d.jawatan='Siak' OR d.jawatan='Siak Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri9.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Asar' AND (g.jawatan='Siak' OR g.jawatan='Siak Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun9=mysqli_query($bd2, $kuiri9);
								$run9=mysqli_fetch_array($kuirirun9);
								$row9=mysqli_num_rows($kuirirun9);

                                $sql_jadual9 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Asar' AND jawatan='Siak'";
                                $query_jadual9 = mysqli_query($bd2,$sql_jadual9);
                                $data_jadual9 = mysqli_fetch_array($query_jadual9);
                                $bil_jadual9 = mysqli_num_rows($query_jadual9);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql9="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Siak' OR a.jawatan='Siak Tambah')";
								$sql9.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Siak' OR c.jawatan='Siak Tambah')";
                                $sql9.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Siak' OR e.jawatan='Siak Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery9=mysqli_query($bd2, $sql9);
								while($data9=mysqli_fetch_array($sqlquery9))
								{
								?>
								<option value="<?php echo $data9['id_datapegawai']; ?>" <?php if($run9['id_pegawai']==$data9['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data9['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual9>0) { ?><input type="hidden" name="id_asar_siak<?php echo $i; ?>" value="<?php echo $data_jadual9['ID']; ?>"><?php } ?>
						</td>
					</tr>
					<tr>
						<td align="middle"><h4>Maghrib</h4></td>
						<td>
							<select name="maghrib_imam<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri10="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Maghrib' AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri10.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Maghrib' AND (d.jawatan='Imam' OR d.jawatan='Imam Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri10.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Maghrib' AND (g.jawatan='Imam' OR g.jawatan='Imam Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun10=mysqli_query($bd2, $kuiri10);
								$run10=mysqli_fetch_array($kuirirun10);
								$row10=mysqli_num_rows($kuirirun10);

                                $sql_jadual10 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Maghrib' AND jawatan='Imam'";
                                $query_jadual10 = mysqli_query($bd2,$sql_jadual10);
                                $data_jadual10 = mysqli_fetch_array($query_jadual10);
                                $bil_jadual10 = mysqli_num_rows($query_jadual10);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql10="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah')";
								$sql10.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Imam' OR c.jawatan='Imam Tambah')";
                                $sql10.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Imam' OR e.jawatan='Imam Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery10=mysqli_query($bd2, $sql10);
								while($data10=mysqli_fetch_array($sqlquery10))
								{
								?>
								<option value="<?php echo $data10['id_datapegawai']; ?>" <?php if($run10['id_pegawai']==$data10['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data10['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual10>0) { ?><input type="hidden" name="id_maghrib_imam<?php echo $i; ?>" value="<?php echo $data_jadual10['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="maghrib_bilal<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri11="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Maghrib' AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri11.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Maghrib' AND (d.jawatan='Bilal' OR d.jawatan='Bilal Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri11.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Maghrib' AND (g.jawatan='Bilal' OR g.jawatan='Bilal Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun11=mysqli_query($bd2, $kuiri11);
								$run11=mysqli_fetch_array($kuirirun11);
								$row11=mysqli_num_rows($kuirirun11);

                                $sql_jadual11 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Maghrib' AND jawatan='Bilal'";
                                $query_jadual11 = mysqli_query($bd2,$sql_jadual11);
                                $data_jadual11 = mysqli_fetch_array($query_jadual11);
                                $bil_jadual11 = mysqli_num_rows($query_jadual11);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql11="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah')";
								$sql11.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Bilal' OR c.jawatan='Bilal Tambah')";
                                $sql11.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Bilal' OR e.jawatan='Bilal Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery11=mysqli_query($bd2, $sql11);
								while($data11=mysqli_fetch_array($sqlquery11))
								{
								?>
								<option value="<?php echo $data11['id_datapegawai']; ?>" <?php if($run11['id_pegawai']==$data11['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data11['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual11>0) { ?><input type="hidden" name="id_maghrib_bilal<?php echo $i; ?>" value="<?php echo $data_jadual11['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="maghrib_siak<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri12="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Maghrib' AND (a.jawatan='Siak' OR a.jawatan='Siak Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri12.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Maghrib' AND (d.jawatan='Siak' OR d.jawatan='Siak Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri12.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Maghrib' AND (g.jawatan='Siak' OR g.jawatan='Siak Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun12=mysqli_query($bd2, $kuiri12);
								$run12=mysqli_fetch_array($kuirirun12);
								$row12=mysqli_num_rows($kuirirun12);

                                $sql_jadual12 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Maghrib' AND jawatan='Siak'";
                                $query_jadual12 = mysqli_query($bd2,$sql_jadual12);
                                $data_jadual12 = mysqli_fetch_array($query_jadual12);
                                $bil_jadual12 = mysqli_num_rows($query_jadual12);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql12="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Siak' OR a.jawatan='Siak Tambah')";
								$sql12.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Siak' OR c.jawatan='Siak Tambah')";
                                $sql12.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Siak' OR e.jawatan='Siak Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery12=mysqli_query($bd2, $sql12);
								while($data12=mysqli_fetch_array($sqlquery12))
								{
								?>
								<option value="<?php echo $data12['id_datapegawai']; ?>" <?php if($run12['id_pegawai']==$data12['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data12['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual12>0) { ?><input type="hidden" name="id_maghrib_siak<?php echo $i; ?>" value="<?php echo $data_jadual12['ID']; ?>"><?php } ?>
						</td>
					</tr>
					<tr>
						<td align="middle"><h4>Isya</h4></td>
						<td>
							<select name="isya_imam<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri13="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Isya' AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri13.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Isya' AND (d.jawatan='Imam' OR d.jawatan='Imam Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri13.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Isya' AND (g.jawatan='Imam' OR g.jawatan='Imam Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun13=mysqli_query($bd2, $kuiri13);
								$run13=mysqli_fetch_array($kuirirun13);
								$row13=mysqli_num_rows($kuirirun13);

                                $sql_jadual13 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Isya' AND jawatan='Imam'";
                                $query_jadual13 = mysqli_query($bd2,$sql_jadual13);
                                $data_jadual13 = mysqli_fetch_array($query_jadual13);
                                $bil_jadual13 = mysqli_num_rows($query_jadual13);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql13="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Imam' OR a.jawatan='Imam Tambah')";
								$sql13.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Imam' OR c.jawatan='Imam Tambah')";
                                $sql13.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Imam' OR e.jawatan='Imam Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery13=mysqli_query($bd2, $sql13);
								while($data13=mysqli_fetch_array($sqlquery13))
								{
								?>
								<option value="<?php echo $data13['id_datapegawai']; ?>" <?php if($run13['id_pegawai']==$data13['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data13['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual13>0) { ?><input type="hidden" name="id_isya_imam<?php echo $i; ?>" value="<?php echo $data_jadual13['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="isya_bilal<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri14="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Isya' AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri14.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Isya' AND (d.jawatan='Bilal' OR d.jawatan='Bilal Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri14.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Isya' AND (g.jawatan='Bilal' OR g.jawatan='Bilal Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun14=mysqli_query($bd2, $kuiri14);
								$run14=mysqli_fetch_array($kuirirun14);
								$row14=mysqli_num_rows($kuirirun14);

                                $sql_jadual14 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Isya' AND jawatan='Bilal'";
                                $query_jadual14 = mysqli_query($bd2,$sql_jadual14);
                                $data_jadual14 = mysqli_fetch_array($query_jadual14);
                                $bil_jadual14 = mysqli_num_rows($query_jadual14);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql14="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Bilal' OR a.jawatan='Bilal Tambah')";
								$sql14.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Bilal' OR c.jawatan='Bilal Tambah')";
                                $sql14.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Bilal' OR e.jawatan='Bilal Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery14=mysqli_query($bd2, $sql14);
								while($data14=mysqli_fetch_array($sqlquery14))
								{
								?>
								<option value="<?php echo $data14['id_datapegawai']; ?>" <?php if($run14['id_pegawai']==$data14['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data14['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual14>0) { ?><input type="hidden" name="id_isya_bilal<?php echo $i; ?>" value="<?php echo $data_jadual14['ID']; ?>"><?php } ?>
						</td>
						<td>
							<select name="isya_siak<?php echo $i; ?>" class="form-control">
								<?php
								$kuiri15="SELECT a.id_pegawai 'id_pegawai', c.nama_penuh 'nama_penuh' FROM sej6x_data_jadual a, data_pegawai_masjid b, sej6x_data_peribadi c WHERE a.id_masjid='$id_masjid' AND a.tarikh='$t' AND a.solat='Isya' AND (a.jawatan='Siak' OR a.jawatan='Siak Tambah') AND a.id_pegawai=b.id_datapegawai AND b.id_pegawai=c.id_data";
                                $kuiri15.=" UNION SELECT d.id_pegawai 'id_pegawai', f.nama_penuh 'nama_penuh' FROM sej6x_data_jadual d, data_pegawai_masjid e, sej6x_data_anakqariah f WHERE d.id_masjid='$id_masjid' AND d.tarikh='$t' AND d.solat='Isya' AND (d.jawatan='Siak' OR d.jawatan='Siak Tambah') AND d.id_pegawai=e.id_datapegawai AND e.id_pegawai2=f.ID";
                                $kuiri15.=" UNION SELECT g.id_pegawai 'id_pegawai', h.nama_penuh 'nama_penuh' FROM sej6x_data_jadual g, data_pegawai_masjid h WHERE g.id_masjid='$id_masjid' AND g.tarikh='$t' AND g.solat='Isya' AND (g.jawatan='Siak' OR g.jawatan='Siak Tambah') AND g.id_pegawai=h.id_datapegawai AND h.id_pegawai IS NULL AND h.id_pegawai2 IS NULL";
                                $kuirirun15=mysqli_query($bd2, $kuiri15);
								$run15=mysqli_fetch_array($kuirirun15);
								$row15=mysqli_num_rows($kuirirun15);

                                $sql_jadual15 = "SELECT * FROM sej6x_data_jadual WHERE id_masjid='$id_masjid' AND tarikh='$t' AND solat='Isya' AND jawatan='Siak'";
                                $query_jadual15 = mysqli_query($bd2,$sql_jadual15);
                                $data_jadual15 = mysqli_fetch_array($query_jadual15);
                                $bil_jadual15 = mysqli_num_rows($query_jadual15);
								?>
								<option value="">Sila Pilih:-</option>
								<?php
								$sql15="SELECT a.id_datapegawai 'id_datapegawai', b.nama_penuh 'nama_penuh' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data AND (a.jawatan='Siak' OR a.jawatan='Siak Tambah')";
								$sql15.=" UNION SELECT c.id_datapegawai 'id_datapegawai', d.nama_penuh 'nama_penuh' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID AND (c.jawatan='Siak' OR c.jawatan='Siak Tambah')";
                                $sql15.=" UNION SELECT e.id_datapegawai 'id_datapegawai', e.nama_penuh 'nama_penuh' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND (e.jawatan='Siak' OR e.jawatan='Siak Tambah') AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL";
								$sqlquery15=mysqli_query($bd2, $sql15);
								while($data15=mysqli_fetch_array($sqlquery15))
								{
								?>
								<option value="<?php echo $data15['id_datapegawai']; ?>" <?php if($run15['id_pegawai']==$data15['id_datapegawai']) { ?>selected="selected"<?php } ?>><?php echo $data15['nama_penuh']; ?></option>
								<?php
								}
								?>
							</select>
                            <?php if($bil_jadual15>0) { ?><input type="hidden" name="id_isya_siak<?php echo $i; ?>" value="<?php echo $data_jadual15['ID']; ?>"><?php } ?>
						</td>
					</tr>
				  </table>
			</div>
			<input type="hidden" name="day" value="<?php echo $i; ?>">
			<input type="hidden" name="tarikh" value="<?php echo $t; ?>">
			<input type="hidden" name="month" value="<?php echo $bulan; ?>">
			<input type="hidden" name="tahun" value="<?php echo $year; ?>">
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" name="submit" class="btn btn-primary" <?php if($run==0) { ?> style="display:none" <?php } ?>>Kemaskini</button>
				<button type="submit" name="submit" class="btn btn-primary" <?php if($run>0) { ?> style="display:none" <?php } ?>>Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>

<?php
	}
?>
<?php

if(isset($_POST['search']))
{
	$bulan = $_POST['month'];
	$year = $_POST['tahun'];
	$id_masjid = $_POST['id_masjid'];
	
	

$date=$year."-".$bulan;
$month=date_format((date_create($date)),"F");
$strdate = strtoupper($strdate=date_format((date_create($date)),"F Y"));

/* draws a calendar */
function draw_calendar($bulan,$year){

	include('connection/connection.php');

	$id_masjid = $_POST['id_masjid'];

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
		
		$num_day=date_format(date_create($tarikh),"d");
		$new_tarikh=$year."-".$bulan."-".$num_day;
		
		$sql16="SELECT * FROM sej6x_data_jadual WHERE id_masjid='".$id_masjid."' AND tarikh='".$new_tarikh."'";
		$sqlquery16=mysqli_query($bd2, $sql16);
		$row16=mysqli_num_rows($sqlquery16);
		
		if($row16==15)
		{
			$calendar.= '<div class="day-number"><button class="button btn-success form-control" id="myBtn'.$list_day.'" data-toggle="modal" data-target="#date'.$list_day.'" value="'.$list_day.'">'.$list_day.'</button></div>';
		}
		else if($row16>15){
            $calendar.= '<div class="day-number"><button class="button btn-success form-control" id="myBtn'.$list_day.'" data-toggle="modal" data-target="#date'.$list_day.'" value="'.$list_day.'">'.$list_day.'</button></div>';
        }
		else if($row16>0 AND $row16<15){
            $calendar.= '<div class="day-number"><button class="button btn-warning form-control" id="myBtn'.$list_day.'" data-toggle="modal" data-target="#date'.$list_day.'" value="'.$list_day.'">'.$list_day.'</button></div>';
        }
		else if($row16==0)
		{
			$calendar.= '<div class="day-number"><button class="button button4 form-control" id="myBtn'.$list_day.'" data-toggle="modal" data-target="#date'.$list_day.'" value="'.$list_day.'">'.$list_day.'</button></div>';
		}
		
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

echo '<center>';
echo '<h2>'.$strdate.$row16.'</h2>';
echo '<br>';
//echo '<table width="50%"><tr><td align="middle" width="50%">Hadir</td><td align="middle" width="50%">Tidak Hadir</td></tr><tr><td bgcolor="#85D84F"></td><td bgcolor="#FF3718"></td></tr></table>';
echo '<br>';
echo '<div class="col-lg-12"><div class="card"><div class="card-header" align="left">Jadual&nbsp;|&nbsp;<a href="" target="_blank" class="btn btn-info" data-toggle="modal" data-target="#modalJadual">Cetak</a></div><div class="card-body">';
echo draw_calendar($bulan,$year);
echo '</div></div></div>';
echo '</center>';
}
else if(isset($_GET['month']) AND isset($_GET['tahun']))
{

	$bulan = $_GET['month'];
	$year = $_GET['tahun'];
	//$id_masjid = $_POST['id_masjid'];
	
	

$date=$year."-".$bulan;
$month=date_format((date_create($date)),"F");
$strdate = strtoupper($strdate=date_format((date_create($date)),"F Y"));

/* draws a calendar */
function draw_calendar($bulan,$year){

	include('connection/connection.php');

	//$id_masjid = $_POST['id_masjid'];

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
		
		$num_day=date_format(date_create($tarikh),"d");
		$new_tarikh=$year."-".$bulan."-".$num_day;
		
		$sql16="SELECT * FROM sej6x_data_jadual WHERE id_masjid='".$id_masjid."' AND tarikh='".$new_tarikh."'";
		$sqlquery16=mysqli_query($bd2, $sql16);
		$row16=mysqli_num_rows($sqlquery16);
		
		if($row16==15)
		{
			$calendar.= '<div class="day-number"><button class="button btn-success form-control" id="myBtn'.$list_day.'" data-toggle="modal" data-target="#date'.$list_day.'" value="'.$list_day.'">'.$list_day.'</button></div>';
		}
        else if($row16>15){
            $calendar.= '<div class="day-number"><button class="button btn-success form-control" id="myBtn'.$list_day.'" data-toggle="modal" data-target="#date'.$list_day.'" value="'.$list_day.'">'.$list_day.'</button></div>';
        }
        else if($row16>0 AND $row16<15){
            $calendar.= '<div class="day-number"><button class="button btn-warning form-control" id="myBtn'.$list_day.'" data-toggle="modal" data-target="#date'.$list_day.'" value="'.$list_day.'">'.$list_day.'</button></div>';
        }
		else if($row16==0)
		{
			$calendar.= '<div class="day-number"><button class="button button4 form-control" id="myBtn'.$list_day.'" data-toggle="modal" data-target="#date'.$list_day.'" value="'.$list_day.'">'.$list_day.'</button></div>';
		}
		
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

echo '<center>';
echo '<h2>'.$strdate.$row16.'</h2>';
echo '<br>';
//echo '<table width="50%"><tr><td align="middle" width="50%">Hadir</td><td align="middle" width="50%">Tidak Hadir</td></tr><tr><td bgcolor="#85D84F"></td><td bgcolor="#FF3718"></td></tr></table>';
echo '<br>';
echo '<div class="col-lg-12"><div class="card"><div class="card-header" align="left">Jadual&nbsp;|&nbsp;<a href="" target="_blank" class="btn btn-info" data-toggle="modal" data-target="#modalJadual">Cetak</a></div><div class="card-body">';
echo draw_calendar($bulan,$year);
echo '</div></div></div>';
echo '</center>';
}

?>