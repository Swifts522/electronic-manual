<?php
    $query = "SELECT * FROM group WHERE FacultyID = '.$_POST['faculty'].'";
    $res=mysql_query($query);
    while($row = mysql_fetch_assoc($res))
    {
        echo "<option value='".$row['ID']."'>".$row['Group']."</option>";
    }
?>