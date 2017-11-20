<?php

function chekUserRegistration()
{
    $ID=$_COOKIE["userID"];
    $Name=$_COOKIE["userName"];

    if($ID!="none")
    {
        registrateUser($ID,$Name);
    }
}

function registrateUser($UserID,$UserName)
{
    $sqlCon= getSqlUrl();
    $result=$sqlCon->query("SELECT * FROM Users WHERE Login='$UserID'");
    $User=$result->fetch_assoc();
    
    if(count($User)==0)
    {
        
        $Querry="INSERT into Users(Login, Status, Name) VALUES ($UserID,'unaccepted','$UserName')";
        
        if($sqlCon->query($Querry)) { echo "<script>console.log(\" registration seccessful \");</script>"; $sqlCon->close(); return 1; }
    }
    else { $sqlCon->close(); return 0; }
}
function isPostCreator($UserID,$PostID)
{
    if(getUserValue($UserID,"ID")==getSqlValueById($PostID,"Creator_ID","News")){return 1;}
    else {return 0;}
}
function getUserValue($UserID,$Value)
{
    $sqlCon= getSqlUrl();
    $result=$sqlCon->query("SELECT $Value FROM `Users` WHERE Login='$UserID'");
    if($result!=null) { $sqlCon->close(); $Xp=$result->fetch_assoc(); }

    return $Xp["$Value"];
}
function getSqlValueById($ID,$Value,$Table)
{
    $sqlCon= getSqlUrl();
    $result=$sqlCon->query("SELECT $Value FROM $Table WHERE ID='$ID'");
    if($result!=null) { $sqlCon->close(); $Xp=$result->fetch_assoc(); }
    return $Xp["$Value"];
}

function isOnEvent($userID,$eventID)
{
    $sqlCon= getSqlUrl();
    $result=$sqlCon->query("SELECT * FROM `Visitors` WHERE `NewsID`='$eventID' AND `UserID`='$userID'");
    if($result!=null) { $sqlCon->close(); $rows=$result->fetch_assoc(); $a=$rows["ID"]; if($rows["ID"]!=""){return 1;}else{return 0;} }
    return 0;
}

function setSqlValue($ID,$ValueName,$Value,$Table)
{
    $sqlCon=getSqlUrl();
    $result=$sqlCon->query("UPDATE $Table SET $ValueName='$Value' WHERE ID='$ID';");
    if($result==true) { $sqlCon->close(); return 1; }
    else { return 0; }
}
function getSqlUrl()
{
    return new mysqli("127.0.0.1:3306","root","","ITB");
}
function getUserStatus()
{
    return getUserValue($_COOKIE["userID"],"Status");
}
function getUserProtectLevel()
{
    switch(getUserValue($_COOKIE["userID"],"Status"))
    {
        case("White"): return 0; break;
        case("Green"): return 1; break;
        case("Orange"): return 2; break;
        case("Gold"): return 3; break;
        case("Diamond"): return 3; break;
        case("Legendary"): return 3; break;
    }
    return 0;
}
function getUserStatusById($Id)
{
    return getSqlValueById($Id,"Status","Users");
}
function setUserValue($UserID,$ValueName, $Value)
{
    $sqlCon= getSqlUrl();
    $result=$sqlCon->query("UPDATE Users SET $ValueName='$Value' WHERE Login='$UserID'");
    if($result!=null) { $sqlCon->close(); return 1; }
    else { return 0; }
}

function consoleLog($string)
{
    echo "<script>console.log(\"$string\");</script>";
}

function isNextB()
{
    $page=$_GET["page"]==null?0:$_GET["page"]; $maxP=($page+1)*10;
    $sqlCon= getSqlUrl();
    $res=$sqlCon->query("SELECT * FROM News ORDER BY ID DESC LIMIT 10 OFFSET $maxP");
    $result=$res->fetch_assoc();
    if ($result['Head']!='') { return 1; } else { return 0; }
}
?>