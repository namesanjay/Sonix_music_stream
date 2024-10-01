<?php
include("../connection.php");
session_start();
function check_user($con,$user){
    $sql="select * from Artist where artist_username='$user'";
    $result=mysqli_query($con,$sql);
    if((mysqli_num_rows($result))==0)
    return true;
    return false;
}

if(isset($_SESSION['username'])){    
    $username=$_SESSION['username'];
    if(check_user($conn,$username)){
        $imageNameNew;
        $imagename=$_FILES['image']['name'];
        $imagetemp=$_FILES['image']['tmp_name'];
        $FileType=$_FILES['image']['type'];
        $FileError=$_FILES['image']['error'];
        $fileExt=explode('.',$imagename);
        $fileActualExt=strtolower(end($fileExt));
        $allowed=array('jpg','jpeg','png');
        if(in_array($fileActualExt,$allowed)){
            if($FileError===0){
            $imageNameNew=uniqid('',true).".".$fileActualExt;
            $destination='../user_image/'.$imageNameNew;
            move_uploaded_file($imagetemp,$destination);
            }else{
                echo"There was error in image uploading your file";
                exit();
            }
         }
    if($_POST['desc']==""){
        $sql="insert into Artist(artist_username,image) values('$username','$imageNameNew')";
       mysqli_query($conn,$sql);
       session_start();
       $_SESSION['artist_username']=$username;
       header("Location:../artist");
       mysqli_close($conn);
    //    echo "Successfully created";
       
    }else{
        $desc=$_POST['desc'];
        $sql="insert into Artist(artist_username,description,image) values('$username','$desc','$imageNameNew')";
        mysqli_query($conn,$sql);
        $_SESSION['artist_username']=$username;
        mysqli_close($conn);
        header("Location:../artist");
    }
}
else{
    echo "User already exist available";
    $message = "Artist already created";
    mysqli_close($conn);
    header("Location: home.php?message=" . urlencode($message));
}
}
?>