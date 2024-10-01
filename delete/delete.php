<?php
include("../connection.php");
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
    <form id="myform" method="POST">
        <input type="number" name="song_id">
        <button type="submit">Sub</button>
    </form>
    <script>
        async function subm(formData){
            console.log(formData)
            let data={
                method:"POST",
                body:formData
            };
            let array=await fetch("http://127.0.0.1/project/delete/delete_song.php",data);
            let response=await array.text();
            return response;
        }
        document.getElementById('myform').addEventListener('submit',async function(e){
            const formData=new FormData(this);
            e.preventDefault();
            console.log(formData);
            let sub=await subm(formData);
            console.log(sub);
        })
    </script>
</body>
</html>