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
function clearElem(element,val)
{
    if(element.split("_")[0]=="additional")
    {
        var additional=$("#"+element).val();

        var news=element.split("_")[1].split("-")[0]; var user=element.split("_")[1].split("-")[1];
        strs=$("#toVisit").val().split(";");

        var exist=0;var n;
        for(i=0;i<strs.length-1;i++)
        {
            if(strs[i].split("-")[0]==news && strs[i].split("-")[1]==user)
            {
                exist=1; n=i;
            }
        }
        if(exist==1)
        {
            var newVal=strs[n]; 
            visit=newVal.split("-"); visit[3]=additional; 
            newVal=visit.join("-"); strs[n]=newVal; $("#toVisit").val(strs.join(";"));
        }
        else{ $("#toVisit").val($("#toVisit").val()+news+"-"+user+"-"+"0"+"-"+additional+";");}
    }
    if($("#"+element).val()==val){$("#"+element).val(""); return 0;}
    if($("#"+element).val()==""){$("#"+element).val(val); return 1;}
}
function hide(name)
{
    var elem=document.getElementsByClassName("name");
    for(i=0;i<elem.length;i++)
    {
        elem[i].style.top="-100";
        elem[i].style.visibility="hidden";
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

function toGoldUser(num)
{
    $("#toGold").val(num);
    $("#toGoldForm").submit();
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

function gotoNewsNext(i)
{
    $("#page").val(i);
    $("#pageForm").submit();
}

function gotoMyEvents() { location.href="/pages/myEvents.php"; }
function gotoMembers() { location.href="/pages/members.php"; }
function gotoNews() { location.href="/pages/news.php"; }
function gotoNewPost() { location.href="/pages/newPost.php"; }
