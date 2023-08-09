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
                    <h1>Senarai Penyelenggara</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
                        <li class="active">Senarai Penyelenggara</li>
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
                    Senarai Penyelenggara
                    <?php
                    if($_GET['action']=="maklumatselenggara")
                    {
                        ?>
                        &nbsp;&nbsp;<a href="utama.php?view=admin&action=selenggara" class="btn btn-primary">Tambah Penyelenggara</a>
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

                    $sql_search="SELECT a.id_penyelenggara, a.id_masjid, CAST(a.date_added AS DATE) as tarikh_daftar, 
                                 a.kat_penyelenggara, a.nama_penyelenggara, a.kat_peralatan, a.no_telefon,
                                 CASE WHEN a.tempoh_perkhidmatan = 1 THEN 'Satu Tahun' WHEN a.tempoh_perkhidmatan = 2 THEN 'Dua Tahun' ELSE 'Tiada Tempoh' END AS tempoh_khidmat,
                                 CASE WHEN DATE_ADD(a.date_added, INTERVAL a.tempoh_perkhidmatan YEAR) >= CURDATE() THEN 'Aktif' ELSE 'Tamat Perkhidmatan' END AS status 
                                 FROM penyelenggara a LEFT JOIN sej6x_data_jenisinventori b ON a.kat_peralatan = b.id_jenisinventori WHERE a.id_masjid = $id_masjid";
                    $result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <div class="table-responsive">
                        <table id="meja_akaun9" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">Bil</div></th>
                                <th><div align="center">Tarikh Daftar</div></th>
                                <th><div align="center">Kategori<br>Penyelenggara</div></th>
                                <th><div align="center">Nama<br>Penyelenggara</div></th>
                                <th><div align="center">Kategori<br>Penyelenggara<br>Peralatan</div></th>
                                <th><div align="center">No. Telefon</div></th>
                                <th><div align="center">Tempoh<br>Perkhidmatan</div></th>
                                <th><div align="center">Status</div></th>
                                <th><div align="center">Tindakan</div></th>
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
                                    <td><div align="center"><?php echo $row['tarikh_daftar']; ?></div></td>
                                    <td><div align="center"><?php echo ucwords($row['kat_penyelenggara']); ?></div></td>
                                    <td><div align="center"><?php echo $row['nama_penyelenggara']; ?></div></td>
                                    <td><div align="center"><?php echo $row['kat_peralatan']; ?></div></td>
                                    <td><div align="center"><?php echo $row['no_telefon']; ?></div></td>
                                    <td><div align="center"><?php echo $row['tempoh_khidmat'] ?></div></td>
                                    <td><div align="center"><?php echo $row['status'] ?></div></td>
                                    <td>
                                        <div align="center">
                                            <form action="admin/del_selenggara.php" method="POST">
<!--                                                <a href="utama.php?view=admin&action=view_inventori&id_inventori=--><?php //echo $row['id_inventori'];?><!--">-->
<!--                                                    <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">-->
<!--                                                        <i class="fa fa-search"></i>-->
<!--                                                    </button>-->
<!--                                                </a>-->
                                                <a href="utama.php?view=admin&action=semak_selenggara&id_selenggara=<?php echo $row['id_penyelenggara'];?>&sideMenu=masjid">
                                                    <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Kemaskini">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <!-- <form name="delete" method="POST" action="admin/del_inventori.php"> -->
                                                <input type="hidden" name="id_penyelenggara" value="<?php echo $row['id_penyelenggara']; ?>">
                                                <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                                <button type="submit" name="delete" id="delete" class="btn btn-danger" title="Padam"><i class="far fa-trash-alt" onclick="return confirm('Padam Rekod?');"></i></button>
                                                <!-- </form> -->
                                            </form>
                                        </div>
                                    </td>
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
        meja_akaun('#meja_akaun9', 'Senarai Penyelenggara', [ 0, 1, 2, 3, 4, 5, 6, 7]);
    });
</script>