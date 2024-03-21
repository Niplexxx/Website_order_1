<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'my_bd';
$link = mysqli_connect($host, $user, $pass, $db_name);
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
}
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $message = $_POST['message'];
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO messages (id_user, text_messages) VALUES ('$user_id', '$message')";
        if(mysqli_query($link, $sql)) {
            header('Location: lk.php');
            exit;
        } else {
            echo 'Ошибка при отправке сообщения: ' . mysqli_error($link);
        }
    } else {
        echo 'Ошибка: ID пользователя не найден в сессии.';
    }
}
?>