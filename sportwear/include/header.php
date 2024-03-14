<?php require_once("include/controller/header_controller.php"); ?>
<div class="header">
    <div class="header_content">
        <!-- Название магазина и значок-->
        <a href="/" class="logotip">
            <img src="img/LOGO.svg" height="87px" width="100px" />
        </a>
        <form action="/products.php" method="get" class="search_form">
            <input type="search" name="input_text" placeholder="поиск" class="input_text" />
            <input type="submit" name="" value="" class="search_button" />
        </form>
        <!-- Верхний блок сайта-->
        <div class="top_menu">
            <div class="user_top_block">
                <!-- Специальный "значок корзины"-->
                <div class="user_avatar_min"><img src="img/cart.svg" width="50px"> </div>
                <div class="user_block_content">
                    <div class="user_block_name">Корзина</div>
                    <!-- Здесь будет информация о пользователе-->
                    <div class="hidden_user_block" id="userBasket">
                        <!-- Данный блок будет использован позже в "script.js" -->
                    </div>
                </div>
            </div>
            <div class="user_top_block">
                <!-- Специальный "значок корзины"-->
                <div class="user_avatar_min"><img src="img/order.svg" width="50px"> </div>
                <div class="user_block_content">
                    <div class="user_block_name">Заказы</div>
                    <!-- Здесь будет информация о пользователе-->
                    <div class="hidden_user_block" id="userOrders">
                        <!-- Данный блок будет использован позже в "script.js" -->
                    </div>
                </div>
            </div>
            <!-- Ссылки на страницы входа и регистрации-->
            <div class="user_top_block">
                <!-- Специальный "значок настроек"-->
                <div class="user_avatar_min"><img src="img/profile.svg" width="30px"> </div>
                <!-- Информация о пользователе-->
                <div class="user_block_content">
                <?php UserBlock($isUser, $user); ?>
                </div>
            </div>
        </div>
    </div>
</div>