<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header bg-info" align="center">
                <h5 class="m-b-0 text-white font-weight-bold">Kedudukan Kewangan Kariah Pada Permulaan</h5>
            </div>
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-12 col-md-6">
                        <input value="<?php echo $openingDate != NULL ? $openingDate : NULL; ?>" onchange="tukarTarikh()" placeholder="* Tarikh Baki Permulaan" id="tarikhOverall" class="form-control">
                    </div>
                    <?php if($training == 2) { ?>
                    <div class="col-12 col-md-6">
                        <button type="button" class="btn btn-danger" onClick="modal_delete_akaun('Padam Semua Rekod (Reset)', '<h4>Rekod yang dipadam (reset) tidak diboleh dikembalikan. Adakah anda pasti?</h4>', '&subModul=7&reset=1')"><i class="fas fa-trash-alt"></i>&nbsp;Padam Semua Rekod (Reset)</button>
                    </div>
                    <?php } ?>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-6 table-responsive">
                            <table class="table table-sm table-hover table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">BIL</th>
                                    <th scope="col">* KATEGORI & BUTIRAN</th>
                                    <th scope="col">* RM</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody id="ada_varians">
                                <?php $ii = 1; do {
                                    foreach ($field_aset as $field) {
                                        if($ii != $num_aset) ${$field->name} = $row_aset[$field->name];
                                        else ${$field->name} = NULL;
                                    }
                                    if($ii == $num_aset) {
                                        echo '<tbody id="extraLoop">';
                                    }
                                    ?>
                                    <tr id="inputFormRow" class="itemGroup">
                                        <th class="numberIndex" scope="row" style="vertical-align: middle; text-align: center"><?php echo($ii); ?></th>
                                        <td>
                                            <select name="assetType[]" class="form-control" required>
                                                <option value="">* KATEGORI</option>
                                                <option value="1" <?php echo $assetType == 1 ? 'selected' : NULL; ?>>TUNAI</option>
                                                <option value="2" <?php echo $assetType == 2 ? 'selected' : NULL; ?>>BANK</option>
                                                <option value="3" <?php echo $assetType == 3 ? 'selected' : NULL; ?>>HARTA</option>
                                                <option value="4" <?php echo $assetType == 4 ? 'selected' : NULL; ?>>PELABURAN</option>
                                                <option value="5" <?php echo $assetType == 5 ? 'selected' : NULL; ?>>SIMPANAN TETAP</option>
                                                <option value="6" <?php echo $assetType == 6 ? 'selected' : NULL; ?>>SI BERHUTANG</option>
                                            </select>
                                            <input value="<?php echo($categoryName); ?>" placeholder="* SUB-AKAUN" oninput="this.value = this.value.toUpperCase()" class="form-control" name="categoryName[]" required maxlength="100">
                                            <div id="moreInfo" style="display: none" class="input-group mt-3">
                                                <input oninput="this.value = this.value.toUpperCase()" placeholder="KOD AKAUN" class="form-control" name="categoryCode[]" maxlength="50" value="<?php echo($categoryCode); ?>">
                                                <div class="input-group-append">
                                                    <input placeholder="TARIKH BAKI AWAL" class="form-control tarikh-baki" name="dateRecords[]" value="<?php echo($dateRecords); ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 150px; vertical-align: middle"><input oninput="kiraJumlah()" class="form-control text-right amaun-debit" type="number" name="amount[]" required value="<?php echo($amount); ?>" step="any"></td>
                                        <td style="width: 100px">
                                            <div align="center">
                                                <input name="categoryType[]" type="hidden" value="1">
                                                <input name="typeJournalEntry[]" type="hidden" value="1">
                                                <input name="typeRecords[]" type="hidden" value="2">
                                                <input name="id[]" type="hidden" value="<?php echo($id); ?>">
                                                <input name="accountsCategory_id[]" type="hidden" value="<?php echo($accountsCategory_id); ?>">
                                                <input name="particulars[]" type="hidden" value="BAKI PERMULAAN">
                                                <input name="id_accountsRecords[]" type="hidden" value="<?php echo($id_accountsRecords); ?>">
                                                <button id="moreInfoAkaun" type="button" class="btn btn-info"><i class="fa fa-window-maximize"></i></button>
                                                <?php if($bilRekod == 0) { ?>
                                                    <button <?php echo $id != NULL ? 'onclick="padamRekodAkaun('.$id.')"' : NULL; ?> id="removeRow<?php echo $id != NULL ? 'Records' : NULL; ?>" type="button" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php if($ii == $num_aset) echo '</tbody>'; $ii++; } while($row_aset = mysqli_fetch_assoc($fetch_aset)); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="4"><button id="addRow" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-12 col-md-6 table-responsive">
                            <table class="table table-sm table-hover table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">BIL</th>
                                    <th scope="col">* BUTIRAN</th>
                                    <th scope="col">* RM</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody id="ada_varians2">
                                <?php $ii = 1; do {
                                    foreach ($field_ekuiti as $field) {
                                        if($ii != $num_ekuiti) ${$field->name} = $row_ekuiti[$field->name];
                                        else ${$field->name} = NULL;
                                    }
                                    if($ii == $num_ekuiti) {
                                        echo '<tbody id="extraLoop2">';
                                    }
                                    ?>
                                    <tr id="inputFormRow2" class="itemGroup2">
                                        <th class="numberIndex2" scope="row" style="vertical-align: middle; text-align: center"><?php echo($ii); ?></th>
                                        <td>
                                            <input value="<?php echo($categoryName); ?>" placeholder="* SUB-AKAUN" oninput="this.value = this.value.toUpperCase()" class="form-control" name="categoryName[]" required maxlength="100">
                                            <div id="moreInfo2" style="display: none">
                                                <select name="assetType[]" class="form-control">
                                                    <option value="">KATEGORI (Jika Berkenaan)</option>
                                                    <option value="7" <?php echo $assetType == 7 ? 'selected' : NULL; ?>>PUITANG</option>
                                                </select>
                                                <div class="input-group mt-3">
                                                    <input oninput="this.value = this.value.toUpperCase()" placeholder="KOD AKAUN" class="form-control" name="categoryCode[]" maxlength="50" value="<?php echo($categoryCode); ?>">
                                                    <div class="input-group-append">
                                                        <input placeholder="TARIKH BAKI AWAL" class="form-control tarikh-baki" name="dateRecords[]" value="<?php echo($dateRecords); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 150px; vertical-align: middle"><input oninput="kiraJumlah()" class="form-control text-right amaun-kredit" type="number" name="amount[]" required value="<?php echo($amount); ?>" step="any"></td>
                                        <td style="width: 100px">
                                            <div align="center">
                                                <input name="categoryType[]" type="hidden" value="2">
                                                <input name="typeJournalEntry[]" type="hidden" value="2">
                                                <input name="typeRecords[]" type="hidden" value="2">
                                                <input name="id[]" type="hidden" value="<?php echo($id); ?>">
                                                <input name="accountsCategory_id[]" type="hidden" value="<?php echo($accountsCategory_id); ?>">
                                                <input name="particulars[]" type="hidden" value="BAKI PERMULAAN">
                                                <input name="id_accountsRecords[]" type="hidden" value="<?php echo($id_accountsRecords); ?>">
                                                <button id="moreInfoAkaun2" type="button" class="btn btn-info"><i class="fa fa-window-maximize"></i></button>
                                                <?php if($bilRekod == 0) { ?>
                                                    <button <?php echo $id != NULL ? 'onclick="padamRekodAkaun('.$id.')"' : NULL; ?> id="removeRow2<?php echo $id != NULL ? 'Records' : NULL; ?>" type="button" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php if($ii == $num_ekuiti) echo '</tbody>'; $ii++; } while($row_ekuiti = mysqli_fetch_assoc($fetch_ekuiti)); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="4"><button id="addRow2" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6" align="right">
                            <div id="jumlahDebit" class="alert alert-success font-weight-bold font-20" role="alert"></div>
                        </div>
                        <div class="col-12 col-md-6" align="right">
                            <div id="jumlahKredit"class="alert alert-success font-weight-bold font-20" role="alert"></div>
                        </div>
                    </div>
                    <div id="buttonSimpan" class="row form-group" style="display: none">
                        <div class="col align-self-center" align="center">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                    <div class="row alert alert-info font-weight-bold font-20" role="alert">
                        <div class="col-6" align="right">NILAI PERTUBUHAN KARIAH:</div>
                        <div id="nilaiKariah" class="col-6" align="left"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>