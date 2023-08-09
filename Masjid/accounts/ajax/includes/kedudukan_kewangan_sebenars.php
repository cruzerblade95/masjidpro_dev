<?php
$qMin = "SELECT MIN(YEAR(dateRecords)) 'minTahun'
       FROM accountsRecords WHERE id_masjid = $id_masjid AND voidStatus != 1 AND typeModule = $training";
selValueSQL($qMin, 'minTahun');
if($row_minTahun['minTahun'] != NULL){
    $minTahun = $row_minTahun['minTahun'];
}else{
    $minTahun = 2023;
}

    if($_GET['trigger'] == 1){
        $trigger = "display: none";
    }else{
        $trigger = "";
    }

if($tahun != NULL && $tahun != -1) {
    if($tahun != NULL && $_GET['bulan1'] != NULL) {
        $bulanNum = $_GET['bulan1'];
        $bulanNum2 = $_GET['bulan2'];
        $hujungBulan = date_format(date_create("$tahun-$bulanNum-01"), "t");
        $hujungBulan2 = date_format(date_create("$tahun-$bulanNum2-01"), "t");
        $tarikh_awal = fungsi_tarikh("$tahun-$bulanNum-01 12:00:00", 7, 99);
        $tarikh_akhir = fungsi_tarikh("$tahun-$bulanNum-$hujungBulan 12:00:00", 7, 99);
        $setTarikh = "AND (a.dateRecords BETWEEN '$tahun-$bulanNum-01' AND '$tahun-$bulanNum2-$hujungBulan2')";
        $setTarikh3 = "AND (aa.dateRecords BETWEEN '$tahun-$bulanNum-01' AND '$tahun-$bulanNum2-$hujungBulan2')";
        $setTarikh2 = "AND ((a.dateRecords BETWEEN '$tahun-$bulanNum-01' AND '$tahun-$bulanNum2-$hujungBulan2') OR ($minTahun = $tahun AND MONTH(a.dateRecords) = $bulanNum AND a.typeRecords = 2))";
        // echo "$tahun-$bulanNum2-$hujungBulan2";
    }   
    else {
        $tarikh_awal = fungsi_tarikh("$tahun-01-01 12:00:00", 7, 99);
        $tarikh_akhir = fungsi_tarikh("$tahun-12-31 12:00:00", 7, 99);
        $setTarikh = "AND YEAR(a.dateRecords) = $tahun";
        $setTarikh3 = "AND YEAR(aa.dateRecords) = $tahun";
        $setTarikh2 = "AND (YEAR(a.dateRecords) < $tahun OR ($minTahun = $tahun AND a.typeRecords = 2))";
    }
}
else {
    $tarikh_awal = fungsi_tarikh(date('Y')."-01-01 12:00:00", 7, 99);
    $tarikh_akhir = fungsi_tarikh(date('Y')."-12-31 12:00:00", 7, 99);
}
$id_masjid = $_SESSION['id_masjid'];
if($_GET['tabungan'] == 1 || $_GET['tabungan'] == 2) $jenisAkaun = "(assetType IS NULL OR assetType = 7)";
// else if($_GET['tabungan'] == 2) $jenisAkaun = "assetType IS NULL";
else $jenisAkaun = "assetType IS NOT NULL";
if($_GET['tabungan'] == NULL){
    $filter_piutang = "AND assetType != 7";
}
$extraConcat = ", CONCAT(IF(assetType = 6, 'SI BERHUTANG - ', IF(assetType = 7, 'PUITANG - ', '')), categoryName) 'categoryName'";
$q = "SELECT * FROM accountsCategory WHERE id_masjid = $id_masjid AND $jenisAkaun AND typeModule = $training $filter_piutang";
// echo($q);
selValueSQL($q, 'listAkaun');


