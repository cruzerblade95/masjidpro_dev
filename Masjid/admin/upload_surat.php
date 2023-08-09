<?php


if(isset($_POST['submit'])){
    $name= $_FILES['file']['name'];

    $tmp_name= $_FILES['file']['tmp_name'];

    $submitbutton= $_POST['submit'];

    $position= strpos($name, ".");

    $fileextension= substr($name, $position + 1);

    $fileextension= strtolower($fileextension);

    $description= $_POST['description'];
    $tarikh=$_POST['tarikh'];

    if(isset($name)) {

        $path= 'Uploads/surat/'.$id_masjid.'/';

        mkdir($path);

        if (!empty($name)){
            if (move_uploaded_file($tmp_name, $path.$name)) {
                //echo 'Berjaya!';

            }
        }
    }

    if(!empty($description)){
        $sqlquery = mysqli_query($bd2,"INSERT INTO upload_surat (id_masjid,tarikh,description, filename)
    VALUES ('$id_masjid','$tarikh','$description','$name')");
    }

    if($sqlquery){
        ?>
        <script>alert("Fail Berjaya Ditambah");window.location.href="utama.php?view=admin&action=upload_surat";</script>
        <?php
    }
}


?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Upload Surat Rasmi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Upload Surat Rasmi</li>
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
                    Maklumat Fail
                </div>
                <div class="card-body">
                    <form action="" method='post' enctype="multipart/form-data">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tarikh</label>
                                <input class="form-control" name="tarikh" id="tarikh" type="date" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Nama Fail</label>
                                <input class="form-control" name="description" id="description" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Upload Fail</label>
                                <input type="file" class="form-control" name="file" id="file" />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <br>
                                <input type="submit" name="submit" value="Upload" class="btn btn-primary"></input>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Rekod Fail</div>
                <script>
                    function myFunction() {
                        window.print();
                    }
                </script>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        include("connection/connection.php");
                        $result= mysqli_query($bd2,"SELECT id,tarikh,description,filename FROM upload_surat WHERE id_masjid='$id_masjid'
					ORDER BY ID desc" ) or die("SELECT Error: ".mysqli_error());
                        ?>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th><div align="center">No.</div></th>
                                <th><div align="center">Nama Fail</div></th>
                                <th><div align="center">Tarikh</div></th>
                                <th><div align="center">Lihat Fail</div></th>
                                <th><div align="center">Muat Turun</div></th>
                                <th><div align="center">Padam</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x=1; ?>
                            <?php while ($row = mysqli_fetch_array($result)){
                                $files_field= $row['filename'];
                                $files_show= "Uploads/surat/$id_masjid/$files_field";
                                $descriptionvalue= $row['description'];  ?>
                                <tr class="odd gradeX">
                                    <td><div align="center"><?php echo $x; ?></div></td>
                                    <td><?php echo $descriptionvalue; ?></td>
                                    <td><div align="center"><?php echo $row['tarikh']; ?></div></td>
                                    <td>
                                        <div align="center">
                                            <?php if(strpos($files_show, '.pdf') === false) echo "<a target='_blank' href='https://view.officeapps.live.com/op/embed.aspx?src=https://masjidpro.com/Masjid/$files_show' class='btn btn-warning'><i class='fa fa-file'></i></a>"?>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center">
                                            <?php echo "<a href='$files_show' class='btn btn-info'><i class='fa fa-upload'></i></a>"?>
                                        </div>
                                    </td>
                                    <td><div align="center">
                                            <form name="delete" method="POST" action="">
                                                <input type="hidden" name="del" id="del" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete" id="delete" class="btn btn-danger" title="Padam" onclick="return confirm('Padam Fail Surat Rasmi?');" ><i class="fas fa-trash"></i>
                                                </button> </form>
                                        </div></td>
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
                <!-- /.card-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
</div>




