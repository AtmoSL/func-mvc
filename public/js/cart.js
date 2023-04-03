console.log('Я подключён');
const mainUrl = "http://func-mvc/";
const cartCounter = document.getElementById('#cartCounter'); //Счётчик товаров в корзине
const cartDeleteButtons = document.querySelectorAll(".order__card__delete"); //Получение всех кнопок "Удалить" в корзине
const cartButtons = document.querySelectorAll(".catalog__card__button"); //Получение всех кнопок "В корзину"
const cartMinusButtons = document.querySelectorAll(".order__card__count__minus"); // Кнопка уменьшения кол-ва товаров
const cartPlusButtons = document.querySelectorAll(".order__card__count__plus"); //Кнопка увеличения кол-ва товаров
const makeOrderButton = document.getElementById("makeOrderButton");
const cartMessage = document.createElement("div");
/**
 * Добавление товара в корзину
 */
cartButtons.forEach(function (cartButton) {
    cartButton.addEventListener("click", function (event) {
        console.log("Ты нажал на кнопку В корзину товара с id ");
        fetch(mainUrl + "cart/addtocart/" + event.target.id + "/")
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                cartCounter.textContent = "(" + data + ")";
            });
    });
});

/**
 * Удаление товара из корзины
 */
cartDeleteButtons.forEach(function (cartDeleteButton) {
    cartDeleteButton.addEventListener("click", function (event) {
        console.log("Удаление товара c id " + event.target.id);
        fetch(mainUrl + "cart/deletefromcart/" + event.target.id + "/")
            .then((response) => response.json())
            .then((data) => deleteProductFromCart(data, event));
    });
});

/**
 * Уменьшшение количества товаров
 */
cartPlusButtons.forEach(function (cartPlusButton) {
    cartPlusButton.addEventListener("click", function (event) {
        console.log("Увелиечение кол-ва товара c id " + event.target.id);
        fetch(mainUrl + "cart/pluscart/" + event.target.id + "/")
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                document.getElementById("productCountText-" + event.target.id).textContent = data["productCount"] + " шт.";
                cartCounter.textContent = "(" + data["count"] + ")";
            });
    });
});

/**
 * Увеличение количества товаров
 */
cartMinusButtons.forEach(function (cartMinusButton) {
    cartMinusButton.addEventListener("click", function (event) {
        console.log("Уменьшение кол-ва товара c id " + event.target.id);
        fetch(mainUrl + "cart/minusfromcart/" + event.target.id + "/")
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                if (data["productCount"] === 0) {
                    deleteProductFromCart(data["count"], event)
                } else {
                    document.getElementById("productCountText-" + event.target.id).textContent = data["productCount"] + " шт.";
                    cartCounter.textContent = "(" + data["count"] + ")";
                }
            });
    });
});

/**
 * Функция изменения HTML при полном удалении товара/товаров
 * @param data
 * @param event
 */
function deleteProductFromCart(data, event) {
    cartCounter.textContent = "(" + data + ")";
    document.getElementById("cartCard-" + event.target.id).remove();
    document.getElementById("orderSeparator-" + event.target.id).remove();
    if (!data) {
        cartCounter.textContent = "";
        makeOrderButton.remove();
        cartMessage.className = "order__message";
        cartMessage.innerHTML = "Корзина пуста";
        document.getElementById("orderInner").append(cartMessage);
    }
}