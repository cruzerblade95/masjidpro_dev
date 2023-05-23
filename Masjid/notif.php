	<?php

function sendNotif ($to, $notif){
    global $info_noti;

    $fields = array('to'=>$to, 'notification'=>$notif);

    $ch = curl_init();


    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $headers = array();
    //api key from firebase
    $headers[] = 'Authorization: Key= AAAA9WmSxZk:APA91bFhcS5pqXkL-X942WvRfxllVWGa8MeePRQ9C0hvBtxC6o1pxBCZcd08v_Xkq1l_DuxSN6VCjKNx1gxx5hHFtS9x0gqBHk6OrdU-E7SiiFuDxnNtUeufEA0mbpaTjth-KecSYPK7';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    // Check if any error occurred
    //if (!curl_errno($ch)) {
        //$info = curl_getinfo($ch);
        //echo 'Took ', $info['total_time'], ' seconds to send a request to ', $info['url'], "\n";
    //}
    $info = curl_getinfo($ch);
    $info_noti = "";
    curl_close($ch);
    foreach ($info as $info_key => $info_value) {
        $info_noti .= "$info_key: $info_value<br />";
    }
    //return $info_noti;
}

if($_GET['loadPage'] == "direct" && $_GET['token'] != NULL) {
    $notification = array(
        'title' => "MasjidPro",
        'body' => "Test notifikasi"
    );
    sendNotif($_GET['token'], $notification);
}

?>