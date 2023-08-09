<?php

	include("connection/connection.php"); 

	//untuk sql negeri
	$sql_negeri="SELECT id_negeri,name FROM negeri"; 
	$result1 = mysqli_query($bd2,$sql_negeri) or die ("Error :".mysqli_error($bd2));

	$options1 = $options1."<option>Sila Pilih Negeri</option>";  
	while($row1=mysqli_fetch_array($result1))
	{

	$options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
	}

	//untuk sql daerah
	$sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='$id_negeri'"; 
	$result2=mysqli_query($bd2,$sql_daerah) or die ("Error :".mysqli_error($bd2));

	$options3 = $options3."<option>Sila Pilih Daerah</option>";  
	while($row2=mysqli_fetch_array($result2))
	{
	$options4=$options4."<option value='$row2[id_daerah]'>$row2[nama_daerah]</option>";
	}
?>
<?php
$sql = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
$list_ajk = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
?>
<?php
//$sqll = "SELECT id_jenisinventori,jenis_inventori FROM sej6x_data_jenisinventori WHERE id_masjid= '0' OR id_masjid= '$id_masjid' ";
//$list_peralatan = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
//?>
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
                    <form method="POST" action="admin/add_selenggara.php" name="selenggara">
                        <div class="row">
                            <div class="col-lg-6">
                            <!-- kategori penyelenggara & nama penyelenggara-->
                                <div class="form-group">
                                    <label>Kategori Penyelenggara</label>
                                    <select class="form-control" name="kat_penyelenggara" id="kat_penyelenggara" onchange="showForm1()">
                                        <option value="">Sila Pilih</option>
                                        <option value="masjid">Masjid</option>
                                        <option value="vendor">Vendor</option>
                                    </select>
                                </div>
                                <!--Bila select akan display maklumat untuk isi nama-->
                                <!--MASJID-->
                                <div id="masjid-form" style="display: none" class="form-group">
                                    <label>Nama Penyelenggara</label>
                                    <select class="form-control" name="nama_ajkmasjid" id="nama_ajkmasjid" >
                                        <option value="">Sila Pilih Pegawai</option>
                                        <?php
                                        while($row_list_ajk = mysqli_fetch_assoc($list_ajk))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_ajk['nama_penuh']); ?>"><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--VENDOR-->
                                <div id="vendor-form" style="display: none" class="form-group">
                                    <label>Nama Penyelenggara</label></br>
                                    <input type="text" name="nama_vendor" id="nama_vendor" placeholder="Sila masukkan nama penyelenggara" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <!--Jenis Peralatan-->
                                <div class="form-group">
                                    <label>Kategori Peralatan</label>
                                    <select class="form-control" name="jenis_peralatan" id="jenis_peralatan" onchange="toggleInput(this)" disabled>
<!--                                        <option value="">Sila Pilih Kategori Peralatan</option>-->
<!--                                        --><?php
//                                        while($row_list_peralatan = mysqli_fetch_assoc($list_peralatan))
//                                        {
//                                            ?>
<!--                                            <option value="--><?php //echo($row_list_peralatan['id_jenisinventori']); ?><!--">--><?php //echo strtoupper($row_list_peralatan['jenis_inventori']); ?><!--</option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
<!--                                        <option value="other">Lain-Lain</option>-->
                                    </select>
                                </div>
                                <!--Bila select Lain-lain keluar div -->
                                <div id="inputContainer" class="form-group" style="display: none">
                                    <label for="otherInput">Sila masukkan kategori</label></br>
                                    <input type="text" class="form-control" name="otherInput" id="otherInput" oninput="this.value = this.value.toUpperCase()">
                                </div>

<!--                                <div class="form-group">-->
<!--                                    <label for="kat_peralatan">Kategori Peralatan<span class="help"></span></label>-->
<!--                                    <select id="kat_peralatan" name="kat_peralatan[]" class="" style="width: 100%" multiple="multiple">-->
<!--                                        <option value=""></option>-->
<!--                                        --><?php
//                                        while($row_list_peralatan = mysqli_fetch_assoc($list_peralatan))
//                                        {
//                                            ?>
<!--                                            <option value="--><?php //echo($row_list_peralatan['jenis_inventori']); ?><!--">--><?php //echo($row_list_peralatan['jenis_inventori']); ?><!--</option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>-->
                            </div>
                            <div class="col-lg-6">
                                <!-- no telefon-->
                                <div class="form-group">
                                    <label>No Telefon Penyelenggara</label>
                                    <input class="form-control" name="no_telefon" id="no_telefon" maxlength="12" disabled>
                                </div>
                                <!-- tempoh perkhidmatan-->
                                <div class="form-group">
                                    <label>Tempoh Perkhidmatan</label>
                                    <select class="form-control" name="tempoh_perkhidmatan" id="tempoh_perkhidmatan" required>
                                        <option readonly>Sila Pilih Tempoh Perkhidmatan</option>
                                        <option value="1">Satu Tahun</option>
                                        <option value="2">Dua Tahun</option>
                                        <option value="0">Tiada Tempoh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12" align="center">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-danger">Set Semula</button>
                            </div>
                        </div>
                        <!-- /.row (nested) -->
                    </form>
				</div>    
			</div>
		</div>
	</div>
</div>
<script>
    function showForm1() {
        var selectBox = document.getElementById("kat_penyelenggara");
        var selectedOption = selectBox.options[selectBox.selectedIndex].value;

        document.getElementById("masjid-form").style.display = "none";
        document.getElementById("vendor-form").style.display = "none";


        if (selectedOption === "masjid") {
            document.getElementById("masjid-form").style.display = "block";
        } else {
            document.getElementById("vendor-form").style.display = "block";
        }
    }
