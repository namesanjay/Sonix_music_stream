<?php
include('../connection.php');
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    // echo $data;

    $user=$_SESSION['username'];
    $sql="call artist_fav('$user','$data')";
    if(mysqli_query($conn,$sql)){
        echo "Executed Successfully";
        $sql="update artist set followers=followers+1 where artist_username='$data'";
        mysqli_query($conn,$sql);
    }
    
    else
    echo "Already followed".mysqli_error($conn);
    mysqli_close($conn);
}