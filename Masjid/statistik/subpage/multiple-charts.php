<!-- INTERNAL Data table css -->
<link href="https://masjidpro.com/Masjid/statistik/assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="https://masjidpro.com/Masjid/statistik/assets/plugins/datatable/css/buttons.bootstrap4.min.css"  rel="stylesheet">
<link href="https://masjidpro.com/Masjid/statistik/assets/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://masjidpro.com/Masjid/statistik/assets/plugins/toastui/tui-grid.css" />
<link rel="stylesheet" href="https://masjidpro.com/Masjid/statistik/assets/plugins/toastui/tui-date-picker.css" />

<script src="https://masjidpro.com/Masjid/statistik/assets/plugins/toastui/tui-date-picker.js"></script>
<script src="https://masjidpro.com/Masjid/statistik/assets/plugins/toastui/tui-grid.js"></script>


<?php 
    include "../connect.php";
    
    $select = "SELECT * FROM jenisStatistik WHERE status='enable' ORDER BY susunan ASC";
    $list_statistics = mysqli_fetch_all(mysqli_query($conn2,$select),MYSQLI_ASSOC);
    $list_name = array_column($list_statistics,'namaStatistik');
    $list_label = array_column($list_statistics,'labelStatistik');
    $list_parameter = array_column($list_statistics,'senaraiLabel');
    
    $detail_label = array();
    $array_size = sizeof($list_name);
    for($i=0;$i<$array_size;$i++){
        $detail_label[$list_name[$i]] = json_decode($list_parameter[$i],true);
    }
    
    $select = "SELECT id_masjid,nama_masjid FROM sej6x_data_masjid";
    $raw_masjid = mysqli_fetch_all(mysqli_query($conn,$select),MYSQLI_ASSOC);
    
    $list_masjid = [];
    foreach($raw_masjid as $list){
        $list_nama_masjid[$list['id_masjid']] = $list['nama_masjid'];
    }
    
    $option_dec = json_decode($_GET['option_list'],true);
    $param_dec = json_decode($_GET['param_list'],true);

    // $where_clause = 'WHERE ';
    
    $select_clause = '';
    $sel_item = array();
    for($i=0;$i<=10;$i++){
        if($i == 0){
            $where_clause = 'WHERE ';
        }
        if(sizeof($param_dec[$i])>0){
            $a = $list_name[$option_dec[$i]];
            $whr = implode("','",$param_dec[$i]);
            if($i > 0){$where_clause .= " AND ";}
            $where_clause .= $a." IN ('".$whr."')";
            $select_clause .= $list_name[$option_dec[$i]].',';
            $sel_item[$list_name[$option_dec[$i]]] = $list_label[$option_dec[$i]];
            unset($list_name[$option_dec[$i]]);
            unset($list_label[$option_dec[$i]]);
        }
    }
    $select_clause = substr($select_clause,0,-1);
    
    echo '<div class="row">';
    $i=0;
    foreach($list_name as $key=>$value){
        if($value != 'id_masjid'){
            echo '<div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                	<div class="card">
                		<div class="card-header  border-0">
                			<h4 class="card-title" id="multi-title-'.$i.'"><b style="color:#138D75;font-size:25px;">'.strtoupper($list_label[$key]).'</b></h4>
                		</div>
                		<div class="card-body">
                			<div id="multi-chart-'.$i.'" class="mx-auto apex-dount" style="display:flex;justify-contents:center;"></div>
                		</div>
                	</div>
                </div>';
                
            //for multi chart
            $select = "SELECT ".$value." as indexs,COUNT(*) as count FROM full_data ".$where_clause." GROUP BY ".$value." ORDER BY indexs DESC";
            $full_data = mysqli_fetch_all(mysqli_query($conn,$select),MYSQLI_ASSOC);
        
            $label_array = [];
            $value_array = [];
            if($value == 'id_masjid'){$label_detail = $list_masjid;}
            else{$label_detail = json_decode($list_parameter[$key],true);}
            
            // print_r($full_data);
            $null_value = 0;
            foreach($full_data as $list){
                if($label_detail[$list['indexs']] == ''){
                    $null_value += intval($list['count']);
                }
                else{
                    $label_array[] = $label_detail[$list['indexs']];
                    $value_array[] = intval($list['count']);
                }
            }
            
            $size_array = sizeof($value_array);
            $value_array[$size_array-1] = $value_array[$size_array-1] + $null_value;
            // print_r($value_array[$size_array-1]);
            
            
            $label_array = json_encode($label_array);
            $value_array = json_encode($value_array);
            $offsetLegend = (6-$size_array)*10;
            if($offsetLegend < 0){
                $offsetLegend = 0;
            }
            
            
            // echo "<script>console.log('".$label_array."')</script>";
            // echo "<script>console.log('".$value_array."')</script>";
        
            echo '
            <script>
                var options'.$i.' = {
                    series: '.$value_array.',
                    chart: {type: "pie"},
                    labels: '.$label_array.',
                    legend: {
                        horizontalAlign: "center", 
                        offsetY: '.$offsetLegend.',
                        itemMargin: {horizontal: 10,vertical: 5},
                        formatter: function(val, opts) {return "&nbsp;" + val + " - " + opts.w.globals.series[opts.seriesIndex]}
                    },
                };
                
                 var chart'.$i.' = new ApexCharts(document.querySelector("#multi-chart-'.$i.'"), options'.$i.');
                 chart'.$i.'.render();
                
            </script>';
        }
        else{
            
            $select3 = "SELECT row_number() over(order by daerah) as bil,sej6x_data_masjid.daerah,sej6x_data_masjid.nama_masjid,COUNT(*) as count FROM full_data LEFT JOIN sej6x_data_masjid ON full_data.id_masjid = sej6x_data_masjid.id_masjid ".$where_clause." GROUP BY nama_masjid ORDER BY daerah ASC";
            $data_by_masjid = mysqli_fetch_all(mysqli_query($conn,$select3),MYSQLI_ASSOC);
            
            // echo '<script>console.log("'.$select3.'")</script>';
            
            echo '
            </div>
            <div class="row">
                <div class="col-xl-5 col-lg-12 col-md-12">
                	<div class="card">
                		<div class="card-header  border-0">
                			<h4 class="card-title" id="multi-title-'.$i.'"><b style="color:#138D75;font-size:25px;">'.strtoupper($list_label[$key]).'</b></h4>
                		</div>
                		<div class="card-body">
                			<div id="multi-chart-'.$i.'" class="mx-auto apex-dount" style="display:flex;justify-contents:center;"></div>
                		</div>
                	</div>
                </div>
                <div class="col-xl-7 col-lg-12 col-md-12">
                	<div class="card">
                		<div class="card-header  border-0">
                			<h4 class="card-title" id="masjid_list"><b style="color:#138D75;font-size:25px;">DETAILS BY MASJID</b></h4>
                		</div>
                		<div class="card-body">
                    	    <div class="row">
								<div class="col-12">
								    <div id="app" class="tui-tree-wrap"></div>
								</div>
							</div>
                		</div>
                	</div>
                </div>
            </div>';
            
            echo '<div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                	<div class="card">
                		<div class="card-header  border-0">
                			<h4 class="card-title" id="masjid_list"><b style="color:#138D75;font-size:25px;">DETAILS BY MASJID</b></h4>
                		</div>
                		<div class="card-body">
                    	    <div class="row">
								<div class="col-12">
								    <div id="app2" class="tui-tree-wrap"></div>
								</div>
							</div>
                		</div>
                	</div>
                </div>
            </div>';
                
            //for multi chart
            $select = "SELECT DISTINCT(a.daerah) as indexs,COUNT(*) as count FROM 
                        (SELECT DISTINCT(full_data.id_masjid),sej6x_data_masjid.daerah FROM full_data 
                        LEFT JOIN sej6x_data_masjid ON full_data.id_masjid = sej6x_data_masjid.id_masjid ".$where_clause." ORDER BY daerah ASC) a GROUP BY daerah ORDER BY daerah ASC;";
            // $select = "SELECT ".$value." as indexs,COUNT(*) as count FROM full_data ".$where_clause." GROUP BY ".$value." ORDER BY indexs ASC";
            $full_data = mysqli_fetch_all(mysqli_query($conn,$select),MYSQLI_ASSOC);
            
            $select = "SELECT row_number() over(order by nama_penuh) as bil,nama_penuh,$select_clause FROM full_data ".$where_clause."ORDER BY nama_penuh ASC";
            $full_list_name = mysqli_fetch_all(mysqli_query($conn,$select),MYSQLI_ASSOC);
            
            // echo '<script>console.log("'.$select.'")</script>';
            
            $full_list_new = array();
            foreach($full_list_name as $list_a){
                foreach($list_a as $key=>$value){
                    if($key != 'bil' && $key != 'nama_penuh'){
                        if(is_null($value)){
                            $list_a[$key] = $detail_label[$key]['0'];
                        }else{
                            $list_a[$key] = $detail_label[$key][$value];
                        }
                    }
                }
                $full_list_new[] = $list_a;
                // echo "<script>console.log('".json_encode($list_a)."')</script>";
            }
            
            // echo "<script>console.log('".json_encode($full_list_new)."')</script>";
            // echo "<script>console.log('".json_encode($full_list_new)."')</script>";
        
            $label_array = [];
            $value_array = [];
            $label_detail = $list_masjid;
            
            // print_r($full_data);
            $null_value = 0;
            foreach($full_data as $list){
                $label_array[] = $list['indexs'];
                $value_array[] = intval($list['count']);
            }
            
            $size_array = sizeof($value_array);
            $value_array[$size_array-1] = $value_array[$size_array-1] + $null_value;
            
            
            $label_array = json_encode($label_array);
            $value_array = json_encode($value_array);
            $offsetLegend = (7-$size_array)*10;
                
            echo '
                <script>
                
                    var options'.$i.' = {
                        series: '.$value_array.',
                        chart: {type: "pie"},
                        labels: '.$label_array.',
                        legend: {
                            position: "bottom",
                            horizontalAlign: "center", 
                            offsetY: '.$offsetLegend.',
                            itemMargin: {horizontal: 10,vertical: 5},
                            formatter: function(val, opts) {return "&nbsp;" + val + " - " + opts.w.globals.series[opts.seriesIndex]}
                        },
                    };
                    
                     var chart'.$i.' = new ApexCharts(document.querySelector("#multi-chart-'.$i.'"), options'.$i.');
                     chart'.$i.'.render();
                </script>
            ';
            
            
        }
        
        $i++;
        
        
    }
    echo '</div>';
