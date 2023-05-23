<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(isset($_GET['tahun'])) { ?>
    <label>Minggu:</label>
    <select id="<?php echo htmlspecialchars($_GET['sel']); ?>" name="<?php echo htmlspecialchars($_GET['sel']); ?>" class="form-control">
        <option></option>
        <?php
        $dt = new DateTime;
        for($m = 0; $m < 52; $m++) {
            $m2 = $m + 1;
            $dt->setISODate($_GET['tahun'], $m, 1);
            $year = $dt->format('o');
            $week = $dt->format('W');
            do {
                $minggu_mula = $dt->format('d M Y');
                $minggu_mula2 = $dt->format('Y-m-d');
                $dt->modify('+6 day');
                $minggu_tamat = $dt->format('d M Y');
                $minggu_tamat2 = $dt->format('Y-m-d');
            } while ($week == $dt->format('W'));
            ?>
            <option value="<?php echo $m2.'|'.$minggu_mula2.'|'.$minggu_tamat2; ?>"><?php echo 'M'.$m2.': '.$minggu_mula.' - '.$minggu_tamat; ?></option>
        <?php } ?>
    </select>
<?php } if($_GET['test'] == 1) echo $week; ?>

