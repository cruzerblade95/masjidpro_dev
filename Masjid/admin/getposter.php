<?php

include ('../connection/connection.php');

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
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-md-12">
                <center>
                    <?php
                    if($data_wakaf['poster_wakaf']==NULL OR $data_wakaf['poster_wakaf']==''){
                        ?>
                        *Tiada Poster*
                        <?php
                    }
                    else if($data_wakaf['poster_wakaf']!=NULL OR $data_wakaf['poster_wakaf']!=''){
                        ?>
                        <img width='750px' heigh='750px' src="<?php echo $data_wakaf['poster_wakaf']; ?>">
                        <?php
                    }
                    ?>
                </center>
            </div>
        </div>
    </div>
    <?php
}
?>