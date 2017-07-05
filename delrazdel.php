<?php
    include "config.php";
    if(isset($_GET['razdel']))
    {
        $query = "SELECT * FROM `templates` WHERE `Razdel` = '".$_POST['Section']."' AND `ID_Book` = '".$_POST['Book']."'";
        $res=mysql_query($query);
        $row = mysql_fetch_assoc($res);
        $id = $row['ID'];
        $query = "DELETE FROM `templates` WHERE `ID_Razdel` = '".$id."' AND `ID_Book` = '".$_POST['Book']."'";
        mysql_query($query);
        $query = "DELETE FROM `templates` WHERE `Razdel` = '".$_POST['Section']."' AND `ID_Book` = '".$_POST['Book']."'";
        mysql_query($query); 
        echo "1";
    }
    if(isset($_GET['podrazdel']))
    {
        $query = "SELECT * FROM `templates` WHERE `Razdel` = '".$_POST['Section']."' AND `ID_Book` = '".$_POST['Book']."'";
        $res=mysql_query($query);
        $row = mysql_fetch_assoc($res);
        $id = $row['ID'];
        $query = "DELETE FROM `templates` WHERE `Razdel` = '".$_POST['Podrazdel']."' AND `ID_Razdel` = '".$id."' AND `ID_Book` = '".$_POST['Book']."'";
        mysql_query($query);
        echo "1";
    }
?>