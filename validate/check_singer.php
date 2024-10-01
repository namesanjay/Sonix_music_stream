<?php
include("../connection.php");
session_start();
if(isset($_SESSION['artist_username']) && $_SERVER['REQUEST_METHOD']==='POST'){
    $rawData=file_get_contents("php://input");
    $data=json_decode($rawData,true);
    $user=strtolower($data['user']);
    // echo $user;
    // echo $_SESSION['artist_username'];
    if($_SESSION['artist_username']===$user)
    echo 3;
    else{
        $sql="select count(*) as num from Artist where artist_username='$user'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        echo $row['num'];
    }
}