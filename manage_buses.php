<?php
include 'db.php';
session_start(); // Agar tum login session use kar rahi ho

// Bus list fetch karo
$result = mysqli_query($conn, "SELECT * FROM buses");
?>
<h2>Manage Buses</h2>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Bus Name</th>
        <th>Route</th>
        <th>Fare (₹)</th>
        <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['bus_name']; ?></td>
            <td><?php echo ucfirst($row['source']) . " → " . ucfirst($row['destination']); ?></td>
            <td><?php echo "₹" . number_format($row['fare'], 2); ?></td>
            <td>
                <a href="delete_bus.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this bus?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>