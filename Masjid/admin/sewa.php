<?php
 require_once("connection/connection.php");
 $sql_jenis = "SELECT jenis_inventori, UCASE(jenis_inventori) 'jenis_inventori2' FROM sej6x_data_jenisinventori";
 $result_jenis = mysqli_query($utama_conn, $sql_jenis);
?>

            <div class="row">
                <div class="col-lg-12">
                  <h1 align="center" class="page-header">BORANG SEWA FASILITI</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Semak Ketersediaan Item Sewaan
                        </div>

                        <div class="panel-body">
                        <div class="row"> 
                            <form id="form1" name="form1" method="POST" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>">
								<div class="col-lg-4">
									<label>Dari</label>
                                  <input type="date" id="dari" name="dari" value="<?php echo($_POST['dari']); ?>" required></input>
								</div>
							<div class="col-lg-4">
								  <label>Hingga</label>
                                  <input type="date" id="hingga" name="hingga" value="<?php echo($_POST['hingga']); ?>" required></input>
                                </div>
                                <div class="col-lg-4">
                                <br>
                                  <input type="submit" name="search" value="Carian" class="btn btn-primary"></input> 
                                </div>
                            </form>
                        </div>
                     </div>
                 </div>
             </div>
         </div>

<script type="text/javascript">
function kira_sewa_lama() {
    var total = parseFloat("0");//
    var kuantiti = document.getElementsByName("kuantiti_sewa[]");
	var harga = document.getElementsByName("harga_sewa[]");
    for(var i = 0; i < kuantiti.length; i++) {
        var	price=harga[i];
		var quantity=kuantiti[i];
		total = total + (parseFloat(price.value)*parseFloat(quantity.value));
    }
    document.getElementById("jumlah_harga").innerHTML = total;  
	
}
	
