<?php require_once("include/controller/catalog_controller.php");?>
<div class="catalog">
    <!-- Ссылка на страницу каталога товаров-->
    <!--<div class="title">
        <a href="/products.php">Каталог товаров</a>
    </div>-->
    <!-- Скрытый блок категорий товаров-->
    <span class="hidden_box">
        <a class="main-item" href="javascript:void(0);" tabindex="1" >Каталог</a> 
            <ul class="sub-menu">
                <!--Здесь будет выведен список категорий, когда подключится БД-->
                <?php PrintListCategories(); ?>
            </ul>
    </span>
</div>
