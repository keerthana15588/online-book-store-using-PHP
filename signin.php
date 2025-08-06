<?php
// Assuming your database credentials
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the username and password match
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, do something (e.g., set session variables)
        session_start();
        $_SESSION['username'] = $username;
        echo "Login successful. Redirecting...";
        // Redirect to a logged-in page
        header("Location: dashboard.php");
        exit();
    } else {
        // Incorrect username or password
        echo "Invalid username or password";
    }
}

$conn->close();
?>
