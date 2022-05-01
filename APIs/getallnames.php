<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
$b=false ;
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT username FROM users ");
$stmt->execute();
$res="";
while ($row = $stmt->fetch())
{
   $res=$res."<option  value='".$row["username"]."'>".$row["username"]."</option>" ;
}
echo $res ;