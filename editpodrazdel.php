<?php
    include "config.php";
    $query = "SELECT Text FROM `templates` WHERE `Razdel` = '".$_POST['Section']."' AND `ID_Razdel` > 0 AND `ID_Book` = '".$_POST['Book']."'";
    $res=mysql_query($query);
    $row = mysql_fetch_assoc($res);
    echo $row['Text'];
?>