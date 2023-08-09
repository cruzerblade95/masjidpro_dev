<script>
function showAhli(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
				eval(document.getElementById("dinamik_sekerip").innerHTML);
				eval(document.getElementById("dinamik_sekerip2").innerHTML);
				eval(document.getElementById("dinamik_sekerip3").innerHTML);
            }
        };
        xmlhttp.open("GET","admin/ajax_khairat.php?id_data=<?php echo($_GET['id_data']); ?>&id_pakej="+str,true);
        xmlhttp.send();
    }
}

function padamKhairat(a) {
	document.getElementById('borang_dinamik_delete').innerHTML += '<input type="hidden" name="id_khairat_padam[]" value="'+a+'" />'
}

</script>
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BUTIRAN KHAIRAT</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Khairat</div>
							
                             <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];

						  $sql_search="SELECT 
						  id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp
						  FROM sej6x_data_peribadi WHERE id_data='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    
                        <div class="panel-body">
                        <div class="row"> 
                        
                  <form name="add_khairat" id="add_khairat" method="post" enctype="multipart/form-data" action="admin/add_khairat.php">
                               
					    <?php while($row = mysql_fetch_assoc($result)){ $id_data = $row['id_data']; ?> 
                        
                    <div class="col-lg-12">
                              <div class="form-group">
                                            <label>Nama Ahli Khairat:</label> <?php echo $row['nama_penuh'];?>
                                          </div>
                                        </div>
                                       
                                        
                    <div class="col-lg-12">
                              <div class="form-group">
                                            <label>No K/P:</label> <?php echo $row['no_ic'];?>
                      </div>
                              </div>
                              <?php }?>
                       <div class="col-lg-12">      
   					 <div class="alert alert-info">
                      <label>NOTA:</label>
                      <label>Maklumat ahli keluarga yang akan dilindungi!</label>      
                      <label>Isteri/Suami dan anak-anak yang belum berkahwin sahaja(Asas), Ibu/Bapa(Premium), Ibu/Bapa mertua(Premium)</label>
                            </div>
                             </div>	   
                           
                         <div class="col-lg-12">
                        <div class="form-group">
                                            <label>Pakej</label>
                                            <select class="form-control" name="pakej2" id="pakej2" onchange="showAhli(this.value)">
                                                <option value="0">Sila Pilih Pakej</option>
                                                <option value="1">Biasa(Asas)- RM90</option>
                                                <option value="2">Biasa(Premium)- RM150</option>
                                                <option value="3">Biasa(Premium Plus)- RM190</option>
                                                <option value="4">W.Emas/Ibu Tunggal/OKU(Asas)- RM60</option>
                                                <option value="5">W.Emas/Ibu Tunggal/OKU(Premium)- RM120</option>
                                                <option value="6">W.Emas/Ibu Tunggal/OKU(Premium Plus)- RM160</option>
                                            </select>
 
                                        </div> 
                                        </div>     
                           
                         <hr />
                           <div class="row">
						   <br>
                           <br>
						     <div align="center"><label>Maklumat Keluarga Dilindungi: </label></div>
                               <br>
						   </div>
                           <div id="tajuk" class="row">
                           <div class="col-lg-3"><div class="form-group"><label><div align="center">Nama</div></label></div></div>                     
                            <div class="col-lg-3"><div class="form-group"><label><div align="center">Hubungan</div></label></div></div>      
							<div class="col-lg-2"><div class="form-group"><label><div align="center">Tarikh Lahir</div></label></div></div>   
                               
                            <div class="col-lg-2"> <div class="form-group"><label><div align="center">No.K/P@S.Lahir</div></label></div></div>
                            
                            <div class="col-lg-2"> <div class="form-group"><label><div align="center">Tindakkan</div></label></div></div>
                            </div>
                      <div id="txtHint">
                           
                        </div>
                        <div id="borang_dinamik_delete">

</div>
                            <div class="form-group"><br>
               
                  <input type="hidden" name="id_data" value="<?php echo $id_data; ?>">
                  <input type="hidden" id="url_back" name="url_back" value="<?php echo("../..".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']); ?>"> 
         		  <input type="hidden" name="id_masjid" value="<?php echo $id_masjid;?>">    
                  <br><center><input type="submit" value="Hantar" class="btn btn-primary" /></center>
                                        

                                    </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" id="dinamik_sekerip2" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript" id="dinamik_sekerip3" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
function selectNama()
{
	var n=document.getElementById('nama');
	if(n.value!=null){
		var dn=document.getElementById('display_nama');
		dn.style.display = 'none';
		var dm=document.getElementById('display_maklumat');
		dm.style.display = 'block';
	}
}

</script>
<script type="text/javascript" id="dinamik_sekerip">
$(document).ready(function(){
 var i=1;
 $('#add_input').click(function(){
 i++;
 $('#borang_dinamik').append('<div id="row'+i+'" class="row"><div class="col-lg-3"><div class="form-group"><input type="hidden" name="pakej[]" value="" /><input type="hidden" name="id_khairat[]" value="0" /><input class="form-control" name="nama[]" placeholder="Masukkan Nama" required></div></div><div class="col-lg-2"><div class="form-group"><select class="form-control" name="hubungan[]" required><option disabled="disabled" selected="selected" value="0">Hubungan:-</option><option value="PASANGAN">Pasangan</option><option value="ANAK">Anak</option><option value="IBU">Ibu</option><option value="BAPA">Bapa</option><option value="IBU MERTUA">Ibu Mertua</option><option value="BAPA MERTUA">Bapa Mertua</option><option value="LAIN-LAIN">Lain-lain</option></select></div></div><div class="col-lg-3"><div class="form-group"><input class="form-control" name="tarikh_lahir[]" placeholder="Masukkan Tarikh Lahir" type="date" required></div></div><div class="col-lg-2"><div class="form-group"><input class="form-control" name="no_kp[]" placeholder="Masukkan No K/P atau Sijil Lahir" maxlength="12" required></div></div><div class="col-lg-2"><div class="form-group"><button type="button" name="remove" id="'+i+'" class="btn_remove" onclick="padamKhairat(0)">-</button></div></div>');
 
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

$("#add_khairat").validate();
</script>          