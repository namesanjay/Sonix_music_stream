<?php
include("../connection.php");
session_start();
$alb=$_SESSION['artist_username'];
$sql="select album_name from album where artist_username='$alb'";
$output=[];
$result=mysqli_query($conn,$sql) or die("SQL failed");
// if(mysqli_num_rows($result)>0){
//     while($row=mysqli_fetch_assoc($result)){
//         $output[]=$row;
//     }
// }
$output=mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_close($conn);
// echo $output;
echo json_encode($output);

?>