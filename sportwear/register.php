<?php require_once("include/controller/register_controller.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <script type="text/javascript" src="/script/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/script/script.js"></script>
    <title>Регистрация</title>
</head>

<body>
    <div class="mainWrapper">
        <!-- Подключаем главное меню-->
        <?php require("include/header.php"); ?>
        <!-- Форма для ввода данных-->
        <div class="wrapper">
        <?php
        PrintErrorMessage($errorMessage);
        WriteRegisterForm($isShowForm);
        ?>
        </div>
    </div>
    <?php require("include/footer.php"); ?>
</body>

</html>