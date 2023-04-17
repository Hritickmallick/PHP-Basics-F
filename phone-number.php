<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
<link rel="stylesheet" href="phone.css">
</head>
<body>

  <div>
  <h1>SUBMIT YOUR FIRST AND LAST NAME</h1>

<form name = "myform" method = "post" action ="phone-validation.php" onsubmit="frontend_validation()" enctype="multipart/form-data"> 

<label for="firstname">firstname</label> 

<input type= "text" name = "firstname"  id = "firstname">

<label for="lastname">lastname</label> 

<input type= "text" name = "lastname"  id = "lastname"> <br>


<label for="fullname">fullname</label> 

<input type= "text" name = "fullname"  id = "fullname" disabled><br>

<label class="phn_num_tag" for="phn_num">Enter Your Phone Number</label>

<input type="text" name="phn_num" id="phn_num">

<input type= "submit" name = "submit"  id = "submit">

</form>  

  </div>



</body>
</html>
