<?php

class validation{

private $fname;
private $lname;

public function __construct()
{
    $this->fname = $_POST['firstname'];
    $this->lname = $_POST['lastname'];
}

public function empty_input(){
   
    
    if(empty($this->fname)|| (empty($this->lname))){
      return array(false,"this field cannot be empty");
    }
    else {
      
        return array(true, $this->fname , $this->lname);
    } 
}

public function invalid_input(){

    if((!preg_match("/^[a-zA-Z]{2,20}$/" , $this->fname)) || (!preg_match("/^[a-zA-Z]{2,20}$/" , $this->lname)))
     {
        return array(false, "only alphabets can be used"); 
     } else {
      
        return  array(true, $this->fname, $this->lname);
        } 
    }
}

$login = new validation;

$checkEmpty= $login -> empty_input();
if ($checkEmpty[0]==TRUE){
    $checkInvalid = $login -> invalid_input();
    if ($checkInvalid[0]==TRUE){
      $result = array($checkInvalid[1],$checkInvalid[2]);
    }
    else {
      $error = $checkInvalid[1];
    } 

} 
else{
  $error = $checkEmpty[1];
} 

if(isset($error)){
  echo $error; 
}
else{
foreach ($result as $res){
  echo  $res;
}
}
?>




    










