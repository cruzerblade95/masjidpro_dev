<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">LAPORAN ADUAN</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
     <?php 
                          //include("connection/connection.php");

						  $sql_search="SELECT 
						  id_aduan,nama,no_kp,jenis_aduan,aduan,cadangan
						  FROM data_aduan "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Senarai Aduan</div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                           <div class="table-responsive">                                 
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No.K/P</div></th>
                                            <th><div align="center">Jenis Aduan</div></th>
                                            <th><div align="center">Aduan</div></th>
                                            <th><div align="center">Cadangan</div></th>
                                            <th><div align="center">Tindakan</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php $x=1; ?>
                                   <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama']; ?></td>
                                             <td><div align="center"><?php echo $row['no_kp']; ?></div></td>
                                            <td><div align="center">
                                             <?php 
											 if($row["jenis_aduan"]=='1')
											 {
											  echo "Pentadbiran"; }
						
											  else if($row["jenis_aduan"]=='2') 
											 {
						 					  echo "Penceramah"; 
											  } 
											  else if($row["jenis_aduan"]=='3') 
											 {
						 					  echo "Dana"; }  
											   else if($row["jenis_aduan"]=='4') 
											 {
						 					  echo "Kerosakan"; }
											 
											   else if($row["jenis_aduan"]=='5') 
											 {
						 					  echo "Jenayah"; }  
											   else if($row["jenis_aduan"]=='6') 
											 {
						 					  echo "Lain-Lain"; } 
											  ?>
                          </td>
                          <td><?php echo $row['aduan']; ?></td>
                          <td><?php echo $row['cadangan']; ?></td>
                          
                          <td>
                            <form name="delete" method="POST" action="admin/del_Aduan.php">
        
                           <input type="hidden" name="del" id="del" value="<?php echo $row['id_aduan']; ?>">
                           <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onClick="return confirm('Padam aduan ini?');"><i class="fa fa-times" ></i></button>

                            </form>
                          </td> 
                                        </tr>
                                         <?php 
  $x++;
   }
  ?>
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
            <!-- /.row -->

