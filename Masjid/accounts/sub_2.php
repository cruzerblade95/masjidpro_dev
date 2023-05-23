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
                        <select class="form-control" id="jenisTransaksi" required>
                            <option value=""></option>
                            <option value="1">Pindahan Antara Sub-Akaun</option>
                            <option value="2">Simpan Tunai Di Bank</option>
                            <option value="3">Keluar Tunai Dari Bank</option>
                            <option value="4">Susut Nilai / Pelupusan Harta</option>
                            <option value="5">Penjualan Saham</option>
                            <option value="6">Pengeluaran Simpanan Tetap</option>
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
                            <input readonly class="tarikh-bootstrap form-control" id="dateRecords" name="dateRecords" value="<?php echo date('Y-m-d'); ?>">
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
                            <label>* Debit Dari Sub-Akaun</label>
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
                            <label>* Kredit Ke Sub-Akaun</label>
                        </div>
                        <div class="col-12 col-md-4" style="text-align: right"><label>* Amaun (RM)</label><img width="36" height="0" src="images/logo.png"></div>
                    </div>
                    <div id="ada_varians" class="row">
                        <div id="inputFormRow" class="input-group itemGroup col-12 col-md-12 form-group">
                            <select required class="pairAccountsCategory_id form-control" name="pairAccountsCategory_id[]">
                                <option value=""></option>
                                <?php do {
                                    $namaAkaun2 = $arrayAkaun[$row_listAkaun2['assetType']]." - ".$row_listAkaun2['categoryName'];
                                    $namaAkaun2 = str_replace($row_listAkaun2['categoryName']." - ", "", $namaAkaun2);
                                    if (!strpos($namaAkaun2, " - ") !== false) $namaAkaun2 = str_replace(" - ", "", $namaAkaun2);
                                    ?>
                                    <option class="listCredit assetType2_<?php echo $row_listAkaun2['assetType'] == NULL ? '99' : $row_listAkaun2['assetType']; ?> assetType_<?php echo $row_listAkaun2['assetType'] == NULL ? '99' : $row_listAkaun2['assetType']; ?> akaun_<?php echo($row_listAkaun2['id']); ?> jenis_<?php echo($row_listAkaun2['categoryType']); ?>" value="<?php echo($row_listAkaun2['id']); ?>"><?php echo($namaAkaun2); ?></option>
                                <?php } while($row_listAkaun2 = mysqli_fetch_assoc($fetch_listAkaun2)); ?>
                            </select>
                            <div class="input-group-append">
                                <input style="text-align: right" oninput2="kiraJumlahAkaun(this.value)" onChange="tambah();" min="0" placeholder="Amaun (RM)" type="number" step="any" class="form-control amaunAmaun" name="amount_pair[]" value="0">
                                <button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-md-auto"><button id="addRow" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-md-12">
                            <label>* Amaun (RM)</label>
                            <input id="amounts" oninput="kiraJumlahAkaun(this.value)" min="0" placeholder="" type="number" step="any" class="form-control" name="amount" value="0">
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