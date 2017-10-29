window.fbAsyncInit = function() {
  FB.init({
    appId      : '370600933378757',
    xfbml      : true,
    version    : 'v2.10'
  });
  FB.AppEvents.logPageView();
};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));


 function chekFBlogin()
 {
     var v=0;

     FB.getLoginStatus(function(responce)
     {
         if(responce.status=="connected")
         {v = 1; } 
         else {v = 0;} 
     });
     return v; 
 }

 function getUserId()
 {
    FB.api('/me?fields=name,email,birthday', function(response)
    {
        if(response && !response.error)
        {
            return response.id;
        }
        else { alert("there was an error while loggining"); }
    });
 }
 function getUserName()
 {
    FB.api('/me?fields=name,email,birthday', function(response)
    {
        if(response && !response.error)
        {
            return response.name;
        }
        else { alert("there was an error while loggining"); }
    });
 }

 function fbLogin()
 {
     if(chekFBlogin()==0 && getCookie("userID")=="none")
     {
        FB.login(function(responce){ chekRegistration();});
     }
    else
    {
        logOut();
    }
 }
 
 function logOut()
 {
    if(chekFBlogin()==1) FB.logout(function(responce){});
    document.cookie=("userID=none;");
    document.cookie=("userName=none;");
    console.log("user acc cookie deleted");
 }
 
 function chekRegistration()
 {
    FB.api('/me?fields=name,email,birthday', function(response)
    {
        if(response && !response.error)
        {
            document.cookie=("userID="+response.id);
            document.cookie=("userName="+response.name);
            console.log("user name: "+response.name);
        }
        else { alert("there was an error while loggining"); console.log(response.error); }
    });
    //document.getElementById("userID").value=getUserId();
 }

 function getCookie(name) 
 {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
 }