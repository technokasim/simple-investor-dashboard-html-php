<?php
require 'db.php';

$conn = new mysqli($host, $username, $password, $database);

$query = "SELECT * FROM investor";
$result = mysqli_query($conn, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
