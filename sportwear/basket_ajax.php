<?php
//Подключение базовых функций
require_once("include/base.php");
//Если пользователь на авторизован
if ($isUser == false) {
    echo '<div class="message_info">Для добавления товаров в корзину необходимо авторизоваться.</div>';
    exit();
}
//Обработка какого-либо действия, переданного методом POST
if (isset($_POST['act']) == true) {
    //Извлечём информацию о переданном действии
    $act = htmlspecialchars($_POST['act']);
    //Если это запрос на добавление в корзину
    if ($act == "add") {
        //Сформулируем текст ошибки, если она произойдёт
        $message = '<div class="message_info">'
            . 'Ошибка добавления товара.</div>';
        //Если ID добавляемого товара не было передано
        if (isset($_POST['tovarId']) == false) {
            //Выведем ошибку и завершим работу.
            echo $message;
            exit();
        }
        //Извлечём ID товара
        $tovarId = (int)$_POST['tovarId'];
        //Сформируем запрос к БД на добавление
        $qAdd = "INSERT INTO `корзина` (`id_клиент`,
`id_товар`) VALUES ('"
            . $user["id"] . "', ' " . $tovarId . " ')";
        //Отправим заброс, включая и текст ошибки, если таковая произойдёт при попытки внести изменения в базу данных
        ChangeData($qAdd, $message, true);
    }
    //Если это запрос на удаление из корзины
    else if ($act == "del") {
        //Текст ошибки
        $message = '<div class="message_info">'
            . 'Ошибка удаления товара.</div>';
        //Если не был передан ID корзины
        if (isset($_POST['basketId']) == false) {
            echo $message;
            exit();
        }
        //Извлечём ID корзины
        $basketId = (int)$_POST['basketId'];
        //Сформируем запрос
        $qDel = "DELETE FROM `корзина` WHERE `id_клиент`
= '" . $user["id"]
            . "' AND `id` = '" . $basketId . "'";
        //Отправим заброс к БД
        ChangeData($qDel, $message, true);
    }
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
if ($data === false) {
    echo '<div class="message_info">Корзина пуста.</div>';
    exit();
}
$sum = 0; //Посчитаем итоговую сумму всех товаром
$count = 0; //И их количество
//Переберём все товары корзины
foreach ($data as $tovar) {
    //Блок товара
    echo '<div class="user_basket_tovar">';
    //Кнопка удаления товара из корзины
    echo '<div class="user_basket_delete"><input
type="hidden" value="'
        . $tovar['b_id'] . '" />✖</div>';
    //Наименование товара
    echo '<span class="user_basket_title">'
        . $tovar['Название'] . '</span>';
    //Цена товара
    echo '<span class="user_basket_price"> - '
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
    if($count>0)
echo '<div class="user_basket_itog"><span class="user_basket_order"><a href="order.php">Перейти к заказу</a></span></div>';
    
