<script id="hide_select">
    var pilih_akaun2;
    var laman;

    function setSelectedIndex(s, valsearch)
    {
// Loop through all the items in drop down list
        for (i = 0; i< s.options.length; i++) {
            if (s.options[i].value == valsearch) {
// Item is found. Set its property and exit
                s.options[i].selected = true;
                break;
            }

        }
        return;
    }

    function setHideIndex(s, valsearch)
    {
// Loop through all the items in drop down list
        for (i = 0; i< s.options.length; i++) {
            if (s.options[i].value == valsearch) {
// Item is found. Set its property and exit
                s.options[i].style.display = 'none';
                break;
            }

        }
        return;
    }

    function setShowIndex(s, valsearch)
    {
// Loop through all the items in drop down list
        for (i = 0; i< s.options.length; i++) {
            if (s.options[i].value == valsearch) {
// Item is found. Set its property and exit
                s.options[i].style.display = '';
                break;
            }

        }
        return;
    }
</script>
<script id="form_ajax">

    function page_ajax2(a, b, c) {
        var aa = a.split("&");
        jQuery('.all-ajax-module').html('');
        jQuery('.all-ajax-module').hide();
        jQuery('#'+c).show();
        jQuery.ajax({
            url: a,
            //method:"POST",
            //data: { bulan: a, tahun: b },
            success: function(data)
            {
                jQuery('#'+c).hide();
                jQuery(b).html(data);
                jQuery(b).fadeIn('slow');
                eval(document.getElementById('form_ajax').innerHTML);
            }
        });
    }

    function page_ajax(a, b, c) {
        var aa = a.split("&");
        jQuery('.all-ajax-module').html('');
        jQuery('.all-ajax-module').hide();
        jQuery('#'+c).show();
        console.log(b);
        var request = jQuery.ajax({
            url:"<?php echo($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']); ?>&data=raw&module="+a,
            //method:"POST",
            //data: { bulan: a, tahun: b },
            success: function(data)
            {
                jQuery('#'+c).hide();
                jQuery(b).html(data);
                jQuery(b).fadeIn('slow');
                post_ajax(aa[0], b, c);
                eval(document.getElementById('form_ajax').innerHTML);
                eval(document.getElementById('modal_delete').innerHTML);
            }
        });

        // request.done(function(msg) {
        //     console.log( msg );
        // });

        // request.fail(function(jqXHR, textStatus) {
        //     console.log( "Request failed: " + textStatus );
        // });
    }

    function post_ajax(a, b, c) {
        var aa = a.split("&");
        jQuery('#'+aa[0]).on('submit', function(e){
            e.preventDefault();
            jQuery('.all-ajax-module').html('');
            jQuery('.all-ajax-module').hide();
            jQuery('#'+c).show();
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']); ?>&data=raw&module='+a,
                //url: a,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    jQuery('#'+c).hide();
                    jQuery(b).html(data);
                    eval(document.getElementById('form_ajax').innerHTML);
                    document.getElementById('exampleModal').innerHTML
                    //eval(document.getElementById('exampleModal').innerHTML);
                    page_ajax(a, b, c);
                }
            });
        });
    }

    function get_ajax(a, b, c) {
        var aa = a.split("&");
        jQuery('#'+aa[0]).submit(function(e) {
            e.preventDefault();
            jQuery('.all-ajax-module').html('');
            jQuery('.all-ajax-module').hide();
            jQuery('#'+c).show();
            var form = jQuery(this);
            jQuery.ajax({
                type: "GET",
                url: aa[1],
                data: form.serialize(),
                success: function(data)
                {
                    jQuery('#'+c).hide();
                    jQuery(b).html(data);
                    jQuery(b).fadeIn('slow');
                }
            });
        });
    }
    function preview_image(event, b)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById(b);
            var output2 = document.getElementById(b+'_base64');
            output.src = reader.result;
            output2.value = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    function preview_image2(event, b) {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById(b);
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<?php if($_GET['action'] == 'kewangan2') { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#cari').click(function(){
                $('#dinamik_table').html('');
                $('#tunggu').show();
                $.ajax({
                    url:"<?php echo($_SERVER['PHP_SELF']); ?>?pl=a&data=raw",
                    method:"POST",
                    data:$('#penyata_kewangan').serialize(),
                    success: function(data)
                    {
                        //alert(data);
                        $('#tunggu').hide();
                        $('#dinamik_table').html(data);
                        eval(document.getElementById('pdf_sekerip').innerHTML);
                        //$('#penyata_kewangan')[0].reset();
                    }
                });
            });
        });
    </script>
