<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">AJK DAN PEGAWAI MASJID</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
  <div class="panel-heading">
                            Carian Maklumat AJK dan Pegawai Masjid
                            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal">Tambah Ahli </button>
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
						  
						  $sql_search="SELECT nama_penuh,no_ic,jawatan_lantikan,no_tel FROM   
						  sej6x_data_ajkmasjid"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  
						  //untuk sql negeri
						  $sql_negeri="SELECT id_negeri,name FROM negeri"; 
	                      $result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
						    
                          $options1 = $options1."<option>Sila Pilih Negeri</option>";  
                          while($row1=mysql_fetch_array($result1))
						  {
							
                          $options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
                          }
						
						  //untuk sql daerah
						  $sql_daerah="SELECT id_negeri,nama_daerah FROM daerah WHERE id_negeri='9'"; 
	                      $result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
						    
                          $options3 = $options3."<option>Sila Pilih Daerah</option>";  
                          while($row2=mysql_fetch_array($result2))
						  {
                          $options4=$options4."<option value='$row2[id_negeri]'>$row2[nama_daerah]</option>";
                          }
						
						  ?>
                            <table class="table table-striped table-bordered table-hover" 
                                 id="dataTables-example">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Nama</th>
                                  <th>No IC</th>
                                  <th>Lantikan</th>
                                  <th>No.Telefon</th>
                                  <th>Tindakan</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $x=1; ?>
                                <?php while($row = mysql_fetch_assoc($result)){ ?>
                                <tr class="odd gradeX">
                                  <td><?php echo $x; ?></td>
                                  <td><?php echo $row['nama_penuh']; ?></td>
                                  <td><?php echo $row['no_ic']; ?></td>
                                  <td class="center"><?php echo $row['jawatan_lantikan'];?></td>
                                  <td class="center"><?php echo $row['no_tel']; ?></td>
                                  <td><button type="button" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"> <i class="fa fa-times"></i> </button>
                                    <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit"> <i class="fa fa-pencil"></i> </button>
                                   </td>
                                </tr>
                                <?php 
										
  $x++;
   }
  ?>
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

 <form name="ajk_masjid" method="POST" action="tetapan/add_ajkmasjid.php">
                           
                                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                
                                  <div class="modal-dialog modal-lg">
                                
                                  <div class="modal-content">
                                
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel">BORANG KEAHLIAN AJK DAN PEGAWAI MASJID</h4>
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
                                
                                <h4 align="center"><u>Maklumat Ahli</u></h4>
                                  <div class="col-lg-6">
                                
                              
                            
                                <div class="form-group">
                                  <label>Nama Penuh</label>
                                  <input class="form-control" nama="nama_penuh" required/>
                                </div>
                                <div class="form-group">
                                  <label>No IC</label>
                                  <input class="form-control" placeholder="Contoh: 880528-35-5036" name="no_ic" required />
                                </div>
                                <div class="form-group">
                                  <label>Umur</label>
                                  <input class="form-control" name="umur" required />
                                </div>
                                <div class="form-group">
                                  <label>Bangsa</label>
                                  <select class="form-control" name="bangsa">
                                    <option>Sila Pilih</option>
                                    <option value="Melayu">Melayu</option>
                                    <option value="Cina">Cina</option>
                                    <option value="India">India</option>
                                    <option value="Lain-lain">Lain-lain</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Status Perkahwinan</label>
                                  <select class="form-control" name="status_perkahwinan" required>
                                    <option>Sila Pilih</option>
                                    <option value="Bujang">Bujang</option>
                                    <option value="Berkahwin">Berkahwin</option>
                                    <option value="Duda">Duda</option>
                                    <option value="Janda">Janda</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>No Telefon</label>
                                  <input class="form-control" placeholder="Contoh: 014-3159891" name="no_tel" required />
                                </div>
                                  </div>
                                
                                <!-- /.col-lg-4 (nested) -->
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label>Tahap Pendidikan</label>
                                      <select class="form-control" name="tahap_pendidikan"required>
                                        <option>Sila Pilih</option>
                                        <option value="UPSR">UPSR / PMR</option>
                                        <option value="SPM">SPM</option>
                                        <option value="STPM/Diploma">STPM / Diploma</option>
                                        <option value="Ijazah Sarjana Muda">Ijazah Sarjana Muda</option>
                                        <option value="Ijazah Sarjana">Ijazah Sarjana</option>
                                        <option value="Ijazah Kedoktoran">Ijazah Kedoktoran</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>No Rumah (Alamat Terkini)</label>
                                      <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="no_rumah" />
                                    </div>
                                    <div class="form-group">
                                      <label>Negeri</label>
                                      <select class="form-control" name="negeri" required>
                                        <?php echo $options1;?> <?php echo $options;?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Daerah</label>
                                      <select name="select" class="form-control" nama="daerah" required>
                                        <?php echo $options3;?> <?php echo $options4;?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Poskod</label>
                                      <input class="form-control" name="poskod" />
                                    </div>
                                    <div class="form-group">
                                      <label>Upload Gambar</label>
                                      <input type="file" class="form-control-file" id="exampleFormControlFile1" name="gambar" />
                                    </div>
                                  </div>
                                  <!-- /.col-lg-4 (nested) -->
                                </div>
                                  </div>
                                
                                <!-- /.row (nested) -->
                                  <div class="row">
                                
                                <h4 align="center"><u>Maklumat Pekerjaan</u></h4>
                                  <div class="col-lg-6">
                                
                              
                            
                                <div class="form-group">
                                  <label>Pekerjaan</label>
                                  <input class="form-control" name="pekerjaan" required />
                                </div>
                                <div class="form-group">
                                  <label>Status Pekerjaan</label>
                                  <select class="form-control" name="status_pekerjaan" required>
                                    <option>Kontrak</option>
                                    <option>Tetap</option>
                                  </select>
                                </div>
                                  </div>
                                
                                <!-- /.col-lg-6 (nested) -->
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label>Majikan/Syarikat</label>
                                      <input class="form-control" name="majikan" />
                                    </div>
                                    <div class="form-group">
                                      <label>Pendapatan Bulanan</label>
                                      <input class="form-control" name="pendapatan" />
                                    </div>
                                  </div>
                                  <!-- /.col-lg-4 (nested) -->
                                </div>
                                  </div>
                                
                                <!-- /.row (nested) -->
                                <div class="row">
                                  <h4 align="center"><u>Maklumat Lantikan</u></h4>
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label>Jawatan Lantikan</label>
                                      <select class="form-control" name="lantikan">
                                        <option>Sila Pilih</option>
                                        <option value="Pengerusi">Pengerusi</option>
                                        <option value="Timbalan Pengerusi">Timbalan Pengerusi</option>
                                        <option value="Setiausaha">Setiausaha</option>
                                        <option value="Bendahari">Bendahari</option>
                                        <option value="AJK">AJK </option>
                                        <option value="Imam">Imam </option>
                                        <option value="Imam Tambah">Imam Tambah</option>
                                        <option value="Bilal">Bilal </option>
                                        <option value="Siak">Siak </option>
                                      </select>
                                    </div>
                                  </div>
                                  <!-- /.col-lg-4 (nested) -->
                                  <div class="row">
                                    <div class="col-lg-4">
                                      <div class="form-group">
                                        <label>Tarikh Lantikan</label>
                                        <input class="form-control" type="date" name="tarikh_lantikan" />
                                      </div>
                                    </div>
                                    <!-- /.col-lg-4 (nested) -->
                                    <div class="row">
                                      <div class="col-lg-4">
                                        <div class="form-group">
                                          <label>Tempoh Lantikan</label>
                                          <select class="form-control" name="tempoh_lantikan">
                                            <option>Sila Pilih</option>
                                            <option value="Kontrak">Kontrak</option>
                                            <option value="Tetap">Tetap</option>
                                          </select>
                                        </div>
                                      </div>
                                      <!-- /.col-lg-4 (nested) -->
                                    </div>
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
                                  <button type="submit" class="btn btn-primary" name="ok">Simpan</button>
                                </div>
                                  </div>
                                
                                <!-- /.modal-content -->
                                  </div>
                                
                                <!-- /.modal-dialog -->
                                  </div>
                                
                              </form>