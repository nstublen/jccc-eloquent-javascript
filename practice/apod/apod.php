<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  $url = 'https://api.nasa.gov/planetary/apod?' . $_SERVER['QUERY_STRING'];
  $response = file_get_contents($url);
  echo $response;

}
