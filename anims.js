var animated=new Array(document.getElementsByClassName("scrollable").length);
for(i=0;i<animated.length;i++)
{
    animated[i]=false;
}

function scrolling(position)
{
    var elems=document.getElementsByClassName("scrollable");
    var maxscroll=$(document).height()-$(window).height();
    var scroll =$(window).scrollTop();
    var scrollPosition=($(window).height()+scroll);
    //alert($(document).height()+" | "+$(window).height()+ " | scroll:"+scroll);

        switch(position)
        {
            case("left"): 
            for(i=0;i<elems.length;i++)
            {
                //alert(scroll+" : "+elems[i].offsetTop);
                if(scrollPosition>=elems[i].offsetTop && scrollPosition<=(elems[i].offsetTop+500) && animated[i]==false) {animated[i]=true; $(elems[i]).animate({opacity:1, left:"+=100"}, 1000);} 
            }
            break;
        }
        /*switch(position)
        {
            case("left"): 
            for(i=0;i<elems.length;i++)
            {
                if(scrollPosition<=elems[i].offsetTop && animated[i]==true) { animated[i]=false; $(elems[i]).animate({opacity:0, left:"-=100"}, 1000); } 
                if(scrollPosition>(elems[i].offsetTop+500) && animated[i]==true) { animated[i]=false; $(elems[i]).animate({opacity:0, left:"-=100"}, 1000); } 
            }
            break;
        }*/
}

function searchStart()
{
    alert("start search");
    document.getElementById("searcher").submit();
}