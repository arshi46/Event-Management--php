
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $eventType = $_POST['eventType'];
    $venue = $_POST['venue'];
    $experience = $_POST['experience'];
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'event');

    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, eventType, venue, experience, message) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $eventType, $venue, $experience, $message);
        $execval = $stmt->execute();

        if ($execval === false) {
            echo "Error: " . $stmt->error;
        } else {
            echo "Feedback submitted successfully!";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
