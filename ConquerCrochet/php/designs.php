<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conquercrochet";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Designs</title>
  <link rel="stylesheet" href="../css/generalcss.css">
  <link rel="stylesheet" href="../css/design.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100..900&display=swap" rel="stylesheet">
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
</head>
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-18YM8QY7XE"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-18YM8QY7XE');
</script>
<body>

  <header>
    <img src="../images/ConquerCrochetLogo.gif" class="animated-logo">
    <h1>Designs</h1>
    <div class="icons">
      <a href="cart.php"><img src="../images/womanwithcart.png" alt="Cart"></a> 
      
      <div class="user-dropdown">
      <img src="../images/3dusericon.png" alt="User" class="user-icon-img">
      <div class="user-dropdown-content">
        <?php if ($isLoggedIn): ?>
          <a href="logout.php">Log Out</a>
        <?php else: ?>
          <a href="loginsignup.php">Log In / Sign Up</a>
        <?php endif; ?>
      </div>
    </div>

    </div>
  </header>

  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="designs.php">Designs</a></li>
      <li><a href="chatroom.php">Chat Room</a></li>
      <li><a href="charities.php">Charities</a></li>
      <li><a href="shop.php">Shop</a></li>
    </ul>
    <img src="../images/bowwebpage.png" alt="Pink Bow" class="bow"> 
  </nav>

  <div class="container">
  <?php
  $sql = "SELECT design_id, name, pattern, difficulty_level, image_url FROM designs";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '
      <div class="card">
        <div class="img-container">
          <img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">
        </div>
        <div class="card-details">
          <h2>' . htmlspecialchars($row['name']) . '</h2>
          <p>Difficulty: ' . htmlspecialchars($row['difficulty_level']) . '</p>
          <p>' . nl2br(htmlspecialchars($row['pattern'])) . '</p>
        </div>
      </div>';
    }
  } else {
    echo '<p style="text-align:center; width:100%;">No designs found in the database.</p>';
  }

  $conn->close();
  ?>
</div>

  <div class="footerbox">
    <footer>All rights reserved Conquer Crochet 2025</footer>
  </div>

</body>
</html>