</script>
<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        $('.multiselect').multiselect({-->
<!--            nonSelectedText: 'Sila Pilih Kategori',-->
<!--            includeSelectAllOption: true-->
<!--        });-->
<!--    });-->
<!--</script>-->
<!--<script>-->
<!--    $(function () {-->
<!---->
<!--        // For select 2-->
<!--        $("#kat_peralatan").select2({-->
<!--            placeholder: 'Sila pilih kategori peralatan'-->
<!--        });-->
<!---->
<!--        // For multiselect-->
<!--        $('#pre-selected-options').multiSelect();-->
<!--        $('#optgroup').multiSelect({-->
<!--            selectableOptgroup: true-->
<!--        });-->
<!--        $('#public-methods').multiSelect();-->
<!--        $('#select-all').click(function () {-->
<!--            $('#public-methods').multiSelect('select_all');-->
<!--            return false;-->
<!--        });-->
<!--        $('#deselect-all').click(function () {-->
<!--            $('#public-methods').multiSelect('deselect_all');-->
<!--            return false;-->
<!--        });-->
<!--        $('#refresh').on('click', function () {-->
<!--            $('#public-methods').multiSelect('refresh');-->
<!--            return false;-->
<!--        });-->
<!--        $('#add-option').on('click', function () {-->
<!--            $('#public-methods').multiSelect('addOption', {-->
<!--                value: 42,-->
<!--                text: 'test 42',-->
<!--                index: 0-->
<!--            });-->
<!--            return false;-->
<!--        });-->
<!--        $(".ajax").select2({-->
<!--            ajax: {-->
<!--                url: "https://api.github.com/search/repositories",-->
<!--                dataType: 'json',-->
<!--                delay: 250,-->
<!--                data: function (params) {-->
<!--                    return {-->
<!--                        q: params.term, // search term-->
<!--                        page: params.page-->
<!--                    };-->
<!--                },-->
<!--                processResults: function (data, params) {-->
<!--                    // parse the results into the format expected by Select2-->
<!--                    // since we are using custom formatting functions we do not need to-->
<!--                    // alter the remote JSON data, except to indicate that infinite-->
<!--                    // scrolling can be used-->
<!--                    params.page = params.page || 1;-->
<!--                    return {-->
<!--                        results: data.items,-->
<!--                        pagination: {-->
<!--                            more: (params.page * 30) < data.total_count-->
<!--                        }-->
<!--                    };-->
<!--                },-->
<!--                cache: true-->
<!--            },-->
<!--            escapeMarkup: function (markup) {-->
<!--                return markup;-->
<!--            }, // let our custom formatter work-->
<!--            minimumInputLength: 1,-->
<!--            //templateResult: formatRepo, // omitted for brevity, see the source of this page-->
<!--            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page-->
<!--        });-->
<!--    });-->
<!--</script>-->
<script>
    function toggleInput(selectBox) {
        var otherInput = document.getElementById("otherInput");

        if (selectBox.value === "other") {
            document.getElementById("inputContainer").style.display = "block";
            otherInput.value = "";
        } else {
            document.getElementById("inputContainer").style.display = "none";
        }
    }
</script>
<script>

    $(document).ready(function() {
        $('#kat_penyelenggara').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption !== '') {
                // Make an AJAX request to retrieve the options for the dynamic select box
                $.ajax({
                    url: './admin/ajax_daftarselenggara.php',
                    type: 'POST',
                    data: { "option": selectedOption },
                    // contentType: "application/json;charset=utf-8",
                    // dataType: "json",
                    success: function(response) {
                        // Assuming the response is an array of options
                        console.log(response);
                        var options = JSON.parse(response);

                        // Clear the dynamic select box
                        $('#jenis_peralatan').empty();

                        // Add the new options
                        $('#jenis_peralatan').append('<option value="">Sila Pilih Kategori Peralatan</option>'); // Empty option

                        for (var i = 0; i < options.length; i++) {
                            var optionValue = options[i].value;
                            var optionLabel = options[i].value2;

                            var displayLabel = '';


                            $('#jenis_peralatan').append('<option value="' + optionValue + '">' + optionLabel + '</option>');
                        }

                        $('#jenis_peralatan').append('<option value="other">Lain-Lain</option>');

                        $('#jenis_peralatan').prop('disabled', false);
                        // Show the dynamic select box
                        // $('#namaPenyelenggaraDiv').show();
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Handle the error appropriately
                    }
                });
            } else {
                // Hide the dynamic select box if no option is selected
                // $('#namaPenyelenggaraDiv').hide();
            }
        });

        $('#nama_ajkmasjid').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption !== '') {
                // Make an AJAX request to retrieve the options for the dynamic select box
                $.ajax({
                    url: './admin/ajax_daftarselenggara2.php',
                    type: 'POST',
                    data: { "option": selectedOption },
                    // contentType: "application/json;charset=utf-8",
                    // dataType: "json",
                    success: function(response) {
                        // Assuming the response is an array of options
                        console.log(response);
                        var options = JSON.parse(response);

                        // Clear the dynamic select box
                        $('#no_telefon').empty();


                        for (var i = 0; i < options.length; i++) {
                            var optionValue = options[i].value;

                            var displayLabel = '';

                            console.log(optionValue);
                            $('#no_telefon').val(optionValue);
                        }

                        $('#no_telefon').prop('disabled', false);
                        // Show the dynamic select box
                        // $('#namaPenyelenggaraDiv').show();
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Handle the error appropriately
                    }
                });
            } else {
                // Hide the dynamic select box if no option is selected
                // $('#namaPenyelenggaraDiv').hide();
            }
        });
    });
</script>
