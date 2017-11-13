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
	public $creator;
	public function __construct($ID, $head, $content, $smallContent, $type, $StartDate,$CreatorID)
	{
		$this->head=$head; $this->content=$content; $this->ID=$ID; $this->smallContent=$smallContent;
		$this->point=0; $this->type=$type; $this->startDate=$StartDate;

		$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
		$result=$sqlCon->query("SELECT `Name` FROM `Users` WHERE `ID`='$CreatorID'");
		if($result!=null) { $r=$result->fetch_assoc(); $this->creator=$r['Name']; }
		else {$this->creator="error";}
	}

	function howFar()
	{
	//if($this->startDate==null){ return "error"; }
	$d=strtotime($this->startDate);
	
	$now=date("U");
	$now=strtotime("-1 hour");
	
	$dif=($d-$now);
	$dif=$dif/60;

	return $dif;
	}

	function chek_search($str)
	{
		$str=mb_strtolower($str,'UTF-8'); $str=str_replace(' ','',$str); $strLen=iconv_strlen($str,'UTF-8');
		$head=mb_strtolower($this->head,'UTF-8'); $head=str_replace(' ','',$head); $headLen=iconv_strlen($head,'UTF-8');
		$creat=mb_strtolower($this->creator,'UTF-8'); $creat=str_replace(' ','',$creat); $creatLen=iconv_strlen($creat,'UTF-8');
		$date=($this->startDate);
		$month=split('-',$date)[1]; $day=split(' ',split('-',$date)[2])[0]; $monthLen=iconv_strlen($$month,'UTF-8'); $dayLen=iconv_strlen($day,'UTF-8');
		consoleLog("$month | $day");
		$end=false;
		$start=0;
		
		$ball=100/$strLen;

		for($i=0;$i<$strLen;$i++)
		{
			$str_char=iconv_substr($str,$i,1,'UTF-8');
			
			for($d=$start;$d<$headLen;$d++)
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

		$end=false;
		$start=0;
		for($i=0;$i<$strLen;$i++)
		{
			$str_char=iconv_substr($str,$i,1,'UTF-8');
			
			for($d=$start;$d<$creatLen;$d++)
			{
				$stat_char=iconv_substr($creat,$d,1,'UTF-8');
				
				if($str_char==$stat_char)
				{
					$this->point+=$ball;
					consoleLog("++");
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
		sorterEvents();
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
			$temp=$events[$d];
			$events[$d]=$events[$d+1];
			$events[$d+1]=$temp;
		}
	}
	}

	$a=0;
	while($a<count($events) && $events[$a]->howFar()<0)
	{
	$a++;
	}
	
	$statti=$stat;
	
		if($a!=count($events))
		{
	for($i=(count($statti)-1);$i>=0;$i--)
	{
		$statti[$i+1]=$statti[$i];
	}

	$statti[0]=$events[$a];
	return 1;
		}
	return 0;
	}
	//$statti=array();
	
}

function fillNews()
{
global $statti,$stat;
$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
$page=$_GET["page"]==null?0:$_GET["page"]; $maxP=$page*10;

$Closest=$sqlCon->query("SELECT * FROM News WHERE `StartDate`!='0000-00-00 00:00:00' AND `StartDate`>=NOW() ORDER BY StartDate ASC LIMIT 1");
$res=$Closest->fetch_assoc(); 

$News=$sqlCon->query("SELECT * FROM News ORDER BY ID DESC LIMIT 10 OFFSET $maxP");

$stat=array();
while($rows=$News->fetch_assoc())
{
	array_push($stat, new sMain($rows["ID"],$rows["Head"],$rows["Content"],$rows["Small_content"],$rows["Type"],$rows["StartDate"],$rows["Creator_ID"]));
}
$statti=array_reverse($stat);
$sqlCon->close();

if($_GET['search']==null) { $closest=sorterEvents(); }

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
	$Result=$sqlCon->query("DELETE FROM `Visitors` WHERE NewsID=$ID");
	if($Result!=null)
	{
		$Result=$sqlCon->query("DELETE FROM `News` WHERE ID=$ID");
		if($Result!=null) { $_POST=array(); $sqlCon->close(); return 1; }
	}
}

?>