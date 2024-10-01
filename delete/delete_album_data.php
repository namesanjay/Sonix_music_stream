<?php
include('../connection.php');
session_start();
if(isset($_SESSION['artist_username']) && $_SERVER['REQUEST_METHOD']==="POST"){
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    $sql="call delete_album('$data')";
    $result=mysqli_query($conn,$sql);
    if(mysqli_affected_rows($conn)>0){
        echo "Successfully deleted";
    }else{
        echo "Error Occured";
    }
}
?>
