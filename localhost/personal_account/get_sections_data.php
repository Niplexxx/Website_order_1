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
    $sectionId = $_POST['sections_id'];
    $sql = "SELECT price FROM sectionnews WHERE id = $sectionId";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $data = [
            'price' => $row['price']
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        $data = [
            'error' => 'Ошибка при получении данных о секции'
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }
?>