</script>
<?php 
if(isset($_POST['dari']) && isset($_POST['hingga'])) {
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" name="borang_sewa">
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Item Sewaan
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
			<div class="table-responsive">
					<table class="table table-striped2 table-bordered table-hover2">
						<thead align="center">
							<tr>
								<th><div align="center"></div></th>
								<th><div align="center">Item Sewaan</div></th>
								<th><div align="center">Lokasi</div></th>
								<th><div align="center">Kuantiti</div></th>
								<th><div align="center">Tersedia</div></th>
								<th><div align="center">Kadar Sewa (RM)</div></th>
								<th><div align="center">Unit Sewa</div></th>
								
							</tr>
						</thead>
						<tbody>
						   <?php 
							$tarikh_mula=$_POST['dari'];
							$tarikh_tamat=$_POST['hingga'];
							$sql = "SELECT * FROM sej6x_data_inventori WHERE id_masjid='$id_masjid'";
							$sqlquery=mysql_query($sql,$bd);
							$i=1;
							while($data=mysql_fetch_array($sqlquery))
							{
								$id_inventori=$data['id_inventori'];
								$sql_item = "SELECT c.id_inventori 'nama_inventori', SUM(b.kuantiti) 'kuantiti' FROM maklumat_sewaan a, maklumat_sewaan_item b, sej6x_data_inventori c WHERE a.no_sewa = b.no_sewa AND b.id_inventori = c.id_inventori AND (a.sewa_tarikh_mula BETWEEN '$tarikh_mula' AND '$tarikh_tamat' OR a.sewa_tarikh_akhir BETWEEN '$tarikh_mula' AND '$tarikh_tamat') AND b.id_inventori='$id_inventori' AND a.id_masjid = '$id_masjid'";
								$query_item = mysql_query($sql_item,$bd);
								$data_item=mysql_fetch_array($query_item);
								$row_item=mysql_num_rows($query_item);
								$disewa = $data_item['kuantiti'];
								$tersedia = $data['kuantiti'] - $disewa;
								if($tersedia>0)
								{
							?>
							
							<tr style="background-color: <?php if($tersedia > 0) echo('#B8F5B1'); if($tersedia < 1) echo('#FF9F9F'); ?>">
								<td align="center"><input type="checkbox" name="id_check<?php echo $id_inventori;?>" id="item<?php echo $id_inventori;?>" value="<?php echo $id_inventori;?>" onClick="selectThis<?php echo $id_inventori;?>()"></td>
								<td align="center"><?php echo $data['nama_inventori']; ?></td>
								<td align="center"><?php echo $data['lokasi']; ?></td>
								<td align="center"><?php echo $data['kuantiti']; ?></td>
								<td align="center"><?php echo $tersedia; ?></td>
								<td align="center"><input name='harga_sewa<?php echo $id_inventori;?>' id='harga_sewa<?php echo $id_inventori;?>' type='number' class='harga' value='<?php echo $data['harga_sewa']; ?>' /></td>
								<td align="center">
								<div id="sewa<?php echo $id_inventori;?>"></div>
								</td>
								
							</tr>
							<?php 
								}
								$i++;
							}
							?>
							<tr>
								<td align="right" colspan=6>Jumlah Harga(RM)</td>
								<td align="middle"><div id="jumlah_harga"></div></td>
							 </tr>
						</tbody>
					</table>
			</div>
			</div>
		</div>
	</div>
</div>
	
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Maklumat Sewaan 
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<?php                                                                      
						if (isset($_POST['btn_simpan_sewa'])) 
						{
							$sewa_tarikh_mula    = $_POST['sewa_tarikh_mula'];
							$sewa_tarikh_akhir    = $_POST['sewa_tarikh_akhir'];
							$sewa_nama    = $_POST['sewa_nama'];
							$sewa_ic    = $_POST['sewa_ic'];
							$sewa_telefon = $_POST['sewa_telefon'];
							$sewa_alamat = $_POST['sewa_alamat'];
							$sewa_deposit    =$_POST['sewa_deposit'];
							$sewa_baki_bayaran    =$_POST['sewa_baki_bayaran'];
							$sewa_ajk    =$_POST['sewa_ajk'];
							$sewa_tarikh = $_POST['sewa_tarikh'];

							$query = "INSERT INTO maklumat_sewaan (
										id_masjid,
										sewa_tarikh_mula, 
										sewa_tarikh_akhir, 
										sewa_nama, 
										sewa_ic, 
										sewa_telefon, 
										sewa_alamat, 
										sewa_perkara,
										sewa_nama_perkara
										sewa_deposit,
										sewa_baki_bayaran,
										sewa_ajk,
										sewa_tarikh,
										sewa_last_added
										) 

										VALUES(
									    '$id_masjid',
									    '$sewa_tarikh_mula', 
									    '$sewa_tarikh_akhir', 
									    '$sewa_nama', 
										'$sewa_ic', 
										'$sewa_telefon', 
										'$sewa_alamat', 
										'$sewa_perkara',
										'$sewa_nama_perkara',
										'$sewa_deposit',
										'$sewa_baki_bayaran',
										'$sewa_ajk',
										'$sewa_tarikh',
										 NOW()
										)";

							mysqli_query($bd2, $query) or die(mysqli_error($bd2));
							$last_id = mysqli_insert_id($bd2);
								   
									
									
						}
						?> 
						<div class="form-group">
							<label>Nama Penuh Penyewa</label>
							<input class="form-control" name="sewa_nama">
						</div>
						<div class="form-group">
							<label>IC Penyewa</label>
							<input class="form-control" name="sewa_ic">
						</div>
						<div class="form-group">
							<label>No Telefon Penyewa</label>
							<input class="form-control" name="sewa_telefon">
							<input type="date" id="sewa_tarikh_mula" name="sewa_tarikh_mula" value="<?php echo($_POST['dari']); ?>" required hidden></input>
							<input type="date" id="sewa_tarikh_akhir" name="sewa_tarikh_akhir" value="<?php echo($_POST['hingga']); ?>" required hidden></input>
						</div>
						<div class="form-group">
							<label>Alamat Penyewa</label>
							<textarea class="form-control" name="sewa_alamat" rows="5"></textarea> 
						</div>	 
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Tarikh</label>
							<input type="date" id="sewa_tarikh" name="sewa_tarikh" value="<?php echo(date('Y-m-d')); ?>" required></input>
						</div>
						<div class="form-group">
							<label>Deposit (RM)</label>
							<input class="form-control" name="sewa_deposit">
						</div>
						<div class="form-group">
							<label>Baki Bayaran (RM)</label>
							<input class="form-control" name="sewa_baki_bayaran">
						</div>
						<div class="form-group">
							<label>AJK Yang Bertugas</label>
							<select class="form-control" name="sewa_ajk">
								<option value="0">Sila Pilih AJK</option>
								<?php 
								$sql2 = "SELECT * FROM sej6x_data_ajkmasjid WHERE id_masjid='$id_masjid'";
								$list_ajk = mysqli_query($bd2, $sql2) or die(mysqli_error($bd2));
								while($row_list_ajk = mysqli_fetch_assoc($list_ajk)) { ?>
								<option value="<?php echo($row_list_ajk['nama_penuh']); ?>"><?php echo($row_list_ajk['nama_penuh']); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
					<!-- /.row (nested) -->
			</div>
				<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>	

<div class="row">
<center>
	<input type="submit" name="submit" value="Submit" class="btn btn-primary">
</center>
</div>

<br>

</form>
<?php
}
?>
<script>

	<?php 
	$tarikh_mula=$_POST['dari'];
	$tarikh_tamat=$_POST['hingga'];
	$sql1="SELECT * FROM sej6x_data_inventori WHERE harga_sewa > 0 AND id_masjid='$id_masjid'";
	$sqlquery1=mysql_query($sql1,$bd);
	while($data1=mysql_fetch_array($sqlquery1))
	{
		$id_inventori=$data1['id_inventori'];
		$sql_item = "SELECT c.id_inventori 'nama_inventori', SUM(b.kuantiti) 'kuantiti' FROM maklumat_sewaan a, maklumat_sewaan_item b, sej6x_data_inventori c WHERE a.no_sewa = b.no_sewa AND b.id_inventori = c.id_inventori AND (a.sewa_tarikh_mula BETWEEN '$tarikh_mula' AND '$tarikh_tamat' OR a.sewa_tarikh_akhir BETWEEN '$tarikh_mula' AND '$tarikh_tamat') AND b.id_inventori='$id_inventori' AND a.id_masjid = '$id_masjid'";
		$query_item = mysql_query($sql_item,$bd);
		$data_item=mysql_fetch_array($query_item);
		$row_item=mysql_num_rows($query_item);
		$disewa = $data_item['kuantiti'];
		$tersedia = $data1['kuantiti'] - $disewa;
		if($tersedia>0)
		{
	
	
	//$row1=mysql_num_rows($sqlquery1);
	//for($i=1;$i<=$row1;$i++)
	//{
	?>
	function selectThis<?php echo $id_inventori;?>(){
	var checkBox<?php echo $id_inventori;?> = document.getElementById('item<?php echo $id_inventori;?>');
	var div<?php echo $id_inventori;?> = document.getElementById('sewa<?php echo $id_inventori;?>');
	
	if(checkBox<?php echo $id_inventori;?>.checked == true){
		div<?php echo $id_inventori;?>.style.display = 'block';
		div<?php echo $id_inventori;?>.innerHTML = "<input onkeyup='kira_sewa()' name='kuantiti_sewa<?php echo $id_inventori;?>' id='kuantiti_sewa<?php echo $id_inventori;?>' type='number' min='1' max='<?php echo $tersedia; ?>' class='kuantiti_sewa' />"
	} else {
		div<?php echo $id_inventori;?>.style.display = 'none';
	}
	}
	<?php
	//}
		}
	}
	?>
	
	
	function kira_sewa(){
		var total = 0;
		<?php
		//for($i=1;$i<=$row1;$i++)
		//{
		$sql2="SELECT * FROM sej6x_data_inventori WHERE harga_sewa > 0 AND id_masjid='$id_masjid'";
		$sqlquery2=mysql_query($sql2,$bd);	
		while($data2=mysql_fetch_array($sqlquery2))
		{
			$id_inventori2=$data2['id_inventori'];
		?>
			var k<?php echo $id_inventori2;?> = document.getElementById('kuantiti_sewa<?php echo $id_inventori2;?>');
			
			if(k<?php echo $id_inventori2;?> != null)
				{
						var kuantiti<?php echo $id_inventori2;?> = k<?php echo $id_inventori2;?>.value;
						var harga<?php echo $id_inventori2;?> = document.getElementById('harga_sewa<?php echo $id_inventori2;?>').value;
						
						total = parseFloat(total) + (parseFloat(kuantiti<?php echo $id_inventori2;?>)*harga<?php echo $id_inventori2;?>);
				}
			else if(k<?php echo $id_inventori2;?> == null){
				var kuantiti<?php echo $id_inventori2;?> = 0;
			}
		
		<?php
		}
		//}
		?>
		document.getElementById('jumlah_harga').innerHTML = total;
	}
</script>