<?php
 $db = mysqli_connect('localhost', 'root', '', 'booking');
?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Borang Sewaan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Semak Tarikh</div>

                        <div class="panel-body">
                        <div class="row"> 
                            <form id="form1" name="form1" method="POST" action="<?php echo $PHP_SELF;?>">         
                            
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label>Daripada</label>
                                        <input class="form-control" name="datefrom" id="datefrom" type="date" required>
                              </div>    
                                </div>                     
                            
                              <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Hingga</label>
                                            <input class="form-control" name="dateto" id="dateto" type="date" required>   
                                        </div>    
                                </div>

                                <div class="col-lg-4">
									<label>Jenis Sewaan</label>
										
											<select  class="form-control" name="jenis_sewaan" id="jenis_sewaan" required>
											<option value="0">Sila Pilih</option>
											<option value="Dewan">Sewa Dewan</option>
											<option value="Pinggan">Sewa Pinggan Mangkuk</option>
											<option value="Kenderaan">Sewa Kenderaan</option>
											
											</select>
									
								</div>

                                <div class="col-lg-4">
                                  <input type="submit" name="search" value="Search" class="btn btn-primary"></input> 
                                    
                                </div>




                                <!-- div class="col-lg-4">
                                    <div class="form-group">
                                            <br>
                                            <input type="submit" name="search" value="Semak" class="btn btn-primary"></input> 

                                    </div>
                                     <input type="hidden" name="semak" value="1" />
                                </div -->
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

<div class="myClass" id="Dewan" style="display:none">

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Sewaan Dewan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <?php 

                                $datefrom = $_POST['datefrom'];   
                $datefrom = strtotime($datefrom); // Convert date to a UNIX timestamp  
                  
                // Specify the end date. This date can be any English textual format  
                $dateto = $_POST['dateto'];  
                $dateto = strtotime($dateto); // Convert date to a UNIX timestamp  
                  
                // Loop from the start date to end date and output all dates inbetween  
                for ($i=$datefrom; $i<=$dateto; $i+=86400) { 
                //$abc="SELECT * FROM booking_maklumat_sewaan where booking_perkara ='Dewan' AND status='Ada'";
                //$result=mysqli_query($db,$abc);



                                            $abc="SELECT * FROM maklumat_barang where barang_perkara ='Dewan'";
                                            //" AND status='Ada'";
                                            $result=mysqli_query($db,$abc);
                                ?>
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nama Dewan</th>
                                            <th>Lokasi Kenderaan</th>
                                            <th>Luas Dewan</th>
                                            <th>Kadar Sewa (RM)</th>
                                            <th>Tindakan</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php while($row=mysqli_fetch_assoc($result)){ ?>
                                        <tr>
                                            <td><?php echo $row['barang_perkara']; ?></td>
                                            <td><?php echo $row['barang_lokasi']; ?></td>
                                            <td><?php echo $row['barang_luas_kuantiti']; ?></td>
                                            <td><?php echo $row['barang_bayaran_sewa']; ?></td>
                                            <td align="center">
                                                <button type="submit" class="form-control btn-primary" onclick="location.href = 'utama.php?view=borang_sewa';">Sewa</button>

                                            </td>
                                            
                                        </tr>
                                         <?php 
                                         //$x++;

                                     }} ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>
        </div>
</div>



                    


<div class="myClass" id="Pinggan" style="display:none">
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Sewaan Pinggan
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">

                                <?php 
                                            $abc="SELECT * FROM maklumat_barang where barang_perkara ='Dewan'"; //AND status='Ada'";

                                            $result=mysqli_query($db,$abc);
    
                                        ?>


                            
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nama Pinggan</th>
                                            <th>Lokasi Simpan Pinggan</th>
                                            <th>Bilangan Pinggan</th>
                                            <th>Kadar Sewaan (RM)</th>
                                            <th>Tindakan</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                         <?php while($row=mysqli_fetch_assoc($result)){ ?>
                                        <tr>
                                            <td><?php echo $row['barang_perkara']; ?></td>
                                            <td><?php echo $row['barang_lokasi']; ?></td>
                                            <td><?php echo $row['barang_luas_kuantiti']; ?></td>
                                            <td><?php echo $row['barang_bayaran_sewa']; ?></td>
                                            <td align="center"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#borang_sewa">
                                            Sewa</button></td>
                                            
                                        </tr>
                                         <?php 
                                         //$x++;

                                     } ?>
                                         
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>
        </div>



<div class="myClass" id="Kenderaan" style="display:none">

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Sewaan Kenderaan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                 <?php 
                                             $abc="SELECT * FROM maklumat_barang where barang_perkara ='Kenderaan'"; //AND status='Ada'";

                                            $result=mysqli_query($db,$abc);
    
                                        ?>
                            
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Jenis Kenderaan</th>
                                            <th>Lokasi Kenderaan</th>
                                            <th>Bilangan Kenderaan</th>
                                            <th>Kadar Sewaan (RM)</th>
                                            <th>Tindakan</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php while($row=mysqli_fetch_assoc($result)){ ?>
                                        <tr>
                                            <td><?php echo $row['barang_perkara']; ?></td>
                                            <td><?php echo $row['barang_lokasi']; ?></td>
                                            <td><?php echo $row['barang_luas_kuantiti']; ?></td>
                                            <td><?php echo $row['barang_bayaran_sewa']; ?></td>
                                            <td align="center">
                                                <button type="submit" onclick="location.href = 'utama.php?view=borang_sewa';">Sewa</button>

                                            
                                                </td>
                                            
                                        </tr>
                                         <?php 
                                         //$x++;

                                     } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>
        </div>
</div>












<script type="text/javascript">
	
$(function () { 
    //$("#dewan").show();

    $("#jenis_sewaan").on("change", function () {
        $(".myClass").hide();
        $("div[id='" + $(this).val() + "']").show();
    });
});

</script>