
<?php
session_start();
$userLoggedIn = isset($_SESSION['user_id']);
$loggedInUserId = $userLoggedIn ? $_SESSION['user_id'] : null;
$isLoggedIn = isset($_SESSION['user_id']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chat Room</title>
  
  <link rel="stylesheet" href="../css/generalcss.css">
  <link rel="stylesheet" href="../css/chatroom.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
  
  
</head>
<body>

<header>
  <img src="../images/ConquerCrochetLogo.gif" class="animated-logo">
  <h1>Chat Room</h1>
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

<section class="chat-container">
  <div class="chat-box" id="chat-box">
  </div>

  <?php if ($userLoggedIn): ?>
    <form class="chat-input" id="chatForm">
      <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($loggedInUserId); ?>">
      <input type="text" name="message" placeholder="Type a message..." required>
      <button type="submit">Send</button>
    </form>
  <?php else: ?>
    <button class="login-button" onclick="showLoginModal()">Log in to join the chat</button>
  <?php endif; ?>
</section>

<div id="loginModal">
  <div id="loginModalContent">
    <h2>Please Log In or Sign Up</h2>
    <p>You must be logged in to send a message.</p>
    <a href="loginsignup.php"><button>Login / Sign Up</button></a>
    <button onclick="closeLoginModal()">Cancel</button>
  </div>
</div>

<div class="footerbox">
  <footer>All rights reserved Conquer Crochet 2025</footer>
</div>

<script>
function showLoginModal() {
  document.getElementById("loginModal").style.display = "flex";
}

function closeLoginModal() {
  document.getElementById("loginModal").style.display = "none";
}

function loadChats() {
  fetch('load_chats.php')
    .then(res => res.json())
    .then(data => {
      const chatBox = document.getElementById('chat-box');
      chatBox.innerHTML = '';
      if (!data.length) {
        chatBox.textContent = 'No chats yet.';
        return;
      }
      
      data.forEach(chat => {
        const div = document.createElement('div');
        div.className = 'message ' + (chat.outgoing_msg_id == <?php echo json_encode($loggedInUserId); ?> ? 'own-message' : 'other-message');
        div.innerHTML = `<p>${chat.msg}</p><small>${chat.created_at}</small>`;
        chatBox.appendChild(div);
      });
      chatBox.scrollTop = chatBox.scrollHeight;
    })
    .catch(error => {
      console.error("Error loading chats:", error);
      document.getElementById('chat-box').textContent = "Failed to load chats.";
    });
}

<?php if ($userLoggedIn): ?>
document.getElementById('chatForm').addEventListener('submit', function (e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch('submit_chat.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      loadChats();
      document.getElementById('chatForm').reset();
    } else {
      alert(data.message || "Failed to send chat.");
    }
  })
  .catch(error => {
    console.error("Error submitting chat:", error);
    alert("Something went wrong.");
  });
});
<?php endif; ?>

document.addEventListener('DOMContentLoaded', function () {
  loadChats();
});
</script>


</body>
</html>
