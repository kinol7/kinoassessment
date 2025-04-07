<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
        body {
            background-color: darkkhaki;
        }
        .card-title {
            text-align: center;
        }
        .btn {
            display: block;
            margin: 0 auto;
        }
        .cart {
            padding: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <form action="yow1.php" method="POST">
            <div class="row row-cols-4 row-cols-sm-4 row-cols-md-4 g-4">
                
                <!-- Lettuce -->
                <div class="col">
                    <div class="card h-100">
                        <h1 class="card-title">Lettuce</h1>
                        <img src="lettuce.jpg" class="card-img-top" alt="Lettuce" width="150" height="200">
                        <div class="card-footer">
                            <button type="button" onclick="window.location.href='yow1.php?productName=Lettuce&productImage=lettuce.jpg&price=5.00';" class="btn btn-info">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Greenbeans -->
                <div class="col">
                    <div class="card h-100">
                        <h1 class="card-title">Greenbeans</h1>
                        <img src="greenbeans.png" class="card-img-top" alt="Greenbeans" width="150" height="200">
                        <div class="card-footer">
                            <button type="button" onclick="window.location.href='yow1.php?productName=Greenbeans&productImage=greenbeans.png&price=3.50';" class="btn btn-info">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Tomato -->
                <div class="col">
                    <div class="card h-100">
                        <h1 class="card-title">Tomato</h1>
                        <img src="tomato.jpg" class="card-img-top" alt="Tomato" width="150" height="200">
                        <div class="card-footer">
                            <button type="button" onclick="window.location.href='yow1.php?productName=Tomato&productImage=tomato.jpg&price=4.00';" class="btn btn-info">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Potato -->
                <div class="col">
                    <div class="card h-100">
                        <h1 class="card-title">Potato</h1>
                        <img src="potatoees.jpg" class="card-img-top" alt="Potato" width="150" height="200">
                        <div class="card-footer">
                            <button type="button" onclick="window.location.href='yow1.php?productName=Potato&productImage=potatoees.jpg&price=2.50';" class="btn btn-info">Add to Cart</button>
                        </div>
                    </div>
                </div>
                
           
            </div>
        </form>
    </div>
    <script src="js/bootstrap.budle.js"></script>
</body>
</html>
