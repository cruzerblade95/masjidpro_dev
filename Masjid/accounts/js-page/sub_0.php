<script type="text/javascript">
    function kiraJumlahAkaun() {
        var jumlahAkaun = 0.00;
        var subJumlahAkaun = 0.00;
        $('.amount').each(function( index ) {
            if(!isNaN(parseFloat($(this).val()))) subJumlahAkaun = $(this).val();
            else subJumlahAkaun = 0.00;
            jumlahAkaun = parseFloat(jumlahAkaun) + parseFloat(subJumlahAkaun);
            jumlahAkaun = jumlahAkaun.toFixed(2);
        });
        $('#jumlah').html('RM '+ addCommas(jumlahAkaun));
        if(jumlahAkaun > 0) {
            $('.balanceAccount').show();
        }
        else {
            $('.balanceAccount').hide();
            $('#pairAccountsCategory_id').val(null);
        }
    }
    function pilihBayaran(a, b) {
        if(a != null && a != "") $(b).show();
        else {
            $(b).hide();
            $(b+' input').val(null);
            $('.amount').each(function( index ) {
                if($(this).val() == null || $(this).val() == "") $(this).val('0');
            });
        }
        kiraJumlahAkaun();
        $('.pairAccountAll').show();
        <?php if($_GET['mode'] == 2) { ?>
        $('#pairAccountsCategory_id_'+$('#pilihHutang').val()).hide();
        <?php } else { ?>
        if($('#pilihHutang').val() != null && $('#pilihHutang').val() != "") $('.pairCreditors, .pairDebtors').hide();
        <?php } ?>
    }
    
    // function submit_baucar(){
    //     let tarikh_semasa = document.getElementById("tarikh_semasa");
    //     document.getElementById("nama_vendor").value = null;
    //     document.getElementById("tujuan_bayaran").value = null;
    //     document.getElementById("dateRecords").value = tarikh_semasa;
    //     // var tarikh_semasa = ('#tarikh_semasa').val();
    //     // $('#nama_vendor').val(null);
    //     // $('#tujuan_bayaran').val(null);
    //     // $('#dateRecords').val(tarikh_semasa);
    // }

    function verifyPair() {
        console.log($('#pairAccountsCategory_id').find(':selected').data("hidden"));
        var a = $('#pairAccountsCategory_id').find(':selected').data("hidden");
        $('#assetTypeData').val(a);
    }
</script>