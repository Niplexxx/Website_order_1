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

    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = htmlentities($_POST['login'], ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5);
        $password = md5($_POST['password']);
        
        $query = "SELECT * FROM `users` WHERE `login` = '{$login}' AND `password` = '{$password}' LIMIT 1";
        $sql = mysqli_query($link, $query) or die(mysqli_error($link));
        
        if (mysqli_num_rows($sql) == 1) {
            $row = mysqli_fetch_assoc($sql);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_per'] = $row['prava'];
            $_SESSION['user_login'] = $row['login'];
            $_SESSION['user_password'] = $row['password'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_phone'] = $row['phone'];
            $_SESSION['user_country'] = $row['country'];
            $_SESSION['user_city'] = $row['city'];
            
            // Перенаправление на следующую страницу в зависимости от прав пользователя
            if ($_SESSION['user_per'] == "1") {
                header("Location: /lk_admin/admin.php");
                exit;
            } elseif ($_SESSION['user_per'] == "0") {
                header("Location: /personal_account/lk.php");
                exit;
            }
        } else {
            echo 'Неверное имя пользователя или пароль';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>.ICaST</title>
    <link rel="icon" type="image/x-icon" href="\img_site\icon.png">
</head>
<body style="background: #021333; font-family: 'Inter', sans-serif;">
    <!-- Ваш оставшийся HTML-код -->
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
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
                        <a href="\entrance.php" class="nav-link link-dark fs-6" style="color: #FFFFFF;">ВХОД</a>
                    </div>
                    <div class="col">
                        <a href="\registration.php" class="nav-link link-dark fs-6" style="color: #FFFFFF;">РЕГИСТРАЦИЯ</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="position-relative overflow-hidden text-left d-flex align-items-center" style="background-image: url('/img_site/background1.png'); background-size: cover; background-position: center; height: 80vh;">
        <article class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="Login p-3 rounded" style="background: #000000; opacity: 0.89; border-radius: 23px;">
                        <h3 class="text-center mb-4" style="color: #0085FF;">Авторизация</h3>
                        <form action="/entrance.php" method="post">
                            <input type="text" name="login" class="form-control mb-4 border-bottom" placeholder="Логин:" required="required" style="background: transparent; border: none; border-bottom: 2px solid #00488A;"/>
                            <input type="password" name="password" class="form-control mb-4 border-bottom" placeholder="Пароль:" required="required" style="background: transparent; border: none; border-bottom: 2px solid #00488A;">
                            <button type="submit" class="btn btn-custom w-100 mb-4" style="background-color: #0085FF;"><span>Войти</span></button>
                        </form>
                        <p class="text-center" style="color: #FFFFFF;">или</p>
                        <a href="\registration.php" class="text-muted d-block text-center nav-link link-dark fs-6" style="text-color: #FFFFFF;">зарегистироваться</a>
                    </div>
                </div>
            </div>
        </article>
    </div>
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
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $login = htmlentities($login, ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5);
            $password = md5($password);
            $query = "SELECT * FROM `users`
            WHERE `login`='{$login}' AND `password`='{$password}'
            LIMIT 1";
            $sql = mysqli_query($link, $query) or die(mysqli_error($link));
            if (mysqli_num_rows($sql) == 1) {
                $row = mysqli_fetch_assoc($sql);
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_per'] = $row['prava'];
                $_SESSION['user_login'] = $row['login'];
                $_SESSION['user_password'] = $row['password'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_phone'] = $row['phone'];
                $_SESSION['user_country'] = $row['country'];
                $_SESSION['user_city'] = $row['city'];
                
                // Добавление данных о последнем заходе пользователя в базу данных
                $event_date = date('Y-m-d H:i:s');
                $browser = $_SERVER['HTTP_USER_AGENT'];
                $location = $_SERVER['REMOTE_ADDR'];
                $failed_entry = 0; // Пока не учитываем неудачные попытки
                
                // Проверяем, существует ли уже запись для данного user_id
                $check_query = "SELECT * FROM `user_events` WHERE `user_id` = '{$row['id']}'";
                $check_result = mysqli_query($link, $check_query);
                
                if (mysqli_num_rows($check_result) > 0) {
                    // Если запись уже существует, обновляем ее
                    $update_query = "UPDATE `user_events` SET `event_date` = '{$event_date}', `browser` = '{$browser}', `location` = '{$location}', `failed_entry` = '{$failed_entry}' WHERE `user_id` = '{$row['id']}'";
                    mysqli_query($link, $update_query) or die(mysqli_error($link));
                } else {
                    // Если записи нет, добавляем новую
                    $insert_query = "INSERT INTO `user_events` (`user_id`, `event_date`, `browser`, `location`, `failed_entry`)
                    VALUES ('{$row['id']}', '{$event_date}', '{$browser}', '{$location}', '{$failed_entry}')";
                    mysqli_query($link, $insert_query) or die(mysqli_error($link));
                }
                
                if ($_SESSION['user_per'] == "1") {
                    echo "<script>window.location.href='/lk_admin/admin.php'</script>";
                    echo 'Вы вошли, как пользователь ' . $_POST['login'] . ' войдите в <a href="/lk_admin/admin.php">личный кабинет</a>';
                }
                if ($_SESSION['user_per'] == "0") {
                    echo "<script>window.location.href='/personal_account/lk.php'</script>";
                }
            } else {
                // Увеличиваем количество неудачных попыток входа для данного пользователя
                $login = htmlentities($login, ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5);
                $failed_entry = 1;
                $event_date = date('Y-m-d H:i:s');
                $browser = $_SERVER['HTTP_USER_AGENT'];
                $location = $_SERVER['REMOTE_ADDR'];
                
                // Обновляем запись для данного пользователя
                $update_failed_query = "UPDATE `user_events` SET `event_date` = '{$event_date}', `browser` = '{$browser}', `location` = '{$location}', `failed_entry` = `failed_entry` + 1 WHERE `user_id` = (SELECT `id` FROM `users` WHERE `login` = '{$login}')";
                mysqli_query($link, $update_failed_query) or die(mysqli_error($link));
                die('Неверное имя пользователя или пароль');
            }
        }
        ?>
    <footer class="text-white py-4" style="background: #021333;">
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