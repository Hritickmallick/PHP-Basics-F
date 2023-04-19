<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

if (isset($_GET["q"])) {
    $var = $_GET['q'];


    switch ($var) {
        case 1:
            header('location:ASSIGNMENT1/F&LNAME.php');
            break;
        case 2:
            header('location:ASSIGNMENT2/phone-number.php');
            break;
        case 3:
            header('location:ASSIGNMENT3/email.php');
            break;
        case 4:
            header('location:ASSIGNMENT4/text.php');
            break;

        case 5:
            header('location:ASSIGNMENT5/index.php');
            break;

        case 6:
            header('location:ASSIGNMENT6/index.php');
            break;

        default:
            header('location:dashboard.php');
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    
    <div class="navigation">
        <a href="ASSIGNMENT1/F&LNAME.php">ASSIGNMENT 1</a>
        <a href="ASSIGNMENT2/phone-number.php">ASSIGNMENT 2</a>
        <a href="ASSIGNMENT3/email.php">ASSIGNMENT 3</a>
        <a href="ASSIGNMENT4/text.php">ASSIGNMENT 4</a>
        <a href="ASSIGNMENT5/index.php">ASSIGNMENT 5</a>
        <a href="ASSIGNMENT6/pdf.php">ASSIGNMENT 6</a>

    </div>


    <a class="lg-out-btn" href="logout_valid.php">LOGOUT</a>




</body>

</html>