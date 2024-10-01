<?php
    // session_start();?

    include("temp.php");
    include("index.php");
    if(!isset($_SESSION['username'])){
        echo "Login First";
        exit();
    }
?>
<?php if (isset($_GET['message'])): ?>
        <p><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?> 
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
#file_name{
    height:66px;
    width:430px;
    position:absolute;
    left:103px;
    background-color:#F5793E;
    border-radius:50px;
    top:562px;
    font-size:30px;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
}
#text{
    height:400px;
    width:400px;
    position:absolute;
    top:74px;
    left:700px;
    font-size:20px;
    border-radius:25px;
}
#btn{
    position:absolute;
    top:562px;
    left:780px;
    height:66px;
    width:252px;
    background-color:#F5793E;
    border-radius:50px;
    font-size:25px;
    color:white;

}
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<body>
    <div id="root">
    <form method="post" action='artist.php' id="myform" enctype='multipart/form-data'>
        <div class='file-upload' onclick="document.getElementById('image').click()">
        <img src="../icon/upl.png" >
       <input type="file" id="image" placeholder="select image" name="image" required hidden>
        </div>
       <label id="file_name" onclick="document.getElementById('image').click()">Choose Profile Picture</label> 
        <textarea name="desc" id="text"  placeholder="Description about Yourself"></textarea>
        <button onclick="check()" id="btn">Create as Artist</button>
    </form> 
    </div>
    <script>
        $('#image').on("change",function(){
            var fileName=$(this).val().split("\\").pop();
            $(this).siblings("#fil_name").addClass("selected").html(fileName);
        });
        function check(){
            var image=document.getElementById('image').value;
            let form=document.getElementById('myform');
            // console.log(image)
            if(image!=''){
                var checking=image.toLowerCase();
                if(!checking.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG)$/)){
                    alert("Please select jpg,png,jpeg file");
                    document.getElementById('image').value="";
                    document.getElementById('file_name').innerHTML="Choose file";
                    return;
                }
                else{
                    form.submit();
                }
            }
        }
    </script>
</body>
</html>