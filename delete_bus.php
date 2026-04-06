<?php
include 'db.php'; // Database connection

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM buses WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Bus deleted successfully'); window.location.href='manage_buses.php';</script>";
    } else {
        echo "Error deleting bus: " . mysqli_error($conn);
    }
}
?>