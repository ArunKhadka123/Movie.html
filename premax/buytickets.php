<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $movie = $_POST["movie"];
    $quantity = $_POST["quantity"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    
    // Database connection details
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "moviebokingsystem"; // C
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO tickets (movie, quantity, name, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $movie, $quantity, $name, $email);
    
    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        echo "Tickets Bought successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close connection
    $stmt->close();
    $conn->close();
}
?>
