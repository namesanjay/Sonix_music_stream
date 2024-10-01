<?php
    // session_start();
    // if(!isset($_SESSION['artist_username']))
    // exit();
    include('index.php');
    include('temp.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         #root{
        background-image:url('../icon/back.png');
        height:663px;
        width:1240px;
        position:absolute;
        top:166px;
        left:402px;
    }
    .file-upload{
        height:406px;
        width:430px;
        /* background-image:url('../icon/upload1.jpg');
        background-size:cover; */
        background-color:#571A4F;
        display:flex;
        justify-content:center;
        align-items:center;
        border-radius:40px;
        position:relative;
    top:74px;
    left:103px;
    }
    
.file-upload input[type="file"] {
    display: none;
}
.file-upload>img{
    height:110px;
    width:100px;
}

#alb,#gen,#yr{
        position:absolute;
        left:620px;
        height:69px;
        width:509px;
        border-radius:25px;
        font-size:24px;
    }
    #alb{
        top:134px;
    }
    #gen{
        top:223px;
    }
    #yr{
        top:312px;
    }
    #sub{
        position:absolute;
        height:66px;
        width:252px;
        border-radius:50px;
        left:749px;
        top:480px;
        font-size:40px;
        background-color:#F5793E;
        color:white;
    }
    </style>
</head>
<body>
    <div id="root">
    <form action="create.php" method="post" id="form" enctype='multipart/form-data'>
        <input type="text" id="alb" name='album_name' placeholder="Album Name"  required>
        <input type="text" id="gen" name="genre" placeholder="Genre" required>
        <input type="date" id="yr" name="release_date" required>
        <div class='file-upload' onclick="document.getElementById('image').click()">
        <img src="../icon/upl.png" >
        <input type="file" name="image" id="image" required>
        </div>
        <input type="submit" id="sub" value="Create">
    </form>
    </div>
</body>
</html>