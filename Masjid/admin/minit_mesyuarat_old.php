<?php
include("connection/connection.php");
$id_mesyuarat = $_GET['id_mesyuarat'];
$query_list_nama = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_masjid = $id_masjid AND a.id_ajk=b.id_data ORDER BY nama_penuh ASC";
	$list_nama = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
	$list_nama2 = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
	$list_nama3 = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
	$list_nama4 = mysqli_query($bd2, $query_list_nama) or die(mysqli_error($bd2));
	$row_list_nama = mysqli_fetch_assoc($list_nama);
	$row_list_nama2 = mysqli_fetch_assoc($list_nama2);
	$row_list_nama3 = mysqli_fetch_assoc($list_nama3);
	$row_list_nama4 = mysqli_fetch_assoc($list_nama4);
	
$query_list_mesyuarat = "SELECT minit_mesyuarat.*, data_ajkmasjid.nama_penuh FROM minit_mesyuarat, data_ajkmasjid WHERE minit_mesyuarat.id_masjid = $id_masjid AND minit_mesyuarat.id_mesyuarat = $id_mesyuarat AND minit_mesyuarat.id_disediakan = data_ajkmasjid.id_dataajk AND minit_mesyuarat.id_disemak = data_ajkmasjid.id_dataajk AND minit_mesyuarat.id_disahkan = data_ajkmasjid.id_dataajk ORDER BY minit_mesyuarat.tarikh DESC, masa DESC";
$query_list_hadir = "SELECT * FROM kehadiran_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat AND jenis_kehadiran = 1 ORDER BY nama ASC";
$query_list_hadir2 = "SELECT * FROM kehadiran_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat AND jenis_kehadiran = 2 ORDER BY nama ASC";
$query_list_hadir3 = "SELECT * FROM kehadiran_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat AND jenis_kehadiran = 3 ORDER BY nama ASC";
$query_list_perkara = "SELECT * FROM perkara_mesyuarat WHERE id_masjid = $id_masjid AND id_mesyuarat = $id_mesyuarat ORDER BY id_perkara ASC";
	?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Borang Minit Mesyuarat</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Borang Minit Mesyuarat</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
<form name="add_khairat" id="add_khairat" method="post" enctype="multipart/form-data" action="admin/add_mesyuarat.php">
<div class="row">
  <div class="col-lg-12">
    <div class="card">
       <div class="card-header">Maklumat Minit Mesyuarat</div>
       <div class="card-body">
          <div class="col-lg-12">
          <div class="form-group">
              <label>* Perkara (Tajuk):</label>
              <input name="id_mesyuarat" id="id_mesyuarat" type="hidden" value="" /><input class="form-control" id="tajuk" name="tajuk" required>  
          </div>
          </div>
          <div class="col-lg-12">
          <div class="form-group">
              <label>No Rujukan Mesyuarat (Jika Ada):</label>
              <input class="form-control" id="no_rujukan" name="no_rujukan">  
          </div>
          </div>
          <div class="col-lg-4">
			  <div class="form-group">
              <label>* Tarikh: </label>
              <input class="form-control" id="tarikh" name="tarikh" type="date" required>                
              </div>
           </div>
		  <div class="col-lg-4">
              <div class="form-group">
              <label>* Masa Mula: </label>
              <input class="form-control" type="time" id="masa" name="masa" required>  
              </div>
           </div>
           <div class="col-lg-4">
			  <div class="form-group">
              <label>Masa Tamat: </label>
              <input class="form-control" type="time" id="masa_tamat" name="masa_tamat">  
              </div>
           </div>
           <div class="col-lg-12">
            <div class="form-group">
              <label>* Tempat: </label>
             <input class="form-control" id="tempat" name="tempat">                
            </div>                       
            </div>
            <div class="col-lg-6">
			  <div class="form-group">
              <label>* Disediakan oleh: </label>
              <select class="form-control" name="disediakan" id="disediakan" required>
                <option>Pilih Nama:-</option>
                <?php do { ?>
                <option value="<?php echo($row_list_nama['id_dataajk']); ?>"><?php echo($row_list_nama['nama_penuh']); ?></option>
                <?php } while($row_list_nama = mysqli_fetch_assoc($list_nama)); ?>              
              </select>                
              </div>
           </div>
		  <div class="col-lg-6">
              <div class="form-group">
              <label>* Disemak oleh: </label>
              <select class="form-control" name="disemak" id="disemak" required>
                <option>Pilih Nama:-</option>
                <?php do { ?>
                <option value="<?php echo($row_list_nama2['id_dataajk']); ?>"><?php echo($row_list_nama2['nama_penuh']); ?></option>
                <?php } while($row_list_nama2 = mysqli_fetch_assoc($list_nama2)); ?>              
              </select>  
              </div>
           </div>
           <div class="col-lg-12">
			  <div class="form-group"><div align="center">
              <label>* Disahkan oleh: </label>
              <select class="form-control" name="disahkan" id="disahkan" required>
                <option>Pilih Nama:-</option>
                <?php do { ?>
                <option value="<?php echo($row_list_nama3['id_dataajk']); ?>"><?php echo($row_list_nama3['nama_penuh']); ?></option>
                <?php } while($row_list_nama3 = mysqli_fetch_assoc($list_nama3)); ?>              
              </select>
              </div>
              </div>
           </div>
           </div>
          </div>
          </div>   
   			 <!-- /.col-lg-6 (nested) -->
       </div>
             <!-- /.row (nested) -->

