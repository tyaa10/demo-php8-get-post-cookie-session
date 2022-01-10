<?php
// если данный сценарий начал выполняться в ответ на POST-запрос,
// в теле которого присутствовал не пустой параметр userName,
// то значение этого параметра сохраняем в переменную $login
$login = isset($_POST['userName']) ? $_POST['userName'] : '';
// если только что произошел вход пользователя
if ($login != '') {
    // отправляем клиенту (браузеру) в составе ответа в области заголовков
    // заголовок setCookie, равный user=$login, где вместо $login
    // будет подставлено значение этой переменной
    setcookie("user", $login, time() + 3600 * 24);  /* отправка куки на клиент (одни сутки) */
} else if (isset($_COOKIE['user'])) {
    // если запрос был типа GET и содержал параметр с именем logout
    if (isset($_GET['logout'])) {
        // отправляем на клиент куки user с уже прошедшим временем пригодности,
        // то есть заставляем браузер уничтожить куки с таким именем
        setcookie('user', $login, time() - 1000);
    } else {
        // иначе если клиент прислал ранее выданный куки с именем user -
        // используем это имя как $login
        $login = $_COOKIE['user'];
    }
}
// var_dump($login);
// die();
$headerText = 'Hello PHP Forms!';
// $x = 2 * 2;
// echo "x = 2 * 2 = $x\n";
// echo "x = 2 * 2 = $x<br>";
// echo "x = 2 * 2 = $x";
?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A Basic HTML5 Template</title>
    <meta name="description" content="A simple HTML5 Template for new projects.">
    <meta name="author" content="SitePoint">
    <!--<link rel="icon" href="/favicon.ico">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="stylesheet" href="css/styles.css?v=1.0">-->
</head>
<body>
<h1><?= $headerText ?></h1>
<!--<div>x = 2 * 2 = <?php /*echo $x*/?></div>-->
<?php if ($login != ''): ?>
<div>Hello <?= $login?> <a href="/?logout">(SignOut)</a></div>
<?php else: ?>
<form action="/" method="post">
    <label>
        Login
        <input type="text" name="userName" placeholder="Your Name">
    </label>
    <input type="submit" value="Login">
</form>
<?php endif; ?>
</body>
</html>

