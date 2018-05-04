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
	$js = $json->{'temp'}.",".$json->{'humidi'}.",".$json->{'press'}.",".$json->{'rain'};

?>
<!DOCTYPE HTML>

<html lang="pl">

	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name=”author” content=”Dominik Domek” />
		
		<link rel="stylesheet" href="style.css" type="text/css" />	
		<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
		
		<script>var odczyt = [<?php echo $js; ?>];</script>
		<script src="skrypt.js"></script>

		<title>Arduino weather station</title>
	</head>

	<body onload="onLoad();">	
		<div id="site">
			<div id="logo">Witaj w panelu stacji pogodowej</div><div id="clock"></div><div class="cb"></div>
			
			<div id="dash">
				<div id="section1">
					<div class="squere" id="temp">temp</div>
					<div class="squere" id="humi">wilgotnosc</div>
					<div class="cb"></div>
					<div class="squere" id="press">ciśnienie</div>
					<div class="squere" id="rain">opady</div>
					<div class="cb"></div>
				</div>
				<div id="section2">
					<a href="24h.php"><div class="rectangle">Zobacz historie pomiarów sprzed 24h</div></a>
					<a href="7d.php"><div class="rectangle">Zobacz historie pomiarów sprzed tygodnia</div></a>
					<a href="arch.php"><div class="rectangle">Zobacz archiwum</div></a>
				</div>
				<div class="cb"></div>
			</div>
			<a href="https://github.com/ChuZZZta/WeatherStationArduino"><div id="footer">Strona stworzona przez Dominika Domka w ramach pracy licencjackiej. Kliknij aby przejść do serwisu github</div></a>
		</div>
	</body>
	
</html>