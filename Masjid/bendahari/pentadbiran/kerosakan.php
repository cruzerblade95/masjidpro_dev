 <!-- Page Content -->
      
<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BORANG KEROSAKAN</h1>
    </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                        <div class="panel-heading">
                           Maklumat Kerosakan
                        </div>
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="panel-body">
                               <form method="POST" action="pentadbiran/add_kerosakan.php" name="kerosakan">
                                                    
							   <div class="row">
							    <div class="col-lg-6">
							                                    
							     <div class="form-group">
							      <label>Tarikh Kerosakan</label>
						          <input class="form-control" type="date" name="tarikh_kerosakan" required>	            
							     </div>
                                                                   						                                             
							     <div class="form-group">
							     <label>Masa Kerosakan</label>
							     <input class="form-control" name="masa_kerosakan" required>	
							     </div>

							     <div class="form-group">
							     <label>Jenis Kerosakan</label>
							     <input class="form-control" name="jenis_kerosakan"required>
							     </div>

							     </div>

							     <div class="row">
							     <div class="col-lg-6">
                                 
							     <div class="form-group">
                                 <label>Catatan Kerosakan</label>
                                 <textarea class="form-control" rows="2" name="catatan_kerosakan"></textarea>
							     </div>
                                                                    
							     <div class="form-group">
                                 <label>Catatan Tindakan</label>
                                 <textarea class="form-control" rows="2" name="catatan_tindakan"></textarea>
								 </div>
                                 
									<button type="submit" class="btn btn-primary">Simpan</button>
								    <button type="reset" class="btn btn-primary">Padam</button>
															</div>

														 </div>
							                                <!-- /.col-lg-6 (nested) -->
							                            </div>

							                                 
							                           
                        </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->