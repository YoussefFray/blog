<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

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
  $image_exploded=explode('.',$data->img);
  $image_extension=strtolower(end($image_exploded));
  $id=mt_rand(1000, 9999);  
  $rand_name=mt_rand().'.'.$image_extension;
  $location = 'C:\xampp\htdocs\blog\pictures\\'. $rand_name;
  $image_tmp='C:\Users\Asus\Pictures\\'.$data->img ;
  compressImage($image_tmp ,$location ,60);
//
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id FROM users where username= ?");
  $stmt->execute(array($data->iduser));
  $row= $stmt->fetch();

    $sql = "INSERT INTO pub (iduser,title, description,category,img,urlv)
    VALUES (".$row["id"].",'".$data->title."','".$data->description."','".$data->category."','". $rand_name."','".$data->urlv."')";
    $conn->exec($sql);
    $conn = null;


  /*  */
  ?>