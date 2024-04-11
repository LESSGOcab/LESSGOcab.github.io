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
    // Assuming your form fields are named appropriately, adjust if needed
    $numPassengers = $_POST["numPassengers"];
    $pickupPoint = $_POST["pickupPoint"];
    $destination = $_POST["destination"];
    $preferredVehicleType = $_POST["preferredVehicleType"];
    $pickupTime = $_POST["pickupTime"];
    $specialRequirements = $_POST["specialRequirements"];
    $additionalServices = $_POST["additionalServices"];
    $paymentMethod = $_POST["paymentMethod"];
    $promoCode = isset($_POST["promoCode"]) ? $_POST["promoCode"] : null;

    // Inserting the data into the database
    $query = "INSERT INTO `booking` (`numPassengers`, `pickupPoint`, `destination`, `preferredVehicleType`, `pickupTime`, `specialRequirements`, `additionalServices`, `paymentMethod`, `promoCode`) VALUES ('$numPassengers', '$pickupPoint', '$destination', '$preferredVehicleType', '$pickupTime', '$specialRequirements', '$additionalServices', '$paymentMethod', '$promoCode')";

    if (mysqli_query($con, $query)) {
        echo "Booking successful!";
        if (!empty($promoCode)) {
            $sql = "SELECT promocode FROM `promocode` WHERE promocode='$promoCode'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $num = mysqli_num_rows($result);
                if ($num == 1) {
                    echo " Valid promo code.";
                } else {
                    echo " Invalid promo code.";
                    // If invalid promo code, you might want to remove the inserted booking, depending on your logic
                    $deleteQuery = "DELETE FROM `booking` WHERE promoCode='$promoCode'";
                    mysqli_query($con, $deleteQuery);
                }
            } else {
                echo "Error checking promo code: " . mysqli_error($con);
            }
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}
