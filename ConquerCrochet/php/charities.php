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

$sql = "SELECT * FROM charities";
$result = $conn->query($sql);

$total = $result ? $result->num_rows : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Charities</title>
  <link rel="stylesheet" href="../css/generalcss.css">
  <link rel="stylesheet" href="../css/charities.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
</head>
<body>

  <header>
    <img src="../images/ConquerCrochetLogo.gif" class="animated-logo" />
    <h1>Charities</h1>
    <div class="icons">
      <a href="cart.php"><img src="../images/womanwithcart.png" alt="Cart" /></a> 
      
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
    <img src="../images/bowwebpage.png" alt="Pink Bow" class="bow" /> 
  </nav>

  <?php
  if ($result && $result->num_rows > 0):
    $index = 0;
    while($row = $result->fetch_assoc()):
    
      $imgClass = ($index === 0 || $index >= $total - 1) ? "charity-image-cover" : "charity-image-contain";
  ?>
    <section class="design-section <?= $index % 2 === 0 ? '' : 'reverse' ?>">
      <div class="instructions">
        <h2><?= htmlspecialchars($row['name']) ?></h2>
        <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
        <a class="donate-button" href="<?= htmlspecialchars($row['link']) ?>" target="_blank">Donate Now</a>
      </div>
      <div class="charity-image-container">
        <img class="charity-image <?= $imgClass ?>" src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" />
      </div>
    </section>
  <?php
      $index++;
    endwhile;
  else:
  ?>
    <p style="text-align: center; padding: 30px;">No charities found at the moment.</p>
  <?php endif; ?>

  <div class="footerbox">
    <footer>All rights reserved Conquer Crochet 2025</footer>
  </div>

</body>
</html>

<?php $conn->close(); ?>
