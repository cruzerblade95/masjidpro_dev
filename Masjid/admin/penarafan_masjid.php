<?php

include("connection/connection.php");

$sql_search="SELECT * FROM majlis_5S WHERE id_masjid='$id_masjid'";
$result = mysql_query($sql_search) or die ("Error :".mysql_error());
$row=mysql_num_rows($result);
?>
<script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table_display').DataTable();
    } );
</script>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Penarafan Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Penarafan Masjid</li>
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
                    Maklumat Penarafan Masjid
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_display" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="5%"><div align="center">#</div></th>
                                <th><div align="center">Tahun Audit</div></th>
                                <th><div align="center">Tarikh Audit</div></th>
                                <th><div align="center">5S</div></th>
                                <th><div align="center">Kewangan</div></th>
                                <th><div align="center">Pentadbiran</div></th>
                                <th><div align="center">Pengimarahan</div></th>
                                <th><div align="center">Maklumat Audit</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($row==0)
                            {
                                ?>
                                <tr>
                                    <td colspan="8" align="center">*Tiada Rekod*</td>
                                </tr>
                                <?php
                            }
                            else if($row>0)
                            {
                                $x=1;
                                while($row = mysql_fetch_assoc($result))
                                {
                                    $id_5s=$row['id_5s'];
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $x; ?></td>
                                        <td align="center"><?php echo $row['tahun']; ?></td>
                                        <td align="center"><?php echo $row['tarikh_audit']; ?></td>
                                        <td width="10%" align="center">
                                            <?php
                                            $sql="SELECT * FROM 5S WHERE id_5s='$id_5s'";
                                            $sqlquery=mysql_query($sql,$bd);
                                            $total_5s=0;
                                            while($data=mysql_fetch_array($sqlquery))
                                            {
                                                $total_5s=$total_5s+$data['skor'];
                                            }
                                            ?>
                                            <a class="btn btn-primary" target="_blank" href="admin/view_5s.php?id_5s=<?php echo $id_5s; ?>"><?php echo $total_5s."/210"; ?></a>
                                        </td>
                                        <td width="10%" align="center">
                                            <?php
                                            $sql1="SELECT * FROM Kewangan WHERE id_5s='$id_5s'";
                                            $sqlquery1=mysql_query($sql1,$bd);
                                            $total_kewangan=0;
                                            while($data1=mysql_fetch_array($sqlquery1))
                                            {
                                                $total_kewangan=$total_kewangan+$data1['skor'];
                                            }
                                            ?>
                                            <a class="btn btn-success" target="_blank" href="admin/view_kewangan.php?id_5s=<?php echo $id_5s; ?>"><?php echo $total_kewangan."/63"; ?></a>
                                        </td>
                                        <td width="10%" align="center">
                                            <?php
                                            $sql2="SELECT * FROM Pentadbiran WHERE id_5s='$id_5s'";
                                            $sqlquery2=mysql_query($sql2,$bd);
                                            $total_pentadbiran=0;
                                            while($data2=mysql_fetch_array($sqlquery2))
                                            {
                                                $total_pentadbiran=$total_pentadbiran+$data2['skor'];
                                            }
                                            ?>
                                            <a class="btn btn-warning" target="_blank" href="admin/view_pentadbiran.php?id_5s=<?php echo $id_5s; ?>"><?php echo $total_pentadbiran."/146"; ?></a>
                                        </td>
                                        <td width="10%" align="center">
                                            <?php
                                            $sql3="SELECT * FROM Pengimarahan WHERE id_5s='$id_5s'";
                                            $sqlquery3=mysql_query($sql3,$bd);
                                            $total_pengimarahan=0;
                                            while($data3=mysql_fetch_array($sqlquery3))
                                            {
                                                $total_pengimarahan=$total_pengimarahan+$data3['skor'];
                                            }
                                            ?>
                                            <a class="btn btn-danger" target="_blank" href="admin/view_pengimarahan.php?id_5s=<?php echo $id_5s; ?>"><?php echo $total_pengimarahan."/128"; ?></a>
                                        </td>
                                        <td width="10%" align="center">
                                            <button class="btn btn-info"><i class="fa fa-info-circle"></i></button>
                                        </td>
                                    </tr>
                                    <?php
                                    $x++;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
