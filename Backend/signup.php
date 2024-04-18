<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "lessgo";

$con = mysqli_connect($server, $username, $password, $database);
if ($con) {

    echo "<br>";
}

if (isset($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['repassword'])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];

    $sql = "INSERT INTO `lessgo`.`signup`(fullname, email, phone, password, repassword) VALUES ('$fullname','$email','$phone','$password','$repassword')";

    
    if ($password == $repassword) {
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('New Account Created!');window.location.href = 'http://127.0.0.1:3000/index.html';</script>";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "<script>alert('Password Do Not Match');window.location.href = 'http://127.0.0.1:3000/signup.html';</script>";
    }
}
?>
