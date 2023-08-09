 <?php 
                include("connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
								
				 $bulan = $_POST['bulan'];
				 $tahun = $_POST['tahun'];
				}
				?>
<div class="row">
                    <div class="col-lg-12">

                        <h2 align="center">LAPORAN PENDAPATAN DAN PERBELANJAAN KEWANGAN TABUNG<br>					
                        				BULAN <?php echo $bulan ?> TAHUN <?php echo $tahun ?> </h2>
                       

                    </div>
                </div>
<hr />
                
                <div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Carian</div>

<div class="panel-body">
<div class="row"> 
  <form id="laporan_pendapatan" name="laporan_pendapatan" method="POST" action="<?php echo $PHP_SELF;?>">                              
<div class="col-lg-3">                                   
<div class="form-group">
                                        <label>Bulan</label>
                                        <select class="form-control" name="bulan" id="bulan">
                                        <option value="" selected="selected">Sila Pilih Bulan</option>
                                        <option value="01" <?php if ($month=="01"){echo "selected='SELECTED'";}?>>Januari</option>
                                        <option value="02" <?php if ($month=="02"){echo "selected='SELECTED'";}?>>Februari</option>   
                                        <option value="03" <?php if ($month=="03"){echo "selected='SELECTED'";}?>>Mac</option>   
                                        <option value="04" <?php if ($month=="04"){echo "selected='SELECTED'";}?>>April</option>   
                                        <option value="05" <?php if ($month=="05"){echo "selected='SELECTED'";}?>>Mei</option>   
                                        <option value="06" <?php if ($month=="06"){echo "selected='SELECTED'";}?>>Jun</option>   
                                        <option value="07" <?php if ($month=="07"){echo "selected='SELECTED'";}?>>Julai</option>   
                                        <option value="08" <?php if ($month=="08"){echo "selected='SELECTED'";}?>>Ogos</option>   
                                        <option value="09" <?php if ($month=="09"){echo "selected='SELECTED'";}?>>September</option>   
                                        <option value="10" <?php if($month=="10"){echo "selected='SELECTED'";}?>>Oktober</option>   
                                        <option value="11" <?php if($month=="11"){echo "selected='SELECTED'";}?>>November</option>   
                                        <option value="12" <?php if($month=="12"){echo "selected='SELECTED'";}?>>Disember</option>      
                                        </select>
                                                                                  
                                  </div>
                                </div>

<div class="col-lg-3">                                    
<div class="form-group">
    <label>Tahun</label>
    <input class="form-control" id="tahun" name="tahun" placeholder="Contoh: 2018"size="20" />
</div>
</div>

<div class="col-lg-3">
<div class="form-group">
<br>
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
<div class="panel-heading">Tabung Bergerak 
 <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
<script>
function myFunction() {
    window.print();
}
</script>
</div>
<div class="panel-body">
<div class="table-responsive">
   
