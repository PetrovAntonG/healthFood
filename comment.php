<?php
$nameComment = filter_input(INPUT_POST, 'nameComment', FILTER_SANITIZE_STRING);
$emailComment = filter_input(INPUT_POST, 'emailComment', FILTER_SANITIZE_EMAIL);
$commentComment = filter_input(INPUT_POST, 'commentComment', FILTER_SANITIZE_STRING);
$dateComment = date("Y-m-d H:i:s");


$linkComment = new mysqli('localhost:3306','u0651_root','mAsTEr081088','u0651369_healthfood');
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}
$linkComment->set_charset("utf8");
if($nameComment && $commentComment && $dateComment) {

    $queryComment= "INSERT INTO comment VALUES  (NULL, '$nameComment','$emailComment','$commentComment','$dateComment')";
    $stmt = $linkComment->stmt_init();
    if(!$stmt->prepare($queryComment)){
        print "Ошибка подготовки запроса\n";
    }
    else{
        $stmt->bind_param('ssss',$nameComment,$emailComment,$commentComment,$dateComment);
        $stmt->execute();
        $stmt->close();
    }

} 
$linkComment->close();


$linkCommentAdd = new mysqli('localhost:3306','u0651_root','mAsTEr081088','u0651369_healthfood');
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}
$linkCommentAdd->set_charset("utf8");
$queryCommentAddToPage = "SELECT dateComment,commentComment,nameComment FROM comment ORDER BY idComent DESC";

$stmt = $linkCommentAdd->stmt_init();
if(!$stmt->prepare($queryCommentAddToPage)){
    print "Ошибка подготовки запроса\n";
}
else{
    $stmt->execute();
    $resultComment = $stmt->get_result();
    $commentClient= mysqli_fetch_all($resultComment, MYSQLI_ASSOC);
    $stmt->close();
}
$linkCommentAdd->close();


if (!empty($_POST["nameComment"]) ) {
  header("Location: ".$_SERVER["REQUEST_URI"]);
  exit;
}
ob_end_flush();
?>

<div class = "comment">
<h2>Отзывы наших посетителей:</h2>
    <div class ="commentDesk">
        <table class = "commentTable">
            <tr>
            <th>Дата</th>
            <th>Отзыв</th>
            <th>Автор</th>
            </tr>
            <?php foreach($commentClient as $value){
                echo "<tr>";
                foreach($value as $key => $val){
                    echo "<td>$val</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class ="commentForm">
    <h2>Оставьте свой отзыв о нашем кафе:</h2>
        <form action = "" method = "post">
            <table class ="tableCom">
                <tr>
                    <td>Укажите Ваше имя:</td>
                    <td><input required type = "text" name = "nameComment"></td>
                </tr>
                <tr>
                    <td>Укажите Ваш e-mail:</td>
                    <td><input type = "email" name = "emailComment"></td>
                </tr>
                <tr>
                    <td colspan = "2">Ваш отзыв:</td>
                </tr>
                <tr>
                    <td colspan ="2"><textarea name = "commentComment" required></textarea></td>
                </tr>
                <tr>
                    <td><input type = "submit" name = "submitComment" value="Оставить отзыв" id = "submitComment"></td>
                    <td><input type = "reset" name = "resetComment" value = "Очистить форму" id ="resetComment"></td>
            </tr>
            </table>
        </form>
    </div>
</div>