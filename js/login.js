function login()
{
    var username = document.getElementById("username").value;
    var pwd = document.getElementById("pwd").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
     if (this.responseText=="true")
     {
        sessionStorage.setItem("username",username);
        window.open("blog.html","_self");
     }
     else
     {
        document.getElementById("alert").innerHTML="<div class='alert alert-danger' role='alert'>  the user name or password is incorrect  </div> ";   
     }
    }
    xhttp.open("POST", "APIs/login.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username="+username+"&pwd="+pwd);

}