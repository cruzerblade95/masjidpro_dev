<style>
    html, body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 1100px;
        margin: 40px auto;
    }
</style>
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
                    <li class="active">Menu Aktiviti</li>
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
                    <div class="row">
                        <div class="col-lg-8">
                            Aktiviti
                        </div>
                        <div class="col-lg-4" style="text-align: end">
                            <a href="utama.php?view=admin&action=tambahAktiviti&sideMenu=masjid" class="btn btn-success">Tambah Aktiviti</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-8">
                            Senarai Aktiviti
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <div>
                            <?php

                            include("connection/connection.php");

                            $sql_search="SELECT a.id_inventori, a.nama_peralatan, a.tarikh_belian, c.nama_penuh as nama_pegawai, a.kuantiti_belian, a.kuantiti_unit, a.lokasi, e.status_kerosakan as status 
                                 FROM sej6x_data_inventori a 
                                 LEFT JOIN data_ajkmasjid b ON a.id_pegawai = b.id_dataajk 
                                 LEFT JOIN sej6x_data_peribadi c ON b.id_ajk = c.id_data 
                                 LEFT JOIN sej6x_data_kerosakkan d ON a.id_inventori = d.id_peralatan 
                                 LEFT JOIN sej6x_data_statuskerosakan e ON d.id_statuskerosakan = e.id_status 
                                 WHERE a.id_masjid = $id_masjid";
                            $result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error($bd2));

                            ?>
                            <div class="table-responsive">
                                <table id="listaktiviti" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                                    <thead>
                                    <tr>
                                        <th><div align="center">Bil</div></th>
                                        <th><div align="center">Nama Peralatan</div></th>
                                        <th><div align="center">Tarikh Belian</div></th>
                                        <th><div align="center">Nama Pegawai</div></th>
                                        <th><div align="center">Kuantiti Semasa & Unit</div></th>
                                        <th><div align="center">Tempat / Lokasi (Simpan)</div></th>
                                        <th><div align="center">Status Peralatan</div></th>
                                        <th><div align="center"></div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $x=1;
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        ?>
                                        <tr>
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><div align="center"><?php echo $row['nama_peralatan']; ?></div></td>
                                            <td><div align="center"><?php echo $row['tarikh_belian']; ?></div></td>
                                            <td><div align="center"><?php echo $row['nama_pegawai']; ?></div></td>
                                            <td><div align="center"><?php echo $row['kuantiti_belian']; ?>&nbsp;<?php echo $row['kuantiti_unit']; ?></div></td>
                                            <td><div align="center"><?php echo $row['lokasi']; ?></div></td>
                                            <td><div align="center"><?php echo $row['status'] ?></div></td>
                                            <td>
                                                <div align="center">
                                                    <form action="admin/del_inventori.php" method="POST">
                                                        <a href="utama.php?view=admin&action=view_inventori&id_inventori=<?php echo $row['id_inventori'];?>&sideMenu=masjid">
                                                            <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </a>
                                                        <a href="utama.php?view=admin&action=edit_inventori&id_inventori=<?php echo $row['id_inventori'];?>&sideMenu=masjid">
                                                            <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Kemaskini">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <!-- <form name="delete" method="POST" action="admin/del_inventori.php"> -->
                                                        <input type="hidden" name="id_inventori" value="<?php echo $row['id_inventori']; ?>">
                                                        <input type="hidden" name="no_rujukan" value="<?php echo $row['kod_peralatan']; ?>">
                                                        <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                                        <button type="submit" name="delete" id="delete" class="btn btn-danger" title="Padam"><i class="far fa-trash-alt" onclick="return confirm('Padam Rekod?');"></i></button>
                                                        <!-- </form> -->
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<!--<script src='fullcalendar/core/index.global.js'></script>-->
<!--<script src='fullcalendar/core/locales/es.global.js'></script>-->
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale:'ms',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            events: [
                {
                    title: 'All Day Event',
                    start: '2023-08-01'
                },
                {
                    title: 'Long Event',
                    start: '2023-08-07',
                    end: '2023-08-10'
                },
                {
                    groupId: '999',
                    title: 'Repeating Event',
                    start: '2023-08-09T16:00:00'
                },
                {
                    groupId: '999',
                    title: 'Repeating Event',
                    start: '2023-08-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2023-07-11',
                    end: '2023-08-13'
                },
                {
                    title: 'Meeting',
                    start: '2023-08-12T10:30:00',
                    end: '2023-08-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2023-08-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2023-08-12T14:30:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2023-08-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'https://google.com/',
                    start: '2023-08-28'
                }
            ]
        });
        calendar.render();

    });

</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#listaktiviti', 'Senarai Aktiviti', [ 0, 1, 2, 3, 4, 5, 6 ]);
    });
</script>