
<?php
//echo($strPage[2].' : '.$strPage[3].' : '.$strPage[4]);

if($strPage[4] != NULL) {
    //$trainingBaucar = e($strPage[2], NULL, NULL);
    $id_masjid = e($strPage[3], NULL, NULL);
    $idBill = e($strPage[4], NULL, NULL);
    $idBill = explode("-", $idBill);
    $typeJournalEntry = $idBill[0];
    $baucarIDNo = $idBill[1];
    if($typeJournalEntry == 2) {
        $baucarID = "a.receivedNo = $baucarIDNo";
        $baucarIDs = "aa.receivedNo = $baucarIDNo";
    }
    if($typeJournalEntry == 1) {
        $baucarID = "a.payNo = $baucarIDNo";
        $baucarIDs = "aa.payNo = $baucarIDNo";
    }

    $q = "SELECT a.*, c.kod_masjid, c.nama_masjid, d.assetType, d.categoryName FROM accountsRecords a
    LEFT JOIN accountsCategory b ON a.pairAccountsCategory_id = b.id
    LEFT JOIN sej6x_data_masjid c ON a.id_masjid = c.id_masjid
    LEFT JOIN accountsCategory d ON a.accountsCategory_id = d.id
WHERE $baucarID AND a.id_masjid = $id_masjid AND a.typeModule = $training AND a.kiraan IS NULL";
    //echo($q);
    $q2 = "SELECT a.*, c.kod_masjid, c.logo, c.nama_masjid, c.alamat_masjid, c.negeri, c.daerah, c.no_tel,
        (SELECT bb.categoryName FROM accountsRecords aa LEFT JOIN accountsCategory bb ON a.accountsCategory_id = bb.id WHERE $baucarID AND a.id_masjid = $id_masjid AND a.typeModule = $training AND a.kiraan = 1 LIMIT 1) 'paparans',
       SUM(a.amount) 'Jumlah' FROM accountsRecords a LEFT JOIN accountsCategory b ON a.accountsCategory_id = b.id
    LEFT JOIN sej6x_data_masjid c ON a.id_masjid = c.id_masjid
WHERE $baucarID AND a.id_masjid = $id_masjid AND a.typeModule = $training AND a.kiraan = 1 GROUP BY a.typeJournalEntry";

    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $qq2 = mysqli_query($bd2, $q2) or die(mysqli_error($bd2));
    $q_row2 = mysqli_fetch_assoc($qq2);


    if($typeJournalEntry == 2) {
        $tajuk = 'RESIT';
        $status = 'Terima Daripada:';
        $status2 = 'Terima Ke:';
        $hideCol = 'display: none;';
    }
    if($typeJournalEntry == 1) {
        $tajuk = 'BAUCAR BAYARAN';
        $status = 'Bayar Kepada:';
        $status2 = 'Bayar Ke:';
        $hideCol = 'display: table-row;';
    }

}
else {
    $noRekod = 1;
    goto tiadaRekod;
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tbody>
    <tr>
        <th align="left"><div align="left">JANAAN SISTEM</div></th>
        <th align="right"><div align="right"><?php echo($q_row2['kod_masjid']); ?> / <?php fungsi_tarikh($q_row2['dateRecords'], 10, 2); ?> / <?php echo($baucarIDNo); ?></div></th>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <?php if($q_row2['logo'] != NULL) { ?>
        <td style="width: 25%; text-align: left"><img style="max-width: 100%" class="img-fluid" src="../../../Masjid/Uploads/<?php echo($q_row2['logo']); ?>" /></td>
        <?php } ?>
        <td <?php echo $q_row2['logo'] == NULL ? 'colspan="2"' : ''; ?>>
            <div align="center">
                <h3><?php echo($q_row2['nama_masjid']); ?></h3>
            </div>
            <div align="center">
                <?php echo($q_row2['alamat_masjid']); ?><br /><?php echo($q_row2['daerah']); ?><br /><?php echo($q_row2['negeri']); ?><?php echo $q_row2['no_tel'] != NULL ? '<br />No Telefon: '.$q_row2['no_tel'] : ''; ?>
            </div>
        </td>
    </tr>
    </tbody>
</table>
<br />
<div align="center" style="border: solid"><h3><?php echo($tajuk); ?></h3></div><br />
<table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tbody>
    <tr>
        <td align="left" valign="middle"><strong><?php echo($status); ?></strong><br /><br />
            <?php echo($q_row2['vendor']); ?>
        </td>
        <td align="right" valign="middle"><strong>Tarikh:</strong><br /><?php fungsi_tarikh($q_row2['dateRecords'], 2, 4); ?></td>
    </tr>
    </tbody>
</table>
<br />
<table id="bah_a" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <th align="left" class="isi-padat">Tujuan Bayaran</th>
        <td align="center" class="isi-padat">:</td>
        <td align="left" class="isi-padat"><?php echo($q_row2['particulars']); ?></td>
    </tr>
    <tr>
        <th align="left" class="isi-padat">Cara Bayaran</th>
        <td align="center" class="isi-padat">:</td>
        <td align="right" class="isi-padat">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tbody>
                <?php do { ?>
                <tr>
                    <th align="left" valign="middle" class="isi-padat"><?php echo $q_row['assetType'] == 2 ? $q_row['categoryName']." (Online Transfer)" : $q_row['categoryName']; ?></th>
                    <?php if($q_row['chequeNo'] != NULL && $q_row['assetType'] == 1) { ?>
                        <th align="left" valign="middle" class="isi-padat">No Cek: <?php echo($q_row['chequeNo']); ?></th>
                    <?php } ?>
                    <th align="right" valign="middle" class="isi-padat"><div align="right">RM <?php echo number_format($q_row['amount'], 2); ?></div></th>
                </tr>
                <?php } while($q_row = mysqli_fetch_assoc($qq)); ?>
                </tbody>
            </table>
        </td>
    </tr>
    <tr style="<?php echo $hideCol ?>">
        <th align="left" class="isi-padat"><?php echo $status2; ?></th>
        <td align="center" class="isi-padat">:</td>
        <td align="right" class="isi-padat">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tbody>
                <?php do { ?>
                <tr style="<?php echo $hideCol ?>">
                    <th align="left" valign="middle" class="isi-padat"><?php echo $q_row2['assetType'] == 2 ? $q_row2['paparans']." (Online Transfer)" : $q_row2['paparans']; ?></th>
                    <?php if($q_row2['chequeNo'] != NULL && $q_row2['assetType'] == 1) { ?>
                        <th align="left" valign="middle" class="isi-padat">No Cek: <?php echo($q_row2['chequeNo']); ?></th>
                    <?php } ?>
                    <th align="right" valign="middle" class="isi-padat"><div align="right">RM <?php echo number_format($q_row2['amount'], 2); ?></div></th>
                </tr>
                <?php } while($q_row = mysqli_fetch_assoc($qq)); ?>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <th align="left" class="isi-padat">&nbsp;</th>
        <td align="center" class="isi-padat">&nbsp;</td>
        <td align="left" class="isi-padat">&nbsp;</td>
    </tr>
    <tr>
        <th align="left" valign="middle" class="isi-padat"><h3><strong>Jumlah Bayaran</strong></h3></th>
        <td align="center" valign="middle" class="isi-padat"><h3><strong>:</strong></h3></td>
        <td valign="middle" align="right" class="isi-padat"><h3><strong>RM <?php echo number_format($q_row2['Jumlah'], 2); ?></strong></h3></td>
    </tr>
    <tr>
        <th align="left" class="isi-padat"><h3><strong>&nbsp;</strong></h3></th>
        <td align="center" class="isi-padat"><h3><strong>&nbsp;</strong></h3></td>
        <td valign="middle" align="left" class="isi-padat"><h4><strong>Ringgit Malaysia: <?php echo numberTowords($q_row2['Jumlah']); ?> Sahaja</strong></h4></td>
    </tr>
</table>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tbody>
    <tr>
        <td width="40%" align="center" valign="top" class="kotak1"><p>Diterima oleh:</p>
            <p>&nbsp;</p>
            <p>.......................................................</p>
            <p>&nbsp;</p></td>
        <?php if($q_row2['typeJournalEntry'] == 2) { ?>
            <td width="20%" valign="top">&nbsp;</td>
            <td width="40%" align="center" valign="top" class="kotak1"><p>Diluluskan oleh:</p>
                <p>&nbsp;</p>
                <p>........................................................</p></td>
        <?php } ?>
    </tr>
    </tbody>
</table>
<br /><br />
<div align="center">....................................................<i class="fa fa-scissors" aria-hidden="true"></i>................................................</div>
<?php if($q_row2['voidStatus'] == 1) { ?>
    <div id="voidOverlay" style="-moz-user-select: none; -webkit-user-select: none; user-select: none; font-size: 50pt; color: black; padding-top: 23%; height: 100%; width: 100%; position: fixed; z-index: 9999; top: 0; left: 0; background-color: white; opacity: 0.85; vertical-align: middle; text-align: center; font-weight: bold; display: inline-block">
        DIBATALKAN
    </div>
<?php }
tiadaRekod:
if($noRekod == 1) {
    ?>
    <div class="font-weight-bold alert alert-danger" role="alert" align="center">Tiada Rekod Dijumpai</div>
<?php } ?>
