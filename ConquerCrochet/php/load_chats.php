<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conquercrochet";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

$query = "SELECT msg_id, incoming_msg_id, outgoing_msg_id, msg, created_at FROM messages ORDER BY created_at ASC";
$result = $conn->query($query);

$chats = [];
while ($row = $result->fetch_assoc()) {
    $chats[] = $row;
}

echo json_encode($chats);

$conn->close();
?>