<div class="row">
  <div class="col-lg-12">
    <div class="card">
       <div class="card-header">* Kehadiran AJK</div>
       <div class="card-body">
       <div class="row">
		  <div class="col-lg-1"><div class="form-group"><label><div align="center">Bil</div></label></div></div>
          <div class="col-lg-5"><div class="form-group"><label><div align="center">Nama</div></label></div></div>      
		  <div class="col-lg-3"><div class="form-group"><label><div align="center">Jawatan</div></label></div></div>
          <div class="col-lg-2"><div class="form-group"><label><div align="center">Kehadiran</div></label></div></div>
       </div>
       <?php $i = 1; while($row_list_nama4 = mysqli_fetch_assoc($list_nama4)) { ?>
       <div class="row">
          <div class="col-lg-1"><div class="form-group"><?php echo($i); ?></div></div>
          <div class="col-lg-5"><div class="form-group"><input name="nama_kehadiran[]" type="hidden" value="<?php echo($row_list_nama4['nama_penuh']); ?>" /><?php echo($row_list_nama4['nama_penuh']); ?></div></div>      
		  <div class="col-lg-3"><div class="form-group"><input name="jawatan_kehadiran[]" type="hidden" value="<?php echo($row_list_nama4['jawatan']); ?>" /><?php echo($row_list_nama4['jawatan']); ?></div></div>
          <div class="col-lg-1"><div class="form-group"><input name="tanda_kehadiran[]" type="checkbox" value="1" checked="checked" /><input name="jenis_kehadiran[]" type="hidden" value="1" /><input name="id_ajk[]" type="hidden" value="<?php echo($row_list_nama4['id_dataajk']); ?>" /><input name="id_kehadiran[]" type="hidden" value="<?php echo($row_list_hadir['id_kehadiran']); ?>" /></div></div>
       </div>
       <?php $i++; } ?>
       </div>
     </div>
   </div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				Turut Hadir (Jemputan)
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="table_turut">
					<tr>
						<th width="5%"><div align="center">#</div></th>
						<th width="50%"><div align="center">Nama</div></th>
						<th width="35%"><div align="center">Jawatan</div></th>
						<th width="10%"><div align="center"><button type="button" class="btn btn-success" name="add" id="add_input" onClick="insertTurut()" >Tambah</button></div></th>
					</tr>
				</table>
				<!-- <div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label><div align="center">Nama</div></label>
						</div>
					</div>      
					<div class="col-lg-4">
						<div class="form-group">
							<label><div align="center">Jawatan</div></label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<div align="center">
								<button type="button" name="add" id="add_input" onClick="insertTurut()" >Tambah</button>
							</div>
						</div>
					</div>
				</div>
				<div id="borang_dinamik">
				</div> -->
			</div>
			<!-- <div id="borang_dinamik_delete2">
			</div> -->
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				Urusetia (Jika berkenaan)
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="table_urusetia">
					<tr>
						<th width="5%"><div align="center">#</div></th>
						<th width="50%"><div align="center">Nama</div></th>
						<th width="35%"><div align="center">Jawatan</div></th>
						<th width="10%"><div align="center"><button type="button" class="btn btn-success" name="add2" id="add_input2" onClick="insertUrusetia()" >Tambah</button></div></th>
					</tr>
				</table>
				<!-- <div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label><div align="center">Nama</div></label>
						</div>
					</div>      
					<div class="col-lg-4">
						<div class="form-group">
							<label><div align="center">Jawatan</div></label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<div align="center">
								<button type="button" name="add2" id="add_input2">Tambah</button>
							</div>
						</div>
					</div>
				</div>
				<div id="borang_dinamik2">
				</div> -->
			</div>    
			<!-- <div id="borang_dinamik_delete2"></div> -->
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				Agenda Mesyuarat
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="table_agenda">
					<tr>
						<th width="5%"><div align="center">#</div></th>
						<th width="28%"><div align="center">Tajuk</div></th>
						<th width="28%"><div align="center">Pekara/Isu</div></th>
						<th width="28%"><div align="center">Status Tindakan</div></th>
						<th width="10%"><div align="center"><button type="button" class="btn btn-success" name="add3" id="add_input3" onClick="insertAgenda()" >Tambah</button></div></th>
					</tr>
				</table>
				<!-- <div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label><div align="center">Perkara / Isu</div></label>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label><div align="center">Tanggungjawab</div></label>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label><div align="center">Status Tindakan</div></label>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<div align="center">
								<button type="button" name="add3" id="add_input3">Tambah</button>
							</div>
						</div>
					</div>
				</div>
				<div id="borang_dinamik3">
				</div> -->
			</div>
		    <!-- <div id="borang_dinamik_delete4"></div> -->
		</div>
	</div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
       <div class="card-body">
       		<div class="col-lg-12"><div align="center">
            <input name="id_masjid" id="id_masjid" type="hidden" value="<?php echo $id_masjid; ?>" />
            <input type="submit" class="btn btn-primary" value="Simpan" />
 		    <input type="reset" class="btn btn-primary" value="Padam" />
            </div>
           </div>
       </div>
     </div>
   </div>
