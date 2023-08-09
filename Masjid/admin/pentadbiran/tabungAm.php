<?php 
                include("connection/connection.php");
	  
				$bulan= $_GET['bulan'];
				$tahun= $_GET['tahun'];		 
				?>

<div class="row">
                    <div class="col-lg-12">

                        <h2 align="center">LAPORAN KEWANGAN
                      TABUNG AM<br>BULAN <?php echo $bulan ?> TAHUN <?php echo $tahun ?></h2>
                      

                    </div>
                </div>

                <hr />
                <div class="col-lg-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">Tabung Am
                    <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
						<script>
						function myFunction() {
   						 window.print();
							}
						</script>
                    </div>
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                          <thead>
                            <?php 
                include("connection/connection.php");
				
				$bulan= $_GET['bulan'];
				$tahun= $_GET['tahun'];
						  
				$sql_search="SELECT 
				id_bukutunai,id_masjid,jenis_duit,jenis_tabung,butiran,amount
				FROM buku_tunai 
				WHERE jenis_tabung='7' 
				AND MONTH(tarikh) = '".$bulan."' AND YEAR(tarikh)='".$tahun."' ";    
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
                            <tr>
                              <th><div align="center">BIL</div></th>
                              <th><div align="center">PERKARA</div></th>
                              <th><div align="center">PENDAPATAN (RM)</div></th>
                              <th><div align="center">PERBELANJAAN (RM)</div></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $x=1; ?>
                            <?php while($row = mysql_fetch_assoc($result)){ ?>
                            <tr class="odd gradeX">
                              <td><div align="center"><?php echo $x; ?></div></td>
                              <td><?php echo $row['butiran']; ?></td>
                              <td><div align="center">
                                <?php if ($row['jenis_duit']=='1') { ?>
                                <?php echo $row['amount']; ?>
                                <?php }?>
                              </div></td>
                              <td><div align="center">
                                <?php if ($row['jenis_duit']=='2') { ?>
                                <?php echo $row['amount']; ?>
                                <?php }?>
                              </div></td>
                            </tr>
                            <?php 
										
  $x++;
   }
  ?>
                            <tr class="odd gradeX">
                              <td>&nbsp;</td>
                              <th><div align="center">JUMLAH</div></th>
                              <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='7' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; ; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                              <th><div align="center">
                                <?php while($row = mysql_fetch_assoc($result)){ ?>
                                <?php echo $row['Pendapatan'] ?>
                                <?php }?>
                              </div></th>
                              <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='7' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                              <th><div align="center">
                                <?php while($row = mysql_fetch_assoc($result)){ ?>
                                <?php echo $row['Pendapatan'] ?>
                                <?php }?>
                              </div></th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
</div>
</div>


</div>
</div>





                                           <!-- END PAGE LEVEL SCRIPTS -->
         