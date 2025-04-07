<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db"; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect to DB: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['purchase'])) {
    $username = trim($_POST['username']);
    $contact = trim($_POST['contact']);
    $quantity = intval($_POST['quantity']);
    $totalPrice = floatval($_POST['totalPrice']);
    $productName = trim($_POST['productName']);

    $stmt = $conn->prepare("INSERT INTO orders (product_name, quantity, total_price, username, contact_number) 
                            VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sidss", $productName, $quantity, $totalPrice, $username, $contact);

    if ($stmt->execute()) {
        $updateQuery = "UPDATE product SET Qty = Qty - ? WHERE Fruit = ?";
        $updateStmt = $conn->prepare($updateQuery);
        if ($updateStmt) {
            $updateStmt->bind_param("is", $quantity, $productName);
            $updateStmt->execute();
            $updateStmt->close();
        }

        echo "<script>alert('Purchase successful!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$productName = isset($_GET['productName']) ? $_GET['productName'] : '';
$productImage = isset($_GET['productImage']) ? $_GET['productImage'] : '';
$productPrice = isset($_GET['price']) ? floatval($_GET['price']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
        body { font-family: verdana; }
    </style>
</head>
<body>

<div class="modal fade show" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" style="display: block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fill Up to Order</h5>
                <a href="index.php" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="text-center mb-3">
                        <img class="modal-img" src="<?php echo htmlspecialchars($productImage); ?>" alt="<?php echo htmlspecialchars($productName); ?>" width="150">
                        <h5><?php echo htmlspecialchars($productName); ?></h5>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Number:</label>
                        <input type="text" name="contact" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" required onchange="updateTotal()">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Price:</label>
                        <input type="text" id="totalPrice" name="totalPrice" class="form-control" value="<?php echo $productPrice; ?>" readonly>
                    </div>

                    <input type="hidden" name="productName" value="<?php echo htmlspecialchars($productName); ?>">
                    <input type="hidden" id="productPrice" value="<?php echo $productPrice; ?>">

                    <button type="submit" name="purchase" class="btn btn-success w-100">Purchase</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.js"></script>
<script>
function updateTotal() {
    let quantity = document.getElementById('quantity').value;
    let productPrice = document.getElementById('productPrice').value;
    let totalPrice = quantity * productPrice;
    document.getElementById('totalPrice').value = totalPrice.toFixed(2);
}
</script>
</body>
</html>
