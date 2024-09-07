<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	$repassword = $_POST['repassword'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'event');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO signup(fname, lname, email, password,repassword) VALUES (?, ?, ?, ?,?)");

    if ($stmt) {
        $stmt->bind_param("sssss", $fname, $lname, $email, $password,$repassword);
        $execval = $stmt->execute();

        if ($execval) {
            echo "Signup successful!";
        } else {
            echo "Error executing query: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Preparation of statement failed: " . $conn->error;
    }

    $conn->close();
}
?>
