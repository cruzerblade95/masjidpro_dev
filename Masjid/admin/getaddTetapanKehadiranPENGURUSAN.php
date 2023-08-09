
<center>
    <div class="col-12">
        <form action="admin/add_tetapankehadiranpengurusan.php" method="POST" onSubmit="return confirm('Pastikan Maklumat Betul')">
            <div class="row">
                <div class="col-12">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Jenis Kehadiran&nbsp;:</label>
                            <div class="col-md-9">
                                <select class="form-control" name="id_clockin" id="id_clockin">
                                    <option value=""></option>
                                    <option value="1">CHECK IN WAKTU SOLAT</option>
                                    <option value="2">CHECK IN NO LIMIT</option>
                                    <option value="3">CHECK IN WAKTU PEJABAT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 offset-4">
                    <center>
                        <input type="hidden" name="id_jawatankuasa" value="<?php echo $_GET['id_jawatankuasa'];?>">
                        <button class="btn-success btn" type="submit" name="tambahTetapan_pengurusan">Tambah</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</center>
