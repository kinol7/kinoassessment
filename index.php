<?php
$host = 'localhost';
$user = 'root';      
$pass = '';           
$db = 'db';          

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM product";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
        body { font-family: verdana; }
        .card-title { text-align: center; }
        .btn { display: block; margin: 0 auto; }
        .cart {
            padding: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .card {
            margin-top: 10px;
            transition: all 0.5s;
        }
        .card:hover {
            transform: scale(1.15);
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <form action="cart.php" method="POST">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $fruit = $row['Fruit'];
                    $image = $row['Image']; // just filename without extension
                    $price = $row['Price'];
                    ?>
                    <div class="col">
                        <div class="card h-100">
                            <h1 class="card-title"><?php echo htmlspecialchars($fruit); ?></h1>
                            <img src="images/<?php echo htmlspecialchars($image); ?>.png" class="card-img-top" alt="<?php echo htmlspecialchars($fruit); ?>" height="250">
                            <div class="card-footer">
                                <button type="button" onclick="window.location.href='cart.php?productName=<?php echo urlencode($fruit); ?>&productImage=<?php echo urlencode('images/' . $image . '.png'); ?>&price=<?php echo $price; ?>';" class="btn btn-info">Order Item</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </form>
</div>

<script src="js/bootstrap.bundle.js"></script>
</body>
</html>

<?php $conn->close(); ?>
