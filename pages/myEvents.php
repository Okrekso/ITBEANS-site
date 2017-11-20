<html>
        <head>
        <link rel="shortcut icon" href="/bean.ico" type="x-icon"/>
        <script src="/pages/javascript/initials.js" type="text/javascript"></script>
        <script src="/pages/javascript/switchers.js" type="text/javascript"></script>
        <link href="/pages/styles/style.css" rel="stylesheet" type="text/css"/>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <title>IT B.E.A.N.S.</title>
        <meta charset="utf-8">
        </head>
        
        <body>

        <?php include_once 'php/registration.php'?>
        <?php include_once 'php/newsShower.php'?>
        
        <?php
        if(getUserProtectLevel()>1)
        {
        echo "<form id=\"uservisit\" method=\"post\">";
            echo "<input id=\"toVisit\" name=\"toVisit\" style=\"display:none;\"></input>";
        echo "</form>";
        }
        ?>

        <?php
        function setVisited($str)
        {
            $elems=explode(";",$str);
            for($i=0;$i<count($elems);$i++)
            {
                $element=explode("-",$elems[$i]);
                $NewsID=$element[0];
                $UserID=$element[1];
                $Visited=$element[2];
                $Additional=$element[3];
                $sqlCon= getSqlUrl();
                $result=$sqlCon->query("UPDATE `Visitors` SET `Visited`='$Visited', `Additional`='$Additional' WHERE `NewsID`='$NewsID' AND `UserID`='$UserID'");  
                if($result!=true){ echo "<script>console.log(\"errors while upd\");</script>"; }            
            }
        }

        setVisited($_POST["toVisit"]);
        $sqlCon= getSqlUrl();
        $CreatorID=getUservalue($_COOKIE["userID"], "ID");
        $count=0;
        $result=$sqlCon->query("SELECT ID FROM News WHERE Creator_ID='$CreatorID' AND Type='Event'");
        while($event=$result->fetch_assoc()){ $count+=1; }
        $result->close();
        $result=$sqlCon->query("SELECT Head, ID, Small_content,Type,StartDate FROM News WHERE Creator_ID='$CreatorID' AND Type='Event' ORDER BY `StartDate` DESC");

        $i=0;
        while($event=$result->fetch_assoc())
        {
            $name = $event["Head"];
            $id=$event["ID"];
            
            $d=strtotime($event["StartDate"]);
            
            $now=date("U");
            $now=strtotime("-1 hour");
            
            $dif=($d-$now);
            $howFar=$dif/60;

            $members_count=0;

            $result2=$sqlCon->query("SELECT UserID,Visited,Additional FROM Visitors WHERE NewsID='$id'");
            echo "<div id=\"elem_$i\" class=\"memberBlock\" style=\"position:relative; height:50; top:200; min-width:250; width:500; margin:0 auto; \">";
            global $eventsHeight;
            $eventsHeight+=100;  
                echo "<div id=\"bg_$i\" class=\"memberBlock\" style=\"position:absolute; background-color:rgba(0,0,0,0.2);min-width:250; width:100%; height:0; margin:0 auto; top:50; display:none;\">";
                    
                    while($user=$result2->fetch_assoc())
                    {
                    $members_count++;
                    $userID=$user["UserID"];
                    $visited=$user["Visited"];
                    $Additional=$user["Additional"];
                    $userName=getSqlValueById($user["UserID"], "Name","Users");
                    echo "<div id=\"visitor_$i\" style=\"position:relative; width:100%; height:25; background:white; box-shadow:0 0 10px #a1a1a1; opacity:1;\">";
                    echo "<a class=\"text_S\" style=\"color:black; margin:50% 0;\">"; echo "$userName"; echo "</a>";
                        if($howFar<=0)
                        {
                        echo "<div style=\"background:#c5c5c5; width:50; top:0; position:absolute; right:0; height:100%;\">";
                            echo "<div id=\"isPres_$id-$userID\" class=\"isVisited\" onclick=\"switcher('isPres_$id-$userID');\" style=\"cursor:pointer; width:50%; height:100%; background:#0f2848;\"></div>";
                        echo "</div>";
                        echo "<input value=\"$Additional\" id=\"additional_$id-$userID\" onfocusin=\"clearElem('additional_$id-$userID','$Additional');\" onfocusout=\"clearElem('additional_$id-$userID','$Additional');\" style=\"width:50; margin:auto auto; right:55; top:2; text-align:center; position:absolute;\"></input>";
                        }
                    echo "</div>";
                    
                    echo "<script>";
                    if($visited==1){echo "setVisitedElement($id,$userID,$visited,$Additional);"; echo "setSwitcher('isPres_$id-$userID',1);"; }
                    else { echo "setVisitedElement($id,$userID,$visited,$Additional);"; echo "setSwitcher('isPres_$id-$userID',0);"; }
                    echo "</script>";
                    }

                echo "</div>";            
                
                $nameSliced=substr($name,0,50);
                if(strlen($name)>=50){$nameSliced=$nameSliced."...";}
                echo "<a style=\"font-size:32; position:relative; left:15; top:5;\" class=\"text_S\">$nameSliced</a>";
                echo "<img onclick=\"openEvent($i,$count,$members_count);\" src=\"/images/triangle.png\" style=\"cursor:pointer; position:absolute; right:10; top:8; width:35; height:35;display:inline-block;\"\"></img>";
            echo "</div>";
            $i++;
        }
        ?>
        <div id="sendB" onclick="submitUserVisit();" style="width:500; min-width:150; cursor:pointer; height:25; background:#0f2848; position:relative; top:200; margin:0 auto;">
            <a class="text_S" style="color:white; margin: auto auto; height:50%; top:4; width:100%; text-align:center; position:absolute;">зберегти зміни</a>
        </div>

        <script>
        
        function submitUserVisit()
        {
            document.getElementById("uservisit").submit();
        }
        function hideElement(count,i)
        {
            for(d=0;d<count;d++)
            {
                if(d!=i)
                {
                    $("#bg_"+d).css({display:"none"});
                }
                if(d!=i)
                {
                    $("#bg_"+d).css({display:"none"});
                }
            }
        }
        
        var Hs=new Array();
        function openEvent(i,count,members)
        {
            Hs[i]=(members*30);
            
            for(d=0;d<count;d++)
            {
                if($("#elem_"+d).css("top")!="200px")
                {
                $("#elem_"+d).animate({top:"200px"},500,function(){ hideElement(count,i); });
                }
                if($("#bg_"+d).css("height")!="0px")
                {
                    //$("#sendB").animate({top:"-="+$("#bg_"+d).css("height")},500);
                $("#bg_"+d).animate({height:"0px"},500,function(){ hideElement(count,i); });
                }
            }
            $("#sendB").animate({top:200+Hs[i]},500);
            $("#bg_"+i).css({display:"block"});
            $("#bg_"+i).animate({height:"+="+Hs[i]},500);
            for(d=i+1;d<count;d++)
            {
                $("#elem_"+d).animate({top:"+="+Hs[i]},500);
            }
            
        }
        </script>

            <div id="head"></div>
        
            <script> 
            setHeader();
            </script> 
        </body>
        
        </html>
        
        