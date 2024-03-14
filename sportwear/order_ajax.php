<?php
//Подключение базовых функций
require_once("include/base.php");
//Если пользователь на авторизован
if ($isUser == false) {
    echo '<div class="message_info">Для отображения заказов, '
        . 'вы должны авторизоваться.</div>';
    exit();
}

if (isset($_POST['act']) == true) {
    //Извлечём информацию о переданном действии
    $act = htmlspecialchars($_POST['act']);
    //Если это запрос на добавление в корзину
    if ($act == "add") {
        mysqli_autocommit($db, FALSE);
        try {
            //Сформулируем текст ошибки, если она произойдёт
            $message = '<div class="message_info">'
                . 'Ошибка оформления заказа (не передан адрес магазина).</div>';
            //Если ID добавляемого товара не было передано
            if (isset($_POST['store']) == false) {
                //Выведем ошибку и завершим работу.
                echo $message;
                exit();
            }
            //Извлечём ID товара
            $storeId = (int)$_POST['store'];
            $message = '<div class="message_info">'
            . 'Ошибка оформления заказа(не удалось создать заказ).</div>';
            //Сформируем запрос к БД на добавление
            $qAdd = "INSERT INTO `заказ` (`id_клиент`,`id_пунктВыдачи`,`id_статус`) VALUES ('"
                . $user["id"] . "', '" . $storeId . "', '1')";
            //Отправим заброс, включая и текст ошибки, если таковая произойдёт при попытки внести изменения в базу данных
            ChangeData($qAdd, $message, true);
            $orderid = mysqli_insert_id($db);
            $message = '<div class="message_info">'
            . 'Ошибка оформления заказа (корзина не найдена).</div>';
            //Сформируем запрос к БД на добавление
            $q = "SELECT id,id_товар FROM корзина WHERE id_клиент = '" . $user["id"] . "'";
            //Отправим заброс, включая и текст ошибки, если таковая произойдёт при попытки внести изменения в базу данных
            $data = GetData($q);
            if ($data == false) {
                echo '<div class="message_info">Заказ пуст.</div>';
                exit();
            }
            $message = '<div class="message_info">'
            . 'Ошибка оформления заказа (не удалось добавить товар в заказ).</div>'.$orderid;
            foreach ($data as $tovar) {
                $qAdd = "INSERT INTO `позициизаказа` (`id_заказ`,`id_товар`) VALUES ('".$orderid . "', '" . $tovar["id_товар"] . "')";
                ChangeData($qAdd, $message, true);
            }
            $message = '<div class="message_info">'
            . 'Ошибка оформления заказа (не удалось очистить корзину).</div>';
            $qDel = "DELETE FROM `корзина` WHERE `id_клиент` = '". $user["id"] . "'";
            ChangeData($qDel, $message, true);
        } catch (Exception $e) {
            mysqli_rollback($db);
            echo $message;
        }
        mysqli_commit($db);
        mysqli_autocommit($db, TRUE);
    }
    //Если это запрос на удаление из корзины
    else if ($act == "del") {
        //Текст ошибки
        $message = '<div class="message_info">'
            . 'Ошибка удаления заказа.</div>';
        //Если не был передан ID корзины
        if (isset($_POST['orderid']) == false) {
            echo $message;
            exit();
        }
        //Извлечём ID корзины
        $orderid = (int)$_POST['orderid'];
        //Сформируем запрос
        $qDel = "DELETE FROM `позициизаказа` WHERE `id_заказ` = '" . $orderid . "'";
        //Отправим заброс к БД
        ChangeData($qDel, $message, true);
        $qDel = "DELETE FROM `заказ` WHERE `id` = '" . $orderid . "'";
        //Отправим заброс к БД
        ChangeData($qDel, $message, true);
    }
}
//Сформируем заброс на выборку товаров из корзины
$q = "SELECT заказ.id AS o_id, пункт_выдачи.Адрес as Адрес,статус_заказа.Название as Статус,заказ.Дата_заказа "
    . "FROM заказ INNER JOIN пункт_выдачи ON (заказ.id_пунктВыдачи = пункт_выдачи.id) INNER JOIN статус_заказа ON (статус_заказа.id=заказ.id_статус) "
    . "WHERE заказ.id_клиент = '" . $user["id"] . "'";
//Получим данные по запросу
$data = GetData($q);
//Если ничего не получили - значит корзина пуста
if ($data === false) {
    echo '<div class="message_info">Заказов нет.</div>';
    exit();
}
$count = 0; //И их количество
//Переберём все товары корзины
foreach ($data as $order) {
    //Блок товара
    echo '<div class="user_order">';
    //Кнопка удаления товара из корзины
    echo '<div class="user_order_delete"><input
type="hidden" value="'
        . $order['o_id'] . '" />✖</div>';
    //Наименование товара
    echo '<span class="user_order_title">Код заказа: '
        . $order['o_id'] . '</span><br>';
    echo '<span class="user_order_status">'
        . $order['Статус'] . '</span><br>';
    //Цена товара
    echo '<span class="user_order_address"> - '
        . $order['Адрес'] . ' </span><br>';
    echo '<span class="user_order_date">Дата: '
        . $order['Дата_заказа'] . ' </span>';
    echo '</div><hr />';
    //Посчитаем сумму цен и количество товаров.
    $count++;
}
//Добавим итоговую черту
echo '<hr />';
//Напечатаем сумму и количество всех товаров корзины
echo '<div class="user_order_itog"><span>Кол-во заказов:</span> ' . $count
    . '.</div>';
