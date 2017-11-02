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

</script>

<script src="/pages/javascript/initials.js" type="text/javascript"></script>
<?php include_once '/php/registration.php'?>

<div id="all" style=<?php if(getUserValue($_COOKIE["userID"],"Status")!="Gold"){echo "\"filter: blur(13px);\"";}?>>

<div style="background:#f0f0f0; height:450; top:200; width:90%; margin:0 auto; position:relative; ">

    <div style="position:relative; width:50%; height:35; top:10; display:block; background:rgb(109, 109, 109); margin:10 auto;">
        <a class="text_S" style="position:absolute; width:100%; height:100%; text-align:center; font-size:30; color:white;">новий пост</a>
    </div>
    
    <form style="position:relative">
        <input value="Заголовок" style="display:block; width:90%; height:30; position:relative; top:10; margin:auto;"></input>
        <textarea style="display:block; width:90%; height:300; position:relative; margin:20 auto; dispaly:block; resize:none;"></textarea>
    </form>
    
    <div style=" width:150; height:20; position:relative;">

    <div style="position:relative; display:inline-block; width:75; height:20; top:0; margin:0 10; background:#c5c5c5;">
        <div id="isEvent" class="switcher" onclick="switcher(isEvent);" style="cursor:pointer; width:50%; height:100%; background:#0f2848;"></div>
    </div>

    <a class="text_S" style="position:absolute; top:0; left:60%; color:black; margin:0 0;">Подія</a>
    </div>

</div>

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