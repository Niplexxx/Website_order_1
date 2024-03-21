<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>.ICaST</title>
    <link rel="icon" type="image/x-icon" href="\img_site\icon.png">
</head>
<body style="background: #021333; font-family: 'Inter', sans-serif;">
<?php
    session_start();
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
                    <a href="#" class="nav-link link-dark fs-6" style="color: #FFFFFF;">МЕРОПРИЯТИЯ</a>
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
    <div class="position-relative overflow-hidden text-left d-flex align-items-center mt-1" style="background-image: url('/img_site/background1.png'); background-size: cover; background-position: center; height: 75vh;">
    <section class="container justify-content-center">
      <div style="background: linear-gradient(to bottom, #060606, #00C2FF); opacity: 0.89; border-radius: 23px; margin-left: 2%; height: 70vh;">
      <div class="row">
        <div class="col-4 mt-3 mb-1" style="margin-left: 1%;">
            <div class="container-relative overflow-hidden" style="background: linear-gradient(to right, #00C2FF, #021333); border-radius: 10px; height: 40px; width: 30%;">
                <a href="/lk_admin\admin.php" class="nav-link" style="color: #FFFFFF; font-size: 18px;">Профиль</a>
            </div>
        </div>
      </div>  
      <div class="row">
      <div class="col-5 mt-4" style="background: #000000; opacity: 0.89; border-radius: 23px; margin-left: 4%; height: 58vh;">
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
    $sql = "SELECT id_user, text_messages FROM messages";
    $result = mysqli_query($link, $sql);
    ?>
    <div class="container py-1 mt-5" style="overflow: auto; height: 24vh; margin-bottom: 20px;">
        <p style="color: white;">сообщения</p>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID пользователя</th>
                    <th>Текст сообщения</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_user'] . "</td>";
                        echo "<td>" . $row['text_messages'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Нет данных в таблице messages.</td></tr>";
                }
                mysqli_close($link);
                ?>
            </tbody>
        </table>
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
    $sql = "SELECT user_id, event_date, browser, location, failed_entry FROM user_events";
    $result = mysqli_query($link, $sql);
    ?>
    <div class="container py-2" style="overflow: auto; height: 24vh;">
        <p style="color: white;">события</p>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID пользователя</th>
                    <th>Дата события</th>
                    <th>Браузер</th>
                    <th>Местоположение</th>
                    <th>Неудачные попытки</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['event_date'] . "</td>";
                        echo "<td>" . $row['browser'] . "</td>";
                        echo "<td>" . $row['location'] . "</td>";
                        echo "<td>" . $row['failed_entry'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Нет данных в таблице user_events.</td></tr>";
                }
                mysqli_close($link);
                ?>
            </tbody>
        </table>
    </div>
