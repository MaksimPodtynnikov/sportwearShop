<?php
//Подключение базы данных
require_once("include/base.php");
if ($isUser == false) {
    echo '<div class="message_info">Вы должны авторизоваться.</div>';
    exit();
}
//Сформируем заброс на выборку товаров из корзины
$q = "SELECT корзина.id AS b_id, товар.id,
товар.Название, товар.Стоимость "
    . "FROM корзина INNER JOIN товар ON (товар.id = корзина.id_товар) "
    . "WHERE корзина.id_клиент = '" . $user["id"] .
    "'";
//Получим данные по запросу
$data = GetData($q);
//Если ничего не получили - значит корзина пуста
if ($data == false) {
    echo '<div class="message_info">В корзине нет товаров.</div>';
    exit();
}
//И их количество
//Переберём все товары корзины
function PrintOrderPosition($data, $user)
{
    $sum = 0; //Посчитаем итоговую сумму всех товаром
    $count = 0;
    foreach ($data as $tovar) {
        //Блок товара
        echo '<div class="user_order_tovar">';
        //Наименование товара
        echo '<span class="user_order_title">'
            . $tovar['Название'] . '</span>';
        //Цена товара
        echo '<span class="user_order_price"> - '
            . $tovar['Стоимость'] . ' ₽</span>';
        echo '</div>';
        //Посчитаем сумму цен и количество товаров.
        $sum = $sum + $tovar['Стоимость'];
        $count++;
    }
    //Добавим итоговую черту
    echo '<hr />';
    //Напечатаем сумму и количество всех товаров корзины
    echo '<div class="user_basket_itog"><span>Кол-во товаров:</span> ' . $count
        . ' шт.</div>';
    echo '<div class="user_basket_itog"><span>Сумма:</span> ' .
        $sum . ' ₽</div>';
    //Выводит список продуктов
}
function PrintStores()
{
    $q = "SELECT id,Название,Адрес,Телефон,Время_работы FROM пункт_выдачи";
    $data = GetData($q);
    //Если ничего не получили - значит корзина пуста
    if ($data === false) {
        echo '<div class="message_info">Магазины не найдены.</div>';
        exit();
    }
    $check="checked";
    foreach ($data as $store) {
        //Блок товара
        echo '<div class="store"><input type="radio" name="music_store" id="' . $store['Название'] . '" '.$check.' value="' . $store['id'] . '">';
        $check="";
        //Наименование товара
        echo '<span class="store_title">'
            . $store['Название'] . '</span>';
        //Цена товара
        echo '<span class="store_address"> - '
            . $store['Адрес'] . '</span>';
        echo '</div>';
    }
}

