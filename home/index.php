<?php
include("../connection.php");
if($conn){
    echo "Connection successful";
    
}
session_start();
if(!isset($_SESSION{'username'})){
    echo "Register first";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div{
            border:2px solid black;
            height:20px;
            width:150px;
        }
        div:hover{
            background-color:red;
        }
    </style>
</head>
<body>
    <button onclick="location.href='logout.php'">Logout</button>
    <div onclick="location.href='artist_acount.php'">Create a Artist Acount</div>
</body>
</html>