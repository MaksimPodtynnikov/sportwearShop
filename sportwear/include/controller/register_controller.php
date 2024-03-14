<?php
//Подключаем базовый код соединения с БД
require_once("include/base.php");
//Если пользователь уже есть в системе
if ($isUser) {
    //то пересылаем его на главную страницу
    header("Location: /index.php");
    exit();
}
//Показывать ли нам форму для ввода регистрационных данных
$isShowForm = true;
//Список с ошибками
$errorMessage = array();
//Если были переданы регистрационные данные методом POST
if (
    isset($_POST['eMail']) &&
    isset($_POST['password']) &&
    isset($_POST['name']) &&
    isset($_POST['lastname']) &&
    isset($_POST['phone']) &&
    isset($_POST['address'])
) {
    //Извлечём их из массива _POST
    $password = htmlspecialchars(trim($_POST['password']));
    $name = htmlspecialchars(trim($_POST['name']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $eMail = htmlspecialchars(trim($_POST['eMail']));
    $address = htmlspecialchars(trim($_POST['address']));
    //Проверяем почту на соответствие формы почты
    if (!preg_match("/\A[^@]+@([^@\.]+\.)+[^@\.]+\z/", $eMail)) {
        $errorMessage[] = "Некорректно ввдена почта.";
    }
    //Пароль не меньше шести символов!
    if (strlen($password) < 6) {
        $errorMessage[] = "Пароль должен содержать минимум 6 символов!.";
    }
    //Имя не менее двух.
    if (strlen($name) < 2) {
        $errorMessage[] = "Некорректно введено имя.";
    }
    //Фамилия не менее двух.
    if (strlen($lastname) < 2) {
        $errorMessage[] = "Некорректно введена фамилия.";
    }
    //Соответствие телефона форме телефонного номера.
    if (!preg_match("/^(\+?\d+)?\s*(\(\d+\))?[\s-]*([\d-]*)$/", $phone)) {
        $errorMessage[] = "Некорректно введен телефон.";
    } //Адрес не менее двадцати символов.
    if(strlen($address) < 10){
        $errorMessage[] = 'Вы действительно тут живете? - "'.$address.'".';
    }
    if (count($errorMessage) == 0) { //Ищем пользователя в базе с такой же почтой
        $isIssetUserEMail = GetData("SELECT `id` FROM клиент WHERE `Почта` " . "= '$eMail';");
        //Если нет пользователя с таким же e-mail
        if ($isIssetUserEMail === false) {
            global $db;
            //Хешируем пароль
            $passwordMD5 = md5($password);
            $passwordMD5AndSHA1 = sha1($passwordMD5);
            //Формируем запрос на добавление данных нового пользователя
            $q = "INSERT INTO `клиент` (`Почта`, `Пароль`, `Имя`, `Фамилия`, ". "`Телефон`, `Адрес`) VALUES ('$eMail','$passwordMD5AndSHA1', "
            . "'$name', '$lastname', '$phone','$address');";
            //Форму заполнения регистрационных данных не показывать
            $isShowForm = false;
            //Тут может возникнуть исключение
            try { //Добавляем данные в БД
                $isRegister = mysqli_query($db, $q);
                //Если данные не добавились

                if ($isRegister == false) { //Выбрасываем исключение
                    throw new Exception();
                }
                //Если пользователь зарегистрировался он автоматически входит в систему
                setcookie("mail", $eMail, time() + 3600);
                setcookie("p40", $passwordMD5, time() + 3600);
            }
            //Если при регистрации произошла непредвиденная ошибка
            catch (Exception $e) {
                //Показываем форму
                $isShowForm = true;
                //Сообщаем пользователю об ошибке
                $errorMessage[] =$e;
                $errorMessage[] = "Во время регистрации произошла ошибка.";
            }
        } //Если был найден пользователь с такой почтой
        else {
            $errorMessage[] = "Пользователь с такой почтой - " . $eMail . ", уже зарегистрирован!";
        }
    }
} //Показывает форму (если нужно)
function WriteRegisterForm($isShow)
{ //Проверяем, нужно ли показывать форму
    if ($isShow == true) {
        //Включим блок с формой
        include("include/blocks/register_form_block.php");
    }
    //Если форму показывать не нужно, то пользователь успешно зарегистрирован
    else {
        echo '<div class="message_info_box">Вы успешно зарегистрированы!</div>';
    }
}
