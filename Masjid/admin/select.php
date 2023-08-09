<?php

    include('../connection/connection.php');

    $id_aktiviti=$_GET['id_aktiviti'];
    $sql1 = "SELECT * FROM sej6x_data_aktivitifail WHERE id_aktiviti='$id_aktiviti'";
    $sqlquery1 = mysqli_query($bd2, $sql1);
    $row1 = mysqli_num_rows($sqlquery1);
    $output ='<table class="table-bordered table table-striped">
        <tr>
            <th><div align="center">Fail</div></th>
            <th><div align="center">Padam</div></th>
        </tr>';

    if($row1>0) {
        while ($data1 = mysqli_fetch_array($sqlquery1)) {
            $output .= '<tr id="' . $data1["ID"] . '">
                <td align="center"><a class="btn btn-info" href="admin/view_aktiviti.php?ID=' . $data1['ID'] . '" target="_blank">Lihat</a></td>
                <td align="center"><button type="button" name="delete_btn" data-id3="' . $data1['ID'] . '" class="btn btn-sm btn-danger btn_delete">Padam</button></td>
            </tr>';
        }
    }
    else if($row1==0)
    {
        $output .= '<tr><td align="center" colspan="3">*Tiada Rekod*</td>';
    }
    $output .= '</table>';
        echo $output;
?>