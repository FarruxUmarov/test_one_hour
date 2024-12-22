<?php
session_start();

$error_message = '';

// Чтение данных из файла users.json
$users_file = 'users.json';
if (file_exists($users_file)) {
    $users_data = json_decode(file_get_contents($users_file), true);
} else {
    die('Файл users.json не найден.');
}

// Проверка данных после отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Валидация логина и пароля
    if (isset($users_data[$username]) && $users_data[$username] === $password) {
        $_SESSION['username'] = $username; // Создаем сессию
        header('Location: dashboard.php'); // Переход на dashboard
        exit();
    } else {
        $error_message = 'Неверный логин или пароль!';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в кабинет</title>
    <!-- Подключение Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="/image/favicon.BjRonRZP.ico" sizes="any">
    <style>
        body {
            font-family: Arial, sans-serif;
            /*  background-color: #f8f9fa; */
            display: flex;
            justify-content: center;
            /* Горизонтальное центрирование */
            align-items: flex-start;
            /* Вертикальное выравнивание по верхнему краю */
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            padding: 40px;
            width: 600px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: left;
            margin-bottom: 20px;
        }

        .logo img {
            height: 110px;
            margin-right: 80px;
        }

        h2 {
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: left;
            margin-bottom: 20px;
        }

        input {
            width: calc(100% - 40px);
            padding: 15px;
            margin: 10px 0;
            border: none;
            /* Убрана обводка */
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            background-color: #f1f1f1;
            /* Светлый фон */
        }

        input:focus {
            background-color: #fff;
            /* Цвет фона при фокусе */
        }

        .password-container {
            position: relative;
        }

        .password-container input {
            width: 90%;
            padding-right: 40px;
        }

        .password-container i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #212529;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #343a40;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Логотип и текст -->
        <div class="logo">
            <svg width="122" height="76" viewBox="0 0 122 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.52958 69.9125L3.89161 75.8722H1.48328L0.239238 64.6878H1.9458L2.88681 73.5075L3.73212 64.6878H5.42273L6.29994 73.5714L7.20904 64.6878H8.74017L7.49613 75.8722H5.16754L4.52958 69.9125Z" fill="#00A76F"></path>
                <path d="M11.2358 73.2998C11.2358 73.7045 11.3156 73.9921 11.4751 74.1626C11.6452 74.3223 11.8685 74.4022 12.145 74.4022C12.4214 74.4022 12.6394 74.3223 12.7989 74.1626C12.969 73.9921 13.0541 73.7045 13.0541 73.2998V67.2602C13.0541 66.8554 12.969 66.5731 12.7989 66.4134C12.6394 66.2429 12.4214 66.1577 12.145 66.1577C11.8685 66.1577 11.6452 66.2429 11.4751 66.4134C11.3156 66.5731 11.2358 66.8554 11.2358 67.2602V73.2998ZM9.48143 67.372C9.48143 66.4666 9.71004 65.7742 10.1672 65.2949C10.6245 64.8049 11.2837 64.5599 12.145 64.5599C13.0062 64.5599 13.6654 64.8049 14.1227 65.2949C14.5799 65.7742 14.8085 66.4666 14.8085 67.372V73.1879C14.8085 74.0933 14.5799 74.791 14.1227 75.281C13.6654 75.7603 13.0062 76 12.145 76C11.2837 76 10.6245 75.7603 10.1672 75.281C9.71004 74.791 9.48143 74.0933 9.48143 73.1879V67.372Z" fill="#00A76F"></path>
                <path d="M19.6169 75.8722C19.5956 75.7976 19.5744 75.7284 19.5531 75.6645C19.5318 75.6006 19.5106 75.5207 19.4893 75.4248C19.4787 75.3289 19.468 75.2064 19.4574 75.0573C19.4574 74.9082 19.4574 74.7218 19.4574 74.4981V72.7405C19.4574 72.2186 19.367 71.8511 19.1863 71.6381C19.0055 71.425 18.7131 71.3185 18.3091 71.3185H17.703V75.8722H15.9486V64.6878H18.5962C19.5106 64.6878 20.1698 64.9008 20.5739 65.3269C20.9885 65.7529 21.1959 66.3974 21.1959 67.2602V68.1389C21.1959 69.2893 20.8131 70.0456 20.0475 70.4078C20.4941 70.5889 20.7971 70.8871 20.9566 71.3025C21.1268 71.7073 21.2118 72.2026 21.2118 72.7885V74.5141C21.2118 74.791 21.2225 75.036 21.2437 75.249C21.265 75.4514 21.3182 75.6591 21.4032 75.8722H19.6169ZM17.703 66.2855V69.7207H18.3888C18.7184 69.7207 18.9736 69.6355 19.1544 69.4651C19.3458 69.2947 19.4415 68.9858 19.4415 68.5384V67.4359C19.4415 67.0312 19.367 66.7382 19.2182 66.5572C19.08 66.3761 18.8567 66.2855 18.5483 66.2855H17.703Z" fill="#00A76F"></path>
                <path d="M22.3657 64.6878H24.1201V74.2744H27.0069V75.8722H22.3657V64.6878Z" fill="#00A76F"></path>
                <path d="M27.8015 64.6878H30.5766C31.4592 64.6878 32.1131 64.9221 32.5384 65.3908C32.9743 65.8595 33.1923 66.5465 33.1923 67.4519V73.108C33.1923 74.0134 32.9743 74.7005 32.5384 75.1692C32.1131 75.6378 31.4592 75.8722 30.5766 75.8722H27.8015V64.6878ZM29.5559 66.2855V74.2744H30.5447C30.8212 74.2744 31.0392 74.1945 31.1987 74.0347C31.3581 73.875 31.4379 73.5927 31.4379 73.1879V67.372C31.4379 66.9672 31.3581 66.685 31.1987 66.5252C31.0392 66.3654 30.8212 66.2855 30.5447 66.2855H29.5559Z" fill="#00A76F"></path>
                <path d="M40.5046 72.6287L41.7008 64.6878H44.1411V75.8722H42.4823V67.8513L41.2702 75.8722H39.6115L38.3036 67.9632V75.8722H36.7725V64.6878H39.2128L40.5046 72.6287Z" fill="#00A76F"></path>
                <path d="M47.0281 73.2998C47.0281 73.7045 47.1079 73.9921 47.2674 74.1626C47.4375 74.3223 47.6608 74.4022 47.9372 74.4022C48.2137 74.4022 48.4316 74.3223 48.5911 74.1626C48.7613 73.9921 48.8463 73.7045 48.8463 73.2998V67.2602C48.8463 66.8554 48.7613 66.5731 48.5911 66.4134C48.4316 66.2429 48.2137 66.1577 47.9372 66.1577C47.6608 66.1577 47.4375 66.2429 47.2674 66.4134C47.1079 66.5731 47.0281 66.8554 47.0281 67.2602V73.2998ZM45.2737 67.372C45.2737 66.4666 45.5023 65.7742 45.9595 65.2949C46.4167 64.8049 47.076 64.5599 47.9372 64.5599C48.7985 64.5599 49.4577 64.8049 49.9149 65.2949C50.3721 65.7742 50.6007 66.4666 50.6007 67.372V73.1879C50.6007 74.0933 50.3721 74.791 49.9149 75.281C49.4577 75.7603 48.7985 76 47.9372 76C47.076 76 46.4167 75.7603 45.9595 75.281C45.5023 74.791 45.2737 74.0933 45.2737 73.1879V67.372Z" fill="#00A76F"></path>
                <path d="M53.3039 67.7715V75.8722H51.7249V64.6878H53.9259L55.7282 71.3824V64.6878H57.2912V75.8722H55.4889L53.3039 67.7715Z" fill="#00A76F"></path>
                <path d="M60.3017 69.4012H62.7101V70.999H60.3017V74.2744H63.3321V75.8722H58.5473V64.6878H63.3321V66.2855H60.3017V69.4012Z" fill="#00A76F"></path>
                <path d="M66.062 72.1653L63.8451 64.6878H65.6792L67.019 69.7847L68.3587 64.6878H70.0334L67.8164 72.1653V75.8722H66.062V72.1653Z" fill="#00A76F"></path>
                <path d="M72.7409 64.6878H78.1636V66.2855H76.3294V75.8722H74.575V66.2855H72.7409V64.6878Z" fill="#00A76F"></path>
                <path d="M82.635 75.8722C82.6137 75.7976 82.5924 75.7284 82.5712 75.6645C82.5499 75.6006 82.5286 75.5207 82.5074 75.4248C82.4967 75.3289 82.4861 75.2064 82.4755 75.0573C82.4755 74.9082 82.4755 74.7218 82.4755 74.4981V72.7405C82.4755 72.2186 82.3851 71.8511 82.2044 71.6381C82.0236 71.425 81.7312 71.3185 81.3271 71.3185H80.7211V75.8722H78.9667V64.6878H81.6142C82.5287 64.6878 83.1879 64.9008 83.5919 65.3269C84.0066 65.7529 84.214 66.3974 84.214 67.2602V68.1389C84.214 69.2893 83.8312 70.0456 83.0656 70.4078C83.5122 70.5889 83.8152 70.8871 83.9747 71.3025C84.1448 71.7073 84.2299 72.2026 84.2299 72.7885V74.5141C84.2299 74.791 84.2405 75.036 84.2618 75.249C84.2831 75.4514 84.3362 75.6591 84.4213 75.8722H82.635ZM80.7211 66.2855V69.7207H81.4069C81.7365 69.7207 81.9917 69.6355 82.1725 69.4651C82.3638 69.2947 82.4595 68.9858 82.4595 68.5384V67.4359C82.4595 67.0312 82.3851 66.7382 82.2363 66.5572C82.098 66.3761 81.8747 66.2855 81.5664 66.2855H80.7211Z" fill="#00A76F"></path>
                <path d="M91.0616 75.8722H89.2913L88.9883 73.843H86.8351L86.5321 75.8722H84.9212L86.7075 64.6878H89.2753L91.0616 75.8722ZM87.0584 72.3251H88.749L87.9037 66.669L87.0584 72.3251Z" fill="#00A76F"></path>
                <path d="M93.4417 67.7715V75.8722H91.8627V64.6878H94.0637L95.866 71.3824V64.6878H97.429V75.8722H95.6267L93.4417 67.7715Z" fill="#00A76F"></path>
                <path d="M98.4618 67.372C98.4618 66.4666 98.6745 65.7742 99.0998 65.2949C99.5357 64.8049 100.184 64.5599 101.046 64.5599C101.907 64.5599 102.55 64.8049 102.975 65.2949C103.411 65.7742 103.629 66.4666 103.629 67.372V67.8034H101.971V67.2602C101.971 66.8554 101.891 66.5731 101.731 66.4134C101.583 66.2429 101.37 66.1577 101.093 66.1577C100.817 66.1577 100.599 66.2429 100.44 66.4134C100.291 66.5731 100.216 66.8554 100.216 67.2602C100.216 67.6436 100.301 67.9845 100.471 68.2828C100.642 68.5704 100.854 68.8473 101.109 69.1136C101.365 69.3692 101.636 69.6302 101.923 69.8965C102.221 70.1521 102.497 70.4344 102.752 70.7433C103.007 71.0522 103.22 71.4037 103.39 71.7979C103.56 72.192 103.645 72.6553 103.645 73.1879C103.645 74.0933 103.422 74.791 102.975 75.281C102.54 75.7603 101.891 76 101.03 76C100.168 76 99.5145 75.7603 99.0679 75.281C98.632 74.791 98.414 74.0933 98.414 73.1879V72.421H100.073V73.2998C100.073 73.7045 100.152 73.9868 100.312 74.1466C100.482 74.3064 100.705 74.3862 100.982 74.3862C101.258 74.3862 101.476 74.3064 101.636 74.1466C101.806 73.9868 101.891 73.7045 101.891 73.2998C101.891 72.9163 101.806 72.5808 101.636 72.2932C101.466 71.9949 101.253 71.718 100.998 71.4623C100.743 71.196 100.466 70.9351 100.168 70.6794C99.8813 70.4131 99.6102 70.1255 99.355 69.8166C99.0998 69.5077 98.8871 69.1562 98.717 68.7621C98.5469 68.368 98.4618 67.9046 98.4618 67.372Z" fill="#00A76F"></path>
                <path d="M106.405 69.6568H108.67V71.2546H106.405V75.8722H104.65V64.6878H109.292V66.2855H106.405V69.6568Z" fill="#00A76F"></path>
                <path d="M111.887 69.4012H114.296V70.999H111.887V74.2744H114.918V75.8722H110.133V64.6878H114.918V66.2855H111.887V69.4012Z" fill="#00A76F"></path>
                <path d="M119.673 75.8722C119.652 75.7976 119.631 75.7284 119.609 75.6645C119.588 75.6006 119.567 75.5207 119.546 75.4248C119.535 75.3289 119.524 75.2064 119.514 75.0573C119.514 74.9082 119.514 74.7218 119.514 74.4981V72.7405C119.514 72.2186 119.423 71.8511 119.243 71.6381C119.062 71.425 118.769 71.3185 118.365 71.3185H117.759V75.8722H116.005V64.6878H118.653C119.567 64.6878 120.226 64.9008 120.63 65.3269C121.045 65.7529 121.252 66.3974 121.252 67.2602V68.1389C121.252 69.2893 120.869 70.0456 120.104 70.4078C120.55 70.5889 120.854 70.8871 121.013 71.3025C121.183 71.7073 121.268 72.2026 121.268 72.7885V74.5141C121.268 74.791 121.279 75.036 121.3 75.249C121.321 75.4514 121.375 75.6591 121.46 75.8722H119.673ZM117.759 66.2855V69.7207H118.445C118.775 69.7207 119.03 69.6355 119.211 69.4651C119.402 69.2947 119.498 68.9858 119.498 68.5384V67.4359C119.498 67.0312 119.423 66.7382 119.275 66.5572C119.136 66.3761 118.913 66.2855 118.605 66.2855H117.759Z" fill="#00A76F"></path>
                <path d="M115.405 0H0V13.2128H108.811V27.046L104.89 18.6668L92.9478 18.6668L82.4324 41.1397L71.9171 18.6668H59.9748L49.4595 41.1397L38.9441 18.6668H27.0018L16.4865 41.1397L5.97113 18.6668L1.57227e-05 18.6668V34.133L10.5154 59.5088H22.4576L32.973 37.0359L43.4883 59.5088H55.4306L65.9459 37.0359L76.4613 59.5088H88.4036L98.9189 37.0359L108.811 59.5088L122 59.5088V6.60639L115.405 0Z" fill="#00A76F"></path>
            </svg>
        </div>

        <!-- Форма входа -->
        <h2>Вход в кабинет</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Логин" required>

            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Пароль" required>
                <i class="fa-solid fa-eye" id="togglePassword" onclick="togglePasswordVisibility()"></i>
            </div>

            <button type="submit">Войти</button>
        </form>
        <?php if ($error_message): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>

    <script>
        // Установка закрытого глаза при загрузке страницы
        document.addEventListener('DOMContentLoaded', () => {
            const togglePasswordIcon = document.getElementById('togglePassword');
            togglePasswordIcon.classList.remove('fa-eye');
            togglePasswordIcon.classList.add('fa-eye-slash'); // Устанавливаем иконку "закрытый глаз"
        });

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const togglePasswordIcon = document.getElementById('togglePassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePasswordIcon.classList.remove('fa-eye-slash');
                togglePasswordIcon.classList.add('fa-eye'); // Изменение иконки на открытый глаз
            } else {
                passwordInput.type = 'password';
                togglePasswordIcon.classList.remove('fa-eye');
                togglePasswordIcon.classList.add('fa-eye-slash'); // Изменение иконки на закрытый глаз
            }
        }
    </script>

</body>

</html>