<?php
session_start();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if ($_GET['action'] == 'remove') {
      
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    if ($_GET['action'] == 'update' && isset($_POST['quantity'])) {
        
        $new_quantity = $_POST['quantity'];

        if ($new_quantity > 0) {
            $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
        } else {
        
            unset($_SESSION['cart'][$product_id]);
        }
    }
}

header("Location: cart.php");
exit();
?>
