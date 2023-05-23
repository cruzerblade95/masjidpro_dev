 <!-- Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">DAFTAR INVENTORI</h1>
                </div>
                <!-- /.col-lg-12 -->
                
                <form method="POST" action="admin/add_inventori.php" name="inventori">
                <div class="col-lg-12">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                        <div class="form-group">
                                            <label>Jenis Peralatan</label>
                                            <select class="form-control" name="jenis_inventori">
                                                <option value="0">Sila Pilih Peralatan</option>
                                                <option value="1">Peralatan</option>
                                                <option value="2">Elektrik</option>
                                                <option value="3">Perabot</option>
                                                <option value="4">Kenderaan</option>
                                                <option value="5">Lain-Lain</option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Peralatan</label>
                                            <input class="form-control" name="nama_inventori">                
                                        </div>

                                        <div class="form-group">
                                            <label>Tarikh Belian</label>
                                            <input class="form-control" name="tarikh_belian" type="date">                
                                        </div>

                                        <div class="form-group">
                                            <label>Kuantiti</label>
                                           <input class="form-control" name="kuantiti">                
                                        </div>
                                        
                                 
                                        
                                </div>


                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                   
                                    
                                        <div class="form-group">
                                       
                                            <label>Harga Belian</label>
                                            <input class="form-control" placeholder="Contoh: 150.00" name="harga_belian">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>No. Ref</label>
                                            <input class="form-control" name="no_rujukan">
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



