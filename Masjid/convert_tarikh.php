<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Location: ../login.php');
include("connection/connection.php");

if(isset($_GET['ID'])) {
    $tarikh_lahir = $_GET['tarikh_lahir'];
    $ID = $_GET['ID'];
    $q_update = "UPDATE sej6x_data_anakqariah SET tarikh_lahir = '$tarikh_lahir' WHERE ID = $ID";
    //mysqli_query($bd2, $q_update) or die(mysqli_error($bd2));
    //echo($q_update);
}

$q = "SELECT *, CONCAT(IF(SUBSTR(no_ic, 1, 2) > 20, 19, 20), SUBSTR(no_ic, 1, 2), '-', SUBSTR(no_ic, 3, 2), '-', SUBSTR(no_ic, 5, 2)) 'Tarikh Lahir' FROM sej6x_data_anakqariah ORDER BY nama_penuh ASC";
$result = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
$row = mysqli_fetch_assoc($result);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css" rel="stylesheet" type="text/css" integrity="sha256-A47OwxL/nAN0ydiDFTSGX7ftbfTJTKgiJ0zqCuTPDh4=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css.map" integrity="undefined" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.js" integrity="sha256-/MqPdltDqe7iSoqjNkMb7+w1uk5FJdOpIS7YErWktBQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js" integrity="sha256-66f6uQTQkvHF8jpniLWJjnteEfmQaC/tATFew/nTBA8=" crossorigin="anonymous"></script>
</head>
<div class="table-responsive">
    <table class="table table-sm table-dark table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">K/P</th>
            <th scope="col">Hubungan</th>
            <th scope="col">Tarikh Lahir</th>
            <th scope="col">Tarikh Lahir ISO</th>
            <th scope="col">Tindakkan</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        do {
            $ID = $row['ID'];
            $tarikh = $row['tarikh_lahir'];
            $tarikh_new =  $row['Tarikh Lahir'];
            if($sakan == NULL) {
                $new_date = date_create_from_format("d/m/Y H:i:s", "$tarikh 01:00:00");
                //$new_date2 = date_create_from_format("Y-m-d H:i:s", "$tarikh 01:00:00");
                //if ($new_date == NULL) $new_date = date_create_from_format("Y-m-d H:i:s", "$tarikh 01:00:00");
                //$time = strtotime("$tarikh 00:00:00");
                $newformat = date_format($new_date, "Y-m-d");

                if ($newformat2 == '1970-01-01') {
                    $new_date = date_create_from_format("d/m/Y H:i:s", "$tarikh 01:00:00");
                    $newformat = date_format($new_date, "Y-m-d");
                    $t1 = date_format($new_date, "d");
                    $t2 = date_format($new_date, "m");
                    if ($t1 < $t2) $newformat = date_format($new_date, "Y-m-d");
                }
                if ($newformat == '2020-04-26') $newformat = NULL;
            }
            //echo substr($tarikh,5, 2);
            if(substr($tarikh,8, 2) > 30 && substr($tarikh,5, 2) == 9) {
            $q = "UPDATE sej6x_data_anakqariah SET tarikh_lahir = '$newformat' WHERE ID = $ID";
            //mysqli_query($bd2, $q) or die(mysqli_error($bd2));
            ?>

        <tr>
            <th scope="row"><?php echo($i); ?></th>
            <td><?php echo($row['nama_penuh']); ?></td>
            <td><?php echo($row['no_ic']); ?></td>
            <td><?php echo($row['hubungan']); ?></td>
            <td><?php echo($row['tarikh_lahir']); ?></td>
            <td><input id="update_tarikh_<?php echo($ID); ?>" value="<?php echo($newformat); ?>"></td>
            <td><button type="button" onclick="document.location.href='<?php echo($_SERVER['PHP_SELF']); ?>?ID=<?php echo($ID); ?>&tarikh_lahir='+$('#update_tarikh_<?php echo($ID); ?>').val()"><?php echo($q); ?></button></a></td>
        </tr>
        <?php $i++; } } while($row = mysqli_fetch_assoc($result)); ?>
        </tbody>
    </table>
</div>
</body>
</html>
