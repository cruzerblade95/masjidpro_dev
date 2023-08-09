   <?php
   $bd = mysqli_connect('spmd.tk', 'greenap4_masjid', 'WebmasterMasjid2018', 'greenap4_masjid');

   $idd = $_GET['no_barang'];

   $abc="SELECT * FROM maklumat_sewaan where sewa_rujukan='".$idd."' and sewa_status='TIADA'";
   $result=mysqli_query($bd,$abc);


   ?>


<div class="row">
            <div class="col-lg-12">
              <h1  align="center" class="page-header">MASIH DALAM SEWAAN</h1>
            </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Sewaan
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                   <form method="post" action="<?php echo $PHP_SELF;?>" name="borang_sewa">

                                        <?php  
							if(isset($_POST['btn_simpan_sewa']))
							{


						       $catatan=$_POST['catatan'];	
						       $sewa_keadaan=$_POST['sewa_keadaan'];
                                          	       $rujukan=$_POST['rujukan'];
                                                       $sewa_rujukan=$_POST['sewa_rujukan'];		
				
                                                       $query_maklumat_sewaan = "UPDATE maklumat_sewaan 
								set 
								sewa_keadaan='$sewa_keadaan',
								sewa_catatan='$catatan',
								sewa_status='ADA'
								where 
								sewa_rujukan='$sewa_rujukan'";

                                                       $query_sewa="UPDATE status_barang set status='ADA' where no_barang='$sewa_rujukan'";
					     
                                                       $r = mysqli_query($bd,$query_maklumat_sewaan);
						       $r = mysqli_query($bd,$query_sewa);

						       if($r)
                                                        {
							header('location: ../utama.php?view=admin&action=maklumatsewa');  
							}
							else
							{
							echo mysql_error();
							}
						}
							
                                            ?>
							
                                        <?php while($row = mysqli_fetch_assoc($result)){ ?>  
                                        <div class="form-group">
                                            <label>Tarikh Mula Sewa</label>
                                            <input class="form-control" name="sewa_tarikh_mula" value="<?php echo $row['sewa_tarikh_mula']; ?>" readonly>   
                                        </div> 

                                         <div class="form-group">
                                            <label>Tarikh Akhir Sewa</label>
                                            <input class="form-control" name="sewa_tarikh_akhir" value="<?php echo $row['sewa_tarikh_akhir']; ?>" readonly>   
                                        </div> 
                                        
                                        <div class="form-group">
                                            <label>Nama Penuh Penyewa</label>
                                            <input class="form-control" name="sewa_nama" value="<?php echo $row['sewa_nama']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>IC Penyewa</label>
                                            <input class="form-control" name="sewa_ic" value="<?php echo $row['sewa_ic']; ?>" readonly>
                                        </div> 
                                        
                                </div>

                                <div class="col-lg-4">

				     <div class="form-group">
                                            <label>Perkara</label>
                                            <input class="form-control" name="sewa_perkara" 
                                             value="<?php echo $row['sewa_perkara']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                            <label>Nama Jenama/Barang/Dewan</label>
                                            <input class="form-control" name="sewa_nama_perkara" 
                                             value="<?php echo $row['sewa_nama_perkara']; ?>" readonly>
                                    </div>  

				      <div class="form-group">
                                            <label>No Telefon Penyewa</label>
                                            <input class="form-control" name="sewa_telefon" value="<?php echo $row['sewa_telefon']; ?>" readonly>
                                    </div>
                                   
                                    <div class="form-group">
                                            <label>Alamat Penyewa</label>
                                            <textarea class="form-control" name="sewa_alamat" readonly><?php echo $row['sewa_alamat']; ?></textarea> 
                                    </div>
                                        
                                    
                                </div>
                                 
                                <div class="col-lg-4">

                                      <div class="form-group">
                                            <label>Deposit (RM)</label>
                                            <input class="form-control" name="sewa_deposit" value="<?php echo $row['sewa_deposit']; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Baki Bayaran (RM)</label>
                                            <input class="form-control" name="sewa_baki_bayaran" value="<?php echo $row['sewa_baki_bayaran']; ?>">
                                        </div>

                                    <div class="form-group">
                                            <label>AJK Yang Bertugas</label>
                                           <input class="form-control" name="sewa_ajk" value="<?php echo $row['sewa_ajk']; ?>"readonly>
                                        </div>

				    <div class="form-group">
                                            <label>Status keadaan dikembalikan</label>
                                            <select class="form-control" name="sewa_keadaan">
                                            <option value="0">Sila Pilih</option>
                                            <option value="1">Baik</option>
                                            <option value="2">Tidak Baik</option>
                                            </select>
                                        </div>

				
				   <div class="form-group">
                                            <label>Catatan (Status keadaan dikembalikan)</label>
                                            <textarea class="form-control" name="catatan" ></textarea> 
                                    </div>                                        
                                        <input type="hidden" name="sewa_rujukan" value="<?php echo $row['sewa_rujukan'];?>">

                                        <button type="submit" name="btn_simpan_sewa" 
                                        class="btn btn-primary" onclick="return confirm('Simpan maklumat?')" 
                                        >Simpan</button>
                                    
                                        <button type="reset" class="btn btn-primary">Padam</button>

                                         <?php } ?>
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
            <div class="row" class="col-lg-6">
                <div class="col-lg-6">                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="modal fade" id="printResit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="col-lg-12">
                                        <h1>Invois Sewa</h1><br>
                                        <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="picture/logoMasjid.jpg" style="width:85%; max-width:85px;">
                            </td>
                            
                            <td>
                                Invoice #: 123<br>
                                Created: January 1, 2019<br> 
                                Due: February 1, 2019
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Masjid Dato' Sheikh Adnan,  Penaga<br>
                                12345 Jalan Besar<br>
                                Kepala Batas, Pulau Pinang
                            </td>
                            
                            <td>
                                Nama Penyewa<br>
                                Nombor Telefon Penyewa<br>
                                Alamat Penyewa
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Deposit #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Baki 
                </td>
                
                <td>
                    300
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Item
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Sewa Dewan
                </td>
                
                <td>
                    RM 200.00
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Sewa Pinggan
                </td>
                
                <td>
                    RM 350
                </td>
            </tr>
            
            <tr class="item last">
                <td>
                    Sewa Van Jenazah
                </td>
                
                <td>
                    RM 80
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: RM 385.00
                </td>
            </tr>
        </table>
    </div><br>
                                            <div class="form-group" >
                                             <button type="submit" class="btn btn-primary" id="btn_register" name="btn_register" onclick="window.print();return false;" />Cetak </button>
                                            </div>
                                        </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                        <div class="modal-footer">
                                            
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>
                        <!-- .panel-body -->
                </div>
                
            </div>
            <!-- /.row -->




