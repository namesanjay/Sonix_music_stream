<?php
include("../connection.php");
session_start();
if(isset($_SESSION['artist_username']) && $_SERVER['REQUEST_METHOD']==='POST'){
    $rawData = file_get_contents("php://input");
    // include("../connection.php");
    // Decode the JSON data
    $data = json_decode($rawData, true);
    $album=$data['album'];
    $album=strtolower($album);
    $sql="select count(*) as num from album where album_name='$album'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    echo $row['num'];
}