<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BUTIRAN AHLI JAWATANKUASA MASJID</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->



      <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat AJK Masjid
                        </div>
                         <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];
						  						  
						  $sql_search="SELECT a.id_data,a.nama_penuh,a.no_ic,a.no_hp,a.alamat_terkini,a.no_hp,a.poskod,a.pekerjaan,a.jantina,a.tarikh_lahir,
						   b.id_dataajk,b.id_ajk,b.jawatan,b.tarikh_lantikan
						   FROM sej6x_data_peribadi a, data_ajkmasjid b
						   where a.id_data='".$idd."' 
						   AND a.data_ajk=1
						   AND a.id_data=b.id_ajk"; 
	                     $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                       <?php while($row = mysql_fetch_array($result)){ ?> 
                                        <div class="form-group">
                                            <label>Nama: <?php echo $row['nama_penuh'];?></label>
                                          
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>No K/P: <?php echo $row['no_ic'];?> </label>
                                                        
                                        </div>
                                        <div class="form-group">
                                            <label>No Telefon: <?php echo $row['no_hp'];?> </label>
                                                        
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat: <?php echo $row['alamat_terkini'];?> </label>
                                         
                                        </div>

                                        <div class="form-group">
                                            <label>Poskod: <?php echo $row['poskod'];?> </label>
                                         
                                        </div>
                                        
                                            <div class="form-group">
                                            <label>Pekerjaan: <?php echo $row['pekerjaan'];?> </label>
                                         
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Jantina: <?php echo $row['jantina'];?> </label>
                                         
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Tarikh Lahir: <?php echo $row['tarikh_lahir'];?> </label>
                                         
                                        </div>
 
                                </div>


                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                     
                      <div class="form-group">
      <?php            
$id_ajk = $_GET['id_data'];

$q = "SELECT gambar FROM data_ajkmasjid where id_ajk='$id_ajk'";
$r = mysql_query("$q",$bd);
if($r)
{
$row1 = mysql_fetch_array($r);
$type = "Content-type: ".$row1['jenis_gambar'];
//header($type);
$image = $row1['gambar'];
}
else
{
echo mysql_error();
}
?>
      <label><?php echo '<img class="thumbnail img-responsive" src="data:image/jpeg;base64,'.base64_encode( $image ) .'" />'; ?></label>
            
                                                   
                                        </div>
                                
                                   
                                     <div class="form-group">
                                            <label>Jawatan: <?php echo $row['jawatan'];?></label>
                                                         
                                        </div>
                                    
                                  <div class="form-group">
                                       
                                               <label>Tarikh Lantikan: <?php echo $row['tarikh_lantikan'];?></label>
                                           
                                        </div>
                                        
                                         
                                         <?php }?>

        </div>
                                <!-- /.col-lg-6 (nested) -->
                            
   
                        <!-- /.panel-heading -->
                        
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->