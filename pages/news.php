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
		$this->point=0;
	}

	function chek_search($str)
	{
		$str=mb_strtolower($str,'UTF-8');
		$head=mb_strtolower($this->head,'UTF-8');
		$end=false;
		$start=0;

		$ball=100/iconv_strlen($str,'UTF-8');

		for($i=0;$i<iconv_strlen($str,'UTF-8');$i++)
		{
			$str_char=iconv_substr($str,$i,1,'UTF-8');
			
			for($d=$start;$d<iconv_strlen($head,'UTF-8');$d++)
			{
				$stat_char=iconv_substr($head,$d,1,'UTF-8');
				
				if($str_char==$stat_char)
				{
					$this->point+=$ball;
					$start=$d+1;
					break;
				}
				else
				{
					if($this->point>=$ball)
					{
						$end=true;
						break;
					}
				}
			}

			if($end)
			{
				break;
			}
		}
	}
}

function sorter($str)
{
	$str=mb_strtolower($str,'UTF-8');
	//echo "<script>alert(\"$str\")</script>";
	if($_GET['search']!=null)
	{
		global $statti,$stat;
		
		$statti=array();
		
		for($i=0;$i<count($stat);$i++)
		{
			$stat[$i]->chek_search($str);
			if($stat[$i]->point>50)
			{
				array_push($statti,$stat[$i]);
			}
		}
	}
	else
	{
		$statti=$stat;
	}
}

$stat=[new sMain("Основание клуба","тут будет текст; а это типа картинка"), new sMain("Иерархия клуба","тратата"),
new sMain("Дополнительные баллы","текст о баллах"), new sMain("Кодовый час","еще какой-то текст")];
$statti=array_reverse($stat);



sorter($_GET['search']);
?>
<html>
<head>
<link rel="shortcut icon" href="/bean.ico" type="x-icon"/>
<link href="/pages/styles/style.css" rel="stylesheet" type="text/css"/>
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
<a href="news.php">
<div id="button_news" class="btn"><p class="btn_text" align="center">Новости</p></div>
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
<div id="search" onclick="document.location.href="itb"" style="background:#4D65FD; box-shadow: 0 0 10px; width:30; position:relative; margin: -30 100%; height:30;"><img style="position:relative; margin:auto auto; width:30; height:30;" src="/search.png"/></div>

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