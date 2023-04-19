<?php
$username = "Hritick";
$password = "123456";

if(($_POST['username'] == $username)&&($_POST['password'] == $password)){
       session_start();
       $_SESSION['username']=$_POST['username'];
       header('location: dashboard.php');

} else{
       header('location:login.php');
       
}




?>