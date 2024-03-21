<?php
    session_start();
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'my_bd';
    $link = mysqli_connect($host, $user, $pass, $db_name);
    if (!$link) {
        echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
        exit;
    }
    $user_id = $_SESSION['user_id'];
    $sql_alter = "ALTER TABLE tickets ADD total_price DECIMAL(10,2)";
    mysqli_query($link, $sql_alter);

    if (isset($_POST['tickets'])) {
        $news_id = $_POST['news_id'];
        $ticket_date = $_POST['ticket_date'];
        $ticket_time = $_POST['ticket_time'];
        $ticket_price = $_POST['ticket_price'];
        $quantity = $_POST['quantity'];
        $place = $_POST['place'];
        $user_id = $_POST['user_id'];
        $total_price = $ticket_price * $quantity;
        $sql = "INSERT INTO tickets (news_id, ticket_date, ticket_time, total_price, quantity, place, user_id, ticket_price) VALUES ('$news_id', '$ticket_date', '$ticket_time', '$total_price', '$quantity', '$place', '$user_id', '$ticket_price')";
        if(mysqli_query($link, $sql)) {
            header('Location: lk.php');
            exit;
        } else {
            echo 'Ошибка при добавлении данных: ' . mysqli_error($link);
        }
    }
?>

<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>.ICaST</title>
    <link rel="icon" type="image/x-icon" href="\img_site\icon.png">
</head>
<body style="background: #021333; font-family: 'Inter', sans-serif;">
    <header class="py-3 border-bottom border-info" style="background: #021333;">
        <nav class="container">
            <div class="container text-center">
                <div class="row align-items-center">
                    <div class="col-sm-3 p-1 col-md-4 ms-auto">
                        <div class="container-fluid my-class" style="background: linear-gradient(to right, #00C2FF, 15%, #021333); border-radius: 23px; height: 40px; width: 50%; margin-right: 100%;">
                            <a href="\index.php" class="nav-link link-dark text-start" style="color: #FFFFFF; font-size: 18px;">.ICaST</a>
                        </div>
                    </div>
                    <div class="col">
                        <a href="" class="nav-link link-dark fs-6" style="color: #FFFFFF;">МЕРОПРИЯТИЯ</a>
                    </div>
                    <div class="col">
                        <a href="\aboutus.php" class="nav-link link-dark fs-6" style="color: #FFFFFF;">О НАС</a>
                    </div>
                    <div class="col">
                        <a href="\personal_account\sections.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link link-dark fs-6" style="color: #FFFFFF;">СЕКЦИИ</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <article>
    <div class="position-relative overflow-hidden text-center d-flex align-items-center justify-content-center mt-1" style="background-image: url('/img_site/background1.png'); background-size: cover; background-position: center; height: 83vh;">
    <div class="col-5 mt-1 mb-3" style="background: #021333; opacity: 0.89; border-radius: 23px;">
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
                $sql_news = "SELECT id, title FROM news";
                $result_news = mysqli_query($link, $sql_news);
                $news_data = mysqli_fetch_all($result_news, MYSQLI_ASSOC);
                ?>
                <form id="ticketForm" method="post">
                    <label for="news_id" class="form-label" style="color: white">Выберите билет</label>
                    <select class="form-select" name="news_id" id="news_id" required>
                        <?php
                        foreach ($news_data as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="date" class="form-label" style="color: white">Дата:</label>
                    <input type="text" name="ticket_date" id="ticket_date" readonly>
                    <label for="time" class="form-label" style="color: white">Время:</label>
                    <input type="text" name="ticket_time" id="ticket_time" readonly>
                    <label for="price" class="form-label" style="color: white">Цена:</label>
                    <input type="text" name="ticket_price" id="ticket_price" readonly>
                    <label for="quantity" class="form-label" style="color: white">Количество билетов</label>
                    <select class="form-select" name="quantity" id="quantity" required>
                    <?php
                        for ($i = 1; $i <= 100; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <label for="place" class="form-label" style="color: white">Место:</label>
                    <select class="form-select" name="place" id="place" required>
                        <?php
                        for ($i = 1; $i <= 100; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <button type="submit" name="tickets" class="w-100 btn btn-outline-dark btn-lg" style="color: white">Заказать билет</button>
                </form>
                <script>
                    // AJAX запрос для загрузки данных о новости при выборе
                    document.getElementById('news_id').addEventListener('change', function() {
                        var newsId = this.value;
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '/personal_account/get_news_data.php');
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);
                                document.getElementById('ticket_date').value = data.date;
                                document.getElementById('ticket_time').value = data.time;
                                document.getElementById('ticket_price').value = data.price;
                            }
                        };
                        xhr.send('news_id=' + newsId);
                    });
                </script>
            </div>
        </div>
    </article>
    <footer class="text-white py-1" style="background: #021333;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-3 text-start">
                    <a href="\index.php" class="nav-link" style="width: 25%;">
                        <img class="d-block w-100" src="\img_site\icon.png" alt="Icon">
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <div>
                        <h6>Подписывайся:</h6>
                        <a href="https://t.me/your_telegram_channel" target="_blank" class="text-white me-3">
                            <i class="bi bi-telegram fs-3"></i>
                        </a>
                        <a href="https://www.instagram.com/your_instagram_page" target="_blank" class="text-white me-3">
                            <i class="bi bi-instagram fs-3"></i>
                        </a>
                        <a href="https://www.youtube.com/your_youtube_channel" target="_blank" class="text-white">
                            <i class="bi bi-youtube fs-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>