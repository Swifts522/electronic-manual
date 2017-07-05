<?php
    include "config.php";
    $query = "SELECT * FROM `book`";
    $res=mysql_query($query);
    if(mysql_num_rows($res) > 0)
    {
        $options = "";
        $group = array();
        while($row = mysql_fetch_assoc($res))
        {
            $group = explode(',', $row['Group']);
            foreach ($group as $groupid) 
            {
                if($groupid == $_POST['group'])
                {
                    $options .= "<a class = 'hrefview' href = 'cviewbook.php?book=".$row['ID']."'><div class = 'bookview'>
                         <div id='bookimg'></div>   
                         <div id='titlebook'>".$row['Name']."</div>
                        </div></a>"; 
                }
            }
        }
        echo $options;
    }
?>