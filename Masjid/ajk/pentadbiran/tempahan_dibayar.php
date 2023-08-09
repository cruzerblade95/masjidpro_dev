<?php 
//session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'booking');


?>

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sewaan Sudah Dikembalikan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Sewaan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                 <?php 
                                            $abc="SELECT * FROM booking_maklumat_barang where status='Ada'";

                                            $result=mysqli_query($db,$abc);
    
                                        ?>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Sewaan</th>
                                            <th>Tarikh Ambil</th>
                                            <th>Tarikh Pulang</th>
                                            <th>Kuantiti Ambil</th>
                                            <th>Kuantiti Pulang</th>
                                            <th>Status Bayaran</th>
                                            <th>AJK Penerima</th>
                                            <th>Catatan</th>
                                            <th>Tindakan</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>                                           
                                            <td>
                                                <button type="button" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"> <i class="fa fa-times"></i> </button>
                                              
                                              <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat"> <i class="fa fa-search"></i> </button>
                                            </td>
                                        </tr>
                                         
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
            <!-- /.row -->



