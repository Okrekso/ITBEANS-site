<?php 
$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
$result=$sqlCon->query("SELECT Name, Login, Level, Status FROM Users");

function sorter($array)
{
    for($d=0;$d<count($array);$d++)
    {
        for($i=0;$i<count($array);$i++)
        {
            $elem=$array[$i]; $elem2=$array[$i+1];

            $a=$elem["Level"];
            $b=$elem2["Level"];
            
            echo "<script>console.log(\"$a | $b\");</script>";

            if($a<$b)
            {
            $temp=$array[$i+1];
            $array[$i+1]=$array[$i]; $array[$i]=$temp;
            }
        }
    }
    return $array;
}

function createUser($User, $Num)
{
    $Name=$User["Name"];
    $Xp=$User["Level"];
    $Status=$User["Status"];
    $Login=$User["Login"];
    if($Login!=$_COOKIE["userID"]) { echo "<div class=\"memberBlock\" style=\" position:relative; top:200; margin:10 auto;\">"; }
    else { echo "<div class=\"memberBlock\" style=\"background:#f3fafc; position:relative; top:200; margin:10 auto;\">"; }
        
        echo "<div class=\"bob_bg\" style=\"display: inline-block; float: left; position:relative;";
        if($Xp<30){ echo "background:#47ad4c; border-color:rgb(32, 121, 47); width:75; height:75; margin:6 6;\">"; }
        if($Xp>=30 && $Xp<90){ echo "background:#cc9509; border-color:rgb(175, 111, 7); width:75; height:75; margin:6 6;\">"; }
        if($Xp>=90 || $Status=="Admin"){ echo "background:#e6d200; border-color:rgb(174, 177, 7); width:75; height:75; margin:6 6;\">"; }
            
            if($Xp<30){ echo "<img src=\"/images/beans/green.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            if($Xp>=30 && $Xp<90){ echo "<img src=\"/images/beans/orange.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            if($Xp>=90 || $Status=="Admin"){ echo "<img src=\"/images/beans/yellow.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            
        echo "</div>";

        echo "<b class=\"text_S\" style=\"display:block; position:relative; margin:0 0; top:5;\" >$Name</b>";
        echo "<b class=\"text_S\" style=\"display:block; position:relative; margin:0 0; top:5;\" >#$Num</b>";

        if($Xp<30){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:green;\" >$Status</b>"; }
        if($Xp>=30 && $Xp<90){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:orange;\" >$Status</b>"; }
        if($Xp>=90 || $Status=="Admin"){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:#e6d200;\" >$Status</b>"; }
    
        echo "<div style=\"display:inline-block; margin:25 0; left:95; position:absolute; width:80%; height:5; background:white;\">";
            
                if($Xp<30) { echo "<div style=\"width:$Xp%; height:100%; background:green;\"></div>"; }
                if($Xp>=30 && $Xp<90) { echo "<div style=\"width:$Xp%; height:100%; background:orange;\"></div>"; }
                if($Xp>=90 || $Status=="Admin") { echo "<div style=\"width:$Xp%; height:100%; background:#e6d200;\"></div>"; }

            echo "<a class=\"text_S\" style=\"position:absolute; margin:0% 0%; top:5;\"></a>";
            echo "<a class=\"text_S\" style=\"position:absolute; margin:0% 10%; top:5;\">0</a>";
            echo "<a class=\"text_S\" style=\"position:absolute; margin:0% 50%; top:5;\">40</a>";
            echo "<a class=\"text_S\" style=\"position:absolute; margin:0% 90%; top:5;\">90</a>";
            echo "<a class=\"text_S\" style=\"position:absolute; margin:0% 100%; top:5;\">100</a>";
    echo "</div>";
    echo "</div>";
}



if($result!=null)
{
    $i=0;
    $users=array();
    while($Res=$result->fetch_assoc())
    { 
        array_push($users,$Res);
        $a=$Res['Name'];
        echo "<script>console.log(\"$a\");</script>";
    }
    $usr=sorter($users);

    for($i=0;$i<count($users);$i++)
    {
        createUser($usr[$i],$i+1);
    }
}
else { echo "<script>console.log(\"error while getting users.\");</script>"; }
?>