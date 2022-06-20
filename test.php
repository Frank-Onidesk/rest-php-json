<?php

$token = '7f608e2b98e2e6ea9b4dba6a1b9762bf8dce2555';
$city = 'pacos-de-ferreira'; 
$url = 'https://api.waqi.info/feed/here/?token='.$token .'&city='.$city;

$json_data = file_get_contents($url);

$response_data = json_decode($json_data);

$data = $response_data->data;
//print_r($data);

$aqi =  $data->aqi;
$lat =  $data->city->geo[0];
$long = $data->city->geo[1];
$tCity =  $data->city->name;

$measure = array("50" => 'Good',
               "100" => 'Moderate',
               "150" => 'Unhealthy for',
               "200" => 'Poor',
            );


  function quality($aqi, $measure) :string {
       
       foreach($measure as $i => $v){
             if($aqi <=$i){
              return $measure[$i];
             }

             return 'undefined';
       }
}
?>

<!-- output -->
<h1 align="center">Air Quality Measure</h1>
<table border="1" width="70%" align="center">
    <tr style="font-weight:bold; background-color:ccc;">
        <td>City</td>
        <td>Latitude</td>
        <td>Longitude</td>
        <td>Real Time Quality info</td>
        <td>Quality</td>
    </tr>
    <tr style="text-align: center;">
        <td><?=$tCity?></td>
        <td><?=$lat?></td>
        <td><?=$long?></td>
        <td><?=$aqi?> </td>
        <td><?=quality($aqi, $measure)?> </td>
    </tr>
</table>










