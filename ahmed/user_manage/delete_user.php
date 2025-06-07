<?php
include 'db_connection.php';  

if (isset($_GET['id'])) {
    $id = $_GET['id'];

     
    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_user.php");  
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
$conn->close();
?>
