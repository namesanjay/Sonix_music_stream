<?php
include('../connection.php');
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);
        
        // echo 
        $user=$data;
        $sql="select a.artist_username,a.followers,a.image,u.name from artist a inner join user u on u.Username=a.artist_username where a.artist_username='$user'";
        $result=mysqli_query($conn,$sql);
        $artist=mysqli_fetch_all($result,MYSQLI_ASSOC);

        $sql="select s.audio, s.song_id, s.title, u.name AS singer_name, u1.name AS collab_singer1_name, u2.name AS collab_singer2_name, u3.name AS collab_singer3_name, u4.name AS collab_singer4_name, s.album_name, s.likes, s.listen, a.thumbnail FROM song s INNER JOIN album a ON s.album_name = a.album_name INNER JOIN user u ON s.singer = u.Username LEFT JOIN user u1 ON s.collab_singer1 = u1.Username LEFT JOIN user u2 ON s.collab_singer2 = u2.Username LEFT JOIN user u3 ON s.collab_singer3 = u3.Username LEFT JOIN user u4 ON s.collab_singer4 = u4.Username where s.singer='$user' or s.collab_singer1='$user' or s.collab_singer2='$user' or s.collab_singer3='$user' or s.collab_singer4='$user'";
        $result=mysqli_query($conn,$sql);
        $song=mysqli_fetch_all($result,MYSQLI_ASSOC);

        $response=[
            "artist"=>$artist,
            "song"=>$song
        ];
        echo json_encode($response);
    }
?>