<?php } ?>
<script id="pdf_var">
    var tajuk_dokumen;
    var nama_masjid;
</script>
<script id="pdf_sekerip">
    var expot;
    if(tajuk_dokumen == 'Rekod Pendapatan dan Perbelanjaan') expot = [ 0, 1, 2, 3, 4, 5, 6 ];
    if(tajuk_dokumen == 'Senarai Kematian Ahli Kariah') expot = [ 0, 1, 2, 3, 4, 5 ];
    if(tajuk_dokumen == 'Senarai Ahli Kariah') expot = [ 0, 1, 2, 3, 4, 5 ];
    if(tajuk_dokumen == 'Senarai Untuk Kelulusan Ahli Kariah') expot = [ 0, 1, 2, 3, 4 ];
    if(tajuk_dokumen == 'Senarai Kelulusan dan Kehadiran Daftar Solat') expot = [ 0, 1, 2, 3, 4, 5 ];

    function meja_akaun(a, b, c) {
        jQuery(document).ready(function () {
            jQuery(a).DataTable({
                //responsive: true,
                dom: 'Bfrtip',
                "iDisplayLength": 25,
                "oLanguage": {
                    "sSearch": "Carian",
                    "info": "Halaman page _PAGE_ dari _PAGES_"
                },

                buttons: [
                    {
                        extend: 'excel',
                        title: nama_masjid,
                        messageTop: b,
                        exportOptions: {
                            stripNewlines: true,
                            columns: c
                        }
                    },
                    {
                        extend: 'pdf',
                        title: nama_masjid,
                        messageTop: b,
                        exportOptions: {
                            stripNewlines: true,
                            columns: c
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Cetak',
                        title: nama_masjid,
                        messageTop: b,
                        exportOptions: {
                            stripNewlines: true,
                            columns: c
                        }
                    }
                ],
                //"order": [[ 6, "asc" ]],
                "columnDefs": [{
                    "visible": true,
                    "targets": -1
                }]
            });
            var meja = jQuery('#meja_akaun').DataTable();

        });
    }
    meja_akaun('#meja_akaun', tajuk_dokumen, expot);

</script>
<script id="sekerip_daftar">
    function dinamik_tambah(a, b, c, d, e, f, g, h, j, k) {
        jQuery(document).ready(function(){
            var nama_lama = [];
            var i = a;
            jQuery('#'+b).click(function(){
                i++;
                jQuery('#'+c).append('<div class="'+b+' row form-group" id="'+f+i+'">'+d+'<div class="col-md-2 col-12 form-group"><input id="'+g+i+'" name="'+h+'" type="hidden"><button name="remove" id="'+i+'" type="button" class="'+e+' btn btn-warning form-group">'+k+'</button></div></div>');
                jQuery("#"+f+i+" select").each(function(){
                    if(jQuery(this).prop("multiple")) {
                        jQuery(this).attr("name", jQuery(this).attr("name")+"_"+i+"[]");
                        //alert(jQuery(this).attr("name"));
                    }
                });
                <?php if($_POST['preview'] == 1) { ?>disableSemua();<?php } ?>
                <?php if($_GET['action'] == "minitmesyuarat") echo "\r\n".'addTinyMCE();'."\r\n"; ?>
            });
            jQuery(document).on('click', '.'+e, function(){
                var button_id = jQuery(this).attr("id");
                var input_padam = jQuery('#'+g+button_id).val();
                jQuery('#'+e).append('<input name="'+j+'" type="hidden" value="'+input_padam+'">');
                jQuery('#'+f+button_id+'').remove();
            });
        });
    }

    function dinamik_buang_semua(a, b, c, d) {
        jQuery(document).ready(function(){
            jQuery("[name='"+a+"']").each(function(){
                var input = jQuery(this).val();
                jQuery('#'+b).append('<input name="'+c+'" type="hidden" value="'+input+'">');
            });
            jQuery('.'+d+'').remove();
        });
    }

    function pilih_dinamik(a, b, c, d, e) {
        if (a == "1" || a == "Y") {
            jQuery('#'+b+'').fadeIn('slow');
        }
        if (a == "2" || a == "N" || a == "" || a == null) {
            jQuery('#'+b+'').fadeOut();
            dinamik_buang_semua(c, d, e, b);
        }
    }
</script>
<script id="dinamik_add_var">
    var mula_index;
    var id_butang_add;
    var id_borang_dinamik;
    var data_dinamik;
    var class_remove_btn;
    var id_baris;
    var nama_padam;
</script>
<script id="kiralah_var">
    var kelas_kira;
    var jumlah_kira;
</script>
<script id="dinamik_add">
    jQuery(document).ready(function(){
        //var i=mula_index;
        <?php if(($daftar_online == 1 || $_GET['module'] == 'add_ahli') && $jum_anak > 0) echo 'mula_index = '.$jum_anak. ';'; ?>
        if(mula_index == null) mula_index = 0;

        jQuery('#'+id_butang_add).click(function(){
            mula_index++;
            <?php
            if($daftar_online == 1 || $_GET['module'] == 'add_ahli') {
                echo 'eval(document.getElementById(\'load_tarikh\').innerHTML);';
                echo 'eval(document.getElementById(\'isi_dinamik\').innerHTML);';
            }
            ?>
            if(nama_padam == null) nama_padam = 'Padam';
            jQuery('#'+id_borang_dinamik).append('<div class="row form-group" id="'+id_baris+mula_index+'">'+data_dinamik+'<div class="col form-group" align="right"><button name="remove" id="'+mula_index+'" type="button" class="btn_remove btn btn-warning form-group">'+nama_padam+'</button></div></div>');
            if(laman == 'pindahan') {
                var x = document.getElementsByName("id_akaun_regu[]");
                var i;
                for (i = 0; i < x.length; i++) {
                    setHideIndex(x[i],pilih_akaun2);
                }
                jQuery('#id_akaun').prop('disabled', true);
            }
            eval(document.getElementById('kiralah').innerHTML);
        });
        jQuery(document).on('click', '.'+class_remove_btn, function(){
            var button_id = jQuery(this).attr("id");
            <?php if($daftar_online == 1 || $_GET['module'] == 'add_ahli') { ?>
            var id_padam = jQuery('#id_padam_'+button_id).val();
            jQuery('#padam_anak').append('<input type="hidden" name="id_padam[]" value="'+id_padam+'">');
            <?php } ?>
            jQuery('#'+id_baris+button_id+'').remove();
            jumlahKira();
            if(laman == 'pindahan') {
                var x = document.getElementsByName("id_akaun_regu[]");
                if (x.length < 1) jQuery('#id_akaun').prop('disabled', false);
            }
        });
    });
</script>
<script id="kiralah">
    function jumlahKira() {
        var sum = 0;
        jQuery('.'+kelas_kira).each(function() {
            if(jQuery(this).val()!="")
            {
                sum = sum + parseFloat(jQuery(this).val());
            }
        });
        jQuery('#'+jumlah_kira).val(sum.toFixed(2));
        if(sum > 0) jQuery('#simpan_save').prop('disabled', false);
        if(sum == 0 || sum == '' || sum == null) jQuery('#simpan_save').prop('disabled', true);
    }
    jQuery('.'+kelas_kira).on('input', function() {
        jumlahKira();
    });
    jumlahKira();
</script>
<?php if($_GET['action'] == 'daftar_khairat') { ?>
    <script>
        jQuery( function() {
            function log( message ) {
                //jQuery( "<div>" ).text( message ).prependTo( "#log" );
                //jQuery( "#log" ).scrollTop( 0 );
            }

            jQuery( "#nama" ).autocomplete({
                source: "utama.php?data=raw&module=carilah",
                minLength: 2,
                select: function( event, ui ) {
                    jQuery( "#no_ic" ).val(ui.item.id_data);
                    //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
                }
            });
        } );
        post_ajax('cari_khairat&module=list_khairat', '#khairat_info', 'tunggu');
    </script>
<?php } ?>
<?php if($_GET['action2'] != 'pendaftaran') { ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="badan" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <script id="modal_delete">
        function modal_delete(a, b, c, d, e) {
            var cc = c.split("&");
            jQuery('#pasti').attr('onclick','page_ajax(\''+c+'\', \''+d+'\', \''+e+'\')');
            jQuery('#exampleModalCenterTitle').html(a);
            jQuery('#badan2').html(b);
            jQuery('#exampleModalCenter').modal('show');
        }
    </script>
    <script>
        jQuery("#jawatan").on('change', function() {
            jQuery("#index_ajk").val(jQuery("#jawatan").prop('selectedIndex'));
        });
    </script>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                <div id="badan2" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button id="pasti" type="button" class="btn btn-primary" data-dismiss="modal">Ya</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if($_GET['action'] == 'pendaftaran') { ?>
    <script type="text/javascript">
        function tunjuk_sebab(a) {
            if(a == 5) jQuery('#sebab_lain_form').show();
            if(a != 5 && a != null) {
                jQuery('#sebab_lain').val(null);
                jQuery('#sebab_lain_form').hide();
            }
            if(a == 4) {
                jQuery('#tarikh_pindah').removeAttr('required');
                jQuery('#tarikh_padam').hide();
            }
            if(a != 4 && a != null) {
                jQuery('#tarikh_padam').show();
                jQuery('#tarikh_pindah').attr('required', 'required');
            }
        }
        function showPadam(id_data, nama, ketua, id_masjid) {
            var data_borang = '<div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable"><div class="modal-content"><form id="'+id_data+'" name="'+id_data+'" method="post" enctype="multipart/form-data" action="admin/del_approve.php"><div class="modal-header"><h5 class="modal-title" id="alasanPadamLabel">Padam Rekod '+nama+'?</h5><button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="container-fluid"><div class="row form-group"><div class="col-md-12 col-12"><label>Sebab:</label><select required id="sebab_padam" name="sebab_padam" class="form-control" onchange="tunjuk_sebab(this.value)"><option value=""></option><option value="1">Kematian</option><option value="2">Berpindah</option><option value="3">Berkahwin</option><option value="4">Kesilapan Data</option><option value="5">Lain-lain</option></select></div></div><div id="sebab_lain_form" class="row form-group" style="display: none"><div class="col-md-12 col-12"><label>Lain-lain</label><textarea placeholder="Nyatakan sebab-sebab lain" name="sebab_lain" id="sebab_lain" class="form-control" rows="3"></textarea></div></div><div style="display: none" id="tarikh_padam" class="row form-group"><div class="col-md-12 col-12"><label>Tarikh:</label><input class="form-control" id="tarikh_pindah" name="tarikh_pindah" type="date"></div></div></div></div><div class="modal-footer"><input id="ketua" name="ketua" type="hidden" value="'+ketua+'"><input id="id_masjid" name="id_masjid" type="hidden" value="'+id_masjid+'"><input id="del" name="del" type="hidden" value="'+id_data+'"><input id="del_mode" name="del_mode" type="hidden" value="1"><input id="token" name="token" type="hidden" value="<?php echo($token_id); ?>"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button><button type="submit" class="btn btn-primary">Padam Ahli Kariah</button></div></form></div></div>';
            jQuery('#alasanPadam').html(data_borang);
            jQuery('#alasanPadam').modal('show');
        }
    </script>
    <div style="display: none" class="modal fade" id="alasanPadam" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="alasanPadamLabel" aria-hidden="true"></div>
<?php } ?>
<?php if($_GET['action'] == 'approve_bantuan') { ?>
    <script type="text/javascript">
        function showSebab(id_bantuan, nama, status_bantuan, sebab_lain, tarikh_tamat) {
            var data_borang = '<div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">' +
                '<div class="modal-content"><form id="'+id_bantuan+'" name="'+id_bantuan+'" method="post" enctype="multipart/form-data" action="admin/add_approve_bantuan.php">' +
                '<div class="modal-header">' +
                '<h5 class="modal-title" id="alasanPadamLabel">Status Kelulusan Bantuan Bagi '+nama+'?</h5>' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>' +
                '</div><div class="modal-body"><div class="container-fluid">' +
                '<div class="row form-group">' +
                '<div class="col-md-12 col-12"><label>Status:</label>' +
                '<select required id="status_bantuan" name="status_bantuan" class="form-control">' +
                '<option value=""></option>' +
                '<option value="1">DILULUSKAN</option>' +
                '<option value="2">TIDAK DILULUSKAN</option>' +
                '</select></div></div>' +
                '<div class="row form-group"><div class="col-md-12 col-12">' +
                '<label>Sebab</label>' +
                '<textarea placeholder="Nyatakan sebab-sebab" name="sebab_lain" id="sebab_lain" class="form-control" rows="3">'+sebab_lain+'</textarea></div></div>' +
                '<div class="row form-group"><div class="col-md-12 col-12">' +
                '<label>Tarikh Tamat</label>' +
                '<input name="tarikh_tamat" id="tarikh_tamat" type="date" class="form-control" value="'+tarikh_tamat+'"></div></div>' +
                '<div class="modal-footer">' +
                '<input id="id_bantuan" name="id_bantuan" type="hidden" value="'+id_bantuan+'">' +
                '<input id="token" name="token" type="hidden" value="<?php echo($token_id); ?>">' +
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>' +
                '<button type="submit" class="btn btn-primary">Respon</button>' +
                '</div></form></div></div>';
            jQuery('#alasanPadam').html(data_borang);
            jQuery('#alasanPadam').modal('show');
            if(status_bantuan == 1) jQuery('#status_bantuan').val('1');
            if(status_bantuan == 2) jQuery('#status_bantuan').val('2');
        }
    </script>
    <div style="display: none" class="modal fade" id="alasanPadam" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="alasanPadamLabel" aria-hidden="true"></div>
<?php } ?>
<?php if($_GET['action'] == 'approve_temujanji') { ?>
    <script type="text/javascript">
        function showSebab(id, nama, status, nota) {
            var data_borang = '<div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">' +
                '<div class="modal-content"><form id="'+id+'" name="'+id+'" method="post" enctype="multipart/form-data" action="admin/add_approve_temujanji.php">' +
                '<div class="modal-header">' +
                '<h5 class="modal-title" id="alasanPadamLabel">Status Kelulusan Temujanji Bagi '+nama+'?</h5>' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>' +
                '</div><div class="modal-body"><div class="container-fluid">' +
                '<div class="row form-group">' +
                '<div class="col-md-12 col-12"><label>Status:</label>' +
                '<select required id="status" name="status" class="form-control">' +
                '<option value=""></option>' +
                '<option value="1">DILULUSKAN</option>' +
                '<option value="2">TIDAK DILULUSKAN</option>' +
                '</select></div></div>' +
                '<div class="lain row form-group"><div class="col-md-12 col-12">' +
                '<label>Nota</label>' +
                '<textarea placeholder="Lain-lain maklumat" name="nota" id="nota" class="form-control" rows="3">'+nota+'</textarea></div></div>' +
                '<div class="modal-footer">' +
                '<input id="id" name="id" type="hidden" value="'+id+'">' +
                '<input id="token" name="token" type="hidden" value="<?php echo($token_id); ?>">' +
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>' +
                '<button type="submit" class="btn btn-primary">Respon</button>' +
                '</div></form></div></div>';
            jQuery('#alasanPadam').html(data_borang);
            jQuery('#alasanPadam').modal('show');
            if(status == 1) {
                jQuery('#status_bantuan').val('1');
                jQuery('.lain').show();
            }
            if(status == 2) {
                jQuery('#status_bantuan').val('2');
                jQuery('.lain').hide();
            }
        }
    </script>
    <div style="display: none" class="modal fade" id="alasanPadam" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="alasanPadamLabel" aria-hidden="true"></div>
<?php } ?>
<?php if($_GET['action'] == 'aduan') { ?>
    <script type="text/javascript">
        function showSebab(id_aduan, tindakkan) {
            var data_borang = '<div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">' +
                '<div class="modal-content"><form id="'+id_aduan+'" name="'+id_aduan+'" method="post" enctype="multipart/form-data" action="admin/add_status_aduan.php">' +
                '<div class="modal-header">' +
                '<h5 class="modal-title" id="alasanPadamLabel">Status Tindakkan Aduan</h5>' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>' +
                '</div><div class="modal-body"><div class="container-fluid">' +
                '<div class="lain row form-group"><div class="col-md-12 col-12">' +
                '<label>Nota</label>' +
                '<textarea placeholder="Tindakkan yang telah dibuat" name="tindakkan" id="tindakkan" class="form-control" rows="3">'+tindakkan+'</textarea></div></div>' +
                '<div class="modal-footer">' +
                '<input id="id_aduan" name="id_aduan" type="hidden" value="'+id_aduan+'">' +
                '<input id="token" name="token" type="hidden" value="<?php echo($token_id); ?>">' +
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>' +
                '<button type="submit" class="btn btn-primary">Respon</button>' +
                '</div></form></div></div>';
            jQuery('#alasanPadam').html(data_borang);
            jQuery('#alasanPadam').modal('show');
            if(status == 1) {
                jQuery('#status_bantuan').val('1');
                jQuery('.lain').show();
            }
            if(status == 2) {
                jQuery('#status_bantuan').val('2');
                jQuery('.lain').hide();
            }
        }
    </script>
    <div style="display: none" class="modal fade" id="alasanPadam" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="alasanPadamLabel" aria-hidden="true"></div>
<?php } ?>
<?php if($_GET['action'] == "senaraiPengundiForm" || $_GET['action'] == "caridetail" || $_GET['action'] == "dashboard_payment" || $_GET['action'] == "daftar_solat" || $_GET['action'] == "daftar_solat_senarai" || $_GET['action'] == "daftar_solat_kehadiran" || $_GET['action'] == "daftar_solat_senaraiLulus") { ?>
    <script>
        $(document).ready(function() {
            $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
            $('#mdate2').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
            <?php if($_GET['action'] == "dashboard_payment") { ?>$('#mdate3').bootstrapMaterialDatePicker({ weekStart: 0, time: false });<?php } ?>
        });
    </script>
<?php } if($_GET['action'] == "daftar_solat" || $_GET['action'] == "daftar_solat_senarai" || $_GET['action'] == "daftar_solat_kehadiran") { ?>
    <script>
        function semakVaksin(nama, status_vaksin, alamat_web) {
            $(document).ready(function(){
                var data_tunggu = '<div id="tungguVaksin" class="col-md-12 col-12 sk-circle" align="center">\n' +
                    '            <div class="sk-circle1 sk-child"></div>\n' +
                    '            <div class="sk-circle2 sk-child"></div>\n' +
                    '            <div class="sk-circle3 sk-child"></div>\n' +
                    '            <div class="sk-circle4 sk-child"></div>\n' +
                    '            <div class="sk-circle5 sk-child"></div>\n' +
                    '            <div class="sk-circle6 sk-child"></div>\n' +
                    '            <div class="sk-circle7 sk-child"></div>\n' +
                    '            <div class="sk-circle8 sk-child"></div>\n' +
                    '            <div class="sk-circle9 sk-child"></div>\n' +
                    '            <div class="sk-circle10 sk-child"></div>\n' +
                    '            <div class="sk-circle11 sk-child"></div>\n' +
                    '            <div class="sk-circle12 sk-child"></div>\n' +
                    '        </div>';
                $('body').addClass('modal-open');
                $('#alasanPadam2').show();
                $('div.modal-backdrop').show();
                $('#alasanPadam2').modal('show');
                $('#alasanPadam2').html(data_tunggu);
                $.ajax({
                    url: alamat_web,
                    success: function(result){
                        $('#alasanPadam2').html('');
                        var data_borang = '<div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">' +
                            '<div class="modal-content">' +
                            '<div class="modal-header">' +
                            '<h5 class="modal-title" id="alasanPadamLabel">'+nama+' - '+status_vaksin+'</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Tutup" onclick="$(\'body\').removeClass(\'modal-open\'); $(\'#alasanPadam2\').hide(); $(\'div.modal-backdrop\').hide(); $(\'#alasanPadam2\').html(\'\');"><span aria-hidden="true">&times;</span></button>' +
                            '</div><div class="modal-body"><div class="container-fluid">' +
                            '<div class="lain row form-group"><div class="col-md-12 col-12">' +
                            '<img class="img-fluid" src="'+result+'">' +
                            '</div></div>' +
                            '<div class="modal-footer">' +
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$(\'body\').removeClass(\'modal-open\'); $(\'#alasanPadam2\').hide(); $(\'div.modal-backdrop\').hide(); $(\'#alasanPadam2\').html(\'\');">Tutup</button>' +
                            '</div></div></div>';
                        $('#alasanPadam2').html(data_borang);
                    }
                });
            });
        }
    </script>
    <div style="display: none" class="modal fade" id="alasanPadam2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="alasanPadamLabel" aria-hidden="true">
    </div>
<?php } ?>
<script>
    function loadPage(alamat_web, load_area) {
        $(document).ready(function(){
            $.ajax({
                url: alamat_web,
                success: function(result){
                    $(load_area).html(result);
                }
            });
        });
    }
</script>
<?php if($_GET['action'] == "butiran_jawatanpegawai") { ?>
    <script type="text/javascript">
        $("#jawatan").change(function(){
            if($(this).val() == "Imam") {
                $("#lantikkanContainer").show();
                $("#lantikkan").attr("required", true);
            }
            else {
                $("#lantikkanContainer").hide();
                $("#lantikkan").removeAttr("required");
            }
        });
    </script>
<?php } ?>
<script type="text/javascript">
    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    <?php
    if($_SESSION['msgResult'] != NULL) {
        echo 'Swal.fire("Notis", "' . $_SESSION['msgResult'] . '", "'.$_SESSION['msgType'].'");';
        unset($_SESSION['msgResult']);
        unset($_SESSION['msgType']);
    }
    ?>
    $('.tarikh-bootstrap').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        minDate : new Date("2023-01-01"),
        // maxDate : new Date("2023-05-31")
    });
</script>
