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
<?php include 'php/newsShower.php'?>
<script src="/pages/javascript/initials.js" type="text/javascript"></script>

<!--билдинг новостей-->

<div id="block" style="position:relative; margin:200 auto; width:90%; background: #f7f7f7; box-shadow: 0 0 10px rgb(194, 194, 194);">

<div id="header" style="position: relative; width:100%; height:25;">
    <b style="width:100%; height:100%; font-size: 25; font-family:HeaderText; position:relative; ">

    <?php $result=getNews($_GET["newsID"]); echo $result->head; ?>

    </b>
</div>
    
<div style="position: relative; width:100%; margin:25 0; height:90%; font-size: 20; font-family:HeaderText; word-wrap:break-word;">
    <a id="content" style=" width:100%; ">

    <?php $result=getNews($_GET["newsID"]); echo $result->content; ?>

    </a>
</div>

<script>
    var size=25; size+=$('#content').height(); size+=25;
    $('#block').height(size);
</script>

</div>

<div id="head"></div>
<script> 
setHeader();
</script> 

</body>
</html>