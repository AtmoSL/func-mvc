console.log('Я подключён (admin)');

const orderStatusSelectors = document.querySelectorAll(".order__selector");


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
                if(data === "3"){
                    document.getElementById('order-status-'+ event.target.id).innerHTML = "Отменён";
                }
            });
    });
});
