let newsView = document.querySelectorAll(".newsView");

//Смена блоков рекомендаций
function hideTabContent(a) {
    for(let i = a; i < newsView.length; i++) {
        newsView[i].classList.remove('show');
        newsView[i].classList.add('hide');
    }
}

hideTabContent(1);

function showTabContent(b) {
    if(newsView[b].classList.contains('hide')) {
        newsView[b].classList.remove('hide');
        newsView[b].classList.add('show');  
    }
}

let i = 1;
        var timer1 = setInterval(function() {  
            hideTabContent(0);
            showTabContent(i);
            if(i == 2){
                i = 0;
            } else i++;
    }, 10800);


//Имитация вызова официанта
let waiter = document.querySelector(".waiter");
waiter.addEventListener('click',wait);
function wait(){
    alert("Официант подойдет к Вам в течении 5 минут");
}




