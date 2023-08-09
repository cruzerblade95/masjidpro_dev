<style type="text/css">
.disabled {
    pointer-events:none; //This makes it not clickable
    opacity:0.6;         //This grays it out to look disabled
}
</style>



<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            
                            <div class="logname">  
                                <img src="picture/mosque.png" width="30" height="30">
                           <?php
//$t=time();
echo '<b> Tarikh: '.(date("d-m-y")).'<br>'.'</b>'; 
//echo(date("l"));

// print date("g.i a", time());
?>
                            </div>
                           
                        </li>

                        <li class="">
                            <a href="utama.php?view=pengerusi&action=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="utama.php?view=pengerusi&action=pendaftaran" disabled><i class="fa fa-edit fa-fw" ></i>Pendaftaran
                            </a>
                        </li> 

                        <li>
                            <a href="utama.php?view=pengerusi&action=kehadiran">
                                <i class="fa fa-users"></i> Kehadiran</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope"></i> Pengurusan Surat<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level"> 
                                    <li>
                                        <a href="utama.php?view=pengerusi&action=minitmensyuarat">Minit Mensyuarat</a>
                                    </li>
                                    <li>
                                        <a href="utama.php?view=pengerusi&action=suratnotis">Surat / Notis</a>
                                    </li>
                                    <li>
                                        <a href="utama.php?view=pengerusi&action=laporanaktiviti">Laporan Aktiviti</a>
                                    </li>
                                </ul>
                        </li>
                    
                       <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Kewangan<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                        <li>
                                        <a href="utama.php?view=pengerusi&action=bukutunai">Buku Tunai</a>
                                        </li>
                                        <li>
                                            <a href="utama.php?view=pengerusi&action=penyata">Penyata Kewangan Bulanan/Tahunan</a>
                                        </li>
                                         <li>
                                            <a href="utama.php?view=pengerusi&action=laporanpendapatan">Laporan Pendapatan & Perbelanjaan</a>
                                        </li>
                                         <li>
                                            <a href="utama.php?view=pengerusi&action=penyata2018">Penyata Kewangan Bulanan/Tahunan 2018</a>
                                        </li>
                                       
                                        <li>
                                            <a href="utama.php?view=pengerusi&action=dashboard_terimabayaran">Terima Bayaran</a>
                                        </li>
                              
                                </ul>
                            <!-- /.nav-second-level -->
                        </li>
                      
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Selenggara<span class="fa arrow">
                            </span>
                            </a>
                                <ul class="nav nav-second-level">
                                        <li>
                                        <a href="utama.php?view=pengerusi&action=selenggara">Borang Penyelenggaraan</a>
                                        </li>
                                        <li>
                                            <a href="utama.php?view=pengerusi&action=maklumatselenggara">Laporan Selenggara
                                            </a>
                                        </li>
                                        <li>
                                            <a href="utama.php?view=pengerusi&action=kerosakan">Borang Kerosakan</a>
                                        </li>
                                        <li>
                                            <a href="utama.php?view=pengerusi&action=maklumatkerosakan">Laporan Kerosakan</a>
                                        </li>
                                        <li>
                                            <a href="#">Utiliti<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="utama.php?view=pengerusi&action=utiliti">Rekod Utiliti</a>
                                                </li>
                                                <li>
                                                    <a href="utama.php?view=pengerusi&action=maklumatutiliti">Laporan Utiliti</a>
                                                </li>
                                               
                                            </ul>
                                            <!-- /.nav-third-level -->
                                        </li>
                                        <li>
                                            <a href="#">Sewa <span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="utama.php?view=pengerusi&action=sewa">Borang Sewa Fasiliti</a>
                                                </li>
                                                <li>
                                                    <a href="utama.php?view=pengerusi&action=maklumatsewa">Maklumat Sewa Fasiliti</a>
                                                </li>
                                            </ul>
                                            <!-- /.nav-third-level -->
                                        </li>
                                            
                                        <li>
                                            <a href="#">Inventori <span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="utama.php?view=pengerusi&action=inventori">Borang Inventori</a>
                                                </li>
                                                <li>
                                                    <a href="utama.php?view=pengerusi&action=maklumatinventori">Laporan Inventori</a>
                                                </li>
                                            </ul>
                                            <!-- /.nav-third-level -->
                                        </li>
                                </ul>
                            <!-- /.nav-second-level -->
                        </li>
                      
                       <li>
                            <a href="utama.php?view=pengerusi&action=dashboard_tetapan"><i class="fa fa-sitemap fa-fw"></i>
                            Organisasi</a>
                        </li>  
                            <!-- /.nav-second-level -->
                        <li>
                            <a href="utama.php?view=pengerusi&action=aduan"><i class="fa fa-edit fa-fw"></i> Aduan Awam</a>
                        </li>
                        
                        <li>
                            <a href="utama.php?view=pengerusi&action=solatjumaat"><i class="fa fa-sitemap fa-fw"></i> Solat Jumaat</a>
                        </li>
                        <li>
                            <a href="utama.php?view=pengerusi&action=carian"><i class="fa fa-search fa-fw"></i> Carian Pantas</a>
                        </li>
                         
                        <li>
                            <a href="#"><i class="fa fa-fax fa-fw"></i> Komuniti<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="utama.php?view=pengerusi&action=komuniti">Komuniti Premis</a>
                                </li>
                                <li>
                                    <a href="utama.php?view=pengerusi&action=hebahan">Hebahan</a>
                                </li>
                              
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>  
			<li>
                            <a href="utama.php?view=pengerusi&action=profil"><i class="fa fa-search fa-fw"></i> Profil</a>
                        </li>
                         
                    </ul>
              </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

