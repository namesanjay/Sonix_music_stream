<?php
include("connection.php");
if($conn){
    echo "Connection successful<br>";
}

echo "muji";
function check_user($con,$user){
    $sql="select * from User where Username='$user'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)==0)
    return true;
    return false;
}

function check_email($con,$email){
    $sql="select * from User where Email='$email'";
    $result=mysqli_query($con,$sql);
    if((mysqli_num_rows($result))==0)
    return true;
    return false;
}
function tables($conn,$user){
    $sql="call liked_table('$user')";
    mysqli_query($conn,$sql);
    $sql="call follow_table('$user')";
    mysqli_query($conn,$sql);
    $data=$user.'_liked';
    echo "<br>Data=$data";
    $sql="insert into liked values('$user','$data')";
    mysqli_query($conn,$sql);
    $sql="insert into followers_table values('$user','$data')";
    mysqli_query($conn,$sql);
    
}



$username=$_POST['username'];
$username=strtolower($username);
$email=$_POST['email'];
$email=strtolower($email);
$password=$_POST['password'];
$name=$_POST['Fullname'];
if(check_user($conn,$username)){
    if(check_email($conn,$email)){
        $sql="insert into user (Email,password,name,Username) values('$email','$password','$name','$username')";
        mysqli_query($conn,$sql);
        tables($conn,$username);
        header("Location:login.php");
        
    }else{
        echo "Email already exist";
        $message="Email already exist";
        header ("Location:signup.php?email=".urlencode($message));
    }
}else{
    if(check_email($conn,$email)){
        $message="Username already exist";
        header("Location:signup.php?username=".urlencode($message));
        echo "Username already exist";
    }else{
        $message1="Email already exist";
        $message2="Username already exist";
        header("Location:signup.php?email=".urlencode($message1)."&username=".urlencode($message2));
        echo "Email and Username already exist";
    }
}
mysqli_close($conn);
// $sql3="insert into user (Email,password,name,Username) values('$email','$password','$name','$username')";



?>