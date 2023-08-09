
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Tabung TLK Wakaf Kubur</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carian Maklumat Tabung
                        </div>

                        <div class="panel-body">
                        <div class="row"> 
                            <form method="POST" action="utama.php?view=superadmin&action=my_attendance">                              
                               
                                <div class="col-lg-3">                                   
                                        <div class="form-group">
                                            <label>Daripada</label>
                                            <input class="form-control" name="datefrom" id="datefrom" required="required">                                        
                                        </div>    
                                </div>

                                <div class="col-lg-3">                                    
                                       <div class="form-group">
                                             <label>Hingga</label>
                                            <input class="form-control"  name="dateto" id="dateto" required="required">                                          
                                        </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                            
                                            <input type="submit" name="search" value="Cari" class="btn btn-primary"></input> 

                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Rekod Tabung TLK Wakaf Kubur
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            

                            <div class="table-responsive">

                               


                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Bil</th>                                    
                                            <th>Perkara</th>
                                            <th style="text-align:center;">Pendapatan</th>
                                            <th style="text-align:center;">Perbelanjaan</th>
                                            <th style="text-align:center;">Jumlah</th>
                                            <th>Tindakan</th>
                                            
                                          
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td style="">1</td>                    
                                            <td style="">
                                                Kuliah Maghrib
                                            </td>   
                                            <td style=" text-align:center;">   
                                            RM 0  
                                            </td>
                                            <td style="">
                                                RM 849.00
                                            </td>     
                                            <td style="">
                                                RM 4920.00
                                            </td>
                                            <td align="center">
                                                <button type="button" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam">
                                                    <i class="fa fa-times"></i>
                                                 </button>&nbsp;&nbsp;&nbsp;
                                                 <button type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#myModalEdit" data-placement="right" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                 </button>&nbsp;&nbsp;&nbsp;
                                                 <button type="button" class="btn btn-info btn-circle" data-placement="right" data-toggle="modal" data-target="#myModal" title="Lihat">
                                                    <i class="fa fa-search"></i>
                                                 </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->




            <!-- Lihat Modal -->

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Tabung TLK Wakaf Kubur</h4>
                                        </div>
                                        <div class="modal-body">
                                            

                                            <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-info">
                                                 
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <h4 align="center"><u>Maklumat Tabung TLK Wakaf Kubur</u></h4>
                                                            
                                                            <div class="col-lg-4">
                                                             
                                                                    <div class="form-group">
                                                                        <label>Nama Pembayar</label>
                                                                        <input class="form-control" disabled>               
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Tunai/Bank In</label>
                                                                        <input class="form-control" placeholder="Contoh: 880528-35-5036" disabled>  
                                                                    </div>

                                                                   
                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->

                                                            <div class="col-lg-4">  

                                                                     <div class="form-group">
                                                                        <label>Tarikh</label>
                                                                        <input class="form-control" disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Butiran</label>
                                                                        <input class="form-control" disabled>
                                                                    </div>
                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->



                                                            <div class="col-lg-4">  

                                                                    <div class="form-group">
                                                                        <label>Rujukan</label>
                                                                        <input class="form-control" disabled>
                                                                    </div>
                                                                     <div class="form-group">
                                                                        <label>Amaun (RM)</label>
                                                                        <input class="form-control" placeholder="Contoh: 014-3159891" disabled>
                                                                    </div>  
                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->
                                                    </div>





                                                   
                                                        <div class="row">
                                                            <h4 align="center"><u>Maklumat Penerima / Masjid</u></h4>


                                                        <div class="col-lg-4">
                                                             
                                                                    <div class="form-group">
                                                                        <label>Nama Penerima</label>
                                                                        <input class="form-control" disabled>               
                                                                    </div>
                                                                   
                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->
                                                            <div class="col-lg-4">

                                                                    <div class="form-group">
                                                                        <label>Jawatan</label>
                                                                        <input class="form-control" placeholder="Contoh: 880528-35-5036" disabled>  
                                                                    </div>

                                                                   
                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->
                                                            <div class="col-lg-4">
                                                             
                                                                    <div class="form-group">
                                                                        <label>No Telefon</label>
                                                                        <input class="form-control" placeholder="Contoh: 880528-35-5036" disabled>  
                                                                    </div>

                                                                   
                                                            </div>
                                                            <!-- /.col-lg-4 (nested) -->
                                                    </div>
                            <!-- /.LIHAT MODAL -->



                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
        