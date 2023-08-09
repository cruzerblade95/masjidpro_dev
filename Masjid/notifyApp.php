<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
if($detect->isAndroidOS()) $urlApp = "https://play.google.com/store/apps/details?id=com.masjidpro.staging";
if($detect->isAndroidOS()) {
    $jenisOS = "Android";
    //$urlApp = "market://details?id=com.masjidpro.staging";
}
if($detect->isiOS()) $urlApp = "https://apps.apple.com/my/app/masjidpro-penang/id1589472737";
if($detect->isiOS()) {
    //$urlApp = "itms://masjidpro-penang/id1589472737";
    $jenisOS = "iOS";
}
?>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tidak">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Assalamualaikum, Untuk makluman anda aplikasi ini akan ditutup pada 20 Disember 2021 & berpindah kepada Aplikasi baru (MasjidPro Penang).<br /><br />
                Sekiranya anda telah menetapkan e-mel dan kata laluan pada aplikasi ini, anda boleh terus login pada aplikasi MasjidPro Penang menggunakan No K/P dan Kata Laluan yang sama untuk mengemaskini maklumat peribadi anda.<br /><br />
                Terima Kasih Atas Sokongan Anda<br />
                -Admin MasjidPro
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <a target="_blank" href="<?php echo($urlApp); ?>"><button type="button" class="btn btn-primary"><i class="fa fa-download"></i>Muat-turun Sekarang</button></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#staticBackdrop').modal('show');
    });
</script>