const inputWeight = document.querySelectorAll(".weight");
const name = document.querySelectorAll(".name");
const calories = document.querySelectorAll(".calories");
const protein = document.querySelectorAll(".protein");
const fat = document.querySelectorAll(".fat");
const carbohydrate = document.querySelectorAll(".carbohydrate");
const price = document.querySelectorAll(".price");

const orderLink = document.querySelectorAll(".orderLink");

const tableOrder = document.querySelector(".tableOrder");

const priceOrderElem = document.querySelector("#priceOrder");
const caloriesOrderElem = document.querySelector("#caloriesOrder");

const dellAllOrder = document.querySelector("#dellAllOrder");

document.addEventListener('DOMContentLoaded', orderTable);

//Объявляем объект -заказ пользователя и счетчик для объекта
let orderArr = {};
counter.counter = 0;
if(localStorage.getItem("order")!=null){
    orderArr = JSON.parse(localStorage.getItem("order"));
    counter.counter = Object.keys(orderArr).length;
}

//Меняет данные в зависимости от заданного пользователем веса продукта
let inputWeightNowValue  = 0;
for(let i = 0; i < inputWeight.length; i++) {

    inputWeight[i].addEventListener('focus',     
    //Сохранаяем текущее значение веса продукта
    function(){
        inputWeightNowValue = inputWeight[i].value;
        return inputWeightNowValue;
    });
    inputWeight[i].addEventListener('change',     
    //Высчитываем параметры по продукту исходя из веса продукта, указанного пользователем
    function(){
        if(1*inputWeight[i].value ==0){
            alert("Укажите вес продукта отличный от '0'");
            inputWeight[i].value = 100;
        }
        if(isNaN(1*inputWeight[i].value)){
            alert("Укажите корректный вес продукта");
            inputWeight[i].value = 100;
     }
        let caloriesText = calories[i].textContent;
        let caloriesNew = (caloriesText/inputWeightNowValue)*inputWeight[i].value;
        calories[i].textContent = caloriesNew.toFixed(2);

        let proteinText = protein[i].textContent;
        proteinText = parseFloat(proteinText);
        let proteinNew = (proteinText/inputWeightNowValue)*inputWeight[i].value;
        protein[i].textContent =proteinNew.toFixed(2) + " г";

        let fatText = fat[i].textContent;
        fatText = parseFloat(fatText);
        let fatNew = (fatText/inputWeightNowValue)*inputWeight[i].value;
        fat[i].textContent = fatNew.toFixed(2) + " г";
        
        let carbohydrateText = carbohydrate[i].textContent;
        carbohydrateText = parseFloat(carbohydrateText);
        let carbohydrateNew = (carbohydrateText/inputWeightNowValue)*inputWeight[i].value;
        carbohydrate[i].textContent = carbohydrateNew.toFixed(2) + " г";
        
        let priceText = price[i].textContent;
        priceText = parseFloat(priceText);
        let priceNew = (priceText/inputWeightNowValue)*inputWeight[i].value;
        price[i].textContent = priceNew.toFixed(2) + " руб.";
    });

}

let arrElements = ['name','inputWeight','price'];

//Устанавлтваем обработчики событий на элементы 
for(let i = 0; i < inputWeight.length; i++){
    orderLink[i].addEventListener('click',
    // Формируем объект с данными заказа
    function (ev){
        ev.preventDefault();
        orderArr[counter.counter] = {};
            orderArr[counter.counter].name = name[i].textContent;
            orderArr[counter.counter].calories = parseFloat(calories[i].textContent);
            orderArr[counter.counter].protein = parseFloat(protein[i].textContent);
            orderArr[counter.counter].fat = parseFloat(fat[i].textContent);
            orderArr[counter.counter].carbohydrate = parseFloat(carbohydrate[i].textContent);
            orderArr[counter.counter].inputWeight = parseFloat(inputWeight[i].value);
            orderArr[counter.counter].price = parseFloat(price[i].textContent);
    });
    orderLink[i].addEventListener('click',counter);
    orderLink[i].addEventListener('click',orderTable);
    orderLink[i].addEventListener('click',conf);

}

