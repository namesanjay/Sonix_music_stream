<?php
session_start();
session_destroy();
if(!isset($_SESSION['username'])){
    header("Location:../login.php");
}
?>