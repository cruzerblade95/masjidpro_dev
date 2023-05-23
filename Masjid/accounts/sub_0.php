<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header bg-info" align="center">
                <h5 class="m-b-0 text-white font-weight-bold"><?php echo($tajukSubModul); ?></h5>
            </div>
            <div class="card-body">
                <form onsubmit="return confirm('Adakah anda pasti segala input adalah tepat?');" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" method="post">
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
                            <input readonly class="tarikh-bootstrap form-control" name="dateRecords" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <?php //} ?>
                    <div class="row form-group">
                        <div class="col-12 col-md-12">
                            <label>* <?php echo $_GET['mode'] == 2 ? 'Bayar Kepada' : 'Terima Daripada'; ?></label>
                            <input oninput="this.value = this.value.toUpperCase()" required class="form-control" name="vendor" value="<?php echo($vendor); ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-md-12">
                            <label>* Tujuan Bayaran</label>
                            <input oninput="this.value = this.value.toUpperCase()" required class="form-control" name="particulars" value="<?php echo($particulars); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12"><label>* Cara Bayaran (Tunai / Bank / Hutang atau Mana-mana kombinasi bayaran)</label></div>
                    </div>
                    <div class="row form-group border p-3">
                        <div class="col-12 col-md-6">
                            <label>Tunai</label>
                            <select onchange="pilihBayaran(this.value, '.tunaiGroup')" class="kategori form-control" name="accountsCategory_id[]">
                                <option value=""></option>
                                <?php do { ?>
                                    <option value="<?php echo($row_tunai['id']); ?>"><?php echo($row_tunai['categoryName']); ?></option>
                                <?php } while($row_tunai = mysqli_fetch_assoc($fetch_tunai)); ?>
                            </select>
                        </div>
                        <div class="tunaiGroup col-12 col-md-3" style="display: none">
                            <label>No. Cek (Jika ada)</label>
                            <input class="form-control" name="chequeNo[]" value="<?php echo($chequeNo); ?>">
                        </div>
                        <div class="tunaiGroup col-12 col-md-3" style="display: none">
                            <label>Amaun (RM)</label>
                            <input oninput="kiraJumlahAkaun()" min="0" placeholder="" type="number" step="any" class="amount form-control" name="amount[]" value="0">
                        </div>
                    </div>
                    <div class="row form-group border p-3">
                        <div class="col-12 col-md-6">
                            <label>Bank (Online Transfer)</label>
                            <select onchange="pilihBayaran(this.value, '.bankGroup')" class="kategori form-control" name="accountsCategory_id[]">
                                <option value=""></option>
                                <?php do { ?>
                                    <option value="<?php echo($row_bank['id']); ?>"><?php echo($row_bank['categoryName']); ?></option>
                                <?php } while($row_bank = mysqli_fetch_assoc($fetch_bank)); ?>
                            </select>
                        </div>
                        <div class="bankGroup col-12 col-md-3" style="display: none">
                            <label>Ref No. (Jika ada)</label>
                            <input class="form-control" name="chequeNo[]" value="<?php echo($chequeNo2); ?>">
                        </div>
                        <div class="bankGroup col-12 col-md-3" style="display: none">
                            <label>Amaun (RM)</label>
                            <input oninput="kiraJumlahAkaun()" min="0" placeholder="" type="number" step="any" class="amount form-control" name="amount[]" value="0">
                        </div>
                    </div>
                    <div class="row form-group border p-3">
                        <div class="col-12 col-md-6">
                            <label>Hutang</label>
                            <select id="pilihHutang" onchange="pilihBayaran(this.value, '.hutangGroup')" class="kategori form-control" name="accountsCategory_id[]">
                                <option value=""></option>
                                <?php do { ?>
                                    <option value="<?php echo($row_hutang['id']); ?>"><?php echo($row_hutang['categoryName']); ?></option>
                                <?php } while($row_hutang = mysqli_fetch_assoc($fetch_hutang)); ?>
                            </select>
                        </div>
                        <div class="hutangGroup col-12 col-md-3" style="display: none">
                            <label>Nota (Jika ada)</label>
                            <input class="form-control" name="chequeNo[]" value="<?php echo($chequeNo2); ?>">
                        </div>
                        <div class="hutangGroup col-12 col-md-3" style="display: none">
                            <label>Amaun (RM)</label>
                            <input oninput="kiraJumlahAkaun()" min="0" placeholder="" type="number" step="any" class="amount form-control" name="amount[]" value="0">
                        </div>
                    </div>
                    <?php if($_GET['mode'] == 2) { ?>
                    <div class="balanceAccount row border border-danger alert alert-danger" role="alert" style="display: none">
                        <?php } else { ?>
                        <div class="balanceAccount row border border-success alert alert-success" role="alert" style="display: none">
                            <?php } ?>
                            <div class="col-12 col-md-6">
                                <label class="font-weight-bold">* <?php echo $_GET['mode'] == 2 ? 'Caj' : 'Masuk'; ?> Ke Akaun / Tabung</label>
                                <select onchange2="verifyPair()" id="pairAccountsCategory_id" class="form-control" required name="pairAccountsCategory_id">
                                    <option value=""></option>
                                    <?php do { ?>
                                        <option class="pairAccountAll<?php echo $row_liabiliti['assetType'] == 7 ? ' pairCreditors' : ''; ?><?php echo $row_liabiliti['assetType'] == 6 ? ' pairDebtors' : ''; ?>" id="pairAccountsCategory_id_<?php echo($row_liabiliti['id']); ?>" value="<?php echo($row_liabiliti['id']); ?>"><?php echo($row_liabiliti['categoryName']); ?></option>
                                    <?php } while($row_liabiliti = mysqli_fetch_assoc($fetch_liabiliti)); ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-6" align="center">
                                <h3 class="font-weight-bold">JUMLAH BAYARAN</h3>
                                <h3 id="jumlah" class="font-weight-bold">RM 1,000.00</h3>
                            </div>
                        </div>
                        <div class="row balanceAccount form-group" style="display: none" align="center">
                            <div class="col-12 col-md-12">
                                <?php if($training_dua == 1) { ?><input type="hidden" name2="dateRecords" value="<?php echo date('Y-m-d'); ?>"><?php } ?>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>