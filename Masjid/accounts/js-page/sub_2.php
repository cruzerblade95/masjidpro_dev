<script type="text/javascript">
    function filterAccount(a) {
        $('.listCredit, .listDebit').hide();
        if(a != "" && a != null) {
            $('.lainForm').show();
            if(a == 1) $('.assetType_99').show();
            else if(a == 2 || a == 3) {
                $('.assetType_1, .assetType_2').show();
                if(a == 2) {
                    $('.assetType1_1, .assetType2_2').hide();
                }
                if(a == 3) {
                    $('.assetType1_2, .assetType2_1').hide();
                }
            }
            console.log($('.listCredit').is(":visible"));
            console.log($('.listDebit:visible').length);
            $('.listCredit').attr('selected');
            $('.listDebit').attr('selected');
            if($('.listCredit:visible').length == 1) $('.listCredit:visible').attr('selected');
            if($('.listDebit:visible').length == 1) $('.listDebit:visible').attr('selected');
        }
        else {
            $('.input-group').remove();
            $('.lainForm').hide();
            $('.lainForm input, .lainForm select').val(null);
            $('#dateRecords').val('<?php echo date('Y-m-d'); ?>');
        }
        if($('.itemGroup').length == 0) $('#addRow').click();
    }
    function accountTransfer(a) {
        var myArray = a.split("|");
        $('.pairAccountsCategory_id').val(null);
        $('.pairAccountsCategory_id option').show();
        filterAccount($('#jenisTransaksi').val());
        $('.akaun_'+myArray[0]).hide();
        //$(".pairAccountsCategory_id [class!='jenis_"+myArray[1]+"']").hide();
    }
    function kiraJumlahAkaun(a) {
        if(a > 0){ $('#simpanButton').show();}
        else{ $('#simpanButton').hide();}
        
        
    }
    
    $(document).ready(function(){
        $('#jenisTransaksi').on('change', function() {
            filterAccount(this.value);
            $('#tujuanTransaksi').val(null);
            $('#accountsCategory_id').val('');
            $('.pairAccountsCategory_id').val(null);
            $('.amaunAmaun').val(0);
            document.getElementById('amounts').value = 0;
            // document.getElementsByName('amount_pair[]').value = 0;
        });
        
    });
    
    function tambah() {
        var sum = 0;
        var cost = document.getElementsByName('amount_pair[]');
        for (var i = 0; i < cost.length; i++)
        {
            sum += parseFloat(cost[i].value);
        }
        document.getElementById('amounts').value = sum;
    }

    function loadDynamicRow(a, b, c, d, e, f, g, h, i) {
        // if($(a).length) {
        //     var html = $(a).html();
        //     $(a).remove();
        // } else {
        //     var html = $(b).html();
        //     $(b).html('');
        // }
        var html = $(b).html();
        $(b).html('');
        var items = $(d).length;

        // add row
        $(i).click(function () {
            items++;
            $(b).append(html);
            accountTransfer($('#accountsCategory_id').val());
            //reNumbering(e);
            //kiraJumlah();
        });

        // remove row
        $(document).on('click', h, function () {
            $(this).closest(c).remove();
            // accountTransfer($('#accountsCategory_id').val());
            //reNumbering(e);
            //kiraJumlah();
        });

        $(document).on('click', g, function () {
            var idKlik = $(this).parent().parent().parent().find(f);
            if(idKlik.is(":visible")) idKlik.hide();
            else idKlik.show();
        });
    }
    loadDynamicRow('#extraLoop', '#ada_varians', '#inputFormRow', '.itemGroup', '.numberIndex', '#moreInfo', '#moreInfoAkaun', '#removeRow', '#addRow');
    //if($('.itemGroup').length) kiraJumlah();
    
    
    
</script>