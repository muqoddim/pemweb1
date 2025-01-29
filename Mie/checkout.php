<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        echo "<script>alert('Pesanan dibatalkan!');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    } else {
        $cart = json_decode($_POST['cart'], true);
        foreach ($cart as $item) {
            $menu_id = $item['id'];
            $quantity = $item['quantity']; // Menggunakan jumlah yang sebenarnya
            $sql = "INSERT INTO orders (menu_id, quantity) VALUES ('$menu_id', '$quantity')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        echo "<script>
                document.body.innerHTML = '<div style=\"display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f4;\"><div style=\"text-align: center;\"><h1 style=\"color: #333;\">Pesanan Anda Berhasil Terkirim</h1><p style=\"color: #555;\">Terima kasih telah memesan di Mie Halilintar!</p><button onclick=\"window.location.href=\'index.php\'\" style=\"padding: 10px 20px; background-color: #ff6600; color: #fff; border: none; cursor: pointer;\">Kembali ke Beranda</button></div></div>';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('img/Toko.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #main-header {
            background-color: #ff6600;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e65a00 3px solid;
        }
        #main-header h1 {
            text-align: center;
            text-transform: uppercase;
            margin: 0;
            font-size: 24px;
        }
        #receipt {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        #total-price {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
        }
        .btn {
            display: inline-block;
            background: #ff6600;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn:hover {
            background: #e65a00;
        }
    </style>
</head>
<body>
    <header id="main-header">
        <div class="container">
            <h1>Checkout</h1>
        </div>
    </header>
    <div class="container">
        <div id="receipt">
            <h2>Struk Belanja</h2>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Jumlah</th>
                        <th>Harga (Rp)</th>
                        <th>Total (Rp)</th>
                    </tr>
                </thead>
                <tbody id="receipt-body">
                    <!-- Item struk akan dimasukkan di sini oleh JavaScript -->
                </tbody>
            </table>
            <p id="total-price"></p>
        </div>
        <form method="POST" action="">
            <input type="hidden" name="cart" id="cart">
            <button type="submit" class="btn">Kirim Pesanan</button>
            <button type="submit" name="cancel" class="btn">Batalkan Pesanan</button>
        </form>
    </div>
    <script>
        const cart = JSON.parse(localStorage.getItem('cart'));
        document.getElementById('cart').value = JSON.stringify(cart);

        const receiptBody = document.getElementById('receipt-body');
        let totalPrice = 0;

        cart.forEach(item => {
            const row = document.createElement('tr');
            const totalItemPrice = item.price * item.quantity;
            row.innerHTML = `
                <td>${item.name}</td>
                <td>${item.quantity}</td> <!-- Menggunakan jumlah yang sebenarnya -->
                <td>${item.price}</td>
                <td>${totalItemPrice}</td>
            `;
            receiptBody.appendChild(row);
            totalPrice += totalItemPrice;
        });

        document.getElementById('total-price').innerText = `Total: Rp ${totalPrice}`;
    </script>
</body>
</html>
