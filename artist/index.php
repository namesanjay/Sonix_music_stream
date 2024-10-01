<?php
  session_start();
  if(!isset($_SESSION['artist_username'])){
    exit();
  }
  echo $_SESSION['artist_username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div onclick="location.href='view_song.php'">Songs</div>
    <div>Albums</div>
    <div onclick="location.href='create_alb.php'">Create Album</div>
    <div onclick="location.href='upload.php'">Add Song</div>
    <div>Bio</div>
</body>
</html>