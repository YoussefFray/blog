<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
$b=false ;
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT password FROM users where username= ?");
$stmt->execute(array($_POST['username']));

while ($row = $stmt->fetch())
{
if ( md5($_POST['pwd'])== $row["password"])
{$b=true ;}
}
if ($b==true) 
echo "true" ;
else
echo "false";





?>