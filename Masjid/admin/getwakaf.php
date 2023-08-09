<?php

include ('../connection/connection.php');
include ('../fungsi.php');

if(isset($_GET['id_wakaf']))
{
    $id_wakaf = $_GET['id_wakaf'];

    $sql_wakaf = "SELECT * FROM wakaf WHERE id_wakaf='$id_wakaf'";
    $query_wakaf = mysqli_query($bd2,$sql_wakaf);

    $data_wakaf = mysqli_fetch_array($query_wakaf);
?>
<div class="form-body">
    <div class="form-group row">
        <div class="alert alert-info col-md-12" role="alert">
            <div class="row">
                <div class="col-md-12"><center><u>MAKLUMAT WAKAF</u></center></div><hr>
                <div class="col-md-3" align="left">Nama Wakaf</div><div class="col-md-1" align="left">:</div><div class="col-md-8" align="left"><?php echo $data_wakaf['nama_wakaf']; ?></div>
                <div class="col-md-3" align="left">Kuantiti</div><div class="col-md-1" align="left">:</div><div class="col-md-8" align="left"><?php echo $data_wakaf['quantity']; ?></div>
                <div class="col-md-3" align="left">Harga Per Kuantiti</div><div class="col-md-1" align="left">:</div><div class="col-md-8" align="left"><?php echo "RM ".$data_wakaf['harga_per_quantity']; ?></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group row">
        <div class="table-responsive">
            <table id="meja_akaun3" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <td align="center">Bil</td>
                    <td align="center">Nama</td>
                    <td align="center">No K/P</td>
                    <td align="center">No Tel</td>
                    <td align="center">Emel</td>
                    <td align="center">Unit</td>
                    <td align="center">Amaun</td>
                    <!-- <td align="center">Tarikh</td> -->
                </tr>
                </thead>
                <tbody>
                <?php
                $j = 1;
                $sql_rekodWakaf = "SELECT * FROM rekod_wakaf WHERE id_wakaf='$id_wakaf' AND statusBayaran=1";
                $query_rekodWakaf = mysqli_query($bd2,$sql_rekodWakaf);
                $bil_rekodWakaf = mysqli_num_rows($query_rekodWakaf);

                if($bil_rekodWakaf==0){
                    ?>
                    <tr>
                        <td align="center" colspan="7">*Tiada Rekod*</td>
                    </tr>
                    <?php
                }
                else if($bil_rekodWakaf>0){

                    while($data_rekodWakaf = mysqli_fetch_array($query_rekodWakaf))
                    {
                ?>
                    <tr>
                        <td align="center"><?php echo $j; ?></td>
                        <td align="center"><?php echo $data_rekodWakaf['nama']; ?></td>
                        <td align="center"><?php echo $data_rekodWakaf['no_ic']; ?></td>
                        <td align="center"><?php echo $data_rekodWakaf['no_tel']; ?></td>
                        <td align="center"><?php echo $data_rekodWakaf['emel']; ?></td>
                        <td align="center"><?php echo $data_rekodWakaf['unit_wakaf']; ?></td>
                        <td align="center"><?php echo "RM ".$data_rekodWakaf['amaun']; ?></td>
                        <!-- <td align="center"><?php //echo $data_rekodWakaf['tarikh_bayaran']; ?></td> -->
                    </tr>
                <?php
                    $j++;
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
}
?>