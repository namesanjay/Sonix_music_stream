<?php
include('../connection.php');
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    // echo $data;

    $user=$_SESSION['username'];
    // $sql="call artist_fav('$user','$data')";
    $table=$user.'_follow';
    $sql="delete from $table where artist='$data'";
    if(mysqli_query($conn,$sql)){
        echo "Executed Successfully";
        $sql="update artist set followers=followers-1 where artist_username='$data'";
        mysqli_query($conn,$sql);
    }
    
    else
    echo "unfollowed".mysqli_error($conn);
    mysqli_close($conn);
}