<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Mie Halilintar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('img/Toko.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #ff6600;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .menu-item {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .menu-item img {
            max-width: 100px;
            margin-right: 20px;
            border-radius: 5px;
        }
        .menu-item h2 {
            margin-top: 0;
        }
        .order-button {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .cart {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .cart-item button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            background-color: #ff6600;
            color: white;
            cursor: pointer;
        }
        .cart-item span {
            margin: 0 10px;
        }
        .checkout-button {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
        .checkout-button:hover {
            background-color: #e65a00;
        }
    </style>
</head>
<body>
    <header>
        <h1>Pesan Mie Halilintar</h1>
    </header>
    <div class="container">
        <?php
        include 'db.php';
        $result = $conn->query("SELECT * FROM menu");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='menu-item'>";
            echo "<img src='img/" . $row['image'] . "' alt='" . $row['name'] . "'>";
            echo "<div>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<p>Rp. " . $row['price'] . "</p>";
            echo "<button class='order-button' onclick='addToCart(" . $row['id'] . ", \"" . $row['name'] . "\", " . $row['price'] . ")'>Pesan Sekarang</button>";
            echo "</div>";
            echo "</div>";
        }
        ?>
        <div class="cart">
            <h2>Keranjang Belanja</h2>
            <div id="cart-items"></div>
            <button class="checkout-button" onclick="checkout()">Checkout</button>
        </div>
    </div>
    <script>
        let cart = [];

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            displayCart();
        }

        function updateQuantity(id, amount) {
            const item = cart.find(item => item.id === id);
            if (item) {
                item.quantity += amount;
                if (item.quantity <= 0) {
                    const confirmDelete = confirm("Anda yakin ingin menghapus ini?");
                    if (confirmDelete) {
                        cart = cart.filter(i => i.id !== id);
                    } else {
                        item.quantity = 1; // Reset quantity to 1 if canceled
                    }
                }
                displayCart();
            }
        }

        function displayCart() {
            const cartItemsDiv = document.getElementById('cart-items');
            cartItemsDiv.innerHTML = '';
            cart.forEach(item => {
                const cartItemDiv = document.createElement('div');
                cartItemDiv.className = 'cart-item';
                cartItemDiv.innerHTML = `
                    <span>${item.name}</span>
                    <span>Rp. ${item.price}</span>
                    <button onclick="updateQuantity(${item.id}, -1)">-</button>
                    <span>${item.quantity}</span>
                    <button onclick="updateQuantity(${item.id}, 1)">+</button>
                `;
                cartItemsDiv.appendChild(cartItemDiv);
            });
        }

        function checkout() {
            localStorage.setItem('cart', JSON.stringify(cart));
            window.location.href = 'checkout.php';
        }
    </script>
</body>
</html>
