<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>

<script type="text/javascript">
        function ShowHideDiv(chkPassport) {
            var dvPassport = document.getElementById("dvPassport");
            dvPassport.style.display = chkPassport.checked ? "block" : "none";
            
            var dvPassportU = document.getElementById("dvPassportU");
            dvPassportU.style.display = chkPassport.checked ? "block" : "none";
			
			var dvPassportU = document.getElementById("dvPassportA");
            dvPassportU.style.display = chkPassport.checked ? "block" : "none";
			
			var dvPassportU = document.getElementById("dvPassportB");
            dvPassportU.style.display = chkPassport.checked ? "block" : "none";
			
			var dvPassportU = document.getElementById("dvPassportC");
            dvPassportU.style.display = chkPassport.checked ? "block" : "none";
			
			var dvPassportU = document.getElementById("dvPassportD");
            dvPassportU.style.display = chkPassport.checked ? "block" : "none";
			
			var dvPassportU = document.getElementById("dvPassportE");
            dvPassportU.style.display = chkPassport.checked ? "block" : "none";
        }
        
        function ShowHideDiv1(chkPassport1) {
            var dvPassport1 = document.getElementById("dvPassport1");
            dvPassport1.style.display = chkPassport1.checked ? "block" : "none";
            
             var dvPassportY = document.getElementById("dvPassportY");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
			
			var dvPassportY = document.getElementById("dvPassportF");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
			
			var dvPassportY = document.getElementById("dvPassportG");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
			
			var dvPassportY = document.getElementById("dvPassportH");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
			
			var dvPassportY = document.getElementById("dvPassportI");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
			
			var dvPassportY = document.getElementById("dvPassportJ");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
			
			var dvPassportY = document.getElementById("dvPassportK");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
			
			var dvPassportY = document.getElementById("dvPassportL");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
			
			var dvPassportY = document.getElementById("dvPassportM");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
			
			var dvPassportY = document.getElementById("dvPassportN");
            dvPassportY.style.display = chkPassport1.checked ? "block" : "none";
        }
        
		 function ShowHideDiv2(chkPassport2) {
            var dvPassport2 = document.getElementById("dvPassport2");
            dvPassport2.style.display = chkPassport2.checked ? "block" : "none";
            
             var dvPassportX = document.getElementById("dvPassportX");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
			
			var dvPassportX = document.getElementById("dvPassportFF");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
			
			var dvPassportX = document.getElementById("dvPassportGG");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
			
			var dvPassportX = document.getElementById("dvPassportHH");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
			
			var dvPassportX = document.getElementById("dvPassportII");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
			
			var dvPassportX = document.getElementById("dvPassportJJ");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
			
			var dvPassportX = document.getElementById("dvPassportKK");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
			
			var dvPassportX = document.getElementById("dvPassportLL");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
			
			var dvPassportX = document.getElementById("dvPassportMM");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
			
			var dvPassportX = document.getElementById("dvPassportNN");
            dvPassportX.style.display = chkPassport2.checked ? "block" : "none";
        }
        
		 function ShowHideDiv3(chkPassport3) {
            var dvPassport3 = document.getElementById("dvPassport3");
            dvPassport3.style.display = chkPassport3.checked ? "block" : "none";
            
             var dvPassportZ = document.getElementById("dvPassportZ");
            dvPassportY.style.display = chkPassport3.checked ? "block" : "none";
			
			var dvPassportZ = document.getElementById("dvPassportFFF");
            dvPassportZ.style.display = chkPassport3.checked ? "block" : "none";
			
			var dvPassportZ = document.getElementById("dvPassportGGG");
            dvPassportZ.style.display = chkPassport3.checked ? "block" : "none";
			
			var dvPassportZ = document.getElementById("dvPassportHHH");
            dvPassportZ.style.display = chkPassport3.checked ? "block" : "none";
			
			var dvPassportZ = document.getElementById("dvPassportIII");
            dvPassportZ.style.display = chkPassport3.checked ? "block" : "none";
			
			var dvPassportZ = document.getElementById("dvPassportJJJ");
            dvPassportZ.style.display = chkPassport3.checked ? "block" : "none";
			
			var dvPassportZ = document.getElementById("dvPassportKKK");
            dvPassportZ.style.display = chkPassport3.checked ? "block" : "none";
			
			var dvPassportZ = document.getElementById("dvPassportLLL");
            dvPassportZ.style.display = chkPassport3.checked ? "block" : "none";
			
			var dvPassportZ = document.getElementById("dvPassportMMM");
            dvPassportZ.style.display = chkPassport3.checked ? "block" : "none";
			
			var dvPassportZ = document.getElementById("dvPassportNNN");
            dvPassportZ.style.display = chkPassport3.checked ? "block" : "none";
        }
		
		$(document).ready(function() {

    $("#pakej option").filter(function() {
        return $(this).val() == $("#bayaran").val();
    }).attr('selected', true);

    $("#pakej").live("change", function() {

        $("#bayaran").val($(this).find("option:selected").attr("value"));
    });
});
		
   </script> 

