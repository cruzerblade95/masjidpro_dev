<?php

include("connection/connection.php");

if(isset($_POST['search']) OR (isset($_GET['month']) AND isset($_GET['tahun'])))
{
    if(isset($_POST['search']))
    {
        $bulan = $_POST['month'];
        $year = $_POST['tahun'];
        $id_masjid = $_POST['id_masjid'];
    }
    else if(isset($_GET['month']) AND isset($_GET['tahun']))
    {
        $id_masjid = $_GET['id_masjid'];
        $bulan = $_GET['month'];
        $year = $_GET['tahun'];
    }

    $date=$year."-".$bulan;
    $month=date_format((date_create($date)),"F");
    $total_days=date_format((date_create($date)),"t");
}
?>
<script>
    /*jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    }); */
</script>
<style>
    table.calendar {
        table-layout: fixed;
    }
    td {
        padding: 0.5rem;
        border: 1px solid #dedede;
    }
    .button4 {
        background-color: white;
        color: black;
        border: 2px solid #e7e7e7;
    }

    .button4:hover {
        background-color: #e7e7e7;
    }
</style>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Menu Aktiviti</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Menu Aktiviti</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Aktiviti&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Aktiviti</button>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="senarai_aktiviti" name="senarai_aktiviti" method="POST" action="">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select class="form-control" name="month" id="month">
                                            <option value="" selected="selected">Sila Pilih Bulan</option>
                                            <option value="01" <?php if ($bulan=="01"){ echo "selected='SELECTED'";}?>>Januari</option>
                                            <option value="02" <?php if ($bulan=="02"){ echo "selected='SELECTED'";}?>>Februari</option>
                                            <option value="03" <?php if ($bulan=="03"){ echo "selected='SELECTED'";}?>>Mac</option>
                                            <option value="04" <?php if ($bulan=="04"){ echo "selected='SELECTED'";}?>>April</option>
                                            <option value="05" <?php if ($bulan=="05"){ echo "selected='SELECTED'";}?>>Mei</option>
                                            <option value="06" <?php if ($bulan=="06"){ echo "selected='SELECTED'";}?>>Jun</option>
                                            <option value="07" <?php if ($bulan=="07"){ echo "selected='SELECTED'";}?>>Julai</option>
                                            <option value="08" <?php if ($bulan=="08"){ echo "selected='SELECTED'";}?>>Ogos</option>
                                            <option value="09" <?php if ($bulan=="09"){ echo "selected='SELECTED'";}?>>September</option>
                                            <option value="10" <?php if($bulan=="10"){ echo "selected='SELECTED'";}?>>Oktober</option>
                                            <option value="11" <?php if($bulan=="11"){ echo "selected='SELECTED'";}?>>November</option>
                                            <option value="12" <?php if($bulan=="12"){ echo "selected='SELECTED'";}?>>Disember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select class="form-control" name="tahun" id="tahun" required>
                                            <?php
                                            if($_POST['tahun']) {
                                                $tahun = $_POST['tahun'];
                                            }
                                            else if($_GET['tahun']){
                                                $tahun = $_GET['tahun'];
                                            }
                                            $start_year = 2018;
                                            $end_year = date('Y');
                                            for($i=$end_year;$i>=$start_year;$i--)
                                            {
                                                ?>
                                                <option value="<?php echo $i; ?>" <?php if($tahun==$i) { echo "selected='SELECTED'"; } ?>><?php echo $i;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <br>
                                        <input type="submit" name="search" value="Carian" class="btn btn-primary">
                                    </div>
                                    <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                    <input type="hidden" name="carisearch" value="1" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">BORANG TAMBAH AKTIVITI</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" id="insert_form" action="admin/add_aktiviti.php" enctype="multipart/form-data">
                                    <center>
                                        <div class="row">
                                            <div class="col-lg-3">

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <b>Jenis Aktiviti</b>
                                                    <select class="form-control" name="jenis_aktiviti" id="jenis_aktiviti" required onChange="displayPenceramah(this.value)">
                                                        <option value="">Sila Pilih:-</option>
                                                        <option value="Kuliah">Kuliah/Pengajian</option>
                                                        <option value="Program">Program</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="div_ceramah" style="display:none">
                                                    <b>Nama Penceramah</b>
                                                    <input class="form-control" name="nama_penceramah" id="nama_penceramah" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <!-- <label style="color: red">*</label> -->
                                                    <b>Nama Aktiviti</b>
                                                    <input class="form-control" name="nama_aktiviti" id="nama_aktiviti" required>
                                                </div>
                                                <div class="form-group">
                                                    <b>Tarikh Aktiviti</b>&nbsp;
                                                    <input class="form-control" type="date" name="tarikh" id="tarikh" required>
                                                </div>
                                                <div class="form-group">
                                                    <b>Masa Aktiviti</b>&nbsp;
                                                    <input class="form-control" type="time" name="masa" id="masa">
                                                </div>
                                                <div class="form-group">
                                                    <b>Lokasi</b>
                                                    <input class="form-control" type="text" name="lokasi" id="lokasi">
                                                </div>
                                                <div class="form-group">
                                                    <b>Lampirkan Fail</b>
                                                    <input type="file" class="form-control" name="fail[]" multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row (nested) -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="hidden" name="month" id="month" value="<?php echo $bulan;?>">
                                                <input type="hidden" name="tahun" id="tahun" value="<?php echo $year;?>">
                                                <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                                <input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-success" />
                                            </div>
                                        </div>
                                        <br>
                                    </center>
                                </form>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.modal-body -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- modal-dialog modal-lg -->
        </div>
        <!-- modal fade -->

        <?php
        $sql = "SELECT * FROM sej6x_data_aktiviti WHERE id_masjid='$id_masjid'";
        $sqlquery = mysqli_query($bd2,$sql);
        while($data = mysqli_fetch_array($sqlquery))
        {
            $id_aktiviti=$data['id_aktiviti'];
        ?>
        <div class="modal fade" id="editModal<?php echo $id_aktiviti; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editModalLabel">BORANG KEMASKINI AKTIVITI</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" id="insert_form" action="admin/update_aktiviti.php" enctype="multipart/form-data">
                                    <center>
                                        <?php
                                        $jenis_aktiviti=$data['jenis_aktiviti'];
                                        ?>
                                        <div class="row" >
                                            <div class="col-lg-3" >

                                            </div >
                                            <div class="col-lg-6" >
                                                <div class="form-group" >
                                                    <b > Jenis Aktiviti </b >
                                                    <select class="form-control" name = "jenis_aktiviti" id = "jenis_aktiviti" required onChange="displayPenceramah<?php echo $id_aktiviti; ?>(this.value)">
                                                        <option value = "" > Sila Pilih:-</option >
                                                        <option value = "Kuliah" <?php if($jenis_aktiviti=="Kuliah") { echo "selected"; } ?>>Kuliah / Pengajian</option >
                                                        <option value = "Program" <?php if($jenis_aktiviti=="Program") { echo "selected"; } ?>> Program</option >
                                                    </select >
                                                </div >
                                                <div class="form-group" id="div_ceramah<?php echo $id_aktiviti; ?>" <?php if($jenis_aktiviti!="Kuliah") { ?>style="display:none"<?php } ?>>
                                                    <b>Nama Penceramah</b>
                                                    <input type="text" name="nama_penceramah" id="nama_penceramah" class="form-control" value="<?php echo $data['nama_penceramah']; ?>">
                                                </div>
                                                <div class="form-group" >
                                                    <b > Nama Aktiviti </b >
                                                    <input class="form-control" name = "nama_aktiviti" id = "nama_aktiviti" required value="<?php echo $data['nama_aktiviti']; ?>">
                                                </div >
                                                <div class="form-group" >
                                                    <b > Tarikh Aktiviti </b >&nbsp;
                                                    <input class="form-control" type = "date" name = "tarikh" id = "tarikh" required value="<?php echo $data['tarikh']; ?>">
                                                </div >
                                                <div class="form-group" >
                                                    <b > Masa Aktiviti </b >&nbsp;
                                                    <input class="form-control" type = "time" name = "masa" id = "masa" value="<?php echo $data['masa']; ?>">
                                                </div >
                                                <div class="form-group" >
                                                    <b > Lokasi</b >
                                                    <input class="form-control" type = "text" name = "lokasi" id = "lokasi" value="<?php echo $data['lokasi']; ?>">
                                                </div >
                                                <div class="form-group">
                                                    <b>Senarai Fail</b>
                                                    <div id="live_data<?php echo $id_aktiviti; ?>"></div>
                                                    <!-- <button type="button" class="btn btn-sm btn-warning" name="delete_fail" id="delete_fail">Padam Gambar</button> -->
                                                </div>
                                                <div class="form-group">
                                                    <b>Lampir Fail Baru</b>
                                                    <input type="file" name="failBaru[]" class="form-control" multiple>
                                                </div>
                                            </div >
                                        </div >
                                        <div class="row" >
                                            <div class="col-lg-12" >
                                                <input type = "submit" name = "insert" id = "insert" value = "Kemaskini" class="btn btn-success" />
                                                <input type="hidden" name= "id_aktiviti" value="<?php echo $data['id_aktiviti']; ?>"/>
                                            </div >
                                        </div >
                                        <br >

                                    </center>
                                    <input type = "hidden" name = "month" id = "month" value = "<?php echo $bulan;?>" >
                                    <input type = "hidden" name = "tahun" id = "tahun" value = "<?php echo $year;?>" >
                                    <input type = "hidden" name = "id_masjid" value = "<?php echo $id_masjid; ?>" >
                                </form>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.modal-body -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- modal-dialog modal-lg -->
        </div>
        <!-- modal fade -->
        <?php
        }
        ?>
    </div>
    <!-- /.row -->
</div>
<?php
$sql = "SELECT * FROM sej6x_data_aktiviti WHERE id_masjid='$id_masjid'";
$sqlquery = mysqli_query($bd2,$sql);
while($data = mysqli_fetch_array($sqlquery))
{
$id_aktiviti=$data['id_aktiviti'];
?>
<script>
    function displayPenceramah<?php echo $id_aktiviti; ?>(str){
        var jenis_aktiviti = str;

        if(jenis_aktiviti=="Kuliah"){
            document.getElementById('div_ceramah<?php echo $id_aktiviti; ?>').style.display = 'block';
        }
        else{
            document.getElementById('div_ceramah<?php echo $id_aktiviti; ?>').style.display = 'none';
        }
    }
</script>
<?php
}
?>
<script>

    function displayPenceramah(str){
        var jenis_aktiviti = str;

        if(jenis_aktiviti=="Kuliah"){
            document.getElementById('div_ceramah').style.display = 'block';
            document.getElementById('nama_penceramah').required = true;
        }
        else{
            document.getElementById('div_ceramah').style.display = 'none';
            document.getElementById('nama_penceramah').required = false;
        }
    }
</script>
<?php

for($i=1;$i<=$total_days;$i++)
{
    ?>
    <div class="modal fade" id="date<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollmodalLabel"><?php echo $i." ".$month." ".$year; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                if($i<10)
                {
                    $day="0".$i;
                }
                else
                {
                    $day = $i;
                }
                $m=date_format((date_create($date)),"m");
                $t=$year."-".$m."-".$day;

                $kuiri="SELECT * FROM sej6x_data_aktiviti WHERE id_masjid='$id_masjid' AND tarikh='$t'";
                $kuirirun=mysqli_query($bd2,$kuiri);

                ?>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th><div align="center">#</div></th>
                            <th><div align="center">Jenis Aktiviti</div></th>
                            <th><div align="center">Nama Aktiviti</div></th>
                            <th><div align="center">Tarikh</div></th>
                            <th><div align="center">Masa</div></th>
                            <th><div align="center">Lokasi</div></th>
                            <th><div align="center">Fail/Gambar</div></th>
                        </tr>
                        <?php
                        $j=1;

                        while($run=mysqli_fetch_array($kuirirun))
                        {
                        ?>
                        <tr>
                            <td align="center"><?php echo $j; ?></td>
                            <td align="center"><?php echo $run['jenis_aktiviti']; ?></td>
                            <td align="center"><?php echo $run['nama_aktiviti']; ?><?php if($run['jenis_aktiviti']=="Kuliah" AND ($run['nama_penceramah']!="" AND $run['nama_penceramah']!=NULL)) { ?><br><h5><span class="label label-info"><?php echo $run['nama_penceramah']; ?></span></h5><?php } ?></td>
                            <td align="center"><?php echo $run['tarikh']; ?></td>
                            <td align="center"><?php echo $run['masa']; ?></td>
                            <td align="center"><?php echo $run['lokasi']; ?></td>
                            <td align="center">
                                <?php
                                $id_aktiviti = $run['id_aktiviti'];
                                $sql = "SELECT * FROM sej6x_data_aktivitifail WHERE id_aktiviti='$id_aktiviti'";
                                $sqlquery = mysqli_query($bd2,$sql);
                                $row = mysqli_num_rows($sqlquery);
                                if($row>0)
                                {
                                    ?>
                                    <a href="admin/view_aktiviti.php?id_aktiviti=<?php echo $id_aktiviti; ?>" target="_blank">[ Lihat ]</a>
                                    <?php
                                }
                                else if($row==0)
                                {
                                    ?>
                                    *Tiada Fail/Gambar*
                                    <?php
                                }
                                ?>
                            </td>
                            <?php
                            $j++;
                            }
                            ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php

if (isset($_POST['search']) or (isset($_GET['month']) and isset($_GET['tahun']))) {

    if(isset($_POST['search'])){
        $bulan = $_POST['month'];
        $year = $_POST['tahun'];
        $id_masjid = $_POST['id_masjid'];
    }
    else if(isset($_GET['month']) and isset($_GET['tahun']))
    {
        $bulan = $_GET['month'];
        $year = $_GET['tahun'];
        $id_masjid = $_GET['id_masjid'];
    }




    $date = $year . "-" . $bulan;
    $month = date_format((date_create($date)), "F");
    $strdate = strtoupper($strdate = date_format((date_create($date)), "F Y"));

    /* draws a calendar */
    function draw_calendar($bulan, $year)
    {

        include('connection/connection.php');

        if(isset($_POST['search']))
        {
            $id_masjid = $_POST['id_masjid'];
        }
        else if(isset($_GET['month']) and isset($_GET['tahun']))
        {
            $id_masjid = $_GET['id_masjid'];
        }

        /* draw table */
        $calendar = '<table width="100%" cellpadding="0" cellspacing="0" class="calendar">';

        /* table headings */
        $headings = array('Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu');
        //$calendar.= '<tr class="calendar-row"><td align="middle" colspan="2" class="calendar-day-head" width="14%">'.implode('</td><td align="middle" colspan="2" class="calendar-day-head" width="14%">',$headings).'</td></tr>';
        $calendar .= '<tr class="calendar-row"><td align="middle" class="calendar-day-head" width="14%"><b>' . implode('</b></td><td align="middle" class="calendar-day-head" width="14%"><b>', $headings) . '</b></td></tr>';

        /* days and weeks vars now ... */
        $running_day = date('w', mktime(0, 0, 0, $bulan, 1, $year));
        $days_in_month = date('t', mktime(0, 0, 0, $bulan, 1, $year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();

        /* row for week one */
        $calendar .= '<tr class="calendar-row">';

        /* print "blank" days until the first of the current week */
        for ($x = 0; $x < $running_day; $x++):
            //$calendar.= '<td colspan="2" class="calendar-day-np"> </td>';
            $calendar .= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        endfor;

        /* keep going with days.... */
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):

            /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/

            $calendar .= '<td width="15%" class="calendar-day">';

            $tarikh = $year . "-" . $bulan . "-" . $list_day;
            $hari = date_format(date_create($tarikh), "l");

            $num_day = date_format(date_create($tarikh), "d");
            $new_tarikh = $year . "-" . $bulan . "-" . $num_day;

            $sql16 = "SELECT * FROM sej6x_data_aktiviti WHERE id_masjid='" . $id_masjid . "' AND tarikh='" . $new_tarikh . "'";
            $sqlquery16 = mysqli_query($bd2,$sql16);
            $row16 = mysqli_num_rows($sqlquery16);

            if ($row16 > 0) {
                $calendar .= '<div class="day-number"><button class="btn-info form-control" id="myBtn' . $list_day . '" data-toggle="modal" data-target="#date' . $list_day . '" value="' . $list_day . '">' . $list_day . '</button></div>';
            } else {
                $calendar .= '<div class="day-number"><button disabled class="button button4 form-control" id="myBtn' . $list_day . '" value="' . $list_day . '">' . $list_day . '</button></div>';
            }

            $calendar .= '</td>';

            //$calendar.= '<td width="7.15%" class="calendar-day">';

            /* add in the day number */
            //$calendar.= '<div class="day-number">'.$list_day.'</div>';

            //$calendar.= '</td>';

            //$calendar.= '<td width="7.15%" class="calendar-day">';

            //$calendar.= '</td>';

            if ($running_day == 6):
                $calendar .= '</tr>';
                if (($day_counter + 1) != $days_in_month):
                    $calendar .= '<tr class="calendar-row">';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++;
            $running_day++;
            $day_counter++;
        endfor;

        /* finish the rest of the days in the week */
        if ($days_in_this_week < 8):
            for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
                //$calendar.= '<td colspan="2" class="calendar-day-np"> </td>';
                $calendar .= '<td class="calendar-day-np"> </td>';
            endfor;
        endif;

        /* final row */
        $calendar .= '</tr>';

        /* end the table */
        $calendar .= '</table>';

        $calendar .= '
';

        $calendar .= '';

        /* all done, return result */
        return $calendar;
    }

    /* sample usages */

    echo '<center>';
    echo '<h2>' . $strdate . $row16 . '</h2>';
    echo '<br>';
//echo '<table width="50%"><tr><td align="middle" width="50%">Hadir</td><td align="middle" width="50%">Tidak Hadir</td></tr><tr><td bgcolor="#85D84F"></td><td bgcolor="#FF3718"></td></tr></table>';
    echo '<br>';
    echo '<div class="col-lg-12"><div class="card"><div class="card-header" align="left">Maklumat Aktiviti&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Aktiviti</button>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</div><div class="card-body">';
    echo '<div class="default_tab"><nav><div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">';
    echo '<a class="nav-item nav-link active" id="nav-jadual-tab" data-toggle="tab" href="#nav-jadual" role="tab" aria-controls="nav-jadual" aria-selected="true">Jadual Aktiviti</a>';
    echo '<a class="nav-item nav-link" id="nav-senarai-tab" data-toggle="tab" href="#nav-senarai" role="tab" aria-controls="nav-senarai" aria-selected="false">Senarai Aktiviti</a>';
    echo '</div></nav>';
    echo '<div class="tab-content pl-3 pt-2" id="nav-tabContent">';
    echo '<div class="tab-pane fade show active" id="nav-jadual" role="tabpanel" aria-labelledby="nav-jadual-tab">';
    echo draw_calendar($bulan, $year);
    echo '</div>';
    echo '<div class="tab-pane fade" id="nav-senarai" role="tabpanel" aria-labelledby="nav-senarai-tab">';
    echo '<div class="table-responsive" align="left">';
    echo '<table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">';
    echo '<thead><tr><th><div align="center">#</div></th><th><div align="center">Jenis Aktiviti</div></th><th><div align="center">Nama Aktiviti</div></th><th><div align="center">Tarikh</div></th><th><div align="center">Masa</div></th><th><div align="center">Lokasi</div></th><th><div align="center">Kemaskini</div></th><th><div align="center">Padam</div></th></tr></thead>';
    echo '<tbody>';
    $tarikh_awal = $year."-".$bulan."-01";
    $tarikh_akhir = $year."-".$bulan."-31";
    $sql_senarai = "SELECT * FROM sej6x_data_aktiviti WHERE id_masjid='$id_masjid' AND tarikh BETWEEN '$tarikh_awal' AND '$tarikh_akhir' ORDER BY tarikh ASC";
    $query_senarai = mysqli_query($bd2,$sql_senarai);
    $i=1;
    while($data_senarai=mysqli_fetch_array($query_senarai))
    {
        ?>
        <tr>
            <td align="center"><?php echo $i; ?></td>
            <td align="center"><?php echo $data_senarai["jenis_aktiviti"]; ?></td>
            <td align="center"><?php echo $data_senarai["nama_aktiviti"]; ?><?php if($data_senarai['jenis_aktiviti']=="Kuliah" AND ($data_senarai['nama_penceramah']!="" AND $data_senarai['nama_penceramah']!=NULL)) { ?><h5><span class="label label-info"><?php echo $data_senarai['nama_penceramah']; ?></span></h5><?php } ?></td>
            <td align="center"><?php echo $data_senarai["tarikh"]; ?></td>
            <td align="center"><?php echo $data_senarai["masa"]; ?></td>
            <td align="center"><?php echo $data_senarai["lokasi"]; ?></td>
            <td align="center">
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#editModal<?php echo $data_senarai["id_aktiviti"]; ?>"><i class="fa fa-edit"></i></button>
            </td>
            <td align="center">
                <form action="admin/del_aktiviti.php" method="POST">
                    <button type="submit" name="submit" class="btn btn-warning" onclick="return confirm('Anda Pasti Untuk Padam?')"><i class="fa fa-trash"></i></button>
                    <input type="hidden" name="bulan" value="<?php echo $bulan; ?>">
                    <input type="hidden" name="year" value="<?php echo $year; ?>">
                    <input type="hidden" name="id_aktiviti" value="<?php echo $data_senarai["id_aktiviti"]; ?>">
                </form>
            </td>
        </tr>
        <?php
        $i++;
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</div></div></div></div></div>';
    echo '</center>';
}
?>

<script>
    function showAktiviti(str) {
        if (str == "") {
            document.getElementById("edit_modal").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("edit_modal").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/get_aktiviti.php?id_aktiviti="+str,true);
            xmlhttp.send();
        }
    }
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Aktiviti', [ 0, 1, 2, 3, 4, 5]);
    });
</script>
<script>
    $(document).ready(function(){
        function fetch_data()
        {
            $.ajax({
                url:"admin/select.php?id_aktiviti=<?php echo $id_aktiviti; ?>",
                method:"POST",
                success:function(data){
                    $('#live_data<?php echo $id_aktiviti; ?>').html(data);
                }
            });
        }
        fetch_data();
        $(document).on('click', '.btn_delete', function(){
            var id=$(this).data("id3");
            if(confirm("Anda Pasti Untuk Padam?"))
            {
                $.ajax({
                    url:"admin/delete_fail.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"text",
                    success:function(data){
                        alert(data);
                        fetch_data();
                    }
                });
            }
        });
    });
</script>
