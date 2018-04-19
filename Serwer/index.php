<?php

	$read = file_get_contents('http://192.168.56.102');
	$json = json_decode($read);
	$a = $json->{'a'};
	$b = $json->{'b'};
	$c = $json->{'c'};
	$d = $json->{'d'};
	$conn = new mysqli("localhost","user1","password","arduino");
	$sql = "INSERT INTO odczyty (a,b,c,d) VALUES (".$a.",".$b.",".$c.",".$d.")";
	$conn->query($sql);

?>
