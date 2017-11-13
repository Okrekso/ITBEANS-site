<html>
<head>
<script src="/pages/javascript/initials.js" type="text/javascript"></script>

<link href="/pages/styles/style.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<title>IT B.E.A.N.S.</title>
<meta charset="utf-8">
</head>

<body>


<script src="/pages/javascript/initials.js" type="text/javascript"></script>
<?php include_once '/php/registration.php' ?>
<?php 
if(getUserStatus()!=null && getUserStatus()!="white") { include '/php/membersFill.php'; }
if(getUserStatus()==null)
{
    echo "<div id='arrow' style='position:absolute; width:800; height:350;'>";
     echo "<a class='text_S' style=' font-size:30; top:250; left:0; width:50%; position:absolute;'>для цього розділу необхідно пройти реєстрацію</a>";
     echo "<img src='/images/arrow.png' style='width:380; left:50%; height:350; position:absolute;'></img>";
    echo "</div>";
}
?>

<?php 
$toacc=$_POST["toAccept"];
$togold=$_POST["toGold"];

if($_POST["toAccept"]!=null && getUserStatus()=="Gold")
{
    if(setSqlValue("$toacc","Level","10","Users")==1)
    {
        echo "<script>console.log(\"user accepted!\"); location.href=\"/pages/members.php\"; </script>";
        
    }
    else
    {
        echo "<script>console.log(\"user accepted failure!\");</script>";
    }
}

if($_POST["toGold"]!=null && getUserStatus()=="Gold")
{
    $a=$_POST["toGold"];
    echo "<script>console.log('a=$a');</script>";
    if(setSqlValue("$togold","Status","Gold","Users")==1)
    {
        echo "<script>console.log(\"user accepted!\"); location.href=\"/pages/members.php\"; </script>";
        
    }
    else
    {
        echo "<script>console.log(\"user accepted failure!\");</script>";
    }
}
?>

<?php
if(getUserStatus()=="Gold")
{
echo "<form method=\"post\" id=\"acception\">";
    echo" <input style=\"display:none;\" id=\"toAccept\" name=\"toAccept\"></input>";
echo "</form>";

echo "<form method=\"post\" id=\"toGoldForm\">";
echo" <input style=\"display:none;\" id=\"toGold\" name=\"toGold\"></input>";
echo "</form>";
}
?>

<div id="head"></div>
<script> 
setHeader();
</script> 
</body>

</html>

