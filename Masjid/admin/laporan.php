 <?php 
         include("connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
								
				 $bulan = $_POST['bulan'];
				 $tahun = $_POST['tahun'];
				}
				?>
            <div class="row">
                <div class="col-lg-12">
                   <h2 align="center" class="page-header">PENYATA KEWANGAN TABUNG MASJID <br><?php if(isset($_POST['search'])) { ?> BULAN <?php echo $bulan; ?> TAHUN <?php echo $tahun; } ?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carian</div>

                        <div class="panel-body">
                        <div class="row"> 
                            <form id="penyata_kewangan" name="penyata_kewangan" method="POST" action="<?php echo $PHP_SELF;?>">         
                            
                            <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Bulan</label>
                                            <select class="form-control" name="bulan" id="bulan">
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
                                            <input class="form-control" name="tahun" id="tahun" required>   
                                        </div>    
                                </div>      

                                <div class="col-lg-2">
                                    <div class="form-group">
                                            <br>
                                            <input type="submit" name="search" value="Semak" class="btn btn-primary"></input> 

                                    </div>
                                     <input type="hidden" name="carisearch" value="1" />
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
			
			<?php
			if(isset($_POST['search']))
			{ 
			?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Penyata Kewangan Tabung
                             <button onclick="myFunction()" class="btn btn-info">Cetak</button>
							<script>
							function myFunction() {
   						    window.print();
							}
							</script>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                           
                                <table class="table table-striped table-bordered table-hover">
                                
                                    <thead>
                                        <tr>
                                            
                                            <th><div align="center">Bil</div></th>
                                            <th><div align="center">Perkara</div></th>
                                            <th><div align="center">Baki Awal</div></th>
                                            <th><div align="center">Pendapatan</div></th>
                                            <th><div align="center">Pendapatan Penuh</div></th>
                                            <th><div align="center">Perbelanjaan</div></th>
                                            <th><div align="center">Baki Akhir</div></th>
                                            <th><div align="center">Tindakan</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <!--Tabung 1-->
                                        <tr class="odd gradeX">
                                           <?php 
                include("connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
								
				 $bulan = $_POST['bulan'];
				 $tahun = $_POST['tahun'];
						  
				$sql_search="SELECT ((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND    
				jenis_tabung='1' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE  
				jenis_duit='2' AND jenis_tabung='1' AND YEAR(tarikh)='$tahun'-1)) AS 'BakiAkhir' FROM  
				buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				}
				?>
                                            <td><div align="center">1</div></td>
                                            <td>Tabung Bergerak</td>
                                            
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?> 
		  								    <?php echo $row['BakiAkhir'] ?>
          								    <?php }?>
         								    </div></td>
                                              <?php 
             
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='1' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan'
				AND YEAR(tarikh)='$tahun'
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['Pendapatan'] ?>
                                           <?php }?>
                                           </div></td>
                                            <?php 
             
						  
				$sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) 
				FROM buku_tunai 
				WHERE jenis_duit='1' 
				AND jenis_tabung='1' 
				AND YEAR(tarikh)='$tahun'-1)-
				(SELECT IFNULL(SUM(amount),0) 
				FROM buku_tunai WHERE jenis_duit='2' 
				AND jenis_tabung='1' 
				AND YEAR(tarikh)='$tahun'-1))+ 
				(SELECT IFNULL(SUM(amount),0) 
				FROM buku_tunai 
				WHERE jenis_duit='1' 
				AND jenis_tabung='1' 
				AND MONTH(tarikh)='$bulan' 
				AND YEAR(tarikh)='$tahun')) 
				AS 'PendapatanPenuh' 
				FROM buku_tunai
				WHERE id_masjid='$id_masjid' 
				GROUP BY 'PendapatanPenuh'  "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                           
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['PendapatanPenuh'] ?>
                                           <?php }?>
                                           </div></td>
                                            
                                             <?php 
               // perbelanjaan Tabung 1
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Perbelanjaan' 
				FROM buku_tunai 
				WHERE jenis_tabung='1' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['Perbelanjaan'] ?>
           									<?php }?>
          								    </div></td>
                                             <?php 
               // Baki Akhir Tabung 1 
               $sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='1' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='1' AND YEAR(tarikh)='$tahun'-1))+((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='1' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='1' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun'))) AS 'BakiAkhir' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['BakiAkhir'] ?>
           									<?php }?>
          								    </div></td>
                                            <td><div align="center"><a target="_blank" href="utama.php?view=admin&action=tabung_bergerak&tahun=<?php echo $tahun;?>&bulan=<?php echo $bulan;?>">[Semak]</a></div></td>
                                        </tr>
                                        <!--End Tabung 1-->
                                        
                                        <!--Tabung 2-->
                                        <tr class="even gradeC">
                                          <?php 
				$sql_search="SELECT ((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND    
				jenis_tabung='2' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE  
				jenis_duit='2' AND jenis_tabung='2' AND YEAR(tarikh)='$tahun'-1)) AS 'BakiAkhir' FROM  
				buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center">2</div></td>
                                            <td>Tabung Kematian</td>
                                            
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?> 
		  								    <?php echo $row['BakiAkhir'] ?>
          								    <?php }?>
         								    </div></td>
                                              <?php 
             
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='2' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['Pendapatan'] ?>
                                           <?php }?>
                                           </div></td>
                                            <?php 
             
						  
				$sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='2' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='2' AND YEAR(tarikh)='$tahun'-1))+ (SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='2' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')) AS 'PendapatanPenuh' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'PendapatanPenuh'  "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                           
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['PendapatanPenuh'] ?>
                                           <?php }?>
                                           </div></td>
                                            
                                             <?php 
               // perbelanjaan Tabung 2
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Perbelanjaan' 
				FROM buku_tunai 
				WHERE jenis_tabung='2' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['Perbelanjaan'] ?>
           									<?php }?>
          								    </div></td>
                                             <?php 
               // Baki Akhir Tabung 2 
               $sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='2' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='2' AND YEAR(tarikh)='$tahun'-1))+((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='2' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='2' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun'))) AS 'BakiAkhir' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['BakiAkhir'] ?>
           									<?php }?>
          								    </div></td>
                                            <td><div align="center"><a href="utama.php?view=admin&action=tabung_kematian&tahun=<?php echo $tahun;?>&bulan=<?php echo $bulan;?>">[Semak]</a></div></td>
                                        </tr>
                                          <tr class="even gradeC">
                                          <!--Tabung 3-->
                                          <?php 
				$sql_search="SELECT ((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND    
				jenis_tabung='3' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE  
				jenis_duit='2' AND jenis_tabung='3' AND YEAR(tarikh)='$tahun'-1)) AS 'BakiAkhir' FROM  
				buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center">3</div></td>
                                            <td>Tabung Kenduri</td>
                                            
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?> 
		  								    <?php echo $row['BakiAkhir'] ?>
          								    <?php }?>
         								    </div></td>
                                              <?php 
             
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='3' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['Pendapatan'] ?>
                                           <?php }?>
                                           </div></td>
                                            <?php 
             
						  
				$sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='3' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='3' AND YEAR(tarikh)='$tahun'-1))+ (SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='3' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')) AS 'PendapatanPenuh' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'PendapatanPenuh'  "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                           
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['PendapatanPenuh'] ?>
                                           <?php }?>
                                           </div></td>
                                            
                                             <?php 
               // perbelanjaan Tabung 3
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Perbelanjaan' 
				FROM buku_tunai 
				WHERE jenis_tabung='3' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['Perbelanjaan'] ?>
           									<?php }?>
          								    </div></td>
                                             <?php 
               // Baki Akhir Tabung 3 
               $sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='3' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='3' AND YEAR(tarikh)='$tahun'-1))+((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='3' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='3' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun'))) AS 'BakiAkhir' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['BakiAkhir'] ?>
           									<?php }?>
          								    </div></td>
                                            <td><div align="center"><a href="utama.php?view=admin&action=tabung_kenduri&tahun=<?php echo $tahun;?>&bulan=<?php echo $bulan;?>">[Semak]</a></div></td>
                                        </tr>
                                        <!--End Tabung 3-->
                                        
                                        <tr class="even gradeC">
                                          <!--Tabung 4-->
                                          <?php 
				$sql_search="SELECT ((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND    
				jenis_tabung='4' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE  
				jenis_duit='2' AND jenis_tabung='4' AND YEAR(tarikh)='$tahun'-1)) AS 'BakiAkhir' FROM  
				buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center">4</div></td>
                                            <td>Tabung Wakaf</td>
                                            
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?> 
		  								    <?php echo $row['BakiAkhir'] ?>
          								    <?php }?>
         								    </div></td>
                                              <?php 
             
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='4' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['Pendapatan'] ?>
                                           <?php }?>
                                           </div></td>
                                            <?php 
             
						  
				$sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='4' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='4' AND YEAR(tarikh)='$tahun'-1))+ (SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='4' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')) AS 'PendapatanPenuh' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'PendapatanPenuh'  "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                           
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['PendapatanPenuh'] ?>
                                           <?php }?>
                                           </div></td>
                                            
                                             <?php 
               // perbelanjaan Tabung 4
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Perbelanjaan' 
				FROM buku_tunai 
				WHERE jenis_tabung='4' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun'
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['Perbelanjaan'] ?>
           									<?php }?>
          								    </div></td>
                                             <?php 
               // Baki Akhir Tabung 4
               $sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='4' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='4' AND YEAR(tarikh)='$tahun'-1))+((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='4' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='4' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun'))) AS 'BakiAkhir' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['BakiAkhir'] ?>
           									<?php }?>
          								    </div></td>
                                            <td><div align="center"><a href="utama.php?view=admin&action=tabung_wakaf&tahun=<?php echo $tahun;?>&bulan=<?php echo $bulan;?>">[Semak]</a></div></td>
                                        </tr>
                                        <!--End Tabung 4-->                                        
                                        <tr class="even gradeC">
                                          <!--Tabung 5-->
                                          <?php 
				$sql_search="SELECT ((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND    
				jenis_tabung='5' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE  
				jenis_duit='2' AND jenis_tabung='5' AND YEAR(tarikh)='$tahun'-1)) AS 'BakiAkhir' FROM  
				buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center">5</div></td>
                                            <td>TLK Wakaf Masjid</td>
                                            
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?> 
		  								    <?php echo $row['BakiAkhir'] ?>
          								    <?php }?>
         								    </div></td>
                                              <?php 
             
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='5' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan'
				AND YEAR(tarikh)='$tahun'
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['Pendapatan'] ?>
                                           <?php }?>
                                           </div></td>
                                            <?php 
             
						  
				$sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='5' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='5' AND YEAR(tarikh)='$tahun'-1))+ (SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='5' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')) AS 'PendapatanPenuh' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'PendapatanPenuh'  "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                           
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['PendapatanPenuh'] ?>
                                           <?php }?>
                                           </div></td>
                                            
                                             <?php 
               // perbelanjaan Tabung 5
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Perbelanjaan' 
				FROM buku_tunai 
				WHERE jenis_tabung='5' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun'
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['Perbelanjaan'] ?>
           									<?php }?>
          								    </div></td>
                                             <?php 
               // Baki Akhir Tabung 5 
               $sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='5' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='5' AND YEAR(tarikh)='$tahun'-1))+((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='5' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='5' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun'))) AS 'BakiAkhir' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['BakiAkhir'] ?>
           									<?php }?>
          								    </div></td>
                                           <td><div align="center"><a href="utama.php?view=admin&action=tlk_wakaf_masjid&tahun=<?php echo $tahun;?>&bulan=<?php echo $bulan;?>">[Semak]</a></div></td>
                                        </tr>
                                        <!--End Tabung 5-->
                                        <tr class="even gradeC">
                                          <!--Tabung 6-->
                                          <?php 
				$sql_search="SELECT ((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND    
				jenis_tabung='6' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE  
				jenis_duit='2' AND jenis_tabung='6' AND YEAR(tarikh)='$tahun'-1)) AS 'BakiAkhir' FROM  
				buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center">6</div></td>
                                            <td>TLK Wakaf Kubur</td>
                                            
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?> 
		  								    <?php echo $row['BakiAkhir'] ?>
          								    <?php }?>
         								    </div></td>
                                              <?php 
             
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='6' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['Pendapatan'] ?>
                                           <?php }?>
                                           </div></td>
                                            <?php 
             
						  
				$sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='6' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='6' AND YEAR(tarikh)='$tahun'-1))+ (SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='6' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')) AS 'PendapatanPenuh' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'PendapatanPenuh'  "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                           
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['PendapatanPenuh'] ?>
                                           <?php }?>
                                           </div></td>
                                            
                                             <?php 
               // perbelanjaan Tabung 6
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Perbelanjaan' 
				FROM buku_tunai 
				WHERE jenis_tabung='6' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['Perbelanjaan'] ?>
           									<?php }?>
          								    </div></td>
                                             <?php 
               // Baki Akhir Tabung 6 
               $sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='6' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='6' AND YEAR(tarikh)='$tahun'-1))+((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='6' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='6' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun'))) AS 'BakiAkhir' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['BakiAkhir'] ?>
           									<?php }?>
          								    </div></td>
                                             <td><div align="center"><a href="utama.php?view=admin&action=tlk_wakaf_kubur&tahun=<?php echo $tahun;?>&bulan=<?php echo $bulan;?>">[Semak]</a></div></td>
                                        </tr>
                                        <!--End Tabung 6-->
                                        
                                       <tr class="even gradeC">
                                          <!--Tabung 7-->
                                          <?php 
				$sql_search="SELECT ((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND    
				jenis_tabung='7' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE  
				jenis_duit='2' AND jenis_tabung='7' AND YEAR(tarikh)='$tahun'-1)) AS 'BakiAkhir' FROM  
				buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center">7</div></td>
                                            <td>Tabung Am</td>
                                            
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?> 
		  								    <?php echo $row['BakiAkhir'] ?>
          								    <?php }?>
         								    </div></td>
                                              <?php 
             
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='7' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['Pendapatan'] ?>
                                           <?php }?>
                                           </div></td>
                                            <?php 
             
						  
				$sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='7' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='7' AND YEAR(tarikh)='$tahun'-1))+ (SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='7' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')) AS 'PendapatanPenuh' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'PendapatanPenuh'  "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                           
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['PendapatanPenuh'] ?>
                                           <?php }?>
                                           </div></td>
                                            
                                             <?php 
               // perbelanjaan Tabung 7
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Perbelanjaan' 
				FROM buku_tunai 
				WHERE jenis_tabung='7' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['Perbelanjaan'] ?>
           									<?php }?>
          								    </div></td>
                                             <?php 
               // Baki Akhir Tabung 7 
               $sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='7' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='7' AND YEAR(tarikh)='$tahun'-1))+((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='7' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='7' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun'))) AS 'BakiAkhir' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['BakiAkhir'] ?>
           									<?php }?>
          								    </div></td>
                                           <td><div align="center"><a href="utama.php?view=admin&action=tabung_am&tahun=<?php echo $tahun;?>&bulan=<?php echo $bulan;?>">[Semak]</a></div></td>
                                        </tr>
                                        <!--End Tabung 7-->
                                       <tr class="even gradeC">
                                          <!--Tabung 8-->
                                          <?php 
				$sql_search="SELECT ((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND    
				jenis_tabung='8' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE  
				jenis_duit='2' AND jenis_tabung='8' AND YEAR(tarikh)='$tahun'-1)) AS 'BakiAkhir' FROM  
				buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center">8</div></td>
                                            <td>Tabung Kebajikan</td>
                                            
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?> 
		  								    <?php echo $row['BakiAkhir'] ?>
          								    <?php }?>
         								    </div></td>
                                              <?php 
             
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='8' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['Pendapatan'] ?>
                                           <?php }?>
                                           </div></td>
                                            <?php 
             
						  
				$sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='8' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='8' AND YEAR(tarikh)='$tahun'-1))+ (SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='8' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')) AS 'PendapatanPenuh' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'PendapatanPenuh'  "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                           
                                            <td><div align="center"> RM
		  								   <?php while($row = mysql_fetch_assoc($result)){ ?>
		                                   <?php echo $row['PendapatanPenuh'] ?>
                                           <?php }?>
                                           </div></td>
                                            
                                             <?php 
               // perbelanjaan Tabung 8
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				IFNULL(SUM(amount),0) AS 'Perbelanjaan' 
				FROM buku_tunai 
				WHERE jenis_tabung='8' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' 
				AND YEAR(tarikh)='$tahun' 
				AND id_masjid='$id_masjid'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['Perbelanjaan'] ?>
           									<?php }?>
          								    </div></td>
                                             <?php 
               // Baki Akhir Tabung 8 
               $sql_search="SELECT (((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='8' AND YEAR(tarikh)='$tahun'-1)-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='8' AND YEAR(tarikh)='$tahun'-1))+((SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='1' AND jenis_tabung='8' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun')-(SELECT IFNULL(SUM(amount),0) FROM buku_tunai WHERE jenis_duit='2' AND jenis_tabung='8' AND MONTH(tarikh)='$bulan' AND YEAR(tarikh)='$tahun'))) AS 'BakiAkhir' FROM buku_tunai WHERE id_masjid='$id_masjid' GROUP BY 'BakiAkhir'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
                                            <td><div align="center"> RM
		  								    <?php while($row = mysql_fetch_assoc($result)){ ?>
		  								    <?php echo $row['BakiAkhir'] ?>
           									<?php }?>
          								    </div></td>
                                             <td><div align="center"><a href="utama.php?view=admin&action=tabung_kebajikan&tahun=<?php echo $tahun;?>&bulan=<?php echo $bulan;?>">[Semak]</a></div></td>
                                        </tr>
                                      
                                        <!--End Tabung 8-->

                                        
                                       


                                       
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
			<?php 
			}
			?>
            <!-- /.row -->
            