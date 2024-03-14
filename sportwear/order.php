<?php require_once("include/controller/order_controller.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <script type="text/javascript" src="/script/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/script/script.js"></script>

    <title>Оформление заказа</title>
</head>

<body>
    <div class="mainWrapper"> 
    <!-- Подключим главное меню-->
    <?php require("include/header.php"); ?>
    <div class="wrapper">
    <?php PrintErrorMessage($errorMessage); ?>
        <div class="modal_page_box" >
            <form id="order_form">
                <h1>Ваш заказ:</h1>
                <div class="order_positions">
                    <?php PrintOrderPosition($data,$user);?>
                </div>
                <div class="order_stores">Выбор магазина:
                <?php PrintStores();?>
                </div>
                <div class="order_payment">Способ оплаты:
                    <input type="radio" id="Payment1" name="payment" value="money" checked>
                    <label for="Payment1">Наличные</label>
                </div>
                </form>
                <div class="order_submit">
                    <span class="button_box">
                    <button class="order_button_submit">Оформить заказ</button>
                    </span>
                </div>
        </div>
    </div>
    </div>
    <?php require("include/footer.php"); ?>
</body>

</html>