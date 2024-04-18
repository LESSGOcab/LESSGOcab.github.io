<?php

$server = "localhost";
$username = "root"; 
$password = ""; 
$database = "lessgo";

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "Connected successfully"."<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pickup = $_POST['pickup_location']; 
    $destination = $_POST['destination_location']; 


    if($pickup!=$destination){
    $sql = "SELECT r.ride_type_name AS ride_type, v.vehicle_type_name AS vehicle_type, f.fare_amount AS fare
            FROM fare f
            INNER JOIN ridetype r ON f.ride_type_id = r.ride_type_id
            INNER JOIN vehicletype v ON f.vehicle_type_id = v.vehicle_type_id
            WHERE f.pickup_location_id = (SELECT location_id FROM location WHERE location_name = '$pickup')
            AND f.destination_location_id = (SELECT location_id FROM location WHERE location_name = '$destination')";
    }
    else{
        echo "The pickup location and destination location are same!";
    }


    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
   
        echo "<table style='border: 2px solid black; border-collapse: collapse;'>
                <tr>
                    <th style='border: 2px solid black; padding: 8px;'>Ride Type</th>
                    <th style='border: 2px solid black; padding: 8px;'>Vehicle Type</th>
                    <th style='border: 2px solid black; padding: 8px;'>Fare</th>
                </tr>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                    <td style='border: 2px solid black; padding: 8px;'>".$row['ride_type']."</td>
                    <td style='border: 2px solid black; padding: 8px;'>".$row['vehicle_type']."</td>
                    <td style='border: 2px solid black; padding: 8px;'>".$row['fare']."</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No fares found for the specified pickup and destination.";
    }
}
?>
