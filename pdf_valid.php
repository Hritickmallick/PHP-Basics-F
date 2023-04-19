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


   

public function img_function(){
  $target_dir = "upload/";
  $target_file = $target_dir . $this->img_name;
  $upload_ok = 1;
  $imagefiletype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
  $check = getimagesize($this->img_tmp_name);
  if($check!==false){
    // echo"File is an image";
    $upload_ok=1;
  }else{
    // echo"file is not an image";
    $upload_ok=0;
  }

  if(file_exists($target_file)){
    // echo "sorry , file already exists";
    $upload_ok=0;  
}

if($this->img_size>200000){
    // echo "file is too big to upload";
    $upload_ok=0;
}

if($imagefiletype!="jpg" && $imagefiletype!="jpeg" && $imagefiletype!="png"){
    // echo "file type is not correct";
    $upload_ok=0;
}

if($upload_ok=0){
    // echo "file was not uploaded succesfully";
}
else{
        if(move_uploaded_file($this->img_tmp_name,$target_file)){
            // echo "the file ".htmlspecialchars(($this->img_name))."was uploaded.";
        }else{
            // echo "sorry file was not uploaded.";
        }
}
return($target_file);

}

public function pdf_func(){
  $first_name = $this->fname;
  $last_name = $this->lname;
  $phone_num = $this->phnnum;
  $email = $this->email;
  $sub_marks = $this->text_area();
  $sub = $sub_marks[0];
  $marks = $sub_marks[1];
  
  $image=$this->img_function();
  
  //echo $image;
  
  
  
  
  
  
  //print_r($sub_marks);
  
  include('fpdf.php');
  
  $pdf = new FPDF();
  
  $pdf->AddPage();
  
  $pdf -> SetFont("Arial","",20);
  
  $pdf->Cell(190,20,"Contact Details",0,1,'C');
  
  $pdf->Cell(55,10,"Full Name",1,0);
  
  $pdf->Cell(95,10,$first_name." ".$last_name ,1,1);
  
  $pdf->Cell(55,10,"Phone Number",1,0);
  
  $pdf->Cell(95,10,$phone_num,1,1);
  
  $pdf->Cell(55,10,"Email Id",1,0);
  
  $pdf->Cell(95,10,$email,1,1);
  
  $pdf-> Ln();

  
 
$pdf->Image($image,20,120,180,100);
  
  
  for($i=0;$i<count($sub);$i++){
    $pdf->Cell(45,10,$sub[$i],1,0);
    $pdf->Cell(45,10,$marks[$i],1,1);
  
  }
 
  $pdf->output('D');
  
  
  
  
  
  }
  

}

$pdf_gen = new validation();

$pdf_gen->pdf_func();


?>







