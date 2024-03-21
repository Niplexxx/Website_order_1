<!doctype html>
<html lang="RU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"></script>
    <title>.ICaST</title>
    <link rel="icon" type="image/x-icon" href="\img_site\icon.png">
</head>
<body style="background: #021333; font-family: 'Inter', sans-serif;">
<?php
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'my_bd';
    $link = mysqli_connect($host, $user, $pass, $db_name);
    if (!$link) {
        echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
        exit;
    }
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
                    <a href="\entrance.php" class="nav-link link-dark fs-6" style="color: #FFFFFF;">ВХОД</a>
                </div>
                <div class="col">
                    <a href="\registration.php" class="nav-link link-dark fs-6" style="color: #FFFFFF;">РЕГИСТРАЦИЯ</a>
                </div>
            </div>
        </div>
    </nav>
</header>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="\img_site\img_header1.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="\img_site\img_header2.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="\img_site\img_header3.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">предыдущая</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">следующая</span>
  </a>
</div>
<div class="position-relative overflow-hidden text-left" style="background-image: url('/img_site/background1.png'); background-size: cover; background-position: center; height: 100%;">
    <div class="py-4 mb-5 mt-5 position-relative overflow-hidden text-left" style="background: #000000; opacity: 0.89; width: 70%;  height: 80%; margin: 0 auto; border-radius: 23px;">
        <div class="container">
            <div class="container-relative overflow-hidden mt-5" style="background: linear-gradient(to right, #00C2FF, #021333); border-radius: 23px; height: 40px; width: 30%; margin-left: 16%;">
                <a href="/index.php" class="nav-link" style="color: #FFFFFF; font-size: 18px;">БЛИЖАЙШИЕ МЕРОПРИЯТИЯ</a>
            </div>
        </div>
        <div class="row d-flex flex-wrap justify-content-center" style="margin-top: 3%; margin-bottom: 3%;">
        <?php 
            $sql = mysqli_query($link, 'SELECT * FROM `news` ORDER BY id DESC LIMIT 4'); 
            while ($result = mysqli_fetch_array($sql)) { 
                echo '<div class="col-md-2">'; 
                echo '<div class="card" style="background-color: #FFFFFF;">'; 
                echo '<img src="' . $result['foto'] . '" class="card-img-top" alt="Car Image" style="max-width: 350px; min-height: 200px;">'; 
                echo '<div class="card-body">'; 
                echo '<h5 class="card-title">' . $result['title'] . '</h5>'; 
                echo '</div>'; 
                echo '<ul class="list-group list-group-flush" style="background-color: #FFFFFF; color: #000000;">'; 
                echo '<li class="list-group-item" style="background-color: #FFFFFF; color: #000000;"><b>Площадка:</b> ' . $result['platform'] . '</li>'; 
                echo '<li class="list-group-item" style="background-color: #FFFFFF; color: #000000;"><b>Дата:</b> ' . $result['date'] . '</li>'; 
                echo '<li class="list-group-item" style="background-color: #FFFFFF; color: #000000;"><b>Цена:</b> ' . $result['price'] . '</li>'; 
                echo '</ul>'; 
                echo '</div>'; 
                echo '</div>'; 
            } 
        ?>
        </div>
        <button type="submit" class="btn btn-custom w-10 mb-4" style="margin-left: 43%; background-color: #000000; border: 3px solid #00C2FF; border-radius: 23px; color: #00C2FF; 200px;"><span>ВСЕ МЕРОПРИЯТИЯ</span></button>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="container-relative overflow-hidden mt-5" style="background: linear-gradient(to right, #00C2FF, #021333); border-radius: 23px; height: 40px; width: 30%;">
        <a href="/index.php" class="nav-link" style="color: #FFFFFF; font-size: 18px;">НОВОСТНАЯ ЛЕНТА</a>
    </div>
    <div class="row">
        <?php
            $sql = mysqli_query($link, 'SELECT * FROM `news`');
            while ($result = mysqli_fetch_array($sql)) {
            ?>
            <div class="col-20 mb-4" style="margin-bottom: 50px;">
                <div class="p-5" style="background: #000000; opacity: 0.89; color: #FFFFFF; border-radius: 23px;">
                    <style>
                        #car_name_ {
                            font-size: 20px;
                            text-align: center;
                        }
                    </style>
                    <div class="row">
                        <div class="col-md-4">
                            <div class='exmpl'>
                                <p><img src='<?php echo $result['foto']; ?>' style='max-width: 350px; max-height: 700px;'></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <p id='car_name_'>
                                <?php echo $result['title'];?>
                            </p>
                            <table cellspacing='0' cellpadding='0' id='cell_roll'>
                                <tr> 
                                    <td id='leftcol'><p id='news_data'>Дата:<b><?php echo $result['date']; ?></b></p></td>
                                </tr>
                                <tr> 
                                    <td id='rightcol'><p id='old_date'>Время:<b><?php echo $result['time']; ?></b></p></td>
                                </tr>
                                <tr> 
                                    <td id='rightcol'><p id='old_date'>Площадка:<b><?php echo $result['platform']; ?></b></p></td>
                                </tr>
                                <tr> 
                                    <td id='rightcol'><p id='old_date'>Цена:<b><?php echo $result['price']; ?></b></p></td>
                                </tr>
                                <tr> 
                                    <td id='rightcol'><p id='old_date'>Организатор:<b><?php echo $result['organizer']; ?></b></p></td>
                                </tr>
                                <tr> 
                                    <td id='rightcol'><p id='old_date'><b><?php echo $result['subject']; ?></b></p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
        ?>
    </div>
</div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>