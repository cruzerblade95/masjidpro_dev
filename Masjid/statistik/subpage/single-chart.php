<?php 
    include "../connect.php";
    
    $select = "SELECT * FROM jenisStatistik WHERE status='enable' ORDER BY susunan ASC";
    $list_statistics = mysqli_fetch_all(mysqli_query($conn2,$select),MYSQLI_ASSOC);
    $list_name = array_column($list_statistics,'namaStatistik');
    $list_label = array_column($list_statistics,'labelStatistik');
    $list_parameter = array_column($list_statistics,'senaraiLabel');
    foreach($list_parameter as $listerino){
        echo $listerino;
    }
    
    $select = "SELECT id_masjid,nama_masjid FROM sej6x_data_masjid";
    $raw_masjid = mysqli_fetch_all(mysqli_query($conn,$select),MYSQLI_ASSOC);
    
    $list_masjid = [];
    foreach($raw_masjid as $list){
        $list_nama_masjid[$list['id_masjid']] = $list['nama_masjid'];
    }
    
    $option = $_GET['option_list'];
    $param = $_GET['param_list'];
    
    $option_dec = json_decode($option,true);
    $param_dec = json_decode($param,true);
    $where_clause = 'WHERE ';
    
    for($i=0;$i<=10;$i++){
        if(sizeof($param_dec[$i])>0){
            $a = $list_name[$option_dec[$i]];
            $whr = implode("','",$param_dec[$i]);
            if($i > 0){$where_clause .= " AND ";}
            $where_clause .= $a." IN ('".$whr."')";
        }
    }
    
    //for single chart
    $single_sel = $list_name[$option_dec[0]];
    $select = "SELECT ".$single_sel." as indexs,COUNT(*) as count FROM full_data ".$where_clause." GROUP BY ".$single_sel." ORDER BY COUNT DESC";
    $full_data = mysqli_fetch_all(mysqli_query($conn,$select),MYSQLI_ASSOC);

    $label_array = [];
    $value_array = [];
    if($single_sel == 'id_masjid'){
        $label_detail = $list_masjid;
    }
    else{
        $label_detail = json_decode($list_parameter[$option_dec[0]],true);
    }
    
    foreach($full_data as $list){
        $label_array[] = $label_detail[$list['indexs']];
        $value_array[] = intval($list['count']);
        // print_r($list); 
    }
    
    
    $size_array = sizeof($value_array);
    $label_array = json_encode($label_array);
    $value_array = json_encode($value_array);
    $offsetLegend = (7-$size_array)*20;
    
?>

<div id="single-chart" class="mx-auto apex-dount" style="display:flex;justify-contents:center;"></div>

<script>
    
    document.getElementById('statistic-title').innerHTML = 'Single Chart Statistics - <b style="color:#DC7633;font-size:30px;"><?php echo strtoupper($list_label[$option_dec[0]]); ?></b>';
    offsetLegend = parseInt(<?php echo $offsetLegend; ?>);
    
    var options = {
        series: <?php echo $value_array; ?>,
        chart: {
            offsetX: offsetChart,
            width: 600,
            type: 'pie',
        },
        labels: <?php echo $label_array; ?>,
        legend: {
            horizontalAlign: 'center', 
            offsetY: offsetLegend,
            fontSize: '20px',
            fontFamily: 'Helvetica, Arial, sans-serif',
            fontWeight: 600,
            color: '#0065bd',
            itemMargin: {
                horizontal: 10,
                vertical: 5
            },
            formatter: function(val, opts) {
                return "&nbsp;" + val + " - " + opts.w.globals.series[opts.seriesIndex]
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom',
                }
            }
        }]
    };
    
    var chart = new ApexCharts(document.querySelector("#single-chart"), options);
    chart.render();
    
      
</script>