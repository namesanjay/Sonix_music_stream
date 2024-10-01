<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $rawData = file_get_contents("php://input");
  include("../connection.php");
  // Decode the JSON data
  $data = json_decode($rawData, true);
  $user=$data['user'];
  $sql="select artist_username,count(*) as num from artist where artist_username='$user'";
  $result=mysqli_query($conn,$sql);
  $output=[];
  $output=mysqli_fetch_assoc($result);
  echo json_encode($output);
}
