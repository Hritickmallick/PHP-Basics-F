<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location :./login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
<link rel="stylesheet" href="text.css">
</head>
<body>

  <div>
  <h1>SUBMIT YOUR FIRST AND LAST NAME</h1>

<form name = "myform" method = "post" action ="text-validation.php" enctype="multipart/form-data"> 

<label for="firstname">firstname</label> 

<input type= "text" name = "firstname"  id = "firstname">

<label for="lastname">lastname</label> 

<input type= "text" name = "lastname"  id = "lastname"> <br>


<label for="fullname">fullname</label> 

<input type= "text" name = "fullname"  id = "fullname" disabled><br>

<label for="phn_num">phone number</label> 

<input type="text" name="phn_num" id="phn_num">

<label class="email-tag" for="phn_num">email id</label> 

<input type="text" name="email_id" id="email_id">

<span class="sub-marks">ENTER YOUR SUBJECT AND MARKS</span>

<textarea name="text" id="text" cols="30" rows="10"></textarea>

<input type= "submit" name = "submit"  id = "submit">

</form>  

  </div>









</body>
</html>
