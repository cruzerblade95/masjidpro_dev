<?php 

include("connection/connection.php");

$sql_search="SELECT * FROM approve_bantuan WHERE id_masjid='6279' ORDER BY tujuan ASC"; 
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
$row=mysql_num_rows($result);
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Approve Ahli Kariah</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Approve Ahli Kariah</li>
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
                            Maklumat Ahli&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="card-body">
							<div class="table-responsive">
       	                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No K/P</div></th>
                                            <th><div align="left">Alamat</div></th>
                                            <th><div align="center">Tindakan</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
									if($row==0)
									{
									?>
										<tr>
											<td colspan="5" align="center">*Tiada Rekod*</td>
										</tr>
									<?php
									}
									else if($row>0)
									{
										$x=1; 
										while($row = mysql_fetch_assoc($result))
										{ 
									?>
                                        <tr>
                                            <td ><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                            <td ><?php echo $row['no_rumah']; ?></td>
                                            <td>
												<button type="button" name="submit" id="submit" class="form-control"  title="Bantu"><i class="fas fa-info"></i></button>
												<!-- <form name="daftar" method="POST" action="admin/add_approve.php">  
												   <input type="hidden" name="add" id="add" value="<?php echo $row['id']; ?>">
												   <input type="hidden" name="view" id="view" value="<?php echo $view;?>">   
												   <button type="submit" name="submit" id="submit" class="form-control"  title="Daftar"><i class="fas fa-user-plus" onclick="return confirm('Daftar Ahli Qariah?');"></i></button>
												</form>
												<form name="delete" method="POST" action="admin/del_approve.php">
													<input type="hidden" name="del" id="del" value="<?php echo $row['id']; ?>">
													<input type="hidden" name="view" id="view" value="<?php echo $view;?>">
													<button type="submit" name="delete" id="delete" class="form-control"  title="Padam"><i class="fas fa-user-minus" onclick="return confirm('Padam Rekod?');"></i></button>
												</form> -->
											</td>
										</tr>
                                    <?php 
										$x++; 
										} 
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
	</div>
</div>