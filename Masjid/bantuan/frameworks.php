<?php
function simpanData($a) {
    foreach ($_POST as $key => $value) {
        //if($_POST['borang'] == $a ) echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
        echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
    }
}
?>
