<?php
require_once("functions.php");
$dblink=db_connect("contact_data");
$sql="Select `first_name`,`last_name`,`email`,`phone_number`,`user_name`,`password`,`comments` from `contact_info`";
$result=$dblink->query($sql) or
	die("<h2>Something went wrong with: <br>$sql</h2>".$dblink->error);
while ($data=$result->fetch_array(MYSQLI_ASSOC)){
	echo '<tr>';
	echo '<td style="color: black;">'.$data['first_name'].'</td>';
	echo '<td style="color: black;">'.$data['last_name'].'</td>';
	echo '<td style="color: black;">'.$data['email'].'</td>';
	echo '<td style="color: black;">'.$data['phone_number'].'</td>';
	echo '<td style="color: black;">'.$data['user_name'].'</td>';
	echo '<td style="color: black;">'.$data['password'].'</td>';
	echo '<td style="color: black;">'.$data['comments'].'</td>';
	echo '</tr>';
}
?>