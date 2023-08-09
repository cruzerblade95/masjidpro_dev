<?php

?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Aktiviti</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=aktivitiMasjid&sideMenu=masjid">Menu Aktiviti</a></li>
					<li class="active">Tambah Aktiviti</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
				   Maklumat Aktiviti
				</div>
				<div class="card-body">
					<div class="panel-body">
						<form method="POST" action="admin/add_aktivitimasjid.php" name="aktivitimasjid" id="aktivitimasjid" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-5">
                                <!--TAJUK-->
                                <div class="form-group">
                                    <label>Tajuk</label>
                                    <input class="form-control" name="tajuk_aktiviti" id="tajuk_aktiviti" required>
                                </div>
                                <!--KATEGORI-->
                                <div class="form-group">
                                    <?php
                                    $sqlkat = "SELECT id, pilihanLabel FROM pilihanAktivitiSub WHERE pilihan_id = '1' ";
                                    $list_kategori = mysqli_query($bd2, $sqlkat) or die(mysqli_error($bd2));
                                    ?>
                                    <label for="kategori_aktiviti">Kategori Aktiviti<span class="help"></span></label>
                                    <select id="kategori_aktiviti" name="kategori_aktiviti" class="form-control" style="width: 100%">
                                        <option value=""></option>
                                        <?php
                                        while($row_list_kategori = mysqli_fetch_assoc($list_kategori))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_kategori['id']); ?>"><?php echo(strtoupper($row_list_kategori['pilihanLabel'])); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--TARIKH & MASA-->
                                <div class="form-group">
                                    <label>Tarikh & Masa </label>
                                    <br>
                                    <input class="form-control" type="date" name="tarikh_aktiviti" style="width:196px">
                                    &nbsp;
                                    <input class="form-control" type="time" name="masa_aktiviti" style="width:196px">
                                </div>
                                <!--LOKASI-->
                                <div class="form-group">
                                    <label>Nama Lokasi</label>
                                    <input class="form-control" name="nama_lokasi" id="nama_lokasi">
                                </div>
                                <div class="form-group">
                                    <label>Link Lokasi</label>
                                    <input class="form-control" name="link_lokasi" id="link_lokasi">
                                </div>
                                <div class="form-group">
                                    <?php
                                    $sqlyn = "SELECT id, pilihanLabel FROM pilihanAktivitiSub WHERE pilihan_id = '2' ";
                                    $list_yesno = mysqli_query($bd2, $sqlyn) or die(mysqli_error($bd2));
                                    ?>
                                    <label for="live_platform">Live Platform<span class="help"></span></label>
                                    <select id="live_platform" name="live_platform" onchange="showInputFields()"  class="form-control" style="width: 100%">
                                        <option></option>
                                        <?php
                                        while($row_list_yesno = mysqli_fetch_assoc($list_yesno))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_yesno['id']); ?>"><?php echo(strtoupper($row_list_yesno['pilihanLabel'])); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div id="inputFields" style="display: none;"  class="form-group">
                                    <?php
                                    $sqlplat = "SELECT id, pilihanLabel FROM pilihanAktivitiSub WHERE pilihan_id = '3' ";
                                    $list_platform = mysqli_query($bd2, $sqlplat) or die(mysqli_error($bd2));
                                    ?>
                                    <label for="nama_platform">Nama Platform<span class="help"></span></label>
                                    <select id="nama_platform" name="nama_platform" class="form-control" style="width: 100%">
                                        <option value=""></option>
                                        <?php
                                        while($row_list_platform = mysqli_fetch_assoc($list_platform))
                                        {
                                            ?>
                                            <option value="<?php echo($row_list_platform['id']); ?>"><?php echo(strtoupper($row_list_platform['pilihanLabel'])); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <label for="link_platform">Link Platform</label>
                                    <input class="form-control" name="link_platform" id="link_platform">
                                    <br>
                                </div>
                                <!--RINGKASAN-->
                                <div class="form-group">
                                    <label>Ringkasan/Info</label>
                                    <textarea class="form-control" rows="3" name="ringkasan"></textarea>
                                </div>
							</div>
							<div class="col-lg-7">
                                <!--POSTER-->
                                <div class="form-group">
                                    <label>Muat Naik Poster</label><br>
                                    <ul>
                                        <li>Format JPG, JPEG & PNG sahaja dibenarkan</li>
                                        <li>Saiz tidak melebihi 2MB</li>
                                        <li>Ukuran terbaik 1080x600(16:9)</li>
                                    </ul>
                                    <input type="file" name="poster" id="poster" accept="image/*" class="form-control">
                                </div>
                                <div id="imagePreviewContainer" style="display: none;max-width: 100%;margin-top: 10px;">
                                    <img id="imagePreview" src="#" alt="Pratonton Poster" style="max-width: 100%;height: auto;">
                                </div>

							</div>
							<div class="col-lg-12" align="center">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-danger">Set Semula</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function showInputFields() {
        var selectBox = document.getElementById("live_platform");
        var inputFieldsDiv = document.getElementById("inputFields");

        if (selectBox.value === "9") {
            inputFieldsDiv.style.display = "block";
        } else {
            inputFieldsDiv.style.display = "none";
        }
    }
</script>
<script>
    document.getElementById("poster").addEventListener("change", function() {
        var file = this.files[0];
        var maxFileSize = 2 * 1024 * 1024; // 2MB in bytes
        var maxWidth = 1080;
        var maxHeight = 600;

        if (file && file.size <= maxFileSize) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = new Image();
                img.onload = function() {
                    var canvas = document.createElement("canvas");
                    var ctx = canvas.getContext("2d");
                    var width = img.width;
                    var height = img.height;

                    if (width > maxWidth || height > maxHeight) {
                        // Display alert if the image will be cropped
                        alert("Imej akan dipangkas agar sesuai dengan saiz.");
                    }

                    // Calculate the cropping coordinates to center the image
                    var x = 0;
                    var y = 0;
                    if (width / height > maxWidth / maxHeight) {
                        height = maxHeight;
                        width = height * img.width / img.height;
                        x = (maxWidth - width) / 2;
                    } else {
                        width = maxWidth;
                        height = width * img.height / img.width;
                        y = (maxHeight - height) / 2;
                    }

                    canvas.width = maxWidth;
                    canvas.height = maxHeight;
                    ctx.drawImage(img, x, y, width, height);
                    document.getElementById("imagePreview").setAttribute("src", canvas.toDataURL("image/jpeg"));
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Show the imagePreviewContainer when an image is chosen
            document.getElementById("imagePreviewContainer").style.display = "block";
        } else {
            // Image size is larger than 2MB or no image is selected, display an alert
            alert("Saiz imej mestilah kurang daripada atau sama dengan 2MB.");
            document.getElementById("poster").value = ""; // Clear the file input
            document.getElementById("imagePreviewContainer").style.display = "none"; // Hide the preview container
        }
    });
</script>







