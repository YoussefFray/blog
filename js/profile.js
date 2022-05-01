function followbutton()
{
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
  const obj = JSON.parse(this.responseText); 
  var s=obj.following;
  var sa=s.split(',');
  if(sessionStorage.getItem('searchName')!=sessionStorage.getItem('username'))
  {if(sa.includes(sessionStorage.getItem('searchName')))
  {
    document.getElementById("fb").innerHTML="<button type='button' class='btn btn-primary'  onclick='following()'>following</button>";
  }
  else{
    document.getElementById("fb").innerHTML="<button type='button' class='btn btn-primary'  onclick='follow()'>follow</button>";
  }

  //document.getElementById("r5").innerHTML=obj.following;

    }
    }
    xhttp.open("POST","APIs/getinfo.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username="+sessionStorage.getItem('username'));

}

function profileinfo(user)
{
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
  const obj = JSON.parse(this.responseText); 
  document.getElementById("imgp").src="pictures/"+obj.img;
  document.getElementById("r1").innerHTML=obj.username;
  document.getElementById("r2").innerHTML=obj.email;
  document.getElementById("r3").innerHTML=obj.birthday;
  document.getElementById("r4").innerHTML=obj.followers;
  document.getElementById("r5").innerHTML=obj.following;

    }
    xhttp.open("POST","APIs/getinfo.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username="+user);

}
function follow()
{      document.getElementById("fb").innerHTML="<button type='button' class='btn btn-primary'  onclick='following()'>following</button>";
    const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
      console.log(this.responseText) ;
      }
      xhttp.open("POST", "APIs/follow.php");
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("username="+sessionStorage.getItem('username')+"&searchName="+sessionStorage.getItem('searchName'));
    }

function following()
{
  document.getElementById("fb").innerHTML="<button type='button' class='btn btn-primary'  onclick='follow()'>follow</button>";
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      console.log(this.responseText) ;
    }
    xhttp.open("POST", "APIs/unfollow.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username="+sessionStorage.getItem('username')+"&searchName="+sessionStorage.getItem('searchName'));
}
profileinfo(sessionStorage.getItem("searchName"));
followbutton();