</div>
          <div class="col-1 mt-4">
          </div>
          <div class="col-5 mt-4" style="background: #000000; overflow: auto; opacity: 0.89; border-radius: 23px; height: 58vh;">
            <section class="mt-2">
              <fieldset>
                <form method="POST" action="admin.php" enctype="multipart/form-data" style="overflow: auto; height: 35vh;" class="border-bottom border-info mb-4">
                  <p style="color: white">Название:</p>
                    <input name="title" type="text"  class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                  </p>
                  <p style="color: white">Описание:</p>
                    <input name="theme" type="text"  class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                  </p>
                  <p style="color: white">Дата:</p>
                    <input name="date" type="text"  class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                  </p>
                  <p style="color: white">Время:</p>
                    <input name="time" type="text"  class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                  </p>
                  <p style="color: white">Площадка:</p>
                    <input name="platform" type="text"  class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                  </p>
                  <p style="color: white">Цена:</p>
                    <input name="price" type="text"  class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                  </p>
                  <p style="color: white">Скидка:</p>
                    <input name="discount" type="text" class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                  </p>
                  <p style="color: white">Организатор:</p>
                    <input name="organizer" type="text"  class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                  </p>
                  <p style="color: white">Добавьте фото мероприятия:</p>
                    <input type="file" name="file" multiple accept="image/*,image/jpeg" class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                  </p>
                  <button type="submit" class="btn btn-custom w-100 mb-4" style="background-color: #0085FF;"><span>Добавить</span></button>
                </form>
              </fieldset>
            </section>
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

              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST["theme"])) {
                    $title = $_POST['title'];
                    $subject = $_POST['theme'];
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $platform = $_POST['platform'];
                    $price = $_POST['price'];
                    $discount = $_POST['discount'];
                    $organizer = $_POST['organizer'];
                    $file = $_FILES['file'];
                    $name = $file['name'];
                    $pathfile = "../images/" . $name;
                    $path = "../images/" . $name;
                    if (!move_uploaded_file($file['tmp_name'], $pathfile)) {
                        echo "Ошибка при загрузке файла";
                    } else {
                        $totalPrice = $price - $discount; // Рассчитываем цену с учетом скидки
                        $sql = mysqli_query($link, "INSERT INTO news (title, subject, date, time, platform, price, discount, organizer, foto) 
                                                    VALUES ('$title', '$subject', '$date', '$time', '$platform', '$totalPrice', '$discount', '$organizer', '$path')");
                        if ($sql) {
                        } else {
                            echo "<p>Произошла ошибка.</p>";
                        }
                    }
                }
            }
            ?>
            <?php
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  if (isset($_POST["theme"])) {
                      $title = $_POST['title'];
                      $subject = $_POST['theme'];
                      $date = $_POST['date'];
                      $time = $_POST['time'];
                      $platform = $_POST['platform'];
                      $price = $_POST['price'];
                      $discount = $_POST['discount'];
                      $organizer = $_POST['organizer'];

                      $file = $_FILES['file'];
                      $name = $file['name'];
                      $pathfile = "../images/" . $name;
                      $path = "../images/" . $name;

                      if (!move_uploaded_file($file['tmp_name'], $pathfile)) {
                      } else {
                          $sqlCheck = mysqli_query($link, 'SELECT * FROM `news`');
                          $hasData = mysqli_num_rows($sqlCheck) > 0;

                          if ($hasData) {
                              $sqlLast = mysqli_query($link, 'SELECT * FROM `news` ORDER BY id DESC LIMIT 1');
                              $lastRecord = mysqli_fetch_assoc($sqlLast);

                              if ($subject !== $lastRecord['subject'] || $title !== $lastRecord['title'] || $path !== $lastRecord['foto']) {
                                    $sql = mysqli_query($link, "INSERT INTO news (title, subject, date, time, platform, price, discount, organizer, foto) 
                                    VALUES ('$title', '$subject', '$date', '$time', '$platform', '$totalPrice', '$discount', '$organizer', '$path')");
                                  if ($sql) {
                                  } else {
                                  }
                              } else {
                                  echo "<p>Новая запись совпадает с последней записью.</p>";
                              }
                          } else {
                              $sql = mysqli_query($link, "INSERT INTO news (title, subject, date, time, platform, price, organizer, foto) 
                                                          VALUES ('$title', '$subject', '$date', '$time', '$platform', '$price', '$organizer', '$path')");
                              if ($sql) {
                              } else {
                              }
                          }
                      }
                  }
              }
            ?>
            <div class="mb-3" style="overflow: auto; height: 35vh;">
            <?php
              $sql = mysqli_query($link, 'SELECT * FROM `news`');
              while ($result = mysqli_fetch_array($sql)) {
                  echo "<p style='color: white'>Название: {$result['title']}</p>";
                  echo "<p style='color: white'>Описание: {$result['subject']}</p>";
                  echo "<p style='color: white'>Дата: {$result['date']}</p>";
                  echo "<p style='color: white'>Время: {$result['time']}</p>";
                  echo "<p style='color: white'>Площадка: {$result['platform']}</p>";
                  echo "<p style='color: white'>Цена: {$result['price']}</p>";
                  echo "<p style='color: white'>Скидка: {$result['discount']}</p>";
                  echo "<p style='color: white'>Организатор: {$result['organizer']}</p>";
                  echo "<p><img src='{$result['foto']}' style='max-width: 350px; max-height: 200px;'></p>";
                  echo "<a href='?del_id={$result['id']}'>Удалить</a>";
                  echo "<p class='py-3 border-bottom border-info'></p>";
              }
              ?>
            </div>
            <?php
              if (isset($_GET['del_id'])) {
                  $sql = mysqli_query($link, "DELETE FROM  `news`  WHERE  `id`  =" . $_GET["del_id"]);
                  if ($sql) {
                      echo "<p>Запись удалена</p>";
                      echo "<script>window.location.href='/lk_admin/admin.php'</script>";
                  } else {
                      echo '<p>Произошла ошибка удаления: ' . mysqli_error($link) . '</p>';
                  }
              }
            ?>
            <section class="mt-2">
                <fieldset>
                    <form method="POST" action="admin.php" enctype="multipart/form-data" style="overflow: auto; height: 35vh;" class="border-bottom border-info mb-4">
                        <p style="color: white">Название секции:</p>
                        <input name="title" type="text" class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                        <p style="color: white">Описание секции:</p>
                        <input name="subject" type="text" class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                        <p style="color: white">Цена секции:</p>
                        <input name="price" type="text" class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                        <p style="color: white">Скидка секции:</p>
                        <input name="discount" type="text" class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                        <p style="color: white">Организатор секции:</p>
                        <input name="organizer" type="text" class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                        <p style="color: white">Добавьте фото секции:</p>
                        <input type="file" name="photo" accept="image/*" class="form-control" style="background: transparent; border: none; border-bottom: 2px solid #00488A; color: white">
                        <button type="submit" class="btn btn-custom w-100 mb-4" style="background-color: #0085FF;"><span>Добавить</span></button>
                    </form>
                </fieldset>
            </section>
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
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST["subject"])) {
                        $title = $_POST['title'];
                        $subject = $_POST['subject'];
                        $price = $_POST['price'];
                        $discount = $_POST['discount'];
                        $organizer = $_POST['organizer'];
                        $file = $_FILES['photo'];
                        $name = $file['name'];
                        $pathfile = "../images/" . $name;
                        $path = "../images/" . $name;
                        if (!move_uploaded_file($file['tmp_name'], $pathfile)) {
                            echo "Ошибка при загрузке файла";
                        } else {
                            $totalPrice = $price - $discount; // Рассчитываем цену с учетом скидки
                            // Преобразуем цену и скидку в числовой формат
                            $totalPrice = (float)$totalPrice;
                            $discount = (float)$discount;
                            // Используем подготовленный запрос для безопасного добавления в базу данных
                            $stmt = $link->prepare("INSERT INTO sectionnews (title, subject, price, discount, organizer, foto) VALUES (?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("ssddss", $title, $subject, $totalPrice, $discount, $organizer, $path);
                            if ($stmt->execute()) {
                            } else {
                                echo 'Произошла ошибка.';
                            }
                            $stmt->close();
                        }
                    }
                }
            ?>
            <div class="mb-3" style="overflow: auto; height: 35vh;">
            <?php
                $sql = mysqli_query($link, 'SELECT * FROM `sectionnews`');
                while ($result = mysqli_fetch_array($sql)) {
                    echo "<p style='color: white'>Название секции: {$result['title']}</p>";
                    echo "<p style='color: white'>Описание секции: {$result['subject']}</p>";
                    echo "<p style='color: white'>Цена секции: {$result['price']}</p>";
                    echo "<p style='color: white'>Скидка секции: {$result['discount']}</p>";
                    echo "<p style='color: white'>Организатор секции: {$result['organizer']}</p>";
                    echo "<p><img src='{$result['foto']}' style='max-width: 350px; max-height: 200px;'></p>";
                    echo "<a href='?del_id_sectionnews={$result['id']}'>Удалить</a>";
                    echo "<p class='py-3 border-bottom border-info'></p>";
                }
                ?>
                </div>
                <?php
                if (isset($_GET['del_id_sectionnews'])) {
                    $id_to_delete = $_GET['del_id_sectionnews']; // Исправлено: использование правильной переменной для удаления
                    $sql = mysqli_query($link, "DELETE FROM `sectionnews` WHERE `id` = $id_to_delete");
                    if ($sql) {
                        echo "<p>Запись удалена</p>";
                        echo "<script>window.location.href='/lk_admin/admin.php'</script>";
                    } else {
                        echo '<p>Произошла ошибка удаления: ' . mysqli_error($link) . '</p>';
                    }
                }
            ?>
            <?php
                if (isset($_GET['updata_id'])) {
                    // перенаправляем на другую страницу
                    echo "<script>window.location.href='/lk_admin/news_updata.php?updata_id=" . $_GET['updata_id'] . "'</script>";
                }
            ?>
          </div>
        </div>
      </div>
    </section>
