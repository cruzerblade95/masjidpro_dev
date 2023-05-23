<head>

<script type="text/javascript">
$(document).ready(function() {

    $("#pakej option").filter(function() {
        return $(this).val() == $("#jumlah").val();
    }).attr('selected', true);

    $("#pakej").live("change", function() {

        $("#jumlah").val($(this).find("option:selected").attr("value"));
    });
});
</script>
</head>
        <!-- Page Content -->
            <div class="row">
            <div class="col-lg-12">
                    <h3 align="center" class="page-header">TERIMA BAYARAN</h3>
                </div>
                <!-- /.col-lg-12 -->
                  <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];
						  $tahun = $_GET['tarikh_belian'];
						  $bil_tahun = $_GET['bil_tahun'];
						  
						  $sql_search="SELECT 
						  id_data,nama_penuh,no_ic FROM sej6x_data_peribadi WHERE id_data='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  
						  //SQL AJKMASJID
						  
						   $sql_ajkmasjid="SELECT 
						  id_ajk,nama_penuh,no_ic,no_tel FROM sej6x_data_ajkmasjid WHERE id_masjid='$id_masjid'"; 
	                      $result1 = mysql_query($sql_ajkmasjid) or die ("Error :".mysql_error());
						  
						  $pilihan = $pilihan."<option>Sila Pilih AJK </option>";  
                          while($row1=mysql_fetch_array($result1))
						  {
							
                          $pilihanajk=$pilihanajk."<option value='$row1[id_ajk]'>$row1[nama_penuh]</option>";
                          }
						  
						  
						  ?>    
                           <?php while($row = mysql_fetch_assoc($result)){ ?> 
                           
                 <div class="col-lg-12">
                  <div class="col-lg-3">
                                 
                                  </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Pembayaran 
                        </div>
                      <form method="POST" action="admin/add_yurankhariat.php" name="yuran_khariat">  
                        <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-12">
                                    
                                        <div class="form-group">
                                            <label>Nama :</label>
                                              <?php echo $row['nama_penuh'];?>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>No.K/P :</label>
                                            <?php echo $row['no_ic'];?>              
                                		</div>
                                        
                                         <div class="form-group">
                                            <label>No.Ahli :</label>
                                            <?php echo $row['id_data'];?>
                                        </div>

                                        <div class="form-group">
                                            <label>Tarikh Bayaran :</label>
                                              <input class="form-control" name="tarikh_bayaran" type="date">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Pilihan Pakej</label>
                                            <select class="form-control" name="pakej" id="pakej">
                                                <option value="0">Sila Pilih Pakej</option>
                                                <option value="90">Biasa(Asas)- RM90</option>
                                                <option value="150">Biasa(Premium)- RM150</option>
                                                <option value="190">Biasa(Premium Plus)- RM190</option>
                                                <option value="60">W.Emas/Ibu Tunggal/OKU(Asas)- RM60</option>
                                                <option value="120">W.Emas/Ibu Tunggal/OKU(Premium)- RM120</option>
                                                <option value="160">W.Emas/Ibu Tunggal/OKU(Premium Plus)- RM160</option>
                                            </select>
  
                                            
                                        </div>
                                        
                                       <div class="form-group">
                                            <label>Jumlah Bayaran (RM) :</label>
                                        <input class="form-control" id="jumlah" name="jumlah" onClick="checkPrice()">
                                       </div>
                                          
                                         <div class="form-group">
                                           <label>AJK Masjid Bertugas:
                                           </label>

                                              <select class="form-control" name="id_ajk" id="id_ajk" required>
                                              <?php echo $pilihan;?> <?php echo $pilihanajk;?>
                                              </div>
                                              
                                              
                                              
                                            <input class="form-control" type="hidden" name="id_data" value="<?php echo $row['id_data'];?>">                            
											<input class="form-control" type="hidden" name="id_jenisbayaran" value="2">
                                             <br>
                     
                       <div align="center"><input type="submit" name="search" value="Simpan" class="btn btn-primary">
                                   
                                   </div>
                              
							                                       
                                    </form>
                                     <?php }?>    
                             
                                <!-- /.col-lg-6 (nested) -->
                                
                                 <div class="col-lg-3">
                                 
                                  </div>
                                     
                              
                        
                            <!-- /.row (nested) -->
                       
                        <!-- /.panel-body -->
                        
                           
                    </div>
                    <!-- /.panel -->
                       
                </div>
                <!-- /.col-lg-6 -->
          