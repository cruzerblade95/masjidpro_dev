<?php

$filePath = $_GET['filepath'];
$fileName = basename($filePath);
if (empty($filePath)) {
    echo "'path' cannot be empty";
    exit;
}

if (!file_exists($filePath)) {
    echo "'$filePath' does not exist";
    exit;
}

header("Content-disposition: attachment; filename=" . $fileName);
header("Content-type: " . mime_content_type($filePath));
readfile($filePath);
?>