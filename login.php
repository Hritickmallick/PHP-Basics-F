<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
<link rel="stylesheet" href="index.css">
</head>
<body>

  <div>
  <h1>SUBMIT YOUR FIRST AND LAST NAME</h1>

<form name = "myform" method = "post" action ="login-classes.php" onsubmit="frontend_validation()"> 

<label for="firstname">firstname</label> 

<input type= "text" name = "firstname"  id = "firstname">

<label for="lastname">lastname</label> 

<input type= "text" name = "lastname"  id = "lastname"> <br>


<label for="fullname">fullname</label> 

<input type= "text" name = "fullname"  id = "fullname" disabled><br>

<input type= "submit" name = "submit"  id = "submit">

</form>  

  </div>








<script src="index.js"></script>
</body>
</html>