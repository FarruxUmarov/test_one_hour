<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление реквизитами</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media (max-width: 1270px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                height: 100%;
                background-color: white;
                transition: transform 0.3s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Встраиваемые символы для иконок -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="burger-icon" viewBox="0 0 24 24">
            <line x1="3" y1="6" x2="21" y2="6" stroke="black" stroke-width="2" stroke-linecap="round" />
            <line x1="3" y1="12" x2="15" y2="12" stroke="black" stroke-width="2" stroke-linecap="round" />
            <line x1="3" y1="18" x2="9" y2="18" stroke="black" stroke-width="2" stroke-linecap="round" />
        </symbol>
        <symbol id="close-icon" viewBox="0 0 24 24">
            <line x1="6" y1="6" x2="18" y2="18" stroke="black" stroke-width="2" stroke-linecap="round" />
            <line x1="6" y1="18" x2="18" y2="6" stroke="black" stroke-width="2" stroke-linecap="round" />
        </symbol>
    </svg>

    <div id="app" class="flex flex-col md:flex-row">
        <!-- Кнопка меню для мобильных -->
        <header class="bg-white p-4 shadow flex justify-between items-center md:hidden">
            <button id="menu-button" class="text-gray-700 focus:outline-none">
                <svg id="menu-icon" class="w-6 h-6">
                    <use xlink:href="#burger-icon"></use>
                </svg>
            </button>
            <span class="font-bold">Work</span>
        </header>

        <!-- Левое меню -->
        <aside id="sidebar" class="sidebar md:block bg-white w-full md:w-1/4 p-4 border-r">
            <div class="flex items-center space-x-2 mb-4">
                <div class="bg-green-500 text-white font-bold rounded p-2">WM</div>
                <span class="font-bold text-lg">Work</span>
            </div>
            <nav class="space-y-2">
                <a href="#" class="block p-2 rounded hover:bg-gray-200">Главная</a>
                <a href="#" class="block p-2 rounded hover:bg-gray-200">Курсы валют</a>
                <a href="#" class="block p-2 rounded hover:bg-gray-200">Аккаунты</a>
                <a href="#" class="block p-2 rounded hover:bg-gray-200">Уведомления</a>
                <a href="#" class="block p-2 rounded hover:bg-gray-200">Pay in</a>
                <a href="#" class="block p-2 rounded hover:bg-gray-200">История пополнений</a>
                <a href="#" class="block p-2 rounded hover:bg-gray-200">Вывод</a>
                <a href="#" class="block p-2 rounded hover:bg-gray-200">Настройки</a>
                <a href="#" class="block p-2 rounded text-red-500 hover:bg-gray-200">Выйти</a>
            </nav>
        </aside>

        <!-- Основной контент -->
        <main class="flex-1 p-4">
            <!-- Верхняя панель -->
            <div class="flex justify-between items-center bg-white p-4 rounded shadow">
                <div>
                    <h1 class="text-lg font-bold">Реквизиты</h1>
                </div>
                <div>
                    <span class="font-semibold">Логин:</span> NotApp
                    <span class="ml-4 font-semibold">Баланс:</span> 0.00 $
                    <span class="ml-4 font-semibold">Hold:</span> 0.00 $
                </div>
            </div>

            <!-- Карточки статуса -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow">
                    <div class="text-lg font-bold">Всего</div>
                    <div class="text-2xl">0</div>
                </div>
                <div class="bg-red-100 text-red-800 p-4 rounded shadow">
                    <div class="text-lg font-bold">Активные</div>
                    <div class="text-2xl">0</div>
                </div>
                <div class="bg-green-100 text-green-800 p-4 rounded shadow">
                    <div class="text-lg font-bold">В работе</div>
                    <div class="text-2xl">0</div>
                </div>
                <div class="bg-gray-100 text-gray-800 p-4 rounded shadow">
                    <div class="text-lg font-bold">На паузе</div>
                    <div class="text-2xl">0</div>
                </div>
            </div>

            <!-- Таблица реквизитов -->
            <div class="mt-4 bg-white p-4 rounded shadow">
                <div class="flex justify-between items-center mb-4">
                    <input type="text" placeholder="Поиск по картам" class="border p-2 rounded w-1/2">
                    <button class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Добавить реквизит</button>
                </div>
                <p class="text-gray-500 text-center">Ничего не найдено</p>
            </div>
        </main>
    </div>

    <script>
        const menuButton = document.getElementById("menu-button");
        const sidebar = document.getElementById("sidebar");
        const menuIcon = document.getElementById("menu-icon");

        menuButton.addEventListener("click", () => {
            sidebar.classList.toggle("open");

            if (sidebar.classList.contains("open")) {
                menuIcon.innerHTML = '<use xlink:href="#close-icon"></use>';
            } else {
                menuIcon.innerHTML = '<use xlink:href="#burger-icon"></use>';
            }
        });
    </script>
</body>
</html>
