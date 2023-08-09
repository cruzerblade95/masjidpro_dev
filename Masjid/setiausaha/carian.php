 <?php include("connection/connection.php"); ?>
						  

<script type="text/javascript">
        function ShowHideDiv(chkPassport) {
            var dvPassport = document.getElementById("dvPassport");
            dvPassport.style.display = chkPassport.checked ? "block" : "none";
        }
		
		function ShowHideDiv1(chkPassport1) {
            var dvPassport1 = document.getElementById("dvPassport1");
            dvPassport1.style.display = chkPassport1.checked ? "block" : "none";
		}
		
		function ShowHideDiv2(chkPassport2) {
            var dvPassport2 = document.getElementById("dvPassport2");
            dvPassport2.style.display = chkPassport2.checked ? "block" : "none";
        }

	    function ShowHideDiv3(chkPassport3) {
            var dvPassport3 = document.getElementById("dvPassport3");
            dvPassport3.style.display = chkPassport3.checked ? "block" : "none";
        }

		function ShowHideDiv4(chkPassport4) {
            var dvPassport4 = document.getElementById("dvPassport4");
            dvPassport4.style.display = chkPassport4.checked ? "block" : "none";
			
			var dvPassport4A = document.getElementById("dvPassport4A");
            dvPassport4A.style.display = chkPassport4.checked ? "block" : "none";
        }
    </script>
<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">CARIAN</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Carian</div>

<div class="panel-body">
<div class="row"> 
                            
                                
<form id="form1" name="form1" method="POST" action="<?php echo $PHP_SELF;?>">
                              
                                        <div class="col-lg-12">                                   
                                          <div class="form-group">
                                            <label>Jenis Carian:</label>
                                            <label class="checkbox-inline" for="chkPassport">
                                                <input type="checkbox" name="chkPassport" id="chkPassport" value="1" onclick="ShowHideDiv(this)" />Nama
                                            </label>
                                            <label class="checkbox-inline" for="chkPassport1">
                                                <input type="checkbox" name="chkPassport1" id="chkPassport1" value="1" onclick="ShowHideDiv1(this)" />Pekerjaan
                                            </label>
                                           
                                            <label class="checkbox-inline" for="chkPassport2">
                                                <input type="checkbox" name="chkPassport2" id="chkPassport2" value="1" onclick="ShowHideDiv2(this)" />Zon Kawasan
                                            </label>
                                            
                                            
                                                <label class="checkbox-inline" for="chkPassport3">
                                                <input type="checkbox" name="chkPassport3" id="chkPassport3" value="1" onclick="ShowHideDiv3(this)" />Status Perkahwinan
                                            </label>
                                            
                                             <label class="checkbox-inline" for="chkPassport4">
                                                <input type="checkbox" name="chkPassport4" id="chkPassport4" value="1" onclick="ShowHideDiv4(this)" />Kategori Umur
                                            </label>
                                        </div>
    </div>
                               <div class="col-lg-5" id="dvPassport" style="display: none">                                   
                                        <div class="form-group ">
                                            <label>Nama</label>
                                            <input class="form-control" name="nama" id="nama">             
                                        </div>    
                                </div>
                                
                                <div class="col-lg-5" id="dvPassport1" style="display: none">
                                    <div class="form-group ">
                                        <label>Jenis Pekerjaan</label>
                                        <input class="form-control" name="pekerjaan" id="pekerjaan"> 
                                    </div>    
                                </div>
                                
<div class="col-lg-5" id="dvPassport2" style="display: none">                                   
<div class="form-group">
							          <label>Zon Kawasan</label>
							          <select class="form-control" name="zon_qariah" required>
                        <option>Sila Pilih</option>
							          <option value="4">ZON 1: RUMAH MURAH</option>
							          <option value="5">ZON 1: KAMPUNG AMAN & TAMAN PENAGA JAYA</option>
							          <option value="6">ZON 1: TAMAN SEJAHTERA</option>
							          <option value="1">ZON 2: TAMAN KUALA BEKAH</option>
                        <option value="2">ZON 2: TAMAN BERKAT</option>
                        <option value="3">ZON 2: TAMAN PENAGA</option>
                        <option value="7">ZON 3: JALAN BAWAH</option>
                        <option value="8">ZON 3: JALAN BESAR & JALAN HAJI HASHIM</option>
                        <option value="9">ZON 3: KAMPUNG BARU & JALAN PERMATANG RAMBAI</option>
                        </select>					                                      
</div>
</div>

<div class="col-lg-5" id="dvPassport3" style="display: none">
<div class="form-group">
    <label>Status Perkahwinan</label>
    <select class="form-control" name="status_perkahwinan" required>
    <option>Sila Pilih</option>
    <option value="1">Bujang</option>
    <option value="2">Sudah Berkahwin</option>
    <option value="3">Duda</option>
    <option value="4">Janda</option>
    </select>
