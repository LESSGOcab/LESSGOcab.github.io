<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "lessgo"; // Replace 'your_database_name' with the name of your database
// Create connection
$con = mysqli_connect($server, $username, $password, $database);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
// Retrieve form data using $_POST superglobal
if(isset($_POST['name'], $_POST['email'], $_POST['message'])){
    $Name = $_POST['name']; 
    $Email = $_POST['email']; 
    $Message = $_POST['message']; 
    // INSERT INTO `contactus` (`Name`, `Email`, `Message`) VALUES ('user1', 'abc@gmail.com', 'hi');
    // Insert data into database
    $sql = "INSERT INTO `lessgo`.`contactus` (`Name`, `Email`, `Message`) VALUES ('$Name', '$Email', '$Message')";

    // Execute SQL query
    if (mysqli_query($con, $sql)) {
        // Output JavaScript alert message with redirection
        echo "<script>alert('ThankYou! Our Team Will Contact You Soon!');window.location.href = 'http://127.0.0.1:3000/index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
        // Close database connection
    mysqli_close($con);
}
else{
    echo "Form data not received.";
}
?>
