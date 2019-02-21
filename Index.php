<?php
ob_start();

// Формируем меню из базы данных
$link = new mysqli('localhost:3306','u0651_root','mAsTEr081088','u0651369_healthfood');
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}
$link->set_charset("utf8");
$query = "SELECT * FROM sidedishes" ;
$stmt = $link->stmt_init();
if(!$stmt->prepare($query)){
    print "Ошибка подготовки запроса\n";
}
else{  
    $stmt->execute();
    $result = $stmt->get_result();
    $sidedishes = mysqli_fetch_all($result, MYSQLI_ASSOC );
    $stmt->close();
}

$queryBr = "SELECT * FROM breakfast" ;
$stmt = $link->stmt_init();
if(!$stmt->prepare($queryBr)){
    print "Ошибка подготовки запроса\n";
}
else{  
    $stmt->execute();
    $resultBr = $stmt->get_result();
    $breakfast = mysqli_fetch_all($resultBr, MYSQLI_ASSOC );
    $stmt->close();
}

$queryFl = "SELECT * FROM fillers" ;
$stmt = $link->stmt_init();
if(!$stmt->prepare($queryFl)){
    print "Ошибка подготовки запроса\n";
}
else{  
    $stmt->execute();
    $resultFl = $stmt->get_result();
    $fillers = mysqli_fetch_all($resultFl, MYSQLI_ASSOC );
    $stmt->close();
}

$queryDr = "SELECT * FROM drinks" ;
$stmt = $link->stmt_init();
if(!$stmt->prepare($queryDr)){
    print "Ошибка подготовки запроса\n";
}
else{  
    $stmt->execute();
    $resultDr = $stmt->get_result();
    $drinks = mysqli_fetch_all($resultDr, MYSQLI_ASSOC );
    $stmt->close();
}

$link->close();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HealthFood</title>
    <link rel="stylesheet" href="style.css">
    <script src ='js/func.js'></script>
</head>
<body>
    <header>
        
        <h1>HealthFood</h1>
    </header>

    <nav>
        <ul class ="topmenu">
            <li><a href="?link=main">Главная</a></li>
            <li><a class ='submenu-link' href="?link=menu&number=0">Меню</a>
            
                <ul class = "submenu">
                    <li><a href="?link=menu&number=0" class = "menuTab">Завтраки</a></li>
                    <li><a href="?link=menu&number=1" class = "menuTab">Гарниры</a></li>
                    <li><a href="?link=menu&number=2" class = "menuTab">Наполнители</a></li>
                    <li><a href="?link=menu&number=3" class = "menuTab">Напитки</a></li>
                </ul>

            </li>
            <li><a href="?link=order">Ваш заказ</a></li>
            <li><a href="?link=about">О проекте</a></li>
            <li><a href="?link=comment">Отзывы</a></li>
            <li><a href="?link=contact">Контакты</a></li>
        </ul>
    </nav>
    <div class="content">
        <?php 
        if ($_GET["link"] == "order") {
            require_once("order.php");
        }
        if ($_GET["link"] == "menu") {
            require_once("menu.php");
        }
        if ($_GET["link"] == "contact") {
            require_once("contact.php");
        }
        if ($_GET["link"] == "comment") {
            require_once("comment.php");
        }
        if ($_GET["link"] == "about") {
            require_once("about.php");
        }
        if ($_GET["link"] == "main" || !$_GET["link"]) {
            require_once("main.php");
        }
        ?>
    </div>
    <footer>
        <div id ="foot">
            <h4>
                Этот проект не является реальным сайтом кафе, а лишь демонстрирует мою работу, как web-программиста и концепцию проекта HealthFood.
                Подробнее об этом вы можете прочитать в разделе <a href="?link=about">О проекте</a> A.Petrov 2019.
            </h4>
        </div>
    </footer>
    
</body>
</html>