</div>
</div>
                                
                  <div class="col-lg-3" id="dvPassport4" style="display: none">
                          <div class="form-group ">
                              <label>Daripada</label>
                              <input class="form-control" name="daripada" id="daripada" placeholder="Contoh: 25">
                          </div>    
                  </div>
								  <div class="col-lg-3" id="dvPassport4A" style="display: none">    
                          <div class="form-group ">
                              <label>Hingga</label>
                              <input class="form-control" name="hingga" id="hingga" placeholder="Contoh: 30"> 
                          </div>    
                  </div>

<div class="col-lg-12">
<div class="form-group">
    <input type="submit" name="search" value="Carian" class="btn btn-primary"></input> 
</div>  
 <input type="hidden" name="carisearch" value="1" />
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
                            Laporan Carian 
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                           <div class="table-responsive">
                             <?php 
                          
						 	 include("connection/connection.php");
						  

							 if(isset($_POST['search']))
	 							{ 
                  //$nama_penuh=mysql_real_escape_string($_POST['nama_penuh']);
									$nama =($_POST['chkPassport']);
									$bypekerjaan = $_POST['chkPassport1'];
									$zon_qariah = $_POST['chkPassport2'];
									$status_perkahwinan = $_POST['chkPassport3'];
									$byumur = $_POST['chkPassport4'];
									
									include("excel/hutang.php");
									
		$sql_search="SELECT nama_penuh,no_ic,alamat_terkini
		FROM sej6x_data_peribadi ";
		
		if ($nama==1){
            $nama =mysql_real_escape_string($_POST['nama']);
            //$nama = escape_data($_POST['nama']); 
			
			include("excel/ahli_kariah.php"); //nama_penuh,no_ic,tarikh_lahir,no_hp,alamat_terkini,jantina
			$sql_search="SELECT *
		FROM sej6x_data_peribadi where nama_penuh LIKE '%$nama%'"; 
		       
		}elseif($bypekerjaan==1){
		 $byypekerjaan=$_POST['pekerjaan'];
			  
		 include("excel/ahli_kariah.php");
	     $sql_search=" SELECT *
	   	FROM sej6x_data_peribadi where pekerjaan LIKE '%$byypekerjaan%'"; 
		
		}elseif($zon_qariah==1){
		 $zon_qariah =$_POST['zon_qariah'];
			
		 include("excel/ahli_kariah.php");
		 $sql_search="SELECT *
		FROM sej6x_data_peribadi where zon_qariah='$zon_qariah'"; 
		
		}elseif($status_perkahwinan==1){
		 $status_perkahwinan=$_POST["status_perkahwinan"];
			 
		 include("excel/ahli_kariah.php");
		$sql_search="SELECT *
		FROM sej6x_data_peribadi where status_perkahwinan ='$status_perkahwinan' ";
		
		}elseif($byumur==1){
	     $bydaripada = $_POST['daripada'];
		 $bydaripada2 = $_POST['daripada'];  
         $byhingga = $_POST['hingga'];
 		include("excel/ahli_kariah.php");
		$sql_search="SELECT *
		FROM sej6x_data_peribadi
		where umur BETWEEN '$bydaripada2' AND '$byhingga'";
		}
	 $result = mysql_query($sql_search) or die ("Error :".mysql_error());

	 ?>  
                           
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <b>Klik Icon
                            <?php
                            $path = "output/AhliKariah.xlsx";
                            ?> Untuk Muat Turun Hasil Carian</b>
                                 
                            <img src="picture/excel1.jpg" height="47" width="50" onClick="window.location.href=window.location='<?php echo $path; ?>'">
                         
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">Umur</div></th>
                                            <th><div align="center">Pekerjaan</div></th>
                                            <th><div align="center">No Kad Pengenalan</div></th>
                                            <th><div align="center">No.Telefon</div></th>
                                            <th><div align="center">Alamat</div></th>
                                  </tr>
                                  </thead>
                                  <tbody>

                                  <?php $x=1; ?>
                                  <?php while($row = mysql_fetch_assoc($result))
                                  { ?>
                                  <tr class="odd gradeX">
                                  <td><div align="center"><?php echo $x; ?></div></td>
                                  <td><?php echo $row['nama_penuh']; ?></td>
                                  <td><?php echo $row['umur']; ?></td>
                                  <td><?php echo $row['pekerjaan']; ?></td>
                                  <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                  <td class="center"><div align="center"><?php echo $row['no_hp']; ?></div></td>
                                  <td class="center"><?php echo $row['alamat_terkini']; ?></td>
                                  </tr>                          
                          <?php 
                										
                  $x++;			  
                  }
                  }else{
                }?>
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

