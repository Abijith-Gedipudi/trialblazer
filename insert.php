<?php
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "prn";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sugg = $_POST['suggestion'];
    $feedback = $_POST['feedback'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (Name, Email, Feedback, Suggestion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $feedback, $sugg);
    
    if ($stmt->execute()) {
        // Success message and redirect
        echo"submitted successfully";
    } else {
        // Error message
        echo "Error submitting feedback. Please try again.";
    }
    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
