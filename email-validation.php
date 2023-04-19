<?php

class validation
{

  private $fname;
  private $lname;
  private $phnnum;
  private $email;

  public function __construct()
  {
    $this->fname = $_POST['firstname'];
    $this->lname = $_POST['lastname'];
    $this->phnnum = $_POST['phn_num'];
    $this->email= $_POST['email_id'];
  }

  public function empty_input()
  {


    if (empty($this->fname) || (empty($this->lname)) || (empty($this->phnnum)) || (empty($this->email))) {
      return array(false, "this field cannot be empty");
    } else {

      return array(true, $this->fname, $this->lname, $this->phnnum, $this->email);
    }
  }

  public function invalid_input()
  {

    if ((!preg_match("/^[a-zA-Z]{2,20}$/", $this->fname)) || (!preg_match("/^[a-zA-Z]{2,20}$/", $this->lname))) {
      return array(false, "only alphabets can be used");
    } else {

      return  array(true, $this->fname, $this->lname);
    }
  }

  public function phonenumber_valid()
  {
    $phone = strval($this->phnnum);

    if ((preg_match('/^[0-9]{10}$/',$phone ))) {
      
      return array(TRUE , $phone);
    } else {
      return array(FALSE, "cannot entry more than 10 digits");
    }
  }

 /* public function email_id(){
    if (filter_var($this->email, FILTER_VALIDATE_EMAIL))
    {
      return array(TRUE, $this->email); 
    }else{
      return array(FALSE, "invalid email format");
    }
  }*/
}


$login = new validation;



$checkEmpty = $login->empty_input();
if ($checkEmpty[0] == TRUE) {
  $checkInvalid = $login->invalid_input();
  if ($checkInvalid[0] == TRUE) {
    $result = array($checkInvalid[1], $checkInvalid[2]);
  } else {
    $error = $checkInvalid[1];
  }
} else {
  $error = $checkEmpty[1];
}

if (isset($error)) {
  echo $error;
} else {
  foreach ($result as $res) {
    echo  $res;
  }
}


$check_phn_invalid=$login->phonenumber_valid();
if ($check_phn_invalid[0] ==TRUE){
  $result = $check_phn_invalid[1];
  echo $result;
}
else{
     $error = $check_phn_invalid[1];
     echo $error;

    }

    /*$check_email=$login->email_id();
    if($check_email[0]==TRUE){
      $result  = $check_email[1];
      echo $result;
    }else{
      $error = $check_email[1];
      echo $error;
    }*/

    class email_api{
        public $mail;

        public function __construct()
        {
          $this->mail = $_POST['email_id'];
        }

        public function fetch_api(){
          // set API Access Key
$access_key = 'ijLP6PMwre79laj5v4Fb8V7RMDTQRWlm';

// set email address
$email_address = $this->mail;

// Initialize CURL:
$ch = curl_init('http://apilayer.net/api/bulk_check?access_key='.$access_key.'&email='.$email_address.'');  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:

$validationResult = json_decode($json, true);


// Access and use your preferred validation result objects
 $validationResult['format_valid'];
        }

        public function email_id(){
          if (filter_var($this->mail, FILTER_VALIDATE_EMAIL))
          {
            return array(TRUE, $this->mail); 
          }else{
            return array(FALSE, "invalid email format");
          }
        }
            
    }

    $fetch = new email_api;

    $check_email=$fetch->email_id();
    if($check_email[0]==TRUE){
      $result  = $check_email[1];
      echo $result;
    }else{
      $error = $check_email[1];
      echo $error;
    }