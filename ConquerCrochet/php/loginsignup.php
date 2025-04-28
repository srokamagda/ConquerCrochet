<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login/Signup</title>

  <link rel="stylesheet" href="../css/generalcss.css" />
  <link rel="stylesheet" href="../css/loginsignup.css" />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
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
  <h1>Login/Signup</h1>
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

<div class="login-container">
  <h2>Log in</h2>
  <form id="login-form">
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Log in</button>
    <div id="login_response" style="color: red;"></div>
  </form>
  <span class="signup-link" onclick="openModal()">Don't have an account? Sign up!</span>
</div>

<div id="signupModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Sign Up</h2>
    <form id="signup-form">
      <input type="text" name="username" placeholder="Username" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Sign up</button>
      <div id="signup_response" style="color: red;"></div>
    </form>
  </div>
</div>

<script>
function openModal() {
  document.getElementById("signupModal").style.display = "block";
}
function closeModal() {
  document.getElementById("signupModal").style.display = "none";
}
window.onclick = function(event) {
  var modal = document.getElementById("signupModal");
  if (event.target == modal) {
    closeModal();
  }
}

document.getElementById('login-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch('login.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById('login_response').innerText = data.message;
    if (data.success) {
      window.location.href = 'index.php';
    }
  });
});

document.getElementById('signup-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch('signup.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById('signup_response').innerText = data.message;
    if (data.success) {
      closeModal();
    }
  });
});
</script>

<div class="footerbox">
  <footer>All rights reserved Conquer Crochet 2025</footer>
</div>

</body>
</html>