</div>
</div>
</form>
<script type="text/javascript" id="dinamik_sekerip2" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript" id="dinamik_sekerip3" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript" id="dinamik_sekerip">
function insertTurut(){
	var table=document.getElementById("table_turut");
	var row=table.insertRow(table.rows.length);
	var bil=(table.rows.length)-1;
	var cell1=row.insertCell(0);
	cell1.style.textAlign="center";
	cell1.innerHTML = bil;
	
	cell1=row.insertCell(1);
	cell1.innerHTML = "<input name='id_kehadiran2[]' type='hidden' value='' /><input name='jenis_kehadiran2[]' type='hidden' value='2' /><input class='form-control' name='nama_jemputan[]' type='text' required />";

	cell1=row.insertCell(2);
	cell1.innerHTML = "<input class='form-control' name='jawatan_jemputan[]' type='text' />";

	cell1=row.insertCell(3);
	cell1.innerHTML = "<button class='btn btn-danger btn_remove'onclick='removeTurut(this);'>x</button>"; 
}
function removeTurut(src){
	var oRow = src.parentElement.parentElement;  
	document.all("table_turut").deleteRow(oRow.rowIndex);
}
function insertUrusetia(){
	var table=document.getElementById("table_urusetia");
	var row=table.insertRow(table.rows.length);
	var bil=(table.rows.length)-1;
	var cell1=row.insertCell(0);
	cell1.style.textAlign="center";
	cell1.innerHTML = bil;
	
	cell1=row.insertCell(1);
	cell1.innerHTML = "<input name='id_kehadiran3[]' type='hidden' value='' /><input name='jenis_kehadiran3[]' type='hidden' value='3' /><input class='form-control' name='nama_urusetia[]' type='text' required />";

	cell1=row.insertCell(2);
	cell1.innerHTML = "<input class='form-control' name='jawatan_urusetia[]' type='text' />";

	cell1=row.insertCell(3);
	cell1.innerHTML = "<button class='btn btn-danger btn_remove'onclick='removeUrusetia(this);'>x</button>"; 
}
function removeUrusetia(src){
	var oRow = src.parentElement.parentElement;  
	document.all("table_urusetia").deleteRow(oRow.rowIndex);
}
function insertAgenda(){
	var table=document.getElementById("table_agenda");
	var row=table.insertRow(table.rows.length);
	var bil=(table.rows.length)-1;
	var cell1=row.insertCell(0);
	cell1.style.textAlign="center";
	cell1.innerHTML = bil;
	
	cell1=row.insertCell(1);
	cell1.innerHTML = "<input name='id_perkara[]' type='hidden' value='' /><textarea name='tajuk[]' rows='5' required class='form-control'></textarea>";

	cell1=row.insertCell(2);
	cell1.innerHTML = "<textarea name='perkara_isu[]' rows='5' required class='form-control'></textarea>";
	
	cell1=row.insertCell(3);
	cell1.innerHTML = "<textarea name='status_tindakan[]' rows='5' class='form-control'></textarea>";

	cell1=row.insertCell(4);
	cell1.innerHTML = "<button class='btn btn-danger btn_remove'onclick='removeAgenda(this);'>x</button>"; 
}
function removeAgenda(src){
	var oRow = src.parentElement.parentElement;  
	document.all("table_agenda").deleteRow(oRow.rowIndex);
}

 $(document).ready(function(){
 var i=1;
 $('#add_input').click(function(){
 i++;
 $('#borang_dinamik').append('<div id="row'+i+'" class="row"><div class="col-lg-6"><div class="form-group"><input name="id_kehadiran2[]" type="hidden" value="" /><input name="jenis_kehadiran2[]" type="hidden" value="2" /><input class="form-control" name="nama_jemputan[]" type="text" required /></div></div><div class="col-lg-4"><div class="form-group"><input class="form-control" name="jawatan_jemputan[]" type="text" /></div></div><div class="col-lg-2"><div class="form-group"><button type="button" name="remove" id="'+i+'" class="btn_remove">Padam</button></div></div>');
 
 });
 $(document).on('click', '.btn_remove', function(){
 var button_id = $(this).attr("id");
 $('#row'+button_id+'').remove();
 });
 
 $('#submit').click(function(){
 $.ajax({
 url:"admin/add_khairat.php?tambah=1",
 method:"POST",
 data:$('#add_khairat').serialize(),
 success: function(data)
 {
 alert(data);
 $('#add_khairat')[0].reset();
 }
 });
 });
}); 

