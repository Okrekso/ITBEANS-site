
var animated=new Array(document.getElementsByClassName("scrollable").length);
var animations=new Array(document.getElementsByClassName("scrollable").length);
var positions=new Array(document.getElementsByClassName("scrollable").length);
var radiuses=new Array(document.getElementsByClassName("scrollable").length);
var collisions=new Array(document.getElementsByClassName("scrollable").length);


    for(i=0;i<animations.length;i++)
    {
        animated[i]=false;
        animations[i]="";
    }
    
function getDirs()
{
    return animated.length;
}
function setDir(ID, dir, pixels, radius)
{
    animations[ID]=dir;
    positions[ID]=pixels;
    radiuses[ID]=radius;
    var elems=document.getElementsByClassName("scrollable");
    collisions[ID]=elems[ID];
}
function setCollision(ID, varID)
{
    collisions[ID]=document.getElementById(varID);
}

function scrolling()
{
    
    var elems=document.getElementsByClassName("scrollable");
//////////////////////////////////////////////////////////
    var maxscroll=$(document).height()-$(window).height();
    var scroll =$(window).scrollTop();
    var scrollPercent=scroll*100/maxscroll;
   
/////////////////////////////////////////////////////////
    for(i=0;i<animations.length;i++)
    {
        var to_opacity=$(elems[i]).css('opacity');
        switch(animations[i])
        {
            case("right"): 
                if(scroll>=collisions[i].offsetTop-radiuses[i] && scroll<=(collisions[i].offsetTop+radiuses[i]) && animated[i]==false || maxscroll==0)
                {
                    $(elems[i]).animate({left:"-="+positions[i], opacity:0},1);
                    elems[i].style.visibility="visible";
                    animated[i]=true; 
                    $(elems[i]).animate({opacity:to_opacity, left:"+="+positions[i]}, 1000); 
                } 
            break;
            case("left"): 
                if(scroll>=collisions[i].offsetTop-radiuses[i] && scroll<=(collisions[i].offsetTop+radiuses[i]) && animated[i]==false || maxscroll==0) 
                {
                    $(elems[i]).animate({left:"+="+positions[i], opacity:0},1);
                    elems[i].style.visibility="visible";
                    animated[i]=true; 
                    $(elems[i]).animate({opacity:to_opacity, left:"-="+positions[i]}, 1000);
                } 
            break;
            case("down"): 
                if(scroll>=collisions[i].offsetTop-radiuses[i] && scroll<=(collisions[i].offsetTop+radiuses[i]) && animated[i]==false || maxscroll==0)
                {
                    $(elems[i]).animate({top:"-="+positions[i], opacity:0},1);
                    elems[i].style.visibility="visible";
                    animated[i]=true; 
                    $(elems[i]).animate({opacity:to_opacity, top:"+="+positions[i]}, 1000);
                } 
            break;
            case("up"): 
                if(scroll>=collisions[i].offsetTop-radiuses[i] && scroll<=(collisions[i].offsetTop+radiuses[i]) && animated[i]==false || maxscroll==0) 
                {
                    $(elems[i]).animate({top:"+="+positions[i], opacity:0},1);
                    elems[i].style.visibility="visible";
                    animated[i]=true;
                    $(elems[i]).animate({opacity:to_opacity, top:"-="+positions[i]}, 1000);
                } 
            break;
        }
    }
       
}



