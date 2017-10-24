
<html>
<head>
<link rel="shortcut icon" href="/bean.ico" type="x-icon"/>
<link href="/animate.css" rel="stylesheet">
<link href="/anims.js" rel="stylesheet"/>
<link href="/pages/styles/style.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

<title>IT B.E.A.N.S.</title>
<meta charset="utf-8">
</head>

<body>
<!-- начало тела -->
<script src="/pages/javascript/initials.js" type="text/javascript"></script>

<div style="
	position:relative;
	top:200;
	background:white;
	width:90%;
	margin:0 auto;
	height:30;
	border: 16 solid black;
	box-shadow: 0 0 10px;
" id="search">


<form id="searcher" method="get">
<script>
function Sclick(i)
{
	if(i.value=="поиск . . .")
	{
		i.value="";
	}
}
</script>
<input name="search" type="text" onclick="Sclick(this);"
 value="поиск . . ." style="color:gray; width:100%; height:30; position:relative; margin:auto auto"/>

<div id="search" onclick="searchStart();" style="background:#4D65FD; box-shadow: 0 0 10px; width:30; position:relative; margin: -30 100%; height:30;">
<img 
style="position:relative; margin:auto auto; width:30; height:30;"
 src="/images/search.png"/>
</div>
</div>
</form>

<!--билдинг новостей-->
<?php  include "/php/newsShower.php"?>
<?php

for($i=0;$i<count($statti);$i++)
{
$zag=$statti[$i]->head;
$cont=$statti[$i]->content;
echo "<div style=\" min-width:600; margin:20 auto; top:200;\" class=\"main\" id=\"main_$i\">";

echo "<div style=\" background:#245eac; width:100%; height:35; box-shadow: 0 0 10px; \" ><p class=\"zagolovok\">$zag</p></div>";
	echo "<p style=\"margin:10 5;\" class=\"text_S\">$cont</p>";
	
	echo "<div class=\"btnS\" style=\"width:200; position:absolute; bottom:10; box-shadow: 0 0 10px; left:10; height:30; background:#245eac;\">";
		echo "<a class=\"small_btn_text\">подробнее. . .</a>";
	echo "</div>";
	
echo "</div>";
}
?>

<div id="head"></div>
<script> 
setHeader();
</script> 

</body>
</html>