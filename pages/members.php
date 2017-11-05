

<html>
<head>
<script src="/pages/javascript/initials.js" type="text/javascript"></script>

<link href="/pages/styles/style.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<title>IT B.E.A.N.S.</title>
<meta charset="utf-8">
</head>

<body>
<?php include '/php/membersFill.php'?>

<script src="/pages/javascript/initials.js" type="text/javascript"></script>
<?php 
$d=$_POST["toAccept"];

if($_POST["toAccept"]!=null && getUserStatus()=="Gold")
{
    if(setSqlValue("$d","Level","0","Users")==1)
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
}
?>

<div id="head"></div>
<script> 
setHeader();
</script> 
</body>

</html>

