$(function () {
    //липкая шапка
    $(window).scroll(function () {
        if ($(this).scrollTop() > 1) {
            $('.header').addClass("sticky");
            $('.wrapper').addClass("sticky");
        }
        else {
            $('.header').removeClass("sticky");
            $('.wrapper').removeClass("sticky");
        }
    });

    //--------------------------------------
    //--- Выпадающие блоки сверху ----------
    $('.user_top_block').hover(function () {

        $(this).find('.hidden_user_block').slideDown(120);
    },
        function () {
            $(this).find('.hidden_user_block').slideUp(50);
        });
    //--------------------------------------
    //--- Корзина --------------------------
    var userBasket = $('#userBasket');

    function ActiveDeleteButton() {
        // Нажатие по кнопке удалить
        $('.user_basket_delete').click(function () {
            var id = $(this).find('input').val();
            $(this).remove();
            $.post("/basket_ajax.php",
                { act: "del", basketId: id },
                function (data) {
                    userBasket.html(data);
                    ActiveDeleteButton();
                }
            );
        });
    }
    // Загрузка
    function LoadBasket() {
        $.post("/basket_ajax.php", function (data) {
            userBasket.html(data);
            ActiveDeleteButton();
        });
    }
    LoadBasket();
    //Нажатие на кнопку "в корзину"
    $('.add_basket_tovar_button').click(function () {
        var basketButton = $(this);
        var inputData = basketButton.find('input');
        if (basketButton.attr('newAdd') == 0)
            return;
        basketButton.attr('newAdd', "0");
        var id = inputData.val();
        var backVal = basketButton.html();
        basketButton.html("Товар добавлен");
        setTimeout(function () {
            basketButton.html(backVal);
            basketButton.attr('newAdd', "1");
        }, 2000);
        $.post("basket_ajax.php",
            { act: "add", tovarId: id },
            function (data) {
                userBasket.html(data);
                ActiveDeleteButton();
            }
        );
    });

    //заказы
    var userOrder = $('#userOrders');
    function ActiveDeleteButtonOrder() {
        // Нажатие по кнопке удалить
        $('.user_order_delete').click(function () {
            var id = $(this).find('input').val();
            $(this).remove();
            $.post("/order_ajax.php",
                { act: "del", orderid: id },
                function (data) {
                    userOrder.html(data);
                    ActiveDeleteButtonOrder();
                }
            );
        });
    }
    function LoadOrders() {
        $.post("/order_ajax.php", function (data) {
            userOrder.html(data);
            ActiveDeleteButtonOrder();
        });
    }
    LoadOrders();

    $('.order_button_submit').click(function () {
        var orderForm = $(document.getElementById("order_form"));
        var inputData =document.querySelector('input[name="music_store"]:checked').value;
        if (orderForm.attr('newAdd') == 0)
            return;
            orderForm.attr('newAdd', "0");
        var id = inputData;
        setTimeout(function () {
            orderForm.attr('newAdd', "1");
        }, 2000);
        $.post("/order_ajax.php",
            { act: "add", store: id },
            function (data) {
                userOrder.html(data);
                ActiveDeleteButtonOrder();
            }
        );
        window.location.href="index.php";
    });
});