<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conquercrochet";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $inputUsername = $_POST['username'];
  $inputPassword = $_POST['password'];

  $stmt = $conn->prepare("SELECT user_id, username, password_hash FROM Users WHERE username = ?");
  $stmt->bind_param("s", $inputUsername);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($inputPassword, $user['password_hash'])) {
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['username'] = $user['username'];
      echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
      echo json_encode(['success' => false, 'message' => 'Invalid password']);
    }
  } else {
    echo json_encode(['success' => false, 'message' => 'User not found']);
  }

  $stmt->close();
}
$conn->close();
?>
