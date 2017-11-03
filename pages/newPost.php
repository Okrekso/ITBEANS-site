<html>
<head>
<link rel="shortcut icon" href="/bean.ico" type="x-icon"/>

<link href="/pages/styles/style.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

<title>IT B.E.A.N.S.</title>
<meta charset="utf-8">
</head>

<body>
<!-- начало тела -->
<script>
function clearElem(element,val)
{
    if($("#"+element).val()==val){$("#"+element).val(""); return 0;}
    if($("#"+element).val()==""){$("#"+element).val(val); return 1;}
}
function resized()
{
console.log("resized");
}
</script>

<script src="/pages/javascript/initials.js" type="text/javascript"></script>


<?php include_once '/php/registration.php'?>

<div id="all" style=<?php if(getUserValue($_COOKIE["userID"],"Status")!="Gold"){echo "\"filter: blur(13px);\"";}?>>

<div id="elem" style="background:#f0f0f0; height:480; top:200; width:90%; margin:0 auto; position:relative; ">

    <div style="position:relative; width:50%; height:35; top:10; display:block; background:rgb(109, 109, 109); margin:10 auto;">
        <a class="text_S" style="position:absolute; width:100%; height:100%; text-align:center; font-size:30; color:white;">новий пост</a>
    </div>
    
    <form style="position:relative" method="post">
        <input id="Zag" name="Head" value="Заголовок" onfocusin="clearElem('Zag','Заголовок');" onfocusout="clearElem('Zag','Заголовок');" style="display:block; width:90%; height:30; position:relative; top:10; margin:auto;"></input>
        <textarea id="SmallText" name="SmallText" onfocusin="clearElem('SmallText','Опис');" onfocusout="clearElem('SmallText','Опис');" style="display:block; width:90%; height:50; position:relative; margin:20 auto; dispaly:block; resize:none;">Опис</textarea>
        <textarea id="BigText" name="BigText" onresize="resized();" onfocusin="clearElem('BigText','Текст новини');" onfocusout="clearElem('BigText','Текст новини');" style="display:block; width:90%; height:250; position:relative; bottom:10; margin:20 auto; dispaly:block; resize:vertical;">Текст новини</textarea>
        <input id="Type" name="Type" value="0" style="display:none;"></input>
    </form>
    
    <div style="width:400; right:5%; height:20; position:absolute;">

    <div style=" width:200; height:20; right:200; position:absolute;">
        <a class="text_S" style="position:absolute; top:0; left:0%; color:black; margin:0 0;">Новина</a>

        <div style="position:relative; width:75; height:20; top:0; left:60; background:#c5c5c5;">
            <div id="isEvent" class="switcher" onclick="switcher(isEvent);" style="cursor:pointer; width:50%; height:100%; background:#0f2848;"></div>
        </div>

        <a class="text_S" style="position:absolute; top:0; left:145; color:black; margin:0 0;">Подія</a>
        
    </div>

    <div class="btn_clear" style="width:200; height:20; right:0;">
    <a class="text_S" style="color:white; width:100%; position:absolute; margin:0 auto; text-align:center;">запостити</a>
    </div>

    </div>
</div>

<script>
var lastSize=$("#BigText").height();
$(document).bind('mouseup', function(){
  if(lastSize != $("#BigText").height()){
    $("#elem").height("-="+(lastSize-$("#BigText").height()));
  }
  lastSize=$("#BigText").height();
});
</script>


<div id="head"></div>
<script> 
setHeader();
</script> 

</div>


<?php
if(getUserValue($_COOKIE["userID"],"Status")!="Gold")
{
    echo "<div style=\"position:fixed; width:100%;height:100%; background-color:rgba(42,136,216,0.9); left:0; top:0; opacity:0.5;\">";
    echo "<a class=\"text_S\" style=\"color:white; width:100%; font-size:50; position:absolute; display:block; text-align:center; margin:35% auto;\">у вас немає доступу до цього розділу, думав самий хиртий?</a>";
        echo "<a class=\"text_S\" href=\"/pages/index.html\" style=\"color:white; font-size:30; display:block; width:100%; text-align:center; margin:40% auto;\">на головну</a>";

    echo "</div>";
}
?>

</body>
</html>