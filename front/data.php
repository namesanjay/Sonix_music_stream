<?php
include('../connection.php');

$sql="select u.name,a.image,a.artist_username from artist a inner join user u on a.artist_username=u.Username ORDER BY a.followers DESC LIMIT 10";
$result=mysqli_query($conn,$sql);
$artist=mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql="select u.name,a.album_name,a.thumbnail from album a inner join user u on a.artist_username=u.Username order by rand() limit 10";
$result=mysqli_query($conn,$sql);
$album=mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql="SELECT s.audio, s.song_id, s.title, u.name AS singer_name, u1.name AS collab_singer1_name, u2.name AS collab_singer2_name, u3.name AS collab_singer3_name, u4.name AS collab_singer4_name, s.album_name, s.likes, s.listen, a.thumbnail FROM song s INNER JOIN album a ON s.album_name = a.album_name INNER JOIN user u ON s.singer = u.Username LEFT JOIN user u1 ON s.collab_singer1 = u1.Username LEFT JOIN user u2 ON s.collab_singer2 = u2.Username LEFT JOIN user u3 ON s.collab_singer3 = u3.Username LEFT JOIN user u4 ON s.collab_singer4 = u4.Username  order by s.listen desc LIMIT 10";
$result=mysqli_query($conn,$sql);
$song=mysqli_fetch_all($result,MYSQLI_ASSOC);

$response=[
    "artist"=>$artist,
    "album"=>$album,
    "song"=>$song
];

echo json_encode($response);

?>