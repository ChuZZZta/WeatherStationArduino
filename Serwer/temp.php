 <?php
$conn = new mysqli(localhost, user1, password, arduino);
$sql = "SELECT * FROM odczyty";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Temperature</th><th>Pressure</th><th>Altitude</th><th>Rain</th><th>Humidity</th><th>Date</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["temperature"]."</td><td>".$row["pressure"]."</td><td>".$row["altitude"]."</td><td>".$row["rain"]."</td><td>".$row["humidity"]."</td><td>".$row["date"]."</td><td>".$row[""]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}



echo "<br><br><br><br>";


$data = new DateTime();
$data->sub(new DateInterval(P1D));
$data = $data->format('Y-m-d H:m:s');
$sql = "SELECT * FROM odczyty WHERE date >='$data'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) 
{
echo " ".$row["date"];
}
echo "<br><br><br>".$data;

$conn->close();
?> 