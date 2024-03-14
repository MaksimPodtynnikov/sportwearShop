<div class="modal_page_box">
    <form action="" method="POST">
        <h1>Регистрация</h1>
        <div class="input_box">
            <label for="eMail">Адрес:</label><br />
            <input name="eMail" id="eMail" placeholder="mail@mail.ru" <?php if (isset($_POST['eMail'])) echo $_POST['eMail']; ?> />
        </div>
        <div class="input_box">
            <label for="password">Пароль:</label><br />
            <input type="password" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" name="password" <?php if (isset($_POST['password'])) echo 'value="' . $_POST['password'] . '"'; ?> />
        </div>
        <div class="input_box">
            <label for="name">Имя:</label><br />
            <input type="text" id="name" placeholder="Иван" name="name" <?php if (isset($_POST['name'])) echo 'value="' . $_POST['name'] . '"'; ?> />
        </div>
        <div class="input_box">
            <label for="lastname">Фамилия:</label><br />
            <input type="text" id="lastname" placeholder="Иванов" name="lastname" <?php if (isset($_POST['Фамилия'])) echo 'value="' . $_POST['lastname'] . '"'; ?> />
        </div>
        <div class="input_box">
            <label for="phone">Телефон:</label><br />
            <input type="text" id="phone" placeholder="+7 XXX-XX-XX" name="phone" <?php if (isset($_POST['phone'])) echo 'value="' . $_POST['phone'] . '"'; ?> />
        </div>
        <div class="input_box">
            <label for="address">Адрес:</label><br />
            <textarea name="address" id="address" placeholder="_____ обл. г. ____ ул. ______ д. __ кв. _"> 
                <?php if (isset($_POST['address'])) echo $_POST['address']; ?>
            </textarea>
        </div>
        <div class="button_box">
            <button type="submit">Зарегистрироваться</button>
        </div>
    </form>
</div>