<?php require_once("include/controller/login_controller.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <script type="text/javascript" src="/script/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/script/script.js"></script>

    <title>Вход</title>
</head>

<body>
    <div class="mainWrapper"> 
    <!-- Подключим главное меню-->
    <?php require("include/header.php"); ?>
    <div class="wrapper">
    <?php PrintErrorMessage($errorMessage); ?>
        <!-- Форма для ввода данных-->
        <div class="modal_page_box">
            <form action="" method="POST">
                <h1>Вход</h1>
                <!-- Ввод почты-->
                <div class="input_box">
                    <label for="eMail">Почта:</label><br />
                    <input type="text" id="eMail" placeholder="mail@mail.ru" name="eMail" />
                </div>
                <!-- Ввод пароля-->
                <div class="input_box">
                    <label for="password">Пароль: </label><br />
                    <input type="password" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" name="password" />
                </div>
                <!-- Кнопка входа-->
                <div class="button_box">
                    <button type="submit">Войти</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <?php require("include/footer.php"); ?>
</body>

</html>