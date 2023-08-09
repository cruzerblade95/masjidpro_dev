<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-Type: application/json; charset=UTF-8");
$url = "https://masjidpro.com/Masjid/appUI";
//$path_parts = pathinfo('/home/admin/public_html/Masjid/appUI/slide');

$files = scandir("slide");
$i = 0;
foreach($files as $file) {
    if(is_file("slide/$file")) {
        $path_parts = pathinfo("slide/$file");
        $slide[$i]['image'] = $url."/slide/".$file;
        $slide[$i]['text'] = file_get_contents($url."/slideText/".$path_parts['filename'].".txt");
        $i++;
    }
}
echo '{"slideDepan":';
echo json_encode($slide, JSON_UNESCAPED_SLASHES);
echo '}';
?>