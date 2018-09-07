 <?php
$conn = new mysqli(localhost, user1, password, arduino);
$sql = "SELECT * FROM odczyty";
$result = $conn->query($sql);
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
		
		<script>var odczyt = [25,33,996,1000];</script>
		<script src="js/kafelki.js"></script>
		
		<title>Arduino weather station</title>
	</head>

	<body>	
		<div id="site">
			<div id="logo">Witaj w panelu stacji pogodowej</div><div id="clock"></div><div class="cb"></div>
			
			<div id="dash">
				
				<div id="arch">
					<?php
						if ($result->num_rows > 0) 
						{
						    echo "<table><tr><th>ID</th><th>Temperature</th><th>Pressure</th><th>Altitude</th><th>Rain</th><th>Humidity</th><th>Date</th></tr>";
						    while($row = $result->fetch_assoc()) {
							echo "<tr><td>".$row["id"]."</td><td>".$row["temperature"]."</td><td>".$row["pressure"]."</td><td>".$row["altitude"]."</td><td>".$row["rain"]."</td><td>".$row["humidity"]."</td><td>".$row["date"]."</td><td>".$row[""]."</td></tr>";
						    }
						    echo "</table>";
						} else {
						    echo "0 results";
						}
					?>
				</div>
				
				<a href=index.php><div class=rectangle>Powrót</div></a>	
			</div>
			<a href="https://github.com/ChuZZZta/WeatherStationArduino"><div id="footer">Strona stworzona przez Dominika Domka w ramach pracy licencjackiej. Kliknij aby przejść do serwisu github</div></a>
		</div>
	</body>
	
</html>