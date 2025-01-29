<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $sql = "INSERT INTO menu (name, price, type) VALUES ('$name', '$price', '$type')";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM menu WHERE id='$id'";
        $conn->query($sql);
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $sql = "UPDATE menu SET name='$name', price='$price', type='$type' WHERE id='$id'";
        $conn->query($sql);
    }
}

$menu = $conn->query("SELECT * FROM menu");
$orders = $conn->query("SELECT * FROM orders");
$daily_profit = $conn->query("SELECT SUM(price * quantity) AS daily_profit FROM orders WHERE DATE(order_date) = CURDATE()");
$monthly_profit = $conn->query("SELECT SUM(price * quantity) AS monthly_profit FROM orders WHERE MONTH(order_date) = MONTH(CURDATE())");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Menu</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" id="menuId">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>
        <br>
        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required>
        <br>
        <button type="submit" name="add">Add Menu Item</button>
        <button type="submit" name="update">Update Menu Item</button>
        <button type="submit" name="delete">Delete Menu Item</button>
    </form>
    <ul>
        <?php while ($row = $menu->fetch_assoc()): ?>
            <li><?php echo $row['name'] . " - Rp. " . $row['price']; ?></li>
        <?php endwhile; ?>
    </ul>

    <h2>Orders</h2>
    <ul>
        <?php while ($row = $orders->fetch_assoc()): ?>
            <li><?php echo "Order ID: " . $row['id'] . " - Menu ID: " . $row['menu_id'] . " - Quantity: " . $row['quantity']; ?></li>
        <?php endwhile; ?>
    </ul>

    <h2>Profit</h2>
    <p>Daily Profit: Rp. <?php echo $daily_profit->fetch_assoc()['daily_profit']; ?></p>
    <p>Monthly Profit: Rp. <?php echo $monthly_profit->fetch_assoc()['monthly_profit']; ?></p>
</body>
</html>
