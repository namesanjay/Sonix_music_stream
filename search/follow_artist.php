<?php
include('../connection.php');
session_start();

if($_SERVER['REQUEST_METHOD']==="POST"){ 
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    // echo $data;

    $sql="call followed_list('$data')";
     $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);



    // $user=$_SESSION['username'];
    // $table=$user.'_follow';
    
    // $sql='select u.name,u.Username,ar.image from anish10_follow a inner join user u on a.artist=u.Username  inner join artist ar on a.artist=ar.artist_username';
    // $result=mysqli_query($conn,$sql);
    // $row=mysqli_fetch_all($result,MYSQLI_ASSOC);

    $response=[
        "artist"=>$row
       ];

    echo json_encode($response);

}