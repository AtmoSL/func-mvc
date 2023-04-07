console.log('Я подключён (admin)');

const orderStatusSelectors = document.querySelectorAll(".order__selector");
const productDeleteBtns = document.querySelectorAll(".product__delete__btn")
const deleteAdminBtns = document.querySelectorAll(".users__admin__delete__btn");

/**
 * Смена статуса заказа
 */
orderStatusSelectors.forEach(function (orderStatusSelector) {
    orderStatusSelector.addEventListener('change', function (event) {
        console.log("Селектор изменён " + JSON.stringify({
            status_id: event.target.value,
        }))

        const data = new FormData()
        data.append("status_id", event.target.value);

        fetch(mainUrl + "orderapi/changestatus/" + event.target.id + "/", {
            method: 'POST',
            body: data
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                if (data === "3") {
                    document.getElementById('order-status-' + event.target.id).innerHTML = "Отменён";
                }
            });
    });
});


/**
 * Удаление товара
 */
productDeleteBtns.forEach(function (productDeleteBtn) {
    productDeleteBtn.addEventListener("click", function (event) {
        if (confirm("Вы точно хотите удалить товар №" + event.target.id + "?")) {
            fetch(mainUrl + "productapi/delete/" + event.target.id + "/")
                .then((response)=>response.json())
                .then((data)=>{
                    console.log(data);
                    document.getElementById("productRow-"+ event.target.id).remove();
                });
        }
    });
});

/**
 * Удаление администратора
 */
deleteAdminBtns.forEach(function (deleteAdminBtn){
    deleteAdminBtn.addEventListener("click",function (event){
        if(confirm("Вы точно хотите удалить администратора?")){
            fetch(mainUrl + "usersapi/deleteadmin/" + event.target.id +"/")
                .then((response)=>response.json())
                .then((data) =>{
                    console.log(data);
                    document.getElementById("adminRow-" + event.target.id).remove();
                });
        }
    });
});