
    <div class="row">
                <div class="col-lg-12">
                    <!--WAKAF-->
                     <?php if($_GET['jenis'] == "wakaf") { ?>
                    <h1 align="center" class="page-header">SENARAI PEMBAYAR WAKAF</h1><?php } ?>
                    <!--ZAKAT-->
                    <?php if($_GET['jenis'] == "zakat") { ?>
                    <h1 align="center" class="page-header">SENARAI PEMBAYAR ZAKAT</h1><?php } ?>
                     <!--YURAN KARIAH-->
                    <?php if(!$_GET['jenis']) { ?>
                    <h1 align="center" class="page-header">SENARAI PEMBAYAR YURAN KARIAH</h1><?php } ?>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
            <?php
			if($_GET['jenis'] == "wakaf") $jenis_bayaran = 4;
            if($_GET['jenis'] == "zakat") $jenis_bayaran = 3;
            if(!$_GET['jenis']) $jenis_bayaran = 1;
			
            $sql_search="SELECT b.id_data,b.nama_penuh,b.no_ic,a.tarikh_bayaran,a.jumlah,b.no_hp,a.id_bayaran 
			FROM sej6x_data_terimabayaran a, sej6x_data_peribadi b, sej6x_data_ajkmasjid c 
			WHERE a.id_data=b.id_data AND a.id_ajk = c.id_ajk 
			AND a.id_masjid=b.id_masjid
			AND a.id_masjid=c.id_masjid
			AND a.id_masjid='$id_masjid'
			AND a.id_jenisbayaran='".$jenis_bayaran."' 
			UNION SELECT id_data, CONCAT('BK - ', nama) 'nama', no_kp, tarikh_bayaran, jumlah, no_phone,id_bayaran 
			FROM sej6x_data_terimabayaran 
			WHERE id_masjid='$id_masjid'
			AND id_data='0'
			AND id_jenisbayaran= '".$jenis_bayaran."' "; 
	        $result = mysql_query($sql_search) or die ("Error :".mysql_error());
			?>		  
               
 			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if($_GET['jenis'] == "wakaf") { ?>Senarai Pembayar Wakaf<?php } ?>
                            <?php if($_GET['jenis'] == "zakat") { ?>Senarai Pembayar Zakat<?php } ?>
                            <?php if(!$_GET['jenis']) { ?>Senarai Pembayar Yuran Kariah<?php } ?>
                            </div>
                        <div class="panel-body">
                           <div class="table-responsive">              	                               
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No IC</div></th>
                                            <th><div align="center">No Telefon</div></th>
                                            <th><div align="center">Tarikh Bayar</div></th>
                                            <th><div align="center">Jumlah (RM)</div></th>
                                            <th><div align="center"></div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php $x=1; ?>
                                        <?php while($row = mysql_fetch_assoc($result)){ ?> 
                                      <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                            <td><div align="center"><?php echo $row['no_hp']; ?></div></td>
                                            <td><div align="center"><?php echo $row['tarikh_bayaran']; ?></div></td>
                                            <td><div align="center"><?php echo $row['jumlah']; ?></div></td>
                                            <td><div align="center"> 
							 <?php if(!$_GET['jenis']) { ?>
   <a href="utama.php?view=admin&action=terima_bayaran_terperinci&id_bayaran=<?php echo($row['id_bayaran']);?>&id_data=<?php echo($row['id_data']); ?>">[Cetak Resit]</a><?php } ?>
                             
                          <?php if($_GET['jenis'] == "wakaf") { ?>
   <a href="utama.php?view=admin&action=terima_bayaran_terperinci&jenis=wakaf&id_bayaran=<?php echo($row['id_bayaran']);?>&id_data=<?php echo($row['id_data']); ?>">[Cetak Resit]</a><?php } ?>
                             
                           <?php if($_GET['jenis'] == "zakat") { ?>
   <a href="utama.php?view=admin&action=terima_bayaran_terperinci&jenis=zakat&id_bayaran=<?php echo $row['id_bayaran'];?>&id_data=<?php echo($row['id_data']); ?>">[Cetak Resit]</a><?php } ?>
                             
                             
                             
                             </div></td>
                                        </tr>
                                         <?php  $x++; }?>  
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
         </div>
        </div>
       </div>
      </div>
     </div>
 
                              
            
            <!-- /.row -->
        
        <!-- /#page-wrapper -->

 
                                         
                                
