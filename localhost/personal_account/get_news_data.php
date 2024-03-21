<?php
// Подключение к базе данных
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'my_bd';
$link = mysqli_connect($host, $user, $pass, $db_name);
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
}

$newsId = $_POST['news_id'];

// Запрос к базе данных для получения данных о выбранной новости
$sql = "SELECT date, time, price FROM news WHERE id = $newsId";
$result = mysqli_query($link, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $data = [
        'date' => $row['date'],
        'time' => $row['time'],
        'price' => $row['price']
    ];

    // Отправляем данные в формате JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Если не удалось получить данные, возвращаем сообщение об ошибке
    $data = [
        'error' => 'Ошибка при получении данных о билетах'
    ];
    header('Content-Type: application/json');
    echo json_encode($data);
}
?>