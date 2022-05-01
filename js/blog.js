document.title ="blog - "+sessionStorage.getItem("username");
function getposts()
{
 
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("post").innerHTML=this.responseText;
 
  }
  xhttp.open("POST", "APIs/getposts.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("username="+sessionStorage.getItem("username"));
 
}
function share(x)
{
  var i=x.parentElement.parentElement.parentElement.parentElement.id;
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
   console.log(this.responseText);
 
  }
  xhttp.open("POST", "APIs/share.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("username="+sessionStorage.getItem("username")+"&postid="+i);
 
}
function addcomment(x)
{

 var i=x.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.id;
 const xhttp = new XMLHttpRequest();
 xhttp.onload = function() {
  console.log(this.responseText);

 }
 xhttp.open("POST", "APIs/addcomment.php");
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("username="+sessionStorage.getItem("username")+"&postid="+i+"&commentcontent="+document.getElementById(i).getElementsByClassName("texta")[0].value);


}


function like(x)
{
  var i=x.parentElement.parentElement.parentElement.parentElement.parentElement.id;

  x.parentElement.innerHTML="<button type='button' class='btn btn-primary' onclick='unlike(this)'>unlike</button>" ;
 
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
       console.log(this.responseText);
     
      }
      xhttp.open("POST", "APIs/like.php");
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("username="+sessionStorage.getItem("username")+"&postid="+i);
  
  }


function unlike(x)
{
var i=x.parentElement.parentElement.parentElement.parentElement.parentElement.id;
x.parentElement.innerHTML="<button type='button' class='btn btn-primary' onclick='like(this)'>like</button>" ;

const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
 console.log(this.responseText);

}
xhttp.open("POST", "APIs/unlike.php");
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("username="+sessionStorage.getItem("username")+"&postid="+i);

}


function comment()
{
  console.log("test comment");
}
function profilePic()
{
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
  const obj = JSON.parse(this.responseText); 
  document.getElementById("pp").src="pictures/"+obj.img;

    }
    xhttp.open("POST","APIs/getinfo.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username="+sessionStorage.getItem("username"));

}

function profile()
{sessionStorage.setItem("searchName",document.getElementById("exampleDataList").value );
  window.open("http://localhost/blog/profile.html");
  

}
function addoptions()
{
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
  document.getElementById("names").innerHTML=this.responseText ;
 
    }
    xhttp.open("POST","APIs/getallnames.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();

}

profilePic();
addoptions();
getposts() ;
function addPost()
{   var user=sessionStorage.getItem("username");
    var input5 = document.getElementById("exampleFormControlInput1").value;
    var input1 = document.getElementById("exampleFormControlTextarea1").value;
    var input2 = document.getElementById("url1").value;
    var input3 = document.getElementById("inputGroupSelect02").value;
    var input4 = document.getElementById("inputGroupFile01").files[0].name;
    let xhr = new XMLHttpRequest();
    let url = "APIs/addpost.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log(this.responseText);
        }
    }
    var data = JSON.stringify({ "iduser":user, "title":input5 ,"description":input1 , "category":input3 , "urlv":input2,"img":input4});
    xhr.send(data);

}
