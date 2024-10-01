<?php
include("../connection.php");

session_start();
// echo $_SESSION['artist_username'];
if($_SERVER['REQUEST_METHOD']==="POST"){ 

    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    // print_r($data);
    $search=$data;
    // echo $search;

   $sql="select u.name,a.image,a.artist_username from artist a inner join user u on u.Username=a.artist_username where u.name like CONCAT('%','$search','%')";
   $album=null;
   $result=mysqli_query($conn,$sql);
   $artist=mysqli_fetch_all($result,MYSQLI_ASSOC);
    
//    if(mysqli_num_rows($result))

// //    $sql="select a.album_name,a.genre,a.release_year,a.thumbnail,u.name from album a inner join user u on a.artist_username=u.Username where album_name like CONCAT('%','$search','%')";
//    $result=mysqli_query($conn,$sql);
//    $album=mysqli_fetch_all($result,MYSQLI_ASSOC);



//    $sql="select s.audio,s.song_id,s.title,s.singer,s.collab_singer1,s.collab_singer2,s.collab_singer3,s.collab_singer4,s.album_name,s.likes,s.listen,a.thumbnail from song s inner join album a on s.album_name=a.album_name WHERE s.title LIKE CONCAT('%', '$search', '%') OR s.album_name LIKE CONCAT('%', '$search', '%')";
$sql="SELECT s.audio, s.song_id, s.title, u.name AS singer_name, u1.name AS collab_singer1_name, u2.name AS collab_singer2_name, u3.name AS collab_singer3_name, u4.name AS collab_singer4_name, s.album_name, s.likes, s.listen, a.thumbnail FROM song s INNER JOIN album a ON s.album_name = a.album_name INNER JOIN user u ON s.singer = u.Username LEFT JOIN user u1 ON s.collab_singer1 = u1.Username LEFT JOIN user u2 ON s.collab_singer2 = u2.Username LEFT JOIN user u3 ON s.collab_singer3 = u3.Username LEFT JOIN user u4 ON s.collab_singer4 = u4.Username WHERE s.title LIKE CONCAT('%', '$search', '%') OR s.album_name LIKE CONCAT('%', '$search', '%')";
    $result=mysqli_query($conn,$sql);
   $song=mysqli_fetch_all($result,MYSQLI_ASSOC);
//    $album=mysqli_fetch_all($result,MYSQLI_ASSOC);

   $response=[
    "artist"=>$artist,
    "songs"=>$song
   ];
   echo json_encode($response);
    
    // $sql="Select * from album";
}
?>
