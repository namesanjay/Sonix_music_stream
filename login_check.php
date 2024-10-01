<?php
include("connection.php");
if($conn){
    echo "connection successful";
}

if(isset($_POST['btn'])){
    echo "randi ko baan";
}
$username=$_POST['username'];
$username=strtolower($username);
$password=$_POST['password'];

print_r($_POST);

function check_user($conn,$user){
    $sql="select * from User where Username='$user'";
    $result=mysqli_query($conn,$sql); 
    if((mysqli_num_rows($result))==1)
    return true;
    return false;
}
function check_artist($user){
    global $conn;
    // $sql="select * from Artist from where artist_username='$user'";
    $sql="select count(*) as num from artist where artist_username='$user'";
    $result=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_assoc($result);
    if($rows['num']=='1')
    return true;
    return false;
}

if(check_user($conn,$username)){
    $sql="select * from User where Username='$username' AND password='$password'";
    $result=mysqli_query($conn,$sql);
    if((mysqli_num_rows($result))==1){
        echo "<h1>Login Successful</h1>";
        session_start();
        $_SESSION['username']=$username;
        $_SESSION['password']=$password;
        if(check_artist($username)){
            $_SESSION['artist_username']=$username;
            mysqli_close($conn);
            header("Location:http://localhost/project/front/home.php");
        }
        mysqli_close($conn);
        header("Location:http://localhost/project/front/home.php");
        
    }else{
        $message = "Password error";
        mysqli_close($conn);
        header("Location: login.php?message=" . urlencode($message));
    }

}else{
    $message = "Username error";
    mysqli_close($conn);
        header("Location: login.php?message=" . urlencode($message));
}

?>