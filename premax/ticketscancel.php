<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ticket_id"])) {
    $ticket_id = $_POST["ticket_id"];
    
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "moviebokingsystem";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM tickets WHERE id = $ticket_id";
    if (mysqli_query($conn, $sql)) {
        echo "Ticket canceled successfully.";
    } else {
        echo "Error canceling ticket: " . mysqli_error($conn);
    }
// After successful cancellation
echo "<script>alert('Ticket canceled successfully.');</script>";

    mysqli_close($conn);
}
?>
