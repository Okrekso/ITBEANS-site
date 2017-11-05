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

<form id="registr" method="post" style="dispay:none">
	<input id="toRegistr" style="display:none" name="toRegistr"></input>
	<input id="toDeregistr" style="display:none" name="toDeregistr"></input>
</form>

<!-- registrating user on event -->
<?php  include "/php/registration.php"?>
<?php
	if($_POST["toRegistr"]!=null)
	{
		$newsID=$_POST["toRegistr"];
		$userID=getUserValue($_COOKIE["userID"],"ID");

		$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
		$result=$sqlCon->query("INSERT INTO Visitors(UserID, NewsID) VALUES('$userID','$newsID')");
		if($result==true)
		{
			echo "<script>gotoNews();</script>";
		}
		else
		{
			echo "<script>console.log(\"registrate failure\");;</script>";
		}
	}

	if($_POST["toDeregistr"]!=null)
	{
		$newsID=$_POST["toDeregistr"];
		$userID=getUserValue($_COOKIE["userID"],"ID");

		$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
		$result=$sqlCon->query("DELETE FROM Visitors WHERE `UserID`='$userID' AND `NewsID`='$newsID'");
		if($result==true)
		{
			echo "<script>gotoNews();</script>";
		}
		else
		{
			echo "<script>console.log(\"registrate failure\");;</script>";
		}
	}
?>

<!--билдинг новостей-->
<?php  include "/php/newsShower.php"?>


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

<?php
if(getUserStatus()=="Gold")
{
echo "<form method=\"post\" id=\"deleter\">";
	echo "<input type=\"text\" style=\"display:none\" id=\"toDelete\" name=\"toDelete\"></input>";
echo "</form>";
}
?>

<script>
	function deletePost(Id)
{
    $("#toDelete").val(Id);
    $("#deleter").submit();
}
</script>

<?php
$deleter=$_POST["toDelete"];

if($deleter!=null && getUserStatus()=="Gold")
{
	deleteNews($deleter);
}
fillNews();


for($i=0;$i<count($statti);$i++)
{
$zag=$statti[$i]->head;
$cont=$statti[$i]->smallContent;
$id=$statti[$i]->ID;
$type=$statti[$i]->type;

$bg=$statti[$i]->type=="Event"?"#3232aa":"#245eac";
if($i==0 && $type=="Event") { $bg="#8209a3"; }

echo "<div style=\" min-width:600; margin:20 auto; top:200;\" class=\"main\" id=\"main_$i\">";

	//голова
	echo "<div  style=\"cursor:pointer; background:$bg; width:100%; height:35; box-shadow: 0 0 10px; \"> <p onclick=\"goNews($id);\" class=\"zagolovok\">";
	if ($i==0 && $type=="Event") { echo "$zag ( НАЙБЛИЖЧЕ )"; } else { echo "$zag"; }
	echo "</p>";
	$de=$_COOKIE["userID"];

	if(getUserStatus()=="Gold")
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
	if(getSqlValueById($id,"Type","News")=="Event" && isOnEvent(getUserValue($_COOKIE["userID"],"ID"),$id)==0)
	{
	echo "<div class=\"btnS\" onclick=\"\" style=\"width:275; margin:0 10; position:relative; display:inline-block; bottom:10; box-shadow: 0 0 10px; left:10; height:30; background:#245eac;\">";
	echo "<a class=\"small_btn_text\" onclick=\"registrateOnEvent($id);\" style=\"position:absolute; margin:0 40;\">зареєструватись</a>";
	echo "</div>";
	}
	if(getSqlValueById($id,"Type","News")=="Event" && isOnEvent(getUserValue($_COOKIE["userID"],"ID"),$id)==1)
	{
	echo "<div class=\"btnS\" onclick=\"\" style=\"width:325; margin:0 10; position:relative; display:inline-block; bottom:10; box-shadow: 0 0 10px; left:10; height:30; background:#245eac;\">";
	echo "<a class=\"small_btn_text\" onclick=\"deRegistrateOnEvent($id);\" style=\"position:absolute; margin:0 40;\">відмінити реєстрацію</a>";
	echo "</div>";
	}
	echo "</div>";

	$AuthID=getSqlValueById($id, "Creator_ID","News");
	$Auth=getSqlValueById($AuthID,"Name","Users");
	$DateOfCreate=getSqlValueById($id,"CreateDate","News");
	$StartDate=getSqlValueById($id,"StartDate","News");
	$Type=getSqlValueById($id,"Type","News");
	$Price=getSqlValueById($id, "Price","News");

	$wrDate=strtotime($StartDate);

	if($Type=="Event")
	{
		echo "<a class=\"text_S\" style=\"position:absolute; color:green; right:0; bottom:55; opacity:0.5;\">$Price баллів</a>";

		$hour=date("H",$wrDate); $mins=date("i",$wrDate); $month=date("m",$wrDate); $day=date("d",$wrDate);
		echo "<a class=\"text_S\" style=\"position:absolute; color:red; right:0; text-align:right; background:black; bottom:35; opacity:0.7;\">початок: $month/$day о $hour:$mins</a>";
	}
	echo "<a class=\"text_S\" style=\"position:absolute; right:0; bottom:15; opacity:0.5;\">$DateOfCreate</a>";
	echo "<a class=\"text_S\" style=\"position:absolute; right:0; text-align:right; bottom:0; opacity:0.5;\">$Auth</a>";

echo "</div>";


}
?>

<div id="head"></div>
<script> 
setHeader();
</script> 

</body>
</html>