<?php  
    $num =$_GET['number'];
?>
<main>
            <div class = "menuDiv">
                <?php 
                    foreach ($breakfast as $key => $value):
                ?>
                    <div class="food">
                        <table>
                            <tr>
                                <td colspan="2"><img class="image" src="img/<?=$breakfast[$key]["img"]?>.jpg" alt='<?=$breakfast[$key]["img"]?>'></td>
                            </tr>
                            <tr>
                                <td class ="name"><?=$breakfast[$key]["name"]?></td>
                                <td><a class = "orderLink" href="#">Заказать</a></td>
                            </tr>
                            <tr>
                                <td>Ккал:</td>
                                <td class = "calories"><?=$breakfast[$key]["calories"]?></td>
                            </tr>
                            <tr>
                                <td>Белки:</td>
                                <td class = "protein"><?=$breakfast[$key]["protein"]?> г</td>
                            </tr>
                            <tr>
                                <td>Жиры:</td>
                                <td class = "fat"><?=$breakfast[$key]["fat"]?> г</td>
                            </tr>
                            <tr>
                                <td>Углеводы:</td>
                                <td class = "carbohydrate"><?=$breakfast[$key]["carbohydrate"]?> г</td>
                            </tr>
                            <tr>
                                <td>Вес:</td>
                                <td>
                                    <form action="#">
                                        <input class = "weight" type="text" value="100">
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Цена:</td>
                                <td class = "price"><?=$breakfast[$key]["price"]?> руб.</td>
                            </tr>       
                        </table>
                    </div>
                <?php endforeach?>
            </div>

            <div class = "menuDiv">
                <?php 
                    foreach ($sidedishes as $key => $value):
                ?>
                    <div class="food">
                        <table>
                            <tr>
                                <td colspan="2"><img class="image" src="img/<?=$sidedishes[$key]["img"]?>.jpg" alt='<?=$sidedishes[$key]["img"]?>'></td>
                            </tr>
                            <tr>
                                <td class ="name"><?=$sidedishes[$key]["name"]?></td>
                                <td><a class = "orderLink" href="#">Заказать</a></td>
                            </tr>
                            <tr>
                                <td>Ккал:</td>
                                <td class = "calories"><?=$sidedishes[$key]["calories"]?></td>
                            </tr>
                            <tr>
                                <td>Белки:</td>
                                <td class = "protein"><?=$sidedishes[$key]["protein"]?> г</td>
                            </tr>
                            <tr>
                                <td>Жиры:</td>
                                <td class = "fat"><?=$sidedishes[$key]["fat"]?> г</td>
                            </tr>
                            <tr>
                                <td>Углеводы:</td>
                                <td class = "carbohydrate"><?=$sidedishes[$key]["carbohydrate"]?> г</td>
                            </tr>
                            <tr>
                                <td>Вес:</td>
                                <td>
                                    <form action="#">
                                        <input class = "weight" type="text" value="100">
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Цена:</td>
                                <td class = "price"><?=$sidedishes[$key]["price"]?> руб.</td>
                            </tr>       
                        </table>
                    </div>
                <?php endforeach?>
            </div>

            <div class = "menuDiv">
                <?php 
                    foreach ($fillers as $key => $value):
                ?>
                    <div class="food">
                        <table>
                            <tr>
                                <td colspan="2"><img class="image" src="img/<?=$fillers[$key]["img"]?>.jpg" alt='<?=$fillers[$key]["img"]?>'></td>
                            </tr>
                            <tr>
                                <td class ="name"><?=$fillers[$key]["name"]?></td>
                                <td><a class = "orderLink" href="#">Заказать</a></td>
                            </tr>
                            <tr>
                                <td>Ккал:</td>
                                <td class = "calories"><?=$fillers[$key]["calories"]?></td>
                            </tr>
                            <tr>
                                <td>Белки:</td>
                                <td class = "protein"><?=$fillers[$key]["protein"]?> г</td>
                            </tr>
                            <tr>
                                <td>Жиры:</td>
                                <td class = "fat"><?=$fillers[$key]["fat"]?> г</td>
                            </tr>
                            <tr>
                                <td>Углеводы:</td>
                                <td class = "carbohydrate"><?=$fillers[$key]["carbohydrate"]?> г</td>
                            </tr>
                            <tr>
                                <td>Вес:</td>
                                <td>
                                    <form action="#">
                                        <input class = "weight" type="text" value="100">
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Цена:</td>
                                <td class = "price"><?=$fillers[$key]["price"]?> руб.</td>
                            </tr>       
                        </table>
                    </div>
                <?php endforeach?>
            </div>

            <div class = "menuDiv">
                <?php 
                    foreach ($drinks as $key => $value):
                ?>
                    <div class="food">
                        <table>
                            <tr>
                                <td colspan="2"><img class="image" src="img/<?=$drinks[$key]["img"]?>.jpg" alt='<?=$drinks[$key]["img"]?>'></td>
                            </tr>
                            <tr>
                                <td class ="name"><?=$drinks[$key]["name"]?></td>
                                <td><a class = "orderLink" href="#">Заказать</a></td>
                            </tr>
                            <tr>
                                <td>Ккал:</td>
                                <td class = "calories"><?=$drinks[$key]["calories"]?></td>
                            </tr>
                            <tr>
                                <td>Белки:</td>
                                <td class = "protein"><?=$drinks[$key]["protein"]?> г</td>
                            </tr>
                            <tr>
                                <td>Жиры:</td>
                                <td class = "fat"><?=$drinks[$key]["fat"]?> г</td>
                            </tr>
                            <tr>
                                <td>Углеводы:</td>
                                <td class = "carbohydrate"><?=$drinks[$key]["carbohydrate"]?> г</td>
                            </tr>
                            <tr>
                                <td>Вес:</td>
                                <td>
                                    <form action="#">
                                        <input class = "weight" type="text" value="100">
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Цена:</td>
                                <td class = "price"><?=$drinks[$key]["price"]?> руб.</td>
                            </tr>       
                        </table>
                    </div>
                <?php endforeach?>
            </div>

<script>
    let num = <?=$num;?>;
</script>

        </main>

        <aside>
            <div class="order">
                <h2>Ваш заказ:</h2>
                <br>
                <table class = "tableOrder">
                    <tr>
                            <th colspan ="3" >Стоимость заказа:</th>
                            <th id ="priceOrder"></th>
                    </tr>
                            <th colspan ="3">Калорийность заказа:</th>
                            <th id = "caloriesOrder"></th>
                    </tr>
                    <tr>
                    <th colspan = "4">Состав заказа: </th>
                    </tr>
                    <tr>
                    <td>Наименование</td>
                    <td>Грамм</td>
                    <td>Цена</td>
                    <td></td>
                    </tr>
                </table>
            </div>
            
            <div class="checkout">
                <h4><a id = "confirmOrder" href="?link=order">Подтвердить заказ</a></h4>
                <br>
                <h4><a href="#" id="dellAllOrder">Очистить</a></h4>
            </div>
        </aside>
        <script src ='js/script.js'></script>
        