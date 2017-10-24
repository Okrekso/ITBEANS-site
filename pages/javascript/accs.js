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

     FB.getLoginStatus(function(responce){if(responce.status=="connected"){v = 1;} else {v = 0;} });
     return v;
     
 }

 function logOut()
 {
    FB.logout(function(responce){});
 }
 function getUserId()
 {
     FB.api('/me',function(responce){return(responce.id)});
 }
 function getUserName()
 {
     FB.api('/me',function(responce){return(responce.name)});
 }

 function fbLogin()
 {
     if(chekFBlogin()==0)
     {
     FB.login(function(responce)
     {
          chekRegistration();
    });
     }
    else
    {
        logOut();
    }
 }

 function chekRegistration()
 {
     //var connect=mysql.createConnection({host:"127.0.0.1:3306", user:"root", password:"", database:"ITB"});
 }