<?php
$x = "SELECT id_negeri, id_daerah, poskod FROM sej6x_data_masjid WHERE id_masjid = ";
if($admin_view == NULL && $_POST['preview'] == NULL) $x .= $_GET['id_masjid'];
if($admin_view != NULL || $_POST['preview'] != NULL) $x .= $_SESSION['id_masjid'];
$x2 = mysqli_query($bd2, $x) or die(mysqli_error($bd2));
$row_x = mysqli_fetch_assoc($x2);
if((($jumpa > 0 || $jumpa3 > 0) && $id_masjid == $id_masjid2) || ($no_ic != NULL && $jumpa == 0 && $jumpa3 == 0 && $jumpa2 == 0 && $jumpa4 == 0) || ($no_ic != NULL && $tajuk_button != 'Semak Semula')) {
?>
<script id="sekerip_adjust">
    function updateTinggal() {
        $(document).ready(function () {
            var tinggal_tahun = $('#tinggal_tahun').val();
            var tinggal_bulan = $('#tinggal_bulan').val();
            $('#tempoh_tinggal').val(tinggal_tahun+', TAHUN, '+tinggal_bulan+', BULAN');
        });
    }
    function updateMastautin(a) {
        var tinggal_tahun;
        var tinggal_bulan;
        if(a == 3) {
            $('#form_tempoh').show();
            tinggal_tahun = 0;
            tinggal_bulan = 4;
            <?php
                if($id_qariah != NULL) {
                    $tinggal_tahun = str_replace('Tahun', '', explode(",", $kemas['tempoh_tinggal'])[0]);
                    if(is_numeric($tinggal_tahun)) echo 'tinggal_tahun = '.str_replace(' ', '', $tinggal_tahun).";\r\n";
                    else echo "tinggal_tahun = 0".";\r\n";
                    if(str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]) != NULL) echo 'tinggal_bulan = '.str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]).';';
                    else echo "tinggal_bulan = 0;\r\n";
                }
            ?>
        }
        else {
            tinggal_tahun = 0;
            tinggal_bulan = 2;
            $('#form_tempoh').hide();
            alert('Keahlian kariah bagi yang bermastautin kurang dari 3 bulan pada tarikh pendaftaran akan dipertimbangkan oleh pihak pengurusan Masjid');
        }
        $('#tinggal_tahun').val(tinggal_tahun);
        $('#tinggal_bulan').val(tinggal_bulan);
        $('#tempoh_tinggal').val(tinggal_tahun+', TAHUN, '+tinggal_bulan+', BULAN');
    }
    function ubah_yatim(a, b, c) {
        $(document).ready(function () {
            if(a <= 15) {
                $(b).show();
                $(c).attr('required', true);
            }
            else {
                $(b).hide();
                $(c).removeAttr('required');
            }
        });
    }
    function ubah_bangsa(a) {
        if(a == 2 || a == 3 || a == 4) {
            $('#data_mualaf_form').show();
            $('#data_mualaf').attr('required', true);
        }
        else {
            $('#data_mualaf').val('2');
            $('#extra_mualaf').hide();
            $('#extra_mualaf input').val(null);
            $('#extra_mualaf textarea').val(null);
            $('#data_mualaf_form').hide();
            $('#data_mualaf').removeAttr('required');
        }
    }
    function ubah_jumaat_tunggal(a) {
        if(a == 1) {
            $('#ibu_tunggal_form').hide();
            $('#solat_jumaat_form').show();
            $('#solat_jumaat').attr('required', true);
            $('#data_ibutunggal').removeAttr('required');
        }
        else if(a == 2) {
            $('#solat_jumaat').val(2);
            $('#solat_jumaat').removeAttr('required');
            $('#solat_jumaat_form').hide();
            $('#ibu_tunggal_form').show();
            $('#data_ibutunggal').attr('required', true);
        }
        else {
            $('#solat_jumaat').removeAttr('required');
            $('#solat_jumaat_form').hide();
            $('#ibu_tunggal_form').hide();
            $('#data_ibutunggal').removeAttr('required');
        }
    }
    $(document).ready(function () {
        //$("form[id="+"insert_form" +"]").bind('submit',function(e){
        //e.preventDefault();
        $('input, textarea').attr('oninput', 'this.value = this.value.toUpperCase();');
        $('#tinggal_tahun, #tinggal_bulan').attr('oninput', 'updateTinggal();');
        $('#nama_penuh').on('change', function() {
            var kotak_nama = $('#nama_penuh').val().toUpperCase();
            var str2 = ["BIN", "BINTI", "BTE", "B.", "BTE.", "B ", "BTE ", "BTE. "];
            var silap = 0;
            for (var i = 0; i < str2.length; i++) {
                if(kotak_nama.indexOf(str2[i]) > 0) silap = 1;
            }
            if(silap == 0) alert('Nama anda mungkin tidak lengkap, contohnya tidak memasukkan bin atau binti. Sila cuba lagi, pastikan nama penuh anda seperti tertera di kad pengenalan / passpot');
        });
        //});
        $('#no_ic').on('change', function() {
            ubah_yatim($('#umur').val(), '#anak_yatim_form', '#data_anakyatim');
        });
        <?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?>
        $('#asnaf_form').hide();
        $('#data_asnaf').removeAttr('required');
        $('#no_rujukan_form').hide();
        <?php } ?>
        $('#solat_jumaat_form').hide();
        $('#data_mualaf_form').hide();
        $('#data_mualaf').removeAttr('required');
        $('#ibu_tunggal_form').hide();
        $('#data_ibutunggal').removeAttr('required');
        ubah_jumaat_tunggal($('#jantina').val());
        ubah_bangsa($('#bangsa').val());
        <?php if(str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]) == 2 && str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[0]) == 0) echo 'updateMastautin(2);'; ?>
        <?php if(str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]) >= 3 || str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[0]) > 0) echo 'updateMastautin(3);'; ?>
        $('#add_rekod_item').on('click', function() {
            <?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?>
            //$('select[name*="tanggung_asnaf"]').hide();
            $('.asnaf_form_anak').hide();
            <?php } ?>
            //$('select[name*="tanggung_mualaf"]').hide();
        });
        <?php if($id_qariah == NULL) { ?>
        $('#id_negeri').val(<?php echo($row_x['id_negeri']); ?>);
        showDaerah(<?php echo($row_x['id_negeri']); ?>, <?php echo($row_x['id_daerah']); ?>);
        $('#poskod').val(<?php echo($row_x['poskod']); ?>);
        <?php } ?>
        $('#bangsa').on('change', function() {
            ubah_bangsa(this.value);
        });
        $('#jantina').on('change', function() {
            ubah_jumaat_tunggal(this.value);
        });
    });
</script>
<?php } ?>