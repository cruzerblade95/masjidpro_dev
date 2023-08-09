<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<?php

function tarikhHijri() {
    $hari_bahasa=date('l');
    $bulan_masihi=date('m');
    $hari_masihi=date('d'); //Boleh +-
    $tahun_masihi=date('Y');
    
    if (($tahun_masihi>1582)||(($tahun_masihi==1582)&&($bulan_masihi>10))||(($tahun_masihi==1582)&&($bulan_masihi==10)&&($hari_masihi>14)))
    	{
    	$zjd=(int)((1461*($tahun_masihi + 4800 + (int)( ($bulan_masihi-14) /12) ))/4) + (int)((367*($bulan_masihi-2-12*((int)(($bulan_masihi-14)/12))))/12)-(int)((3*(int)(( ($tahun_masihi+4900+(int)(($bulan_masihi-14)/12))/100)))/4)+$hari_masihi-32075;
    	}
    else
    	{
    	$zjd = 367*$tahun_masihi-(int)((7*($tahun_masihi+5001+(int)(($bulan_masihi-9)/7)))/4)+(int)((275*$bulan_masihi)/9)+$hari_masihi+1729777;
    	}		
    
    $zl=$zjd-1948440+10632;
    $zn=(int)(($zl-1)/10631);
    $zl=$zl-10631*$zn+354;
    $zj=((int)((10985-$zl)/5316))*((int)((50*$zl)/17719))+((int)($zl/5670))*((int)((43*$zl)/15238));
    $zl=$zl-((int)((30-$zj)/15))*((int)((17719*$zj)/50))-((int)($zj/16))*((int)((15238*$zj)/43))+29;
    
    $bulan_hijri=(int)((24*$zl)/709);
    $hari_hijri=$zl-(int)((709*$bulan_hijri)/24);
    $tahun_hijri=30*$zn+$zj-30;
    
    if($bulan_hijri==1){ $bulan_hijri = "Muharam"; }
    if($bulan_hijri==2){ $bulan_hijri = "Safar"; }
    if($bulan_hijri==3){ $bulan_hijri = "Rabiul Awal"; }
    if($bulan_hijri==4){ $bulan_hijri = "Rabiul Akhir";}
    if($bulan_hijri==5){ $bulan_hijri = "Jamadil Awal";}
    if($bulan_hijri==6){ $bulan_hijri = "Jamadil Akhir";}
    if($bulan_hijri==7){ $bulan_hijri = "Rejab";}
    if($bulan_hijri==8){ $bulan_hijri = "Syaban";}
    if($bulan_hijri==9){ $bulan_hijri = "Ramadhan";}
    if($bulan_hijri==10){ $bulan_hijri = "Syawal";}
    if($bulan_hijri==11){ $bulan_hijri = "Zulkaedah";}
    if($bulan_hijri==12){ $bulan_hijri = "Zulhijah";}
    
    if($hari_bahasa=="Sunday"){ $hari_bahasa = "Ahad"; }
    if($hari_bahasa=="Monday"){ $hari_bahasa = "Isnin"; }
    if($hari_bahasa=="Tuesday"){ $hari_bahasa = "Selasa"; }
    if($hari_bahasa=="Wednesday"){ $hari_bahasa = "Rabu"; }
    if($hari_bahasa=="Thursday"){ $hari_bahasa = "Khamis"; }
    if($hari_bahasa=="Friday"){ $hari_bahasa = "Jumaat"; }
    if($hari_bahasa=="Saturday"){ $hari_bahasa = "Sabtu"; }
    
    //PAPARAN OUTPUT
    echo  $hari_bahasa . ", " . date('d M Y') . " / " . $hari_hijri." ".$bulan_hijri." ".$tahun_hijri."H";
    
}

?>

