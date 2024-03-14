<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
//Посылаем заголовок с тек кодировкой
//header('Content-Type: text/html; charset=utf-8');
//=== Настройки подключение к БД
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
define("DB_DATABASE_NAME", "sportbase");
//=== Красивое сообщение об ошибке
function errorMassage($message)
{
    echo '<div style="background-color: #fdd; padding: 20px; margin: 50px 20%; font-family: sansserif;">';
    echo $message;
    echo '</div>';
}
//=== Соединение с БД
//Соединяемся с БД
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME); //@ - говорит о том, чтобы не выводились предупреждения
//Проверяем удалось ли соединиться
if (!$db) {
    errorMassage("Сервер недоступен!" .
        mysqli_connect_error());
    exit();
}
//=== Возвращает массив строк по запросу
function GetData($queryString)
{
    global $db; // Берем переменную из глобальной облсати видимости

    //--- Запрос к БД
    $q = mysqli_query($db, $queryString);
    //Проверка запроса на ошибки
    if ($q == false) {
        errorMassage('<b>Произошла ошибка во время запроса:</b> <br />' . mysqli_error($db));
        exit(); //Завершаем выполнение скрипта
    }
    //--- Обработка полученных строк
    //Массив будет хранить строки полученные из БД
    $rows = array();
    //Получаем первую строку
    $row = mysqli_fetch_assoc($q);
    //Если запрос не вернул строк
    if ($row == null || mysqli_num_rows($q) == 0) {
        //То возвращаем ложь
        return false;
    }
    //Получаем все остальные строки
    do {
        //Добавляем строку в массив строк
        $rows[] = $row;

        //Получаем след строку из запроса
        $row = mysqli_fetch_assoc($q);
    } while ($row != false);
    //Возвращаем массив строк
    return $rows;
}
//=== Функция проверяющая есть ли пользователь в системе
function isUser()
{
    //Если у пользователя существуют куки почты и пароля
    if (isset($_COOKIE["mail"]) && isset($_COOKIE["p40"])) {
        //Обрабатываем данные пришедшие от пользователя
        $eMail = htmlspecialchars($_COOKIE["mail"]);
        $password = sha1($_COOKIE["p40"]);
        //Делаем запрос БД на вход тек пользователя
        $user = GetData("SELECT `id`, `Почта`,
    `Имя`, `Фамилия`, `Телефон`, `Адрес` FROM клиент
    WHERE `Почта` = '$eMail' AND `Пароль` =
    '$password';");
        //Если не нашли пользователя, то выходим
        if ($user === false) {
            //Удаляем cookie
            setcookie("mail", "", time() - 3600);
            setcookie("p40", "", time() - 3600);

            //Говорим что пользователь не найден или не авторизован
            return false;
        }
        //Возвращаем данные о пользователе
        return $user[0];
    }
    //Говорим что пользователь не найден или не авторизован
    return false;
}
//Получаем статус пользователя (в системе или нет)
$user = isUser();
//Авторизован ли пользователь
$isUser = ($user === false) ? false : true;

//=== Функция выводящая список ошибок
function PrintErrorMessage($errors)
{
    //Если список ошибок не пуст
    if (count($errors) > 0) {
        echo '<div class="message_error_box">';
        foreach ($errors as $message) {
            echo '<span> ' . $message . "</span><br />";
        }
        echo '</div>';
    }
}
//=== Функция для запроса добавления, изменения и удаления
function ChangeData($q, $message, $exit = false)
{
    global $db;

    try {
        // Делаем запрос
        $is = mysqli_query($db, $q);

        // Если что то пошло не так
        if ($is == false) {
            //Выбрасываем исключение
            throw new Exception();
        }
    }
    //Если при произошла непридвиденная ошибка
    catch (Exception $e) {
        echo $message;
        if ($exit == true) {
            exit();
        }
    }
}
