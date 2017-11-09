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
<?php include 'php/newsShower.php'?>
<script src="/pages/javascript/initials.js" type="text/javascript"></script>

<!--билдинг новостей-->

<div id="block" style="position:relative; margin:200 auto; width:90%; background: #f7f7f7; box-shadow: 0 0 10px rgb(194, 194, 194);">

<div id="header" style="position: relative; margin:10 20; width:95%; height:25;">
    <b style="width:100%; height:100%; font-size: 25; font-family:HeaderText; position:relative; ">

    <?php $result=getNews($_GET["newsID"]); echo $result->head; ?>

    </b>
</div>
    
<div style="position: relative; width:95%; margin:25 auto; height:90%; font-size: 20; font-family:HeaderText; word-wrap:break-word;">

    <div id="content" style=" width:100%;">
    <?php $result=getNews($_GET["newsID"]); echo $result->content; ?>
    </div>
    <?php include '/php/registration.php'?>
    <?php
    $id=$_GET["newsID"];

    if($_POST["toRegistr"]!=null)
	{
		$newsID=$_POST["toRegistr"];
		$userID=getUserValue($_COOKIE["userID"],"ID");

		$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
		$result=$sqlCon->query("INSERT INTO Visitors(UserID, NewsID) VALUES('$userID','$newsID')");
    }
    
    if($_POST["toDeregistr"]!=null)
	{
		$newsID=$_POST["toDeregistr"];
		$userID=getUserValue($_COOKIE["userID"],"ID");

		$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
		$result=$sqlCon->query("DELETE FROM Visitors WHERE `UserID`='$userID' AND `NewsID`='$newsID'");
		
    }
    //кнопка регистрации
    if(getSqlValueById($id,"Type","News")=="Event")
    {
        echo "<form id=\"registr\" method=\"post\" style=\"dispay:none\">";
        echo "<input id=\"toRegistr\" style=\"display:none\" name=\"toRegistr\"></input>";
        echo "<input id=\"toDeregistr\" style=\"display:none\" name=\"toDeregistr\"></input>";
        echo "</form>";
    }
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
    ?>

</div>

<script>
    var size=25; size+=$('#content').height(); size+=75;
    $('#block').height(size);
</script>

</div>

<div id="head"></div>
<script> 
setHeader();
</script> 

</body>
</html>