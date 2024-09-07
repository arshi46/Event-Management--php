<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'event';

    $fullname = $_POST['firstname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $expmonth = $_POST['expmonth'];
    $expyear = $_POST['expyear'];
    $cvv = $_POST['cvv'];
    $conn = new mysqli('localhost', 'root', '', 'event');
    
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO pay(firstname, email, address, city, state, zip, cardname, cardnumber, expmonth, expyear, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssi", $fullname, $email, $address, $city, $state, $zip, $cardname, $cardnumber, $expmonth, $expyear, $cvv);
        $execval = $stmt->execute();

        if ($execval) {
            echo "Payment successful!";
        } else {
            echo "Payment failed.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
