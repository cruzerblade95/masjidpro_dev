<?php
 $db = mysqli_connect('localhost', 'root', '', 'booking');
?>

<div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Tambah Fasiliti</h1>
            </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Fasiliti Baru
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <form method="post" action="utama.php?view=tambah_fasiliti">

                                    	<?php                                                                        
                                            $barang_tarikh_masuk = "";
                                            $barang_ajk = "";
                                            $barang_perkara    = "";
                                            $barang_nama    = "";
                                            $barang_harga_asal    = "";
                                            $barang_lokasi = "";
                                            $barang_luas_kuantiti = "";
                                            $barang_bayaran_sewa = "";
                                            
                                            $errors   = array(); 

                                            if (isset($_POST['btn_simpan'])) {
                                            	register();
                                            }

                                            function register(){
                                            	
                                            	global $db, $errors, 
                                                $barang_tarikh_masuk, 
                                                $barang_ajk, 
                                                $barang_perkara, 
                                                $barang_nama, 
                                                $barang_harga_asal, 
                                                $barang_lokasi, 
                                                $barang_luas_kuantiti, 
                                                $barang_bayaran_sewa;
                                                

                                            	$barang_tarikh_masuk    =  $_POST['barang_tarikh_masuk'];
                                            	$barang_ajk    =  $_POST['barang_ajk'];
                                            	$barang_perkara    =  $_POST['barang_perkara'];
                                            	$barang_nama    =  $_POST['barang_nama'];
                                            	$barang_harga_asal = $_POST['barang_harga_asal'];
                                            	$barang_lokasi = $_POST['barang_lokasi'];
                                            	$barang_luas_kuantiti = $_POST['barang_luas_kuantiti'];
                                            	$barang_bayaran_sewa    =  $_POST['barang_bayaran_sewa'];

                                            	if (count($errors) == 0) {
                                            		
                                            		if (isset($_POST['barang_tarikh_masuk'])) {
                                            			$barang_tarikh_masuk = $_POST['barang_tarikh_masuk'];

                                                        //table maklumat_barang
                                                        $query = "INSERT INTO maklumat_barang (
                                                        barang_tarikh_masuk, 
                                                        barang_ajk, 
                                                        barang_perkara, 
                                                        barang_nama, 
                                                        barang_harga_asal, 
                                                        barang_lokasi, 
                                                        barang_luas_kuantiti,
                                                        barang_bayaran_sewa) 
                                            					  VALUES(
                                                                  '$barang_tarikh_masuk', 
                                                                  '$barang_ajk', 
                                                                  '$barang_perkara', 
                                                                  '$barang_nama', 
                                                                  '$barang_harga_asal', 
                                                                  '$barang_lokasi', 
                                                                  '$barang_luas_kuantiti',
                                                                  '$barang_bayaran_sewa'
                                                        )";

                                                        //table status_barang
                                                        $query2 = "INSERT INTO status_barang (
                                                        status_nama_perkara, 
                                                        status_nama, 
                                                        status_lokasi, 
                                                        status_luas_kuantiti, 
                                                        status
                                                        ) 
                                                                  VALUES(                                  
                                                                  '$barang_perkara', 
                                                                  '$barang_nama',  
                                                                  '$barang_lokasi', 
                                                                  '$barang_luas_kuantiti',
                                                                  'ADA'
                                                        )";

                                            			mysqli_query($db, $query);
                                                        mysqli_query($db, $query2);
                                            		
                                            		}
                                            		
                                            	}
                                            }

                                            ?>


                                    	<div class="form-group">
                                            <label>Tarikh Terima Barang</label>
                                            <input class="form-control" name="barang_tarikh_masuk" type="date" required>   
                                        </div> 
                                        <div class="form-group">
                                            <label>Nama AJK Yang Bertanggungjawab</label>
                                            <input class="form-control" name="barang_ajk">
                                        </div>
                                    	<div class="form-group">
                                            <label>Perkara</label>
											<select  class="form-control" name="barang_perkara">
											<option value="0">Sila Pilih</option>
											<option value="Dewan">Dewan</option>
											<option value="Pinggan">Pinggan Mangkuk</option>
											<option value="Kenderaan">Kenderaan</option>
											</select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Jenama/Barang/Dewan</label>
                                            <input class="form-control" name="barang_nama">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Asal/Belian (RM)</label>
                                            <input class="form-control" name="barang_harga_asal">
                                        </div>
                                        
                                </div>

                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Alamat / Lokasi (Simpan) </label>
                                            <textarea class="form-control" name="barang_lokasi"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Luas Dewan/ Kuantiti Barang</label>
                                            <input class="form-control" name="barang_luas_kuantiti">
                                        </div>
                                       <div class="form-group">
                                            <label>Bayaran Untuk Sewaaan Selama Sehari (RM)</label>
                                            <input class="form-control" name="barang_bayaran_sewa">
                                        </div>
                                        
                                        <button type="submit" name="btn_simpan" class="btn btn-primary" onclick="return confirm('Simpan maklumat?')">Simpan</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                    </form>
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
<!-- /.row -->

