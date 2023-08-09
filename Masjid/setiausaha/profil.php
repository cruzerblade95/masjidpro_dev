<style type="text/css">
    
    .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
}

</style>


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maklumat Log Masuk</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Pengguna Sistem
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form name="tukarpassword" method="post" action="<?php echo $PHP_SELF;?>" >
                                     
                                    <?php
                                        include("../connection/connection.php");

                                        if(isset( $_POST['kemaskini']))
                                        {

                                        $username=mysql_real_escape_string($_POST['username']);
                                        $password=mysql_real_escape_string($_POST['password']);
                                        $user_name=mysql_real_escape_string($_POST['user_name']);
                                        $user_ic=mysql_real_escape_string($_POST['user_ic']);

                                        mysql_select_db($mysql_database, $bd);   

                                        $query="UPDATE masjid_user 
                                                SET username='$username', password='$password',
                                                user_name='$user_name', user_ic='$user_ic'
                                                WHERE user_id='$_SESSION[user_id]'";
                                        
                                        mysql_query($query, $bd);
                                         header("location: ../utama.php?view=admin&action=profil");

                                }
                                        
                                ?>

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" value="<?php echo $datastaff['user_name'];?>" name="user_name" >
                                        </div>
                                        <div class="form-group">
                                            <label>No. IC</label>
                                            <input class="form-control" value="<?php echo $datastaff['user_ic'];?>" name="user_ic">
                                        </div>
                                        <div class="form-group">
                                            <label>Jawatan</label>
                                            <input class="form-control" value="<?php echo $datastaff['user_type'];?>" disabled="">
                                        </div>
                                       
                                        
                                    
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <h2>Log Masuk Detail</h2>
                                   
                                        <fieldset >
                                            <div class="form-group">
                                            <label>Nama Pengguna</label>
                                            <input class="form-control" value="<?php echo $datastaff['username'];?>" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label>Kata Laluan</label>
                                            <input id="password-field" type="password" class="form-control" name="password" value="<?php echo $datastaff['password'];?>"
                                            >

                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        </fieldset>
                                    

                                       <button type="submit" name="kemaskini" id="kemaskini" class="btn btn-default" onclick="return confirm('Kemaskini?')" onClick="history.go(0)">Kemaskini</button>
                                        <!-- button type="reset" class="btn btn-default"></button -->
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            </form>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>