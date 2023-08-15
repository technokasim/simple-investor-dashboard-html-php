<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'signout') {
    session_unset();
    session_destroy();

    header('Content-Type: application/json');
    echo json_encode(array('success' => true));
} else {
 
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'error' => 'Invalid action.'));
}
?>
