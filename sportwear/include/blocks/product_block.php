<?php
//если переменной $product или $isUser не существует
if (
    isset($product) == false || isset($isUser) == false
) {
    exit();
}
?>
<div class="tovar_block clear" id="tovar_id_<?php echo $product['id']; ?>">
    <div class="tovar_right_panel">
        <span class="price">
            <?php echo $product['Стоимость'] . " ₽"; ?>
        </span>
        <?php
        //Получаем кол-во товара на складе
        $count = (int)$product['Количество'];
        //Если товар есть на складе
        if ($count > 0) {
            echo '<span class="count_message_true">✔ Есть в наличии</span>';
            echo '<span class="count">Количество: ' . $count . " шт.</span>";
            //Если пользователь авторизован
            if ($isUser == true) {
                //Добавляем активную кнопку
                echo '<button class="add_basket_tovar_button"><input type="hidden" ' . 'value="' . $product['id'] . '" />В корзину</button>';
            }
        }
        //Если товара нет, то сообщаем пользователю
        else {
            echo '<span class="count_message_false">✘ Нет в наличии</span>';
        }
        ?>
    </div>
    <div class="tovar_left_panel">
    <span class="tovar_mainImg">
        <?php echo '<img src="img/sls/' . $product['id'] . '/1.webp" onError="this.src=' . "'img/no_photo.svg'" . '"; height=100px>' ?>
    </span>
    <div class="tovar_mid_panel">
        <div class="tovar_title">
            <?php echo $product['Название']; ?>
        </div>
        <div class="tovar_description">
            <?php echo nl2br($product['Описание']); ?>
        </div>
        <div class="tovar_footer">
            Категория:
            <span class="gray_bold">
                <?php echo $product['Тип']; ?>
            </span>
            <br />
            Артикул:
            <span class="gray_bold">
                <?php echo $product['id']; ?>
            </span>
        </div>
    </div>
    </div>
</div>