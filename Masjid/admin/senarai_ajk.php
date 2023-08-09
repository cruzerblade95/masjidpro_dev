<?php

if($_SERVER['REQUEST_METHOD'] == "POST") {
    for($i = 0; $i < count($_POST['id_dataajk']); $i++) {
        $id_dataajk = $_POST['id_dataajk'][$i];
        $rank = $_POST['rank'][$i];
        if($rank != NULL) {
            $q_rank = "UPDATE data_ajkmasjid SET data_ajkmasjid.rank = $rank WHERE id_dataajk = $id_dataajk";
            mysqli_query($bd2, $q_rank) or die(mysqli_error($bd2));
        }
    }
}

	$sql_search = "SELECT a.id_data, a.id_masjid, a.nama_penuh, a.no_ic, a.no_hp, b.id_dataajk, b.jawatan, b.rank 'ranking' FROM sej6x_data_peribadi a, data_ajkmasjid b WHERE a.id_data=b.id_ajk AND a.id_masjid = $id_masjid
	                UNION SELECT CONCAT('A-', c.ID) 'id_data', c.id_masjid, c.nama_penuh, c.no_ic, c.no_tel 'no_hp', d.id_dataajk, d.jawatan, d.rank 'ranking' FROM sej6x_data_anakqariah c, data_ajkmasjid d WHERE c.ID = d.id_ajk2 AND c.id_masjid = $id_masjid
                    ORDER BY ranking ASC";
	$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

?>		  
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Senarai Ahli AJK Masjid</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
					<li class="active">Senarai Ahli AJK Masjid</li>
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
                    Senarai AJK Masjid &nbsp;&nbsp;
                    <button  class="btn btn-info" onclick="history.go(-1);">Kembali </button>
                </div>
                <form name="list_ajk" id="list_ajk" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'])?>" method="post" enctype="multipart/form-data"></form>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">No</div></th>
                                <th><div align="center">Nama</div></th>
                                <th><div align="center">No IC</div></th>
                                <th><div align="center">No Telefon</div></th>
                                <th><div align="center">Jawatan</div></th>
                                <th><div align="center">Susunan</div></th>
                                <th><div align="center">&nbsp;</div></th>
                                <th><div align="center">&nbsp;</div></th>
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
                                    <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                    <td><div align="center"><?php echo $row['no_hp']; ?></div></td>
                                    <td><div align="center"><?php echo $row['jawatan']; ?></div></td>
                                    <td><div align="center"><input name="id_dataajk[]" type="hidden" value="<?php echo($row['id_dataajk']); ?>" form="list_ajk"><input type="number" step="1" class="form-control" name="rank[]" value="<?php echo $row['ranking']; ?>" style="width: 75px; text-align: center" form="list_ajk"></div></td>
                                    <td><div align="center"><a href="utama.php?view=admin&action=semak_ajk&id_dataajk=<?php echo $row['id_dataajk'];?>&sideMenu=organisasi">[Kemaskini]</a></div></td>
                                    <td>
                                        <div align="center">
                                            <form name="delete" method="POST" action="admin/del_senaraiajk.php">
                                                <input type="hidden" name="del" id="del" value="<?php echo $row['id_dataajk']; ?>">
                                                <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')"><i class="fa fa-times"></i></button>
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
                    <div class="col-12 col-md-12 align-self-end" align="right"><button type="submit" form="list_ajk" class="btn btn-primary">Kemaskini Susunan</button></div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai AJK', [ 0, 1, 2, 3, 4 ]);
    });
</script>
 
                                         
                                
