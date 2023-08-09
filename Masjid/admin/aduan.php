<?php 

	$sql_search="SELECT a.nama, IF(b.no_hp IS NOT NULL, b.no_hp, c.no_tel) 'no_hp', a.time, a.jenis_aduan, a.cadangan, a.tindakkan FROM data_aduan a LEFT JOIN sej6x_data_peribadi b ON a.no_kp = b.no_ic LEFT JOIN sej6x_data_anakqariah c ON a.no_kp = c.no_ic WHERE a.id_masjid='$id_masjid' ORDER BY a.time ASC";
	$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
	
?> 
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Pandangan & Cadangan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Pandangan & Cadangan</li>
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
				   Senarai Pandangan & Cadangan
				</div>
				<div class="card-body">
					<div class="table-responsive">                                 
						<table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No H/P</div></th>
                                    <th width="10%"><div align="center">Tarikh</div></th>
									<th><div align="center">Jenis Pandangan & Cadangan</div></th>
									<!-- <th><div align="center">Pandangan</div></th>
									<th><div align="center">Cadangan</div></th> -->
                                    <th><div align="center">Pandangan & Cadangan</div></th>
                                    <th><div align="center">Tindakan</div></th>
                                    <th>&nbsp;</th>
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
									<td><?php echo strtoupper($row['nama']); ?></td>
									<td><div align="center"><?php echo $row['no_hp']; ?></div></td>
                                    <td align="center">
                                        <?php
                                        $tarikh = date_create($row['time']);
                                        echo date_format($tarikh,"Y-m-d");
                                        ?>
                                    </td>
									<td>
										<div align="center">
										<?php 
										echo $row['jenis_aduan'];
										?>
										</div>
									</td>
									<!-- <td align="center"><?php //echo $row['aduan']; ?></td>
									<td align="center"><?php //echo $row['cadangan']; ?></td> -->
                                    <td align="center"><?php echo $row['cadangan']; ?></td>
                                    <td align="center"><?php echo $row['tindakkan']; ?></td>
                                    <?php
                                    $tindakkan = $row['tindakkan'];
                                    if(($tindakkan=='')){
                                    ?>
                                        <td align="center">
                                            <button class="btn btn-danger" type="button" onclick="showSebab(<?php echo $row['id_aduan']; ?>, '<?php echo($row['tindakkan']); ?>')">Respon</button>
                                        </td>
                                    <?php
                                    }
                                    else{
                                    ?>
                                    <td align="center">
                                        <button class="btn btn-success" type="button" onclick="showSebab(<?php echo $row['id_aduan']; ?>, '<?php echo($row['tindakkan']); ?>')">Edit Respon</button>
                                    </td>
									<?php } ?>
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
        meja_akaun('#meja_akaun2', 'Senarai Pandangan & Cadangan', [ 0, 1, 2, 3, 4, 5 ]);
    });
</script>