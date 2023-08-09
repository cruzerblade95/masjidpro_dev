<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">SENARAI LAYAK MENGUNDI</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Senarai Layak Mengundi
                              <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal" style="display:none;">Tambah Ahli </button>
                             
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="table-responsive">
                             <?Php
              $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp 
						   FROM sej6x_data_peribadi where data_undi=1"; 
	                     $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>		                	                               
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No IC</div></th>
                                            <th><div align="center">Alamat</div></th>
                                            <th><div align="center">Tindakan</div></th>
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
                                             <td><div align="center">
                                              <a href="utama.php?view=setiausaha&action=kemaskini_layakmengundi&id_data=<?php echo $row['id_data'];?>"><button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">
                            					 	<i class="fa fa-pencil"></i>
                            					 </button></a>
                                             	 <form name="delete" method="POST" action="setiausaha/del_layakmengundi.php">
                                           <input type="hidden" name="del" id="del" value="<?php echo $row['id_data']; ?>">
                                           <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')"><i class="fa fa-times"></i>
                            					 </button> </form></div>
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

                                
                       
