<?php
include('../connection.php');
if($_SERVER['REQUEST_METHOD']==="POST"){
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    $id=(int) $data;
    $sql="select * from song where song_id=$id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $sql="call delete_song($id)";
    if(mysqli_query($conn,$sql)){
        $file='../audio/'.$row['audio'];
        if(unlink($file)){
            echo "Delete success";
        }
        else{
            echo "Delete unsucess";
        }
    }
    else{
        echo" bigriyo";
    }
}
?>