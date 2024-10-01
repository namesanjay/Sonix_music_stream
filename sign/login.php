<?php
    session_start();
    if(isset($_SESSION['username']))
    header("Location:home/index.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
         height:100vh;
         width:100wh;
        display:flex;
        justify-content: center;
        align-items: center;
        background-color: aqua;
        }
    div{
        width:1728px;
        height:1117px;
        background-color: azure;
        background-image: url('./background.jpg');
        border-radius: 60px;
        position:relative;
    }
    #icon{
        position:absolute;
        left:508px;
        top:331px;
        height:159px;
        width:182.65px;
    }
    #icon1{
        position:absolute;
        left:499px;
        top:529px;
        height:60px;
        width:200px;
    }
    #icon2{
        position:absolute;
        left:1113px;
        top:-11px;
        width:277px;
        height:277px;
        z-index: 2;
    }
    #icon3{
        position:absolute;
        left:1576px;
        top:65px;
        width:83px;
        height:80px;
    }
    #container{
        position:absolute;
        left:869px;
        top:202px;
        height:753px;
        width:815px;
        border-radius: 25px;
        background-image: url('./white.png');
    }
    #icon4{
        position:absolute;
        left:63px;
        top:36px;
        height:60px;
        width:184px;
        z-index: 2;
    }
    #icon5{
        position:absolute;
        left:375px;
        top:13px;
        width:429px;
        height:398px;
    }
    #icon6{
        position:absolute;
        left:79px;
        top:188px;
        width:456px;
        height:30px;
    }
    #icon7{
        position:absolute;
        left:87px;
        top:318px;
        height:38px;
        width:44px;
    }
    /* left:869 
        top: 202
     */
    #user{
        position:absolute;
        left:167px;
        top:315px;
        height:37px;
        width:321px;
        font-size:large;
        padding-bottom: 10px;
        font-weight: 600;
    }
    #icon8{
        position: absolute;
        top:454px;
        left:87px;
    }
    #pass1{
        position:absolute;
        left:167px;
        top:454px;
        height:37px;
        width:321px;
        font-size:larger;
        padding-bottom: 10px;
        font-weight: 600;
    }
    #icon9{
        position: absolute;
        left:430px;
        top:457px;
        height:38px;
        width:38px;
    }
    #icon10{
        position: absolute;
        left:265px;
        top:537px;
        height:34;
        width:231px; 
    }
    button{
        position: absolute;
        left:180px;
        top:630px;
        height:86px;
        width:494px;
        background-color: blueviolet;
        border-radius:32px ;
        font-size: 45px;
        font-weight: 700;
    }
    </style>
</head>
<body>
    <div>
    <?php if (isset($_GET['message'])): ?>
        <p><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>
        <form action="login_check.php" method="post" id="myform" onsubmit="event.preventDefault()">
        <img src="./icon.png" alt="No Object" id="icon">
        <img src="./SONIX.png" alt="No Object" id="icon1">
        <img src="./girl.png" alt="No object" id="icon2">
        <img src="./Undo.png" alt="No object" id="icon3">
        <div id="container">
            <img src="./Login.png" alt="" id="icon4">
            <img src="./log.png" alt="No object" id="icon5">
            <img src="./new_user.png" alt="" id="icon6" onclick="change()">
            <label for="Username"><img src="./user.png" id="icon7"></label>
            <input type="text" id="user" required placeholder="  Enter Username" name="username">
            <label for="password"><img src="pass.png" alt="no" id="icon8"></label>
            <input type="password" id="pass1" name="password" placeholder=" Enter Password" name="password">
            <span class="toggle-password" onclick="togglePassword()">
                <img src="./toggle.png" id="icon9">
            </span>
            <img src="forgot.png" alt="" id="icon10">
            <button onclick="validate()" name="btn">Login</button>
        </div>
        </form>
    </div>
    <script>
         function valid(){

let username=document.getElementById('user').value;
var pattern2= /^(?!.*[-_]{2})(?=[a-zA-Z0-9])[a-zA-Z0-9-_]{3,15}(?<![-_])$/;
if(!username.match(pattern2)){
    alert("Enter username format correctly")
   return false;
}
// console.log(v)
return true;
}
        function togglePassword() {
            var passwordField = document.getElementById('pass1');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
        function validate(){
        if(valid()){
            let form=document.getElementById('myform');
            for(let i=0;i<form.elements.length;i++){
                    if(form.elements[i].value==='' && form.elements[i].hasAttribute('required')){
                        alert("Enter the data in all required field")
                        return;
                    }
                }
                form.submit();
            }else
            alert("Username format incorrect")
        }
    </script>
</body>
</html>
<?php
   

?>