<?php
/**
 * Created by PhpStorm.
 * User: ESCOPIL
 * Date: 02-07-2019
 * Time: 19:22
 */

$origin_latitude = $_REQUEST["origin_latitude"];
$origin_longitude = $_REQUEST["origin_longitude"];


$destin_latitude = $_REQUEST["destin_latitude"];
$destin_longitude = $_REQUEST["destin_longitude"];

echo json_encode(array('Data'=>getdistanceAndduration($origin_latitude,$origin_longitude,$destin_latitude,$destin_longitude)));

function getdistanceAndduration($Origlat,$Origlog,$Destlat,$Destlog){

    $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$Origlat.','.$Origlog.'&destinations='.$Destlat.','.$Destlog.'&key=AIzaSyDtb3EfoRdTwKS3I-aBcw-H7wycAWmI-UM';

    $headers = array(
        'Authorization:key = AAAAm0hsYlQ:APA91bFPPvtDPufDkRr2joRe3XXNjxBAtUv81iFKE0AFeri1QPXEhl_f7woJwm8GZaNSvaIjDrub0dARQo5Ap6wAGp_nnh008zhyUjJfuRrv4ozBS3v7bXR8szPCyMDrFX88CiFLue8Y',
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, false);
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    $result = str_replace("[","",$result);
    $result = str_replace("]","",$result);

    $result = json_decode($result);
    $rows = $result->rows;
    $elements = $rows->elements;
    $distance = $elements->distance;
    $duration = $elements->duration;
    $distance = $distance->text;
    $duration = $duration->text;

    $valores = array(
        'distance' => $distance,
        'duration' => $duration
    );

    return $valores;
}

