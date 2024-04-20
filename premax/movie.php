<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "moviebokingsystem";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and escape form inputs to prevent SQL injection
    $firstName = mysqli_real_escape_string($conn, $_POST['FirstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['LastName']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['Mobile']);
    $password = mysqli_real_escape_string($conn, $_POST['Password']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO arun (first_name, last_name, email, mobile, password) VALUES ('$firstName', '$lastName', '$email', '$mobile', '$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Signup successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
