<?php
//Подключается базовый код соединения с БД
require_once("include/base.php");
//Функция,выводящая блок пользователя
function UserBlock($isUser, $user)
{
    //Если пользователь вошел
    if ($isUser == true) {
        //подключается код блока
        include("include/blocks/user_block.php");
    }
    //Если пользователь не вошел, выводятся ссылки на регистрацию и авторизацию.
    else {
        echo '<a href="/login.php">Вход</a> | ';
        echo '<a href="/register.php">Регистрация</a>';
    }
}
