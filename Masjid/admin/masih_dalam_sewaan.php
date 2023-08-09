
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">MASIH DALAM SEWAAN</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
            <?php
              $sql_search="SELECT * FROM maklumat_sewaan where sewa_status='TIADA'"; 
	      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
	    ?>		  
            
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat dalam Sewaan</div>

                        <div class="panel-body">
                           <div class="table-responsive"> 
                            <form method="post" id="asnaf" action="admin/del_asnaf.php">             	                               
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No Telefon</div></th>
                                            <th><div align="center">Jenis Sewaan</div></th>
 					    <th><div align="center">Perkara</div></th>
					    <th><div align="center">Rujukan</div></th>
  				            <th><div align="center">Tindakan</div></th>
                                        </tr>
                                       </thead>
                                       <tbody>
                                   <?php $x=1; ?>

                                   <?php while($row = mysql_fetch_assoc($result)){ ?>

                                      <tr class="odd gradeX">
                                          <td><div align="center"><?php echo $x; ?></div></td>
                                          <td><div align="center"><?php echo $row['sewa_nama']; ?></div></td>
                                          <td><div align="center"><?php echo $row['sewa_telefon']; ?></div></td>
                                          <td><div align="center"><?php echo $row['sewa_perkara']; ?></div></td>
                                          <td><div align="center"><?php echo $row['sewa_nama_perkara']; ?></div></td>
                                          <td><div align="center"><?php echo $row['sewa_rujukan'] ?></div></td>
                                          <td><div align="center">
                                          <a href="utama.php?view=admin&action=detail_masihsewaan&no_barang=<?php echo $row['sewa_rujukan'];?>"><button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">
                                          <div align="center"><i class="fa fa-search"></i>
                   			  </div>
                           		  </button></a></div></td>
                                      </tr>
                                        <?php  $x++; }?>  
                                         
                                  </tbody>
                                </table>
                                </form>
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

 
                                         
                                
