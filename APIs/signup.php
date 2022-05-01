<?php

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
// Compress image
function compressImage($source, $destination, $quality) {
    
  $info = getimagesize($source);
  if ($info['mime'] == 'image/jpeg') {
    $image = imagecreatefromjpeg($source);
    }
  elseif ($info['mime'] == 'image/gif') {
    $image = imagecreatefromgif($source);

  }
  elseif ($info['mime'] == 'image/png') {
    $image = imagecreatefrompng($source);
  }
  imagejpeg($image, $destination, $quality);

}
if($data->img!="")
{
  $image_exploded=explode('.',$data->img);
  $image_extension=strtolower(end($image_exploded));
  $id=mt_rand(1000, 9999);  
  $rand_name=mt_rand().'.'.$image_extension;
  $location = 'C:\xampp\htdocs\blog\pictures\\'. $rand_name;
  $image_tmp='C:\Users\Asus\Pictures\\'.$data->img ;
  compressImage($image_tmp ,$location ,60);
}
else{
  $rand_name="973460.png";  
}
//
try{
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO users (username, email, password,birthday,img)
  VALUES ('".$data->username."','".$data->email."','".md5($data->pwd)."','".$data->birthday."','". $rand_name."')";
  $conn->exec($sql);
  echo "<div class='alert alert-success' role='alert'>congratulation your account has been successfully created <a href='login.html' class='alert-link'>go to login page</a></div>";
} catch(PDOException $e) {
  echo "<div class='alert alert-danger' role='alert'> Your account has not been created</div>";
}
$conn = null;
?>

