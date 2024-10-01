<?php
session_start();
if(isset($_SESSION['username']))
header("Location:home");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            height:940px;
            width:1512px;
            background-color:#000000;
        }
        #first{
            position:absolute;
            left:589px;
            top:135px;
            height:136px;
            width:142px;
        }
        #second{
            position:absolute;
            left:782px;
            top:168px;
            height:70px;
            width:141px;
        }
        #third{
            position:absolute;
            left:249px;
            top:339px;
            height:152px;
            width:1014px;
        }
        button{
            border-radius:50px;
            height:83px;
            width:282px;
            position:absolute;
            top:591px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:40px;

        }
        #log{
            left:332px;
            background-color:white;
        }
        #sign{
            left:857px;
            background-color:#5E1857;
            color:white;
        }
        #main{
            position:relative;
            left:130px;
        }
    </style>
</head>
<body>
    <!-- <button onClick="location.href='login.php'">Login</button><br>
    <button onClick="location.href='signup.php'">Signup</button> -->
    <div id='main'>
    <img src="./icon/Son.png" id="first">
    <img src="./icon/Sonix.png" id="second">
    <img src="./icon/unlock.png" id="third">
    <button onClick="location.href='login.php'" id="log">Login</button>
    <button onClick="location.href='signup.php'" id="sign">Signup</button>
    </div>
    
</body>
<script>
   
</script>
</html>