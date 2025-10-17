//tenant Dashboard

<?php
session_start();
if ($_SESSION['role'] != 'tenant') {
    header("Location: login.html");
    exit;
}
echo "<h1>Welcome Tenant!</h1>";
echo "<a href='logout.php'>Logout</a>";
?>