</article>
<?php
  if(isset($_FILES['file']) && !empty($_FILES['file']['size'])) {
      if($_FILES['file']['size'] > (5 * 1024 * 1024)) {
          // Обработка ошибки, если размер файла превышает 5Мб
      } else {
          $imageinfo = getimagesize($_FILES['file']['tmp_name']);
          $arr = array('image/jpeg', 'image/gif', 'image/png');
          if(in_array($imageinfo['mime'], $arr)) {
              $upload_dir = '../images/';
              $name = $upload_dir . date('YmdHis') . basename($_FILES['file']['name']);
              $mov = move_uploaded_file($_FILES['file']['tmp_name'], $name);
              if($mov) {
                  $host = 'localhost';
                  $user = 'root';
                  $pass = '';
                  $db_name = 'my_bd';
                  $link = mysqli_connect($host, $user, $pass, $db_name);
                  if (!$link) {
                      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                      exit;
                  }
                  $name = mysqli_real_escape_string($link, $name);
                  mysqli_query($link, "UPDATE `news` SET `foto`='$name' WHERE `id`={$_GET['id']}");
                  echo 'Изображение успешно загружено';
              } else {
                  echo 'Произошла ошибка при загрузке изображения. Пожалуйста, попробуйте снова';
              }
          } else {
              // Обработка ошибки, если формат файла не соответствует допустимым
          }
      }
  } else {
      // Обработка ошибки, если файл не был выбран
  }
