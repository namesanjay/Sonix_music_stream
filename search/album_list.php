<?php
include('../connection.php');

if($_SERVER['REQUEST_METHOD']==="POST"){ 

    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    $sql="select s.song_id,u.name,a.thumbnail from album a inner join user u on a.artist_username=u.Username inner join song s on s.singer=a.artist_username where a.album_name='$data'";
    $result=mysqli_query($conn,$sql);

    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);

    $response=[
        $song=>$row;
    ];

    echo json_encode($response);

}