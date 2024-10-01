<?php
session_start();
echo $_SESSION['username'];
include('../connection.php');
if($_SERVER['REQUEST_METHOD']=="POST"){
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    $username=$_SESSION['username'];
    echo "<br/>$data<br/>";
    $id=(int)$data;
    // $sql="call song_like('$username',$id)";
    // if(mysqli_query($conn,$sql)){
    //     echo "executed";
    // }else{
    //     echo "Not executed";
    // }
    $table=$username.'_liked';
    $sql="select song_id from $table where song_id=$id";
    $result=mysqli_query($conn,$sql);
    echo "<br>".$id."<br>";
    echo mysqli_num_rows($result);
    if(mysqli_num_rows($result)==0){
        // $sql1="insert into $table value($id)";
        // $sql2="update song set likes=likes+1 where song_id=$id";
        // if(mysqli_query($conn,$sql1)){
        //     if(mysqli_query($conn,$sql2)){
        //         echo "Executed";
        //     }else{
        //         echo 'Not executed 2';
        //     }
        // }
        // else{
        //     echo 'Not executed 1'.mysqli_error($conn);
        // }
        $sql1="call song_like('$username',$id)";
        $result=mysqli_query($conn,$sql1);
        if(mysqli_affected_rows($conn)>1){
            echo "Executed successfully";
        }
        else{
            echo "".mysqli_error($conn);
        }
    
    }
    else{
        echo "Not executed 0";
    }
    
}