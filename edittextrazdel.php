<?php
    include "config.php";
    $query = "SELECT ID FROM `templates` WHERE `ID_Book` = '".$_POST['Book']."' AND `Razdel` = '".$_POST['Section']."'";
    $res=mysql_query($query); 
    $row = mysql_fetch_assoc($res);
    $id = $row['ID'];
    $query = "UPDATE `templates` SET `Razdel` = '".$_POST['Name']."', `Text` = '".$_POST['Text']."' WHERE ID = '".$id."'";
    $res=mysql_query($query); 
    echo "1";
?>