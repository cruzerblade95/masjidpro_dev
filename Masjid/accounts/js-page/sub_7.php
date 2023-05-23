<script type="text/javascript">
    function kiraJumlah() {
        var jumlahDebit = 0.00;
        var subJumlahDebit = 0.00;
        $('.amaun-debit').each(function( index ) {
            if(!isNaN(parseFloat($(this).val()))) subJumlahDebit = $(this).val();
            else subJumlahDebit = 0.00;
            jumlahDebit = parseFloat(jumlahDebit) + parseFloat(subJumlahDebit);
            jumlahDebit = jumlahDebit.toFixed(2);
        });
        $('#jumlahDebit').html('JUMLAH: RM '+ addCommas(jumlahDebit));

        var jumlahKredit = 0.00;
        var subJumlahKredit = 0.00;
        $('.amaun-kredit').each(function( index ) {
            if(!isNaN(parseFloat($(this).val()))) subJumlahKredit = $(this).val();
            else subJumlahKredit = 0.00;
            jumlahKredit = parseFloat(jumlahKredit) + parseFloat(subJumlahKredit);
            jumlahKredit = jumlahKredit.toFixed(2);
        });
        $('#jumlahKredit').html('JUMLAH: RM '+ addCommas(jumlahKredit));

        if(jumlahDebit == jumlahKredit && $('.itemGroup').length > 0 && $('.itemGroup2').length > 0) {
            $('#nilaiKariah').html('RM: ' + addCommas(jumlahDebit));
            $('#buttonSimpan').show();
        }
        else {
            $('#nilaiKariah').html('');
            $('#buttonSimpan').hide();
        }
    }

    function showBtn() {
        if($('.itemGroup').length) $('#btnSubmit').show();
        else {
            items = 0;
            $('#btnSubmit').hide();
        }
    }

    function reNumbering(a) {
        var numberIndex = 0;
        $(a).each(function( index ) {
            numberIndex = index + 1;
            $(this).html(numberIndex);
        });
    }

    function loadDynamicRow(a, b, c, d, e, f, g, h, i) {
        if($(a).length) {
            var html = $(a).html();
            $(a).remove();
        } else {
            var html = $(b).html();
            $(b).html('');
        }
        var items = $(d).length;

        // add row
        $(i).click(function () {
            items++;
            $(b).append(html);
            reNumbering(e);
            kiraJumlah();
            eval(document.getElementById('skripDate').innerHTML);
        });

        // remove row
        $(document).on('click', h, function () {
            $(this).closest(c).remove();
            reNumbering(e);
            kiraJumlah();
        });

        $(document).on('click', g, function () {
            var idKlik = $(this).parent().parent().parent().find(f);
            if(idKlik.is(":visible")) idKlik.hide();
            else idKlik.show();
        });
    }
    $(document).ready(function(){
        $('#tarikhOverall').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
        loadDynamicRow('#extraLoop', '#ada_varians', '#inputFormRow', '.itemGroup', '.numberIndex', '#moreInfo', '#moreInfoAkaun', '#removeRow', '#addRow');
        loadDynamicRow('#extraLoop2', '#ada_varians2', '#inputFormRow2', '.itemGroup2', '.numberIndex2', '#moreInfo2', '#moreInfoAkaun2', '#removeRow2', '#addRow2');
        if($('.itemGroup, .itemGroup2').length) kiraJumlah();
    });
    function padamRekodAkaun(a) {
        if(confirm('Adakah anda pasti ingin memadam rekod ini?')) {
            document.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>&id=' + a;
        }
    }
</script>
<script id="skripDate" type="text/javascript">
    $('.tarikh-baki').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
    function tukarTarikh() {
        if($('#tarikhOverall').val() != null && $('#tarikhOverall').val() != "") {
            $('.tarikh-baki').each(function(index) {
                if($(this).val() == null || $(this).val() == "") $(this).val($('#tarikhOverall').val());
            });
        }
    }
    tukarTarikh();
</script>