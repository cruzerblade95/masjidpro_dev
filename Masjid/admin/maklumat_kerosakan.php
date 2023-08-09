<?php 
                include("connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
				 $daripada = $_POST['daripada'];				
				 $hingga = $_POST['hingga'];
				
				}
				?>
<?php
if($_GET['action']=="maklumatkerosakan")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Senarai Kerosakan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
					<li class="active">Senarai Kerosakan</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<div class="content mt-3">
	<!-- <div class="row">
		<div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Carian &nbsp;&nbsp;
				</div>
				<div class="card-body">
					<form id="form1" name="form1" method="POST" action="<?php echo $PHP_SELF;?>"> 
                    <div class="row">         
						<div class="col-lg-12">
							<div class="col-lg-3">
								<div class="form-group">
									<label>Daripada</label>
									<input class="form-control" name="daripada" id="daripada" type="date" required>   
								</div>    
                            </div>                     
                            <div class="col-lg-3">
								<div class="form-group">
									<label>Hingga</label>
									<input class="form-control" name="hingga" id="hingga" type="date" required>   
								</div>    
                            </div>      
							<div class="col-lg-2">
								<div class="form-group">
									<br>
                                    <input type="submit" name="search" value="Carian" class="btn btn-primary"></input> 
								</div>
                                <input type="hidden" name="carisearch" value="1" />
                            </div>
						</div>
                    </div>
					</form>
				</div>
			</div>
		</div>
	</div> -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Laporan Kerosakan&nbsp;
                    <?php
                    if($_GET['action']=="maklumatkerosakan")
                    {
                    ?>
					    <a href="utama.php?view=admin&action=kerosakan" class="btn btn-primary">Borang Kerosakan</a>
                    <?php
                    }
                    ?>
					<!-- <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
					<script>
					function myFunction() {
					window.print();
					}
					</script> -->
				</div>
				<div class="card-body">
					<div class="row">
						<div class="table-responsive">
						<?php 
						
						include("connection/connection.php");
						
						if(isset($_POST['search']))
						{ 
						   $daripada = $_POST['daripada']; 
						   $hingga = $_POST['hingga'];
						   $statuss = $_POST['carisearch']; 
						}
						//if($statuss == '1')
						//{
							//$sql_search="SELECT id_kerosakkan,jenis_kerosakan,catatan_kerosakkan,catatan_tindakkan,tarikh_kerosakkan FROM sej6x_data_kerosakkan WHERE id_masjid='$id_masjid' AND tarikh_kerosakkan BETWEEN '$daripada' AND '$hingga' "; 
							$sql_search="SELECT a.id_kerosakan, a.id_masjid, a.tarikh_kerosakan, a.masa_kerosakan, b.nama_peralatan, d.jenis_inventori, c.kat_penyelenggara, a.kuantiti, a.kuantiti_unit, c.nama_penyelenggara, a.lokasi_kerosakan, c.no_telefon, a.id_statuskerosakan,
                                         CASE WHEN a.id_statuskerosakan = 1 THEN 'MAKLUMAT AWAL PENYELENGGARA' WHEN a.id_statuskerosakan = 2 THEN 'DALAM PROSES PEMBAIKAN (VENDOR)' WHEN a.id_statuskerosakan = 3 THEN 'DALAM PROSES PEMBAIKAN (MASJID)' WHEN a.id_statuskerosakan = 4 THEN 'TELAH SIAP DIBAIKI' WHEN a.id_statuskerosakan = 5 THEN 'ROSAK & DILUPUS' ELSE 'TIADA TINDAKAN' END AS status 
                                         FROM sej6x_data_kerosakkan a 
                                         LEFT JOIN sej6x_data_inventori b on a.id_peralatan = b.id_inventori
                                         LEFT JOIN penyelenggara c ON a.id_penyelenggara = c.id_penyelenggara
                                         LEFT JOIN sej6x_data_jenisinventori d on b.jenis_peralatan = d.id_jenisinventori
                                         WHERE a.id_masjid ='$id_masjid'";
							$result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error($bd2));
						?> 
							<table id="meja_kerosakan" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
								<thead>
									<tr>
										<th><div align="center">Bil</div></th>
										<th><div align="center">Tarikh</div></th>
										<th><div align="center">Masa</div></th>
										<th><div align="center">Nama<br>Peralatan</div></th>
										<th><div align="center">Kategori<br>Peralatan</div></th>
                                        <th><div align="center">Kategori<br>Penyelenggara</div></th>
                                        <th><div align="center">Kuantiti<br>& Unit</div></th>
                                        <th><div align="center">Nama<br>Penyelenggara</div></th>
                                        <th><div align="center">Lokasi</div></th>
                                        <th><div align="center">No.<br>Telefon</div></th>
                                        <th><div align="center">Status</div></th>
                                        <th><div align="center"></div></th>
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
										<td><div align="center"><?php echo $row['tarikh_kerosakan']; ?></div></td>
										<td><div align="center"><?php echo $row['masa_kerosakan']; ?></div></td>
										<td><div align="center"><?php echo strtoupper($row['nama_peralatan']); ?></div></td>
                                        <td><div align="center"><?php echo strtoupper($row['jenis_inventori']); ?></div></td>
                                        <td><div align="center"><?php echo strtoupper($row['kat_penyelenggara']); ?></div></td>
                                        <td><div align="center"><?php echo $row['kuantiti']; ?>&nbsp;<?php echo $row['kuantiti_unit']; ?></div></td>
                                        <td><div align="center"><?php echo strtoupper($row['nama_penyelenggara']); ?></div></td>
                                        <td><div align="center"><?php echo strtoupper($row['lokasi_kerosakan']); ?></div></td>
                                        <td><div align="center"><?php echo $row['no_telefon']; ?></div></td>
                                        <td><div align="center"><?php echo $row['status']; ?></div></td>
                                        <?php
                                        $id_statuskerosakan = $row['id_statuskerosakan'];
                                        if ($id_statuskerosakan != '4' && $id_statuskerosakan != '5') {
                                        ?>
                                            <td>
                                                <div align="center" style="display: block">
                                                    <a href="utama.php?view=admin&action=semak_kerosakan&id_kerosakan=<?php echo $row['id_kerosakan'];?>&sideMenu=masjid">
                                                        <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div align="center" style="display: block">
                                                    <form name="delete" method="POST" action="admin/del_kerosakkan.php">
                                                        <input type="hidden" name="del" id="del" value="<?php echo $row['id_kerosakan']; ?>">
                                                        <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="far fa-trash-alt" onclick="return confirm('Padam Rekod?');"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        <?php
                                        } else { ?>
                                            <td>
                                                <div align="center" style="display: block">
                                                    <a href="utama.php?view=admin&action=view_kerosakan&id_kerosakan=<?php echo $row['id_kerosakan'];?>&sideMenu=masjid">
                                                        <button type="button" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">
                                                            <i class="fa fa-book-reader"></i>
                                                        </button>
                                                    </a>
                                                </div>
<!--                                                <div align="center" style="display: none">-->
<!--                                                    <a href="utama.php?view=admin&action=semak_kerosakan&id_kerosakan=--><?php //echo $row['id_kerosakan'];?><!--&sideMenu=masjid">-->
<!--                                                        <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">-->
<!--                                                            <i class="fa fa-pencil"></i>-->
<!--                                                        </button>-->
<!--                                                    </a>-->
<!--                                                </div>-->
<!--                                                <div align="center" style="display: none">-->
<!--                                                    <form name="delete" method="POST" action="admin/del_kerosakkan.php">-->
<!--                                                        <input type="hidden" name="del" id="del" value="--><?php //echo $row['id_kerosakan']; ?><!--">-->
<!--                                                        <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="far fa-trash-alt" onclick="return confirm('Padam Rekod?');"></i></button>-->
<!--                                                    </form>-->
<!--                                                </div>-->
                                            </td>
                                        <?php } ?>
									</tr>
						<?php 
							
								$x++;
								}
						//}
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
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_kerosakan', 'Senarai Kerosakan', [ 0, 1, 2, 3 ]);
    });
</script>

   