console.log('Я подключён');

let cartButtons = document.querySelectorAll(".catalog__card__button");

cartButtons.forEach(function (cartButton) {
    cartButton.addEventListener("click", function (event) {
        console.log("Ты нажал на кнопку В корзину товара с id " + event.target.id);
    });
});

