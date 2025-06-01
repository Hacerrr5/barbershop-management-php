<?php
include("db_config.php");

$id = $_GET['id'];
$query = "DELETE FROM services WHERE id=$id";
if ($connection->query($query)) {
    echo "<script>alert('Service deleted successfully!'); window.location.href='service_list.php';</script>";
} else {
    echo "<script>alert('An error occurred while deleting the service.'); window.location.href='service_list.php';</script>";
}
?>