?>
<?php
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK && !empty($_FILES['photo']['size'])) {
        if($_FILES['photo']['size'] > (5 * 1024 * 1024)) {
            // Обработка ошибки, если размер файла превышает 5Мб
        } else {
            $imageinfo = getimagesize($_FILES['photo']['tmp_name']);
            if($imageinfo !== false) {
                $arr = array('image/jpeg', 'image/gif', 'image/png');
                if(in_array($imageinfo['mime'], $arr)) {
                    $upload_dir = '../images/';
                    $name = $upload_dir . date('YmdHis') . basename($_FILES['photo']['name']);
                    $mov = move_uploaded_file($_FILES['photo']['tmp_name'], $name);
                    if($mov) {
                        $host = 'localhost';
                        $user = 'root';
                        $pass = '';
                        $db_name = 'my_bd';
                        $link = mysqli_connect($host, $user, $pass, $db_name);
                        if (!$link) {
                            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                            exit;
                        }
                        $name = mysqli_real_escape_string($link, $name);
                        mysqli_query($link, "UPDATE `sectionnews` SET `foto`='$name' WHERE `id`={$_GET['id']}");
                        echo 'Изображение успешно загружено';
                    } else {
                        echo 'Произошла ошибка при загрузке изображения. Пожалуйста, попробуйте снова';
                    }
                } else {
                    // Обработка ошибки, если формат файла не соответствует допустимым
                }
            } else {
                // Обработка ошибки, если информацию о файле получить не удалось
            }
        }
    } else {
        // Обработка ошибки, если файл не был выбран или произошла ошибка при загрузке
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