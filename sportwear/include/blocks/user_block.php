<?php
//Проверяется, подключения пользователя напрямую к данному файлу, как к самостоятельной странице.
if (isset($user) == false) {
    exit();
}
?>
<!-- Пишется имя пользователя в названии блока в
главном меню -->
<div class="user_block_name" id="userBlock">
    <b><?= $user['Имя'] ?></b>
</div>
<!-- Создается скрытый блок с данными пользователя
-->
<div class="hidden_user_block">
    <div class="user_name">
        <?php echo $user["Имя"] . " " . $user["Фамилия"]; ?>
    </div>
    <div class="user_dop_info">
        <span>Почта: </span>
        <?php echo $user["Почта"]; ?>
    </div>
    <div class="user_dop_info">
        <span>Тел: </span>
        <?php echo $user["Телефон"]; ?>
    </div>
    <div class="user_dop_info">
        <span>Адрес: </span>
        <?php echo $user["Адрес"]; ?>
    </div>
    <hr />
    <!-- Добавляется кнопка для выхода пользователя-->
    <a href="/login.php?exit=true" class="button">Выйти</a>
</div>