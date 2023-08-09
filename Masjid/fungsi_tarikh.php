<?php
header("Access-Control-Allow-Origin: *");

$t = $_GET['t'];
$j1 = $_GET['j1'];
$j2 = $_GET['j2'];

class HijriDate{

    private $hijri;

    public function __construct( $time = false ){
        if(!$time) $time = time();
        $this->hijri = $this->GregorianToHijri($time);
    }

    public function get_date(){
        return $this->hijri[1] . ' ' . $this->get_month_name($this->hijri[0]) . ' ' . $this->hijri[2] . 'H';
    }

    public function get_day(){
        return $this->hijri[1];
    }

    public function get_month(){
        return $this->hijri[0];
    }

    public function get_year(){
        return $this->hijri[2];
    }

    public function get_month_name($i){
        static $month  = array(
            "Muharram", "Safar", "Rabiulawal", "Rabiulakhir",
            "Jamadilawal", "Jamadilakhir", "Rejab", "Syaaban",
            "Ramadhan", "Syawal", "Zulkaedah", "Zulhijjah"
        );
        return $month[$i-1];
    }

    private function GregorianToHijri($time = null){
        if ($time === null) $time = time();
        $m = date('m', $time);
        $d = date('d', $time);
        $y = date('Y', $time);

        return $this->JDToHijri(cal_to_jd(CAL_GREGORIAN, $m, $d, $y));
    }

    private function HijriToGregorian($m, $d, $y){
        return jd_to_cal(CAL_GREGORIAN, $this->HijriToJD($m, $d, $y));
    }

    # Julian Day Count To Hijri
    private function JDToHijri($jd){
        $jd = $jd - 1948440 + 10632;
        $n  = (int)(($jd - 1) / 10631);
        $jd = $jd - 10631 * $n + 354;
        $j  = ((int)((10985 - $jd) / 5316)) *
            ((int)(50 * $jd / 17719)) +
            ((int)($jd / 5670)) *
            ((int)(43 * $jd / 15238));
        $jd = $jd - ((int)((30 - $j) / 15)) *
            ((int)((17719 * $j) / 50)) -
            ((int)($j / 16)) *
            ((int)((15238 * $j) / 43)) + 29;
        $m  = (int)(24 * $jd / 709);
        $d  = $jd - (int)(709 * $m / 24);
        $y  = 30*$n + $j - 30;

        return array($m, $d, $y);
    }

    # Hijri To Julian Day Count
    private function HijriToJD($m, $d, $y){
        return (int)((11 * $y + 3) / 30) +
            354 * $y + 30 * $m -
            (int)(($m - 1) / 2) + $d + 1948440 - 385;
    }
}

function fungsi_tarikh($tarikh_semua, $jenis, $jenis2) {
    //date_default_timezone_set('Asia/Kuala_Lumpur');
    $tarikh_generate = date_create($tarikh_semua);
    if($jenis2 == 4 || $jenis2 == 5 || $jenis2 == 7 || $jenis2 == 99 || $jenis2 == 100) {
        $tarikh = date_format($tarikh_generate, "d-m-Y");
        $tbh = date_format($tarikh_generate, "Y-m-d");
        $h = date_format($tarikh_generate, "d");
        $b = date_format($tarikh_generate, "m");
        $t = date_format($tarikh_generate, "Y");
        $hijri = new HijriDate( strtotime($tbh) );
    }
    if ($jenis == 1) $tarikh_generate = date_format($tarikh_generate, "g:i:s A, l, j F, Y");
    if ($jenis == 2) $tarikh_generate = date_format($tarikh_generate, "l, j F, Y");
    if ($jenis == 3) $tarikh_generate = date_format($tarikh_generate, "Y");
    if ($jenis == 4) $tarikh_generate = date_format($tarikh_generate, "F, Y");
    if ($jenis == 5) $tarikh_generate = date_format($tarikh_generate, "g:i A");
    if ($jenis == 6) $tarikh_generate = date_format($tarikh_generate, "l");
    if ($jenis == 7) $tarikh_generate = date_format($tarikh_generate, "j F, Y");
    if ($jenis == 8) $tarikh_generate = date_format($tarikh_generate, "F");
    if ($jenis == 9) $tarikh_generate = date_format($tarikh_generate, "m");
    if ($jenis == 10) $tarikh_generate = date_format($tarikh_generate, "Y");
    if ($jenis == 11) $tarikh_generate = date_format($tarikh_generate, "j M, Y");

    if($jenis != 11) {
        $tarikh_generate = str_replace("January", "Januari", $tarikh_generate);
        $tarikh_generate = str_replace("February", "Februari", $tarikh_generate);
        $tarikh_generate = str_replace("March", "Mac", $tarikh_generate);
        $tarikh_generate = str_replace("May", "Mei", $tarikh_generate);
        $tarikh_generate = str_replace("June", "Jun", $tarikh_generate);
        $tarikh_generate = str_replace("July", "Julai", $tarikh_generate);
        $tarikh_generate = str_replace("August", "Ogos", $tarikh_generate);
        $tarikh_generate = str_replace("October", "Oktober", $tarikh_generate);
        $tarikh_generate = str_replace("December", "Disember", $tarikh_generate);
    }
    if($jenis == 11) {
        $tarikh_generate = str_replace("Mar", "Mac", $tarikh_generate);
        $tarikh_generate = str_replace("May", "Mei", $tarikh_generate);
        $tarikh_generate = str_replace("Aug", "Ogos", $tarikh_generate);
        $tarikh_generate = str_replace("Oct", "Okt", $tarikh_generate);
        $tarikh_generate = str_replace("Dec", "Dis", $tarikh_generate);
    }
    $tarikh_generate = str_replace("Sunday","Ahad", $tarikh_generate);
    $tarikh_generate = str_replace("Monday","Isnin", $tarikh_generate);
    $tarikh_generate = str_replace("Tuesday","Selasa", $tarikh_generate);
    $tarikh_generate = str_replace("Wednesday","Rabu", $tarikh_generate);
    $tarikh_generate = str_replace("Thursday","Khamis", $tarikh_generate);
    $tarikh_generate = str_replace("Friday","Jumaat", $tarikh_generate);
    $tarikh_generate = str_replace("Saturday","Sabtu", $tarikh_generate);

    if($jenis2 == 1) echo($tarikh_generate);
    if($jenis2 == 2) echo(strtoupper($tarikh_generate));
    if($jenis2 == 3) strtoupper($tarikh_generate);
    if($jenis2 == 4) echo($tarikh_generate.'<br />'.$hijri->get_date());
    if($jenis2 == 5) echo($hijri->get_date());
    if($jenis2 == 6) echo('Tahun Lahir:<br />'.$tarikh_generate);
    if($jenis2 == 7) echo($tarikh_generate.' / '.$hijri->get_date());
    if($jenis2 == 99) return $tarikh_generate;
    if($jenis2 == 100) {
        $tarikh_generate = $hijri->get_date();
        return $tarikh_generate;
    }
}
if(isset($_GET['t']) && isset($_GET['j1']) && isset($_GET['j2'])) {
    fungsi_tarikh($t, $j1, $j2);
}

?>