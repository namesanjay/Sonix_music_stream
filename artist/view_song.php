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
    <button id="btn">Load</button>

    <script>
        let btn=document.getElementById('btn');

    </script>
</body>
</html>