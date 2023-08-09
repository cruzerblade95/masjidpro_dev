<?php

$sql_search = "SELECT * FROM jawatan_pengurusan_masjid WHERE id_masjid='$id_masjid'";
$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Senarai Jawatan Pengurusan Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li class="active">Senarai Jawatan Pengurusan Masjid</li>
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
                    Senarai Jawatan Pengurusan Masjid&nbsp;|&nbsp;<button type="button" name="tambah" class="btn btn-info" data-toggle="modal" data-target="#modalJawatan">Tambah Jawatan</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">No</div></th>
                                <th><div align="center">Jawatan</div></th>
                                <th><div align="center"></div></th>
                                <th><div align="center"></div></th>
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
                                    <td><div align="center"><?php echo $row['jawatan']; ?></div></td>
                                    <td><div align="center">
                                            <!-- <a href="utama.php?view=admin&action=semak_jawatan_pengurusan&id_jawatan=<?php echo $row['id_jawatan'];?>">[Kemaskini]</a> -->
                                            <button type="button" name="update" class="btn btn-success" data-toggle="modal" data-target="#modalJawatanUpdate" value="<?php echo $row['id_jawatan'];?>" onClick="displayJawatan(this.value)">Kemaskini</button>
                                        </div></td>
                                    <td>
                                        <div align="center">
                                            <form name="delete" method="POST" action="admin/del_jawatanpengurusan.php">
                                                <input type="hidden" name="del" id="del" value="<?php echo $row['id_jawatan']; ?>">
                                                <input type="hidden" name="id_masjid" id="del_idMasjid" value="<?php echo $_SESSION['id_masjid']; ?>">
                                                <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam Rekod?')"><i class="fa fa-times"></i></button>
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
    </div>
</div>
<div class="modal fade" id="modalJawatan" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Daftar Jawatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <form action="admin/add_jawatan_pengurusan.php" method="POST">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 offset-4">
                               <div class="form-group">
                                   <label>Jawatan</label>
                                   <input type="text" name="jawatan" class="form-control" required>
                               </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-4">
                                <center>
                                <button type="submit" name="submit" class="btn btn-success">Daftar Jawatan</button>
                                </center>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalJawatanUpdate" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Kemaskini Jawatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="div_jawatan">
            </div>
        </div>
    </div>
</div>
<script>
    function displayJawatan(str){
        if (str == "") {
            document.getElementById("div_jawatan").innerHTML = "";
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
                    document.getElementById("div_jawatan").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/semak_jawatan_pengurusan.php?id_jawatan="+str,true);
            xmlhttp.send();
        }
    }
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Jawatan Pengurusan Masjid', [ 0, 1, 2, 3, 4 ]);
    });
</script>




