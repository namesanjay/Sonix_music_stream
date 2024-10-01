<?php
    session_start();
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
</head>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<body>
    <form method="post" action='artist.php' id="myform" enctype='multipart/form-data'>
       <input type="file" id="image" placeholder="select image" name="image" required>
       <label id="file_name">Choose file</label> 
        <textarea name="desc"  placeholder="Description about Yourself"></textarea>
        <button onclick="check()">Create as Artist</button>
    </form>
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