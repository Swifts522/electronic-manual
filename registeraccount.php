<?php
    include "config.php";
    $query = "SELECT * FROM `accounts` WHERE `Email` = '".$_POST['Email']."'";
    $res=mysql_query($query);
    if(mysql_num_rows($res) > 0) echo "0";    
    else
    {
        $query = "INSERT INTO `accounts` (`Name`, `Fam`, `MiddleName`, `Password`, `Email`) VALUES('".$_POST['Name']."', '".$_POST['Surname']."', '".$_POST['Lastname']."', '".$_POST['Firstpassword']."', '".$_POST['Email']."')";
        $res=mysql_query($query);
        echo "1";
    }
?>