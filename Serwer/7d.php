<?php
	$godz = '';
	$temp = '';
	$humi = '';
	$press = '';
	$rain = '';

$conn = new mysqli(localhost, user1, password, arduino);
$data = new DateTime();
$data->sub(new DateInterval(P7D));
$data = $data->format('Y-m-d H:m:s');
$sql = "SELECT * FROM odczyty WHERE date >='$data'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) 
{
	echo $row["id"]." ";
	$godz=$godz.'"'.$row["date"].'",';
	$temp=$temp.$row["temperature"].",";
	$humi=$humi.$row["humidity"].",";
	$press=$press.$row["pressure"].",";
	if($row['rain']>700)
	{
		$rain=$rain."0,";
	}else if($row['rain']>500)
	{
		$rain=$rain."1,";
	}else{
		$rain=$rain."2,";
	}
}

$conn->close();
?>

<!DOCTYPE HTML>

<html lang="pl">

	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name=”author” content=”Dominik Domek” />
		
		<link rel="stylesheet" href="css/style.css" type="text/css" />	
		<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
		
		<script src="js/kafelki.js"></script>
		<script>
			var godz = ["x", <?php echo $godz; ?>]
			var temp = ["Temperatura", <?php echo $temp; ?>];
			var humi = ["Wilgotność", <?php echo $humi; ?>];
			var press = ["Ciśnienie", <?php echo $press; ?>];
			var rain = ["Opady", <?php echo $rain; ?>];
		</script>
		
		<!-- Load D3.js -->
		<script src="https://d3js.org/d3.v4.min.js"></script>
		<!-- Load billboard.js with style -->
		<script src="js/billboard.js"></script>
		<link rel="stylesheet" href="css/billboard.css">
		
		<title>Arduino weather station</title>
	</head>

	<body>	
		<div id="site">
			<div id="logo">Witaj w panelu stacji pogodowej</div><div id="clock"></div><div class="cb"></div>
			
			<div id="dash">
			
				<div class="title">Temperatura i wilgotność</div>
				<div id="chart" style="width: 800px;margin-left: auto; margin-right: auto;"></div>
				<div class="title">Ciśnienie</div>
				<div id="chart2" style="width: 800px;margin-left: auto; margin-right: auto;"></div>
				<div class="title">Opady</div>
				<div id="chart3" style="width: 800px;margin-left: auto; margin-right: auto;"></div>
				<script src="js/wykresy.js"></script>
				<a href=index.php><div class=rectangle>Powrót</div></a>
				
			</div>
			<a href="https://github.com/ChuZZZta/WeatherStationArduino"><div id="footer">Strona stworzona przez Dominika Domka w ramach pracy licencjackiej. Kliknij aby przejść do serwisu github</div></a>
		</div>
	</body>
	
</html>