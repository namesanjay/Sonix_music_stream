<?php
    session_start();
    
    if(isset($_SESSION['artist_username'])){
        include("../connection.php");
        if($conn){
            echo "Successful";
        }
        function check($album_name){
            global $conn;
            $sql="select count(*) as num from album where album_name='$album_name'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            echo $row['num'];
            if($row['num']==0)
            return true;
            return false;
        }

        function insert_data($imageName){
            global $conn;
            if($conn){
                echo "<br>SCkjdbckjdbcskjdc";
            }
            $album=$_POST['album_name'];
            $album=strtolower($album);
            $release=$_POST['release_date'];
            $genre=$_POST['genre'];
            $user=$_SESSION['artist_username'];
            echo "$album $release $genre $user $imageName";
            $sql="insert into album values('$album','$release','$user','$genre','$imageName')";
            if(!mysqli_multi_query($conn,$sql)){
                echo "<br>Error desc".mysqli_error($conn)."<br>";
                echo $sql;
            }
            else{
                echo "Success";
            }
        }

        echo "Muji1";
        $album_name=$_POST['album_name'];
        $album_name=strtolower($album_name);
        if(check($album_name)){
            $imagename=$_FILES['image']['name'];
            $imagetemp=$_FILES['image']['tmp_name'];
            $imageType=$_FILES['image']['type'];
            $imageError=$_FILES['image']['error'];
            $imageExt=explode('.',$imagename);
            $imageActualExt=strtolower(end($imageExt));
            $allowed=array('jpg','jpeg','png');
            $imageNameNew="dcdcd";
            if(in_array($imageActualExt,$allowed)){
                if($imageError===0){
                    $imageNameNew=uniqid('',true).".".$imageActualExt;
                    $destination="../album_image/".$imageNameNew;
                    move_uploaded_file($imagetemp,$destination);
                }
            }
            $username=$_SESSION['artist_username'];
            echo $username;
            echo $imageNameNew;
           if( insert_data($imageNameNew))
           echo "Failed";
            else
            echo "succesdkbdjvh";
        }else{
            echo "Album";
        }
        
    }
?>