<?php
    include "config.php";
    $query = "SELECT ID FROM `templates` WHERE `Razdel` = '".$_POST['Section']."' AND `ID_Book` = '".$_POST['Book']."'";
    $res=mysql_query($query);
    $row = mysql_fetch_assoc($res);
    $id = $row['ID'];
    $query = "SELECT Razdel FROM `templates` WHERE `ID_Razdel` = '".$id."' AND `ID_Book` = '".$_POST['Book']."'";
    $res=mysql_query($query);
    if(mysql_num_rows($res) > 0)
    {
        $options = "";
        while($row = mysql_fetch_assoc($res))
        {
            $options .= "<li>".$row['Razdel']."</li>";
        }
        echo $options;
    }
?>