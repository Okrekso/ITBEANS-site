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

var switchers=new Array();
function switchersAnims(Enable)
{
    if(Enable==0)
    {
        for(i=0;i<switchers.length;i++)
        {
            var n=switchers[i][0];
            var e=document.getElementById(n);
            e.onclick=function(){};
        }
    }
    else
    {
        for(i=0;i<switchers.length;i++)
        {
            var n=switchers[i][0];
            console.log("n:"+n);
            var e=document.getElementById(n);
            e.onclick=function(){switcher(n);};
        }
    }
}
function switcher(elemID)
{
    document.getElementsByClassName("switcher");
    

    elementName="#"+$("#"+elemID).attr('id');
    elem=document.getElementById(elemID);
    console.log(elemID);

    var exist=0; var num;
    for(i=0;i<switchers.length;i++)
    {
        if(switchers[i][0]==elemID) { exist=1; num=i; break; }
    }
    if(exist!=1) { switchers.push(new Array(elemID,0)); console.log("created for"+elemID); num=switchers.length-1; }
    
    if(switchers[num][1]==0)
    {
        switchersAnims(0);
        $(elementName).animate({float:"=left", width:"+=50%"},500,
        function()
        {
            switchersAnims(0);
            $(elementName).animate({marginLeft:"+=50%", width:"-=50%"},300); 
            switchersAnims(1);
        }); 
        switchers[num][1]=1;
        
        if(elemID=="isEvent")
        {
        $("#Date").animate({opacity:"+=1"},500);
        $("#Time").animate({opacity:"+=1"},500);
        $("#Price").animate({opacity:"+=1"},500);
        var d=new Date();
        var date=d.getFullYear()+"-"+(d.getUTCMonth()+1<10?('0'+d.getUTCMonth()+1):d.getUTCMonth()+1)+"-"+(d.getDate()<10?'0'+d.getDate():d.getDate());
        
        var time=(d.getHours()<10?"0"+d.getHours():d.getHours())+":"+(d.getMinutes()<10?"0"+d.getMinutes():d.getMinutes());
        $("#Date").val(date);
        $("#Time").val(time);
        document.getElementById("Type").value="1";
        }
    }
    else
    {
        switchersAnims(0);
        $(elementName).animate({marginLeft:"-=50%", width:"+=50%"},500,
        function()
        {
            switchersAnims(0);
            $(elementName).animate({width:"-=50%"},300);
            switchersAnims(1);
        }); 
        switchers[num][1]=0;

        if(elemID=="isEvent")
        {
        document.getElementById("Type").value="0";
        $("#Date").animate({opacity:"-=1"},500);
        $("#Time").animate({opacity:"-=1"},500);
        $("#Price").animate({opacity:"-=1"},500);
        }
    }
}

function howFarToEvent(date)
{
    var d=new Date();
    d.setMonth(d.getMonth()+1);
    var newDate=date;
    var res=(d-newDate)/1000/60/60/24;
    res=res.toFixed();
    return res<0?-res:res;
}

function acceptUser(num)
{
    $("#toAccept").val(num);
    $("#acception").submit();
}

function registrateOnEvent(num)
{
    $("#toRegistr").val(num);
    $("#registr").submit();
}
function deRegistrateOnEvent(num)
{
    $("#toDeregistr").val(num);
    $("#registr").submit();
}

function gotoMyEvents() { location.href="/pages/myEvents.php"; }
function gotoMembers() { location.href="/pages/members.php"; }
function gotoNews() { location.href="/pages/news.php"; }
function gotoNewPost() { location.href="/pages/newPost.php"; }
