<?php

	$fp = fopen("http://192.168.0.200", "rb");
	if (FALSE === $fp) {
    		exit("Failed to open stream to URL");
	}

	$result = '';

	while (!feof($fp)) 
	{
	    	$result .= fread($fp, 8192);
	}
	fclose($fp);

	$json = json_decode($result);
	$conn = new mysqli("localhost","user1","password","arduino");
	$sql = "INSERT INTO odczyty (temperature,pressure,altitude,rain,humidity) VALUES (".$json->{'temp'}.",".$json->{'press'}.",".$json->{'altit'}.",".$json->{'rain'}.",".$json->{'humidi'}.")";
	$conn->query($sql);

?>
