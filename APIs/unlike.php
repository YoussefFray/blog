<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
// $_POST['username'] ;
// $_POST['postid'] ;
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT likes FROM pub where idpub= ?");
$stmt->execute(array($_POST['postid']));
$row = $stmt->fetch();
$t=",".$_POST['username'];
$f=str_replace($t,"",$row["likes"]);
$stmt = $conn->prepare("UPDATE pub set likes=? where idpub= ?");
$stmt->execute(array($f,$_POST['postid']));
//