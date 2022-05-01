<?php
//$_POST['username']
//$_POST['postid']
//$_POST['commentcontent']
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT comments FROM pub where idpub= ?");
$stmt->execute(array($_POST['postid']));
$row = $stmt->fetch();
$f=$row["comments"];
$f=$f.",".$_POST['username'] .",".$_POST['commentcontent'];
$stmt = $conn->prepare("UPDATE pub set comments=? where idpub= ?");
$stmt->execute(array($f,$_POST['postid']));