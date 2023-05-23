 <!-- Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">REKOD UTILITI</h1>
                </div>
                <!-- /.col-lg-12 -->
                
                <form method="POST" action="pentadbiran/add_utiliti.php" name="utiliti">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Maklumat Utiliti</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                        <div class="form-group">
                                            <label>Jenis Utiliti</label>
                                            <select class="form-control" name="jenis_utiliti" required>
                                                <option value="0">Sila Pilih</option>
                                                <option value="1">Air</option>
                                                <option value="2">Elektrik</option>
                                                <option value="3">Internet</option>
                                                <option value="4">Lain-Lain</option>
                                              
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tarikh Bayaran</label>
                                            <input class="form-control" name="tarikh_bayaran" type="date" required>                
                                        </div>

                                        <div class="form-group">
                                            <label>Harga Bayaran</label>
                                            <input class="form-control" name="harga_bayaran" placeholder="Contoh: 150.00" required>                
                                        </div>

                                </div>


                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                   
                                    
                                        <div class="form-group">
                                            <label>Ref.Resit</label>
                                            <input class="form-control" name="ref_resit" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <textarea class="form-control" rows="2" name="catatan"></textarea>
                                            
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
 									  <button type="reset" class="btn btn-primary">Padam</button>


              </form>
        </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->