$(document).ready(function(){
 var i=1;
 $('#add_input2').click(function(){
 i++;
 $('#borang_dinamik2').append('<div id="row2'+i+'" class="row"><div class="col-lg-6"><div class="form-group"><input name="id_kehadiran3[]" type="hidden" value="" /><input name="jenis_kehadiran3[]" type="hidden" value="3" /><input class="form-control" name="nama_urusetia[]" type="text" required /></div></div><div class="col-lg-4"><div class="form-group"><input class="form-control" name="jawatan_urusetia[]" type="text" /></div></div><div class="col-lg-2"><div class="form-group"><button type="button" name="remove2" id="'+i+'" class="btn_remove2">Padam</button></div></div>');
 
 });
 $(document).on('click', '.btn_remove2', function(){
 var button_id = $(this).attr("id");
 $('#row2'+button_id+'').remove();
 });
 
 $('#submit').click(function(){
 $.ajax({
 url:"admin/add_khairat.php?tambah=1",
 method:"POST",
 data:$('#add_khairat').serialize(),
 success: function(data)
 {
 alert(data);
 $('#add_khairat')[0].reset();
 }
 });
 });
});

$(document).ready(function(){
 var i=1;
 $('#add_input3').click(function(){
 i++;
 $('#borang_dinamik3').append('<div id="row3'+i+'" class="row"><div class="col-lg-4"><div class="form-group"><input name="id_perkara[]" type="hidden" value="" /><textarea name="perkara_isu[]" rows="5" required class="form-control"></textarea></div></div><div class="col-lg-3"><div class="form-group"><textarea name="tanggungjawab[]" rows="5" required class="form-control"></textarea></div></div><div class="col-lg-3"><div class="form-group"><textarea name="status_tindakan[]" rows="5" class="form-control"></textarea></div></div><div class="col-lg-2"><div class="form-group"><button type="button" name="remove3" id="'+i+'" class="btn_remove3">Padam</button></div></div>');
 
 });
 $(document).on('click', '.btn_remove3', function(){
 var button_id = $(this).attr("id");
 $('#row3'+button_id+'').remove();
 });
 
 $('#submit').click(function(){
 $.ajax({
 url:"admin/add_khairat.php?tambah=1",
 method:"POST",
 data:$('#add_khairat').serialize(),
 success: function(data)
 {
 alert(data);
 $('#add_khairat')[0].reset();
 }
 });
 });
});

$("#add_khairat").validate();
</script>