if($_GET['tabungan'] == 2) {
    $q = "SELECT * FROM accountsCategory WHERE id_masjid = $id_masjid AND assetType IN (1, 2) AND typeModule = $training";
    selValueSQL($q, 'listAkaun2');

    $q = "SELECT (SUM(IF((a.typeJournalEntry = 1 AND a.baki_permulaan = 1), a.amount, 0)) - SUM(IF((a.typeJournalEntry = 2 AND a.baki_permulaan = 1), a.amount, 0))) 'baki_awal', SUM(IF((a.typeJournalEntry = 1 AND a.baki_permulaan != 1), a.amount, 0)) 'masuk', SUM(IF((a.typeJournalEntry = 2 AND a.baki_permulaan != 1), a.amount, 0)) 'keluar'
       FROM accountsRecords a 
       LEFT JOIN accountsCategory b ON (a.pairAccountsCategory_id = b.id OR a.accountsCategory_id = b.id)
WHERE a.id_masjid = $id_masjid AND b.assetType IN (1, 2, 3, 4, 5, 6, 7) AND a.voidStatus != 1 AND a.typeModule = $training $setTarikh2";

    $q2 = "SELECT SUM(IF(a.typeJournalEntry = 1 AND a.typeRecords = 1, a.amount, 0)) 'pendapatan',
       SUM(IF(a.typeJournalEntry = 2 AND a.typeRecords = 1, a.amount, 0)) 'perbelanjaan'
       FROM accountsRecords a 
       LEFT JOIN accountsCategory b ON (a.pairAccountsCategory_id = b.id OR a.accountsCategory_id = b.id)
WHERE a.id_masjid = $id_masjid AND b.assetType IN (1, 2, 3, 4, 5, 6, 7) AND a.voidStatus != 1 AND a.typeModule = $training $setTarikh";
    if($_GET['testDebug'] == 1) echo($q);
    selValueSQL($q, 'bakiAwal');
    selValueSQL($q2, 'bakiAkhir');
    $baki_awal = $row_bakiAwal['baki_awal'];
    $pendapatan = $row_bakiAkhir['pendapatan'];
    $perbelanjaan = $row_bakiAkhir['perbelanjaan'];
    $baki_akhir = $baki_awal + $pendapatan - $perbelanjaan;
}
$baseJawatan = "SELECT IF(a.id_ajk IS NOT NULL, b.nama_penuh, c.nama_penuh) 'nama_penuh' FROM data_ajkmasjid a LEFT JOIN sej6x_data_peribadi b ON a.id_ajk = b.id_data LEFT JOIN sej6x_data_anakqariah c ON a.id_ajk2 = c.ID WHERE a.id_masjid = $id_masjid";
$q = "$baseJawatan AND a.jawatan = 'Bendahari' ORDER BY a.tarikh_lantikan DESC LIMIT 1";
$q2 = "$baseJawatan AND a.jawatan = 'Pemeriksa Kira-kira' ORDER BY a.tarikh_lantikan DESC LIMIT 2";
selValueSQL($q, 'bendahari');
selValueSQL($q2, 'pemeriksa');
?>
<div align="center"><h3><?php echo($_SESSION['nama_masjid']); ?></h3></div><br />
<div align="center" style="border: solid"><h3>
    <?php echo $tajukSubModul == "Kedudukan Kewangan" ? 'Kedudukan Aset Pertubuhan' : '';
    echo $tajukSubModul == "Kedudukan Setiap Tabungan" ? 'Kedudukan Tabungan Pertubuhan' : '';
    echo $tajukSubModul == "Laporan Kewangan" ? 'Laporan Kewangan' : '';
    echo $_GET['training'] == 1 ?  ' (Latihan)' : ' (Sebenar)'; ?>
