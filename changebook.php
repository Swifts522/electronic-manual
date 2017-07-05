<?php
    include "config.php";
    $query = "SELECT * FROM `templates` WHERE `ID_Razdel` = '0' AND `ID_Book` = '".$_POST['Book']."'";
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