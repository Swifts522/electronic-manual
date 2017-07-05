<?php

# include data base

//echo '<select size="1" name="group"">';
//$rows = $DB->select('SELECT * FROM group WHERE FacultyID = '+$_POST['id_country']);
//foreach ($rows as $numRow => $row) 
//{
	//echo '<option value="'.$row['ID'].'">'.$row['Group'].'</option>';
//};
//echo '</select>';

echo '<select size="1" name="group">';
$query = "SELECT * FROM group WHERE FacultyID = ".$_POST['id_country']."";
$res=mysql_query($query);
while($row = mysql_fetch_assoc($res))
{
	echo "<option value='".$row['ID']."'>".$row['Faculty']."</option>";
}     
echo '</select>';

?>