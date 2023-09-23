<?php
// Запуск сессии
session_start();

// Если пользователь не авторизован, то он переадресовывается на страницу авторизации
if (!isset($_SESSION['auth'])) {
  header('Location: ./authorization.php');
}

// Подключение к БД
require("./handler/db.php");



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;700&family=Rubik:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./js/scrolling.js"></script>
  <script src="./js/comment.js"></script>
  <script src="./js/like.js"></script>
  <title>blogify</title>
</head>

<body>
  <nav>
    <div class="nav__wrapper">
      <div class="nav__logo"><a href="./index.php"><img src="./img/blogify.svg" alt="logo"></a></div>
      <div class="nav__buttons">
        <a href="./index.php"><img src="./img/user.svg" alt="user"></a>
        <a href="./handler/exit.php"><img src="./img/exit.svg" alt="exit"></a>
      </div>
    </div>
  </nav>

  <section class="newArticle">
    <form name="newArticle__form" action="./handler/newArticle.php" method="POST" enctype="multipart/form-data">
      <textarea class="newArticle__textarea" name="article" placeholder="Что у вас нового?"></textarea>
      <input type="file" id="img" name="uploadfile" class="newArticle__input">
      <div class="newArticle__buttons">
        <label for="img" class="newArticle__lable"><img src="./img/img.svg" alt="img"></label>
        <button class="newArticle__button" name="upload">Опубликовать</button>
      </div>
    </form>
  </section>

  <section id="article">
    <?php
    $result = mysqli_query($db, "SELECT*FROM `articles` LEFT OUTER JOIN `users` ON articles.ID_user = users.ID_user ORDER BY ID_article DESC");
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <section class="article">
        <div class="article__title">
          <div class="article__avatar">
            <p class="article__avatar-text"><?php echo mb_substr($row['surname'], 0, 1), mb_substr($row['name'], 0, 1); ?></p>
          </div>
          <div class="article__dateName">
            <p><?php echo $row['surname'], ' ', $row['name']; ?></p>
            <p><?php echo $row['date'] ?></p>
          </div>
        </div>
        <p class="article__text"><?php echo $row['text'] ?></p>
        <?php if ($row['img']) {
        ?>
          <img class="article__img" src="./img/<?php echo $row['img'] ?>" alt="photo">
        <?php
        }
        $count = mysqli_query($db, "SELECT * FROM `likes` WHERE `ID_article` = " . $row['ID_article']);

        ?>
        <div class="article__like-img" data-id="<?php echo $row['ID_article'] ?>">
          <p class="article__like-count"><?php if (mysqli_num_rows($count)) {
                                            echo mysqli_num_rows($count);
                                          } else {
                                            echo 0;
                                          }
                                          ?></p>
        </div>
        <div id="responsecontainer<?php echo $row['ID_article'] ?>">
          <?php
          $comment = mysqli_query($db, "SELECT * FROM `comments` LEFT OUTER JOIN `users` ON comments.ID_user = users.ID_user WHERE `ID_article`='" . $row['ID_article'] . "'");
          while ($rowComment = mysqli_fetch_assoc($comment)) { ?>
            <div class="article__comment">
              <div class="article__commentAvatar">
                <p class="article__commentAvatar-text"><?php echo mb_substr($rowComment['surname'], 0, 1), mb_substr($rowComment['name'], 0, 1); ?></p>
              </div>
              <div class="article__commentNameText">
                <p><?php echo $rowComment['surname'], ' ', $rowComment['name']; ?></p>
                <p><?php echo $rowComment['text'] ?></p>
                <p><?php echo $rowComment['date'] ?></p>
              </div>
            </div>
          <?php } ?>
        </div>
        <form class="article__form" method="POST" action="javascript:void(null);" id="<?php echo $row['ID_article'] ?>">
          <textarea class="article__newComment" placeholder="Ваш комментарий" name="text" required></textarea>
          <input type="hidden" name="ID_article" value="<?php echo $row['ID_article'] ?>">
          <input class="article__button" type="submit" name="submit">
        </form>
      </section>

    <?php } ?>
  </section>

</body>
<script src="./js/resize.js"></script>

</html>