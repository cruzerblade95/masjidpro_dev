<?php 

	include("connection/connection.php"); 

	//untuk sql negeri
	$sql_negeri="SELECT id_negeri,name FROM negeri"; 
	$result1 = mysqli_query($bd2,$sql_negeri) or die ("Error :".mysqli_error());

	$options1 = $options1."<option>Sila Pilih Negeri</option>";  
	while($row1=mysqli_fetch_array($result1))
	{

	$options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
	}

	//untuk sql daerah
	$sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='$id_negeri'"; 
	$result2=mysqli_query($bd2,$sql_daerah) or die ("Error :".mysqli_error());

	$options3 = $options3."<option>Sila Pilih Daerah</option>";  
	while($row2=mysqli_fetch_array($result2))
	{
	$options4=$options4."<option value='$row2[id_daerah]'>$row2[nama_daerah]</option>";
	}
?>
<?php
if($_GET['action']=="selenggara")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Borang Selenggara</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
					<li class="active">Borang Selenggara</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Maklumat Penyelenggaraan
				</div>
				<div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <center><h4>P.I.C (PERSON IN CHARGE)</h4></center>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>P.I.C (Person-In-Charge)</label>
                                <select class="form-control" name="pic" required onChange="showSelenggara(this.value)">
                                    <option value="">Sila Pilih:-</option>
                                    <option value="1">Vendor</option>
                                    <option value="2">Masjid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
					<form method="POST" action="admin/add_selenggara.php" name="selenggara">
					<div id="show_selenggara">

                    </div>
					</form>
				</div>    
			</div>
		</div>
	</div>
</div>
<script>
function showSelenggara(str) {
    if (str == "") {
        document.getElementById("show_selenggara").innerHTML = "";
        return;
    }
    else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("show_selenggara").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","admin/getselenggara.php?id_pic="+str,true);
        xmlhttp.send();
    }
}
</script>
							                        