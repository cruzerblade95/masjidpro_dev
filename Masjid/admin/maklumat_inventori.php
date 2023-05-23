<?php 
                include("connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
				 $daripada = $_POST['daripada'];				
				 $hingga = $_POST['hingga'];
				
				}
				?>
<?php
if($_GET['action']=="maklumatinventori")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Laporan Inventori</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
					<li class="active">Laporan Inventori</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<!-- div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carian &nbsp;&nbsp;
                            <button  class="btn btn-info" onclick="history.go(-1);">Kembali </button></div>

                        <div class="panel-body">
                        <div class="row"> 
                            <form id="form1" name="form1" method="POST" action="<?php //echo $PHP_SELF;?>">         
                            
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
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div -->
<div class="content mt-3">            
    <div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Maklumat Inventori
                    <?php
                    if($_GET['action']=="maklumatinventori")
                    {
                    ?>
					&nbsp;&nbsp;<a href="utama.php?view=admin&action=inventori" class="btn btn-primary">Tambah Inventori</a>
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
                    <?php

                    include("connection/connection.php");

                    $sql_search="SELECT id_inventori, no_rujukan, nama_inventori,kuantiti,harga_belian,peratus,bil_tahun,tarikh_belian,(kuantiti*harga_belian) as 'amaun',((kuantiti*harga_belian)*ROUND(peratus/100,2)) as 'susut', YEAR(tarikh_belian) as 'tahun', (kuantiti*harga_belian)-((kuantiti*harga_belian)*ROUND(peratus/100,2)) as 'aset_bersih' FROM sej6x_data_inventori WHERE id_masjid='$id_masjid'";
                    $result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error());

                    ?>
                    <div class="table-responsive">
                        <table id="meja_akaun3" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
							<thead>
								<tr>
									<th colspan="7"><div align="center">Harga Sebelum Susust Nilai</div></th>
									<th rowspan="2" width="20%"><div align="center">Semak</div></th>
								</tr>
								<tr>
									<th width="5%"><div align="center">Bil</div></th>
									<th width="25%"><div align="center">Nama Aset</div></th>
									<th width="10"><div align="center">Kod Aset</div></th>
									<th width="15%"><div align="center">Tarikh Belian</div></th>
									<th width="5%"><div align="center">Kuantiti</div></th>
									<th width="10%"><div align="center">Harga Belian Seunit (RM)</div></th>
									<th width="10%"><div align="center">Amaun (RM)</div></th>
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
									<td><div align="center"><?php echo $row['nama_inventori']; ?></div></td>
									<td align="center"><?php echo $row['no_rujukan']; ?></td>
									<td><div align="center"><?php echo $row['tarikh_belian']; ?></div></td>
									<td><div align="center"><?php echo $row['kuantiti']; ?></div></td>
									<td><div align="center"><?php echo $row['harga_belian']; ?></div></td>
									<td><div align="center"><?php echo $row['amaun'] ?></div></td>
									<td>
										<div align="center">
											<form action="admin/del_inventori.php" method="POST">
											<a href="utama.php?view=admin&action=susut_nilai&id_inventori=<?php echo $row['id_inventori'];?>&tarikh_belian=<?php echo $row['tahun'];?>">
												<button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">
													<i class="fa fa-search"></i>
												</button>
											</a>
											<a href="utama.php?view=admin&action=edit_inventori&id_inventori=<?php echo $row['id_inventori'];?>&tarikh_belian=<?php echo $row['tahun'];?>">
												<button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Kemaskini">
													<i class="fas fa-edit"></i>
												</button>
											</a>
											<!-- <form name="delete" method="POST" action="admin/del_inventori.php"> -->
												<input type="hidden" name="id_inventori" value="<?php echo $row['id_inventori']; ?>">
												<input type="hidden" name="no_rujukan" value="<?php echo $row['no_rujukan']; ?>">
												<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
												<button type="submit" name="delete" id="delete" class="btn btn-danger" title="Padam"><i class="far fa-trash-alt" onclick="return confirm('Padam Rekod?');"></i></button>
											<!-- </form> -->
											</form>
										</div>
									</td>
                                </tr>
							<?php 		
							$x++;
							}
							?>
							</tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun3', 'Senarai Inventori', [ 0, 1, 2, 3, 4, 5, 6 ]);
    });
</script>