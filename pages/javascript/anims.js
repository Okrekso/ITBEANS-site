var animated=new Array(document.getElementsByClassName("scrollable").length);
var animations=new Array(document.getElementsByClassName("scrollable").length);

    for(i=0;i<animations.length;i++)
    {
        animated[i]=false;
        animations[i]="";
    }

function setDir(ID, dir)
{
    animations[ID]=dir;
}

function scrolling()
{
    var elems=document.getElementsByClassName("scrollable");
//////////////////////////////////////////////////////////
    var maxscroll=$(document).height()-$(window).height();
    var scroll =$(window).scrollTop();
    var scrollPosition=($(window).height()+scroll);
/////////////////////////////////////////////////////////
    for(i=0;i<animations.length;i++)
    {
        switch(animations[i])
        {
            case("left"): 
            for(i=0;i<elems.length;i++)
            {
                if(scrollPosition>=elems[i].offsetTop && scrollPosition<=(elems[i].offsetTop+500) && animated[i]==false) {animated[i]=true; $(elems[i]).animate({opacity:1, left:"+=100"}, 1000); } 
            }
            break;
            case("right"): 
            for(i=0;i<elems.length;i++)
            {
                if(scrollPosition>=elems[i].offsetTop && scrollPosition<=(elems[i].offsetTop+500) && animated[i]==false) {animated[i]=true; $(elems[i]).animate({opacity:1, right:"+=100"}, 1000);} 
            }
            break;
            case("up"): 
            for(i=0;i<elems.length;i++)
            {
                if(scrollPosition>=elems[i].offsetTop && scrollPosition<=(elems[i].offsetTop+500) && animated[i]==false) {animated[i]=true; $(elems[i]).animate({opacity:1, top:"+=100"}, 1000);} 
            }
            break;
            case("down"): 
            for(i=0;i<elems.length;i++)
            {
                if(scrollPosition>=elems[i].offsetTop && scrollPosition<=(elems[i].offsetTop+500) && animated[i]==false) {animated[i]=true; $(elems[i]).animate({opacity:1, bottom:"+=100"}, 1000);} 
            }
            break;
        }
    }
       
}



