<?php

include('../connection.php');
if($conn){
    echo "Success";
}
session_start();
if(isset($_SESSION['artist_username']) && $_SERVER['REQUEST_METHOD']==='POST'){
    echo "muji";
    $current=$_POST['current'];
    $sql="select * from album where album_name='$current'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $release=($_POST['release']==null)?$row['release_year']:$_POST['release'];
    $genre=($_POST['genre']==null)?$row['genre']:$_POST['genre'];
    $album=($_POST['album_name']==null)?$row['album_name']:$_POST['album_name'];
    if($_FILES['image']==null)
    $thumbnail=$row['thumbnail'];

    else{
        $filename=$_FILES['image']['name'];
        $filetmp=$_FILES['image']['tmp_name'];
        $fileExt=explode('.',$filename);
        $fileActualExt=strtolower(end($fileExt));
        $thumbnail=uniqid('',true).".".$fileActualExt;
        $destination="../album_image/".$thumbnail;
        move_uploaded_file($filetmp,$destination);
        $file='../album_image/'.$row['thumbnail'];
       if( unlink($file))
        echo "Yess";
        else
        echo"Noo";
    }
    echo "$album $release $genre $thumbnail  $current";
    $sql="call update_album('$current','$album','$release','$genre','$thumbnail')";
    if(mysqli_query($conn,$sql)){
        echo "Success";
    }else{
        echo "".mysqli_error();
    }
}
?>