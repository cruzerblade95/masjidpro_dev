<?php

include('../connection/connection.php');

if(isset($_GET['id_aktiviti'])) {

    $id_aktiviti = $_GET['id_aktiviti'];
    $sql = "SELECT * FROM sej6x_data_aktiviti WHERE id_aktiviti='$id_aktiviti'";
    $sqlquery = mysqli_query($bd2,$sql);
    $data = mysqli_fetch_array($sqlquery);
    $jenis_aktiviti=$data['jenis_aktiviti'];
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
<div class="row">
    <div class="col-lg-12" >
        <center ><h4 ><u > Maklumat Aktiviti </u ></h4 ></center >
    </div >
</div >
<hr >
<div class="row" >
    <div class="col-lg-3" >

    </div >
    <div class="col-lg-6" >
        <div class="form-group" >
            <b > Jenis Aktiviti </b >
            <select class="form-control" name = "jenis_aktiviti" id = "jenis_aktiviti" required >
                <option value = "" > Sila Pilih:-</option >
                <option value = "Kuliah" <?php if($jenis_aktiviti=="Kuliah") { echo "selected"; } ?>>Kuliah / Pengajian</option >
                <option value = "Program" <?php if($jenis_aktiviti=="Program") { echo "selected"; } ?>> Program</option >
            </select >
        </div >
        <div class="form-group" >
            <!-- <label style = "color: red" >*</label > -->
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
            <div id="live_data"></div>
            <!-- <button type="button" class="btn btn-sm btn-warning" name="delete_fail" id="delete_fail">Padam Gambar</button> -->
        </div>
        <div class="form-group">
            <b>Lampir Fail Baru</b>
            <input type="file" name="failBaru" class="form-control">
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
    <script>
        $(document).ready(function(){
            function fetch_data()
            {
                $.ajax({
                    url:"select.php?id_aktiviti=<?php echo $id_aktiviti; ?>",
                    method:"POST",
                    success:function(data){
                        $('#live_data').html(data);
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
<?php
}
?>


