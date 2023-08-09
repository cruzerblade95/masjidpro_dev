<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header bg-info" align="center">
                <h5 class="m-b-0 text-white font-weight-bold"><?php echo($tajukSubModul); ?></h5>
            </div>
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-12 col-md-12" align="center">
                        <h4><?php echo strtoupper($_SESSION['nama_masjid']); ?></h4>
                        <h4>REKOD TRANSAKSI PENDAPATAN, PERBELANJAAN & PEMINDAHAN</h4>
                    </div>
                </div>
                <form id="formPilih" enctype="multipart/form-data" method="get">
                    <?php foreach ($_GET as $key => $val) {
                        if($key != "pilihRekod" && $key != "pilihSusun") { ?>
                            <input type="hidden" name="<?php echo($key); ?>" value="<?php echo($val); ?>">
                        <?php } } ?>
                    <div class="row form-group">
                        <div class="col-md-4 col-6 align-self-start">
                            <label for="pilihRekod">Pilih Rekod / Sub Akaun / Tabung:-</label>
                            <select onchange="$('#formPilih').submit()" id="pilihRekod" name="pilihRekod" class="form-control">
                                <option></option>
                                <option value="1" <?php echo $pilihRekod == NULL || $pilihRekod == 1 || $pilihRekod == 'SEMUA' ? 'selected' : NULL; ?>>Semua Rekod Kewangan</option>
                                <option value="3" <?php echo $pilihRekod == 3 ? 'selected' : NULL; ?>>Rekod Pindahan Sahaja</option>
                                <option value="2" <?php echo $pilihRekod == 2 ? 'selected' : NULL; ?>>Rekod Baki Permulaan Sahaja</option>
                                <?php $pilihRekod2 = "A$pilihRekod"; do { ?>
                                    <option value="A<?php echo($row_listAkaunTabung['id']); ?>" <?php echo $pilihRekod2 == "A".$row_listAkaunTabung['id'] ? 'selected' : NULL; ?>><?php echo($row_listAkaunTabung['categoryName']); ?></option>
                                <?php } while($row_listAkaunTabung = mysqli_fetch_assoc($fetch_listAkaunTabung)); ?>
                            </select>
                        </div>
                        <div class="d-none d-xs-none d-sm-none d-md-block col-md-4 col align-self-center"></div>
                        <div class="col-md-4 col-6 align-self-end" align="right">
                            <label for="pilihSusun">Ikut Susunan:-</label>
                            <select onchange="$('#formPilih').submit()" id="pilihSusun" name="pilihSusun" class="form-control">
                                <option></option>
                                <option value="1" <?php echo $pilihSusun == 1 ? 'selected' : NULL; ?>>Tarikh Terkini</option>
                                <option value="2" <?php echo $pilihSusun == 2 ? 'selected' : NULL; ?>>Tarikh Terawal</option>
                                <option style="display: none" value="3" <?php echo $pilihSusun == 3 ? 'selected' : NULL; ?>>Pendapatan & Perbelanjaan</option>
                                <option style="display: none" value="4" <?php echo $pilihSusun == 4 ? 'selected' : NULL; ?>>Pendapatan</option>
                                <option style="display: none" value="5" <?php echo $pilihSusun == 5 ? 'selected' : NULL; ?>>Perbelanjaan</option>
                                <option value="6" <?php echo $pilihSusun == 6 ? 'selected' : NULL; ?>>Pembatalan</option>
                            </select>
                        </div>
                    </div>
                </form>
                <?php
                    // echo $pilihRekod;
                    // exit;
                ?>
                <div class="row">
                    <div class="table-responsive">
                        <?php if($num_listRekod > 0) { ?>
                            <div class="alert alert-success font-weight-bold" role="alert" align="center">Sebanyak <?php echo($num_listRekod); ?> Rekod Dijumpai</div>
                            <table style="width: 100%; color: black" id="meja_akaun_baru" data-order="[]" class="table table-bordered table-hover display margin-top-10 w-p100 table-striped">
                                <thead>
                                <tr>
                                    <?php foreach ($field_listRekod as $field) {
                                        $exceptColumn = array("voidStatus", "typeRecords", "typeJournalEntry", "Nama", "Butiran", "susut_nilai", "categoryType", "assetType", "accountsCategory_id", "pairAccountsCategory_id", "jenis_transaksi", "payNo", "receivedNo");
                                        if($pilihSusun == 5) array_push($exceptColumn, "Pendapatan<br />(RM)");
                                        if($pilihSusun == 4) array_push($exceptColumn, "Perbelanjaan<br />(RM)");
                                        ?>
                                        <?php if(!in_array($field->name, $exceptColumn)) { ?>
                                            <?php if($field->name == "Akaun") { ?><th style="width: available; vertical-align: middle" valign="middle"><div align="center">Akaun, Nama & Butiran</div></th><?php } else { ?>
                                                <th style="vertical-align: middle" valign="middle"><div align="center"><?php echo($field->name); ?></div></th><?php } ?>
                                        <?php } ?>
                                    <?php } if($pilihRekod != 1 && $pilihSusun != 6 && $pilihRekod != 'SEMUA') { ?>
                                    <th style="vertical-align: middle" valign="middle"><div align="center">Baki<br />(RM)</div></th>
                                    <?php } ?>
                                    <th style="vertical-align: middle" valign="middle"><div align="center">Tindakan</div></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; $baki[0] = 0.00; do {
                                    $assetType = $row_listRekod['assetType'];
                                    $typeJournalEntry = $row_listRekod['typeJournalEntry'];
                                    $categoryType = $row_listRekod['categoryType'];
                                    $typeRecords = $row_listRekod['typeRecords'];
                                    $susut_nilai = $row_listRekod['susut_nilai'];
                                    $accountsCategory_id = $row_listRekod['accountsCategory_id'];
                                    $pairAccountsCategory_id = $row_listRekod['pairAccountsCategory_id'];
                                    $jenis_transaksi = $row_listRekod['jenis_transaksi'];
                                    $payNo = $row_listRekod['payNo'];
                                    $receivedNo = $row_listRekod['receivedNo'];

                                    //$pendapatan = ($typeJournalEntry == 1 && $typeRecords == 1) || ($typeJournalEntry == 2 && $typeRecords == 2) ? number_format($row_listRekod['Pendapatan<br />(RM)'], 2) : '';
                                    //$perbelanjaan = ($typeJournalEntry == 2 && $typeRecords == 1) || ($typeJournalEntry == 1 && $typeRecords == 2) ? number_format($row_listRekod['Perbelanjaan<br />(RM)'], 2) : '';
                                    if($typeRecords == 3 && $susut_nilai == 1 && $assetType == NULL && $pilihRekod == "SEMUA"){
                                        $pendapatan = number_format($row_listRekod['Perbelanjaan<br />(RM)'], 2);
                                        $perbelanjaan = number_format($row_listRekod['Pendapatan<br />(RM)'], 2)."A";
                                    }else if($typeJournalEntry == 1 && $typeRecords == 3 && $susut_nilai == NULL && $assetType == 3 && $pilihRekod == "SEMUA"){
                                        $pendapatan = number_format($row_listRekod['Pendapatan<br />(RM)'], 2);
                                        $perbelanjaan = number_format($row_listRekod['Perbelanjaan<br />(RM)'], 2)."B";
                                    }
                                    else if(($typeRecords == 3 && $assetType == 3 && strpos($pilihRekod, "A"))){
                                        $pendapatan = number_format($row_listRekod['Perbelanjaan<br />(RM)'], 2);
                                        $perbelanjaan = number_format($row_listRekod['Pendapatan<br />(RM)'], 2)."C";
                                    }
                                    // else if($typeJournalEntry == 1 && $typeRecords == 1 && ($accountsCategory_id == 32 || $accountsCategory_id == 59) && $assetType == NULL && strpos($_GET['pilihRekod'], "A") == 0){
                                    //     $pendapatan = number_format($row_listRekod['Perbelanjaan<br />(RM)'], 2)";
                                    //     $perbelanjaan = number_format($row_listRekod['Pendapatan<br />(RM)'], 2);
                                    // }
                                    else if($receivedNo != NULL && strpos($_GET['pilihRekod'], "A") == 0){
                                        $pendapatan = number_format($row_listRekod['Pendapatan<br />(RM)'], 2);
                                        $perbelanjaan = number_format($row_listRekod['Perbelanjaan<br />(RM)'], 2)."D";
                                    }
                                    else{
                                        $pendapatan = number_format($row_listRekod['Pendapatan<br />(RM)'], 2)." TJE>".$typeJournalEntry." TR>".$typeRecords." AT>".$assetType." PR>".$_GET['pilihRekod']." SN>".$susut_nilai." ACI>".$accountsCategory_id." PACI>".$pairAccountsCategory_id;
                                        $perbelanjaan = number_format($row_listRekod['Perbelanjaan<br />(RM)'], 2)."E";
                                    }

                                    // "." TJE>".$typeJournalEntry." TR>".$typeRecords." AT>".$assetType." PR>".$_GET['pilihRekod']." SN>".$susut_nilai." ACI>".$accountsCategory_id." PACI>".$pairAccountsCategory_id"

                                    $voidStatus = $row_listRekod['voidStatus'];
                                    if($voidStatus != 1) $baki[$i] = $baki[$i-1] + $row_listRekod['Pendapatan<br />(RM)'] - $row_listRekod['Perbelanjaan<br />(RM)'];
                                    else $baki[$i] = $baki[$i-1];
                                    if($_GET['testDebug'] == 1) echo($qBase.' - '.$typeRecords.' - '.$categoryType.'<br />');
                                    ?>
                                    <tr <?php echo $voidStatus == 1 ? 'style="text-decoration: line-through"' : NULL; ?>>
                                        <td style="width: fit-content; vertical-align: middle"><div align="center"><?php echo($i); ?></div></td>
                                        <td style="width: fit-content; vertical-align: middle"><div align="left"><?php echo fungsi_tarikh($row_listRekod['Tarikh'], 11, 1); ?></div></td>
                                        <td style="width: auto; vertical-align: middle"><div align="left"><?php echo ($row_listRekod['Akaun']); ?>
                                                <?php echo $row_listRekod['Nama'] != NULL && $row_listRekod['Nama'] != "" ? '<br />'.$row_listRekod['Nama'] : ''; ?>
                                                <?php echo $row_listRekod['Butiran'] != NULL && $row_listRekod['Butiran'] != "" ? '<br />'.$row_listRekod['Butiran'] : ''; ?></div></td>
                                        <?php if($pilihSusun == 4 || $pilihSusun != 5) { ?><td style="width: 100px; vertical-align: middle"><div align="right"><?php echo ($pendapatan); ?></div></td><?php } ?>
                                        <?php if($pilihSusun == 5 || $pilihSusun != 4) { ?><td style="width: 100px; vertical-align: middle"><div align="right"><?php echo ($perbelanjaan); ?></div></td><?php } ?>
                                        <?php if($pilihRekod != 1 && $pilihSusun != 6 && $pilihRekod != 'SEMUA') { ?><td style="width: 100px; vertical-align: middle"><div align="right"><?php echo number_format($baki[$i], 2); ?></div></td><?php } ?>
                                        <td style="vertical-align: middle; width: fit-content">
                                            <div align="center">
                                                <?php if($row_listRekod['typeRecords'] == 1 || $row_listRekod['typeRecords'] == 3) { ?>
                                                    <?php if($row_listRekod['typeRecords'] == 1) { ?><a target="_blank" href="https://masjidpro.com/baucar/<?php echo $training == 2 ? '1' : '0'; ?>/<?php echo($_SESSION['id_masjid']); ?>/<?php echo($row_listRekod['Bil']); ?>"><button type="button" class="btn btn-info fas fa-info"></button></a><?php } ?>
                                                    <?php if($voidStatus != 1) { ?>&nbsp;<button type="button" class="btn btn-danger fas fa-trash-alt" onClick="modal_delete_akaun('<?php echo $training == 1 ? 'Batalkan' : 'Padam'; ?> Rekod Pendapatan / Perbelanjaan', 'Akaun: <?php echo ($row_listRekod['Akaun']); ?><br />Nama: <?php echo ($row_listRekod['Nama']); ?><br />Butiran: <?php echo ($row_listRekod['Butiran']); ?><br /><?php echo $pendapatan != NULL ? 'Pendapatan (RM): '.$pendapatan : 'Perbelanjaan (RM): '.$perbelanjaan; ?>', '&subModul=3&markVoid=1&id=<?php echo ($row_listRekod['Bil']); ?>')"></button><?php } ?>
                                                <?php } else { ?>
                                                    <a href="utama.php?view=admin&action=kewangan&newModul=1&subModul=7<?php echo $training == 2 ? '&training=1' : NULL; ?>"><button type="button" class="btn btn-info fas fa-info"></button></a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; } while($row_listRekod = mysqli_fetch_assoc($fetch_listRekod)); ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="alert alert-danger font-weight-bold" role="alert" align="center">Tiada Rekod Dijumpai</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>