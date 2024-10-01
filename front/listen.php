<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include("../connection.php");
            $rawData = file_get_contents("php://input");
            $data = json_decode($rawData, true);
            echo $data["id"];
            // $id=(int) $data;
            $sql="update song set listen=listen+1 where song_id=$id";
            $result=mysqli_query($conn,$sql);
            if(mysqli_affected_rows($conn)>0)
            echo 'Executed';
            else
            echo "muji".mysqli_error($conn);
    }
?>