<?php
function test()
{
    echo "hello PHP!";
}
function chekUserRegistration($UserID)
{


$sqlCon= new mysqli("127.0.0.1:3306","root","","ITB");
$User=$sqlCon->query("SELECT * FROM Users WHERE Login='$UserID'");
if($User.count()>0)
{
    return 1;
}
else
{
    return 0;
}
}

function registrateUser($UserID)
{
    switch(chekUserRegistration($UserID))
    {
        case(1):{ break;}
        case(0):{ break;}
    }
}
?>