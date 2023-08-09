<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$test = 1;
if($test == 1) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css" integrity="sha512-drnvWxqfgcU6sLzAJttJv7LKdjWn0nxWCSbEAtxJ/YYaZMyoNLovG7lPqZRdhgL1gAUfa+V7tbin8y+2llC1cw==" crossorigin="anonymous" />
        <title>Masjid Pro - Kod QR :: Masjid Jamek Tasek Gelugor</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.js" integrity="sha512-g6uKBhbH4/FmsKhkup5OCgdNJ6hHQxcJZ7jPPF5lI7ZTeQtBqTC0B0nT1Rg15blk6pnOd5CoMUwvXSxjaYUzuA==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.js" integrity="sha512-KCgUnRzizZDFYoNEYmnqlo0PRE6rQkek9dE/oyIiCExStQ72O7GwIFfmPdkzk4OvZ/sbHKSLVeR4Gl3s7s679g==" crossorigin="anonymous"></script>
    </head>
    <body>
    <iframe id="mysejahtera" name="mysejahtera" src="<?php echo $_GET['url']; ?>" style="width: 100%" scrolling="no"></iframe>
    <!--script>
            //$('#mysejahtera').contents().find('input #name').bind('change',function(e) {
                //title_name = $(this).val();
                //title_name = "matdus";
                //$('input #name').val(title_name);
            //});


            // attach handlers once iframe is loaded

            document.getElementById('mysejahtera').onload = function() {

                var win = mysejahtera.contentWindow; // reference to iframe's window
                // reference to document in iframe
                var doc = mysejahtera.contentDocument? mysejahtera.contentDocument:
                    mysejahtera.contentWindow.document;
                // reference to form named 'demoForm' in iframe
                doc.getElementById('name').value = 'matdus';
                //window.frames['mysejahtera'].document.getElementById("name").value = "matdus";
            }
    </script-->
    <script>
        $(document).ready(function() {
            var height = $(window).height();
            $('#mysejahtera').css('height', (screen.height * 2) + "px");
        });
    </script>
    </body>
    </html>
<?php } if($test == 2) {
    $isi = file_get_contents("https://mysejahtera.malaysia.gov.my/qrscan/?lId=5efc45da474da02d91dcc2de&ln=Masjid_Jamek_Tasek_Gelugor&eln=TWFzamlkIEphbWVrIFRhc2VrIEdlbHVnb3I=&formType=REGULAR&isExternal=false");
    $isi = str_replace('/css/', 'https://mysejahtera.malaysia.gov.my/css/', $isi);
    $isi = str_replace('/images/', 'https://mysejahtera.malaysia.gov.my/images/', $isi);
    $isi = str_replace('/js/', 'https://mysejahtera.malaysia.gov.my/js/', $isi);
    $isi = str_replace('formGeneral.html', 'formGeneral.php', $isi);
    $isi = str_replace('checkinSuccess.html', 'checkinSuccess.php', $isi);
    $isi = str_replace('/clockin', 'https://mysejahtera.malaysia.gov.my/clockin', $isi);
    $isi = str_replace('https://" + window.location.host', '"', $isi);
    echo $isi;
}
?>