<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header bg-info" align="center">
                <h5 class="m-b-0 text-white font-weight-bold"><?php echo($tajukSubModul); ?></h5>
            </div>
            <form onsubmit="return confirm('Adakah anda pasti segala input adalah tepat?');" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" method="post">
                <div class="card-body row">
                    <div class="col-12 col-md-auto">
                        <label>* Jenis Transaksi</label>
                        <select class="form-control" onchange="kePilihanJenisTransaksi()" id="jenisTransaksi" name="jenisTransaksi" required>
                            <option value=""></option>
                            <option value="1">Pindahan Antara Sub-Akaun</option>
                            <option value="2">Tunai - Simpan Tunai Ke Bank</option>
                            <option value="3">Tunai - Keluar Tunai Dari Bank</option>
                            <option value="8">Harta - Beli Harta</option>
                            <option value="4">Harta - Susut Nilai/Pelupusan Harta</option>
                            <option value="9">Pelaburan - Beli Saham</option>
                            <option value="5">Pelaburan - Jual Saham</option>
                            <option value="10">Simpanan Tetap - Beli/Tambah Simpanan Tetap</option>
                            <option value="6">Simpanan Tetap - Jual/Lupus Simpanan Tetap</option>
                            <option value="7">Pelarasan Sub-Akaun</option>
                        </select>
                    </div>
                </div>
                <div class="card-body lainForm" style="display: none">
                    <?php if($training_dua == 1) { ?>
                        <div class="row form-group">
                            <div class="col-12 col-md-12">
                                <h4>Tarikh : <?php fungsi_tarikh(date('Y-m-d'), 2, 7); ?></h4>
                            </div>
                        </div>
                    <?php } //if($training == 2) { ?>
                    <div class="row form-group">
                        <div class="col-12 col-md-auto">
                            <label>* Tarikh Transaksi</label>
                            <input <?php if($_GET['training'] == NULL){echo 'readonly';}else{} ?> class="<?php if($_GET['training'] == 1){echo 'tarikh-bootstrap';}else{} ?> form-control" id="dateRecords" onchange="keTarikhPilihan()" name="dateRecords" value="<?php echo date('Y-m-d'); ?>">
                            <input type="hidden" id="tarikh_pilihan" name="tarikh_pilihan" value="<?php echo date('Y-m-d'); ?>">
                            <!--echo tarikhHijri();-->
                            <!--<input readonly class="tarikh-bootstrap form-control" id="dateRecords" name="dateRecords" value="">-->
                        </div>
                    </div>
                    <?php //} ?>
                    <div class="row form-group">
                        <div class="col-12 col-md-12">
                            <label>* Tujuan Transaksi</label>
                            <input id="tujuanTransaksi" oninput="this.value = this.value.toUpperCase()" required class="form-control" name="particulars" maxlength="100">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-md-12">
                            <label id="penukaranLabel1_1"></label>
                            <label id="penukaranLabel1_2">
                                * 
                                <select name="debitKreditDropdown1">
                                    <option value=""></option>
                                    <option value="1">Debit</option>
                                    <option value="2">Kredit</option>
                                </select>    
                                Dari Sub-Akaun
                            </label>
                            <select id="accountsCategory_id" required onchange="accountTransfer(this.value)" class="form-control" name="accountsCategory_id">
                                <option value=""></option>
                                <?php do {
                                    $namaAkaun = $arrayAkaun[$row_listAkaun['assetType']]." - ".$row_listAkaun['categoryName'];
                                    $namaAkaun = str_replace($row_listAkaun['categoryName']." - ", "", $namaAkaun);
                                    if (!strpos($namaAkaun, " - ") !== false) $namaAkaun = str_replace(" - ", "", $namaAkaun);
                                    ?>
                                    <option class="listDebit assetType1_<?php echo $row_listAkaun['assetType'] == NULL ? '99' : $row_listAkaun['assetType']; ?> assetType_<?php echo $row_listAkaun['assetType'] == NULL ? '99' : $row_listAkaun['assetType']; ?>" value="<?php echo($row_listAkaun['id'].'|'.$row_listAkaun['categoryType']); ?>"><?php echo($namaAkaun); ?></option>
                                <?php } while($row_listAkaun = mysqli_fetch_assoc($fetch_listAkaun)); ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <label id="penukaranLabel2_1"></label>
                            <label id="penukaranLabel2_2">
                                * 
                                <select name="debitKreditDropdown2">
                                    <option value=""></option>
                                    <option value="1">Debit</option>
                                    <option value="2">Kredit</option>
                                </select>    
                                Dari Sub-Akaun
                            </label>
                        </div>
                        <div class="col-12 col-md-4" style="text-align: right"><label>* Amaun (RM)</label><img width="36" height="0" src="images/logo.png"></div>
                    </div>
                    <input type="hidden" id="assetTypeData" name="assetType" value="">
                    <div id="ada_varians" class="row">
                        <div id="inputFormRow" class="input-group itemGroup col-12 col-md-12 form-group">
                            <select required class="pairAccountsCategory_id form-control" name="pairAccountsCategory_id[]" onchange="listPairTrigger(this.value)">
                                <option value=""></option>
                                <?php do {
                                    $namaAkaun2 = $arrayAkaun[$row_listAkaun2['assetType']]." - ".$row_listAkaun2['categoryName'];
                                    $namaAkaun2 = str_replace($row_listAkaun2['categoryName']." - ", "", $namaAkaun2);
                                    if (!strpos($namaAkaun2, " - ") !== false) $namaAkaun2 = str_replace(" - ", "", $namaAkaun2);
                                    ?>
                                    <option data-hidden="<?php echo $row_listAkaun2['assetType']; ?>" class="listCredit tabungAm_<?php echo($row_listAkaun2['tabung_am']); ?> assetType2_<?php echo $row_listAkaun2['assetType'] == NULL ? '99' : $row_listAkaun2['assetType']; ?> assetType_<?php echo $row_listAkaun2['assetType'] == NULL ? '99' : $row_listAkaun2['assetType']; ?> akaun_<?php echo($row_listAkaun2['id']); ?> jenis_<?php echo($row_listAkaun2['categoryType']); ?>" value="<?php echo($row_listAkaun2['id']); ?>"><?php echo($namaAkaun2); ?></option>
                                <?php } while($row_listAkaun2 = mysqli_fetch_assoc($fetch_listAkaun2)); ?>
                            </select>
                            <div class="input-group-append">
                                <input style="text-align: right" min="0.00" onkeyup="tambah();" step="0.1" placeholder="Amaun (RM)" type="number" class="form-control amaunAmaun" name="amount_pair[]" value="0.00">
                                <button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-md-auto"><button id="addRow" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-md-12">
                            <div class="balanceAccount row border border-success alert alert-success" role="alert">
                                <h3 class="font-weight-bold">JUMLAH</h3>
                                &nbsp &nbsp &nbsp &nbsp<h3 class="font-weight-bold">RM <span id="jumlah" class="font-weight-bold">0.00</span></h3>
                                <input id="amounts" min="0.00" placeholder="" type="hidden" step="0.1" class="form-control" name="amount" value="0.00" readonly>
                            </div>
                        </div>
                    </div>
                    <div id="simpanButton" class="row form-group" style="display: none" align="center">
                        <div class="col-12 col-md-12">
                            <?php if($training_dua == 1) { ?><input type="hidden" name="dateRecords" value="<?php echo date('Y-m-d'); ?>"><?php } ?>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>