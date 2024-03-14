<?php require("include/controller/products_controller.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <script type="text/javascript" src="/script/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/script/script.js"></script>
    <title>Каталог</title>
</head>

<body>
<div class="mainWrapper">
    <!-- Подключаем главное меню-->
    <?php require("include/header.php"); ?>
    <div class="wrapper">
        <div class="top_content_bar">
            <div class="left_bar">
                <!-- Подключаем меню каталога товаров-->
                <?php require("include/catalog.php"); ?>
            </div>
        </div>
        <div class="content">
        <?php PrintListProducts($products, $isUser);?>
        </div>
    </div>
</div>
<?php require("include/footer.php"); ?>
</body>

</html>