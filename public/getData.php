<?php
header("Content-Type: application/json");

$id = $_GET['id'];
if($id == null) return;

$id = intval($id);
if($id == 0) return;

// create curl resource
$ch = curl_init();

$configContent = file_get_contents("../config.json");
$config = json_decode($configContent, true);
$apiClientId = $config['X-MAL-CLIENT-ID'];

// set url
curl_setopt($ch, CURLOPT_URL, "https://api.myanimelist.net/v2/anime/$id?fields=start_date,end_date,related_anime");
curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-MAL-CLIENT-ID: $apiClientId"));

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

echo $output;

// close curl resource to free up system resources
curl_close($ch);