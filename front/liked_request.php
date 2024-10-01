<?php
include('../connection.php');
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=$_SESSION['username'];
    $sql="call liked_song('$username')";
    $result=mysqli_query($conn,$sql);
    $song=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($song);
}
?>