<table class="table table-striped table-bordered table-hover">
<thead>
 				<?php 
                include("connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
								
				 $bulan = $_POST['bulan'];
				 $tahun = $_POST['tahun'];
						  
				$sql_search="SELECT id_bukutunai,id_masjid,tarikh,jenis_duit,jenis_tabung,butiran,amount
				FROM buku_tunai 
				WHERE jenis_tabung='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				}
				?>

   <tr>
    <th><div align="center">BIL</div></th>
    <th><div align="center">PERKARA</div></th>
    <th><div align="center">PENDAPATAN (RM)</div></th>
    <th><div align="center">PERBELANJAAN (RM)</div></th>
  </tr>

</thead>
<tbody>
      <?php $x=1; ?>
      <?php while($row = mysql_fetch_assoc($result)){ ?>
        <tr class="odd gradeX">
           <td><div align="center"><?php echo $x; ?></div></td>
  		   <td><?php echo $row['butiran']; ?></td>
    	   <td><div align="center">
		   <?php if ($row['jenis_duit']=='1') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           <td><div align="center">
           <?php if ($row['jenis_duit']=='2') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           </tr>
              <?php 
										
  $x++;
   }
  ?>
     <tr class="odd gradeX">
           <td>&nbsp;</td>
  		   <th><div align="center">JUMLAH</div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='1' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='1' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           </tr> 
  
</tbody>
</table>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Tabung Kematian</div>
<div class="panel-body">
<div class="table-responsive">
   
<table class="table table-striped table-bordered table-hover" >
<thead>
<?php 
                include("connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
								
				 $bulan = $_POST['bulan'];
				 $tahun = $_POST['tahun'];		  
				$sql_search="SELECT id_bukutunai,id_masjid,jenis_duit,jenis_tabung,butiran,amount
				FROM buku_tunai 
				WHERE jenis_tabung='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun'"; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				}
				?>
   <tr>
    <th><div align="center">BIL</div></th>
    <th><div align="center">PERKARA</div></th>
    <th><div align="center">PENDAPATAN (RM)</div></th>
    <th><div align="center">PERBELANJAAN (RM)</div></th>
  </tr>

</thead>
<tbody>
      <?php $x=1; ?>
      <?php while($row = mysql_fetch_assoc($result)){ ?>
        <tr class="odd gradeX">
           <td><div align="center"><?php echo $x; ?></div></td>
  		   <td><?php echo $row['butiran']; ?></td>
    	   <td><div align="center">
		   <?php if ($row['jenis_duit']=='1') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           <td><div align="center">
           <?php if ($row['jenis_duit']=='2') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           </tr>
            <?php 
										
  $x++;
   }
  ?> 
    <tr class="odd gradeX">
           <td>&nbsp;</td>
  		     <th><div align="center">JUMLAH</div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='2' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; ; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='2' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           </tr> 
  
</tbody>
</table>

</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Tabung Kenduri</div>
<div class="panel-body">
<div class="table-responsive">
   
<table class="table table-striped table-bordered table-hover" >
<thead>
<?php 
                include("connection/connection.php");
						  
				$sql_search="SELECT id_bukutunai,id_masjid,jenis_duit,jenis_tabung,butiran,amount
				FROM buku_tunai 
				WHERE jenis_tabung='3'
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
   <tr>
    <th><div align="center">BIL</div></th>
    <th><div align="center">PERKARA</div></th>
    <th><div align="center">PENDAPATAN (RM)</div></th>
    <th><div align="center">PERBELANJAAN (RM)</div></th>
  </tr>

</thead>
<tbody>
      <?php $x=1; ?>
      <?php while($row = mysql_fetch_assoc($result)){ ?>
        <tr class="odd gradeX">
           <td><div align="center"><?php echo $x; ?></div></td>
  		   <td><?php echo $row['butiran']; ?></td>
    	   <td><div align="center">
		   <?php if ($row['jenis_duit']=='1') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           <td><div align="center">
           <?php if ($row['jenis_duit']=='2') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           </tr>
            <?php 
										
  $x++;
   }
  ?> 
   <tr class="odd gradeX">
           <td>&nbsp;</td>
  		   <th><div align="center">JUMLAH</div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='3' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; ; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='3' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           </tr> 
  
</tbody>
</table>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Tabung Wakaf</div>
<div class="panel-body">
<div class="table-responsive">
   
<table class="table table-striped table-bordered table-hover" >
<thead>
<?php 
                include("connection/connection.php");
						  
				$sql_search="SELECT id_bukutunai,id_masjid,jenis_duit,jenis_tabung,butiran,amount
				FROM buku_tunai 
				WHERE jenis_tabung='4' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' ";  
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
   <tr>
    <th><div align="center">BIL</div></th>
    <th><div align="center">PERKARA</div></th>
    <th><div align="center">PENDAPATAN (RM)</div></th>
    <th><div align="center">PERBELANJAAN (RM)</div></th>
  </tr>

</thead>
<tbody>
      <?php $x=1; ?>
      <?php while($row = mysql_fetch_assoc($result)){ ?>
        <tr class="odd gradeX">
           <td><div align="center"><?php echo $x; ?></div></td>
  		   <td><?php echo $row['butiran']; ?></td>
    	   <td><div align="center">
		   <?php if ($row['jenis_duit']=='1') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           <td><div align="center">
           <?php if ($row['jenis_duit']=='2') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           </tr>
        
            <?php 
										
  $x++;
   }
  ?> 
   <tr class="odd gradeX">
           <td>&nbsp;</td>
  		   <th><div align="center">JUMLAH</div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='4' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; ; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='4' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           </tr> 
  
</tbody>
</table>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Tabung Letak Kereta Wakaf Masjid</div>
<div class="panel-body">
<div class="table-responsive">
   
<table class="table table-striped table-bordered table-hover" >
<thead>
<?php 
                include("connection/connection.php");
						  
				$sql_search="SELECT id_bukutunai,id_masjid,jenis_duit,jenis_tabung,butiran,amount
				FROM buku_tunai 
				WHERE jenis_tabung='5' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
   <tr>
    <th><div align="center">BIL</div></th>
    <th><div align="center">PERKARA</div></th>
    <th><div align="center">PENDAPATAN (RM)</div></th>
    <th><div align="center">PERBELANJAAN (RM)</div></th>
  </tr>

</thead>
<tbody>
      <?php $x=1; ?>
      <?php while($row = mysql_fetch_assoc($result)){ ?>
        <tr class="odd gradeX">
           <td><div align="center"><?php echo $x; ?></div></td>
  		   <td><?php echo $row['butiran']; ?></td>
    	   <td><div align="center">
		   <?php if ($row['jenis_duit']=='1') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           <td><div align="center">
           <?php if ($row['jenis_duit']=='2') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           </tr>
        
            <?php 
										
  $x++;
   }
  ?> 
         <tr class="odd gradeX">
           <td>&nbsp;</td>
  		    <th><div align="center">JUMLAH</div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='5' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; ; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='5' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           </tr> 
  
</tbody>
</table>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Tabung Letak Kereta Wakaf Kubur</div>
<div class="panel-body">
<div class="table-responsive">
   
<table class="table table-striped table-bordered table-hover" >
<thead>
<?php 
                include("connection/connection.php");
						  
				$sql_search="SELECT id_bukutunai,id_masjid,jenis_duit,jenis_tabung,butiran,amount
				FROM buku_tunai 
				WHERE jenis_tabung='6' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
   <tr>
    <th><div align="center">BIL</div></th>
    <th><div align="center">PERKARA</div></th>
    <th><div align="center">PENDAPATAN (RM)</div></th>
    <th><div align="center">PERBELANJAAN (RM)</div></th>
  </tr>

</thead>
<tbody>
      <?php $x=1; ?>
      <?php while($row = mysql_fetch_assoc($result)){ ?>
        <tr class="odd gradeX">
           <td><div align="center"><?php echo $x; ?></div></td>
  		   <td><?php echo $row['butiran']; ?></td>
    	   <td><div align="center">
		   <?php if ($row['jenis_duit']=='1') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           <td><div align="center">
           <?php if ($row['jenis_duit']=='2') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           </tr>
       
            <?php 
										
  $x++;
   }
  ?>  
            <tr class="odd gradeX">
           <td>&nbsp;</td>
  		    <th><div align="center">JUMLAH</div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='6' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; ; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='6' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           </tr> 
  
</tbody>
</table>
</div>
</div>
</div>
</div>


<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Tabung Am</div>
<div class="panel-body">
<div class="table-responsive">
   
<table class="table table-striped table-bordered table-hover" >
<thead>
<?php 
                include("connection/connection.php");
						  
				$sql_search="SELECT id_bukutunai,id_masjid,jenis_duit,jenis_tabung,butiran,amount
				FROM buku_tunai 
				WHERE jenis_tabung='7' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' ";  
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
   <tr>
    <th><div align="center">BIL</div></th>
    <th><div align="center">PERKARA</div></th>
    <th><div align="center">PENDAPATAN (RM)</div></th>
    <th><div align="center">PERBELANJAAN (RM)</div></th>
  </tr>

</thead>
<tbody>
      <?php $x=1; ?>
      <?php while($row = mysql_fetch_assoc($result)){ ?>
        <tr class="odd gradeX">
           <td><div align="center"><?php echo $x; ?></div></td>
  		   <td><?php echo $row['butiran']; ?></td>
    	   <td><div align="center">
		   <?php if ($row['jenis_duit']=='1') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           <td><div align="center">
           <?php if ($row['jenis_duit']=='2') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           </tr>
        
            <?php 
										
  $x++;
   }
  ?> 
            <tr class="odd gradeX">
           <td>&nbsp;</td>
  		   <th><div align="center">JUMLAH</div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='7' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; ; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='7' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           </tr> 
  
</tbody>
</table>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Tabung Kebajikan</div>
<div class="panel-body">
<div class="table-responsive">
   
<table class="table table-striped table-bordered table-hover" >
<thead>
<?php 
                include("connection/connection.php");
						  
				$sql_search="SELECT id_bukutunai,id_masjid,jenis_duit,jenis_tabung,butiran,amount
				FROM buku_tunai 
				WHERE jenis_tabung='8' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>
   <tr>
    <th><div align="center">BIL</div></th>
    <th><div align="center">PERKARA</div></th>
    <th><div align="center">PENDAPATAN (RM)</div></th>
    <th><div align="center">PERBELANJAAN (RM)</div></th>
  </tr>

</thead>
<tbody>
      <?php $x=1; ?>
      <?php while($row = mysql_fetch_assoc($result)){ ?>
        <tr class="odd gradeX">
           <td><div align="center"><?php echo $x; ?></div></td>
  		   <td><?php echo $row['butiran']; ?></td>
    	   <td><div align="center">
		   <?php if ($row['jenis_duit']=='1') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           <td><div align="center">
           <?php if ($row['jenis_duit']=='2') { ?>
		   <?php echo $row['amount']; ?>
           <?php }?>
           </div></td>
           </tr>
             <?php 
										
  $x++;
   }
  ?> 
         <tr class="odd gradeX">
           <td>&nbsp;</td>
  		    <th><div align="center">JUMLAH</div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='8' 
				AND jenis_duit='1' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; ; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           <?php 
               // include("connection/connection.php");
						  
				$sql_search="SELECT id_masjid,jenis_duit,jenis_tabung,amount,
				SUM(amount) AS 'Pendapatan' 
				FROM buku_tunai 
				WHERE jenis_tabung='8' 
				AND jenis_duit='2' 
				AND MONTH(tarikh) = '$bulan' AND YEAR(tarikh)='$tahun' "; 
	            $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				
				?>
    	   <th><div align="center">
		   <?php while($row = mysql_fetch_assoc($result)){ ?>
		   <?php echo $row['Pendapatan'] ?>
           <?php }?>
           </div></th>
           </tr> 
  
</tbody>
</table>
</div>
</div>
</div>
</div>

</div>
</div>





                                           <!-- END PAGE LEVEL SCRIPTS -->
         