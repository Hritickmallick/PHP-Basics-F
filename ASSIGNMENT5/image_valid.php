<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class validation
{

  private $fname;
  private $lname;
  private $phnnum;
  private $email;
  private $text;
  public $img_name;
public $img_size;
public $img_type;
public $img_tmp_name;
public $img_dir;

public $image;


  public function __construct()
  {
    $this->fname = $_POST['firstname'];
    $this->lname = $_POST['lastname'];
    $this->phnnum = $_POST['phn_num'];
    $this->email = $_POST['email_id'];
    $this->text = $_POST['text'];
    $this->img_name =$_FILES['image']['name'];
$this->img_size =$_FILES['image']['size'];
$this->img_type =$_FILES['image']['type'];
$this->img_tmp_name = $_FILES['image']['tmp_name'];

   
}


public function img_function(){
  $target_dir = "upload/";
  $target_file = $target_dir . $this->img_name;
  $upload_ok = 1;
  $imagefiletype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
  $check = getimagesize($this->img_tmp_name);
  if($check!==false){
   
    $upload_ok=1;
  }else{
    return "file is not an image";
    $upload_ok=0;
  }

  if(file_exists($target_file)){
    return "sorry , file already exists";
    $upload_ok=0;  
}

if($this->img_size>200000){
  return "file is too big to upload";
    $upload_ok=0;
}

if($imagefiletype!="jpg" && $imagefiletype!="jpeg" && $imagefiletype!="png"){
  return "file type is not correct";
    $upload_ok=0;
}

if($upload_ok=0){
  return "file was not uploaded succesfully";
}
else{
        if(move_uploaded_file($this->img_tmp_name,$target_file)){
            echo "the file"." ".htmlspecialchars(($this->img_name)). " " . "was uploaded.";
        }else{
          return "sorry file was not uploaded.";
        }
}
return $target_file;

}


  
public function text_area() {
    $text_value = trim($this->text);

    $text_array = (explode("\n", $text_value));

    $count_text = sizeof($text_array);

    $sub =[];
    $marks =[];
    foreach($text_array as $ta){ 
      if(!preg_match("/\|/", $ta)){
        return "invalid format";
      }
      
       $result = explode("|", $ta);
       for ($i=0; $i< 2; $i++){
        if($i==0)
        array_push($sub,$result[0]);
        else{
          array_push($marks,$result[1]);
        }
      }
    }
         
    if(count($sub)!= count($marks)){
      return "Invalid Input";
    }
  
       foreach($sub as $S){
        if(!preg_match("/^[A-Za-z]{2,35}$/",$S)){
          return "INVALID FORMAT";
        }
       }

       foreach($marks as $M){
        $M=trim($M);
        if(!preg_match("/^[0-9]{1,3}$/",$M)){
          return "INVALID FORMAT";
        }
        
      }

       return array($sub,$marks);
       
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

    if ((preg_match('/^[0-9]{10}$/', $phone))) {

      return array(TRUE, $phone);
    } else {
      return array(FALSE, "cannot entry more than 10 digits");
    }
  }

  public function email_id()
  {
    if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      return array(TRUE, $this->email);
    } else {
      return array(FALSE, "invalid email format");
    }
  }

  public function fetch_mail()
  {

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

    if ($validationResult['format_valid'] && $validationResult['smtp_check']) {
      return $mail_id;
    } else {
      return "INVALID EMAIL ID";
    }

    curl_close($curl);
  }
}


$login = new validation();

$store_var=$login->img_function();
echo $store_var;
?>

<img src="<?php echo $store_var;?>"></img>

<?php



$store_variable = $login->text_area();

if(is_string($store_variable)){
  echo $store_variable;
  
  
 }else{
  $subject=$store_variable[0];
   $marks=$store_variable[1];
 
?>

<table>
<?php for($i=0;$i< count($subject); $i++){ ?>
<tr>
    <td><?php echo $subject[$i]; ?> </td>
    <td><?php echo $marks[$i]; ?></td>

  </tr>
    <?php }}  ?>
</table>



<?php



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
    echo "<br>";
    echo  $res;
  }
}

$checkEmpty = $login->empty_input();
if ($checkEmpty[0] == TRUE) {
  $check_phn_invalid = $login->phonenumber_valid();
  if ($check_phn_invalid[0] == TRUE) {
    $result = $check_phn_invalid[1];
    echo $result . "<br>" . "<br>";
  } else {
    $error = $check_phn_invalid[1];
    echo $error . "<br>" . "<br>";
  }
}

$checkEmpty = $login->empty_input();
if ($checkEmpty[0] == TRUE) {
  $check_email = $login->email_id();
  if ($check_email[0] == false) {
    $error = $check_email[1];
    echo $error . "<br>" . "<br>";
    }else{

      $store=$login->fetch_mail();

      echo $store."<br>"."<br>";
    }
  }


?>




