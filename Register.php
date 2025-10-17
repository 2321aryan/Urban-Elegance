//register backend

<?php
session_start();
include "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role  = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $pass, $role);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful. Please login.";
        header("Location: login.html");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
