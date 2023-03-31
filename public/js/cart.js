console.log('Я подключён');
const mainUrl = "http://func-mvc/";
const cartCounter = document.getElementById('#cartCounter');
const cartDeleteButtons =  document.querySelectorAll(".order__card__delete");
let cartButtons = document.querySelectorAll(".catalog__card__button"); //Получение всех кнопок "В корзину"

/**
 * Добавление товара в корзину
 */
cartButtons.forEach(function (cartButton) {
    cartButton.addEventListener("click", function (event) {
        console.log("Ты нажал на кнопку В корзину товара с id " );
        fetch(mainUrl+"cart/addtocart/" + event.target.id +"/", {
            method: 'GET'
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                cartCounter.textContent = "("+data+")";
            });
    });
});

/**
 * Удаление товара из корзины
 *
 *
 */
cartDeleteButtons.forEach(function (cartDeleteButton){
   cartDeleteButton.addEventListener("click", function (event){
       console.log("Удаление товара c id "+ event.target.id);
       fetch(mainUrl + "cart/deletefromcart/" + event.target.id + "/")
           .then((response) => response.json())
           .then((data) => {
               cartCounter.textContent = "("+data+")";
               document.getElementById("cartCard-"+event.target.id).remove();
               if(!data){
                   cartCounter.textContent = "";
               }
           });
   });
});