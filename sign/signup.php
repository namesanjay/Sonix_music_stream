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
    }
    #icon3{
        position:absolute;
        left:1576px;
        top:65px;
        width:83px;
        height:80px;
    }
    #icon4{
        position:absolute;
        left:63px;
        top:96px;
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
    #container{
        position:absolute;
        left:869px;
        top:202px;
        height:800px;
        width:815px;
        border-radius: 25px;
        background-image: url('./white.png');
    }
    input{
        height:50px;
        width:427px;
        border-radius:40px;
        margin-bottom:36px;
        position:relative;
        left:30px;
        top:254px;
        font-size:30px;
        font-weight:500;
        padding-left:20px;
    }
    #icon6,#icon7{
        position:relative;
        top:270px;
        right:30px;
    }
    button{
        position:relative;
        left:170px;
        top:250px;
        height:80px;
        width:506px;
        border-radius:32px;
        background-color:#782386;
        font-size:35px;
        font-weight:500;
        color:white;
    }
    </style>
</head>
<body>
<div>
        <form action="signup_check.php" method="post" id="myform" onsubmit="event.preventDefault()">
        <img src="./icon.png" alt="No Object" id="icon">
        <img src="./SONIX.png" alt="No Object" id="icon1">
        <img src="./girl.png" alt="No object" id="icon2">
        <img src="./Undo.png" alt="No object" id="icon3">
        <div id="container">
        <img src="./sign.png" alt="" id="icon5">
        <img src="./Signup.png" alt="No object" id="icon4">
        <input type="text" id="in1" required placeholder="Enter Full Name" name="Fullname">
        <input type="email" id="in2" required placeholder="Enter Email" name="email">
        <input type="text" id="in3" required placeholder="Enter username" name="username">
        <input type="password" id="in4" required placeholder="Enter Password" name="password">
        <span class="toggle-password" onclick="togglePassword('in4')">
                <img src="./toggle.png" id="icon6">
            </span>
        <input type="password" required id="in5" placeholder="Confirm Password">
        <span class="toggle-password" onclick="togglePassword1('in5')">
                <img src="./toggle.png" id="icon7">
            </span>
            <button  onclick="verification()">Signup</button>
    </form>
    </div>
    <script>
         function togglePassword() {
            var passwordField = document.getElementById('in4');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
        function togglePassword1() {
            var passwordField = document.getElementById('in5');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
        function valid(){
            let name=document.getElementById('in1').value;
            let username=document.getElementById('in2').value;
            let pattern1=/^[a-zA-Z\s'-]{1,50}$/;
            // var pattern2= /^(?!.*[-_]{2})(?=[a-zA-Z0-9])[a-zA-Z0-9-_]{3,15}(?<![-_])$/;
            let v1=true;
            let v2=true;
            if(!name.match(pattern1)){
                alert("Enter name format correctly")
                v1=false;
            }
            // if(!username.match(pattern2)){
            //     alert("Enter username format correctly")
            //     v2=false;
            // }
            // console.log(v)
            if(v1===false || v2===false)
            return false;
            else 
            return true;
        }
        function verification(){
            if(!valid()){
                return;
            }
            let p1=document.getElementById('in5').value
            let p2=document.getElementById('in4').value
            let form=document.getElementById('myform')
            console.log(form.elements)
            if(p1===p2 && p1.length>0){
                for(let i=0;i<form.elements.length;i++){
                    if(form.elements[i].value==='' && form.elements[i].hasAttribute('required')){
                        alert("Enter the data in all required field")
                        return;
                    }
                }
                form.submit();
            }else{
                alert("Password didn't match")
            }

        }
        
    </script>
</form>
</div>
</body>
</html>
