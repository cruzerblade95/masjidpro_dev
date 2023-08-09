<?php

    include('../connection/connection.php');
    include('../fungsi_tarikh.php');

    $id_masjid = $_GET['id_masjid'];
    $sql = "SELECT * FROM surat_rasmi WHERE id_masjid='$id_masjid'";
    $sqlquery = mysqli_query($bd2,$sql);
    $row = mysqli_num_rows($sqlquery);

    $output = '<div class="table-responsive">
            <table id="table_display" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th width="5%"><div align="center">#</div></th>
                    <th width="35%"><div align="center">Tajuk</div></th>
                    <th width="20%"><div align="center">Tarikh</div></th>
                    <th width="15%"><div align="center">Jenis Surat</div></th>
                    <th width="25%"><div align="center">Tindakan</div></th>
                </tr>
                </thead>
                <tbody>';

                $i = 1;
                while($data=mysqli_fetch_array($sqlquery))
                {
                    $jenis_surat = $data["jenis_surat"];
                    if($jenis_surat=="1"){
                        $nama_jenis = "Surat Aduan";
                    }
                    else if($jenis_surat=="2"){
                         $nama_jenis = "Surat Jemputan";
                    }
                    else if($jenis_surat=="3"){
                         $nama_jenis = "Surat Pemberitahuan";
                    }
                    else if($jenis_surat=="4"){
                         $nama_jenis = "Surat Pengesahan";
                    }
                    else if($jenis_surat=="5"){
                         $nama_jenis = "Surat Permohonan";
                    }
                    else if($jenis_surat=="6"){
                         $nama_jenis = "Surat Sokongan";
                    }
                    $tarikh = fungsi_tarikh($data["tarikh"], 2, 1);
                $output .=  '<tr>
                        <td>'.$i.'</td>
                        <td align="left">'.$data["tajuk_surat"].'</td>
                        <td align="center">'.$tarikh.'</td>
                        <td align="center">'.$nama_jenis.'</td>
                        <td align="center">
                            <a class="btn btn-info" href="admin/view_surat.php?id_surat='.$data["id_surat"].'" target="_blank"><i class="fa fa-search"></i></a>&nbsp;
                            <a class="btn btn-warning" href="utama.php?view=admin&action=edit_surat_rasmi&id_surat='.$data["id_surat"].'"><i class="fa fa-edit"></i></a>&nbsp;
                            <button type="submit" class="btn btn-danger btn_delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>';
                }
                $output .= '</tbody>
            </table>
        </div>';
        echo $output;
?>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai KAFA', [ 0, 1, 2, 3, 4 ]);
    });
</script>
