<?php 

$nameClient = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$tableClient = filter_input(INPUT_POST, 'table', FILTER_SANITIZE_NUMBER_INT);
$people = filter_input(INPUT_POST, 'people', FILTER_SANITIZE_NUMBER_INT);
$paymentMethod = filter_input(INPUT_POST, 'payVariant', FILTER_SANITIZE_STRING);
$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);


if(!empty($nameClient) && $tableClient != "Выберите столик" && ($paymentMethod == "card" || $paymentMethod == "cash")) {
    if($_COOKIE['order']){ 
        $orderArr = json_decode($_COOKIE['order'], true);
        foreach ($orderArr as $key => $value) {
            if($value){
                ++$i;
                $orderText = "$i) Наименование: $value[name], количество: $value[inputWeight] гр., цена: $value[price] руб.";
                $orderTextAll .= $orderText;
                $orderPrice += $value['price'];
            };
        };
        $dateOrder = date("Y-m-d H:i:s");

        $linkOrder = new mysqli('localhost:3306','u0651_root','mAsTEr081088','u0651369_healthfood');
        if (mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s\n", mysqli_connect_error());
            exit();
        }
        $linkOrder->set_charset("utf8");
        $queryOrder = "INSERT INTO orderList VALUES  (NULL,?,?,?,?,?,?,?,?)";
        $stmt = $linkOrder->stmt_init();
        if(!$stmt->prepare($queryOrder)){
            print "Ошибка подготовки запроса\n";
        }
        else{
            $stmt->bind_param('sdsiisss',$orderTextAll,$orderPrice,$nameClient,$tableClient,$people,$paymentMethod,$comment,$dateOrder);
            $stmt->execute();
            $stmt->close();
        }

        $linkOrder->close();


        $linkOrderCl = new mysqli('localhost:3306','u0651_root','mAsTEr081088','u0651369_healthfood');
        if (mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s\n", mysqli_connect_error());
            exit();
        }
        $linkOrderCl->set_charset("utf8");
        $queryOrderForClient = "SELECT id FROM orderList WHERE dateOrder = ?";
        $stmt = $linkOrderCl->stmt_init();
        if(!$stmt->prepare($queryOrderForClient)){
            print "Ошибка подготовки запроса\n";
        }
        else{
            $stmt->bind_param('s',$dateOrder);
            $stmt->execute();
            $resultClient = $stmt->get_result();
            $orderForClient = mysqli_fetch_array($resultClient, MYSQLI_ASSOC );
            $stmt->close();
        }

        $linkOrderCl->close();
//Очищаем данные по заказу
        echo "<script>   function deleteCookie() {
            setCookie('order', '', {
                expires: -1})
        };
        deleteCookie();
        localStorage.clear();
        </script>";

    }

} 

?>

<script>
    let id = '<?= $orderForClient['id'];?>';
</script>


<div class = "tablePage">
    <div class = "tableA">
        <table class = "orderMenu">
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Калорийность</th>
                <th>Белки</th>
                <th>Жиры</th>
                <th>Углеводы</th>
                <th>Количество</th>
                <th>Цена</th>
                <th></th>
            </tr>
        </table>
    </div>
    <div class = "formPage">
        <form action = "" method = "post">
            <table class = "formTable">
            <tr>
                <td>Укажите Ваше имя:</td>
                <td><input required type = "text" name = "name"></td>
            </tr>
            <tr>
                <td>Укажите номер Вашего столика:</td>
                <td>
                    <select name = "table" id ="table" required>
                    <option disabled selected value>Выберите столик</option>
                        <?php
                        for($i =1; $i < 19; $i++){
                            echo"<option>$i</option>";
                        }
                        ?>
                    </select>
            </td>
            </tr>
            <tr>
                <td>Укажите количество персон:</td>
                <td>
                    <select name = "people">
                        <?php
                        for($i =1; $i < 11; $i++){
                            echo"<option>$i</option>";
                        }
                        ?>
                    </select>
            </td>
            </tr>
            <tr>
                <td rowspan = "2">Выберите способ оплаты:</td>
                <td>
                   <input required class = "radio" id="radio1" type = "radio" name = "payVariant" value = "card">
                   <label for="radio1">Банковской картой</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input required class = "radio" id="radio2" type = "radio" name = "payVariant" value = "cash">
                    <label for="radio2">Наличными</label>
                </td>
            </tr>
            <tr>
                <td colspan = "2">Комментарии к заказу:</td>
            </tr>
            <tr>
                <td colspan ="2"><textarea name = "comment"></textarea></td>
            </tr>
            <tr>
                <td><input type = "submit" name = "submit" value="Подтвердить заказ" id = "submit"></td>
                <td><input type = "reset" name = "reset" value = "Очистить заказ" id ="reset"></td>
            </tr>
            
            
            </table>
        </form>
    </div>
</div>

<div class = "textOrder">
    <div class = "textShadow">
        <p>Заказ принят: <?=$dateOrder?></p>
        <p>Номер Вашего заказа: <?=$orderForClient['id']?></p>
        <p>Заказ будет готов в течении 15 минут</p>
        <p>Общая стоимость заказа: <?=$orderPrice?> руб.</p>
        <p id = "taste">Приятного аппетита!</p>
      </div>
</div>

<div class = "notOrder">
    <h3>К сожалению Вы ещё не выбрали ни одной позиции для заказа!</h3>
    <img src = "/img/notOrder3.jpg" alt = "Not order">
    <h3>Но Вы можете это сделать в любой момент в разделе <a href = "?link=menu&number=0"><span>меню</span></a> нашего сайта.</h3>
</div>

<script src ='js/order.js'></script>






