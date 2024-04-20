<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moviebokingsystem";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare SQL statement to select tickets
$sql = "SELECT * FROM tickets";
$result = mysqli_query($conn, $sql);

// Check if there are any tickets
if ($result && mysqli_num_rows($result) > 0) {
    // Output data of each row
    echo "<h2>View Tickets</h2>";
    echo "<table id='ticketTable' border='1'>";
    echo "<tr><th>Movie</th><th>Quantity</th><th>Name</th><th>Email</th><th>Action</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr id='ticket_" . $row["id"] . "'>";
        echo "<td>" . $row["movie"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        // Add a cancel button for each ticket
        echo "<td>";
        echo "<form id='cancelForm_" . $row["id"] . "' action='ticketscancel.php' method='post'>";
        echo "<input type='hidden' name='ticket_id' value='" . $row["id"] . "'>"; // Hidden input for ticket ID
        echo "<button type='button' onclick='cancelTicket(" . $row["id"] . ")'>Cancel</button>";
        echo "<span id='cancelMessage_" . $row["id"] . "' style='display:none;'>Cancelled successfully!</span>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No tickets found.";
}

// Close connection
mysqli_close($conn);
?>

<script>
function cancelTicket(ticketId) {
    // Make an AJAX request to cancel the ticket
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ticketscancel.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Show cancellation message
              alert('Ticket canceled successfully.')
                // Remove the ticket row from the table after a delay
                setTimeout(function() {
                    var ticketRow = document.getElementById("ticket_" + ticketId);
                    if (ticketRow) {
                        ticketRow.remove();
                    }
                }, 2000); // Delay in milliseconds before removing the row
            } else {
                console.error("Failed to cancel ticket.");
            }
        }
    };
    xhr.send("ticket_id=" + ticketId);
}
</script>
