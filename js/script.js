function showContent(contentId) {
    // Скрыть все разделы
    const sections = [
        'home', 'currency', 'accounts', 'notification', 'payIn',
        'payInHistory', 'payOut', 'recharge', 'rechargeHistory',
        'withdraw', 'withdrawHistory', 'settings'
    ];
    sections.forEach(id => document.getElementById(id).style.display = 'none');

    // Показать выбранный раздел
    document.getElementById(contentId).style.display = 'block';

    // Убрать класс "active" у всех ссылок и добавить только выбранной
    const links = document.querySelectorAll('.sidebar a');
    links.forEach(link => link.classList.remove('active'));
    document.getElementById(contentId + 'Link').classList.add('active');
}

// Показать "Главная" по умолчанию
showContent('home');

// Toggle the dropdown menu when clicking on the "Мои реквизиты" button
document.querySelector('.dropbtn').addEventListener('click', function (event) {
    var dropdownMenu = this.nextElementSibling; // Find the dropdown menu
    var isMenuVisible = dropdownMenu.style.display === 'block';
    // Toggle visibility
    dropdownMenu.style.display = isMenuVisible ? 'none' : 'block';

    // Prevent the click from propagating to the document click listener
    event.stopPropagation();
});

// Close the dropdown menu when clicking anywhere outside
document.addEventListener('click', function (event) {
    var dropdownMenu = document.querySelector('.dropdown-menu');
    var dropbtn = document.querySelector('.dropbtn');

    // Check if the click is outside the dropdown and the button
    if (!dropdownMenu.contains(event.target) && !dropbtn.contains(event.target)) {
        dropdownMenu.style.display = 'none'; // Hide the dropdown menu
    }
});


// Get the modal and the button that opens the modal
var modal = document.getElementById("myModal");
var btn = document.getElementById("openModal");
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Обработчик для открытия/закрытия dropdown валют
document.getElementById("currencySelectBtn").addEventListener("click", function (event) {
    var dropdown = document.getElementById("currencyDropdown");
    var isVisible = dropdown.style.display === 'block';
    dropdown.style.display = isVisible ? 'none' : 'block';
    event.stopPropagation();
});

// Закрыть dropdown, если клик был не на нем
document.addEventListener("click", function (event) {
    var dropdown = document.getElementById("currencyDropdown");
    if (!dropdown.contains(event.target) && event.target !== document.getElementById("currencySelectBtn")) {
        dropdown.style.display = "none";
    }
});

// Выбор валюты
document.querySelectorAll("#currencyDropdown a").forEach(function (item) {
    item.addEventListener("click", function (event) {
        event.preventDefault();
        var selectedCurrency = item.getAttribute("data-value");
        document.getElementById("currencySelectBtn").textContent = item.textContent;
        document.getElementById("currency").value = selectedCurrency; // Устанавливаем выбранную валюту в скрытый input
        document.getElementById("currencyDropdown").style.display = "none";
    });
});


// Получаем ссылки на элементы
const sbpCheckbox = document.getElementById('sbp');
const otherCheckboxes = Array.from(
    document.querySelectorAll("input[type='checkbox'][name='rekvizit']:not(#sbp)")
);
const cardField = document.getElementById('cardnum').parentElement;
const bankField = document.getElementById('bank').parentElement;
const phoneField = document.getElementById('phone').parentElement;

// Функция для скрытия всех дополнительных полей
function hideFields() {
    cardField.style.display = 'none';
    bankField.style.display = 'none';
    phoneField.style.display = 'none';
}

// Функция для обработки выбора чекбоксов
function handleCheckboxChange() {
    if (sbpCheckbox.checked) {
        // Если выбран "СПБ", показываем все поля
        cardField.style.display = 'block';
        bankField.style.display = 'block';
        phoneField.style.display = 'block';
    } else {
        // Если выбран любой другой чекбокс, показываем только поле "Номер карты"
        const anyOtherChecked = otherCheckboxes.some((checkbox) => checkbox.checked);
        if (anyOtherChecked) {
            cardField.style.display = 'block';
            bankField.style.display = 'none';
            phoneField.style.display = 'none';
        } else {
            hideFields(); // Скрываем все поля, если ничего не выбрано
        }
    }
}

// Добавляем обработчики событий для всех чекбоксов
sbpCheckbox.addEventListener('change', handleCheckboxChange);
otherCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', handleCheckboxChange);
});

// Изначально скрываем все дополнительные поля
hideFields();


// Скрипт для управления модальным окном "Добавить аккаунт"

// Получение элементов
const addAccountModal = document.getElementById('addAccountModal');
const addAccountBtn = document.getElementById('addAccountBtn');
const closeBtn = document.querySelector('.modal2 .close2');

// Открытие модального окна при нажатии на кнопку "Добавить аккаунт"
addAccountBtn.addEventListener('click', () => {
    addAccountModal.style.display = 'block';
});

// Закрытие модального окна при нажатии на крестик
closeBtn.addEventListener('click', () => {
    addAccountModal.style.display = 'none';
});

// Закрытие модального окна при клике вне его области
window.addEventListener('click', (event) => {
    if (event.target === addAccountModal) {
        addAccountModal.style.display = 'none';
    }
});

// Обработчик формы
const addAccountForm = document.getElementById('addAccountForm');
addAccountForm.addEventListener('submit', (event) => {
    event.preventDefault();

    // Получение данных из формы
    const formData = new FormData(addAccountForm);
    const accountData = {
        name: formData.get('name'),
        telegramId: formData.get('telegramId'),
        percentIn: formData.get('percentIn'),
        percentOut: formData.get('percentOut'),
        verified: formData.get('verified') === 'on' // Проверяем, установлен ли чекбокс
    };

    // Логика обработки данных (например, отправка на сервер или сохранение в массив)
    console.log('Данные нового аккаунта:', accountData);

    // Очистка формы и закрытие модального окна
    addAccountForm.reset();
    addAccountModal.style.display = 'none';

    // Добавление нового аккаунта в список (пример)
    const emptyMessage = document.getElementById('emptyMessage');
    if (emptyMessage) emptyMessage.style.display = 'none';

    const accountsContainer = document.getElementById('accounts');
    const accountElement = document.createElement('div');
    accountElement.className = 'account';
    accountElement.innerHTML = `
<p><strong>Имя:</strong> ${accountData.name}</p>
<p><strong>ID Телеграм:</strong> ${accountData.telegramId}</p>
<p><strong>Процент ввода:</strong> ${accountData.percentIn}%</p>
<p><strong>Процент вывода:</strong> ${accountData.percentOut}%</p>
<p><strong>Статус:</strong> ${accountData.verified ? 'Проверенный' : 'Не проверенный'}</p>
`;
    accountsContainer.appendChild(accountElement);
});


// Получаем чекбокс и контейнер с лимитом
const verifiedCheckbox = document.getElementById('verified');
const limitContainer = document.getElementById('limitContainer');

// Слушаем изменения состояния чекбокса
verifiedCheckbox.addEventListener('change', function () {
    if (verifiedCheckbox.checked) {
        // Показываем поле с лимитом, если чекбокс выбран
        limitContainer.style.display = 'block';
    } else {
        // Скрываем поле с лимитом, если чекбокс не выбран
        limitContainer.style.display = 'none';
    }
});

document.getElementById('addAcc').onclick = function () {
    // Показать секцию "Пополнение"
    showContent('recharge');

    // Убедиться, что класс "active" добавлен к пункту меню "Пополнение"
    document.getElementById('rechargeLink').classList.add('active');
};
