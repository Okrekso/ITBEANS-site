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
<link rel="shortcut icon" href="/bean.ico" type="x-icon"/>
<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
<link href="/pages/styles/style.css" rel="stylesheet" type="text/css"/>
<title>IT B.E.A.N.S.</title>
<meta charset="utf-8">
</head>

<body>



<a href="index.php">
<div id="button_home" class="btn"><p class="btn_text" align="center">Главная</p></div>
</a>
<a href="news.php">
<div id="button_news" class="btn"><p class="btn_text" align="center">Новости</p></div>
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



<div style="position:relative; top:200;">
<img class="rideImg" src="/images/beans_bg_big.png"/>
</div>

<div aos="fade" style="position:absolute; width:100%; top:1000; left:0; rigth:0;">
<img  src="/images/beans_bg.png"/>
</div>

</body>
</html>