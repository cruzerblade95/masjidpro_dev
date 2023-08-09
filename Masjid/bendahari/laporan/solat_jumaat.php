<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">SOLAT JUMAAT</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Senarai Kariah Solat Jumaat
                            
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
                            
                              <?php 
                          include("connection/connection.php");
						  
						  $sql_search="SELECT nama_penuh,no_ic,alamat_terkini FROM sej6x_data_peribadi WHERE jantina='lelaki'";  
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>     
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No Kad Pengenalan</div></th>
                                            <th><div align="center">Alamat</div></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $x=1; ?>
                              <?php while($row = mysql_fetch_assoc($result)){ ?>
                                       
                                        <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                            <td><?php echo $row['alamat_terkini']; ?></td>
                                           
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

