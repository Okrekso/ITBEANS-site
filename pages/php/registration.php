<?php

function chekUserRegistration()
{
    $ID=$_COOKIE["userID"];
    $Name=$_COOKIE["userName"];

    if($ID!="none")
    {
        registrateUser($ID,$Name);
        setUserValue($ID,"Status","Gold");
        setUserValue($ID,"Level",100);
    }
}

function registrateUser($UserID,$UserName)
{
    $sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
    $result=$sqlCon->query("SELECT * FROM Users WHERE Login='$UserID'");
    $User=$result->fetch_assoc();
    
    if(count($User)==0)
    {
        
        $Querry="INSERT into Users(Login, Level, Status, Name) VALUES ($UserID,0,'unaccepted','$UserName')";
        
        if($sqlCon->query($Querry)) { echo "<script>console.log(\" registration seccessful \");</script>"; $sqlCon->close(); return 1; }
    }
    else { $sqlCon->close(); return 0; }
}

function getUserValue($UserID,$Value)
{
    $sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
    $result=$sqlCon->query("SELECT $Value FROM `Users` WHERE Login='$UserID'");
    if($result!=null) { $sqlCon->close(); $Xp=$result->fetch_assoc(); }

    return $Xp["$Value"];
}
function getSqlValueById($ID,$Value,$Table)
{
    $sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
    $result=$sqlCon->query("SELECT $Value FROM $Table WHERE ID='$ID'");
    if($result!=null) { $sqlCon->close(); $Xp=$result->fetch_assoc(); }

    return $Xp["$Value"];
}
function setUserValue($UserID,$ValueName, $Value)
{
    $sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
    $result=$sqlCon->query("UPDATE Users SET $ValueName='$Value' WHERE Login='$UserID'");
    if($result!=null) { $sqlCon->close(); return 1; }
    else { return 0; }
}
?>