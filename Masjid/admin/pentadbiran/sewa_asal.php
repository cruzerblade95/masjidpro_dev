<?php 

$today = date('Y-m-d');
$chkSearch = 0;

if ($_POST['search']){
   
    $chkSearch = 1;
    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];
    $jenis_sewaan = $_POST['jenis_sewaan'];

    if(!empty($datefrom)){
        $datefrom= date('Y-m-d',strtotime($datefrom));
        $dateto= date('Y-m-d',strtotime($dateto));
        $dateto=date('Y-m-d',(strtotime ('1 day', strtotime ($dateto))));
    }

}

$gtimein = $GLOBALS['timein']; 
$gtimeout = $GLOBALS['timeout'];
$duration = $GLOBALS['duration'];

?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Borang Sewaan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Semak Tarikh
                        </div>

                        <div class="panel-body">
                        <div class="row"> 
                            <form method="POST" action="utama.php?view=sewa">                              
                               
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
                                </div >

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="submit" name="search" value="Semak" class="btn btn-primary"></input> 
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Rekod Barang
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">                            
                            <div class="table-responsive">
                                <?php
                                        $today = date('Y-m-d');                        
                                        $month = date('m');
                                        $year = date('Y');

                                        //$user_id= $_SESSION['staff_id'];
                                        $sql_semakBooking = "SELECT * FROM maklumat_sewaan";
                                                           //WHERE staff_id = '$user_id'";

                                    if ($_POST['search']){
                                    $datetox=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $dateto ) ) ));

                                    $sql_semakBooking .=" WHERE sewa_tarikh BETWEEN '$datefrom' AND '$datetox'";
                                        }else{
                                        $sql_semakBooking .=" AND sewa_tarikh = '$year' AND sewa_tarikh = '$month'"; 
                                        }
                                        $sql_semakBooking .=" ORDER BY sewa_tarikh ASC";

                                        $res_semakBooking= mysql_query($sql_semakBooking) or die(mysql_error());
                                ?>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No.</th>                                    
                                            <th>Tarikh Sewa</th>
                                            <th style="text-align:center;">Tarikh Pulang</th>
                                            <th style="text-align:center;">Perkara Disewa</th>
                                            <th style="text-align:center;">Details</th>
                                            <th>AJK Bertanggungjawab</th>
                                            <th style="text-align:center;">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                           <?php      
                                               $bil=0; 
                                            while($row_semak = mysql_fetch_assoc($res_semakBooking)) {
                                               $bil++;
                                             ?>
                                        <tr class="odd gradeX">
                                            <td style="">
                                                <?php echo $bil;  ?>                                
                                            </td>      
                                             <td align="center"><?php 
                                                    if (!empty($row_semak['sewa_tarikh_mula'])){
                                                        $timein = date('H:i A',strtotime($row_semak['sewa_tarikh_mula'])); 
                                                        $gtimein = date('H:i A',strtotime($gtimein)); 
                                                        if(($timein>$gtimein)){
                                                            echo date('h:i A',strtotime($row_semak['sewa_tarikh_mula']))."</font>"; 
                                                        }else{
                                                            echo date('h:i A',strtotime($row_semak['sewa_tarikh_mula'])); 
                                                        }
                                                    }else{
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td align="center"><?php 
                                                    if (($row_semak['sewa_tarikh_akhir'] == NULL)||($row_semak['sewa_tarikh_akhir'] == '0000-00-00 00:00:00')){
                                                        echo "-";
                                                    }else{
                                                        $timeout = date('H:i',strtotime($row_semak['sewa_tarikh_akhir'])); 
                                                        $gtimeout = date('H:i',strtotime($gtimeout)); 
                                                        if($timeout<$gtimeout){
                                                            echo date('h:i A',strtotime($row_semak['sewa_tarikh_akhir']))."</font>"; 
                                                        }else{
                                                            echo date('h:i A',strtotime($row_semak['sewa_tarikh_akhir'])); 
                                                        }
                                                     //echo date('h:i A',strtotime($row_attendancex2['att_out']));
                                                    }
                                                ?>
                                            </td>
                                           <td align="center">
                                                <?php 
                                                        echo $row_semak['sewa_perkara'];                       
                                                ?>
                                            </td>
                                           <td align="center">
                                                <?php 
                                                        echo $row_semak['sewa_nama_perkara'];
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php 
                                                        echo $row_semak['sewa_ajk'];                       
                                                ?>
                                            </td>
                                           <td align="center">

                                             <?php

                                                if($row_semak['sewa_status']==1)
                                                {   
                                                    echo "<a href='utama.php?view=borang_sewa&no_sewa=$row_semak[no_sewa]'>
                                                            <img src='images/cross.png' width='15' height='15' rel='tooltip' title='Telah Disewa'/></a>";                                                    
                                                }elseif($row_semak['sewa_status']==0){
                                                    echo "<a href='utama.php?view=borang_sewa&no_sewa=$row_semak[no_sewa]'>
                                                            <img src='images/tickMark.png' width='15' height='15' rel='tooltip' title='Sewa'/></a>";                                                     
                                                }else
                                                    echo "-";                                                

                                                ?>

                                           
                                                <!-- button type="submit" class="btn btn-primary" onclick="location.href = 'utama.php?view=borang_sewa';" disabled="">Telah Disewa</button -->
                                            </td>
                                        </tr>
                                        <?php  } ?>
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
<script>
$(function(){
$( "#datefrom" ).datepicker({dateFormat:"yy-mm-dd"})
});
$(function(){
$( "#dateto" ).datepicker({dateFormat:"yy-mm-dd"})
});
</script>

<!-- Page-Level Demo Scripts - Tables - Use for reference / Delete existing search field-->
<script>
    jQuery(document).ready(function( $ ) {   
        $("#dataTables-example").dataTable( {
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
                 });
} );
</script> 