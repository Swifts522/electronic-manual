<?php
    include "config.php";
    $query = "SELECT * FROM `templates` WHERE `Razdel` = '".$_POST['Section']."' AND `ID_Book` = '".$_POST['Book']."'";
    $res=mysql_query($query);
    $row = mysql_fetch_assoc($res);
    echo $row['Text'];
?>