function checks(username,pwd,rpwd,email,birthday)
{
    document.getElementById("usernameerror").innerHTML="";
    document.getElementById("pwderror").innerHTML="";
    document.getElementById("pwdrerror").innerHTML="";
    document.getElementById("emailerror").innerHTML="";
    document.getElementById("birthdayerror").innerHTML="";
    if(username=="")
    {
        document.getElementById("usernameerror").innerHTML="<div class='alert alert-danger' role='alert'>enter your name </div>" ;
        return false;   
    }
    if(pwd=="")
    {
        document.getElementById("pwderror").innerHTML="<div class='alert alert-danger' role='alert'>enter your password </div>" ;

        return false;  
    }
    if(rpwd=="")
    {
        document.getElementById("pwdrerror").innerHTML="<div class='alert alert-danger' role='alert'>repeat your password </div>" ;
        return false;  
    }
    if(email=="")
    {
        document.getElementById("emailerror").innerHTML="<div class='alert alert-danger' role='alert'>enter your email </div>" ;
        return false;  
    }
    if(birthday=="")
    {
        document.getElementById("birthdayerror").innerHTML="<div class='alert alert-danger' role='alert'>enter your birthday </div>" ;
        return false;  
    }
    if(pwd!=rpwd)
    {
        document.getElementById("pwdrerror").innerHTML="<div class='alert alert-danger' role='alert'>check your password </div>" ;
        return false; 
    }
    return true ;
}
  
function sendJSON(username,pwd,email,birthday,img){			    
    let xhr = new XMLHttpRequest();
    let url = "APIs/signup.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("alert").innerHTML=this.responseText;
        }
    };
    var data = JSON.stringify({ "username":username, "pwd":pwd ,"email":email , "birthday":birthday , "img":img });
    xhr.send(data);
}


function signup()
{   const extensions  = ["jpg", "tif", "png","gif"];
    var username = document.getElementById("username").value;
    var pwd = document.getElementById("pwd").value;
    var rpwd = document.getElementById("rpwd").value;
    var email = document.getElementById("email").value;
    var birthday = document.getElementById("birthday").value;
    var b=checks(username,pwd,rpwd,email,birthday);
    if(document.getElementById("img").value!="")
      {
        var img = document.getElementById("img").files[0].name; 
        if(!extensions.includes(img.split('.').pop())) 
          {
            document.getElementById("imgerror").innerHTML="<div class='alert alert-danger' role='alert'>only images </div>" ;
             b=false ;
          }
      }
      else
      {
        var img ="";  
      }
if(b==true)
{
    sendJSON(username,pwd,email,birthday,img);
}
}