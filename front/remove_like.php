<?php
include("../connection.php");
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    $username=$_SESSION['username'];
    $id=(int) $data['id'];
    $table=$username.'_liked';
    $sql="delete from $table where song_id=$id";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_affected_rows($conn);
    if($num>0)
    echo "Successfully removed";
    else
    echo "NOt performed";
}