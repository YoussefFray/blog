<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";
$b=false ;
$i=0;

//
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT following FROM users where username= ?");
$stmt->execute(array($_POST['username']));
$row = $stmt->fetch();
$f=$row["following"];
$f1=explode(",",$f);
$f1[0]=$_POST['username'] ;
$f2="";
foreach($f1 as $value){ 
    $f2=$f2."'".$value."',";  
}
$res="";
$stmt = $conn->prepare("SELECT id FROM users where username in (".trim($f2, ", ").") ");
$stmt->execute();

while ($row = $stmt->fetch())
{
     $res=$res.$row["id"]."," ;
}
$res=trim($res, ", ");

//user and following ids =1,24
//like post username share
//$stmt = $conn->prepare("SELECT * FROM pub where iduser in (".$res.") ");
//OR share like %".$_POST['username']."%
$stmt = $conn->prepare("SELECT * FROM pub where share like '%".$_POST['username']."%' or iduser in (".$res.") ");
$stmt->execute();

//idpub 	iduser 	title 	description 	category 	img 	urlv 	likes 	comments 	share 	
//  $row["id"]
while ($row = $stmt->fetch())
{
   echo "
   <div id='".$row["idpub"]."'>
<div class=''container mt-3>
      <div class='card' style='width: 350px;''>
        <div class='card-body'>
          <button type='button' class='btn btn-success' onclick='share(this)'>share</button>
          <h5 class='card-title'>".$row["title"]."</h5> 
          <h6 class='card-subtitle mb-2 text-muted'>".$row["category"]."</h6>
   <p>".$row["description"]."</p>
   <p> <img src='pictures/".$row["img"]."' alt'logo' width='100%' height='auto'></p>
   <a href='#' class='card-link'>".$row["urlv"]."</a></br>
   <div id='like'> ";
   if (str_contains($row["likes"],$_POST['username'])) 
   { 
    echo "<button type='button' class='btn btn-primary' onclick='unlike(this)'>unlike</button>";
   }
else
    {
      echo "<button type='button' class='btn btn-primary' onclick='like(this)'>like</button>" ;
    }

    echo "</div>
      <div>
        <br>
        <textarea class='form-control texta' id='Textareacomments3'  rows='3'></textarea>
        <br>
        <div id='comment'>
        <button type='button' class='btn btn-primary' onclick='addcomment(this)'>comment</button>
      </div>
      </div>
   <p>
    <div class='card' style='width: 18rem;'>
      <div class='card-header'>
        comments
      </div>
      <ul class='list-group list-group-flush'>";
      if($row["comments"]!="")
      {
          ;
   $arr=explode(",",substr($row["comments"], 1));
   $items = count($arr);
   for($num = 0; $num < $items; $num += 2){
      echo  "<li class='list-group-item'>
      <b>".$arr[$num]."</b>
    <br>".$arr[$num+1]." </li>";
 }
}
echo "  </ul>
</div>
</p>
</div>
</div>
</br>
</br>
</br>
</div>
</div>
";


}
//shared like


