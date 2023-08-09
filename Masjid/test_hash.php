<?php
$time_start = microtime(true);
$txt = "PHP.PHP";
$hash_statik = '$2y$10$j/u8spzO5cuVLRA5ZktFuu9P.6IDG1.wLcncSLKrWkggm/w/uTElG';
$hash = password_hash($txt, PASSWORD_DEFAULT);
$hash2 = password_hash($txt, PASSWORD_DEFAULT);
$hash3 = password_hash($txt, PASSWORD_DEFAULT);
echo $hash.'<br/>'.$hash2.'<br/>'.$hash3.'<br/>';
if (password_verify('156156', $hash_statik)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
echo '<br/>Masa diambil: ' . (microtime(true) - $time_start);
?>