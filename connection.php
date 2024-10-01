<?php
$conn=new mysqli("localhost","root","","Sonix");
header("Access-Control-Allow-Origin: *"); // This allows all origins
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Origin: http://localhost");
// session_start();
?>