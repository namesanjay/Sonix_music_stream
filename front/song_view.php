<?php
include('../connection.php');
if($_SERVER['REQUEST_METHOD']=="POST"){
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    // $data="32";
    // echo "data=$data";
    $id=(int)$data['id'];
    // echo $id;
    $sql="select audio from song where song_id=$id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    echo $row['audio'];

    $sql="update song set listen=listen+1 where song_id=$id";
    mysqli_query($conn,$sql);
}