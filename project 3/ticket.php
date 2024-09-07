
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $area = $_POST['area'];
    $starttime = $_POST['start-time'];
    $endtime = $_POST['end-time'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $ntickets = $_POST['num-tickets'];

    $conn = new mysqli('localhost', 'root', '', 'event');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO ticket(username, area, starttime, endtime, email, phone, ntickets) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $username, $area, $starttime, $endtime, $email, $phone, $ntickets);
        $execval = $stmt->execute();
        
        if ($execval) {
            echo "TICKET-BOOKING successful!";
        } else {
            echo "TICKET-BOOKING failed.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
