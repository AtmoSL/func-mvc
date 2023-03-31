console.log('Я подключён');
const mainUrl = "http://func-mvc/";

let cartButtons = document.querySelectorAll(".catalog__card__button"); //Получение всех кнопок "В корзину"

/**
 * Считывание клика на кнопку "В корзину"
 */
cartButtons.forEach(function (cartButton) {
    cartButton.addEventListener("click", function (event) {
        console.log("Ты нажал на кнопку В корзину товара с id " );
        fetch(mainUrl+"cart/addtocart/" + event.target.id +"/", {
            method: 'GET'
        })
            .then((response) => console.log(response.json()))
            .then((data) => {
                console.log(data);
            });
    });
});
