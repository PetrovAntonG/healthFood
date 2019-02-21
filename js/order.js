//Получаем массив заказа из меню
let orderArr = JSON.parse(localStorage.getItem("order"));

const orderMenu = document.querySelector(".orderMenu");
document.addEventListener('DOMContentLoaded', orderFunc);



//Отрисовываем таблицу заказа
function orderFunc() {
    if(orderArr){
            let n = 0;
            //Добавляем в таблицу счетчик по цене и калориям
            // countPriceCall();
            // drawOrderTable(orderMenu,9);
            for (let keyObj in orderArr){
                if(orderArr[keyObj].price != null){
                    var elementTrOrder = document.createElement('tr');
                    elementTrOrder.setAttribute('class', 'trOrderMenu');
                    var elementTdOrder = document.createElement('td');
                    n ++;
                    var textTdOrder = document.createTextNode(n);
                    elementTdOrder.appendChild(textTdOrder);
                    elementTrOrder.appendChild(elementTdOrder);
                    for(let key in orderArr[keyObj]){
                        var elementTdOrder = document.createElement('td');
                        var textTdOrder = document.createTextNode(orderArr[keyObj][key]);
                        elementTdOrder.appendChild(textTdOrder);
                        elementTrOrder.appendChild(elementTdOrder);
                    }
                    delIcon(elementTrOrder);
                    hideIndex(elementTrOrder,keyObj);
                    orderMenu.appendChild(elementTrOrder);
                }
            }

            countPriceCall();
            drawOrderTable(orderMenu,9);

            // Добавляем возможность удаления позиции из заказа
            let dell = document.querySelectorAll(".dell");
            for(let i = 0; i < dell.length; i++) {
                dell[i].addEventListener('click',dellPos.bind(dell[i],orderMenu));
                dell[i].addEventListener('click',conf);
                dell[i].addEventListener('click',refreshCallPriceForOrder.bind(this,orderMenu,9));
                
            }
        }
}

let submit = document.querySelector("#submit");
submit.addEventListener('click',set);
let reset = document.querySelector("#reset");
reset.addEventListener('click',orderClear);

//Устанавливаем cookie для передачи данных заказа в php
function set(){
        let OrderEncode = encodeURI(JSON.stringify(orderArr));
        document.cookie = `order = ${OrderEncode}`;
}

// Отобраение таблицы заказа или информацию о заказе
let tablePage = document.querySelector(".tablePage"),
    textOrder = document.querySelector(".textOrder");
    notOrder = document.querySelector(".notOrder");

if((!Boolean(orderArr) || Object.keys(orderArr).length ==0) && !id){  
    notOrder.classList.remove('hide');
    notOrder.classList.add('show'); 
    textOrder.classList.remove('show');
    textOrder.classList.add('hide');
    tablePage.classList.remove('show');
    tablePage.classList.add('hide');
}else if(id) {
        textOrder.classList.remove('hide');
        textOrder.classList.add('show');
        tablePage.classList.remove('show');
        tablePage.classList.add('hide');
        notOrder.classList.remove('show');
        notOrder.classList.add('hide');
    } else {
        textOrder.classList.remove('show');
        textOrder.classList.add('hide');
        tablePage.classList.remove('hide');
        tablePage.classList.add('show'); 
        notOrder.classList.remove('show');
        notOrder.classList.add('hide');  
    }
