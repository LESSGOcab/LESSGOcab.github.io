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
    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $value = "INSERT INTO `login` (`username`, `password`,`login_time`) VALUES ('$username', '$password',CURRENT_TIMESTAMP);";
        $insertResult = mysqli_query($con, $value); // Execute the INSERT query first

        if ($insertResult) { // Check if the INSERT was successful
            $sql = "SELECT * FROM `signup` WHERE fullname='$username' AND password='$password'";
            $result = mysqli_query($con, $sql); // Execute the SELECT query without the $value parameter

            if ($result) {
                $num = mysqli_num_rows($result);
                if ($num == 1) {
                    echo  "<script>alert('Welcome back! $username');window.location.href = 'http://127.0.0.1:5500/booking.html';</script>";
                } else {
                    $showError = "invalid credentials";
                    echo  "<script>alert('Invalid Credentials! Make Sure Your Password Is Correct');window.location.href = 'http://127.0.0.1:5500/login.html';</script>";
                }
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>
