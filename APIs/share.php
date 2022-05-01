<?php
//$_POST['username']
//$_POST['postid']

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT share FROM pub where idpub= ?");
$stmt->execute(array($_POST['postid']));
$row = $stmt->fetch();
$f=$row["share"];
$f=$f.",".$_POST['username'];
$stmt = $conn->prepare("UPDATE pub set share=? where idpub= ?");
$stmt->execute(array($f,$_POST['postid']));