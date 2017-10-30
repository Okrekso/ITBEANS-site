function setHeader()
{
    console.log("settings");
    $("#head").load("/pages/header.php");
}
function searchStart()
{
    document.getElementById("searcher").submit();
}

var acc_open=0;

function accountTip()
{
    var elem=document.getElementsByClassName("acc_menu");
    if(acc_open==0)
    {
    for(i=0;i<elem.length;i++)
    {
        elem[i].style.visibility="visible";
        elem[i].style.opacity="0";
        elem[i].style.top-="100";
        $(elem[i]).animate({top:"+=100", opacity: i==0 ? "0.4" : "1"},1000);
    }
    acc_open=1;
    console.log("id="+$.cookie("userID"));
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
        $(elem[i]).animate({top:"-=100", opacity: 0},1000);
    }
    acc_open=0;
    }
}