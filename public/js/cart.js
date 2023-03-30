console.log('Я подключён');

let cartButtons = document.querySelectorAll(".catalog__card__button"); //Получение всех кнопок "В корзину"

/**
 * Считывание клика на кнопку "В корзину"
 */
cartButtons.forEach(function (cartButton) {
    cartButton.addEventListener("click", function (event) {
        console.log("Ты нажал на кнопку В корзину товара с id " + event.target.id);
    });
});

