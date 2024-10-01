<?php
session_start();
if(isset($_SESSION['artist_username']) && $_SERVER['REQUEST_METHOD']==='POST'){
    include("../connection.php");
        if($conn){
            echo "Successful";
        }
    $fileName=$_FILES['audio']['name'];
    $filetmp=$_FILES['audio']['tmp_name'];
    $fileExt=explode('.',$fileName);
    $fileActualExt=strtolower(end($fileExt));
    $audio=uniqid('',true).".".$fileActualExt;
    $destination='../audio/'.$audio;


    move_uploaded_file($filetmp,$destination);
    
    $album=$_POST['album'];
    $album=$_POST['album'];
    $album=strtolower($album);
    $title=$_POST['title'];
    $title=strtolower($title);
    $singer=$_SESSION['artist_username'];
    $singer1=$_POST['Singer1'];
    $singer1=strtolower($singer1);
    $singer2=$_POST['Singer2'];
    $singer2=strtolower($singer2);
    $singer3=$_POST['Singer3'];
    $singer3=strtolower($singer3);
    $singer4=$_POST['Singer4'];
    $singer4=strtolower($singer4);
    


    $arr=[1];
    if($_POST['Singer1']!=null)
    $arr[]=$_POST['Singer1'];
    if($_POST['Singer2']!=null)
    $arr[]=$_POST['Singer2'];
    if($_POST['Singer3']!=null)
    $arr[]=$_POST['Singer3'];
    if($_POST['Singer4']!=null)
    $arr[]=$_POST['Singer5'];
    print_r($arr);

    if(sizeof($arr)==1){
        $sql="insert into song(audio,singer,album_name,title) values('$audio','$singer','$album','$title')";
        mysqli_query($conn,$sql);
        echo "Success";
    }
    else if(sizeof($arr)==2){
        $sql="insert into song(audio,singer,album_name,title,collab_singer1) values('$audio','$singer','$album','$title','$singer1')";
        mysqli_query($conn,$sql);
        echo "Success";
    }else if(sizeof($arr)==3){
        $sql="insert into song(audio,singer,album_name,title,collab_singer1,collab_singer2) values('$audio','$singer','$album','$title','$singer1','$singer2')";
        mysqli_query($conn,$sql);
        echo "Success";
    }else if(sizeof($arr)==4){
        $sql="insert into song(audio,singer,album_name,title,collab_singer1,collab_singer2,collab_singer3) values('$audio','$singer','$album','$title','$singer1','$singer2','$singer3')";
        mysqli_query($conn,$sql);
        echo "Success";
    }else{
        $sql="insert into song(audio,singer,album_name,title,collab_singer1,collab_singer2,collab_singer3,collab_singer4) values('$audio','$singer','$album','$title','$singer1','$singer2','$singer3','$singer4')";
        mysqli_query($conn,$sql);
        echo "Success";
    }
}
else echo "unsucess";
?>