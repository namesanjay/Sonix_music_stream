<?php
session_start();
// if(isset($_SESSION['artist_username'])){
//     exit();
// }
    // <label id="current"><?php echo $album?
include('temp.php');
include('index.php');
echo $_GET['album'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .file-upload input[type="file"] {
    display: none;
    }
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
    <form id='form' method="post">
        <input type="text" name="current" hidden id="current">
        <input type="text" id='alb' name='album_name' placeholder="Album Name" >
        <input type="text"id='gen' name="genre" placeholder="Genre">
        <input type="number" id='yr' name='release' placeholder="release year">
        <div class='file-upload' onclick='alert("muji")'>
        <img src="../icon/upl.png" >
        <input type="file" name="image"  id="image" accept="image/*" hidden>
        </div>
        <input type="submit" id='sub' value="submit">
    </form>
    </div>
    <script>

        function ImageFile() {
        let filename=document.getElementById('image').value
        // console.log(filename)

        const imageExtensions = ['jpg','jpeg','png'];
        function getFileExtension(filename) {
        const match = filename.toLowerCase().match(/\.([^.]+)$/);
        return match ? match[1] : null;
        }
        const extension = getFileExtension(filename);
        if( imageExtensions.includes(extension))
        return true;
        return false
        }


        async function upload(formData){
            console.log("Rando");
            let data={
                method:"POST",
                body:formData
            };
            let array=await fetch("http://localhost/project/update/update_album_data.php",data)
            let response=await array.text();
            console.log("response="),response;
            return response;
        }

        
        function func1(){
            alert("muji");
            let image=document.getElementById('image')
            image.click();
        }

        document.getElementById('form').addEventListener('submit',async function(e){
            e.preventDefault();

            document.getElementById('current').value="<?php echo $_GET['album_name']?>"
            let image=document.getElementById('image')
            if(ImageFile() || image.files.length==0){
                const formData=new FormData(this);
                let v=await upload(formData);
                console.log(v);
            }
        })
    </script>
</body>
</html>