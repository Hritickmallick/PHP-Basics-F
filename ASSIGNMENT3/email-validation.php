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

  public function email_id(){
    if (filter_var($this->email, FILTER_VALIDATE_EMAIL))
    {
      return array(TRUE, $this->email); 
    }else{
      return array(FALSE, "invalid email format");
    }
  }
  
  public function fetch_mail(){
    
    $curl = curl_init();
    $mail_id = $this->email;

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=$mail_id",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: text/plain",
    "apikey: ijLP6PMwre79laj5v4Fb8V7RMDTQRWlm"
  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET"
));

$response = curl_exec($curl);

$validationResult = json_decode($response, true);

if($validationResult['format_valid'] && $validationResult['smtp_check'])
{
  return $mail_id;
}
else{
  return "INVALID EMAIL ID";
}

curl_close($curl);

} 

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

    $check_email=$login->email_id();
    if($check_email[0]==false){
    $error = $check_email[1];
      echo $error;
    }else{
     
      $store=$login->fetch_mail();

      echo $store;
    }


   