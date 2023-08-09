
<div class="row">
            	<?php 
						include("connection/connection.php");
						$result= mysql_query("SELECT id_masjid,kod_masjid,nama_masjid,alamat_masjid 
						FROM sej6x_data_masjid 
						WHERE kod_masjid='$jname'") or die("SELECT Error: ".mysql_error()); 
						$namamasjid = mysql_fetch_assoc($result);
                ?>
            
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">DASHBOARD </h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            
<!-- div class="panel-body">
                            <div class="alert alert-success">
                               <div align="center">
                                 <p>Selamat Datang Ke Sistem Pengurusan Masjid (E-SPMD)</p>
                                 
                                 <p><?php echo $namamasjid['nama_masjid'];echo",";echo $namamasjid['alamat_masjid']; ?></p>
                               </div>
                            </div>
</div -->

            
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                              <?php 
							
                           include("connection/connection.php");

						  $sql_search="SELECT count(id_data) as 'ahli_kariah' 
						   FROM sej6x_data_peribadi 
						  "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error()); 
						   while($row = mysql_fetch_assoc($result)){
						  ?>
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row['ahli_kariah']; ?></div>
                                    <div>[ Jumlah Ahli Kariah]</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=admin&action=pendaftaran_ahli_qariah">
                            <div class="panel-footer">
                                <span class="pull-left">Semak</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php 									
                 }
                ?>
      
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                             <?php 
							
                           include("connection/connection.php");

						  $sql_search="SELECT count(id_dataajk) as 'ajk' 
						   FROM data_ajkmasjid 
						  "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error()); 
						   while($row = mysql_fetch_assoc($result)){
						  ?>
                                <div class="col-xs-3">
                                    <i class="fa fa-sitemap fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row['ajk']; ?></div>
                                    <div>[  AJK Masjid ]</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=senarai_ajk">
                            <div class="panel-footer">
                                <span class="pull-left">Semak</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                  <?php 									
                 }
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                             <?php 
							
                           include("connection/connection.php");

						  $sql_search="SELECT count(id_datapegawai) as 'pegawai' 
						   FROM data_pegawai_masjid 
						  "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error()); 
						   while($row = mysql_fetch_assoc($result)){
						  ?>
                                <div class="col-xs-3">
                                    <i class="  fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row['pegawai']; ?></div>
                                    <div>[ Pegawai Masjid ]</div>
                                </div>
                            </div>
                        </div>
                        <?php 									
                        }
                        ?>
                        <a href="utama.php?view=senarai_pegawai">
                            <div class="panel-footer">
                                <span class="pull-left">Semak</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                 <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                              <?php 
                            
                           include("connection/connection.php");

                          $sql_search="SELECT count(id_inventori) as 'inventori' 
                           FROM sej6x_data_inventori 
                          "; 
                          $result = mysql_query($sql_search) or die ("Error :".mysql_error()); 
                           while($row = mysql_fetch_assoc($result)){
                          ?>
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row['inventori']; ?></div>
                                    <div>[ Inventori Masjid]</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=maklumatinventori">
                            <div class="panel-footer">
                                <span class="pull-left">Semak</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                           </div>
                        </a>
                    </div>
                </div>
                <?php                                   
                 }
                ?>



            </div>
            <!-- /.row -->

           <!-- second line-->
           
            
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                               <?php 
                            
                           include("connection/connection.php");

                          $sql_search="SELECT count(id_kerosakkan) as 'bil_kerosakan' 
                           FROM sej6x_data_kerosakkan 
                          "; 
                          $result = mysql_query($sql_search) or die ("Error :".mysql_error()); 
                           while($row = mysql_fetch_assoc($result)){
                          ?>
                                <div class="col-xs-3">
                                    <i class="fa fa-wrench fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row['bil_kerosakan']; ?></div>
                                    <div>[ Jumlah Kerosakan ]</div>
                                </div>
                            </div>
                        </div>
                          <?php                                     
                 }
                ?>
                        <a href="utama.php?view=maklumatkerosakan">
                            <div class="panel-footer">
                                <span class="pull-left">Semak</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


      
             
            </div> 
            <!-- /.row -->

   
           
    