<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your form processing code here

    $fullName = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    // Check if fields are not empty
    if ($fullName && $email && $password) {
        $conn = new mysqli("localhost", "root", "", "student_portal");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
if ($password !== $confirm) {
    echo "❌ Passwords do not match.";
    exit;
}
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO students (Full_Name, Email, password) 
                VALUES ('$fullName', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.html");
exit;
        } else {
            echo "❌ Error: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "❌ Please fill all fields.";
    }
} else {
    // If this page is accessed directly without POST data
    echo "❌ Invalid access.";
}
?>
