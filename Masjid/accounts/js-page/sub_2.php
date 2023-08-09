<script type="text/javascript">
    function filterAccount(a) {
        console.log(a);
        $('.listCredit, .listDebit').hide();
        if(a != "" && a != null) {
            $('.lainForm').show();
            if(a == 1) $('.assetType_99').show();
            else if(a == 2 || a == 3) {
                $('.assetType_1, .assetType_2').show();
                if(a == 2) {
                    $('.assetType1_2, .assetType2_1').hide();
                }
                if(a == 3) {
                    $('.assetType1_1, .assetType2_2').hide();
                }
            }else if(a == 4){
                
                $('.assetType_3').show();
                $('.tabungAm_1').show();
                // $('.akaun_18').show();
                // $('.akaun_41').show();
                
                $('.assetType2_3').hide();
                $('.assetType1_99').hide();
                
            }else if(a == 5){
                
                $('.assetType_4').show();
                $('.assetType_1, .assetType_2').show();
                
                $('.assetType2_4').hide();
                $('.assetType1_1, .assetType1_2').hide();
                
            }else if(a == 6){
                
                $('.assetType_5').show();
                $('.assetType_1, .assetType_2').show();
                
                $('.assetType2_5').hide();
                $('.assetType1_1, .assetType1_2').hide();
                
            }else if(a == 7){
                
                $('.assetType_99, .assetType_1, .assetType_2, .assetType_3, .assetType_4, .assetType_5, .assetType_6, .assetType_7').show();
                
            }else if(a == 8){
                
                $('.assetType_1, .assetType_2, .assetType_7').show();
                $('.assetType_3').show();
                
                $('.assetType1_1, .assetType1_2, .assetType1_7').hide();
                $('.assetType2_3').hide();
                
            }else if(a == 9){
                
                $('.assetType_1, .assetType_2').show();
                $('.assetType_4').show();
                
                $('.assetType2_1, .assetType2_2').hide();
                $('.assetType1_4').hide();
                
            }else if(a == 10){
                
                $('.assetType_1, .assetType_2').show();
                $('.assetType_5').show();
                
                $('.assetType2_1, .assetType2_2').hide();
                $('.assetType1_5').hide();
                
            }
            // console.log($('.listCredit').is(":visible"));
            // console.log($('.listDebit:visible').length);
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
        // $('.pairAccountsCategory_id').val(null);
        $('.pairAccountsCategory_id option').show();
        filterAccount($('#jenisTransaksi').val());
        $('.akaun_'+myArray[0]).hide();
        //$(".pairAccountsCategory_id [class!='jenis_"+myArray[1]+"']").hide();
    }
    
    $(document).ready(function(){
        $('#jenisTransaksi').on('change', function() {
            filterAccount(this.value);
            $('#tujuanTransaksi').val(null);
            $('#accountsCategory_id').val('');
            $('.pairAccountsCategory_id').val(null);
            // $('.amaunAmaun').val(0);
            // document.getElementById('amounts').value = 0;
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
        document.getElementById('amounts').value = sum.toFixed(2);
        document.getElementById('jumlah').textContent = addCommas(sum.toFixed(2));
        
        if($('#amounts').val()!=""){
            if($('#amounts').val() > 0){ $('#simpanButton').show();}
            else{ $('#simpanButton').hide();}
            // console.log($('#amounts').val());
        }
    }
    
    function keTarikhPilihan(){
        var dateRecords = document.getElementById('dateRecords');
        var tarikh_pilihan = document.getElementById('tarikh_pilihan');
        tarikh_pilihan.value = dateRecords.value;
        console.log(document.getElementById('dateRecords').value);
        console.log(document.getElementById('tarikh_pilihan').value);
    }
    
    function kePilihanJenisTransaksi(){
        var x = document.getElementById('jenisTransaksi').value;
        var y1 = document.getElementById('penukaranLabel1_1');
        var y2 = document.getElementById('penukaranLabel1_2');
        var z1 = document.getElementById('penukaranLabel2_1');
        var z2 = document.getElementById('penukaranLabel2_2');
        
        if (x == "4"){
            y1.style.display = 'block';
            z1.style.display = 'block';
            y1.innerHTML = "* Debit Ke Sub-Akaun";
            z1.innerHTML = "* Debit Ke Sub-Akaun";
            y2.style.display = 'none';
            z2.style.display = 'none';
        }else if (x == "7"){
            y1.style.display = 'none';
            z1.style.display = 'none';
            y2.style.display = 'block';
            z2.style.display = 'block';
        }else if (x == "8"){
            y1.style.display = 'block';
            z1.style.display = 'block';
            y1.innerHTML = "* Kredit Ke Sub-Akaun";
            z1.innerHTML = "* Debit Ke Sub-Akaun";
            y2.style.display = 'none';
            z2.style.display = 'none';
        }else{
            y1.style.display = 'block';
            z1.style.display = 'block';
            y1.innerHTML = "* Debit Ke Sub-Akaun";
            z1.innerHTML = "* Kredit Ke Sub-Akaun";
            y2.style.display = 'none';
            z2.style.display = 'none';
        }
    }
    
    function listPairTrigger(a){
        // console.log(a);
        // console.log($('.listCredit').val());
        
        var cost = document.getElementsByName('pairAccountsCategory_id[]');
        
        for (var i = 0; i < cost.length; i++)
        {
            // console.log(cost[i].value);
            var option= cost[i].options[cost[i].selectedIndex];
            var datahidden = option.getAttribute("data-hidden");
            // $('.akaun_'+cost[i].value).prop('disabled', true);
            console.log(datahidden);
            
            if(datahidden == "7"){
                document.getElementById('assetTypeData').value= "2";
            }
        }
        
        // var a = $('#pairAccountsCategory_id').find(':selected').data("hidden");
        // console.log($(this).find("option:selected").attr('data-rc'));
        // $('#assetTypeData').val(a);
        
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