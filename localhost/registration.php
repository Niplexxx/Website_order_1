<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
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
                    <a href="\entrance.php" class="nav-link link-dark fs-6" style="color: #FFFFFF;">ВХОД</a>
                </div>
                <div class="col">
                    <a href="\registration.php" class="nav-link link-dark fs-6" style="color: #FFFFFF;">РЕГИСТРАЦИЯ</a>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="position-relative overflow-hidden text-left d-flex align-items-center justify-content-center" style="background-image: url('/img_site/background1.png'); background-size: cover; background-position: center; height: 80vh;">
    <article class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="Login p-5 rounded" style="background: #000000; opacity: 0.89; border-radius: 23px;">
                    <form action="\registration.php" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Имя" required="required" style="background: transparent; border: none; border-bottom: 2px solid #00488A;"/>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="login" placeholder="Логин" required="required" style="background: transparent; border: none; border-bottom: 2px solid #00488A;"/>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required" style="background: transparent; border: none; border-bottom: 2px solid #00488A;"/>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Пароль" required="required" style="background: transparent; border: none; border-bottom: 2px solid #00488A;"/>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password2" placeholder="Повтор пароля" required="required" style="background: transparent; border: none; border-bottom: 2px solid #00488A;"/>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="phone" placeholder="Телефон" style="background: transparent; border: none; border-bottom: 2px solid #00488A;"/>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="country" placeholder="Страна" style="background: transparent; border: none; border-bottom: 2px solid #00488A;"/>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="city" placeholder="Город" style="background: transparent; border: none; border-bottom: 2px solid #00488A;"/>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="subscription" name="subscription">
                            <label class="form-check-label" for="subscription" style="color: #FFFFFF;">Согласие на обработку данных.</label>
                        </div>
                        <button type="submit" class="btn btn-custom w-100 mb-4" style="background-color: #0085FF;"><span>Зарегистрироваться</span></button>
                    </form>
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
    if (isset($_POST["name"])) { 
        if ($_POST["password"] == $_POST["password2"]) { 
            if ($_POST["subscription"] == "on") { 
                $sql = mysqli_query($link,  
                "INSERT INTO users(login, password, name, email, phone, country, city, subscription)  
                VALUES ('".htmlentities($_POST['login'], ENT_QUOTES|ENT_DISALLOWED|ENT_HTML5)."', 
                '".md5($_POST['password'])."', 
                '".htmlentities($_POST['name'], ENT_QUOTES|ENT_DISALLOWED|ENT_HTML5)."', 
                '".$_POST['email']."', 
                '".htmlentities($_POST['phone'], ENT_QUOTES|ENT_DISALLOWED|ENT_HTML5)."', 
                '".htmlentities($_POST['country'], ENT_QUOTES|ENT_DISALLOWED|ENT_HTML5)."', 
                '".htmlentities($_POST['city'], ENT_QUOTES|ENT_DISALLOWED|ENT_HTML5)."', 
                '".$_POST['subscription']."') 
                "); 
                if ($sql) { 
                    echo "<script>window.location.href='/entrance.php'</script>"; 
                } else { 
                    echo "<p>Произошла ошибка.</p>"; 
                }  
            } else { 
                echo("Подпишись на уведомления!!!"); 
            } 
        } else { 
            echo("Пароли не совпадают!!!"); 
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