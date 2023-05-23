<?php

	include('connection/connection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

   
    <title>Masjid Pro</title>
    <link rel="icon" href="picture/mosque.png">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
	

</head>

<body background="picture/wallwhite.jpg" style="background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
  <!-- background="picture/4657cee25652c4a.png" -->
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
    <div class="container" style="margin:0 auto;">
        <div class="row">
            <div class="col-lg-12" align="center">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" align="center" style="background-color:#36BFE9"> 
                        <h3 class="panel-title" ><b><br><br>
                        Masjid Pro</b></h3><br>
                    </div>


                    
                    <div class="panel-body" style="background-color:lightblue" >
                         <form name=loginform method=POST action="">
                            <fieldset>
								<!-- div class="form-group">
									<input class="form-control" placeholder="Kod Masjid" name="kod_masjid" type="text" id="kod_masjid" required>
								</div -->
                                <div class="form-group">
									<label>No Kad Pengenalan</label>
									<input class="form-control" placeholder="Contoh:985223123212" name="no_ic" type="text" id="no_ic" autofocus required>
                                </div>
                                <div class="form-group">
									<label>AJK Masjid</label>
									<select required class="selectpicker form-control" width="100%" data-show-subtext="true" data-live-search="true">
										<?php
											$sql="SELECT b.nama_penuh 'nama_penuh', a.jawatan 'jawatan', a.id_dataajk 'id_ajk' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_masjid='6279' AND a.id_ajk=b.id_data";
											$sqlquery=mysql_query($sql,$bd);
											
											while($data=mysql_fetch_array($sqlquery))
											{
											?>
											<option value="<?php echo $data['id_ajk']; ?>" data-subtext="<?php echo $data['jawatan']; ?>"><?php echo $data['nama_penuh']; ?></option>
											<?php
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Tujuan</label>
									<input type="text" name="tujuan" required class="form-control">
								</div>
								<div class="form-group">
									<label>Hari</label>
									<input type="date" name="tarikh" required class="form-control">
								</div>
								<div class="form-group">
									<label>Time</label>
									<input type="time" name="masa" required class="form-control">
								</div>
								<br>
								<div class="col-lg-6">
									<div class="form-group">
										<button class="btn btn-info btn-block">Hantar</button>
									</div>
								</div>
                            </fieldset><br>
                        </form>
						<div align="center"><b>MyRich Dynasty © | 2019</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
