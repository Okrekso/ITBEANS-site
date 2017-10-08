function scrolling(wind)
{
    var maxscroll=$(document).height()-$(window).height();
    var scroll =$(window).scrollTop();
    alert(scroll*100/maxscroll);
}