//Отрисовываем текущий заказ на странице
function orderTable(){
    let trOrder = document.querySelectorAll('.trOrder');
    for(let i = 0; i < trOrder.length; i++){
        trOrder[i].remove();
    }
    for (let keyObj in orderArr){
        if(orderArr[keyObj].price != null){
            let elementTr = document.createElement('tr');
            elementTr.setAttribute('class', 'trOrder');
            for(let j=0; j < arrElements.length; j++){
                let elementTd = document.createElement('td');
                let elem = arrElements[j];
                let textTd = document.createTextNode(orderArr[keyObj][elem]);
                elementTd.appendChild(textTd);
                elementTr.appendChild(elementTd);
            }

            //Создаём кнопку удаления позиции заказа
            delIcon(elementTr);
            //Добавляем скрытый столбец таблицы с индексом элемента объекта для возможности последующего удаления элемента из объекта заказа
            hideIndex(elementTr,keyObj);
    
            tableOrder.appendChild(elementTr);
            // Считаем стоимость заказа и его калорийность
            countPriceCall();
            // Добавляем стоимость заказа и его калорийность
            priceOrderElem.textContent = priceOrder + " руб.";
            caloriesOrderElem.textContent = caloriesOrder;
        }
    }
     // Добавляем возможность удаления позиции из заказа
    let dell = document.querySelectorAll(".dell");
            
     for(let i = 0; i < dell.length; i++) {
        dell[i].addEventListener('click',dellPos.bind(dell[i],tableOrder));
        dell[i].addEventListener('click',conf);
        dell[i].addEventListener('click',addPriceCall);
    }
}
    
    // Добавляем стоимость заказа и его калорийность
    function addPriceCall(){  
    priceOrderElem.textContent = priceOrder + " руб.";
    caloriesOrderElem.textContent = caloriesOrder;
    }

//Функция счётчик для объекта заказа
function counter(){
counter.counter++;
}


//Очистка всего заказа
dellAllOrder.addEventListener('click',dellOrder);
function dellOrder(){
    orderArr = {};
    counter.counter = 0;
    let trOrder = document.querySelectorAll('.trOrder');
     for(let i = 0; i < trOrder.length; i++){
         trOrder[i].remove();
     }
     priceOrder = 0;
     caloriesOrder = 0;
     priceOrderElem.textContent = '';
     caloriesOrderElem.textContent = '';
     localStorage.clear()
}

// Организация работы меню

let tab = document.querySelectorAll('.menuTab'),
    submenu = document.querySelector(".submenu-link"),
    info = document.querySelector('.submenu'),
    tabContent = document.querySelectorAll('.menuDiv');
//Отмена переподключения файла при работе в меню
submenu.addEventListener('click',prevDef);
    function prevDef(ev){
        ev.preventDefault();
    }

function hideTabContent(a) {
    for(let i = a; i < tabContent.length; i++) {
        tabContent[i].classList.remove('show');
        tabContent[i].classList.add('hide');
    }
}

hideTabContent(0);

function showTabContent(b) {
    if(tabContent[b].classList.contains('hide')) {
        tabContent[b].classList.remove('hide');
        tabContent[b].classList.add('show');  
    }
}
showTabContent(num);
info.addEventListener('click', function(event){
    event.preventDefault();
    let target = event.target;
if(target && target.classList.contains('menuTab')) {
    for(let i = 0; i < tab.length; i++) {
        if (target == tab[i]) {
            hideTabContent(0);
            showTabContent(i);
            break;
        }
    }
}
});

//Подтверждение заказа и сохранение в локальную память браузера
const confirmOrder = document.querySelector("#confirmOrder");
confirmOrder.addEventListener('click',conf);
conf();