<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">TERIMA BAYARAN</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                    <div class="row">
							                <div class="col-lg-12">
							                    <div class="panel panel-info">
							                       <!--  <div class="panel-heading">
							                            MAKLUMAT PERIBADI
							                        </div> -->
							                        <div class="panel-body">
                                                    
							                            <div class="row">
							                            	<h4 align="center">MAKLUMAT PERIBADI</h4>
							                                
							                                <div class="col-lg-6">
							                                    <form role="form">
							                                        <div class="form-group">
							                                            <label>Nama Penuh</label>
							                                            <input class="form-control" required>	            
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
                                                                    
                                                                    

							                                        <div class="form-group">
							                                            <label>No IC</label>
							                                            <input class="form-control" placeholder="Contoh: 880528-35-5036" required>	
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Umur</label>
							                                            <input class="form-control" required>
							                                        </div>

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
							                                            <label>Bangsa</label>
							                                            <select class="form-control">
							                                                <option>Sila Pilih</option>
							                                                <option>Melayu</option>
							                                                <option>Cina</option>
							                                                <option>India</option>
							                                                <option>Lain-lain</option>
							                                            </select>
							                                        </div>
                                                                    
                                                                    
							                                          </div>

							                                    

							                            <div class="row">
							                                <div class="col-lg-6">
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
							                                             <input class="form-control">
							                                        </div>


							                                        <div class="form-group">
							                                            <label>Poskod</label>
							                                            <input class="form-control">	                  
							                                        </div>
                                                                    
                                                                    
                                                                     <div class="form-group">
							                                            <label>No Telefon</label>
							                                            <input class="form-control" required>	
							                                        </div>

							                                </div>
							                               
							                            </div>
														 <!-- /.col-lg-6 (nested) -->
							                                 
							                            </div>
							                            <!-- /.row (nested) -->


							                        <div class="row">
							                        	<h4 align="center">BAYARAN</h4>
							                                
							                                <div class="col-lg-12">
                                                            
							                                   <div class="form-group">
                                            <label>Jenis Bayaran:</label>
                                            
                                            <label class="checkbox-inline" for="chkPassport">
                                                <input type="checkbox" name="chkPassport" id="chkPassport" value="1" onclick="ShowHideDiv(this)" />Yuran Qariah
                                            </label>
                                            <label class="checkbox-inline" for="chkPassport1">
                                                <input type="checkbox" name="chkPassport1" id="chkPassport1" value="1" onclick="ShowHideDiv1(this)" />Yuran Khairat
                                            </label>
                                           
                                            <label class="checkbox-inline" for="chkPassport2">
                                                <input type="checkbox" name="chkPassport1" id="chkPassport1" value="1" onclick="ShowHideDiv2(this)" />Zakat
                                            </label>
                                            
                                             <label class="checkbox-inline" for="chkPassport3">
                                                <input type="checkbox" name="chkPassport1" id="chkPassport1" value="1" onclick="ShowHideDiv3(this)" />Wakaf
                                            </label>
                                        </div>



                                <div class="col-lg-3" id="dvPassport" style="display: none">                                   
                                        <div class="form-group ">
                                            <label>Tarikh Bayaran</label>
                                            <input class="form-control" name="tarikh" id="tarikh" type="date" >                                                                                                                            
                                        </div>    
                                </div>

                                <div class="col-lg-3" id="dvPassportU" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Hari Bayaran</label>
                                            <input class="form-control" name="hari" id="hari" >                                          
                                  </div>
                                </div>
                                
                                 <div class="col-lg-3" id="dvPassportA" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Masa Bayaran</label>
                                            <input class="form-control" name="masa" id="masa" >                                          
                                  </div>
                                </div>
                                
                                    <div class="col-lg-3" id="dvPassportB" style="display: none">                                    
                                       <div class="form-group">
                                             <label>No Ahli</label>
                                            <input class="form-control" name="ahli" id="ahli" >                                          
                                  </div>
                                </div>
                                
                                    <div class="col-lg-3" id="dvPassportC" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Tempoh Lanjutan Yuran</label>
                                            <input class="form-control" name="yuran" id="yuran" >                                          
                                  </div>
                                </div>
                                
                                    <div class="col-lg-3" id="dvPassportD" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Jumlah Bayaran</label>
                                            <input class="form-control" name="jumlah" id="jumlah" >                                          
                                  </div>
                                </div>
                                
                                 <div class="col-lg-3" id="dvPassport1" style="display: none">                                    
                                     <div class="form-group">
                                             <label>Tarikh Bayaran</label>
                                            <input class="form-control" name="tarikh" id="tarikh" type="date">         
                                                                                  
                                  </div>
                                </div>
                                
                               <div class="col-lg-3" id="dvPassportY" style="display: none">                                   
                                        <div class="form-group">
                                             <label>Hari Bayaran</label>
                                            <input class="form-control" name="hari" id="hari" >   
                                  </div>
                                </div> 
                                
                                 <div class="col-lg-3" id="dvPassportF" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Masa Bayaran</label>
                                            <input class="form-control" name="masa" id="masa" >                                          
                                  </div>
                                </div>
                                
                                 <div class="col-lg-3" id="dvPassportG" style="display: none">                                    
                                       <div class="form-group">
                                             <label>No.Ahli</label>
                                            <input class="form-control" name="ahli" id="ahli" >                                          
                                  </div>
                                </div>
                                
                                <div class="col-lg-3" id="dvPassportH" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Tempoh Lanjutan Yuran</label>
                                            <input class="form-control" name="yuran" id="yuran" >                                          
                                  </div>
                                </div>
                                
                                 <div class="col-lg-3" id="dvPassportJ" style="display: none">                                    
                                       <div class="form-group">
                                            <label>Pilihan Pakej</label>
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
                                
                                  <div class="col-lg-3" id="dvPassportI" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Jumlah Bayaran</label>
                                            <input class="form-control" type="text" name="xx" id="xx" value="" readonly="readonly" >                                          
                                  </div>
                                </div>
                                                           
                                
                                 <div class="col-lg-3" id="dvPassport2" style="display: none">                                    
                                     <div class="form-group">
                                             <label>Tarikh Bayaran</label>
                                            <input class="form-control" type="date" name="tarikh" id="tarikh" type="date">         
                                                                                  
                                  </div>
                                </div>
                                
                               <div class="col-lg-3" id="dvPassportX" style="display: none">                                   
                                        <div class="form-group">
                                             <label>Hari Bayaran</label>
                                            <input class="form-control" name="hari" id="hari" >   
                                  </div>
                                </div> 
                                
                                 <div class="col-lg-3" id="dvPassportFF" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Masa Bayaran</label>
                                            <input class="form-control" name="masa" id="masa" >                                          
                                  </div>
                                </div>
   
                                <div class="col-lg-3" id="dvPassportHH" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Tempoh Lanjutan Yuran</label>
                                            <input class="form-control" name="tempoh" id="tempoh" >                                          
                                  </div>
                                </div>
                                
                                <div class="col-lg-3" id="dvPassportII" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Jumlah Bayaran</label>
                                            <input class="form-control" name="bayaran" id="bayaran" >                                          
                                  </div>
                                </div>
                                
                                 <div class="form-group" id="dvPassportGG" style="display: none">
                                 
                                <label class="control-label col-lg-8">Jenis Zakat</label>
        
                                <div class="col-lg-3">
                                        <select class="form-control" name="jenis">
                                            <option value="official">Zakat Harta</option>
                                            <option value="manual">Zakat Tanaman</option>
                                             <option value="official">Zakat Padi</option>
                                            <option value="manual">Zakat Ternakan</option>
                                            <option value="official">Simpanan</option>
                                            <option value="manual">Saham</option>
                                             <option value="official">KWSP</option>
                                            <option value="manual">Emas</option>
                                             <option value="manual">Perak</option>
                                             <option value="manual">Qadha Zakat</option>
      
                                        </select>
                                </div>
                              </div>
                             
                                  <div class="col-lg-3" id="dvPassport3" style="display: none">                                    
                                     <div class="form-group">
                                             <label>Tarikh Bayaran</label>
                                            <input class="form-control" name="tarikhbayaran" id="tarikhbayaran" type="date">         
                                                                                  
                                  </div>
                                </div>
                                
                               <div class="col-lg-3" id="dvPassportZ" style="display: none">                                   
                                        <div class="form-group">
                                             <label>Hari Bayaran</label>
                                            <input class="form-control" name="hari" id="hari" >   
                                  </div>
                                </div> 
                                
                                 <div class="col-lg-3" id="dvPassportFFF" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Masa Bayaran</label>
                                            <input class="form-control" name="masa" id="masa" >                                          
                                  </div>
                                </div>
                                
                                <div class="col-lg-3" id="dvPassportHHH" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Tempoh Lanjutan Yuran</label>
                                            <input class="form-control" name="tempoh" id="tempoh" >                                          
                                  </div>
                                </div>
                                
                                <div class="col-lg-3" id="dvPassportIII" style="display: none">                                    
                                       <div class="form-group">
                                             <label>Jumlah Bayaran</label>
                                            <input class="form-control" name="jum_bayaran" id="jum_bayaran" >                                          
                                  </div>
                                </div>
                                
                                 <div class="form-group" id="dvPassportGGG" style="display: none">
                                 
                                <label class="control-label col-lg-8">Jenis Wakaf</label>
        
                                <div class="col-lg-3">
                                        <select class="form-control" name="wakaf">
                                            <option value="official">1</option>
                                            <option value="manual">2</option>
                                             <option value="official">3</option>
                                            <option value="manual">4</option>
                                            <option value="official">5</option>
                                          
                                        </select>
                                </div>
                              </div>
							                                     </div>
							                                <!-- /.col-lg-12 (nested) -->
	    
							                            </div>
							                            <!-- /.row (nested) -->
								  <div class="row">
	
							                                <div class="col-lg-4">

																  <div class="form-group">
                                           						 <label>Catatan</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                     					   
							                                        </div>
<button type="submit" class="btn btn-primary">Simpan</button>
 <button type="reset" class="btn btn-primary">Padam</button>
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