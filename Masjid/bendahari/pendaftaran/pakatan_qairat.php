<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">PAKATAN KHAIRAT</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carian Maklumat Kematian Qariah
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<!-- ^_^ tab for button Tambah Ahli-->
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                              
                             <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal2">Pakatan Khairat Kematian(Borang Permohonan Keahlian)</button>
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
						  
						  $sql_search="SELECT nama,tarikh_kematian FROM sej6x_data_kematian"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>                                        
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tarikh Kematian</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $x=1; ?>
                                     <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['tarikh_kematian']; ?></td>
                                             <td>
                                             	<button type="button" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam">
                                             		<i class="fa fa-times"></i>
                            					 </button>
                            					 <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit">
                            					 	<i class="fa fa-pencil"></i>
                            					 </button>
                            					 <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">
                            					 	<i class="fa fa-search"></i>
                            					 </button>
                                            </td>
                                        </tr>
                                         <?php 
										
  $x++;
   }
  ?>

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">BORANG KEMATIAN QARIAH</h4>
                                        </div>
                                        <div class="modal-body">
                                            

                                            <div class="row">
							                <div class="col-lg-12">
							                    <div class="panel panel-info">
							                       <!--  <div class="panel-heading">
							                            MAKLUMAT PERIBADI
							                        </div> -->
							                        <div class="panel-body">

							                            <div class="row">
							                            	<h4 align="center"><u>Maklumat Si Mati</u></h4>
							                                
							                                <div class="col-lg-4">
							                                    <form role="form">

                                                                    <div class="form-group">
                                                                        <label>No IC</label>
                                                                        <input class="form-control" placeholder="Carian.." required>  
                                                                    </div>

							                                        <div class="form-group">
							                                            <label>Nama Penuh</label>
							                                            <input class="form-control" required>	            
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Umur</label>
							                                            <input class="form-control" required>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Bangsa</label>
							                                            <select class="form-control">
							                                                <option>Sila Pilih</option>
							                                                <option>Melayu</option>
							                                                <option>Cina</option>
							                                                <option>India</option>
							                                                <option>Lain-lain</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Status Perkahwinan</label>
							                                            <select class="form-control" required>
							                                                <option>Sila Pilih</option>
							                                                <option>Bujang</option>
							                                                <option>Berkahwin</option>
							                                                <option>Duda</option>
							                                                <option>Janda</option>
							                                            </select>
							                                        </div>

							                                        

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                                <div class="col-lg-4">	

							                                        <div class="form-group">
							                                            <label>Tahap Pendidikan</label>
							                                            <select class="form-control" required>
							                                                <option>Sila Pilih</option>
							                                                <option>UPSR / PMR</option>
							                                                <option>SPM</option>
							                                                <option>STPM / Diploma</option>
							                                                <option>Ijazah Sarjana Muda</option>
							                                                <option>Ijazah Sarjana</option>
							                                                <option>Ijazah Kedoktoran</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Pekerjaan</label>
							                                            <input class="form-control">	                  
							                                        </div> 
							                                        <div class="form-group">
							                                            <label>Majikan / Syarikat</label>
							                                            <input class="form-control">	                  
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Status Pekerjaan</label>
							                                            <select class="form-control" required>
							                                            <option>Sila Pilih</option>
							                                                <option>Tetap</option>
							                                                <option>Kontrak</option>
							                                            </select>                  
							                                        </div> 
							                                        <div class="form-group">
							                                            <label>Pendapatan Bulanan</label>
							                                            <input class="form-control">	                  
							                                        </div> 

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                            <div class="row">
							                                <div class="col-lg-4">
							                                	    <div class="form-group">
							                                            <label>No Rumah (Alamat Terkini)</label>
							                                            <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat">
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Negeri</label>
							                                            <select class="form-control" required>
							                                            <option>Sila Pilih</option>
							                                                <option>Pulau Pinang</option>
							                                                <option>Perlis</option>
							                                                <option>Kedah</option>
							                                                <option>Perak</option>
							                                                <option>Selangor</option>	
							                                                <option>Negeri Sembilan</option>	
							                                                <option>Melaka</option>	
							                                                <option>Johor</option>	
							                                                <option>Kelantan</option>	
							                                                <option>Pahang</option>	
							                                                <option>Terengganu</option>
							                                                <option>Sabah</option>	
							                                                <option>Sarawak</option>
							                                                <option>Wilayah Persekutuan</option>				
							                                                <option>Wilayah Labuan</option>
							                                            </select>
							                                        </div>		

							                                        <div class="form-group">
							                                            <label>Daerah</label>
							                                            <select class="form-control" required>
							                                            <option>Sila Pilih</option>
							                                                <option>Tasek Gelugor</option>
							                                                <option>Kepala Batas</option>
							                                                <option>Bukit Mertajam</option>
							                                                <option>Sungai Dua</option>	
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Poskod</label>
							                                            <input class="form-control">	                  
							                                        </div>

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
							                            </div>

							                                 
							                            </div>
							                            <!-- /.row (nested) -->




                                                    <div class="row">
                                                            <h4 align="center"><u>Maklumat Kematian</u></h4>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label>Tarikh Kematian</label>
                                                                    <input class="form-control" required>  
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Waktu Kematian</label>
                                                                    <input class="form-control" required>            
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Sebab Kematian</label>
                                                                    <textarea class="form-control" rows="3"></textarea>
                                                                </div>


                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->

                                                            <div class="col-lg-4">  
                                                                <div class="form-group">
                                                                    <label>Lokasi Tanah Perkuburan</label>
                                                                    <input class="form-control" required>            
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Waktu Dikebumikan</label>
                                                                    <input class="form-control" required>
                                                                </div>

                                                            

                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->

                                                            <div class="col-lg-4">  
                                                                <div class="form-group">
                                                                    <label>No. Kubur</label>
                                                                    <input class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->
                                                        </div>





							                        <div class="row">
							                        	<h4 align="center"><u>Maklumat Pemaklum</u></h4>
							                                
							                                <div class="col-lg-4">
							                                    <form role="form">
							                                        <div class="form-group">
							                                            <label>Nama Penuh</label>
							                                            <input class="form-control" required>	            
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No IC</label>
							                                            <input class="form-control" placeholder="Contoh: 880528-35-5036" required>	
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Umur</label>
							                                            <input class="form-control" required>
							                                        </div>

							                                        
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                                <div class="col-lg-4">
                                                                 <div class="form-group">

                                                                    <div class="form-group">
                                                                        <label>Bangsa</label>
                                                                        <select class="form-control">
                                                                            <option>Sila Pilih</option>
                                                                            <option>Melayu</option>
                                                                            <option>Cina</option>
                                                                            <option>India</option>
                                                                            <option>Lain-lain</option>
                                                                        </select>
                                                                    </div>

                                                                        <label>No Telefon</label>
                                                                        <input class="form-control" placeholder="Contoh: 014-3159891" required>
                                                                    </div>  


							                                	    <div class="form-group">
							                                            <label>No Rumah (Alamat Terkini)</label>
							                                            <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat">
							                                        </div>

							                                       
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->



                                                             <div class="col-lg-4">

                                                                 <div class="form-group">
                                                                        <label>Negeri</label>
                                                                        <select class="form-control" required>
                                                                        <option>Sila Pilih</option>
                                                                            <option>Pulau Pinang</option>
                                                                            <option>Perlis</option>
                                                                            <option>Kedah</option>
                                                                            <option>Perak</option>
                                                                            <option>Selangor</option>   
                                                                            <option>Negeri Sembilan</option>    
                                                                            <option>Melaka</option> 
                                                                            <option>Johor</option>  
                                                                            <option>Kelantan</option>   
                                                                            <option>Pahang</option> 
                                                                            <option>Terengganu</option>
                                                                            <option>Sabah</option>  
                                                                            <option>Sarawak</option>
                                                                            <option>Wilayah Persekutuan</option>                
                                                                            <option>Wilayah Labuan</option>
                                                                        </select>
                                                                    </div>      

                                                                    <div class="form-group">
                                                                        <label>Daerah</label>
                                                                        <select class="form-control" required>
                                                                        <option>Sila Pilih</option>
                                                                            <option>Tasek Gelugor</option>
                                                                            <option>Kepala Batas</option>
                                                                            <option>Bukit Mertajam</option>
                                                                            <option>Sungai Dua</option> 
                                                                        </select>
                                                                    </div>


                                                                 <div class="form-group">
                                                                        <label>Poskod</label>
                                                                        <input class="form-control">                      
                                                                    </div>
                                                                    
                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->




							                         </div>
							                         <!-- /.row (nested) -->

							                        </div>
							                        <!-- /.panel-body -->
							                    </div>
							                    <!-- /.panel -->
							                </div>
							                <!-- /.col-lg-12 -->
							            </div>
							            <!-- /.row -->


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                            <button type="button" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div> </form>

                                <!-- /Tambah Ahli (Borang Permohonan Keahlian) -->

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">BORANG PERMOHONAN KEAHLIAN</h4>
                                        </div>
                                        <div class="modal-body">
                                            

                                            <div class="row">
							                <div class="col-lg-12">
							                    <div class="panel panel-info">
							                       <!--  <div class="panel-heading">
							                            MAKLUMAT PERIBADI
							                        </div> -->
							                        <div class="panel-body">

							                            <div class="row">
							                            	<h4 align="center"><u>Maklumat Ahli/Ketua Ahli</u></h4>
							                                
							                                <div class="col-lg-4">
							                                    <form role="form">

                                                                    <div class="form-group">
                                                                        <label>Nama</label>
                                                                        <input class="form-control" placeholder="Carian.." required>  
                                                                    </div>

							                                        <div class="form-group">
							                                            <label>NO IC</label>
							                                            <input class="form-control" required>	            
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Tarikh Lahir</label>
							                                            <input class="form-control" type="date" required>
							                                        </div>

							                                        <div class="form-group">
							                                             <label>No.Tel/Henfon</label>
							                                            <input class="form-control" required>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Email</label>
							                                             <input class="form-control" required>							                                        </div>

							                                        

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
                                                            
							                               
							                            
							                                <div class="col-lg-4">
							                                	    <div class="form-group">
							                                            <label>No Rumah (Alamat Terkini)</label>
							                                            <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat">
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Negeri</label>
							                                            <select class="form-control" required>
							                                            <option>Sila Pilih</option>
							                                                <option>Pulau Pinang</option>
							                                                <option>Perlis</option>
							                                                <option>Kedah</option>
							                                                <option>Perak</option>
							                                                <option>Selangor</option>	
							                                                <option>Negeri Sembilan</option>	
							                                                <option>Melaka</option>	
							                                                <option>Johor</option>	
							                                                <option>Kelantan</option>	
							                                                <option>Pahang</option>	
							                                                <option>Terengganu</option>
							                                                <option>Sabah</option>	
							                                                <option>Sarawak</option>
							                                                <option>Wilayah Persekutuan</option>				
							                                                <option>Wilayah Labuan</option>
							                                            </select>
							                                        </div>		

							                                        <div class="form-group">
							                                            <label>Daerah</label>
							                                            <select class="form-control" required>
							                                            <option>Sila Pilih</option>
							                                                <option>Tasek Gelugor</option>
							                                                <option>Kepala Batas</option>
							                                                <option>Bukit Mertajam</option>
							                                                <option>Sungai Dua</option>	
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Poskod</label>
							                                            <input class="form-control">	                  
							                                        </div>

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
                                                            <div class="row">
                                                           <div class="col-lg-4">	

							                                        <div class="form-group">
							                                            <label>Pekerjaan</label>
							                                             <input class="form-control" required>							                                        </div>

							                                       <div class="form-group">
							                                            <label>Status</label>
							                                            <select class="form-control" required>
							                                            <option>Sila Pilih</option>
                                                                        <option>Tiada</option>
							                                            <option>Warga Emas</option>
							                                            <option>Ibu Tunggal</option>
							                                            <option>OKU</option>
							                                                	
							                                            </select>
							                                        </div>
							                                       
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
   
							                            </div>
     
							                            </div>
							                            <!-- /.row (nested) -->
                                                    <div class="row">
                                                            <h4 align="center"><u>Pakej</u></h4>
                                                            <div class="col-lg-12">
                                                            
                                                            <div class="form-group">
                                                                    <label>NOTA:</label>
                                                                    <label>Maklumat ahli keluarga yang akan dilindungi!</label>      
                                                                     <label>Isteri/Suami dan anak-anak yang belum berkahwin sahaja(Asas), Ibu/Bapa(Premium), Ibu/Bapa mertua(Premium)</label>            
                                                                </div>
                                                            
                                                                 <div class="form-group">
                                            <label>Pakej</label>
                                            <select class="form-control" name="pakej" id="pakej">
                                                <option value="">Sila Pilih Pakej</option>
                                                <option value="RM90">Biasa(Asas)- RM90</option>
                                                <option value="RM150">Biasa(Premium)- RM150</option>
                                                <option value="RM190">Biasa(Premium Plus)- RM190</option>
                                                <option value="RM60">W.Emas/Ibu Tunggal/OKU(Asas)- RM60</option>
                                                <option value="RM120">W.Emas/Ibu Tunggal/OKU(Premium)- RM120</option>
                                                <option value="RM160">W.Emas/Ibu Tunggal/OKU(Premium Plus)- RM160</option>
                                            </select>
  
                                            
                                        </div>


                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->

                                                           

                                                        </div>


							                        <div class="row">
							                        	<h4 align="center"><u>Maklumat Keluarga Dilindungi</u></h4>
							                                
							                                <div class="col-lg-3">
							                                    <form role="form">
							                                        <div class="form-group">
							                                            <label>Nama</label>
							                                            
							                                        </div>

							                                        <div class="form-group">
							                                            <input class="form-control" placeholder="Nama 1" required>	
							                                        </div>

							                                        <div class="form-group">
							                                        <input class="form-control" placeholder="Nama 2" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="Nama 3" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="Nama 4" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="Nama 5" required>	
							                                        </div>

							                                        
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                                <div class="col-lg-3">
                                                                 <form role="form">
							                                        <div class="form-group">
							                                            <label>Hubungan</label>
							                                            
							                                        </div>

							                                        <div class="form-group">
							                                            <input class="form-control" placeholder="Hubungan 1" required>	
							                                        </div>

							                                        <div class="form-group">
							                                        <input class="form-control" placeholder="Hubungan 2" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="Hubungan 3" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="Hubungan 4" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="Hubungan 5" required>	
							                                        </div>

							                                       
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
                                                            
                                                              <div class="col-lg-3">
                                                                 <form role="form">
							                                        <div class="form-group">
							                                            <label>Tarikh Lahir</label>
							                                            
							                                        </div>

							                                        <div class="form-group">
							                                            <input class="form-control" placeholder="Tarikh Lahir 1" required>	
							                                        </div>

							                                        <div class="form-group">
							                                        <input class="form-control" placeholder="Tarikh Lahir 2" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="Tarikh Lahir 3" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="Tarikh Lahir 4" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="Tarikh Lahir 5" required>	
							                                        </div>

							                                       
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->



                                                             <div class="col-lg-3">

                                                                 <form role="form">
							                                        <div class="form-group">
							                                            <label>No.K/P@S.Lahir</label>
							                                            
							                                        </div>

							                                        <div class="form-group">
							                                            <input class="form-control" placeholder="No.K/P@S.Lahir 1" required>	
							                                        </div>

							                                        <div class="form-group">
							                                        <input class="form-control" placeholder="No.K/P@S.Lahir 2" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="No.K/P@S.Lahir 3" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="No.K/P@S.Lahir 4" required>	
							                                        </div>
                                                                    <div class="form-group">
							                                        <input class="form-control" placeholder="No.K/P@S.Lahir 5" required>	
							                                        </div>

                                                                    
                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->




							                         </div>
							                         <!-- /.row (nested) -->

							                        </div>
							                        <!-- /.panel-body -->
							                    </div>
							                    <!-- /.panel -->
							                </div>
							                <!-- /.col-lg-12 -->
							            </div>
							            <!-- /.row -->


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                            <button type="button" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div> </form>


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

