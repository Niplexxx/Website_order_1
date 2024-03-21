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
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
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
<article>
    <div class="position-relative overflow-hidden text-left d-flex align-items-center mt-1" style="background-image: url('/img_site/background1.png'); background-size: cover; background-position: center; height: 79vh;">
        <div id="map"></div>
    </div>
</article>
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
    <script src="https://api-maps.yandex.ru/2.1/?apikey=YOUR_API_KEY&lang=ru_RU" type="text/javascript"></script>
    <script>
        ymaps.ready(init);

        function init() {
            const myMap = new ymaps.Map("map", {
                center: [51.3681, 42.0844],
                zoom: 12
            });

            const myPlacemark = new ymaps.Placemark([51.3681, 42.0844], {
                hintContent: 'Город Борисоглебск',
                balloonContent: 'Борисоглебск - здесь мы находимся!'
            });

            myMap.geoObjects.add(myPlacemark);
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
</body>
</html>