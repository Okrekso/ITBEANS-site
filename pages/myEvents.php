<html>
        <head>
        <link rel="shortcut icon" href="/bean.ico" type="x-icon"/>
        <script src="/pages/javascript/initials.js" type="text/javascript"></script>
        <link href="/pages/styles/style.css" rel="stylesheet" type="text/css"/>
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <title>IT B.E.A.N.S.</title>
        <meta charset="utf-8">
        </head>
        
        <body>
        
        <?php include_once '/php/registration.php'?>
        <?php include_once '/php/newsShower.php'?>

        <?php
        $sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
        $CreatorID=getUservalue($_COOKIE["userID"], "ID");
        $count=0;
        $result=$sqlCon->query("SELECT ID FROM News WHERE Creator_ID='$CreatorID' AND Type='Event'");
        while($event=$result->fetch_assoc()){ $count+=1; }
        $result->close();
        $result=$sqlCon->query("SELECT Head, ID, Small_content,Type FROM News WHERE Creator_ID='$CreatorID' AND Type='Event'");

        $i=0;
        while($event=$result->fetch_assoc())
        {
            $name = $event["Head"];
            $id=$event["ID"];
            $result2=$sqlCon->query("SELECT UserID FROM Visitors WHERE NewsID='$id'");
            echo "<div id=\"elem_$i\" class=\"memberBlock\" style=\"position:relative; height:50; min-width:250; width:500; margin:0 auto; top:150;\">";
                
                echo "<div id=\"bg_$i\" class=\"memberBlock\" style=\"position:absolute; background-color:rgba(0,0,0,0.2);min-width:250; width:100%; height:0; margin:0 auto; top:50; display:none;\">";
                    
                    while($user=$result2->fetch_assoc())
                    {
                    $d=$user["UserID"];
                    $userName=getSqlValueById($user["UserID"], "Name","Users");
                    echo "<div id=\"visitor_$i\" style=\"position:relative; width:100%; height:25; background:white; box-shadow:0 0 10px #a1a1a1; opacity:1;\">";
                    echo "<a class=\"text_S\" style=\"color:black; margin:50% 0;\">"; echo "$userName"; echo "</a>";
                        echo "<div style=\"background:#c5c5c5; width:50; top:0; position:absolute; right:0; height:100%;\">";
                            echo "<div id=\"isPres_$id-$d\" class=\"switcher\" onclick=\"switcher('isPres_$id-$d');\" style=\"cursor:pointer; width:50%; height:100%; background:#0f2848;\"></div>";
                        echo "</div>";
                    echo "</div>";
                    }

                echo "</div>";            
                
                echo "<a style=\"font-size:32; position:relative; left:15; top:5;\" class=\"text_S\">$name</a>";
                echo "<img onclick=\"openEvent($i,$count);\" src=\"/images/triangle.png\" style=\"cursor:pointer; position:absolute; right:10; top:8; width:35; height:35;display:inline-block;\"\"></img>";
            echo "</div>";
            $i++;
        }
        ?>
        <script>

        </script>

        <script>
        function hideElement(count,i)
        {
            for(d=0;d<count;d++)
            {
                if($("#elem_"+d).css("top")!="150px" && d!=i)
                {
                    $("#bg_"+d).css({display:"none"});
                }
                if($("#bg_"+d).css("height")!="0px" && d!=i)
                {
                    $("#bg_"+d).css({display:"none"});
                }
            }
        }
        
        function openEvent(i,count)
        {
            newH=100;
            for(d=0;d<count;d++)
            {
                if($("#elem_"+d).css("top")!="150px")
                {
                $("#elem_"+d).animate({top:"-="+newH},500,function(){ hideElement(count,i); });
                }
                if($("#bg_"+d).css("height")!="0px")
                {
                $("#bg_"+d).animate({height:"-="+newH},500,function(){ hideElement(count,i); });
                }
                
            }
            $("#bg_"+i).css({display:"block"});
            $("#bg_"+i).animate({height:"+="+newH},500);

            for(d=i+1;d<count;d++)
            {
                $("#elem_"+d).animate({top:"+="+newH},500);
            }
        }
        </script>

            <div id="head"></div>
        
            <script> 
            setHeader();
            </script> 
        </body>
        
        </html>
        
        