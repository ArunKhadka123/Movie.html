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

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and escape form inputs to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // SQL query to fetch password based on email
    $sql = "SELECT password FROM arun WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Check if user exists
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['password'];

            // Verify entered password with stored password
            if ($password === $storedPassword) {
                echo "Login successful";
                // Redirect to dashboard or any other page after successful login
                // header("Location: dashboard.php");
                // exit();
            } else {
                echo "Invalid password";
            }
        } else {
            echo "User not found for email: $email";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

// Close the database connection
$conn->close();
?>
