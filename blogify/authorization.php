<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;700&family=Rubik:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/style_authorization.css">
  <title>blogify</title>
</head>

<body>
  <nav>
    <div class="nav__wrapper">
      <div class="nav__logo"><a href="./index.php"><img src="./img/blogify.svg" alt="logo"></a></div>

    </div>
  </nav>

  <form action="./handler/handler_authorization.php" class="authorization" method="POST">
    <img class="authorization__logo" src="./img/logo.svg" alt="logo">
    <?php if (isset($_GET['error'])) : // если есть ошибка при авторизации, то выводим её 
    ?>
      <p class="error">Неправильный e-mail или пароль</p>
    <?php endif; ?>
    <input class="authorization__input" type="email" name="email" placeholder="Ваш e-mail" required>
    <input class="authorization__input" type="password" name="password" placeholder="Ваш пароль" required>
    <div class="authorization__buttons">
      <button class="authorization__button-auth">Войти</button>
      <a href="./registration.php"><div class="authorization__button-reg">Регистрация</div></a>
    </div>
  </form>

</html>