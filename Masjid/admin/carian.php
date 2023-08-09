 <?php include("connection/connection.php");
//untuk sql zon kariah
						  $sql_zonkariah="SELECT id_zonqariah,nama_zon,no_huruf FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; 
	                      $sql_zon = mysqli_query($bd2, $sql_zonkariah) or die ("Error :".mysqli_error($bd2));
?>
						  

<script type="text/javascript">
        function ShowHideDiv(chkPassport) {
            var dvPassport = document.getElementById("dvPassport");
            dvPassport.style.display = "block";
			dvPassport1.style.display = "none";
			dvPassport2.style.display = "none";
			dvPassport3.style.display = "none";
			dvPassport4.style.display = "none";
			dvPassport4A.style.display = "none";
        }
		
		function ShowHideDiv1(chkPassport1) {
            var dvPassport1 = document.getElementById("dvPassport1");
            dvPassport1.style.display = "block";
			dvPassport.style.display = "none";
			dvPassport2.style.display = "none";
			dvPassport3.style.display = "none";
			dvPassport4.style.display = "none";
			dvPassport4A.style.display = "none";
		}
		
		function ShowHideDiv2(chkPassport2) {
            var dvPassport2 = document.getElementById("dvPassport2");
            dvPassport2.style.display = "block";
			dvPassport.style.display = "none";
			dvPassport1.style.display = "none";
			dvPassport3.style.display = "none";
			dvPassport4.style.display = "none";
			dvPassport4A.style.display = "none";
        }

	    function ShowHideDiv3(chkPassport3) {
            var dvPassport3 = document.getElementById("dvPassport3");
            dvPassport3.style.display = "block";
			dvPassport.style.display = "none";
			dvPassport1.style.display = "none";
			dvPassport2.style.display = "none";
			dvPassport4.style.display = "none";
			dvPassport4A.style.display = "none";
        }

		function ShowHideDiv4(chkPassport4) {
            var dvPassport4 = document.getElementById("dvPassport4");
            dvPassport4.style.display = chkPassport4.checked ? "block" : "none";
			
			var dvPassport4A = document.getElementById("dvPassport4A");
            dvPassport4A.style.display = chkPassport4.checked ? "block" : "none";
			
			dvPassport.style.display = "none";
			dvPassport1.style.display = "none";
			dvPassport2.style.display = "none";
			dvPassport3.style.display = "none";
        }
    </script>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Carian</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Carian</li>
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
					Carian
				</div>
				<div class="card-body">
					<form id="form1" name="form1" method="POST" action="<?php echo $PHP_SELF;?>">
					<div class="row"> 
                        <div class="col-lg-12">                                   
                            <div class="form-group">
								<label>Jenis Carian:</label>
								<label class="checkbox-inline" for="chkPassport">
									<input type="radio" name="chkPassport" id="chkPassport" value="1" onclick="ShowHideDiv(this)" />No K/P / Passpot
                                </label>
								<label class="checkbox-inline" for="chkPassport1">
									<input type="radio" name="chkPassport" id="chkPassport1" value="2" onclick="ShowHideDiv1(this)" />Jantina
								</label> 
								<label class="checkbox-inline" for="chkPassport2">
									<input type="radio" name="chkPassport" id="chkPassport2" value="3" onclick="ShowHideDiv2(this)" />Zon Kawasan
								</label>
                                <label class="checkbox-inline" for="chkPassport3">
									<input type="radio" name="chkPassport" id="chkPassport3" value="4" onclick="ShowHideDiv3(this)" />Status Perkahwinan
								</label>
                                <label class="checkbox-inline" for="chkPassport4">
									<input type="radio" name="chkPassport" id="chkPassport4" value="5" onclick="ShowHideDiv4(this)" />Kategori Umur
								</label>
                            </div>
						</div>
						<div class="col-lg-5" id="dvPassport" style="display: none">                                   
							<div class="form-group ">
								<label>No K/P / Passpot</label>
								<input class="form-control" name="no_ic" id="no_ic">             
							</div>    
						</div>
						<div class="col-lg-5" id="dvPassport1" style="display: none">
							<div class="form-group ">
								<label>Jantina</label>
								<select class="form-control" id="jantina" name="jantina" required> 
									<option>Sila Pilih</option>
									<option value="1">Lelaki</option>
									<option value="2">Perempuan</option>
								</select>
							</div>    
						</div>
                        <div class="col-lg-5" id="dvPassport2" style="display: none">                                   
							<div class="form-group">
								<label>Zon Kawasan</label>
								<select class="form-control" id="zon_qariah" name="zon_qariah" required>
									<option>Sila Pilih</option>
									<?php while($list_zon = mysqli_fetch_array($sql_zon)) 
									{ 
									$id_zon = $list_zon['id_zonqariah'];
									$nama_zon = $list_zon['nama_zon'];
									?>
							        <option value="<?php echo($id_zon); ?>"><?php echo($nama_zon); ?></option>
									<?php 
									} 
									?>
								</select>					                                      
							</div>
						</div>
						<div class="col-lg-5" id="dvPassport3" style="display: none">
							<div class="form-group">
								<label>Status Perkahwinan</label>
								<select class="form-control" name="status_perkahwinan" required>
									<option>Sila Pilih</option>
									<option value="1">Bujang</option>
									<option value="2">Sudah Berkahwin</option>
									<option value="3">Duda</option>
									<option value="4">Janda</option>
								</select>
							</div>
						</div>
                        <div class="col-lg-3" id="dvPassport4" style="display: none">
							<div class="form-group ">
								<label>Daripada</label>
								<input class="form-control" name="daripada" id="daripada" placeholder="Contoh: 25">
							</div>    
						</div>
						<div class="col-lg-3" id="dvPassport4A" style="display: none">    
							<div class="form-group ">
								<label>Hingga</label>
								<input class="form-control" name="hingga" id="hingga" placeholder="Contoh: 30"> 
							</div>    
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<input type="submit" name="search" value="Carian" class="btn btn-primary"></input> 
							</div>  
							<input type="hidden" name="carisearch" value="1" />
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
        <div class="col-lg-12">
            <div class="card">
				<div class="card-header">
					Laporan Carian 
                </div>
                <div class="card-body">
					<div class="table-responsive">
                    <?php 
                          
					include("connection/connection.php");
					
					if(isset($_POST['search']))
					{
						$search = $_POST['chkPassport'];
									
						$sql_search="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_tel', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_qariah=c.id_data AND b.id_masjid='$id_masjid' ORDER BY nama_penuh ASC";
		
						if ($search==1)
						{
							$no_ic = mysql_real_escape_string($_POST['no_ic']);

                            $sql_search="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND a.no_ic LIKE '%$no_ic%' UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_tel', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_qariah=c.id_data AND b.id_masjid='$id_masjid' AND b.no_ic LIKE '%$no_ic' ORDER BY nama_penuh ASC";
						}
						elseif($search==2)
						{
							$jantina=mysql_real_escape_string($_POST['jantina']);

                            $sql_search="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND a.jantina='$jantina' UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_tel', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_qariah=c.id_data AND b.id_masjid='$id_masjid' AND b.jantina='$jantina' ORDER BY nama_penuh ASC";
		
						}
						elseif($search==3)
						{
							$zon_qariah = $_POST['zon_qariah'];

                            $sql_search="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND a.zon_qariah='$zon_qariah' UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_tel', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_qariah=c.id_data AND b.id_masjid='$id_masjid' AND c.zon_qariah='$zon_qariah' ORDER BY nama_penuh ASC";
						}
						elseif($search==4)
						{
							$status_perkahwinan=$_POST["status_perkahwinan"];

                            $sql_search="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND a.status_perkahwinan='$status_perkahwinan' UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_tel', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_qariah=c.id_data AND b.id_masjid='$id_masjid' AND b.status_kahwin='$status_perkahwinan' ORDER BY nama_penuh ASC";
						}
						elseif($search==5)
						{
							$bydaripada = $_POST['daripada'];
							$bydaripada2 = $_POST['daripada'];  
							$byhingga = $_POST['hingga'];

                            $sql_search="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '$bydaripada2' AND '$byhingga') 
                                    UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '$bydaripada2' AND '$byhingga') ORDER BY nama_penuh ASC";
                            //$sql_search = "SELECT id_data, nama_penuh, no_ic, no_hp, alamat_terkini, tarikh_lahir, jantina, YEAR(CURDATE()) - YEAR(tarikh_lahir) 'umur' FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND umur BETWEEN '$bydaripada2' AND '$byhingga' UNION SELECT ID 'id_data', nama_penuh, no_ic, no_tel 'no_hp', 'alamat_terkini' IS NULL, tarikh_lahir, jantina, YEAR(CURDATE()) - YEAR(tarikh_lahir) 'umur' FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND umur BETWEEN '$bydaripada2' AND '$byhingga'";
                            //$sql_search="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', a.umur 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND a.umur BETWEEN '$bydaripada2' AND '$byhingga' UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', b.umur 'umur', b.no_ic 'no_ic', b.no_tel 'no_tel', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_qariah=c.id_data AND b.id_masjid='$id_masjid' AND b.umur BETWEEN '$bydaripada2' AND '$byhingga' ORDER BY nama_penuh ASC";
						}
						$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
						mysqli_num_rows($result);
					?>  
                        <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
							<thead>
                                <tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">Umur</div></th>
									<th><div align="center">No Kad Pengenalan</div></th>
									<th><div align="center">No.Telefon</div></th>
									<th><div align="center">Alamat</div></th>
									<th><div align="center">Maklumat Kariah</div></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php 
							$x=1; 
							while($row = mysqli_fetch_assoc($result))
							{ 
							?>
								<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td align="center"><?php echo $row['umur']; ?></td>
									<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
									<td class="center"><div align="center"><?php echo $row['no_hp']; ?></div></td>
									<td class="center"><?php echo $row['alamat_terkini']; ?></td>
									<td align="center"></td>
								</tr>                          
							<?php 
							$x++;			  
							}
					}			
					else
					{
					}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
