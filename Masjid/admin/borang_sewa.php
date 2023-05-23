<?php
 require_once("connection/connection.php");

  $idd = $_GET['no_barang'];

  // $sql_search="SELECT 
   //id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp
  // FROM sej6x_data_peribadi WHERE id_data='".$idd."' "; 
  // $result = mysql_query($sql_search) or die ("Error :".mysql_error());

   $abc="SELECT * FROM status_barang where no_barang='".$idd."' ";
   $result=mysqli_query($bd2,$abc);
   ?>


<div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">BORANG SEWA</h1>
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
                                            $sewa_tarikh_mula = "";
                                            $sewa_tarikh_akhir = "";
                                            $sewa_nama    = "";
                                            $sewa_ic    = "";
                                            $sewa_telefon    = "";
                                            $sewa_alamat = "";
                                            $sewa_perkara = "";
                                            $sewa_nama_perkara = "";
                                            $sewa_deposit = "";
                                            $sewa_baki_bayaran = "";
                                            $sewa_ajk = "";
                                            
                                            $errors   = array(); 

                                            if (isset($_POST['btn_simpan_sewa'])) {
                                                register();
                                            }

                                            function register(){
                                                
                                                global $db, $errors, 
                                                $sewa_tarikh_mula, 
                                                $sewa_tarikh_akhir,
                                                $sewa_nama, 
                                                $sewa_ic, 
                                                $sewa_telefon, 
                                                $sewa_alamat, 
                                                $sewa_perkara, 
                                                $sewa_nama_perkara, 
                                                $sewa_deposit;
                                                $sewa_baki_bayaran;
                                                $sewa_ajk;

                                                $sewa_tarikh_mula    = $_POST['sewa_tarikh_mula'];
                                                $sewa_tarikh_akhir    = $_POST['sewa_tarikh_akhir'];
                                                $sewa_nama    = $_POST['sewa_nama'];
                                                $sewa_ic    = $_POST['sewa_ic'];
                                                $sewa_telefon = $_POST['sewa_telefon'];
                                                $sewa_alamat = $_POST['sewa_alamat'];
                                                $sewa_perkara = $_POST['sewa_perkara'];
                                                $sewa_nama_perkara    = $_POST['sewa_nama_perkara'];
                                                $sewa_deposit    =$_POST['sewa_deposit'];
                                                $sewa_baki_bayaran    =$_POST['sewa_baki_bayaran'];
                                                $sewa_ajk    =$_POST['sewa_ajk'];

                                                if (count($errors) == 0) {
                                                    
                                                    if (isset($_POST['sewa_tarikh_mula'])) {
                                                        $sewa_tarikh_mula = $_POST['sewa_tarikh_mula'];

                                                        $query = "INSERT INTO maklumat_sewaan (
                                                        sewa_tarikh_mula, 
                                                        sewa_tarikh_akhir, 
                                                        sewa_nama, 
                                                        sewa_ic, 
                                                        sewa_telefon, 
                                                        sewa_alamat, 
                                                        sewa_perkara,
                                                        sewa_nama_perkara,
                                                        sewa_deposit,
                                                        sewa_baki_bayaran,
                                                        sewa_ajk,
                                                        sewa_status
                                                        ) 

                                                                  VALUES(
                                                                  '$sewa_tarikh_mula', 
                                                                  '$sewa_tarikh_akhir', 
                                                                  '$sewa_nama', 
                                                                  '$sewa_ic', 
                                                                  '$sewa_telefon', 
                                                                  '$sewa_alamat', 
                                                                  '$sewa_perkara',
                                                                  '$sewa_nama_perkara',
                                                                  '$sewa_deposit'.
                                                                  '$sewa_baki_bayaran'.
                                                                  '$sewa_ajk',
                                                                  'TIADA'
                                                        )";

                                                        mysqli_query($db, $query);
                                                    
                                                    }
                                                    
                                                }
                                            }
                                            ?>
                                        <?php while($row = mysqli_fetch_assoc($result)){ ?>  
                                        <div class="form-group">
                                            <label>Tarikh Mula Sewa</label>
                                            <input class="form-control" name="sewa_tarikh_mula" type="date">   
                                        </div> 

                                         <div class="form-group">
                                            <label>Tarikh Akhir Sewa</label>
                                            <input class="form-control" name="sewa_tarikh_akhir" type="date">   
                                        </div> 
                                        
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
                                    </div>
                                        
                                        
                                </div>

                                <div class="col-lg-4">
                                   
                                    <div class="form-group">
                                            <label>Alamat Penyewa</label>
                                            <textarea class="form-control" name="sewa_alamat"></textarea> 
                                    </div>
                                        
                                    <div class="form-group">
                                            <label>Perkara</label>
                                               <input class="form-control" name="sewa_nama_perkara" value="<?php echo $row['status_nama_perkara']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                            <label>Nama Jenama/Barang/Dewan</label>
                                            <input class="form-control" name="sewa_perkara" 
                                             value="<?php echo $row['status_nama']; ?>" disabled>
                                    </div>  
                                </div>
                                 
                                <div class="col-lg-4">
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
                                            <select class="form-control" name="sewa_ajk" >
                                            <option value="0">Sila Pilih</option>
                                            <option value="Dewan">Encik Yusoff Manan</option>
                                            <option value="Pinggan">Encik Firdaus Ikmal</option>
                                            <option value="Kenderaan">Encik Faisol Hambali</option>
                                            </select>
                                        </div>
 
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




