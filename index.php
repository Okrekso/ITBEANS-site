<?php 
class sMain
{
	public $ID;
	public $head;
	public $content;
	public $picture;
	public $point;
	public function __construct($head, $content)
	{
		$this->head=$head; $this->content=$content;
		$point=0;
	}
}

$stat=[new sMain("Основание клуба","тут будет текст; а это типа картинка"), new sMain("Иерархия клуба","тратата"),
new sMain("Дополнительные баллы","текст о баллах"), new sMain("Кодовый час","еще какой-то текст")];
$statti=array_reverse($stat);

function sorter($str)
{
	$str=mb_strtolower($str,'UTF-8');
	//echo "<script>alert(\"$str\")</script>";
	if($_GET['search']!=null)
	{
		echo "<script>alert(\"I have request: $str\")</script>";
		global $statti,$stat;
		
		$statti=array();
		
		$ball=100/iconv_strlen($str,'UTF-8');
		$start=0;
		for($i=0;$i<count($stat);$i++)
		{
			$ths=$stat[$i];
			for($d=0;$d<iconv_strlen($str,'UTF-8');$d++)
			{
				for($c=$start;$c<iconv_strlen($ths->head,'UTF-8');$c++)
				{
					if($stat[$i]->point==100){ break; }
					$headB=mb_substr($ths->head,$c,1,'UTF-8');
					echo "<script>alert(\"char: $headB\")</script>";
					if(mb_substr($str,$d,1,'UTF-8')==mb_strtolower($headB,'UTF-8'))
						{
							$start=$c+1;
							$stat[$i]->point+=$ball;
							break;
						}
					else
						{
							if($stat[$i]->point>=$ball)
							$stat[$i]->point=0;
						}							
				}
			}
			if($stat[$i]->point>=50)
			{
				$p=$stat[$i]->point;
				echo "<script>alert(\"point of $i:$p\")</script>";
				array_push($statti, $stat[$i]);
			}
		}
	}
	else
	{
		$statti=$stat;
	}
}

sorter($_GET['search']);
?>
<html>
<head>
<link rel="shortcut icon" href="bean.ico" type="x-icon"/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<title>IT B.E.A.N.S.</title>
<meta charset="utf-8">
</head>

<body>



<a href="index.php">
<div id="button_home" class="btn"><p class="btn_text" align="center">Главная</p></div>
</a>
<a href="members.php">
<div id="button_members" class="btn"><p class="btn_text" align="center">Участники</p></div>
</a>
<a href="accout.php">
<div id="button_myCab" class="btn"><p class="btn_text" align="center">Мой кабинет</p></div>
</a>

<div margin-top="10" id="shapka_fon">
<b class="head">IT B.E.A.N.S.</b>
</div>

<div style="
	position:relative;
	top:130;
	background:white;
	width:90%;
	margin:0 auto;
	height:30;
	border: 16 solid black;
	box-shadow: 0 0 10px;
" id="search">
<form method="get">
<input name="search" type="text" onclick="this.value=''; sorter('sss');" value="поиск . . ." style="color:gray; width:100%; height:30; position:relative; margin:auto auto"/>
<div id="search" style="background:#4D65FD; box-shadow: 0 0 10px; width:30; position:relative; margin: -30 100%; height:30;"><img style="position:relative; margin:auto auto; width:30; height:30;" src="search.png"/></div>

</form>
</div>

<?php

for($i=0;$i<count($statti);$i++)
{
$zag=$statti[$i]->head;
$cont=$statti[$i]->content;
echo "<div style=\" min-width:600; margin:20 auto; top:130;\" class=\"main\" id=\"main_$i\">";
echo "<div style=\" background:#6B7DF5; width:-1; height:35; box-shadow: 0 0 10px; \" ><p class=\"zagolovok\">$zag</p></div>";
	echo "<p style=\"margin:10 5;\" class=\"text_S\">$cont</p>";
	
	echo "<div class=\"btnS\" style=\"width:200; position:absolute; bottom:10; box-shadow: 0 0 10px; left:10; height:30; background:#4D65FD;\">";
		echo "<a class=\"small_btn_text\">подробнее. . .</a>";
	echo "</div>";
	
echo "</div>";
}
?>

</body>
</html>