<?php
    include 'connect.php';
    
    $select = "SELECT * FROM jenisStatistik WHERE status = 'enable' ORDER BY susunan ASC";
    $list_statistics = mysqli_fetch_all(mysqli_query($conn2,$select),MYSQLI_ASSOC);
    
    $list_length = sizeof($list_statistics);

    $select = "SELECT COUNT(ID) AS COUNT FROM full_data";
    $data_count = mysqli_fetch_object(mysqli_query($conn,$select))->COUNT;
    
    $select = "SELECT COUNT(DISTINCT(id_masjid)) AS COUNT FROM full_data";
    $masjid_count = mysqli_fetch_object(mysqli_query($conn,$select))->COUNT;




?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Statistik @ Masjid Pro." name="description">
		<meta content="Myrich Dynasty" name="author">
		<meta name="keywords" content="Masjid Pro, Statistik"/>

		<!-- Title -->
		<title>Masjid Pro - Statistics Page</title>

		<!--Favicon -->
		<link rel="icon" href="image/icon.ico" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="assets/css/style.css" rel="stylesheet" />
		<link href="assets/css/dark.css" rel="stylesheet" />
		<link href="assets/css/skin-modes.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="assets/css/animated.css" rel="stylesheet" />

		<!--Sidemenu css -->
        <link  href="assets/css/sidemenu.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="assets/css/icons.css" rel="stylesheet" />

		<!---Sidebar css-->
		<link href="assets/plugins/sidebar/sidebar.css" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="assets/plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- INTERNAL Data table css -->
		<link href="assets/plugins/datatable/datatables.min.css" rel="stylesheet" />
		<link href="assets/plugins/datatable/css/jquery.dataTables.min.css" rel="stylesheet" />
		<link href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="assets/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

		<!-- INTERNAL Pg-calendar-master css -->
		<link href="assets/plugins/pg-calendar-master/pignose.calendar.css" rel="stylesheet" />
		
		<!-- INTERNAL Mutipleselect css-->
		<link rel="stylesheet" href="assets/plugins/multipleselect/multiple-select.css">

		<!-- INTERNAL Sumoselect css-->
		<link rel="stylesheet" href="assets/plugins/sumoselect/sumoselect.css">

		<!-- INTERNAL Jquerytransfer css-->
		<link rel="stylesheet" href="assets/plugins/jQuerytransfer/jquery.transfer.css">
		<link rel="stylesheet" href="assets/plugins/jQuerytransfer/icon_font/icon_font.css">

	</head>

	<body class="app sidebar-mini">

		<!---Global-loader-->
		<div id="global-loader" >
			<img src="assets/images/svgs/loader.svg" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">

				<!--aside open-->
				<aside class="app-sidebar">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="index.php">
							<img src="image/MasjidPro Penang.png" class="header-brand-img desktop-lgo" alt="MasjidPro">
							<img src="image/MasjidPro Penang.png" class="header-brand-img dark-logo" alt="MasjidPro">
							<img src="image/icon.jpg" class="header-brand-img mobile-logo" alt="MasjidPro">
							<img src="image/icon.jpg" class="header-brand-img darkmobile-logo" alt="MasjidPro">
						</a>
					</div>
					<div class="app-sidebar3">
						<div class="app-sidebar__user">
							<div class="dropdown user-pro-body text-center">
								<div class="user-pic">
									<img src="assets/images/users/16.jpg" alt="user-img" class="avatar-xxl rounded-circle mb-1">
								</div>
								<div class="user-info">
									<h5 class=" mb-2">Masjid Pro</h5>
									<span class="text-muted app-sidebar__user-name text-sm">Admin</span>
								</div>
							</div>
						</div>
						<ul class="side-menu">
							<li class="side-item side-item-category mt-4">Dashboards</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
									<i class="feather feather-home sidemenu_icon"></i>
									<span class="side-menu__label">Main Page</span><i class="angle fa fa-angle-right"></i>
								</a>
                                <ul class="slide-menu">
                                    <li><a href="../utama.php?view=admin&action=utama" class="slide-item">Menu Utama</a></li>
                                </ul>
								<ul class="slide-menu">
									<li><a href="index.php" class="slide-item">Dashboard</a></li>
								</ul>
                                <ul class="slide-menu">
                                    <li><a href="../logout.php" class="slide-item">Log Keluar</a></li>
                                </ul>
							</li>
						</ul>
					</div>
				</aside>
				<!--aside closed-->

				<div class="app-content main-content">
					<div class="side-app">

						<!--app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="index.php">
										<img src="image/MasjidPro Penang.png" class="header-brand-img desktop-lgo" alt="MasjidPro">
            							<img src="image/MasjidPro Penang.png" class="header-brand-img dark-logo" alt="MasjidPro">
            							<img src="image/icon.jpg" class="header-brand-img mobile-logo" alt="MasjidPro">
            							<img src="image/icon.jpg" class="header-brand-img darkmobile-logo" alt="MasjidPro">
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<i class="feather feather-menu"></i>
										</a>
										<a class="close-toggle" href="#">
											<i class="feather feather-x"></i>
										</a>
									</div>
								
									<div class="d-flex order-lg-2 my-auto ml-auto">
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->

						<!--Page header-->
						<div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<h4 class="page-title">Statistik<span class="font-weight-normal text-muted ml-2">Dashboard</span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										<!--<button  class="btn btn-primary " data-toggle="modal" data-target="#newprojectmodal"><i class="feather feather-plus fs-15 my-auto mr-2"></i>Create New Project</button>-->
										<!--<button  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>-->
										<!--<button  class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>-->
										<!--<button  class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button>-->
									</div>
								</div>
							</div>
						</div>
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-9">
														<div class="mt-0 text-left">
															<span class="fs-16 font-weight-semibold">Total Filterable Option</span>
															<h3 class="mb-0 mt-1 text-primary fs-25"><?php echo $list_length; ?></h3>
														</div>
													</div>
													<div class="col-3">
														<div class="icon1 bg-primary-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-9">
														<div class="mt-0 text-left">
															<span class="fs-16 font-weight-semibold">Total Registered Qariah</span>
															<h3 class="mb-0 mt-1 text-secondary fs-25"><?php echo number_format($data_count); ?></h3>
														</div>
													</div>
													<div class="col-3">
														<div class="icon1 bg-secondary-transparent my-auto  float-right"> <i class="feather feather-info"></i> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-9">
														<div class="mt-0 text-left">
															<span class="fs-16 font-weight-semibold">Masjid with Qariah Data</span>
															<h3 class="mb-0 mt-1 text-success fs-25"><?php echo number_format($masjid_count); ?></h3>
														</div>
													</div>
													<div class="col-3">
														<div class="icon1 bg-success-transparent my-auto  float-right"> <i class="feather feather-check"></i> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
								    <div class="col-xl-12 col-lg-12 col-md-12">
								        <!--<form id="submit-form" action="test.php" method="post">-->
										<div class="card">
        									<div class="card-header border-bottom-0">
        										<div class="card-title">Statistic Generator</div>
        									</div>
        									<div class="card-body">
        										<div class="row" id="reload_filter">
        											<?php 
        											for($i=0;$i<=10;$i++){
        											    if($i==0){
        											        $display='block';
        											    }
        											    else{
        											        $display = 'none';
        											    }
        											    $count = $i+1;
                                                        echo '<div class="col-lg-4 col-md-12" id="div_a'.$i.'" style="display:'.$display.';">
                                                            	<div class="form-group row">';
                                                    	if($count == 1){
                                                    	    echo '<label class="col-md-12 form-label">Main Option:</label>';
                                                    	}else{
                                                    	    echo '<label class="col-md-12 form-label">Option '.$count.':</label>';
                                                    	}
                                                            		
                                                        echo    		'<div class="col-md-12">
                                                            			<select class="search_test" id="option'.$i.'" name="option_list[]">
                                                            			    <option value="">Select Option</option>';
                                                            			        $c = 0;
                                                            			        foreach($list_statistics as $list){
                                                            			            echo '<option value="'.$c.'">'.$list['labelStatistik'].'</option>';
                                                            			            $c++;
                                                            			        }
                                                        echo            '</select>
                                                            		</div>
                                                            	</div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12" id="div_b'.$i.'" style="display:'.$display.';">
                                                            	<div class="form-group row">';
                                                    	if($count == 1){
                                                    	    echo '<label class="col-md-12 form-label">Main Parameter :</label>';
                                                    	}
                                                    	else{
                                                    	    echo '<label class="col-md-12 form-label">Parameter '.$count.':</label>';
                                                    	}
                                                                		
                                                        echo    		'<div class="col-md-12">
                                                            			<select multiple="multiple" class="testselect'.$i.' SlectBox-grp-src" id="param'.$i.'" name="param_list[]">
                                            			                </select>
                                                            		</div>
                                                            	</div>
                                                            </div>';
                                                    }
        											?>
        											<!--SlectBox-grp-src-->
        										</div>
        										<div style="height: 100px;">
        										</div>
        										<button id="update-chart" class="btn btn-primary "><i class="feather search fs-15 my-auto mr-2"></i>Apply Filter</button>
        									</div>
        								</div>
									</div>
									<!--</form>-->
								</div>
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-md-12">
										<div class="card">
											<div class="card-header  border-0">
												<h4 class="card-title" id="statistic-title">Single Chart Statistic </h4>
											</div>
											<div class="card-body" id='chart-1'>
												
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-md-12">
										<div class="card">
											<div class="card-header  border-0">
												<h4 class="card-title" id="multi-statistic-title">Multiple Chart Statistic </h4>
											</div>
											<div class="card-body" id='chart-2'>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->

					</div>
				</div><!-- end app-content-->
			</div>

            <div class="modal fade"  id="modalLoader">
    			<div class="modal-dialog modal-dialog-centered text-center ">
    				<div class="modal-content tx-size-sm">
    					<div class="modal-body text-center p-4">
    					    <div class="card-body">
								<div class="dimmer active">
								    <div class="sk-cube-grid">
										<div class="sk-cube sk-cube1"></div>
										<div class="sk-cube sk-cube2"></div>
										<div class="sk-cube sk-cube3"></div>
										<div class="sk-cube sk-cube4"></div>
										<div class="sk-cube sk-cube5"></div>
										<div class="sk-cube sk-cube6"></div>
										<div class="sk-cube sk-cube7"></div>
										<div class="sk-cube sk-cube8"></div>
										<div class="sk-cube sk-cube9"></div>
									</div>
									<h4 class="text-primary tx-semibold">Loading data. Please wait</h4>
								</div>
							</div>
    					</div>
    				</div>
    			</div>
    		</div>
		
			<!--Footer-->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
							<!--Copyright © 2021 <a href="#">Dayone</a>. Designed by <a href="#">Spruko Technologies Pvt.Ltd</a> All rights reserved.-->
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer-->

		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

		<!-- Jquery js-->
		<script src="assets/plugins/jquery/jquery.min.js"></script>

		<!--Moment js-->
		<script src="assets/plugins/moment/moment.js"></script>

		<!-- Bootstrap4 js-->
		<script src="assets/plugins/bootstrap/popper.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Othercharts js-->
		<script src="assets/plugins/othercharts/jquery.sparkline.min.js"></script>

		<!--Sidemenu js-->
		<script src="assets/plugins/sidemenu/sidemenu.js"></script>

		<!-- P-scroll js-->
		<script src="assets/plugins/p-scrollbar/p-scrollbar.js"></script>
		<script src="assets/plugins/p-scrollbar/p-scroll1.js"></script>

		<!--Sidebar js-->
		<script src="assets/plugins/sidebar/sidebar.js"></script>

		<!-- Select2 js -->
		<script src="assets/plugins/select2/select2.full.min.js"></script>

		<!-- Circle-progress js-->
		<script src="assets/plugins/circle-progress/circle-progress.min.js"></script>

		<!-- INTERNAL Chart js -->
		<script src="assets/plugins/chart/chart.bundle.js"></script>
		<script src="assets/plugins/chart/utils.js"></script>

		<!-- INTERNAL Chartjs rounded-barchart -->
		<script src="assets/plugins/chart.min/chart.min.js"></script>
		<script src="assets/plugins/chart.min/rounded-barchart.js"></script>

		<!-- INTERNAL Apexchart js-->
		<script src="assets/plugins/apexchart/apexcharts.js"></script>
		
		<!-- INTERNAL jquery transfer js-->
		<script src="assets/plugins/jQuerytransfer/jquery.transfer.js"></script>
		
		<!-- INTERNAL Multiple select js -->
		<script src="assets/plugins/multipleselect/multiple-select.js"></script>
		<script src="assets/plugins/multipleselect/multi-select.js"></script>

		<!-- INTERNAL Sumoselect js-->
		<script src="assets/plugins/sumoselect/jquery.sumoselect.js"></script>

		<!-- INTERNAL Data tables -->
		<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
		<script src="assets/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="assets/plugins/datatable/responsive.bootstrap4.min.js"></script>

		<!-- INTERNAL Pg-calendar-master js -->
		<script src="assets/plugins/pg-calendar-master/pignose.calendar.full.min.js"></script>

		<!-- INTERNAL Index js-->
		<!--<script src="assets/js/index5.js"></script>-->
		<!--<script src="assets/js/client/client-sidemenuchart.js"></script>-->
		
		<!-- INTERNAL Form Advanced Element -->
		<script src="assets/js/formelementadvnced.js"></script>
		<!--<script src="assets/js/form-elements.js"></script>-->
		<script src="assets/js/file-upload.js"></script>

		<!-- Custom js-->
		<script src="assets/js/custom.js"></script>
		
		<script>
	        let width = screen.width;
		</script>
		
		<script id="on_change_main">
		
		
		    $.fn.myFunction = function(selected,lengths){ 
                var options = []
		        var par = []
		        for(let x=0; x < lengths; x++){
		            options[x] = document.getElementById("option"+x).value;
		            par[x] = $("#param"+x).val();
		        }
		        var options_s = JSON.stringify(options)
		        var params_s = JSON.stringify(par)
		      //  console.log(options_s);
		      //  console.log(params_s);
                
                var http = new XMLHttpRequest();
                var url = 'subpage/single.php';
                var params = "option="+options_s+"&param="+params_s+"&sel="+selected;
                
                http.onreadystatechange = function() {
                    if (http.readyState == XMLHttpRequest.DONE) {
                        // console.log(http.responseText);
                        var raw = http.responseText.split(";")
                        // var data_type = raw[4];
                        // console.log(raw[1]);
                        // console.log(raw[5]);
                        
                        var new_options_val = JSON.parse(raw[0]);
                        var new_options_label = JSON.parse(raw[1]);
                        
                        $('#param'+selected).html('');
                        if(raw[4] == 'id_masjid'){
                            $('#param'+selected).html(raw[5])
                        }
                        $('#param'+selected)[0].sumo.reload();
                        
                        if(raw[4] != 'id_masjid'){
                            for (const property in new_options_val) {
                                $('#param'+selected)[0].sumo.add(new_options_val[property],new_options_label[property]);
                            }
                        }
                        
                        $('#param'+selected)[0].sumo.selectAll();
                        
                        $("#div_a"+(parseInt(selected)+1)).css("display","block")
                        $("#div_b"+(parseInt(selected)+1)).css("display","block")
                        
                        for(let i=parseInt(selected); i< 10; i++){
                            $("#div_a"+(i+2)).css("display","none")
                            $("#div_b"+(i+2)).css("display","none")
                            $('#option'+(parseInt(selected)+2)).html('');
                            $('#option'+(parseInt(selected)+2))[0].sumo.reload();
                            $('#param'+(parseInt(selected)+1)).html('');
                            $('#param'+(parseInt(selected)+1))[0].sumo.reload();
                        }
                        
                        var new_param_val = JSON.parse(raw[2]);
                        var new_param_label = JSON.parse(raw[3]);
                        
                        $('#option'+(parseInt(selected)+1)).html('');
                        $('#option'+(parseInt(selected)+1))[0].sumo.reload();
                        
                        for (const property in new_param_val) {
                            $('#option'+(parseInt(selected)+1))[0].sumo.add(new_param_val[property],new_param_label[property]);
                        }
                        
                        
                    }
                }

                http.open('POST', url, true);
                
                //Send the proper header information along with the request
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                http.send(params);
            }
		    
		    $("select[name='option_list[]']").change(function(){
		        var selected = $(this).attr("id").substr(6)
		        var lengths = $("select[name='option_list[]']").length;
		        $.fn.myFunction(selected,lengths);
            });
            
            $("select[name='param_list[][]']").click(function(){
		        var selected = $(this).attr("id").substr(5)
                
                for(let i=parseInt(selected); i< 10; i++){
                    $("#div_a"+(i+2)).css("display","none")
                    $("#div_b"+(i+2)).css("display","none")
                    $('#param'+(parseInt(selected)+1)).html('');
                    $('#param'+(parseInt(selected)+1))[0].sumo.reload();
                }
                
                // $('#option'+(parseInt(selected)+1)).html('');
                // $('#option'+(parseInt(selected)+1)).SumoSelect({ clearAll: true });
                // console.log('#option'+(parseInt(selected)+1));
                // $('#option'+(parseInt(selected)+1))[0].sumo.unSelectAll();
            });
            
            
		</script>
		<script>
		    var offsetChart = width/6;
            var offsetLegend = 100;
		  //  var old_html = $("#chart-2").html();
		    
		    $("#update-chart").click(function(){
		        $('#modalLoader').modal('show');
		        $('#modalLoader').on('shown.bs.modal', function () {
                    var options = []
		            var par = []
    		        for(let x=0; x < 10; x++){
    		            options[x] = document.getElementById("option"+x).value;
    		            par[x] = $("#param"+x).val();
    		        }
    		        var options_s = JSON.stringify(options)
    		        var params_s = JSON.stringify(par)
                    $('#chart-1').load('subpage/single-chart.php?option_list='+options_s+'&param_list='+params_s);
                    
                    // $("#chart-2").html(old_html);
                    $('#chart-2').load('subpage/multiple-charts.php?option_list='+options_s+'&param_list='+params_s, function(){
                        $('#modalLoader').modal('toggle');
                    });
                })
		        
            });
		</script>
		
		
		

	</body>
</html>