<?php
include('../connection.php');

if($_SERVER['REQUEST_METHOD']==="POST"){ 
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    // echo $data;
    $sql="select a.album_name,a.release_year,a.genre,a.thumbnail,u.name from album a inner join user u on a.artist_username=u.Username where a.artist_username='$data'";
    $result=mysqli_query($conn,$sql);
  
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);

    // $response=[
    //     "alb"=>$row
    // ];
    // echo json_encode($response);
    echo json_encode($row);
}