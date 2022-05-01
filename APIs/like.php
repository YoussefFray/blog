<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT likes FROM pub where idpub= ?");
$stmt->execute(array($_POST['postid']));
$row = $stmt->fetch();
$f=$row["likes"];
$f=$f.",".$_POST['username'] ;
$stmt = $conn->prepare("UPDATE pub set likes=? where idpub= ?");
$stmt->execute(array($f,$_POST['postid']));
