<?php
include("connection/connection.php");

if(isset($_POST['search']))
{
    $daripada = $_POST['daripada'];
    $hingga = $_POST['hingga'];

}
?>
<?php
if($_GET['action']=="maklumatinventori")
{
    ?>
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Rekod Inventori</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
                        <li class="active">Rekod Inventori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<!-- div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carian &nbsp;&nbsp;
                            <button  class="btn btn-info" onclick="history.go(-1);">Kembali </button></div>

                        <div class="panel-body">
                        <div class="row">
                            <form id="form1" name="form1" method="POST" action="<?php //echo $PHP_SELF;?>">

                            <div class="col-lg-3">
                              <div class="form-group">
                                <label>Daripada</label>
                                        <input class="form-control" name="daripada" id="daripada" type="date" required>
                              </div>
                                </div>

                              <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Hingga</label>
                                            <input class="form-control" name="hingga" id="hingga" type="date" required>
                                        </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                            <br>
                                            <input type="submit" name="search" value="Carian" class="btn btn-primary"></input>

                                    </div>
                                     <input type="hidden" name="carisearch" value="1" />
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div -->
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Rekod Inventori
                    <?php
                    if($_GET['action']=="maklumatinventori")
                    {
                        ?>
                        &nbsp;&nbsp;<a href="utama.php?view=admin&action=inventori" class="btn btn-primary">Tambah Inventori</a>
                        <?php
                    }
                    ?>
                    <!-- <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
                    <script>
                    function myFunction() {
                    window.print();
                    }
                    </script> -->
                </div>
                <div class="card-body">
                    <?php

                    include("connection/connection.php");
                    $idrekod = $_GET['id_inventori'];
                    $sql_search="SELECT a.tarikh_kerosakan, a.kuantiti, a.kuantiti_unit, b.status_kerosakan, a.catatan 
                                 FROM sej6x_data_kerosakkan a LEFT JOIN sej6x_data_statuskerosakan b on a.id_statuskerosakan = b.id_status 
                                 WHERE a.id_peralatan = '$idrekod'";
                    $result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <div class="table-responsive">
                        <table id="meja_akaun8" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">Bil</div></th>
                                <th><div align="center">Tarikh</div></th>
                                <th><div align="center">Kuantiti & Unit</div></th>
                                <th><div align="center">Status</div></th>
                                <th><div align="center">Catatan</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x=1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <tr>
                                    <td><div align="center"><?php echo $x; ?></div></td>
                                    <td><div align="center"><?php echo $row['tarikh_kerosakan']; ?></div></td>
                                    <td><div align="center"><?php echo $row['kuantiti']; ?>&nbsp;<?php echo $row['kuantiti_unit']; ?></div></td>
                                    <td><div align="center"><?php echo $row['status_kerosakan'] ?></div></td>
                                    <td><div align="center"><?php echo $row['catatan']; ?></div></td>
                                </tr>
                                <?php
                                $x++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun8', 'Rekod Inventori', [ 0, 1, 2, 3, 4 ]);
    });
</script>