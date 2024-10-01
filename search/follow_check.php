<?php
include('../connection.php');
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    // echo $data;

    $user=$_SESSION['username'];
    $table=$user.'_follow';
    
    $sql="select * from $table where artist='$data'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==0)
    echo "false";
    else
    echo "true";
}