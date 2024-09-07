<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    $event = $_POST['event'];
    $venue = $_POST['venue'];
    $cost = $_POST['cost'];
    $date = $_POST['date'];
    
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'event');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO register(name, email, address, eventtype, venue, cost, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $address, $event, $venue, $cost, $date);
        $execval = $stmt->execute();
        
        if ($execval) {
            echo "Registration successful!";
        } else {
            echo "Registration failed.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
