		<?php
	include("connection/connection.php");
	$result= mysqli_query($bd2, "SELECT id_masjid,kod_masjid,nama_masjid,alamat_masjid FROM sej6x_data_masjid WHERE kod_masjid='$jname'") or die("SELECT Error: ".mysqli_error());
	$namamasjid = mysqli_fetch_assoc($result);
?>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <?php
if($_GET['qariah']=="tanggungan")
{
?>
<script>
$(function() {

    /*<!-- ============================================================== -->*/
    /*<!-- Bar Chart -->*/
    /*<!-- ============================================================== -->*/
    new Chart(document.getElementById("chart"),
        {
            "type":"bar",
            "data":{"labels":["1-20 Tahun","21-30 Tahun","31-40 Tahun","41-50 Tahun","51-60 Tahun","61-70 Tahun","71-80 Tahun","80 Tahun Ke Atas"],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php
						$sql="SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '1' AND '20')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '21' AND '30')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '31' AND '40')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
						?>,
						<?php
                        $sql="SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '41' AND '50')";
						$sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '51' AND '60')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '61' AND '70')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '71' AND '80')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery); ?>,
						 <?php
						$sql="SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) > 80)";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(255, 153, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(255, 153, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
    
	new Chart(document.getElementById("chart2"),
        {
            "type":"bar",
            "data":{"labels":["Lelaki","Perempuan"],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php $sql="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND jantina=1"; $sqlquery=mysqli_query($bd2, $sql); echo mysqli_num_rows($sqlquery); ?>,
						<?php $sql="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND jantina=2"; $sqlquery=mysqli_query($bd2, $sql); echo mysqli_num_rows($sqlquery); ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
		
	new Chart(document.getElementById("chart4"),
        {
            "type":"bar",
            "data":{"labels":["Bujang","Berkahwin","Duda","Janda"],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php $sql="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND status_kahwin=1"; $sqlquery=mysqli_query($bd2, $sql); echo mysqli_num_rows($sqlquery); ?>,
						<?php $sql="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND status_kahwin=2"; $sqlquery=mysqli_query($bd2, $sql); echo mysqli_num_rows($sqlquery); ?>,
						<?php $sql="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND status_kahwin=3"; $sqlquery=mysqli_query($bd2, $sql); echo mysqli_num_rows($sqlquery); ?>,
						<?php $sql="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND status_kahwin=4"; $sqlquery=mysqli_query($bd2, $sql); echo mysqli_num_rows($sqlquery); ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
});
</script>
<?php
}
else if($_GET['qariah']=="ketua")
{
?>
<script>
$(function() {
    
    /*<!-- ============================================================== -->*/
    /*<!-- Bar Chart -->*/
    /*<!-- ============================================================== -->*/
    new Chart(document.getElementById("chart"),
        {
            "type":"bar",
            "data":{"labels":["1-20 Tahun","21-30 Tahun","31-40 Tahun","41-50 Tahun","51-60 Tahun","61-70 Tahun","71-80 Tahun","80 Tahun Ke Atas"],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '1' AND '20')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '21' AND '30')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '31' AND '40')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
						?>,
						<?php
                        $sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '41' AND '50')";
						$sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '51' AND '60')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '61' AND '70')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '71' AND '80')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery); ?>,
						 <?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) > 80)";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(255, 153, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(255, 153, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
    
	new Chart(document.getElementById("chart2"),
        {
            "type":"bar",
            "data":{"labels":["Lelaki","Perempuan"],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND jantina=1";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND jantina=2";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
		
	new Chart(document.getElementById("chart3"),
        {
            "type":"horizontalBar",
            "data":{"labels":[<?php $sql_zon="SELECT * FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; $sqlquery_zon=mysqli_query($bd2, $sql_zon); $zon_row=mysqli_num_rows($sqlquery_zon); $i=1; while($zon=mysqli_fetch_array($sqlquery_zon)) { ?>"<?php echo $zon['nama_zon']; ?>"<?php if($i<$zon_row) { echo ","; } $i++; } ?>],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php $sql_zon="SELECT * FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; $sqlquery_zon=mysqli_query($bd2, $sql_zon);  $zon_row=mysqli_num_rows($sqlquery_zon); $i=1; while($zon=mysqli_fetch_array($sqlquery_zon)) { $zon_qariah=$zon['id_zonqariah']; $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND zon_qariah='$zon_qariah'"; $sqlquery=mysqli_query($bd2, $sql); echo mysqli_num_rows($sqlquery); if($i<$zon_row) { echo ","; } $i++; } ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });

	new Chart(document.getElementById("chart4"),
        {
            "type":"bar",
            "data":{"labels":["Bujang","Berkahwin","Duda","Janda"],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND status_perkahwinan=1";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND status_perkahwinan=2";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND status_perkahwinan=3";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND status_perkahwinan=4";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
});
</script>
<?php
}
else if($_GET['qariah']=="semua")
{
?>
<script>
$(function() {
    
    /*<!-- ============================================================== -->*/
    /*<!-- Bar Chart -->*/
    /*<!-- ============================================================== -->*/
    new Chart(document.getElementById("chart"),
        {
            "type":"bar",
            "data":{"labels":["1-20 Tahun","21-30 Tahun","31-40 Tahun","41-50 Tahun","51-60 Tahun","61-70 Tahun","71-80 Tahun","80 Tahun Ke Atas"],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '1' AND '20') 
                                    UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '1' AND '20')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '21' AND '30') 
                                    UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '21' AND '30')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '31' AND '40') 
                                    UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '31' AND '40')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
						?>,
						<?php
                        $sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '41' AND '50') 
                                    UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '41' AND '50')";
						$sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '51' AND '60') 
                                    UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '51' AND '60')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '61' AND '70') 
                                    UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '61' AND '70')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>,
						<?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) BETWEEN '71' AND '80') 
                                    UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) BETWEEN '71' AND '80')";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery); ?>,
						 <?php
						$sql="SELECT a.id_data 'id_data', a.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(a.tarikh_lahir) 'umur', a.no_ic 'no_ic', a.no_hp 'no_hp', a.alamat_terkini 'alamat_terkini', a.tarikh_lahir 'tarikh_lahir', a.jantina 'jantina' FROM sej6x_data_peribadi a WHERE a.id_masjid='$id_masjid' AND (YEAR(CURDATE()) - YEAR(a.tarikh_lahir) > 80) 
                                    UNION SELECT b.ID 'id_data', b.nama_penuh 'nama_penuh', YEAR(CURDATE()) - YEAR(b.tarikh_lahir) 'umur', b.no_ic 'no_ic', b.no_tel 'no_hp', c.alamat_terkini 'alamat_terkini', b.tarikh_lahir 'tarikh_lahir', b.jantina 'jantina' FROM sej6x_data_anakqariah b, sej6x_data_peribadi c WHERE b.id_masjid='$id_masjid' AND b.id_qariah=c.id_data AND (YEAR(CURDATE()) - YEAR(b.tarikh_lahir) > 80)";
                        $sqlquery=mysqli_query($bd2, $sql);
                        echo $row=mysqli_num_rows($sqlquery);
                        ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(255, 153, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(255, 153, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
    
	new Chart(document.getElementById("chart2"),
        {
            "type":"bar",
            "data":{"labels":["Lelaki","Perempuan"],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND jantina=1";
                        $sqlquery=mysqli_query($bd2, $sql);
                        $row=mysqli_num_rows($sqlquery);

                        $sql1="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND jantina=1";
                        $sqlquery1=mysqli_query($bd2, $sql1);
                        $row1=mysqli_num_rows($sqlquery1);

                        echo $total = $row + $row1;
                        ?>,
						<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND jantina=2";
                        $sqlquery=mysqli_query($bd2, $sql);
                        $row=mysqli_num_rows($sqlquery);

                        $sql1="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND jantina=2";
                        $sqlquery1=mysqli_query($bd2, $sql1);
                        $row1=mysqli_num_rows($sqlquery1);

                        echo $total=$row+$row1;
                        ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
		
	new Chart(document.getElementById("chart3"),
        {
            "type":"horizontalBar",
            "data":{"labels":[<?php $sql_zon="SELECT * FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; $sqlquery_zon=mysqli_query($bd2, $sql_zon); $zon_row=mysqli_num_rows($sqlquery_zon); $i=1; while($zon=mysqli_fetch_array($sqlquery_zon)) { ?>"<?php echo $zon['nama_zon']; ?>"<?php if($i<$zon_row) { echo ","; } $i++; } ?>],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php $sql_zon="SELECT * FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; $sqlquery_zon=mysqli_query($bd2, $sql_zon);  $zon_row=mysqli_num_rows($sqlquery_zon); $i=1; while($zon=mysqli_fetch_array($sqlquery_zon)) { $zon_qariah=$zon['id_zonqariah']; $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND zon_qariah='$zon_qariah'"; $sqlquery=mysqli_query($bd2, $sql); echo mysqli_num_rows($sqlquery); if($i<$zon_row) { echo ","; } $i++; } ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]},
            }
        });

	new Chart(document.getElementById("chart4"),
        {
            "type":"bar",
            "data":{"labels":["Bujang","Berkahwin","Duda","Janda"],
            "datasets":[{
                            "label":"Jumlah Ahli Kariah",
                            "data":[<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND status_perkahwinan=1";
                        $sqlquery=mysqli_query($bd2, $sql);
                        $row=mysqli_num_rows($sqlquery);

                        $sql1="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND status_kahwin=1";
                        $sqlquery1=mysqli_query($bd2, $sql1);
                        $row1=mysqli_num_rows($sqlquery1);

                        echo $total = $row + $row1;
                        ?>,
						<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND status_perkahwinan=2";
                        $sqlquery=mysqli_query($bd2, $sql);
                        $row=mysqli_num_rows($sqlquery);

                        $sql1="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND status_kahwin=2";
                        $sqlquery1=mysqli_query($bd2, $sql1);
                        $row1=mysqli_num_rows($sqlquery1);

                        echo $total=$row+$row1;
                        ?>,
						<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND status_perkahwinan=3";
                        $sqlquery=mysqli_query($bd2, $sql);
                        $row=mysqli_num_rows($sqlquery);

                        $sql1="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND status_kahwin=3";
                        $sqlquery1=mysqli_query($bd2, $sql1);
                        $row1=mysqli_num_rows($sqlquery1);

                        echo $total = $row+$row1;
                        ?>,
						<?php
                        $sql="SELECT * FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' AND status_perkahwinan=4";
                        $sqlquery=mysqli_query($bd2, $sql);
                        $row=mysqli_num_rows($sqlquery);

                        $sql1="SELECT * FROM sej6x_data_anakqariah WHERE id_masjid='$id_masjid' AND status_kahwin=4";
                        $sqlquery1=mysqli_query($bd2, $sql1);
                        $row1=mysqli_num_rows($sqlquery1);

                        echo $total = $row + $row1;
                        ?>],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
});
</script>
<?php
}
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Utama</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Statistik Ahli Kariah</li>
                    <?php if($_SESSION['user_type_id'] != 10)  { ?>
					<li><a href="utama.php?view=admin&action=dashboard_payment">Statistik Bayaran</a></li>
					<li><a href="utama.php?view=admin&action=dashboard_bantuan">Statistik Bantuan</a></li>
					<?php } ?>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <center>
                    <select class="form-control" style="width:300px" name="qariah" onChange="document.location.href='utama.php?view=admin&action=dashboard&qariah='+this.options[this.selectedIndex].value">
                        <option value="semua" <?php if($_GET['qariah']=="semua") { echo "selected"; } ?>>Ketua Keluarga & Tanggungan</option>
                        <option value="ketua" <?php if($_GET['qariah']=="ketua") { echo "selected"; } ?>>Ketua Keluarga</option>
                        <option value="tanggungan" <?php if($_GET['qariah']=="tanggungan") { echo "selected"; } ?>>Tanggungan</option>
                    </select>
                    </center>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Umur Ahli Kariah</h4>
					<div>
						<canvas id="chart" height="150"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Jantina Ahli Kariah</h4>
					<div>
						<canvas id="chart2" height="150"></canvas>
					</div>
				</div>
			</div>
		</div>
		<?php if($_GET['qariah']!="tanggungan"){ ?>
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Bilangan Ahli Kariah Mengikut Zon</h4>
					<div>
						<canvas id="chart3" height="150"></canvas>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Status Diri Ahli Kariah</h4>
					<div>
						<canvas id="chart4" height="150"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
