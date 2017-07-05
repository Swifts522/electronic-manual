<?php
    include "config.php";
    $query = "SELECT * FROM `book` WHERE `Name` = '".$_POST['Name']."'";
    $res=mysql_query($query);
    if(mysql_num_rows($res) > 0) echo "0";    
    else
    {
        $query = "INSERT INTO `book` (`Name`, `Group`, `TeacherID`) VALUES('".$_POST['Name']."', '".$_POST['Group']."', '".$_SESSION['Teacher']."')";
        $res=mysql_query($query);
        echo "1";
    }
?>