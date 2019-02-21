
//Создаём кнопку удаления позиции заказа
function delIcon(elementTr){
    let elementTd = document.createElement('td');
    let elementA = document.createElement('a');
    elementA.setAttribute('href', '#');
    elementA.setAttribute('class', 'dell');
    let textA = document.createTextNode('Del');
    elementA.appendChild(textA);
    elementTd.appendChild(elementA);
    elementTr.appendChild(elementTd);
}

//Добавляем скрытый столбец таблицы с индексом элемента объекта для возможности последующего удаления элемента из объекта заказа
function hideIndex(elementTr,keyObj){
    let elementNubmerArr = document.createElement('td');
    elementNubmerArr.setAttribute('class', 'numberArrDell');
    elementNubmerArr.style.display = 'none';
    let textNumberArr = document.createTextNode(keyObj);
    elementNubmerArr.appendChild(textNumberArr);
    elementTr.appendChild(elementNubmerArr);
}

// Функция удаления позиций заказа
function dellPos(tableOrder){

    let numberArrDell = this.parentElement.nextSibling;
    let dellArr = numberArrDell.textContent;
    parentTd = this.parentElement.parentElement;
    tableOrder.removeChild(parentTd);
    orderArr[dellArr] = {};
    // Считаем стоимость заказа и его калорийность
    countPriceCall();
  // Очистка заказа при удалении всех позиций
    let arrLength = Object.keys(orderArr).length,
    countArr = 0;
    for(let i = 0; i < arrLength; i++){
        countArr += Object.keys(orderArr[i]).length;
    }
    console.log(countArr);
    if(countArr == 0) {
        orderArr={};
        orderClear();
    }
}

//Запись объекта заказа в память браузера пользователя
function conf(){
    var serialOrderArr = JSON.stringify(orderArr);
    localStorage.setItem("order", serialOrderArr);
}

// Считаем стоимость заказа и его калорийность
let orderArrLength,
    priceOrder,
    caloriesOrder;

function countPriceCall(){
    orderArrLength = Object.keys(orderArr).length;
    priceOrder = 0;
    caloriesOrder = 0;
    for(let g = 0; g < orderArrLength; g++) {
        if(orderArr[g].price != null){
            priceOrder = priceOrder + orderArr[g].price;
        }
    }
    priceOrder = priceOrder.toFixed(2);       
    for(let g = 0; g < orderArrLength; g++) {
        if(orderArr[g].price != null){
            caloriesOrder = caloriesOrder + orderArr[g].calories;
        }
    }
    caloriesOrder = caloriesOrder.toFixed(2);
}

//Отрисовка суммы калорий и цены заказа 
function drawOrderTable(table,a){
    var elementTrCall = document.createElement('tr');
    elementTrCall.setAttribute('class', 'trOrderCall');
    var elementTdCall = document.createElement('td');
    elementTdCall.setAttribute('colspan',a);
    var textTdCall= document.createTextNode(`Калорийнойсть заказа составит: ${caloriesOrder} ккал`);
    elementTdCall.appendChild(textTdCall);
    elementTrCall.appendChild(elementTdCall);
    table.insertBefore(elementTrCall,table.children[1]);

    var elementTrPrice = document.createElement('tr');
    elementTrPrice.setAttribute('class', 'trOrderPrice');
    var elementTdPrice = document.createElement('td');
    elementTdPrice.setAttribute('colspan',a);
    var textTdPrice= document.createTextNode(`Стоимость заказа составит: ${priceOrder} руб.`);
    elementTdPrice.appendChild(textTdPrice);
    elementTrPrice.appendChild(elementTdPrice);
    table.insertBefore(elementTrPrice,table.children[2]);
}
//Обновление стоимости и цены заказа
function refreshCallPriceForOrder(table,a){
    var trCall = document.querySelector(".trOrderCall");
    var trPrice = document.querySelector(".trOrderPrice");
    trCall.remove();
    trPrice.remove();
    drawOrderTable(table,a);
}


function setCookie(name, value, options) {
    options = options || {};
  
    var expires = options.expires;
  
    if (typeof expires == "number" && expires) {
      var d = new Date();
      d.setTime(d.getTime() + expires * 1000);
      expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
      options.expires = expires.toUTCString();
    }
  
    value = encodeURIComponent(value);
  
    var updatedCookie = name + "=" + value;
  
    for (var propName in options) {
      updatedCookie += "; " + propName;
      var propValue = options[propName];
      if (propValue !== true) {
        updatedCookie += "=" + propValue;
      }
    }
  
    document.cookie = updatedCookie;
  }


// Очистка заказа
function orderClear() {
    setCookie('order', "", {
        expires: -1});
    localStorage.clear();
    window.location.reload();
}