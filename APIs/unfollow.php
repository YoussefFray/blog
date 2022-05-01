<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
$b=false ;
//$_POST['username']
//$_POST['searchName']
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT following FROM users where username= ?");
$stmt->execute(array($_POST['username']));
$row = $stmt->fetch();
$t=",".$_POST['searchName'];
$f=str_replace($t,"",$row["following"]);
$stmt = $conn->prepare("UPDATE users set following=? where username= ?");
$stmt->execute(array($f,$_POST['username']));
//
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT followers FROM users where username= ?");
$stmt->execute(array($_POST['searchName']));
$row = $stmt->fetch();
$t=",".$_POST['username'];
$f=str_replace($t,"",$row["followers"]);
$stmt = $conn->prepare("UPDATE users set followers=? where username= ?");
$stmt->execute(array($f,$_POST['searchName']));
