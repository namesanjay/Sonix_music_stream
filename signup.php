<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            height:100vh;
            width:100vw;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        #main{
            position:relative;
            height:956px;
            width:1512px;
            background-image:url("./icon/Login.png");
            overflow:hidden;
        }
        #first{
            position:absolute;
            height:114px;
            width:131px;
            top:419px;
            left:454px;
        }
        #icon{
            position:absolute;
            top:450px;
            left:594px;
            width:169px;
            height:50px;
            z-index:3;
        }
        #second{
            position:absolute;
            top:0px;
            left:992px;
            height:277px;
            width:277px;
            z-index:3;
        }
        #box{
            position:absolute;
            left:706px;
            top:181px;
            width:815px;
            height:753px;
            border-radius:25px;
            background-color:#ffffff;
        }
        #eclipse{
            position:absolute;
            top:0px;
            left:481px;
            height:336px;
            width:332px;
        }
        #sign{
            font-size:40px;
            font-weight:900;
            position:absolute;
            top:72px;
            left:213px;
            color:#5E1857;
        }
        #name{
            position:absolute;
            top:193px;
            left:213px;
            height:50px;
            width:427px;
            border-radius:40px;
        }
        #user{
            position:absolute;
            top:262px;
            left:213px;
            height:50px;
            width:427px;
            border-radius:40px;
        }
        #email{
            position:absolute;
            top:331px;
            left:213px;
            height:50px;
            width:427px;
            border-radius:40px;
        }
        #pass1{
            position:absolute;
            top:400px;
            left:213px;
            height:50px;
            width:427px;
            border-radius:40px;
        }
        #pass2{
            position:absolute;
            top:469px;
            left:213px;
            height:50px;
            width:427px;
            border-radius:40px;
        }
    </style>
</head>
<body>
    <?php?>

    <!-- <h1>SIGNUP PAGE</h1> -->
    <div id="main">
    <form action="signup_check.php" method="post" id="signup_form" onsubmit="event.preventDefault()">
       
         <img src="./icon/Son.png" id='first'>
         <img src="./icon/girl.png" id="second">
         <img src="./icon/Sonix1.png" id="icon">
         <div id="box">
            <img src="./icon/eclipse2.png" id="eclipse">
            <h1 id="sign">Sign up</h1>


            <input type="text" name="Fullname" id="name" required placeholder="Enter Fullname"><br>
            <input type="text" name="username" id="user" required placeholder="Enter username"><br>
            <?php
            if(isset($_GET['username']))
            echo htmlspecialchars($_GET['username'])."<br>";
            ?>
            <input type="email" name="email" id="email" required placeholder="Enter email"><br>
            <?php
            if(isset($_GET['email']))
            echo htmlspecialchars($_GET['email'])."<br>";
            ?>
        <input type="password" name="password" id="pass1" required placeholder="Enter password"><br>
        <!-- <input type="checkbox" onclick="toggle_pass('pass1')" id="chk1"> <label for="chk1">Show Password</label> <br> -->
        <input type="password" id="pass2" required placeholder="Enter password"><br>
        <!-- <input type="checkbox" onclick="toggle_pass('pass2')" id="chk2"> <label for="chk2">Show Password</label> <br> -->
        <!-- <button onclick="check()">Submit</button> -->
         <button onclick='check()' name='signup'>Signup</button>
         </div>
    </form>
    </div>
    <script>
        function valid(){
            let name=document.getElementById('name').value;
            let username=document.getElementById('user').value;
            let pattern1=/^[a-zA-Z\s'-]{1,50}$/;
            var pattern2= /^(?!.*[-_]{2})(?=[a-zA-Z0-9])[a-zA-Z0-9-_]{3,15}(?<![-_])$/;
            let v1=true;
            let v2=true;
            if(!name.match(pattern1)){
                alert("Enter name format correctly")
                v1=false;
            }
            if(!username.match(pattern2)){
                alert("Enter username format correctly")
                v2=false;
            }
            // console.log(v)
            if(v1===false || v2===false)
            return false;
            else 
            return true;
        }
        function check(){
            if(!valid()){
                return;
            }
            let p1=document.getElementById('pass1').value
            let p2=document.getElementById('pass2').value
            let form=document.getElementById('signup_form')
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

        function toggle_pass(val){
            
            let p1=document.getElementById(val)
            console.log(p1);
            if(p1.type=='password')
            p1.type='text';
            else
            p1.type='password';
        }

    </script>
</body>
</html>