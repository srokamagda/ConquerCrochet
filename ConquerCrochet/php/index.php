<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/generalcss.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
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
        <h1>Home</h1>
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

    <section class="about-section">
        <div class="about-text">
            <h2>About</h2>
            <p>
                Hello and Welcome to our website! I built Conquer Crochet because we wanted a space where crochet learners 
                felt they could gather to learn the art together. My mom has been crocheting for years and I myself have
                wanted to learn for quite a while. I decided to build a website where you can buy items, make items, share designs,
                and communicate with other people who are trying to learn it as well as I would find that handy myself.<br>
                Thank you and enjoy your time on our website!
            </p>
        </div>
        <div class="image-container">
            <img src="../images/gnome1.png" alt="Gnome Image">
        </div>
    </section>

    <section class="video-section">
        <div class="video-container">
            <video controls>
                <source src="../videos/VideoCC.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>

    <div class="footerbox">
        <footer>All rights reserved Conquer Crochet 2025</footer>
    </div>

</body>
</html>
