<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="../css/generalcss.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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
        <h1>Shop</h1>
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

    <section class="shop-container">
        <div id="cart-message" style="margin: 20px 0; color: green;"></div>

        <div class="products">
            <?php
            $conn = new mysqli("conquercrochet", "root", "", "conquercrochet");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT product_id, name, price, image_url FROM Shop";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>
                            <img src='" . $row['image_url'] . "' alt='Item'>
                            <p>" . htmlspecialchars($row['name']) . "</p>
                            <p class='price'>€" . number_format($row['price'], 2) . "</p>
                            <button class='add-to-cart' data-id='" . $row['product_id'] . "'>Add to Cart</button>
                        </div>";
                }
            } else {
                echo "<p>No products available.</p>";
            }
            $conn->close();
            ?>
        </div>
    </section>

    <div class="footerbox">
        <footer>All rights reserved Conquer Crochet 2025</footer>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".add-to-cart").forEach(button => {
            button.addEventListener("click", function () {
                const id = this.dataset.id;
                const formData = new FormData();
                formData.append("product_id", id);

                fetch("add_to_cart.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(data => {
                    document.getElementById("cart-message").innerHTML = data;
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById("cart-message").innerHTML = "<p>Failed to add to cart.</p>";
                });
            });
        });
    });
    </script>

</body>
</html>
