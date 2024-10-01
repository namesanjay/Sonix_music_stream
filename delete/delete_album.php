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
    <form id='form'>
        <input type="text" placeholder="Album Name" name="album">
        <button type="submit">Submit</button>
    </form>
    <script>
        async function sub(formData){
            let data={
                method:"POST",
                body:formData
            };
            let array=await fetch("http://localhost/project/delete/delete_album_data.php",data)
            let response=await array.text();
            return response;
        }
        document.getElementById('form').addEventListener('submit',async function(e){
            e.preventDefault();
            const formData=new FormData(this);
            console.log(formData);
            let val=await sub(formData);
            console.log(val);
        }) 
    </script>
</body>
</html>