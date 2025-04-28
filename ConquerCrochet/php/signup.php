<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conquercrochet";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
  }

  if (!preg_match('/^\w{3,20}$/', $username)) {
    echo json_encode(['success' => false, 'message' => 'Username must be 3-20 characters and only contain letters, numbers, or underscores.']);
    exit;
  }

  if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', $password)) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters and include a number.']);
    exit;
  }

  $checkUser = $conn->prepare("SELECT * FROM Users WHERE username = ?");
  $checkUser->bind_param("s", $username);
  $checkUser->execute();
  $result = $checkUser->get_result();

  if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Username already exists']);
  } else {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO Users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $passwordHash);
    if ($stmt->execute()) {
      echo json_encode(['success' => true, 'message' => 'User registered successfully']);
    } else {
      echo json_encode(['success' => false, 'message' => 'Error registering user']);
    }
    $stmt->close();
  }
  $checkUser->close();
}
$conn->close();
?>
