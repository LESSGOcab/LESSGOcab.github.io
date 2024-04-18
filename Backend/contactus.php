<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "lessgo"; 

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['name'], $_POST['email'], $_POST['message'])){
    $Name = $_POST['name']; 
    $Email = $_POST['email']; 
    $Message = $_POST['message']; 
    // INSERT INTO `contactus` (`Name`, `Email`, `Message`) VALUES ('user1', 'abc@gmail.com', 'hi');
    // Insert data into database
    $sql = "INSERT INTO `lessgo`.`contactus` (`Name`, `Email`, `Message`) VALUES ('$Name', '$Email', '$Message')";


    if (mysqli_query($con, $sql)) {

        echo "<script>alert('ThankYou! Our Team Will Contact You Soon!');window.location.href = 'http://127.0.0.1:3000/index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
else{
    echo "Form data not received.";
}
?>
