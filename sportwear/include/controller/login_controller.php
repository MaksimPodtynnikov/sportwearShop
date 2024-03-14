<?php
//Если передан параметр выхода, то выходим из системы
if (isset($_GET["exit"]) && $_GET["exit"] == "true") {
    //Удаляем cookie
    setcookie("mail", "", time() - 3600);
    setcookie("p40", "", time() - 3600);
    //Пересылаем на страницу входа (на текущую страницу)
    header("Location: /");
    exit();
}
//Подключаем базовый код соединения с БД
require_once("include/base.php");
//Если пользователь уже есть в системе
if ($isUser == true) {
    //то пересылаем его на главную страницу
    header("Location: /index.php");
    exit();
}
//Список ошибок
$errorMessage = array();
//Проверяем, может пользователь уже пытался войти,или, были ли переданы какие-то данные методом POST
if (isset($_POST['eMail']) && isset($_POST['password'])) {
    //Считываем и обрабатываем данные
    $eMail = htmlspecialchars(trim($_POST['eMail']));
    $password = htmlspecialchars(trim($_POST['password']));
    //Т.к. данные пользователя, хранящиеся в БД закешированы, причём дважды, то и передаваемый из текстового поля пароль тоже закешируем дважды в том же порядке.
    $passwordMD5 = md5($password);
    $passwordMD5AndSHA1 = sha1($passwordMD5);
    //Ищем пользователя в БД
    $login = GetData("SELECT `id` FROM клиент WHERE `Почта` = '$eMail' ". "AND `Пароль` = '$passwordMD5AndSHA1';");
    //Проверяем есть ли пользователь
    if ($login != false) {
        //Если пользователь с такими данными найден в БД,добавим его в КУКИ на час и...
        setcookie("mail", $eMail, time() + 3600);
        setcookie("p40", $passwordMD5, time() + 3600);
        //Перешлём на главную страницу
        header("Location: /index.php");
        exit();
    }
    //Если пользователь не найден то добавляем ошибку
    else {
        $errorMessage[] = "Неправильные имя пользователя или пароль";
    }
}
