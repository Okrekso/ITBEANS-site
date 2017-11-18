
<?php 
$sqlCon= getSqlUrl();
$result=$sqlCon->query("SELECT ID, Name, Login, Level, Status FROM Users");

function sorter($array)
{
    for($d=0;$d<count($array);$d++)
    {
        for($i=0;$i<count($array);$i++)
        {
            $elem=$array[$i]; $elem2=$array[$i+1];

            $a=$elem["Level"];
            $b=$elem2["Level"];
            

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
    $ID=$User["ID"];
    
    if($Xp=="" && getUserStatus()=="Gold" || $Xp!="")
    {
    if($Login!=$_COOKIE["userID"]) { echo "<div class=\"memberBlock\" style=\" position:relative; top:200; margin:10 auto;\">"; }
    else { echo "<div class=\"memberBlock\" style=\"background:#f3fafc; position:relative; top:200; margin:10 auto;\">"; }
        
        if($Xp=="") 
        {
        echo "<div class=\"bob_bg\" style=\"display: inline-block; float: left; position:relative; ";
        echo "background:#6d6d6d; border-color:rgb(72, 72, 72); width:75; height:75; margin:6 6;\">"; 
        }  
        else
        {
        echo "<div class=\"bob_bg\" style=\"display: inline-block; float: left; position:relative; ";
        if(getUserStatusById($ID)=="Green"){ echo "background:#47ad4c; border-color:rgb(32, 121, 47); width:75; height:75; margin:6 6;\">"; }
        if(getUserStatusById($ID)=="Orange"){ echo "background:#cc9509; border-color:rgb(175, 111, 7); width:75; height:75; margin:6 6;\">"; }
        if(getUserStatusById($ID)=="Gold"){ echo "background:#e6d200; border-color:rgb(174, 177, 7); width:75; height:75; margin:6 6;\">"; }
        if(getUserStatusById($ID)=="Diamond"){ echo "background:#195b60; border-color:rgb(67, 132, 137); width:75; height:75; margin:6 6;\">"; }
        if(getUserStatusById($ID)=="Legendary"){ echo "background:#610c79; border-color:rgb(115, 21, 98); width:75; height:75; margin:6 6;\">"; }
        if(getUserStatusById($ID)=="Deleted"){ echo "background:#b30000; border-color:rgb(118, 0, 0); width:75; height:75; margin:6 6;\">"; }
        }
            if($Xp=="") { echo "<img src=\"/images/beans/gray.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            else
            {
            if(getUserStatusById($ID)=="Green"){ echo "<img src=\"/images/beans/green.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            if(getUserStatusById($ID)=="Orange"){ echo "<img src=\"/images/beans/orange.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            if(getUserStatusById($ID)=="Gold"){ echo "<img src=\"/images/beans/yellow.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            if(getUserStatusById($ID)=="Diamond"){ echo "<img src=\"/images/beans/diamond.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            if(getUserStatusById($ID)=="Legendary"){ echo "<img src=\"/images/beans/legendary.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            if(getUserStatusById($ID)=="Deleted"){ echo "<img src=\"/images/beans/red.png\" class=\"bob_img\" style=\"width:50; height:70; margin: auto 50%; top:2; left:-25;\"></img>"; }
            }

        echo "</div>";

        echo "<b class=\"text_S\" style=\"display:block; position:relative; margin:0 0; top:5;\" >$Name</b>";
        echo "<b class=\"text_S\" style=\"display:block; position:relative; margin:0 0; top:5;\" >#$Num</b>";
        
        if(getUserStatusById($ID)==""){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:gray;\" >$Status</b>"; }
        else
        {
        if(getUserStatusById($ID)=="Green"){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:green;\" >$Status</b>"; }
        if(getUserStatusById($ID)=="Orange"){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:orange;\" >$Status</b>"; }
        if(getUserStatusById($ID)=="Gold"){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:#e6d200;\" >$Status</b>"; }
        if(getUserStatusById($ID)=="Diamond"){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:#376d71;\" >$Status</b>"; }
        if(getUserStatusById($ID)=="Legendary"){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:#71376a;\" >$Status</b>"; }
        if(getUserStatusById($ID)=="Deleted"){ echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:red;\" >$Status</b>"; }        
        }
        //echo "<b class=\"text_S\" style=\" position:relative; margin:0 0; top:5; font-size:10; color:black;\">$Xp</b>";
            
        if(getUserStatusById($ID)==""  || getUserStatusById($ID)=="Orange" && getSqlValueById($ID,"Level","Users")>90 || getUserStatusById($ID)=="Deleted")
        { 
        if(getUserProtectLevel()>=3)
        {
        $toGold=0;
        if(getUserStatusById($ID)=="Orange" && getSqlValueById($ID,"Level","Users")>90){$toGold=1;}
        echo "<div class=\"btn_clear\" style=\"width:150; height:25; left:95; bottom:10;\">";
        echo "<a class=\"text_S\" onclick=\"";
            if($toGold==0) { echo "acceptUser($ID);"; }
            else { echo "toGoldUser($ID);"; }
        echo "\" style=\"color:white; top:10%; width:90%; text-align:center; position:absolute;\">підтвердити</a>";
        echo "</div>";
        }
        }
        else
        {
        if(getUserStatusById($ID)!="Diamond" && getUserStatusById($ID)!="Legendary")
        { 
            echo "<div style=\"display:inline-block; margin:25 0; left:95; position:absolute; width:80%; height:5; background:white;\">";
        }
        if(getUserStatusById($ID)=="Diamond")
        { 
            echo "<div style=\"display:inline-block; margin:25 0; left:95; position:absolute; width:80%; height:5; background:#e6d200;\">";
        }
        if($Xp<=300 && getUserStatusById($ID)=="Legendary")
        { 
            echo "<div style=\"display:inline-block; margin:25 0; left:95; position:absolute; width:80%; height:5; background:#c3e7f8;\">";
        }
        if($Xp>300)
        {
            echo "<div style=\"display:inline-block; margin:25 0; left:95; position:absolute; width:80%; height:5; background:#941189;\">";            
        }

            if(getUserStatusById($ID)=="Green") { echo "<div style=\"width:$Xp%; height:100%; background:green;\"></div>"; }
            if(getUserStatusById($ID)=="Orange") { echo "<div style=\"width:$Xp%; height:100%; background:orange;\"></div>"; }
            if(getUserStatusById($ID)=="Gold") { echo "<div style=\"width:$Xp%; height:100%; background:#e6d200;\"></div>"; }
            if(getUserStatusById($ID)=="Diamond"){ echo "<div style=\"width: calc($Xp% - 100%); height: 100%; background: #c3e7f8;\"></div>"; }
            if(getUserStatusById($ID)=="Legendary") 
            { 
                $wdth=$Xp>300?$Xp-300:$Xp-200; 
                if($Xp<=300) { echo "<div style=\"width:$wdth%; height:100%; background:#941189;\"></div>"; }
                if($Xp>300) { echo "<div style=\"width:$wdth%; height:100%; background:#6c00ff;\"></div>"; }
            }

            echo "<a class=\"text_S\" style=\"dipslay:block; position:absolute; margin:0% 0%; top:5;\"></a>";
            echo "<a class=\"text_S\" style=\"position:absolute; margin:0% 10%; top:5;\">0</a>";
            echo "<a class=\"text_S\" style=\"position:absolute; margin:0% 50%; top:5;\">40</a>";
            echo "<a class=\"text_S\" style=\"position:absolute; margin:0% 90%; top:5;\">90</a>";
            echo "<a class=\"text_S\" style=\"position:absolute; margin:0% 100%; top:5;\">100</a>";

            if(getUserStatusById($ID)=="Legendary")
            { $wdth=$Xp>300?$Xp-300:$Xp-200; echo "<img class='shine' src='/images/shine_legendary.png' style='width:50;height:50; position:absolute; margin:calc(0% - 25px) calc($wdth% - 25px);'></img>"; }
            if(getUserStatusById($ID)=="Diamond")
            { echo "<img class='shine' src='/images/shine_diamond.png' style='width:50;height:50; position:absolute; margin:calc(0% - 25px) calc($Xp% - 100% - 25px);'></img>"; }
        echo "</div>";
        }
    echo "</div>";
    
    }
}



if($result!=null)
{
    $i=0;
    $users=array();
    while($Res=$result->fetch_assoc())
    { 
        array_push($users,$Res);
        $a=$Res['Name'];
    }
    $usr=sorter($users);

    for($i=0;$i<count($users);$i++)
    {
        createUser($usr[$i],$i+1);
    }
}
else { echo "<script>console.log(\"error while getting users.\");</script>"; }
?>