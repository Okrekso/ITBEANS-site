function setHeader()
{
    $("#head").load("/pages/header.php");
}
function searchStart()
{
    document.getElementById("searcher").submit();
}

var acc_open=0;
var news_open=0;

function accountTip()
{
    document.getElementById("button_myCab_bg").onmouseenter=function(){};
    document.getElementById("button_myCab_bg").onmouseleave=function(){};
    var elem=document.getElementsByClassName("acc_menu");
    if(acc_open==0)
    {
    
    for(i=0;i<elem.length;i++)
    {

        elem[i].style.opacity="0";
        elem[i].style.top-="100";
        $(elem[i]).css({visibility: "visible"}).animate({top:"+=100", opacity: i==0 ? "0.4" : "1"},300,
        function()
        {
            document.getElementById("button_myCab_bg").onmouseenter=function(){};
            document.getElementById("button_myCab_bg").onmouseleave=function(){accountTip();};
        });
    }
    acc_open=1;

    document.getElementById("myEvents_button").style.display="block"; 

        if(chekFBlogin()==1 || $.cookie("userID")!="none")
        {
        document.getElementById("fb_button").style.display="none";
        document.getElementById("logout_button").style.display="block";
        }
        else
        {
        document.getElementById("fb_button").style.display="block";
        document.getElementById("logout_button").style.display="none";
        }
    }
    
    else
    {
    for(i=0;i<elem.length;i++)
    {
        $(elem[i]).animate({top:"-=100",opacity:"0"},300,
        function()
        {
            document.getElementById("button_myCab_bg").onmouseenter=function(){accountTip();};
            document.getElementById("button_myCab_bg").onmouseleave=function(){};
            hide("acc_menu");
        });
        //elem[i].style.visibility="hidden";
    }

    acc_open=0;
    }
}

function newsTip()
{
    document.getElementById("button_news_bg").onmouseenter=function(){};
    document.getElementById("button_news_bg").onmouseleave=function(){};

    var elem=document.getElementsByClassName("news_menu");
    if(news_open==0)
    {
    
    for(i=0;i<elem.length;i++)
    {

        elem[i].style.opacity="0";
        elem[i].style.top-="100";
        $(elem[i]).css({visibility: "visible"}).animate({top:"+=100", opacity: i==0 ? "0.4" : "1"},300,
        function()
        {
            document.getElementById("button_news_bg").onmouseenter=function(){};
            document.getElementById("button_news_bg").onmouseleave=function(){newsTip();};
        });
    }

    news_open=1;
    }
    
    else
    {
    for(i=0;i<elem.length;i++)
    {
        $(elem[i]).animate({top:"-=100",opacity:"0"},300,
        function()
        {
            hide("news_menu"); 
            document.getElementById("button_news_bg").onmouseenter=function(){newsTip();};
            document.getElementById("button_news_bg").onmouseleave=function(){};
        });
        //elem[i].style.visibility="hidden";
    }

    news_open=0;
    }
}

function hide(name,open)
{
    var elem=document.getElementsByClassName("name");
    for(i=0;i<elem.length;i++)
    {
        elem[i].style.top="-100";
        elem[i].style.visibility="hidden";
    }
}
function gotoMyEvents() { location.href="/pages/myEvents.php"; }
function gotoNews() { location.href="/pages/news.php"; }
function gotoNewPost() { location.href="/pages/newPost.php"; }

var switchers=new Array();
function switcher(element)
{
    element.onclick=function(){};
    document.getElementsByClassName("switcher");

    var exist=0; var num;
    for(i=0;i<switchers.length;i++)
    {
        if(switchers[i][0]==element) { exist=1; num=i; break; }
    }
    if(exist!=1) { switchers.push(new Array(element.id,0)); num=0; }
    
    if(switchers[num][1]==0)
    {
        $("#"+element.id).animate({float:"=left", width:"+=50%"},500,
        function()
        {
             $("#"+element.id).animate({marginLeft:"+=50%", width:"-=50%"},300); 
             element.onclick=function(){ switcher(element); }
        }); 
        switchers[num][1]=1;
        document.getElementById("Type").value="1";
    }
    else
    {
        $("#"+element.id).animate({marginLeft:"-=50%", width:"+=50%"},500,
        function()
        {
             $("#"+element.id).animate({width:"-=50%"},300);
             element.onclick=function(){ switcher(element); }
        }); 
        switchers[num][1]=0;
        document.getElementById("Type").value="0";
    }
}