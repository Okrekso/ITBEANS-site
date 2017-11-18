switchers=new Array();
function switchersIsEvent(isSwitched)
{
    if(isSwitched==1)
    {
        $("#Date").animate({opacity:"+=1"},500);
        $("#Time").animate({opacity:"+=1"},500);
        $("#Price").animate({opacity:"+=1"},500);
        var d=new Date();
        var date=d.getFullYear()+"-"+(d.getUTCMonth()+1<10?('0'+d.getUTCMonth()+1):d.getUTCMonth()+1)+"-"+(d.getDate()<10?'0'+d.getDate():d.getDate());
        
        var time=(d.getHours()<10?"0"+d.getHours():d.getHours())+":"+(d.getMinutes()<10?"0"+d.getMinutes():d.getMinutes());
        if($("#Date").val()=="") { $("#Date").val(date); }
        if($("#Time").val()=="") { $("#Time").val(time); }
        document.getElementById("Type").value="1";
    }
    else
    {
        document.getElementById("Type").value="0";
        $("#Date").animate({opacity:"-=1"},500);
        $("#Time").animate({opacity:"-=1"},500);
        $("#Price").animate({opacity:"-=1"},500);
    }
}

function getVisitedElement(news,user,returnValue)
{
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
        switch(returnValue)
        {
            case("news"): return strs[0]; break;
            case("user"): return strs[1]; break;
            case("visited"): return strs[2]; break;
            case("additional"): return strs[3]; break;
        }
    }
    else{return null;}
}
function setVisitedElement(news,user,visited,additional)
{
    //if(element.split("-")[0]=="additional"){clearElem("additional_"+news+"-"+user,additional);}
    
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
        visit=newVal.split("-"); visit[2]=visited; visit[3]=additional; 
        newVal=visit.join("-"); strs[n]=newVal; $("#toVisit").val(strs.join(";"));
    }
    else{ $("#toVisit").val($("#toVisit").val()+news+"-"+user+"-"+visited+"-"+additional+";");}
    
}
function switchersIsVisited(isSwitched,id)
{
    var string1=id.split('_')[1];
    var news=string1.split('-')[0];
    var user=string1.split('-')[1];
    var additional=$("#additional_"+news+"-"+user).val()!=""?$("#additional_"+news+"-"+user).val():"0";

    if(isSwitched==1)
    {
        $("#userID").css({color:"#1ba12d"});

        setVisitedElement(news,user,1,additional);
        //$("#uservisit").submit();
    }
    else
    {
        $("#userID").css({color:"#9e0b0b"});

        setVisitedElement(news,user,0,additional);
        //$("#uservisit").submit();
    }
}
function setSwitcher(switchID,val)
{
    var exist=0; var num;
    for(i=0;i<switchers.length;i++)
    {
        if(switchers[i][0]==switchID) { exist=1; num=i; break; }
    }
    if(exist!=1) { switchers.push(new Array(switchID,0)); num=switchers.length-1; }

    if(val==1)
    {
        //$("#"+switchID).css({background:"#1ba12d"});
        switchers[num][1]=1;
        $("#"+switchers[num][0]).css({float:"left",marginLeft:"50%"});
    }
    else
    {
        //$("#"+switchID).css({background:"#9c0404"});
        switchers[num][1]=0;
        $("#"+switchers[num][0]).css({float:"left"});
    }
}

function switcher(elemID)
{
    elementName="#"+$("#"+elemID).attr('id');
    elem=document.getElementById(elemID);
    var exist=0; var num;
    for (i=0;i<switchers.length;i++) { console.log(i+")"+switchers[i][0]); }
    for(i=0;i<switchers.length;i++)
    {
        if(switchers[i][0]==elemID) { exist=1; num=i; break; }
    }
    if(exist!=1) { switchers.push(new Array(elemID,0)); num=switchers.length-1; }
    

    
    if(switchers[num][1]==0)
    {
        switchers[num][1]=1;
        document.getElementById(switchers[num][0]).onclick=function(){};
        
        $("#"+switchers[num][0]).animate({ width:"+=50%"},500,
        function()
        {
            
            $("#"+switchers[num][0]).animate({marginLeft:"+=50%",width:"-=50%", "background-color":"#1ba12d"},300,function()
            {
                switch(elem.className)
                {
                    case("isEvent"): switchersIsEvent(switchers[num][1]); break;
                    case("isVisited"):switchersIsVisited(switchers[num][1],elem.id); break;
                }
            }); 
            document.getElementById(switchers[num][0]).onclick=function(){switcher(switchers[num][0]);};
        }); 
        
    }
    else
    {
        switchers[num][1]=0;
        document.getElementById(switchers[num][0]).onclick=function(){};
        $("#"+switchers[num][0]).animate({width:"+=50%",marginLeft:"-=50%"},500,
        function()
        {
            //$("#"+switchers[num][0]).css({float:"right"});
            $("#"+switchers[num][0]).animate({width:"-=50%","background-color":"#9c0404"},300,function()
        {
            switch(elem.className)
            {
                case("isEvent"): switchersIsEvent(switchers[num][1]); break;
                case("isVisited"):switchersIsVisited(switchers[num][1],elem.id); break;
            }
        });
        document.getElementById(switchers[num][0]).onclick=function(){switcher(switchers[num][0]);};
            
        }); 
    }
}