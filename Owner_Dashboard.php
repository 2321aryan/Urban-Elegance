//Owner Dashboard

<?php
session_start();
if ($_SESSION['role'] != 'owner') {
    header("Location: login.html");
    exit;
}
echo "<h1>Welcome Owner!</h1>";
echo "<a href='logout.php'>Logout</a>";
?>
