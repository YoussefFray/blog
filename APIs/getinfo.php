<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
$b=false ;
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT id,username,email,password,birthday,img,followers,following FROM users where username= ?");
$stmt->execute(array($_POST['username']));

$row = $stmt->fetch() ;


$arr = array('id' => $row["id"], 'username' => $row["username"], 'email' => $row["email"], 'password' => $row["password"], 'birthday' => $row["birthday"],'img' => $row["img"],'followers' => $row["followers"],'following' => $row["following"]);

echo json_encode($arr);









