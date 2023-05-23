<?php 
include("connection/connection.php");

$sql_search="SELECT id_data FROM sej6x_data_peribadi"; 
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
?> 
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Menu Pendaftaran</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Menu Pendaftaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
<!-- /.row -->
<div class="content mt-3">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">AHLI KARIAH</strong>
					</div>
					<div class="card-body">
						<a href="utama.php?view=admin&action=pendaftaran_ahli_qariah">
							Daftar Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
						<hr>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">LAYAK MENGUNDI</strong>
					</div>
					<div class="card-body">
						<a href="utama.php?view=admin&action=daftar_layak_mengundi">
							Daftar Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
						<hr>
						<a href="utama.php?view=admin&action=pendaftaran_layak_mengundi">
							Senarai Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">KEMATIAN</strong>
					</div>
					<div class="card-body">
					<a href="utama.php?view=admin&action=daftar_kematian">
						Daftar Ahli&nbsp;
						<i class="fa fa-arrow-circle-right"></i>
					</a>
					<hr>
					<a href="utama.php?view=admin&action=pendaftaran_kematian">
						Senarai Ahli&nbsp;
						<i class="fa fa-arrow-circle-right"></i>
					</a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">ANAK YATIM</strong>
					</div>
					<div class="card-body">
					<a href="utama.php?view=admin&action=pendaftaran_anak_yatim">
						Daftar Ahli&nbsp;
						<i class="fa fa-arrow-circle-right"></i>
					</a>
					<hr>
					<a href="utama.php?view=admin&action=senarai_anakyatim">
						<div class="panel-footer">
							Senarai Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</div>
					</a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">ASNAF</strong>
					</div>
					<div class="card-body">
						<a href="utama.php?view=admin&action=pendaftaran_asnaf">
							Daftar Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
						<hr>
						<a href="utama.php?view=admin&action=senarai_asnaf">
							Senarai Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">IBU TUNGGAL</strong>
					</div>
					<div class="card-body">
						<a href="utama.php?view=admin&action=pendaftaran_ibu_tunggal">
							Daftar Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
						<hr>
						<a href="utama.php?view=admin&action=senarai_ibutunggal">
							Senarai Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">SAKIT KRONIK</strong>
					</div>
					<div class="card-body">
						<a href="utama.php?view=admin&action=pendaftaran_sakit_kronik">
							Daftar Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
						<hr>
						<a href="utama.php?view=admin&action=senarai_sakit">
							Senarai Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">OKU</strong>
					</div>
					<div class="card-body">
						<a href="utama.php?view=admin&action=pendaftaran_oku">
							Daftar Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
						<hr>
						<a href="utama.php?view=admin&action=senarai_oku">
							Senarai Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">WARGA EMAS</strong>
					</div>
					<div class="card-body">
						<a href="utama.php?view=admin&action=daftar_warga_emas">
							Daftar Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
						<hr>
						<a href="utama.php?view=admin&action=senarai_wargaemas">
							Senarai Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
			
			 <div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">PAKATAN KHAIRAT</strong>
					</div>
					<div class="card-body">
						<a href="utama.php?view=admin&action=daftar_khairat">
							Daftar &amp; Lihat Senarai Ahli&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="card">
					<div class="card-header">
						<strong class="card-title mb-3">PERMOHONAN KE PEJABAT ZAKAT</strong>
					</div>
					<div class="card-body">
						<a href="utama.php?view=admin&action=pemohonan_zakat">
							Pemohon (Ahli Kariah)&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
						<hr>
						<a href="utama.php?view=admin&action=senarai_zakat">
							Senarai Pemohon&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
						<hr>
						<a href="utama.php?view=admin&action=butiran_zakat&jenis=bukan_kariah">
							Pemohon (Bukan Kariah)&nbsp;
							<i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>         
<!-- /.row -->          