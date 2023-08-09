<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Butiran AJK Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li><a href="utama.php?view=admin&action=senarai_ajk">Senarai AJK Masjid</a></li>
                    <li class="active">Butiran AJK Masjid</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Maklumat AJK Masjid &nbsp;&nbsp;
                    </div>
                    <?php
                    include("connection/connection.php");

                    $idd = $_GET['id_dataajk'];

                    $semak_ajk = "SELECT id_ajk, id_ajk2 FROM data_ajkmasjid WHERE id_dataajk = $idd";
                    $r_ajk = mysqli_query($bd2, $semak_ajk) or die ("Error :".mysqli_error($bd2));
                    $r_result = mysqli_fetch_assoc($r_ajk);
                    if($r_result['id_ajk'] != NULL) {
                        $sql_search="SELECT a.id_data,a.nama_penuh,a.no_ic,a.no_hp,a.alamat_terkini,a.poskod,a.pekerjaan,a.jantina,a.tarikh_lahir,
						b.id_dataajk,b.id_ajk,b.jawatan,b.tarikh_lantikan
						FROM sej6x_data_peribadi a, data_ajkmasjid b
						WHERE b.id_dataajk='".$idd."' 
						AND a.id_data=b.id_ajk";
                    }
                    if($r_result['id_ajk2'] != NULL) {
                        $sql_search="SELECT CONCAT('A-', c.ID) 'id_data',c.nama_penuh,c.no_ic,c.no_tel,a.alamat_terkini,a.poskod,c.jantina,c.tarikh_lahir,
						b.id_dataajk,b.id_ajk2 'id_ajk',b.jawatan,b.tarikh_lantikan
						FROM sej6x_data_peribadi a, data_ajkmasjid b, sej6x_data_anakqariah c
						WHERE b.id_dataajk='".$idd."' 
						AND c.ID=b.id_ajk2 AND a.id_data=c.id_qariah";
                    }
                    $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
                    $row=mysqli_fetch_array($result);
                    ?>
                    <form action="admin/add_ajk.php" method='post' enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama: <?php echo $row['nama_penuh'];?></label>
                                    </div>
                                    <div class="form-group">
                                        <label>No K/P: <?php echo $row['no_ic'];?> </label>
                                    </div>
                                    <div class="form-group">
                                        <label>No Telefon: <?php echo $row['no_hp'];?> </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat: <?php echo $row['alamat_terkini'];?> </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Poskod: <?php echo $row['poskod'];?> </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Pekerjaan: <?php echo $row['pekerjaan'];?> </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Jantina:
                                            <?php
                                            if($row['jantina']=='1')
                                            {
                                                echo "LELAKI";
                                            }
                                            else if($row['jantina']=='2')
                                            {
                                                echo "PEREMPUAN";
                                            }
                                            ?>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Tarikh Lahir: <?php echo $row['tarikh_lahir'];?> </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group row">
                                        <div class="col-12 col-md-6">
                                            <?php
                                            $id_dataajk = $_GET['id_dataajk'];

                                            $q = "SELECT gambar, jenis_gambar FROM data_ajkmasjid where id_dataajk='$id_dataajk'";
                                            $r = mysqli_query($bd2, $q);
                                            if($r)
                                            {
                                                $row1 = mysqli_fetch_array($r);
                                                $type = "Content-type: ".$row1['jenis_gambar'];
                                                //header($type);
                                                $image = $row1['gambar'];
                                                $jenis_gambar = $row1['jenis_gambar'];
                                            }
                                            else
                                            {
                                                echo mysqli_error($bd2);
                                            }
                                            ?>
                                            <label>
                                                <input id="gambar" name="gambar" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')">
                                                <?php echo '<img class="img-fluid p-3" id="output1" src="data:'.$jenis_gambar.';base64,'.$image .'" />'; ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-12 col-md-6">
                                            <label>Alamat Emel</label>
                                            <input class="form-control" type="email" name="emel" id="emel">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-6">
                                            <label>Jawatan</label>
                                            <select class="form-control" name="jawatan" id="jawatan">
                                                <option>Sila Pilih</option>
                                                <option value="Pengerusi" <?php if($row['jawatan'] == 'Pengerusi') echo 'selected'; ?>>Pengerusi</option>
                                                <option value="Timbalan Pengerusi" <?php if($row['jawatan'] == 'Timbalan Pengerusi') echo 'selected'; ?>>Timbalan Pengerusi</option>
                                                <option value="Setiausaha" <?php if($row['jawatan'] == 'Setiausaha') echo 'selected'; ?>>Setiausaha</option>
                                                <option value="Bendahari" <?php if($row['jawatan'] == 'Bendahari') echo 'selected'; ?>>Bendahari</option>
                                                <option value="AJK" <?php if($row['jawatan'] == 'AJK') echo 'selected'; ?>>AJK</option>
                                                <option value="Pemeriksa Kira-Kira" <?php if($row['jawatan'] == 'Pemeriksa Kira-Kira') echo 'selected'; ?>>Pemeriksa Kira-Kira</option>
                                            </select>
                                            <input type="hidden" id="index_ajk" name="index_ajk" value="">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label>Tarikh Lantikan</label>
                                            <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" value="<?php echo $row['tarikh_lantikan'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-12">
                                            <input type="hidden" name="id_dataajk" value="<?php echo $row['id_dataajk']; ?>">
                                            <input type="hidden" name="id_ajk" value="<?php echo $row['id_data']; ?>">
                                            <input type="submit"  value="Kemaskini" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
					