<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style/style.css" />
        <script type="text/javascript" src="/script/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="/script/script.js"></script>
        <title>Сеть магазинов спортивной обуви street-foot.ru</title>
    </head>
    <body>
        <div class="mainWrapper"> 
        <!-- Подключаем блок основного меню-->
        <?php require("include/header.php"); ?>
        <!-- Основной блок сайта-->
        <div class="wrapper">
            <!-- Основная информация главного окна-->
            <div class="content_lb">
                <!-- Приветственный текст-->
                <h1 class="h_title">Сеть магазинов спортивной обуви street-foot</h1>
                <!-- Приветственное изображение-->
                <div class="mainPageMenu">
                    <?php require_once("include/controller/catalog_controller.php");
                    PrintMainPageCategories(); ?>
                </div>               
            </div>
        </div>
        </div>
        <?php require("include/footer.php"); ?>
    </body>
</html>