?>

<script>
    var gridData = <?php echo json_encode($data_by_masjid); ?>;

    var Grid = tui.Grid;
    var instance = new Grid({
          el: document.getElementById('app'),
          data: gridData,
          bodyHeight: 500,
          columns: [{header: 'Bil',name: 'bil',width: 30,sortingType: 'asc',sortable: true},
            {header: 'Daerah',name: 'daerah',filter: 'select',width: 300,sortingType: 'asc',sortable: true},
            {header: 'Masjid',name: 'nama_masjid',filter: 'text',width: 400,sortingType: 'asc',sortable: true},
            {header: 'Bilangan',name: 'count',filter: 'number',width: 100,sortingType: 'asc',sortable: true}]
    });
    
    var gridDatas = <?php if(empty($full_list_new)){echo '[]';}else{echo json_encode($full_list_new);} ?>;
    var Grids = tui.Grid;
    var instances = new Grids({
          el: document.getElementById('app2'),
          data: gridDatas,
          bodyHeight: 500,
          columns: [{header: 'Bil',name: 'bil',width: 30,sortingType: 'asc',sortable: true},
            {header: 'Nama',name: 'nama_penuh',filter: 'select',width: 300,sortingType: 'asc',sortable: true},
            <?php 
                foreach($sel_item as $key=>$value){
                    echo "{header: '".$value."',name: '".$key."',filter: 'select',width: 150,sortingType: 'asc',sortable: true},";
                }
            
            
            ?>
            ]
    });
</script>


            
<!-- INTERNAL Data tables -->
	<!--<script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>-->
	<!--<script src="../../assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>-->
	<!--<script src="../../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>-->
	<!--<script src="../../assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>-->
	<!--<script src="../../assets/plugins/datatable/dataTables.responsive.min.js"></script>-->
	<!--<script src="../../assets/plugins/datatable/responsive.bootstrap4.min.js"></script>-->
	<!--<script src="../../assets/js/datatables.js"></script>-->
    
      
