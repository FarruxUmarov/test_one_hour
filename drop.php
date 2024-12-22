<?php
session_start();

// Проверка сессии пользователя
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Перенаправление на страницу логина
    exit();
}

// Логин пользователя из сессии
$username = $_SESSION['username'];
$balance = 0; // Пример начального баланса
$hand = 0; // Пример начального значения hand
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="icon" href="/image/favicon.BjRonRZP.ico" sizes="any">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .sidebar {
            width: 250px;
            background-color: #f1f6f9;
            height: 100vh;
            float: left;
            padding: 20px 10px;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar img {
            width: 100%;
            max-width: 60px;
            /* Уменьшаем размер логотипа */
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: #333;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #e8f5e9;
            font-weight: bold;
        }

        .logo {
            font-size: 10px;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e9ecef;
            margin-bottom: 20px;
        }

        .header .menu {
            display: flex;
            align-items: center;
            /* Добавляем вертикальное выравнивание */
            gap: 10px;
        }

        .header .menu a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .menu-button {
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 4px;
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            margin: 0 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .cards {
            flex: 1;
            margin: 0 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .card h3 {
            margin: 0 0 10px;
        }

        .card span {
            font-size: 20px;
            font-weight: bold;
        }

        .add-btn {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        #currency,
        #accounts {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Верхний логотипы -->
        <img src="image/logo.png" alt="Logo 1">
        <img src="image/logo2.png" alt="Logo 2" style="max-width: 90px;">

        <a href="#" class="active" onclick="showContent('home')">Главная</a>
        <a href="#" onclick="showContent('currency')">Курсы валют</a>
        <a href="#" onclick="showContent('accounts')">Аккаунты</a>
        <a href="#" onclick="showContent('notification')">Уведомления</a>
        <a href="#">Pay in</a>
        <a href="#">Pay in история</a>
        <a href="#">Pay out</a>
        <a href="#">Пополнение</a>
        <a href="#">История пополнений</a>
        <a href="#">Вывод</a>
        <a href="#">История выводов</a>
        <a href="#">Настройки</a>
        <a href="logout.php">Выйти</a>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header внутри контента -->
        <div class="header">
            <div class="menu">
                <!-- Логотип перед логином (перед текстом) -->
                <img src="image/logo3.png" alt="Logo 3" style="max-width: 50px; vertical-align: middle;">
                Логин: <strong><?php echo htmlspecialchars($username); ?></strong> |
                Баланс: <strong><?php echo $balance; ?></strong> |
                Hand: <strong><?php echo $hand; ?></strong>
            </div>
        </div>

        <!-- Основной контент -->
        <div id="home">
            <h2>Реквизиты</h2>
            <div class="card-container">
                <div class="card" style="background-color: #fff3cd;">
                    <h3>Всего</h3>
                    <span>0</span>
                </div>
                <div class="card" style="background-color: #f8d7da;">
                    <h3>Активные</h3>
                    <span>0</span>
                </div>
                <div class="card" style="background-color: #d4edda;">
                    <h3>В работе</h3>
                    <span>0</span>
                </div>
                <div class="card" style="background-color: #e2e3e5;">
                    <h3>На паузе</h3>
                    <span>0</span>
                </div>
            </div>

            <div class="card-container">
                <div>
                    <h3>Доступные реквизиты</h3>
                </div>
                <div class="card">Мои реквизиты</div>
                <div class="card">Поиск по картам</div>
                <div><a href="#" class="add-btn">Добавить реквизит</a></div>


            </div>
            <p>Ничего не найдено</p>
        </div>

        <div id="currency">
            <h2>Курс рубля к доллару США</h2>
            <p id="exchangeRate">Загрузка...</p>
        </div>

        <div id="accounts">
            <h2>Добавление пользователей</h2>
            <form action="add_account.php" method="POST">
                <input type="text" name="username" placeholder="Имя пользователя" required><br>
                <input type="password" name="password" placeholder="Пароль" required><br>
                <button type="submit">Создать</button>
            </form>
        </div>

        <div id="notification">
            <h2>Уведомление</h2>
            <div><a href="#" class="add-btn">Добавить реквизит</a></div>
            <p>Ничего не найдено</p>
        </div>
    </div>

    <script>
        // Функция для показа контента в зависимости от выбранной кнопки меню
        function showContent(contentId) {
            // Скрыть все разделы
            document.getElementById('home').style.display = 'none';
            document.getElementById('currency').style.display = 'none';
            document.getElementById('accounts').style.display = 'none';
            document.getElementById('notification').style.display = 'none';

            // Показать выбранный раздел
            document.getElementById(contentId).style.display = 'block';

            // Убираем активный класс у всех ссылок и добавляем только для выбранной
            const menuLinks = document.querySelectorAll('.sidebar a');
            menuLinks.forEach(link => link.classList.remove('active'));
            document.querySelector(`.sidebar a[href='#']`).classList.add('active');
        }
    </script>

</body>

</html>