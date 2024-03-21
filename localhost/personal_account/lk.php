<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="\personal_account\stylelk.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>.ICaST</title>
    <link rel="icon" type="image/x-icon" href="\img_site\icon.png">
</head>
<body style="background: #021333; font-family: 'Inter', sans-serif;">
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

    // Запрос к базе данных для получения купленных билетов текущего пользователя
    $sql = "SELECT * FROM tickets WHERE user_id = '$user_id'";
    $result = mysqli_query($link, $sql);
?>
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
    <div class="position-relative overflow-hidden text-left d-flex align-items-center mt-1" style="background-image: url('/img_site/background1.png'); background-size: cover; background-position: center; height: 79vh;">
        <section class="container justify-content-center">
            <div style="background: linear-gradient(to bottom, #060606, #00C2FF); opacity: 0.89; border-radius: 23px; margin-left: 4%; height: 70vh;">
                <div class="row">
                    <div class="col-5 mt-4 mb-1" style="margin-left: 1%;">
                        <div class="container-relative overflow-hidden" style="background: linear-gradient(to right, #00C2FF, #021333); border-radius: 10px; height: 40px; width: 30%;">
                            <a href="/personal_account/lk.php" class="nav-link" style="color: #FFFFFF; font-size: 18px;">Профиль</a>
                        </div>
                    </div>
                    <div class="col-6 mt-2 mb-1">
                        <form method="POST" action="/personal_account/ticket_handler.php">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="hidden" name="user_login" value="<?php echo $_SESSION['user_login']; ?>">
                            <div class="col-6 mt-3 mb-1">
                                <div class="container-relative overflow-hidden" style="background: linear-gradient(to right, #00C2FF, #021333); border-radius: 10px; height: 40px;">
                                    <button type="submit" class="nav-link" style="color: #FFFFFF; font-size: 18px; background: transparent; border: none;">Купить билет</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 mt-1 mb-3" style="background: #000000; opacity: 0.89; border-radius: 23px; overflow: auto; height: 50vh; margin-left: 4%;">
                        <div>
                            <?php 
                                $host = 'localhost';
                                $user = 'root';
                                $pass = '';
                                $db_name = 'my_bd';
                                $link = mysqli_connect($host, $user, $pass, $db_name);
                                if (!$link) { 
                                    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error(); 
                                exit; }
                                $sql = mysqli_query($link, "SELECT * FROM users WHERE id=".$_SESSION['user_id']." LIMIT 1" ); 
                                $result = mysqli_fetch_array($sql); 
                                echo("<image class='mt-3' src=".$result['image']." width='150px'>"); 
                                echo "<form action=\"/personal_account/lk.php?edit_id=". $_SESSION['user_id']. "\"method=\"post\">"; 
                                echo "<fieldset> 
                                <legend style='color: white'>Логин:</legend> 
                                    <input value = ".$_SESSION['user_login']." type='text' tabindex='1' name='login' required autofocus style='background: transparent; border: none; border-bottom: 2px solid #00488A; color: white'> 
                                </fieldset> 
                                <fieldset> 
                                    <legend style='color: white'>Пароль:</legend> 
                                    <input type='password' value = ".$_SESSION['user_password']." name='password' placeholder='Пароль' required='required' tabindex='2' style='background: transparent; border: none; border-bottom: 2px solid #00488A; color: white'/> 
                                </fieldset> 
                                <fieldset> 
                                    <legend style='color: white'>Повтор пароля:</legend> 
                                    <input type='password' value = ".$_SESSION['user_password']." name='password2' placeholder='Повтор пароля' required='required' tabindex='3' style='background: transparent; border: none; border-bottom: 2px solid #00488A; color: white'/> 
                                </fieldset> 
                                <fieldset> 
                                    <legend style='color: white'>Имя:</legend> 
                                    <input placeholder='Имя' value = ".$_SESSION['user_name']." name='name' type='text' tabindex='3' required style='background: transparent; border: none; border-bottom: 2px solid #00488A; color: white'> 
                                </fieldset> 
                                <fieldset> 
                                    <legend style='color: white'>E-mail:</legend> 
                                    <input placeholder='E-mail' value = ".$_SESSION['user_email']." name='email' type='e_mail' tabindex='4' required style='background: transparent; border: none; border-bottom: 2px solid #00488A; color: white'> 
                                </fieldset> 
                                <fieldset> 
                                    <legend style='color: white'>Телефон:</legend> 
                                    <input placeholder='Телефон' value = ".$_SESSION['user_phone']." name='phone' type='text' tabindex='5' required style='background: transparent; border: none; border-bottom: 2px solid #00488A; color: white'> 
                                </fieldset> 
                                <fieldset> 
                                    <legend style='color: white'>Страна:</legend> 
                                    <input placeholder='Страна' value = ".$_SESSION['user_country']." name='country' type='text' tabindex='6' required style='background: transparent; border: none; border-bottom: 2px solid #00488A; color: white'> 
                                </fieldset> 
                                <fieldset> 
                                    <legend style='color: white'>Город:</legend> 
                                    <input placeholder='Город' value = ".$_SESSION['user_city']." name='city' type='text' tabindex='7' required style='background: transparent; border: none; border-bottom: 2px solid #00488A; color: white'> 
                                </fieldset>"; 
                                echo "<input type='submit' class='btn btn-custom w-100 mt-3 mb-3' style='background-color: #0085FF;' value='Изменить данные'/>";
                                $host = 'localhost';
                                $user = 'root';
                                $pass = '';
                                $db_name = 'my_bd';
                                $link = mysqli_connect($host, $user, $pass, $db_name);
                                if (!$link) { 
                                    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error(); 
                                exit; }
                                if ($_POST ["password"] == $_POST["password2"]){                       
                                    $sql = mysqli_query($link, "UPDATE `users` SET `login`='{$_POST['login']}',`password`='{$_POST['password']}',`name`='{$_POST['name']}',`prava`='0',`email`='{$_POST['email']}',`phone`='{$_POST['phone']}',`country`='{$_POST['country']}',`city`='{$_POST['city']}',`subscription`='on' WHERE `id`={$_GET['edit_id']}"); 
                                } 
                                else{ 
                                    echo("Пароли не совпадают!!!"); 
                                } 
                                echo "</form>"; 
                            ?>
                        </div>
                    </div>
                    <div class="col-1 mt-1 mb-3">
                    </div>
                    <div class="col-5 mt-1 mb-3" style="background: #000000; opacity: 0.89; border-radius: 23px;">
                        <form enctype="multipart/form-data" method="POST" action="/personal_account/lk.php"> 
                            <legend style="color: white">Сменить аватарку</legend>
                            <br/> 
                            <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
                            <input type="file" name="avatarka" class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                            <input type="submit" value="Добавить аватарку" class="btn btn-custom w-100 mt-3" style="background-color: #0085FF;">
                        </form>
                        <?php
                            if(isset($_FILES['avatarka'])) {
                                $upload_dir = '../images/';
                                $allowed_types = array('image/jpeg', 'image/png', 'image/gif');

                                if($_FILES['avatarka']['error'] == UPLOAD_ERR_OK && in_array($_FILES['avatarka']['type'], $allowed_types)) {
                                    $name = $upload_dir . date('YmdHis') . '_' . $_FILES['avatarka']['name'];
                                    
                                    if(move_uploaded_file($_FILES['avatarka']['tmp_name'], $name)) {
                                        $host = 'localhost';
                                        $user = 'root';
                                        $pass = '';
                                        $db_name = 'my_bd';
                                        $link = mysqli_connect($host, $user, $pass, $db_name);
                                        
                                        if(!$link) {
                                            echo 'Не удалось соединиться с базой данных.';
                                            exit;
                                        }
                                        
                                        $name = mysqli_real_escape_string($link, $name);
                                        mysqli_query($link, "UPDATE `users` SET `image`='$name' WHERE `id`={$_SESSION['user_id']}");
                                        
                                        echo 'Изображение успешно загружено и установлено как аватарка.';
                                    } else {
                                        echo 'Ошибка при загрузке изображения. Пожалуйста, попробуйте снова.';
                                    }
                                } else {
                                    echo 'Недопустимый формат изображения или произошла ошибка при загрузке.';
                                }
                            }
                        ?>
                        <form class="mt-2   " method="post" action="/personal_account/send_message.php">
                            <label for="message" style="color: white;">Сообщение:</label><br>
                            <textarea style='background: transparent; border: none; border-bottom: 2px solid #00488A; color: white' name="message" id="message" rows="3" cols="60" required></textarea><br>
                            <input type="submit" value="Отправить сообщение" class="btn btn-custom w-100 mt-3" style="background-color: #0085FF;">
                        </form>
                    </div>
                    <div class="col-11" style="background: #000000; opacity: 0.89; border-radius: 23px; margin-left: 4%; overflow: auto; height: 10vh;">
                    <fieldset style="color: white;">
                        <legend style="color: white;">Купленные билеты:</legend>
                            <table>
                                <tr>
                                    <th>Номер билета</th>
                                    <th>Дата</th>
                                    <th>Время</th>
                                    <th>Цена</th>
                                    <th>Статус</th>
                                    <th>Количество</th>
                                    <th>Место</th>
                                    <th>Общая стоимость</th>
                                    <th>Действие</th>
                                </tr>
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

                                    // Обработка удаления записи
                                    if (isset($_POST['delete_ticket'])) {
                                        $ticket_id = $_POST['ticket_id'];
                                        $sql_delete = "DELETE FROM tickets WHERE ticket_id = '$ticket_id'";
                                        if (mysqli_query($link, $sql_delete)) {
                                            echo 'Билет успешно удален.';
                                        } else {
                                            echo 'Ошибка при удалении билета: ' . mysqli_error($link);
                                        }
                                    }

                                    // Запрос к базе данных для получения купленных билетов текущего пользователя
                                    $sql = "SELECT * FROM tickets WHERE user_id = '$user_id'";
                                    $result = mysqli_query($link, $sql);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['ticket_id'] . "</td>";
                                            echo "<td>" . $row['ticket_date'] . "</td>";
                                            echo "<td>" . $row['ticket_time'] . "</td>";
                                            echo "<td>" . $row['ticket_price'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "<td>" . $row['place'] . "</td>";
                                            echo "<td>" . $row['total_price'] . "</td>";
                                            echo "<td>
                                                    <form method='post'>
                                                        <input type='hidden' name='ticket_id' value='" . $row['ticket_id'] . "'>
                                                        <button type='submit' name='delete_ticket' class='btn btn-custom w-10' style='background-color: #0085FF;'>Удалить</button>
                                                    </form>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>Нет купленных билетов</td></tr>";
                                    }
                                ?>
                            </table>
                        </fieldset>
                        <fieldset style="color: white;">
                        <legend style="color: white;">Купленные секции:</legend>
                        <table>
                            <tr>
                                <th>Номер секции</th>
                                <th>На сколько дней</th>
                                <th>Цена</th>
                                <th>Статус</th>
                                <th>Общая стоимость</th>
                                <th>Действие</th>
                            </tr>
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
                            if (isset($_POST['delete_section'])) {
                                $section_id = $_POST['section_id'];
                                $sql_delete = "DELETE FROM section WHERE section_id = '$section_id'";
                                if (mysqli_query($link, $sql_delete)) {
                                    echo 'Секция успешно удалена.';
                                } else {
                                    echo 'Ошибка при удалении секции: ' . mysqli_error($link);
                                }
                            }
                            $sql = "SELECT * FROM section WHERE user_id = '$user_id'";
                            $result = mysqli_query($link, $sql);
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['sections_id'] . "</td>";
                                    echo "<td>" . $row['section_term'] . "</td>";
                                    echo "<td>" . $row['section_price'] . "</td>";
                                    echo "<td>" . $row['section_status'] . "</td>";
                                    echo "<td>" . $row['total_price'] . "</td>";
                                    echo "<td>
                                        <form method='post'>
                                            <input type='hidden' name='section_id' value='" . $row['section_id'] . "'>
                                            <button type='submit' name='delete_section' class='btn btn-custom w-10' style='background-color: #0085FF;'>Удалить</button>
                                        </form>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>Нет купленных секций</td></tr>";
                            }
                            ?>
                        </table>
                    </fieldset>
                    </div>
                </div>
            </div>
        </section>
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