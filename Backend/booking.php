<?php
$showError = false;
$server = "localhost";
$username = "root";
$password = "";
$database = "lessgo";
$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numPassengers = $_POST["numPassengers"];
    $pickupPoint = $_POST["pickupPoint"];
    $destination = $_POST["destination"];
    $preferredVehicleType = $_POST["preferredVehicleType"];
    $pickupTime = $_POST["pickupTime"];
    $specialRequirements = $_POST["specialRequirements"];
    $additionalServices = $_POST["additionalServices"];
    $paymentMethod = $_POST["paymentMethod"];
    $promoCode = isset($_POST["promoCode"]) ? $_POST["promoCode"] : null;

    if ($numPassengers > 0 && $numPassengers <= 7) {

        $query = "INSERT INTO `booking` (`numPassengers`, `pickupPoint`, `destination`, `preferredVehicleType`, `pickupTime`, `specialRequirements`, `additionalServices`, `paymentMethod`, `promoCode`) VALUES ('$numPassengers', '$pickupPoint', '$destination', '$preferredVehicleType', '$pickupTime', '$specialRequirements', '$additionalServices', '$paymentMethod', '$promoCode')";

        if (!empty($promoCode)) {
            $sql = "SELECT promocode FROM `promocode` WHERE promocode='$promoCode'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $num = mysqli_num_rows($result);
                if ($num == 1) {
                    
                    if (mysqli_query($con, $query)) {
                        echo "<script>alert('Booking Successful!');window.location.href = 'http://127.0.0.1:3000/index.html';</script>";
                    } else {
                        echo "Error: " . $query . "<br>" . mysqli_error($con);
                    }
                } else {
                    
                    echo "<script>alert('Booking unsuccessful! Invalid promocode used');window.location.href = 'http://127.0.0.1:3000/index.html';</script>";
                }
            } else {
                
                echo "<script>alert('Error checking promo code:');window.location.href='http://127.0.0.1:3000/booking.html';</script>" . mysqli_error($con);
            }
        } else {
            
            if (mysqli_query($con, $query)) {
                echo "<script>alert('Booking Successful!');window.location.href = 'http://127.0.0.1:3000/index.html';</script>";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($con);
            }
        }
        
    } else {
        echo "<script>alert('Invalid number of passengers. Please select a number between 1 and 8.');window.location.href='http://127.0.0.1:3000/booking.html';</script>";
    }
}
