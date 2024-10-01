<?php
    session_start();
    if(!isset($_SESSION['artist_username']))
    exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="create.php" method="post" id="form" enctype='multipart/form-data'>
        <input type="text" name='album_name' plcaeholder="Album Name"  required>
        <input type="text" name="genre" placeholder="Genre" required>
        <input type="date" name="release_date" required>
        <input type="file" name="image" id="image" required>
        <input type="submit" value="Create">
    </form>
</body>
</html>