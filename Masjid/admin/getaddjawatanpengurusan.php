
<center>
    <div class="col-12">
        <form action="admin/add_jawatanpengurusan.php" method="POST" onSubmit="return confirm('Pastikan Maklumat Betul')">
            <div class="row">
                <div class="col-12">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Nama Jawatan&nbsp;:</label>
                            <div class="col-md-9">
                                <input type="text" name="jawatan_pengurusan" id="jawatan_pengurusan" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 offset-4">
                    <center>
                        <button class="btn-success btn" type="submit" name="tambah_pengurusan">Tambah</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</center>
