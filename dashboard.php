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
include 'icon.svg';
include 'modal.php';
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="icon" href="image/favicon.BjRonRZP.ico" sizes="any">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style-adaptive.css">
</head>

<style>

</style>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="flexes">
            <div class="svg-a">
                <svg width="40" viewBox="0 0 122 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="#logo-main"></use>
                </svg>
            </div>
            <div class="svg-b">
                <svg width="70" viewBox="6 5 70 28" xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="#logo-second"></use>
                </svg>
            </div>
        </div>

        <a href="#" id="homeLink" class="active" onclick="showContent('home')">Главная</a>
        <a href="#" id="currencyLink" onclick="showContent('currency')">Курсы валют</a>
        <a href="#" id="accountsLink" onclick="showContent('accounts')">Аккаунты</a>
        <a href="#" id="notificationLink" onclick="showContent('notification')">Уведомления</a>
        <a href="#" id="payInLink" onclick="showContent('payIn')">Pay in</a>
        <a href="#" id="payInHistoryLink" onclick="showContent('payInHistory')">Pay in история</a>
        <a href="#" id="payOutLink" onclick="showContent('payOut')">Pay out</a>
        <a href="#" id="rechargeLink" onclick="showContent('recharge')">Пополнение</a>
        <a href="#" id="rechargeHistoryLink" onclick="showContent('rechargeHistory')">История пополнений</a>
        <a href="#" id="withdrawLink" onclick="showContent('withdraw')">Вывод</a>
        <a href="#" id="withdrawHistoryLink" onclick="showContent('withdrawHistory')">История выводов</a>
        <a href="#" id="settingsLink" onclick="showContent('settings')">Настройки</a>
        <a href="logout.php" class="logout-link">
            Выйти
            <svg width="24" height="24" class="logout-icon">
                <use xlink:href="#door"></use>
            </svg>
        </a>

    </div>
    <div class="header">
        <div class="sim" id="emptyMessage">
            <svg width="22" viewBox="0 0 24 24" fill="none">
                <use xlink:href="#logotip"></use>
            </svg>

            <div id="logins">Логин:</div>
            <p> </p> <strong id="logins2"><?php echo htmlspecialchars($username); ?> </strong>
            <div class="bal">Баланс:</div> <strong id="balans"><?php echo $balance; ?>$</strong>
            <div class="fl-jun">
                <div class="svg-c">
                    <svg width="40" viewBox="0 0 122 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="#logo-main"></use>
                    </svg>
                </div>
                <div class="svg-d">
                    <svg width="70" viewBox="6 5 70 28" xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="#logo-second"></use>
                    </svg>
                </div>
            </div>
            <div class="line">|</div>
            <div class="hand">Hand: <strong><?php echo $hand; ?>$</strong></div>
        </div>
    </div>
    <!-- Content -->
    <div class="content">

        <div id="home" style="display: block;">
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

            <div class="rekviz">
                <h3>Доступные реквизиты</h3>
                <div class="rows">
                    <ul class="dropdown">
                        <li><a href="javascript:void(0);" class="dropbtn">Мои реквизиты <i class="fas fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Мои реквизиты</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="rows2">
                    <input type="text" placeholder="Поиск по картам">
                </div>
                <div>
                    <a href="javascript:void(0);" class="add-btn rows3" id="openModal">Добавить реквизит</a>
                </div>

            </div>
            <p id="emptyMessage" class="notext">Ничего не найдено</p>
        </div>


        <div id="currency">
            <h2>Курсы валют</h2>
            <div class="cards-container">
                <!-- Карточка для RUB -->
                <div class="cards">
                    <table class="currency-table">
                        <tr>
                            <td>Название:</td>
                            <td style="text-align: right;">RUB</td>
                        </tr>
                        <tr>
                            <td>Ввод:</td>
                            <td style="text-align: right;"><strong>102.41 | 5.50%</strong></td>
                        </tr>
                        <tr>
                            <td>Вывод:</td>
                            <td style="text-align: right;"><strong>102.41 | 1.50%</strong></td>
                        </tr>
                    </table>
                </div>

                <!-- Карточка для SOM -->
                <div class="cards">
                    <table class="currency-table">
                        <tr>
                            <td>Название:</td>
                            <td style="text-align: right;">SOM</td>
                        </tr>
                        <tr>
                            <td>Ввод:</td>
                            <td style="text-align: right;"><strong>86.38 | 5.50%</strong></td>
                        </tr>
                        <tr>
                            <td>Вывод:</td>
                            <td style="text-align: right;"><strong>86.38 | 1.50%</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div id="accounts">
            <div>
                <div class="rekviz">
                    <h3>Аккаунты</h3>
                    <button id="addAccountBtn" class="add-account-btn">Добавить аккаунт</button>
                </div>
            </div>
            <p id="emptyMessage" class="notext">Ничего не найдено</p>
        </div>

        <div id="notification">
            <div>
                <div class="rekviz">
                    <h2>Уведомления</h2>
                    <div>
                        <input type="text" placeholder="Введите ID транзакции или текст" style="width: 300px;">
                    </div>
                </div>
            </div>

            <p id="emptyMessage" class="notext">Ничего не найдено</p>
        </div>

        <div id="payIn">
            <div>
                <div class="rekviz">
                    <h2>Pay in</h2>
                    <div>
                        <input type="text" placeholder="Поиск по ID" style="width: 300px;">
                    </div>
                </div>
            </div>
            <p id="emptyMessage" class="notext">Ничего не найдено</p>
        </div>

        <div id="payInHistory">
            <div>
                <div class="rekviz">
                    <h2>Pay in история</h2>
                </div>
            </div>
            <p id="emptyMessage" class="notext">Ничего не найдено</p>
        </div>

        <div id="payOut">
            <div>
                <div class="rekviz">
                    <h2>Pay out</h2>
                    <div>
                        <input type="text" placeholder="Поиск по ID" style="width: 300px;">
                    </div>
                </div>
            </div>
            <p id="emptyMessage" class="notext">Ничего не найдено</p>
        </div>

        <div id="recharge">
            <div id="contents">
                <h2>Пополнение</h2>
                <div class="payment-container">
                    <div class="qr-code">
                        <img src="image/Screenshot_7.png" alt="QR Code">
                    </div>
                    <div class="payment-details">
                        <p><strong>Выбранный способ оплаты</strong> <br> USDT TRC20</p>
                        <p><strong>Статус</strong> <br> Ожидает пополнения</p>
                        <p><strong>Сумма</strong> <br> 3000 USDT</p>
                        <p><strong>Адрес</strong> <br> TAAs0oYqrSSkub21nbxrsBeKxtzhuEGAt6</p>
                        <button class="cancel-btn">Отмена</button>
                    </div>
                </div>
            </div>

        </div>

        <div id="rechargeHistory">
            <div id="history-content" class="history-content">
                <div class="rekviz">
                    <h2>История пополнений</h2>
                    <button id="addAcc" class="add-account-btn">Пополнить</button>
                </div>

                <div class="cards-container">
                    <!-- Карточка для ID: 3 -->
                    <div class="cards">
                        <table class="currency-table">
                            <tr>
                                <td>ID:</td>
                                <td style="text-align: right;">3</td>
                            </tr>
                            <tr>
                                <td>Дата:</td>
                                <td style="text-align: right;">17.12.24 12:22</td>
                            </tr>
                            <tr>
                                <td>Сумма:</td>
                                <td style="text-align: right;"><strong>3000.00</strong></td>
                            </tr>
                            <tr>
                                <td>Валюта:</td>
                                <td style="text-align: right;">USDT</td>
                            </tr>
                            <tr>
                                <td>Статус:</td>
                                <td style="text-align: right;"><span class="status">Ожидает пополнения</span></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Карточка для ID: 2 -->
                    <div class="cards">
                        <table class="currency-table">
                            <tr>
                                <td>ID:</td>
                                <td style="text-align: right;">2</td>
                            </tr>
                            <tr>
                                <td>Дата:</td>
                                <td style="text-align: right;">17.12.24 12:22</td>
                            </tr>
                            <tr>
                                <td>Сумма:</td>
                                <td style="text-align: right;"><strong>3000.00</strong></td>
                            </tr>
                            <tr>
                                <td>Валюта:</td>
                                <td style="text-align: right;">USDT</td>
                            </tr>
                            <tr>
                                <td>Статус:</td>
                                <td style="text-align: right;"><span class="status">Ожидает пополнения</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div id="withdraw">
            <div id="withdraw-content" class="withdraw-content">
                <h2>Вывод</h2>
                <form id="withdraw-form" class="withdraw-form">
                    <label for="withdraw-method">Выберите метод вывода</label>
                    <select id="withdraw-method" class="withdraw-select">
                        <option value="" disabled selected>Выберите метод</option>
                        <option value="usdt-trc20">USDT TRC20</option>
                        <option value="usdt-erc20">USDT ERC20</option>
                        <option value="btc">BTC</option>
                    </select>

                    <label for="withdraw-amount">Введите сумму вывода</label>
                    <input type="number" id="withdraw-amount" class="withdraw-input" placeholder="0" min="1" required>

                    <label for="wallet-address">Адрес кошелька для вывода</label>
                    <input type="text" id="wallet-address" class="withdraw-input" placeholder="Вставьте адрес" required>

                    <button type="submit" class="withdraw-button">Создать заявку</button>
                </form>
            </div>

        </div>

        <div id="withdrawHistory">
            <div>
                <div class="rekviz">
                    <h2>История выводов</h2>
                </div>
            </div>
            <p id="emptyMessage" class="notext">Здесь пока ничего нет</p>
        </div>

        <div id="settings">
            <h2>Настройки</h2>
            <h3>Пароль</h3>
            <p id="emptyMessage">Сменить пароль</p>
            <div class="cards" style="width: 66%; padding: 15px; box-sizing: border-box;">
                <input type="text" placeholder="Старый пароль" style="width: 100%; padding: 10px; font-size: 16px;">
                <input type="text" placeholder="Новый пароль" style="width: 100%; padding: 10px; font-size: 16px;">
                <input type="text" placeholder="Подтвердить новый пароль" style="width: 100%; padding: 10px; font-size: 16px;">
                <button class="add-account-btn">Сохранить</button>
            </div>
            <h3>Варианты работы</h3>
            <p id="emptyMessage">Нужно выбрать 1 или 2 варианта</p>
            <div class="cards" style="width: 66%; padding: 15px; box-sizing: border-box;">
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="payin" value="payin" id="payin">
                    <label for="payin"></label> Pay In
                </label>
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="payout" value="payout" id="payout">
                    <label for="payout"></label> Pay Out
                </label>
            </div>
            <h3>Выбор валют для прием PayOut ордеров</h3>
            <p id="emptyMessage">Нужно выбрать 1 или 2 варианта</p>
            <div class="cards" style="width: 66%; padding: 15px; box-sizing: border-box;">
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="rub" value="rub" id="rub">
                    <label for="rub"></label> RUB
                </label>
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="som" value="som" id="som">
                    <label for="som"></label> SOM
                </label><br>
                <button class="add-account-btn">Сохранить</button>
            </div>

            <h2>Уведомления</h2>
            <p id="emptyMessage">Получать уведомления в телеграм</p>
            <p id="emptyMessage">Для того, что бы узнать айди телеграмм аккаунта необходимо написать боту <span style="color: green;">@getmy_idbot</span></p>
            <div class="cards" style="width: 66%; padding: 15px; box-sizing: border-box;">
                <span>ID в Telegram</span>
                <input type="text" placeholder="ID в Telegram" style="width: 100%; padding: 10px; font-size: 16px;">
                <button class="add-account-btn">Сохранить</button>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>

<script>

</script>