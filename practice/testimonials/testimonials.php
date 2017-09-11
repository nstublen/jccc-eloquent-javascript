<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

$db = new mysqli('localhost', 'tflabs_jccc', 'jccc4sql', 'tflabs_jccc');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  $sql = "SELECT comments, name, location, rating FROM testimonials ORDER BY RAND() LIMIT 1";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();
  echo json_encode($row);

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if ($_POST['comments'] && $_POST['name'] && $_POST['location'] && $_POST['rating'] &&
      $stmt = $db->prepare("INSERT INTO testimonials (comments, name, location, rating) VALUES (?, ?, ?, ?)")) {
    $stmt->bind_param('sssi', $_POST['comments'], $_POST['name'], $_POST['location'], $_POST['rating']);
    $stmt->execute();
    $stmt->close();
    echo "OK";
  }
  else {
    echo "ERROR - POST with 'comments', 'name', 'location', 'rating'";
  }

}

$db->close();
