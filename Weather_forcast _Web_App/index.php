
<?php
header('Content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET , POST");
header('Content-type: application/json');

//echo "success reached php";

/*if ($_GET['data'] == true) {
      
      echo "success: data received."; 
     }
else {
     echo "failure"
}*/

$state = $_GET['state'];
$address = $_GET['address'];
$city = $_GET['city'];
$temperature = $_GET['temperature'];
//echo "\n$address";
//echo "\n$city";
//echo "\n$state";
//echo "\n$temperature";


 $street="";
    $street.=$address;
    $street.=",";
    $street.=$city;
    $street.=",";
    $street.=$state;


 $street = urlencode($street);
    $key12 ="AIzaSyDxQWluvZjYUqU-3JbxcW1u6O3LTNkE0Rk";
   //$url ="http://maps.google.com/maps/api/geocode/xml?address={$address}";    
   $url ="https://maps.googleapis.com/maps/api/geocode/xml?address={$street}&key=AIzaSyDxQWluvZjYUqU-3JbxcW1u6O3LTNkE0Rk";
         // https://maps.googleapis.com/maps/api/geocode/xml?address=1600+Amphitheatre+Parkway,Mountain+View,CA&key=YOUR_API_KEY                 

   $resp_location = file_get_contents($url);
   $value = new SimpleXMLElement($resp_location);
   //Hardcoded value : 34.029253, -118.280705
    $lat = $value->result->geometry->location->lat;
    $longitu=$value->result->geometry->location->lng;

//echo "\n$lat";
//echo "\n$longitu";

    
    
$api_key = 'f1342155a9491648cec0840f0a579595';
$latitude = $lat;
$longitude = $longitu;

//echo "$lat";
//echo "$long";
    
if($temperature == "Celsius")
    $units ='si' ;
else
    $units = 'us';



    
$url1 = "https://api.forecast.io/forecast/$api_key/$latitude,$longitude?units=$units&exclude=flags";

$forcast = file_get_contents($url1);
$resp = json_decode($forcast, true);

echo "$resp";
   

//echo "\n$summery";
//echo "\n$image";

//echo "$forcast"




?>
