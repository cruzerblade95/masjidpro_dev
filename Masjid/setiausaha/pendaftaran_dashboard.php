		
            <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">MENU PENDAFTARAN</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <?php 
                          include("connection/connection.php");
						  
						  $sql_search="SELECT id_data FROM sej6x_data_peribadi"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>   
                                <div class="col-xs-9 text-right">
                                 <?php while($row = mysql_fetch_assoc($result))?>
                                    <div class="huge"></div>
                                    <div>AHLI KARIAH</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=pendaftaran_ahli_qariah">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                       
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                      
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>LAYAK MENGUNDI</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=daftar_layak_mengundi">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <a href="utama.php?view=setiausaha&action=pendaftaran_layak_mengundi">
                           <div class="panel-footer">
                                <span class="pull-left">Senarai Ahli </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                            </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>KEMATIAN</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=daftar_kematian">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli</span>                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=pendaftaran_kematian">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>ANAK YATIM</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=pendaftaran_anak_yatim">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=senarai_anakyatim">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>ASNAF</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=pendaftaran_asnaf">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=senarai_asnaf">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>IBU TUNGGAL</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=pendaftaran_ibu_tunggal">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=senarai_ibutunggal">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>SAKIT KRONIK</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=pendaftaran_sakit_kronik">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=senarai_sakit">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>OKU</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=pendaftaran_oku">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=senarai_oku">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>WARGA EMAS</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=daftar_warga_emas">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=senarai_wargaemas">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                 <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>PAKATAN KHAIRAT</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=daftar_khairat">
                            <div class="panel-footer">
                                <span class="pull-left">Daftar Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=senarai_khairat">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Ahli</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>PERMOHONAN KE PEJABAT ZAKAT</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=pemohonan_zakat">
                            <div class="panel-footer">
                                <span class="pull-left">Pemohon (Ahli Kariah)</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=senarai_zakat">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Pemohon</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=butiran_zakat&jenis=bukan_kariah">
                            <div class="panel-footer">
                                <span class="pull-left">Pemohon (Bukan Kariah)</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

                  <!-- <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class=""></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>PERMOHONAN KE PEJABAT AGAMA</div>
                                </div>
                            </div>
                        </div>
                        <a href="utama.php?view=setiausaha&action=pendaftaran_pejabatagama">
                            <div class="panel-footer">
                                <span class="pull-left">Pemohon (Ahli Kariah)</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=pendaftaran_zakat">
                            <div class="panel-footer">
                                <span class="pull-left">Senarai Pemohon</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                         <a href="utama.php?view=setiausaha&action=pendaftaran_zakat">
                            <div class="panel-footer">
                                <span class="pull-left">Pemohon (Bukan Kariah)</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div> 
            </div>-->
            <!-- /.row -->
           

           