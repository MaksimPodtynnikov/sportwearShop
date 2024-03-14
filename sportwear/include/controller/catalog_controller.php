<?php
//Подключается базовый код соединения с БД
require_once("include/base.php");
//Если существует параметр открытия, то добавляется дополнительный класс
function CategoriesOpenFunc($parametr)
{
    if (isset($parametr) && $parametr == true) {
        //То добавляем класс open, чтобы меню отображалось всегда
        echo " open";
    }
}
//Выводит список категорий
function PrintListCategories()
{
    //Получаем список категорий
    $categories = GetData("SELECT id, Название,Изображение FROM Категория;");
    //Если список категорий не пуст
    if ($categories != false) {
        //То он выводится
        foreach ($categories as $cat) {
            //Если методом GET была передана строка поиска
            if (
                isset($_GET["text"]) && $_GET["text"]
                != ""
            ) {
                //То добавляется к ссылке значение искомой строки
                echo
                '<a href="/products.php?cat=' . $cat['id'] . '&text=' . $_GET["text"]. '">' . $cat['Название'] . '</a>';
            }
            //Иначе
            else {
                //Выводится ссылка с номером категории
                echo '<li><a href="/products.php?cat=' . $cat['id']. '">' . $cat['Название']. '</a></li>';
            }
        }
    }
}
function PrintMainPageCategories()
{
    //Получаем список категорий
    $categories = GetData("SELECT id, Название,Изображение FROM Категория;");
    //Если список категорий не пуст
    if ($categories != false) {
        //То он выводится
        foreach ($categories as $cat) {
            //Выводится ссылка с номером категории 
            echo '<span class="imgMainPage">
            <a href="/products.php?cat=' . $cat['id']. '">
            <img src = "data:image/jpg;base64,' . base64_encode($cat['Изображение']) . '" width = "100%" height = "150px">
            <h2>'.$cat['Название'].'</h2></a>
            </span>';
        }
    }
}
