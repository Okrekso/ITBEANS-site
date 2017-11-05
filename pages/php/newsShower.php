<?php 
global $statti,$stat;

class sMain
{
	public $ID;
	public $head;
	public $content;
	public $smallContent;
	public $type;
	public $startDate;
	public $point;
	public function __construct($ID, $head, $content, $smallContent, $type, $StartDate)
	{
		$this->head=$head; $this->content=$content; $this->ID=$ID; $this->smallContent=$smallContent;
		$this->point=0; $this->type=$type; $this->startDate=$StartDate;
	}

	function howFar()
	{
	$d=strtotime($this->startDate);
	
	$now=date("U");
	$now=strtotime("-1 hour");

	$dif=($d-$now);
	$dif=$dif/60;
	return $dif;
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
class User
{
	public $Name;
	public $Pass;
	public $Facebook;
	public $logined;

	public function __construct()
	{
		echo
		"<div style=\"position:fixed; width:150; heigth:150; background:black;\"></div>";
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
function sorterEvents()
{
	global $statti,$stat;
	
	$events=array();
	for($i=0;$i<count($stat);$i++)
	{
		if($stat[$i]->type=="Event")
		{
			array_push($events, $stat[$i]);
		}
	}
	$d=count($events);
	
	if(count($events)>0)
	{
		$statti=array();
		
	for($i=0;$i<count($events);$i++)
	{
	for($d=0;$d<count($events);$d++)
	{
		if($d!=(count($events)-1) && $events[$d]->howFar()>$events[$d+1]->howFar())
		{
			$a=$d+1;
			$temp=$events[$d];
			$events[$d]=$events[$d+1];
			$events[$d+1]=$temp;
		}
	}
	}
	$a=$events[0]->head;
	$a=0;
	while($events[$a]->howFar()<0)
	{
	$a++;
	}

	$statti=array_reverse($stat);
	for($i=(count($statti)-1);$i>=0;$i--)
	{
		$statti[$i+1]=$statti[$i];
	}

	$statti[0]=$events[$a];

	
	$action=$stat[0];
	}
	//$statti=array();
	
}

function fillNews()
{
global $statti,$stat;
$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
$News=$sqlCon->query("SELECT * FROM News");

$stat=array();
while($rows=$News->fetch_assoc())
{
	array_push($stat, new sMain($rows["ID"],$rows["Head"],$rows["Content"],$rows["Small_content"],$rows["Type"],$rows["StartDate"]));
}
$statti=array_reverse($stat);
$sqlCon->close();

sorterEvents();
sorter($_GET['search']);
}

function getNews($ID)
{
	fillNews();
	global $statti;
	$d=count($statti);
	$g=$_GET["newsID"];
	
	for($i=0;$i<count($statti);$i++)
	{
		$a=$statti[$i]->ID;
		if($statti[$i]->ID==$ID){ return $statti[$i]; }
	}

	return "null";
}
function deleteNews($ID)
{
	fillNews();
	global $statti;
	$d=count($statti);
	$g=$_POST["toDelete"];
	
	$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
	$Result=$sqlCon->query("DELETE FROM News WHERE ID=$ID");
	if($Result!=null) { $_POST=array(); $sqlCon->close(); return 1; }
}

?>