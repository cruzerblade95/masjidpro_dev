<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
    <style type="text/css">
        @media print {
            #printbtn {
                display :  none;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <br>
    <center>
        <button onClick="window.print()" id="printbtn">Cetak</button>
    </center>
<div class="table-responsive" id="div_print">

    <?php
    include("../connection/connection.php");
    include("../connection/connection_kehadiran.php");

    $jawatan = $_GET['jenis_pegawai'];
    //echo($kod_masjid_kecik);

    //$id_masjid = $_GET['id_masjid'];
    $bulan_jadual = $_GET['tarikh']."-01";
    $tarikh_jadual = date_create($bulan_jadual);
    $tarikh_jadual = date_format($tarikh_jadual, "F Y");
    $id_bulan = $_GET['month'];
    $tahun = $_GET['tahun'];
    //Bulan

    $hari = date("t", mktime(0,0,0,$id_bulan,1,$tahun));
    $bulan3 = date("m", mktime(0,0,0,$id_bulan,1,$tahun));
    $bulan2 = date("F", mktime(0,0,0,$id_bulan,1,$tahun));

    $j = 1;
    $bil_cuti = 0;
    do {
        $z=mktime(00, 00, 00, $bulan3, $j, $tahun);
        $namahari = date("w", $z);
        $j++;
    } while ($j <= $hari);



    $sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
    $query_masjid = mysqli_query($bd2,$sql_masjid);
    $data_masjid = mysqli_fetch_array($query_masjid);

    $kod_masjid_kecik = $data_masjid['kod_masjid'];
    $id_device = $data_masjid['id_device'];


    //$id = $_GET['id_pegawai'];

    if($id_device == 1 ) {
        $sql_search = "SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', b.no_ic 'no_ic', a.id_fingerprint 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', d.no_ic 'no_ic', c.id_fingerprint 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID";
    }
    if($id_device == 2 ) {
        $sql_search = "SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', b.no_ic 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', d.no_ic 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID";
    }
    else{
        $sql_search = "SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', b.no_ic 'id_fingerprint' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_datapegawai='$id' AND a.id_pegawai=b.id_data
                             UNION SELECT d.nama_penuh 'nama_penuh', c.jawatan 'jawatan', d.no_ic 'id_fingerprint' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_datapegawai='$id' AND c.id_pegawai2=d.ID";
    }
    $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
        <tr>
            <th colspan="2" align="center"><br />
                <div align="center">
                    JADUAL BERTUGAS <?php echo strtoupper($jawatan); ?> <br>
                    <?php echo $data_masjid['nama_masjid']; ?><br>
                    <?php echo strtoupper($tarikh_jadual); ?>

                </div><br />
            </th>
        </tr>
    </table><br />
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2" style="display:none"><div align="center">Bil</div></th>
            <th rowspan="2" width="15%"><div align="center">Tarikh</div></th>
            <th colspan="5"><div align="center">Jadual <?php echo $jawatan; ?> Bertugas</div></th>
        </tr>
        <tr>
            <?php
            $sql_waktu = "SELECT a.perkara 'Perkara' FROM sej6x_data_perkarakehadiran a";
            $result2 = mysqli_query($bd2, $sql_waktu) or die ("Error :".mysqli_error($bd2));
            ?>
            <?php while($row = mysqli_fetch_assoc($result2)){ ?>
                <th><div align="center"><?php echo $row['Perkara']; ?></div></th>
            <?php } ?>
        </tr>
        </thead>

        <tbody>
        <?php



        $i = 1;
        do {
            $z=mktime(00, 00, 00, $bulan3, $i, $tahun);
            $namahari = date("w", $z);
            $namahari2 = date("D", $z);
            $tarikh = date("Y-m-d",$z);

            ?>

            <?php $x=1; ?>

            <tr>
                <td style="display:none"><?php echo $x; ?></td>
                <td align="center"><?php echo $tarikh; ?></td>
                <?php
                $sqljadual = "SELECT a.id_pegawai 'id_pegawai', a.id_pegawai2 'id_pegawai2', a.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid a, sej6x_data_jadual b WHERE b.id_pegawai=a.id_datapegawai AND b.id_masjid='$id_masjid' AND b.jawatan='$jawatan' AND b.tarikh='$tarikh' AND b.solat='Subuh'";
                $query_jadual = mysqli_query($bd2, $sqljadual);
                $row_jadual=mysqli_num_rows($query_jadual);
                $data_jadual = mysqli_fetch_array($query_jadual);

                $id_pegawai = $data_jadual['id_pegawai'];
                $id_pegawai2 = $data_jadual['id_pegawai2'];
                $id_datapegawai = $data_jadual['id_datapegawai'];
                if($id_pegawai!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_pegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else if($id_pegawai2!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_pegawai2'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else{
                    $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_datapegawai='$id_datapegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                $data2 = mysqli_fetch_array($sqlquery2);
                echo "<td align='center'>".$data2['nama_penuh']."</td>";
                ?>
                <?php
                $sqljadual = "SELECT a.id_pegawai 'id_pegawai', a.id_pegawai2 'id_pegawai2', a.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid a, sej6x_data_jadual b WHERE b.id_pegawai=a.id_datapegawai AND b.id_masjid='$id_masjid' AND b.jawatan='$jawatan' AND b.tarikh='$tarikh' AND b.solat='Zohor'";
                $query_jadual = mysqli_query($bd2, $sqljadual);
                $row_jadual=mysqli_num_rows($query_jadual);
                $data_jadual = mysqli_fetch_array($query_jadual);

                $id_pegawai = $data_jadual['id_pegawai'];
                $id_pegawai2 = $data_jadual['id_pegawai2'];
                $id_datapegawai = $data_jadual['id_datapegawai'];
                if($id_pegawai!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_pegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else if($id_pegawai2!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_pegawai2'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else{
                    $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_datapegawai='$id_datapegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                $data2 = mysqli_fetch_array($sqlquery2);
                echo "<td align='center'>".$data2['nama_penuh']."</td>";
                ?>
                <?php
                $sqljadual = "SELECT a.id_pegawai 'id_pegawai', a.id_pegawai2 'id_pegawai2', a.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid a, sej6x_data_jadual b WHERE b.id_pegawai=a.id_datapegawai AND b.id_masjid='$id_masjid' AND b.jawatan='$jawatan' AND b.tarikh='$tarikh' AND b.solat='Asar'";
                $query_jadual = mysqli_query($bd2, $sqljadual);
                $row_jadual=mysqli_num_rows($query_jadual);
                $data_jadual = mysqli_fetch_array($query_jadual);

                $id_pegawai = $data_jadual['id_pegawai'];
                $id_pegawai2 = $data_jadual['id_pegawai2'];
                $id_datapegawai = $data_jadual['id_datapegawai'];
                if($id_pegawai!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_pegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else if($id_pegawai2!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_pegawai2'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else{
                    $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_datapegawai='$id_datapegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                $data2 = mysqli_fetch_array($sqlquery2);
                echo "<td align='center'>".$data2['nama_penuh']."</td>";
                ?>
                <?php
                $sqljadual = "SELECT a.id_pegawai 'id_pegawai', a.id_pegawai2 'id_pegawai2', a.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid a, sej6x_data_jadual b WHERE b.id_pegawai=a.id_datapegawai AND b.id_masjid='$id_masjid' AND b.jawatan='$jawatan' AND b.tarikh='$tarikh' AND b.solat='Maghrib'";
                $query_jadual = mysqli_query($bd2, $sqljadual);
                $row_jadual=mysqli_num_rows($query_jadual);
                $data_jadual = mysqli_fetch_array($query_jadual);

                $id_pegawai = $data_jadual['id_pegawai'];
                $id_pegawai2 = $data_jadual['id_pegawai2'];
                $id_datapegawai = $data_jadual['id_datapegawai'];
                if($id_pegawai!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_pegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else if($id_pegawai2!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_pegawai2'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else{
                    $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_datapegawai='$id_datapegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                $data2 = mysqli_fetch_array($sqlquery2);
                echo "<td align='center'>".$data2['nama_penuh']."</td>";
                ?>
                <?php
                $sqljadual = "SELECT a.id_pegawai 'id_pegawai', a.id_pegawai2 'id_pegawai2', a.id_datapegawai 'id_datapegawai' FROM data_pegawai_masjid a, sej6x_data_jadual b WHERE b.id_pegawai=a.id_datapegawai AND b.id_masjid='$id_masjid' AND b.jawatan='$jawatan' AND b.tarikh='$tarikh' AND b.solat='Isya'";
                $query_jadual = mysqli_query($bd2, $sqljadual);
                $row_jadual=mysqli_num_rows($query_jadual);
                $data_jadual = mysqli_fetch_array($query_jadual);

                $id_pegawai = $data_jadual['id_pegawai'];
                $id_pegawai2 = $data_jadual['id_pegawai2'];
                $id_datapegawai = $data_jadual['id_datapegawai'];
                if($id_pegawai!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_pegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else if($id_pegawai2!=NULL)
                {
                    $sql2 = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id_pegawai2'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                else{
                    $sql2 = "SELECT * FROM data_pegawai_masjid WHERE id_datapegawai='$id_datapegawai'";
                    $sqlquery2 = mysqli_query($bd2,$sql2);
                }
                $data2 = mysqli_fetch_array($sqlquery2);
                echo "<td align='center'>".$data2['nama_penuh']."</td>";
                ?>
            </tr>

            <?php $i++; } while ($i <= $hari);




        ?>

        </tbody>

    </table>

</div>
</div>
</body>
</html>
<!-- /.table-responsive -->
