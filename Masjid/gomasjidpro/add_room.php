<?php
require_once $_SERVER;
if(!is_logged_in()){
    login_error_check();
}

include 'includes/header.php';
include 'includes/navigation.php';

if(@$_GET['edit'] && !empty(@$_GET['edit'])){
    $id = $_GET['edit'];
    $get = $db2->query("SELECT * FROM beradu_room WHERE id_room = '$id_room' ");
    $edit = mysqli_fetch_assoc($get);

}

//VALIDATING AND MOVING OF FILE FROM TEMPORAL LOCATION TO INTENDED LOCATION
if(!empty($_FILES)){
    $fileName = @$_FILES['file']['name'];
    $ext = strtolower(substr($fileName, strpos($fileName,'.') + 1));
    $fileName = md5(microtime()).'.'.$ext;
    $type = @$_Files['file']['type'];
    $tmp_name = @$_FILES['file']['tmp_name'];

    if(($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'png') || ($ext == 'gif')){
        $location = $_SERVER;
        move_uploaded_file($tmp_name, $location.$fileName);
    } else {
        echo '<div class="w3-center w3-red">The image type must be jpg, jpeg, gif, or png.</div></br>';
    }
}

//INSERTING THE EVENT INFORMATION IN THE DATABASE
if(isset($_POST['submit'])){
    if(!empty($_POST['id_room']) && !empty($_POST['id_produk']) && !empty($_POST['price']) && !empty($_POST['room_type'])){

        $id_room = $_POST['id_room'];
        $id_produk = $_POST['id_produk'];
        $price = $_POST['price'];
        $room_type = $_POST['room_type'];
        $total_room = $_POST['total_room'];
        #$room_image = $_POST['room_image']

        $room_image = 'room_image/'.$fileName;
        //INSERTING EVENT DETAILS IN THE DATABASE
        $sql = "INSERT INTO beradu_room (`id_room`,`id_produk`,`room_type`,`price`,`room_image`,`total_room`)
                  VALUES ('$id_room','$room_type','$price','$room_image','$total_room') ";

        $query_run = $db2->query($sql);
        if($query_run){
            $_SESSION['added_event'] = '<div class="w3-center w3-green">Room successfully added!</div></br>';
        }
        header("Location: rooms.php");
    } else {
        echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
    }
}
//RUNNING UPDATE IF EDITING
else if(isset($_POST['update'])) {
    if(!empty($_POST['id_room']) && !empty($_POST['id_produk']) && !empty($_POST['price']) && !empty($_POST['room_type'])){
        $id_room = $_POST['id_room'];
        $room_type = $_POST['room_type'];
        $price = $_POST['price'];
        $id_produk = $_POST['id_produk'];
        $total_room = $_POST['total_room'];

        @$room_image = 'images/'.$fileName;
        $toEditID = $_GET['edit'];
        $sqlSelect = $db2->query("SELECT * FROM beradu_room WHERE id_room = '$toEditID' ");
        $row = mysqli_fetch_assoc($sqlSelect);

        if($row['photo']==''){
            $query = $db2->query("UPDATE beradu_room SET `id_room`='$id_room',`room_image`='$room_image',`room_type`='$room_type',`price`='$price',`room_type`='$room_type' WHERE id_room = '$toEditID' ");
        } else {
            $query = $db2->query("UPDATE beradu_room SET `id_room`='$id_room',`total_room`='$total_room',`price`='$price',`room_type`='$room_type' WHERE id_room = '$toEditID' ");
        }

        $update = $db2->query($query);
        header("Location: rooms.php");

    } else {
        echo '<div class="w3-center w3-red">Please fill in all fields.</div></br>';
    }
}

if(isset($_GET['delete_image'])){
    $toEditID= $_GET['delete_image'];
    $sql1 = $db2->query("SELECT * FROM beradu_room WHERE id_room = '$toEditID'");
    $fetch = mysqli_fetch_assoc($sql1);
    $imageURL = $_SERVER.$fetch['photo'];
    unlink($imageURL);
    ##################################################################
    $sql = "UPDATE beradu_room SET `room_image` = '' WHERE id_room = '$toEditID' ";
    $db2
        ->query($sql);
    header("Location: add_room.php?edit=$toEditID");
}

?>

<div class="w3-container w3-main" style="margin-left:200px">
    <header class="w3-container w3-purple">
        <span class="w3-opennav w3-xlarge w3-hide-large" onclick="w3_open()">☰</span>
        <h2 class="text-center">Add a room</h2>
    </header>
    <br/>
    <form class="form" action="#" method="post" enctype="multipart/form-data">

        <div class="form-group col-md-4">
            <label>Room Number:</label>
            <input type="text" class="form-control" value="<?= (isset($_GET['edit']))? ''.$edit['id_room'].'':''; ?>" name="number">
        </div>

        <div class="form-group col-md-4">
            <label>Room Type:</label>
            <input type="text" class="form-control" value="<?= (isset($_GET['edit']))? ''.$edit['room_type'].'':''; ?>" name="type">
        </div>

        <div class="form-group col-md-2">
            <label>Room Price:</label>
            <input type="text" class="form-control" value="<?= (isset($_GET['edit']))? ''.$edit['price'].'':''; ?>" name="price">
        </div>

        <div class="form-group col-md-2">
            <label># of rooms:</label>
            <input type="number" class="form-control" value="<?= (isset($_GET['edit']))? ''.$edit['rooms'].'':''; ?>" name="rooms">
        </div>

        <div class="form-group col-md-4">
            <?php if(isset($_GET['edit']) && !$edit['room_image'] != ' '): ?>
                <figure>
                    <h3>Event Image</h3>
                    <img src="../<?=$edit['room_image']; ?>" alt="event image" class="img-responsive">
                    <figcaption>
                        <a href="#" class="w3-text-red">Delete Photo</a>
                    </figcaption>
                </figure>
            <?php else: ?>
                <label>Room Image:</label>
                <input type="file" class="form-control" name="file">
            <?php endif; ?>
        </div>

        <div class="form-group col-md-4">
            <label>Description:</label>
            <textarea type="text" class="form-control" rows="6" name="description"> <?= (isset($_GET['edit']))? ''.$edit['details'].'':''; ?> </textarea>
        </div>

        <div class="form-group col-md-4">
            <label></label>
            <input type="submit" class="btn btn-block btn-lg btn-success" value="<?= (isset($_GET['edit']))? 'Update Room':'Add Room'; ?>" name="<?= (isset($_GET['edit']))? 'update':'submit'; ?>">
        </div>

        <?php if(isset($_GET['edit']) && !empty($_GET['edit'])): ?>
            <div class="form-group col-md-4">
                <label></label>
                <a class="btn btn-block btn-danger btn-lg" href="#">Cancel Edit</a>
            </div>


        <?php endif; ?>

    </form>
</div>
<script>
    function w3_open() {
        document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
    }
    function w3_close() {
        document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
    }
</script>

</body>
</html>