</h3></div><br />
<?php if($_GET['tahun'] != NULL || $_GET['bulan'] != NULL) { if($_GET['tabungan'] == 2) { ?>
    <table data-hidden="1" width="100%" border="1" cellpadding="5" cellspacing="0" id="bah_a" style="<?php echo $trigger; ?>">
        <tr>
            <th style="width: 20px" class="isi-padat" rowspan="2"><h4 align="center">BIL</h4></th>
            <th style="width: 300px" class="isi-padat" rowspan="2"><h4 align="center">PERKARA</h4></th>
            <th class="isi-padat" colspan="3"><h4 align="center">(RM)</h4></th>
            <!-- <th class="isi-padat" rowspan="2"><h4 align="center">CATATAN</h4></th> -->
        </tr>
        <tr>
            <th style="width: 150px" class="isi-padat"><h5 align="center">BUKA AKAUN</h5></th>
            <th style="width: 150px" class="isi-padat"><h5 align="center">PENDAPATAN</h5></th>
            <th style="width: 150px" class="isi-padat"><h5 align="center">PERBELANJAAN</h5></th>
            <th style="width: 150px" class="isi-padat"><h5 align="center">BAKI</h5></th>
        </tr>
        <tr>
            <td align="center" class="isi-padat">1</td>
            <td align="left" class="isi-padat">BAKI PADA <?php echo strtoupper($tarikh_awal); ?></td>
            <td align="right" class="isi-padat"><label id="output_jum_buka_akaun"></label></td>
            <td align="right" class="isi-padat"></td>
            <td align="right" class="isi-padat"></td>
            <td align="right" class="isi-padat"><label id="output_jum_buka_akaun1"></label></td>
            <!-- <td align="right" class="isi-padat"></td> -->
        </tr>
        <tr>
            <td align="center" class="isi-padat">2</td>
            <td align="left" class="isi-padat">BAKI PADA <?php echo strtoupper($tarikh_akhir); ?></td>
            <td align="right" class="isi-padat"></td>
            <td align="right" class="isi-padat"><label id="output_jum_pendapatan"></label></td>
            <td align="right" class="isi-padat"><label id="output_jum_perbelanjaan"></label></td>
            <td align="right" class="isi-padat"><label id="output_jum_baki"></label></td>
            <!-- <td align="right" class="isi-padat"></td> -->
        </tr>
    </table>
    <br /><br />
<?php } ?>
    <?php if($_GET['tabungan'] == 2) { ?><h4 align="center" style="<?php echo $trigger; ?>">PERINCIAN PENDAPATAN DAN PERBELANJAAN <?php echo($tahun); ?></h4><br /><?php } ?>
    <table data-hidden="2" width="100%" border="1" cellpadding="5" cellspacing="0" id="bah_a" style="<?php echo $trigger; ?>">
        <tr>
            <th class="isi-padat" style="width: 20px" rowspan="2"><h4 align="center">BIL</h4></th>
            <th class="isi-padat" style="width: 300px" rowspan="2"><h4 align="center"><?php echo $_GET['tabungan'] == 2 ? 'TABUNGAN' : 'SUB-AKAUN'; ?></h4></th>
            <th class="isi-padat" colspan="<?php echo $_GET['tabungan'] != 2 ? '4' : '3'; ?>"><h4 align="center">(RM)</h4></th>
            <?php if($_GET['tabungan'] != 2) { ?><th class="isi-padat" rowspan="2"><h4 align="center">CATATAN</h4></th><?php } ?>
        </tr>
        <tr>
            <th style="width: 150px" class="isi-padat"><h4 align="center">BUKA AKAUN</h4></th>
            <th style="width: 150px" class="isi-padat"><h5 align="center">PENDAPATAN</h5></th>
            <th style="width: 150px" class="isi-padat"><h5 align="center">PERBELANJAAN</h5></th>
            <th style="width: 150px" class="isi-padat"><h5 align="center">BAKI</h5></th>
        </tr>
        <?php $i = 1; $jum_baki = 0; do {
            $id_akaun = $row_listAkaun['id'];
            // echo $id_akaun;
            
            $sub_select1 = "SELECT IFNULL(SUM(aa.amount), 0.00) FROM accountsRecords aa WHERE aa.kiraan IS NULL AND aa.id_masjid = $id_masjid AND aa.typeRecords != 2 AND aa.typeModule = $training AND aa.voidStatus != 1 AND (aa.accountsCategory_id = $id_akaun OR aa.pairAccountsCategory_id = $id_akaun) $setTarikh3 AND";
            $q3 = "SELECT IF((a.typeRecords = 2 AND baki_permulaan = 1), a.amount, '0.00') 'baki_permulaan',
           ($sub_select1 (
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 2 AND b.assetType = 7 AND aa.hasSiBerhutang = 2) OR
            (aa.pairAccountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 2 AND aa.susut_nilai = 0 AND aa.pelarasan = 0) OR 
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.susut_nilai = 0 AND aa.pelarasan = 0 AND aa.hasSiBerhutang = 0) OR 
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.susut_nilai = 0 AND aa.pelarasan = 0 AND aa.hasSiBerhutang = 1) OR 
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.susut_nilai = 1 AND aa.pelarasan = 0) OR 
            (aa.pairAccountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.pelarasan = 1 AND aa.susut_nilai = 0) OR 
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.pelarasan = 1 AND aa.susut_nilai = 0) OR 
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 1 AND aa.inBatch = 1) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 1 AND aa.inBatch = 0) 
            )) 'perbelanjaan',
           ($sub_select1 (
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND b.assetType = 7 AND aa.hasSiBerhutang = 2) OR
            (aa.pairAccountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.susut_nilai = 0 AND aa.pelarasan = 0) OR 
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 2 AND aa.susut_nilai = 0 AND aa.pelarasan = 0) OR 
            (aa.pairAccountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 2 AND aa.pelarasan = 1 AND aa.susut_nilai = 0) OR
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 2 AND aa.pelarasan = 1 AND aa.susut_nilai = 0) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 2 AND aa.inBatch = 1) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 2 AND aa.inBatch = 0) 
            )) 'pendapatan'
            FROM accountsRecords a 
            LEFT JOIN accountsCategory b ON ((a.pairAccountsCategory_id = b.id AND a.jenis_transaksi IS NULL) OR (a.accountsCategory_id = b.id AND a.pairAccountsCategory_id IS NULL) OR (a.jenis_transaksi IS NOT NULL AND a.accountsCategory_id = b.id))
            WHERE a.accountsCategory_id = $id_akaun AND a.id_masjid = $id_masjid AND a.typeModule = $training $setTarikh
            GROUP BY IF(a.pairAccountsCategory_id IS NOT NULL, a.pairAccountsCategory_id, a.accountsCategory_id)";
            // $q2 = "SELECT 
            // (SELECT aa.amount FROM accountsRecords aa WHERE aa.baki_permulaan = 1) 'baki_permulaan'
            // FROM accountsRecords a 
            // WHERE a.accountsCategory_id = $id_akaun AND a.id_masjid = $id_masjid AND a.typeModule = $training";
            if($_GET['testDebug'] == 1) echo($q3."<br/>");

            selValueSQL($q3, 'listRekod');
            $baki_permulaan = $row_listRekod['baki_permulaan'];
            $pendapatan = $row_listRekod['pendapatan'];
            $perbelanjaan = $row_listRekod['perbelanjaan'];
            $jum_baki_permulaan = $jum_baki_permulaan + $baki_permulaan;
            $jum_pendapatan = $jum_pendapatan + $pendapatan;
            $jum_perbelanjaan = $jum_perbelanjaan + $perbelanjaan;
            $baki = $baki_permulaan + $pendapatan - $perbelanjaan;
            $jum_baki = $jum_baki + $baki;
            $namaAkaun = $arrayAkaun[$row_listAkaun['assetType']]." - ".$row_listAkaun['categoryName'];
            $namaAkaun = str_replace($row_listAkaun['categoryName']." - ", "", $namaAkaun);
            if (!strpos($namaAkaun, " - ") !== false) $namaAkaun = str_replace(" - ", "", $namaAkaun);
            ?>
            <tr>
                <td align="center" class="isi-padat"><?php echo($i); ?></td>
                <td align="left" class="isi-padat"><?php echo($namaAkaun); ?></td>
                <td align="right" class="isi-padat"><?php echo number_format($baki_permulaan, 2); ?></td>
                <td align="right" class="isi-padat"><?php echo number_format($pendapatan, 2); ?></td>
                <td align="right" class="isi-padat"><?php echo number_format($perbelanjaan, 2); ?></td>
                <td align="right" class="isi-padat"><?php echo number_format($baki, 2); ?></td>
                <?php if($_GET['tabungan'] != 2) { ?><td align="right" class="isi-padat"></td><?php } ?>
            </tr>
            <?php $i++; } while($row_listAkaun = mysqli_fetch_assoc($fetch_listAkaun)); ?>
        <tr>
            <th align="center" class="isi-padat"></th>
            <th align="left" class="isi-padat"><h4>JUMLAH (RM)</h4></th>
            <th class="isi-padat"><h4 align="right"><?php echo number_format($jum_baki_permulaan, 2); ?></h4></th>
            <th class="isi-padat"><h4 align="right"><?php echo number_format($jum_pendapatan, 2); ?></h4></th>
            <th class="isi-padat"><h4 align="right"><?php echo number_format($jum_perbelanjaan, 2); ?></h4></th>
            <th class="isi-padat"><h4 align="right"><?php echo number_format($jum_baki, 2); ?></h4></th>
            <?php if($_GET['tabungan'] != 2) { ?><td align="right" class="isi-padat"></td><?php } ?>
        </tr>
    </table>
    <input id="jum_buka_akaun" type="hidden" value="<?php echo number_format($jum_baki_permulaan, 2); ?>">
    <input id="jum_pendapatan" type="hidden" value="<?php echo number_format($jum_pendapatan, 2); ?>">
    <input id="jum_perbelanjaan" type="hidden" value="<?php echo number_format($jum_perbelanjaan, 2); ?>">
    <input id="jum_baki" type="hidden" value="<?php echo number_format($jum_baki, 2); ?>">
    <?php if($_GET['tabungan'] == 2) { ?>
        <br /><br />
        <h4 align="center">TUNAI DALAM TANGAN DAN BANK</h4><br />
        <table data-hidden="3" width="100%" border="1" cellpadding="5" cellspacing="0" id="bah_a">
        <tr>
            <th class="isi-padat" style="width: 20px" rowspan="2"><h4 align="center">BIL</h4></th>
            <th class="isi-padat" style="width: 300px" rowspan="2"><h4 align="center"><?php echo $_GET['tabungan'] != 2 ? 'TABUNGAN' : 'SUB-AKAUN'; ?></h4></th>
            <th class="isi-padat" colspan="<?php echo $_GET['tabungan'] != 2 ? '4' : '3'; ?>"><h4 align="center">(RM)</h4></th>
            <?php if($_GET['tabungan'] != 2) { ?><th class="isi-padat" rowspan="2"><h4 align="center">CATATAN</h4></th><?php } ?>
        </tr>
        <tr>
            <?php if($_GET['tabungan'] == 2) { ?><th style="width: 150px" class="isi-padat"><h4 align="center">BUKA AKAUN</h4></th><?php } ?>
            <th style="width: 150px" class="isi-padat"><h5 align="center">PENDAPATAN</h5></th>
            <th style="width: 150px" class="isi-padat"><h5 align="center">PERBELANJAAN</h5></th>
            <th style="width: 150px" class="isi-padat"><h5 align="center">BAKI</h5></th>
        </tr>
        <?php
        $jenisAkaun = "assetType IS NOT NULL";
        $filter_piutang2 = "AND assetType != 7";
        $query = "SELECT * FROM accountsCategory WHERE id_masjid = $id_masjid AND $jenisAkaun AND typeModule = $training $filter_piutang2";
        selValueSQL($query, 'listAkaun');
         $i = 1; $jum_baki = 0; do {
            // $id_akaun = $row_listAkaun['id'];
            // echo $row_listAkaun['id'];
            $id_akaun = $row_listAkaun['id'];
            // exit;
            $sub_select4 = "SELECT IFNULL(SUM(aa.amount), 0.00) FROM accountsRecords aa WHERE aa.id_masjid = $id_masjid AND aa.typeRecords != 2 AND aa.typeModule = $training AND aa.voidStatus != 1 AND (aa.accountsCategory_id = $id_akaun OR aa.pairAccountsCategory_id = $id_akaun) $setTarikh3 AND";
            $q4 = "SELECT IF(a.typeRecords = 2, a.amount, '0.00') 'baki_permulaan',
           ($sub_select4 (
            (aa.pairAccountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 2 AND aa.susut_nilai = 0 AND aa.pelarasan = 0 AND aa.kiraan IS NULL) OR 
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.susut_nilai = 0 AND aa.pelarasan = 0 AND aa.kiraan IS NULL) OR 
            (aa.pairAccountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.susut_nilai = 1 AND aa.pelarasan = 0 AND aa.kiraan IS NULL) OR 
            (aa.pairAccountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.pelarasan = 1 AND aa.susut_nilai = 0 AND aa.kiraan IS NULL) OR 
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.pelarasan = 1 AND aa.susut_nilai = 0 AND aa.kiraan IS NULL) OR  
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 1 AND aa.inBatch = 1 AND aa.kiraan IS NULL AND b.assetType != 6) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 1 AND aa.inBatch = 0 AND aa.kiraan IS NULL AND b.assetType != 6) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 1 AND aa.inBatch = 1 AND aa.kiraan IS NULL AND b.assetType = 6 AND aa.hasSiBerhutang = 0) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 2 AND aa.inBatch = 1 AND aa.kiraan IS NULL AND b.assetType = 6 AND aa.hasSiBerhutang = 1) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 2 AND aa.inBatch = 0 AND aa.kiraan IS NULL AND b.assetType = 6 AND aa.hasSiBerhutang = 1)
            )) 'perbelanjaan',
           ($sub_select4 (
            (aa.pairAccountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 1 AND aa.susut_nilai = 0 AND aa.pelarasan = 0 AND aa.kiraan IS NULL) OR 
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 2 AND aa.susut_nilai = 0 AND aa.pelarasan = 0 AND aa.kiraan IS NULL)  OR
            (aa.pairAccountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 2 AND aa.pelarasan = 1 AND aa.susut_nilai = 0 AND aa.kiraan IS NULL) OR
            (aa.accountsCategory_id = $id_akaun AND aa.typeRecords = 3 AND aa.typeJournalEntry = 2 AND aa.pelarasan = 1 AND aa.susut_nilai = 0 AND aa.kiraan IS NULL) OR 
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 2 AND aa.inBatch = 1 AND aa.kiraan IS NULL AND b.assetType != 6) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 2 AND aa.inBatch = 0 AND aa.kiraan IS NULL AND b.assetType != 6) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 2 AND aa.inBatch = 1 AND aa.kiraan IS NULL AND b.assetType = 6 AND aa.hasSiBerhutang = 0) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 1 AND aa.inBatch = 1 AND aa.kiraan IS NULL AND b.assetType = 6 AND aa.hasSiBerhutang = 1) OR
            (aa.typeRecords = 1 AND aa.typeJournalEntry = 1 AND aa.inBatch = 0 AND aa.kiraan IS NULL AND b.assetType = 6 AND aa.hasSiBerhutang = 1)
            )) 'pendapatan',
           CONCAT(
        IF(a.receivedNo > 0, CONCAT(a.receivedNo, '-1'), ''),
        IF(a.payNo > 0, CONCAT(a.payNo, '-2'), ''),
        IF(a.groupTransactionID > 0, CONCAT(a.groupTransactionID, '-3'), '')
        ) 'pairId'
            FROM accountsRecords a LEFT JOIN accountsCategory b ON (a.pairAccountsCategory_id = b.id OR (a.accountsCategory_id = b.id AND a.pairAccountsCategory_id IS NULL))
            WHERE a.accountsCategory_id = $id_akaun AND a.id_masjid = $id_masjid AND a.typeModule = $training $setTarikh
            GROUP BY IF(a.pairAccountsCategory_id IS NOT NULL, a.pairAccountsCategory_id, a.accountsCategory_id)";
            // echo($q3);
            selValueSQL($q4, 'listRekod');
            $baki_permulaan1 = $row_listRekod['baki_permulaan'];
            $pendapatan1 = $row_listRekod['pendapatan'];
            $perbelanjaan1 = $row_listRekod['perbelanjaan'];
            $jum_baki_permulaan1 = $jum_baki_permulaan1 + $baki_permulaan1;
            $jum_pendapatan1 = $jum_pendapatan1 + $pendapatan1;
            $jum_perbelanjaan1 = $jum_perbelanjaan1 + $perbelanjaan1;
            if($_GET['tabungan'] == 2) $baki1 = $baki_permulaan1 + $pendapatan1 - $perbelanjaan1;
            else $baki1 = $pendapatan1 - $perbelanjaan1;
            $jum_baki1 = $jum_baki1 + $baki1;
            $namaAkaun = $arrayAkaun[$row_listAkaun['assetType']]." - ".$row_listAkaun['categoryName'];
            $namaAkaun = str_replace($row_listAkaun['categoryName']." - ", "", $namaAkaun);
            if (!strpos($namaAkaun, " - ") !== false) $namaAkaun = str_replace(" - ", "", $namaAkaun);
            ?>
            <tr>
                <td align="center" class="isi-padat"><?php echo($i); ?></td>
                <td align="left" class="isi-padat"><?php echo($namaAkaun); ?></td>
                <?php if($_GET['tabungan'] == 2) { ?><td align="right" class="isi-padat"><?php echo number_format($baki_permulaan1, 2); ?></td><?php } ?>
                <td align="right" class="isi-padat"><?php echo number_format($pendapatan1, 2); ?></td>
                <td align="right" class="isi-padat"><?php echo number_format($perbelanjaan1, 2); ?></td>
                <td align="right" class="isi-padat"><?php echo number_format($baki1, 2); ?></td>
                <?php if($_GET['tabungan'] != 2) { ?><td align="right" class="isi-padat"></td><?php } ?>
            </tr>
            <?php $i++; } while($row_listAkaun = mysqli_fetch_assoc($fetch_listAkaun)); ?>
        <tr>
            <th align="center" class="isi-padat"></th>
            <th align="left" class="isi-padat"><h4>JUMLAH (RM)</h4></th>
            <?php if($_GET['tabungan'] == 2) { ?><th class="isi-padat"><h4 align="right"><?php echo number_format($jum_baki_permulaan1, 2); ?></h4></th><?php } ?>
            <th class="isi-padat"><h4 align="right"><?php echo number_format($jum_pendapatan1, 2); ?></h4></th>
            <th class="isi-padat"><h4 align="right"><?php echo number_format($jum_perbelanjaan1, 2); ?></h4></th>
            <th class="isi-padat"><h4 align="right"><?php echo number_format($jum_baki1, 2); ?></h4></th>
            <?php if($_GET['tabungan'] != 2) { ?><td align="right" class="isi-padat"></td><?php } ?>
        </tr>
    </table>

        <footer></footer>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" style="<?php echo $trigger; ?>">
            <tbody>
            <tr>
                <td colspan="3" valign="top" class2="kotak1">
                    <p align="left">Sepanjang saya bertugas sebagai Bendahari bagi tempoh yang dinyatakan pada pembentangan penyata kewangan ini pada hemat saya adalah benar.</p>
                    <p>Bendahari:</p>
                    <p>&nbsp;</p>
                    <p style="margin-bottom: 0px">.......................................................</p>
                    (<?php echo strtoupper($row_bendahari['nama_penuh']); ?>)
                </td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">Laporan Pemeriksa Kira-kira<br /><br /></td>
            </tr>
            <tr>
                <?php $i = 1; do { ?>
                    <td width="40%" valign="top" class2="kotak1">
                        <p>Saya telah menyemak penyata kewangan ini dan mengesahkannya betul.</p>
                        <p>Pemeriksa Kira-kira <?php echo($i); ?></p>
                        <p>&nbsp;</p>
                        <p style="margin-bottom: 0px">.......................................................</p>
                        (<?php echo strtoupper($row_pemeriksa['nama_penuh']); ?>)
                    </td>
                    <?php if($i == 1) { ?><td width="20%" valign="top">&nbsp;</td><?php } ?>
                <?php $i++; } while($row_pemeriksa = mysqli_fetch_assoc($fetch_pemeriksa)); ?>
            </tr>
            </tbody>
        </table>
    <?php } } else { ?>
    <div align="center"><h4>Tiada Rekod Dijumpai, Sila pilih Tahun / Bulan untuk melihat Laporan</h4></div>
<?php } ?>
