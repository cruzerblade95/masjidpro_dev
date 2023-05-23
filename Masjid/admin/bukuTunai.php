
        <!-- Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BUKU TUNAI</h1>
                </div>
                <!-- /.col-lg-12 -->
                <!-- ---------       DUIT MASUK     ---------- -->
                
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Debit - Duit Masuk
                        </div>
                       <form method="POST" action="admin/add_bukuTunai.php" name="duitmasuk">  
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                        <div class="form-group">
                                            <label>Pilih Tabung</label>
                                            <select class="form-control" name="jenis_tabung">
                                                <option>Sila Pilih</option>
                                                <option value="1">Tabung Bergerak</option>
                                                <option value="2">Tabung Kematian</option>
                                                <option value="3">Tabung Kenduri</option>
                                                <option value="4">Tabung Wakaf</option>
                                                <option value="5">TLK Wakaf Masjid</option>
                                                <option value="6">TLK Wakaf Kubur</option>
                                                <option value="7">Tabung Am</option>
                                                <option value="8">Tabung Kebajikan</option>
												<option value="9">Tabung Khas</option>
                                            </select>
                                        </div>
                                       
									   <div class="form-group">
											<label>Jenis Program/Aktiviti</label>
											<select class="form-control" name="jenis_program">
												<option>Sila Pilih</option>
												<option value="1">Aktiviti</option>
												<option value="2">Kuliah</option>
												<option value="3">Program</option>
												<option value="4">Saguhati</option>
											</select>
										</div>
									   
                                        <div class="form-group">
                                            <label>Tarikh</label>
                                            <input class="form-control" name="tarikh" type="date">                
                                        </div>

                                        <div class="form-group">
                                            <label>Butiran</label>
                                            <textarea class="form-control" rows="2" name="butiran"></textarea>
                                            <p class="help-block">Contoh: Kutipan Tabung Solat Jumaat</p>
                                        </div>
                                        
                                </div>


                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                   
                                    
                                        <div class="form-group">
                                            <label>Amaun:</label>
                                            <input class="form-control" placeholder="Contoh: 150.00" name="amount">
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Pembayar</label>
                                            <input class="form-control" placeholder="Masukan nama" name="nama_pembayar">
                                        </div>

                                        <div class="form-group">
                                            <label>Rujukan</label>
                                            <textarea class="form-control" rows="2" name="rujukan"></textarea>
                                            <p class="help-block">Contoh: M2U / No. Resit / No.Cek</p>
                                        </div>
									   <input class="form-control" type="hidden" name="jenis_duit" value="1">  
                                        <button type="submit" class="btn btn-primary">Simpan</button>
										<button type="reset" class="btn btn">Reset</button>



                                      
        </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                        </form>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->





                    <!-- -----        DUIT KELUAR  ------   -->


                <div class="col-lg-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            Kredit - Duit Keluar
                        </div>
                         <form method="POST" action="admin/add_bukuTunai.php" name="duit_keluar">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                        <div class="form-group">
                                            <label>Pilih Tabung</label>
                                            <select class="form-control" name="jenis_tabung">
                                                <option>Sila Pilih</option>
                                                <option value="1">Tabung Bergerak</option>
                                                <option value="2">Tabung Kematian</option>
                                                <option value="3">Tabung Kenduri</option>
                                                <option value="4">Tabung Wakaf</option>
                                                <option value="5">TLK Wakaf Masjid</option>
                                                <option value="6">TLK Wakaf Kubur</option>
                                                <option value="7">Tabung Am</option>
                                                <option value="8">Tabung Kebajikan</option>
												<option value="9">Tabung Khas</option>
                                            </select>
                                        </div>
										
										<div class="form-group">
											<label>Jenis Program/Aktiviti</label>
											<select class="form-control" name="jenis_program">
												<option>Sila Pilih</option>
												<option value="1">Aktiviti</option>
												<option value="2">Kuliah</option>
												<option value="3">Program</option>
												<option value="4">Saguhati</option>
											</select>
										</div>
										
                                        <div class="form-group">
                                            <label>Tarikh</label>
                                            <input class="form-control" name="tarikh" type="date">
                                        </div>

                                        <div class="form-group">
                                            <label>Butiran</label>
                                            <textarea class="form-control" rows="2" name="butiran"></textarea>
                                            <p class="help-block">Contoh: Kutipan Tabung Solat Jumaat</p>
                                        </div>
                                        
                                        
                                       
                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                   
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Amaun:</label>
                                            <input class="form-control" placeholder="Contoh: 150.00" name="amount">
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Pembayar</label>
                                            <input class="form-control" placeholder="Masukan nama" name="nama_pembayar">
                                        </div>

                                        <div class="form-group">
                                            <label>Rujukan</label>
                                            <textarea class="form-control" rows="2" name="rujukan"></textarea>
                                            <p class="help-block">Contoh: M2U / No. Resit / No.Cek</p>
                                        </div>
										  <input class="form-control" type="hidden" name="jenis_duit" value="2">  
                                        <button type="submit" class="btn btn-primary">Simpan</button>
										<button type="reset" class="btn btn">Reset</button>
                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                        </form>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
       

