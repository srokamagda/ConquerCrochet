<?php
session_start();
$total = 0;
$isLoggedIn = isset($_SESSION['user_id']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/generalcss.css">
    <link rel="stylesheet" href="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="../css/cart.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
        <h1>Cart</h1>
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
    <main class="shopping-cart-container" style="padding: 30px;">
    <h2>Your Shopping Cart</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="cart-items">
            <?php foreach ($_SESSION['cart'] as $id => $item): 
                $itemTotal = $item['price'] * $item['quantity'];
                $total += $itemTotal;
            ?>
                <div class="cart-item" style="border-bottom: 1px solid #ccc; padding: 10px 0;">
                    <?php if (!empty($item['image'])): ?>
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 100px; height: auto;">
                    <?php endif; ?>
                    <p><strong><?= htmlspecialchars($item['name']) ?></strong></p>
                    <p>Price: €<?= number_format($item['price'], 2) ?></p>
                    <p>Quantity: <?= $item['quantity'] ?></p>
                    <p>Total: €<?= number_format($itemTotal, 2) ?></p>
                    <a href="update_cart.php?action=remove&id=<?= urlencode($id) ?>"><button>Remove</button></a>
                </div>
            <?php endforeach; ?>

            <div class="cart-total" style="margin-top: 20px;">
                <strong>Total: €<?= number_format($total, 2) ?></strong>
            </div>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</main>

   
    <div class="footerbox">
    <footer>All rights reserved Conquer Crochet 2025</footer>
    </div>
</body>

</html>
