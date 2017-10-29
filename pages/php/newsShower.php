<?php 
class sMain
{
	public $ID;
	public $head;
	public $content;
	public $picture;
	public $point;
	public function __construct($ID, $head, $content)
	{
		$this->head=$head; $this->content=$content; $this->ID=$ID;
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

$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
$News=$sqlCon->query("SELECT * FROM News");

$stat=array();
while($rows=$News->fetch_assoc())
{
	array_push($stat, new sMain($rows["ID"],$rows["Head"],$rows["Small_content"]));
}


$statti=array_reverse($stat);



sorter($_GET['search']);
?>