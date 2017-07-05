<?php
    include "config.php";
    $query = "SELECT * FROM `group` WHERE `FacultyID` = ".$_POST['faculty'];
    $res=mysql_query($query);
    $options = "";
    while($row = mysql_fetch_assoc($res))
    {
        $options .= "<option value='".$row['ID']."'>".$row['Group']."</option>";
    }
    echo $options;
?>