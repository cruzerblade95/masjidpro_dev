<style type="text/css">
@media print {
    #printbtn {
        display :  none;
    }
}
</style>

<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">KEHADIRAN PEGAWAI MASJID</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
                  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default" id="printbtn">
                        <div class="panel-heading">
                            Carian</div>

                        <div class="panel-body">
                        <div class="row"> 
              <form id="kehadiran_terperinci" name="kehadiran_terperinci" method="POST" action="<?php echo $PHP_SELF;?>">                              
                               
                                <div class="col-lg-3">                                   
                                        <div class="form-group">
                                            <label>Bulan</label>
                                        <select class="form-control" name="month" id="month">
                                        <option value="" selected="selected">Sila Pilih Bulan</option>
                                        <option value="01" <?php if ($month=="01"){echo "selected='SELECTED'";}?>>Januari</option>
                                        <option value="02" <?php if ($month=="02"){echo "selected='SELECTED'";}?>>Februari</option>   
                                        <option value="03" <?php if ($month=="03"){echo "selected='SELECTED'";}?>>Mac</option>   
                                        <option value="04" <?php if ($month=="04"){echo "selected='SELECTED'";}?>>April</option>   
                                        <option value="05" <?php if ($month=="05"){echo "selected='SELECTED'";}?>>Mei</option>   
                                        <option value="06" <?php if ($month=="06"){echo "selected='SELECTED'";}?>>Jun</option>   
                                        <option value="07" <?php if ($month=="07"){echo "selected='SELECTED'";}?>>Julai</option>   
                                        <option value="08" <?php if ($month=="08"){echo "selected='SELECTED'";}?>>Ogos</option>   
                                        <option value="09" <?php if ($month=="09"){echo "selected='SELECTED'";}?>>September</option>   
                                        <option value="10" <?php if($month=="10"){echo "selected='SELECTED'";}?>>Oktober</option>   
                                        <option value="11" <?php if($month=="11"){echo "selected='SELECTED'";}?>>November</option>   
                                        <option value="12" <?php if($month=="12"){echo "selected='SELECTED'";}?>>Disember</option>   
                                        </select>                                                                                                                            
                                        </div>    
                                </div>

                                <div class="col-lg-3">                                    
                                       <div class="form-group">
                                             <label>Tahun</label>
                                            <input class="form-control" placeholder="Contoh: 2018" name="tahun" id="tahun" required>                                          
                                  </div>
                                </div>

                                <div class="col-lg-3">
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
                   
            </div>

 
  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Rekod Kehadiran
                             <button id="printbtn" onclick="myFunction()" class="btn btn-info">Cetak</button>
							<script>
							function myFunction() {
   						    window.print();
							}
							</script>
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div class="table-responsive">
                            
                             <?php 
                          include("connection/connection.php");
						  include("../fungsi_tarikh.php");
						  $tahun_view = date("Y");
						  $month = date("m");
						  $datetime_view = "$tahun_view-$month-01 00:00:00";
						   if(isset($_POST['search']))
	 					  { 
								
							$month = $_POST['month'];
							$tahun = $_POST['tahun'];
							$datetime_view = "$tahun-$month-01 00:00:00";
						    $id_ajk = $_GET['id_ajk'];
						    $sql_search="SELECT a.nama_penuh, a.jawatan_lantikan 
						    FROM sej6x_data_ajkmasjid a 
						    WHERE a.id_ajk = $id_ajk"; 
						  
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>
                          <table width="400" border="0" cellspacing="0" cellpadding="5" align="center">
  							<tr>
    						<th colspan="2" align="center"><br />
    						<div align="center">Maklumat Pegawai Masjid</div><br /></th>
    						</tr>
                            <?php while($row = mysql_fetch_assoc($result)){ ?>
  							<tr>
    						<td align="left"><strong>Nama</strong></td>
    						<td>  <?php echo $row['nama_penuh']; ?></td>
  							</tr>
  							<tr>
    						<td align="left"><strong>Jawatan</strong></td>
    						<td>  <?php echo $row['jawatan_lantikan']; ?></td>
  							</tr>
                            <tr>
    						<td align="left"><strong>Bulan</strong></td>
    						<td>  <?php echo $month; ?></td>
  							</tr>
                             <tr>
    						<td align="left"><strong>Tahun</strong></td>
    						<td>  <?php echo $tahun; ?></td>
  							</tr>
                            <?php } ?>
						</table><br />  
                               <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                        <th rowspan="2" style="display:none"><div align="center">Bil</div></th>
       									  <th rowspan="2"><div align="center">Tarikh</div></th>
       									  <th colspan="5"><div align="center">Butir-butir Kehadiran</div></th>
   									  </tr>
                                      <tr>
                                        <?php
                                    $sql_waktu = "SELECT a.perkara 'Perkara' FROM sej6x_data_perkarakehadiran a";
									$result2 = mysql_query($sql_waktu) or die ("Error :".mysql_error());
									?>
                                    <?php while($row = mysql_fetch_assoc($result2)){ ?>
       									  <th><div align="center"><?php echo $row['Perkara']; ?></div></th>
                                    <?php } ?>
   									  </tr>
                                  </thead>
                                   
                                  <tbody>
                                    <?php	
									if($tahun == NULL || $tahun > date('Y')) $tahun = date('Y');
									if($month == NULL || $month > date('m')) $bulan = date('m');
									$date_buat = date_create($tahun."-".$month."-01");
									$hari_last = date_format($date_buat,"t");
									date_default_timezone_set('Asia/Kuala_Lumpur');
									$period = new DatePeriod(
     								new DateTime($tahun.'-'.$month.'-01 00:00:00'),
     								new DateInterval('P1D'),
     								new DateTime($tahun.'-'.$month.'-'.$hari_last.' 23:59:59')
									);
									foreach ($period as $key => $value) {
									$list_tarikh = $value->format('Y-m-d H:i:s');
									$list_tarikh2 = $value->format('Y-m-d');
									
									$sql_waktu2 = "SELECT DATE_FORMAT(a.masa_mula, '%H:%i:%s') 'Waktu Mula', DATE_FORMAT(a.masa_tamat, '%H:%i:%s') 'Waktu Tamat' FROM sej6x_data_perkarakehadiran a";
									$resultspecial = mysql_query($sql_waktu2) or die ("Error :".mysql_error());
									?>
								   
                                    <?php $x=1; ?>
                                 
                   				    <tr>
                   			    	   <td style="display:none"><?php echo $x; ?></td>
       								   <td><?php fungsi_tarikh($list_tarikh, 2, 2); ?></td>
       								   <?php while($row = mysql_fetch_assoc($resultspecial)){ ?>
                   				 		   <th>
									  	     <div align="center">
									  	       <?php
										  	$waktu_mula = $row['Waktu Mula'];
										  	$waktu_mula = $list_tarikh2 . " " . $waktu_mula;
										  	$waktu_tamat = $row['Waktu Tamat'];
										  	$waktu_tamat = $list_tarikh2 . " " . $waktu_tamat;
                        $sql_waktuhadir = "SELECT IF(a.Clock BETWEEN DATE_FORMAT('$waktu_mula', '%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('$waktu_tamat', '%Y-%m-%d %H:%i:%s'), DATE_FORMAT(a.Clock, '%r'), '') 'Waktu Hadir' FROM sej6x_data_kehadiran a, sej6x_data_ajkmasjid b WHERE b.id_fingerprint = a.DIN AND b.id_ajk = $id_ajk";
											
										   	$result3 = mysql_query($sql_waktuhadir) or die ("Error :".mysql_error());
											  ?>
										  	    
									  	       <?php while($row = mysql_fetch_assoc($result3)) { ?>
									  	       <?php echo $row['Waktu Hadir']; ?>
									  	       <?php } ;?>            
						  	          </div></th>
                        <?php ; } ?> 
      					</tr>
       
                        <?php  }
						
					
                        }
							
						?>
					   
                        </tbody>

                              </table>

                            </div>
                            <!-- /.table-responsive -->
                         <div class="well">
                                   
                       <strong>Pengesahan Pengerusi Masjid,</strong>
                        
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                       
                       <strong>---------------------------------------------</strong>
                        <br>
               
                                </div>     
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
             
             