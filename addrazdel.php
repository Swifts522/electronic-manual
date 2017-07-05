<?php
    include "config.php";
    if(strlen($_POST['Subsection']) > 1)
    {
        $query = "SELECT * FROM `templates` WHERE `Razdel` = '".$_POST['Subsection']."'";
        $res=mysql_query($query); 
        $row = mysql_fetch_assoc($res);
        $id = $row['ID'];
        $query = "INSERT INTO `templates` (`Razdel`, `ID_Book`, `ID_Razdel`, `Text`) VALUES('".$_POST['Name']."', '".$_POST['Book']."', '".$id."', '".$_POST['Text']."')";
        $res=mysql_query($query); 
        echo "2";
    }
    else
    {
        $query = "INSERT INTO `templates` (`Razdel`, `ID_Book`, `Text`) VALUES('".$_POST['Name']."', '".$_POST['Book']."', '".$_POST['Text']."')";
        $res=mysql_query($query);
        echo "1";
    }
?>