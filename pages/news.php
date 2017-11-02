<html>
<head>
<link rel="shortcut icon" href="/bean.ico" type="x-icon"/>
<link href="/pages/styles/style.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/pages/javascript/jquery.cookie.js"></script>

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
	if(i.value=="пошук . . .")
	{
		i.value="";
	}
}
</script>
<input name="search" type="text" onclick="Sclick(this);"
 value="пошук . . ." style="color:gray; width:100%; height:30; position:relative; margin:auto auto"/>

<div id="search" onclick="searchStart();" style="background:#4D65FD; box-shadow: 0 0 10px; width:30; position:relative; margin: -30 100%; height:30;">
<img 
style="position:relative; margin:auto auto; width:30; height:30;"
 src="/images/search.png"/>
</div>
</div>

</form>

<!--билдинг новостей-->
<?php  include "/php/newsShower.php"?>
<?php  include "/php/registration.php"?>

<form id="newsForm" type="get" action="showNews.php">
<input name="newsID" id="newsID" type="text" style="display:none"></input>
</form>

<script type="text/javascript">
	function goNews(id)
	{
	document.getElementById("newsID").value=id;
	document.getElementById("newsForm").submit();
	}
</script>

<form method="post" id="deleter">
	<input type="text" style="display:none" id="toDelete" name="toDelete"></input>
</form>

<script>
	function deletePost(Id)
{
    $("#toDelete").val(Id);
    $("#deleter").submit();
}
</script>

<?php
$deleter=$_POST["toDelete"];

if($deleter!=null)
{
	deleteNews($deleter);
}
fillNews();


for($i=0;$i<count($statti);$i++)
{
$zag=$statti[$i]->head;
$cont=$statti[$i]->smallContent;
$id=$statti[$i]->ID;

echo "<div style=\" min-width:600; margin:20 auto; top:200;\" class=\"main\" id=\"main_$i\">";

	//голвоа
	echo "<div  style=\"cursor:pointer; background:#245eac; width:100%; height:35; box-shadow: 0 0 10px; \"> <p onclick=\"goNews($id);\" class=\"zagolovok\">$zag</p>";
	//$k=getUserValue($_COOKIE["userID"],"Status");
	$de=$_COOKIE["userID"];

	if(getUserValue($_COOKIE["userID"],"Status")=="Gold")
	{
		echo "<div onclick=\"deletePost($id);\" id=\"deleteBtn\">";
		echo "<div style=\"background:white; transform: rotate(45deg); margin:13 0%; position:absolute; width:100%; height:3;\"></div>";
		echo "<div style=\"background:white; transform: rotate(135deg); margin:13 0%; position:absolute; width:100%; height:3;\"></div>";
		echo "</div>";
	}
	echo "</div>";
	//конец головы
	
	echo "<p style=\"margin:10 5;\" class=\"text_S\">$cont</p>";

	//кнопки
	echo "<div style=\"position:absolute; bottom:5;\">";

	echo "<div class=\"btnS\" onclick=\"goNews($id);\" style=\"width:200; margin:0 0; position:relative; display:inline-block; bottom:10; box-shadow: 0 0 10px; left:10; height:30; background:#245eac;\">";
		echo "<a class=\"small_btn_text\" style=\"position:absolute; margin:0 40;\">більше . . .</a>";
	echo "</div>";
	if(getSqlValueById($id,"Type","News")=="Event")
	{
	echo "<div class=\"btnS\" onclick=\"\" style=\"width:275; margin:0 10; position:relative; display:inline-block; bottom:10; box-shadow: 0 0 10px; left:10; height:30; background:#245eac;\">";
	echo "<a class=\"small_btn_text\" style=\"position:absolute; margin:0 40;\">зареєструватись</a>";
	echo "</div>";
	}
	echo "</div>";

	$AuthID=getSqlValueById($id, "Creator_ID","News");
	$Auth=getSqlValueById($AuthID,"Name","Users");
	$DateOfCreate=getSqlValueById($id,"CreateDate","News");
	echo "<a class=\"text_S\" style=\"position:absolute; right:0; bottom:15; opacity:0.5;\">$DateOfCreate</a>";
	echo "<a class=\"text_S\" style=\"position:absolute; right:0; bottom:0; opacity:0.5;\">$Auth</a>";

echo "</div>";

}
?>

<div id="head"></div>
<script> 
setHeader();
</script> 

</body>
</html>