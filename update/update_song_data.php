<?php
    include('../connection.php');
    if($conn)
    echo "Sucessful";
    session_start();
    if(isset($_SESSION['artist_username']) && $_SERVER['REQUEST_METHOD']==="POST"){
        $id=$_POST['song_id'];
        print_r($_POST);
        $id=(int) $id;
        // echo gettype($id);
        $sql="select * from song  where song_id=$id";

        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        print_r($row);
        $album=($_POST['album']==null)?$row['album_name']:$_POST['album'];
        $title=($_POST['title']==null)?$row['title']:$_POST['title'];
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
            // $sql="insert into song(audio,singer,album_name,title) values('$audio','$singer','$album','$title')";
            $sql="update song set album_name='$album',title='$title' where song_id=$id";
            if(mysqli_multi_query($conn,$sql)){
                echo 'succes';
            }
            echo "Success1";
        }
        else if(sizeof($arr)==2){
            // $sql="insert into song(audio,singer,album_name,title,collab_singer1) values('$audio','$singer','$album','$title','$singer1')";
            $sql="update song set album_name='$album',title='$title',collab_singer1='$arr[1]' where song_id=$id";
            mysqli_query($conn,$sql);
            echo "Success2";
        }else if(sizeof($arr)==3){
            // $sql="insert into song(audio,singer,album_name,title,collab_singer1,collab_singer2) values('$audio','$singer','$album','$title','$singer1','$singer2')";
            $sql="update song set album_name='$album',title='$title',collab_singer1='$arr[1]',collab_singer2='$arr[2]' where song_id=$id";
            mysqli_query($conn,$sql);
            echo "Success3";
        }else if(sizeof($arr)==4){
            // $sql="insert into song(audio,singer,album_name,title,collab_singer1,collab_singer2,collab_singer3) values('$audio','$singer','$album','$title','$singer1','$singer2','$singer3')";
            $sql="update song set album_name='$album',title='$title',collab_singer1='$arr[1]',collab_singer2='$arr[2]',collab_singer3='$arr[3]' where song_id=$id";
            mysqli_query($conn,$sql);
            echo "Success4";
        }else{
            // $sql="insert into song(audio,singer,album_name,title,collab_singer1,collab_singer2,collab_singer3,collab_singer4) values('$audio','$singer','$album','$title','$singer1','$singer2','$singer3','$singer4')";
            $sql="update song set album_name='$album',title='$title',collab_singer1='$arr[1]',collab_singer2='$arr[2]',collab_singer3='$arr[3]',collab_singer4='$arr[4]' where song_id=$id";
            mysqli_query($conn,$sql);
            echo "Success5";
        }
    }
?>