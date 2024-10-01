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
            height:159px;
            width:182.25px;
            top:414px;
            left:393px;
        }
        #second{
            position:absolute;
            top:0px;
            left:992px;
            height:277px;
            width:277px;
            z-index:3;
        }
        #icon{
            position:absolute;
            top:468px;
            left:576px;
            width:200px;
            height:60px;
            z-index:2;
        }
        #box{
            background-color:white;
            position:absolute;
            height:753px;
            width:812px;
            top:185px;
            left:697px;
            border-radius:25px;
        }
        #third{
            position:absolute;
            top:0px;
            left:473px;
            width:363px;
            height:384px;
            overflow:hidden;
        }
        #fourth{
            font-size:40px;
            font-weight:900;
            Color:#5E1857;
            text-decoration:line;
            position:absolute;
            top:60px;
            left:162px;

        }
        #fifth{
            position:absolute;
            top:165px;
            left:162px;
            height:28px;
            width:450px;
        }
        #six{
            position:absolute;
            left:162px;
            top:260px;
            height:32.52px;
            width:38.5px;
        }
        #sev{
            position:absolute;
            left:162px;
            top:371px;
            height:44px;
            width:44px;
        }
        #user{
            position:absolute;
            top:260px;
            left:245px;
            height:44px;
            width:321px;
        }
        #pass1{
            position:absolute;
            top:371px;
            left:245px;
            height:44px;
            width:321px;
        }
        #chk{
            position:absolute;
            left:162px;
            top:440px;
            height:44px;
            width:44px;
        }
        #show{
            position:absolute;
            top:445px;
            left:245px;
            height:44px;
            width:321px;
            font-size:30px;
        }
        button{
            position:absolute;
            top:524px;
            left:271px;
            height:90px;
            width:257px;
            border-radius:32px;
            background-color:#782386;
            color:black;
        }
    </style>
</head>
<body>

<?php if (isset($_GET['message'])): ?>
        <p><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>
    <!-- <form action="login_check.php" method="post" id="myform" onsubmit="event.preventDefault()">
        <input type="text" name="username" id="user" required placeholder="Enter Username">
        <br>
        <input type="password" name="password" id="pass1" placeholder="Enter Password" required><br>
        <input type="checkbox" id="chk" onclick="togglePass('pass1')"><label for="chk">Show Password</label><br>
        <button onclick="validate()" name="btn">Login</button>
    </form> -->

    <div id="main">
    <form action="login_check.php" method="post" id="myform" onsubmit="event.preventDefault()">
       
        
        <br>
        <!-- <input type="password" name="password" id="pass1" placeholder="Enter Password" required><br> -->
        <!-- <input type="checkbox" id="chk" onclick="togglePass('pass1')"><label for="chk">Show Password</label><br> -->
       
        <img src="./icon/Son.png" id='first'>
        <img src="./icon/girl.png" id="second">
        <img src="./icon/Sonix1.png" id="icon">
        <div id="box"> 
            <img src="./icon/eclipse1.png" id="third"/>
            <h1 id="fourth">Login</h1>
            <img src="./icon/new_user.png" id="fifth">
            <label for="user"><img src="./icon/user.png" id="six"></label>
            <label for="pass1"><img src="./icon/pass.png" id="sev"></label>
            <input type="text" name="username" id="user" required placeholder="Enter Username">
            <input type="password" name="password" id="pass1" placeholder="Enter Password" required><br>

            <input type="checkbox" id="chk" onclick="togglePass('pass1')"><label for="chk" id="show">Show Password</label><br>
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

        function togglePass(val){
            let p1=document.getElementById(val)
            if(p1.type=='password')
            p1.type='text';
            else
            p1.type='password';
        }
</script>
</body>
</html>
