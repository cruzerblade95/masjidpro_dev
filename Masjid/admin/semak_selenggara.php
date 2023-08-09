
<?php
$idd = $_GET['id_selenggara'];
$sqlw = "SELECT id_penyelenggara, id_masjid, kat_penyelenggara, nama_penyelenggara, kat_peralatan,
        no_telefon, tempoh_perkhidmatan FROM penyelenggara WHERE id_penyelenggara = $idd";
$result = mysqli_query($bd2, $sqlw) or die ("Error :".mysqli_error($bd2));
$row = mysqli_fetch_assoc($result);
?>
<?php
$sql = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
$list_ajk = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
?>
<?php
$sqll = "SELECT id_jenisinventori,jenis_inventori FROM sej6x_data_jenisinventori WHERE id_masjid='0' OR id_masjid='$id_masjid' ";
$list_peralatan = mysqli_query($bd2, $sqll) or die(mysqli_error($bd2));
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
                    <form method="POST" action="admin/update_selenggara.php" name="selenggara">
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- kategori penyelenggara & nama penyelenggara-->
                                <div class="form-group">
                                    <label>Kategori Penyelenggara</label>
                                    <select class="form-control" name="kat_penyelenggara" id="kat_penyelenggara" onchange="showForm1()">
                                        <option value="">Sila Pilih</option>
                                        <option value="masjid" <?php if($row['kat_penyelenggara']=='masjid') { echo "selected"; } ?>>Masjid</option>
                                        <option value="vendor" <?php if($row['kat_penyelenggara']=='vendor') { echo "selected"; } ?>>Vendor</option>
                                    </select>
                                </div>
                                <!--Bila select akan display maklumat untuk isi nama-->
                                <!--MASJID-->
                                <div id="masjid-form" style="display: none" class="form-group">
                                    <label>Nama Penyelenggara</label>
                                    <select class="form-control" name="nama_ajkmasjid" id="nama_ajkmasjid" >
                                        <option value="">Sila Pilih Pegawai</option>
                                        <?php
                                        $nama_ajkmasjid=$row['nama_penyelenggara'];
                                        while($row_list_ajk = mysqli_fetch_assoc($list_ajk))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_ajk['nama_penuh']); ?>" <?php if($nama_ajkmasjid==$row_list_ajk['nama_penuh']) { echo "selected"; } ?>><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--VENDOR-->
                                <div id="vendor-form" style="display: none" class="form-group">
                                    <label>Nama Penyelenggara</label></br>
                                    <?php $nama_vendor = $row['nama_penyelenggara']; ?>
                                    <input type="text" name="nama_vendor" id="nama_vendor" placeholder="Sila masukkan nama penyelenggara" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $nama_vendor; ?>">
                                </div>
                                <!-- kategori peralatan-->
                                <div class="form-group">
                                    <label for="kat_peralatan">Kategori Peralatan<span class="help"></span></label>
                                    <select id="kat_peralatan" name="kat_peralatan[]" class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple">
                                        <option value=""></option>
                                        <?php
                                        while($row_list_peralatan = mysqli_fetch_assoc($list_peralatan))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_peralatan['jenis_inventori']); ?>"><?php echo($row_list_peralatan['jenis_inventori']); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- no telefon-->
                                <div class="form-group">
                                    <label>No Telefon Penyelenggara</label>
                                    <input class="form-control" name="no_telefon" id="no_telefon" maxlength="12" value="<?php echo $row['no_telefon']; ?>">
                                </div>
                                <!-- tempoh perkhidmatan-->
                                <div class="form-group">
                                    <label>Tempoh Perkhidmatan</label>
                                    <select class="form-control" name="tempoh_perkhidmatan" id="tempoh_perkhidmatan" >
                                        <option value="">Sila Pilih Tempoh Perkhidmatan</option>
                                        <option value="1" <?php if($row['tempoh_perkhidmatan']==1) { echo "selected"; } ?>>Satu Tahun</option>
                                        <option value="2" <?php if($row['tempoh_perkhidmatan']==2) { echo "selected"; } ?>>Dua Tahun</option>
                                        <option value="0" <?php if($row['tempoh_perkhidmatan']==0) { echo "selected"; } ?>>Tiada Tempoh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12" align="center">
                                <input type="hidden" value="<?php echo $row['id_penyelenggara']; ?>" name="id_penyelenggara">
                                <button type="submit" class="btn btn-success">Kemaskini</button>
<!--                                <button type="reset" class="btn btn-danger">Set Semula</button>-->
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
    var selectBox = document.getElementById("kat_penyelenggara");
    var selectedOption = selectBox.value;
    console.log(selectedOption);

    viewForm1(selectedOption);

    function showForm1() {
        var selectBox = document.getElementById("kat_penyelenggara");
        var selectedOption = selectBox.options[selectBox.selectedIndex].value;

        document.getElementById("masjid-form").style.display = "none";
        document.getElementById("vendor-form").style.display = "none";

        viewForm1(selectedOption);
    }

    function viewForm1(selectedOption){
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
<script>
    $(function () {

        // For select 2
        $("#kat_peralatan").select2({
            placeholder: '',
            multiple:true
        });

         var selOpts = "<?php echo $row['kat_peralatan']; ?>";
        selOpts = selOpts.replaceAll(", ",",");
        const myArray = selOpts.split(",");

        $("#kat_peralatan").val(myArray).trigger("change");
         console.log(selOpts);

        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function () {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function () {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function () {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function () {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>