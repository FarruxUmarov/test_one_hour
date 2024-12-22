<!-- Modal Structure -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h5>Добавить реквизит</h5>
        <form>
            <!-- Чекбоксы для выбора -->
            <div style="margin-bottom: 10px;">
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="rekvizit" value="SBP" id="sbp">
                    <label for="sbp"></label> СБП
                </label>
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="rekvizit" value="Alfa" id="alfa">
                    <label for="alfa"></label> Alfa
                </label>
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="rekvizit" value="Sber" id="sber">
                    <label for="sber"></label> Sber
                </label>
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="rekvizit" value="Tinkoff" id="tinkoff">
                    <label for="tinkoff"></label> Tinkoff
                </label>
            </div>

            <!-- Выпадающий список для выбора валюты -->
            <div>

                <div class="custom-dropdown">
                    <button class="dropbtn2" id="currencySelectBtn">Выберите валюту </button><i class="fas fa-caret-down dropdown-icon"></i>
                    <ul class="dropdown-menu" id="currencyDropdown">
                        <li><a href="#" data-value="rub">Выберите валюту</a></li>
                        <li><a href="#" data-value="rub">RUB</a></li>
                        <li><a href="#" data-value="som">SOM</a></li>
                    </ul>
                </div>
            </div>


            <!-- Поля для ввода лимитов -->
            <div>
                <input type="number" id="limit" name="limit" placeholder="- Лимит" min="0">
            </div>
            <div>
                <input type="number" id="minAmount" name="minAmount" placeholder="- Минимальная сумма" min="0">
            </div>
            <div>
                <label for="maxAmount"></label>
                <input type="number" id="maxAmount" name="maxAmount" placeholder=" Максимальная сумма">
            </div>

            <!-- Поле для ввода ФИО -->
            <div>
                <input type="text" id="fio" name="fio" placeholder="ФИО" required>
            </div>
            <div>
                <input type="text" id="cardnum" name="cardnum" placeholder="Номер карты" required>
            </div>
            <div>
                <input type="text" id="bank" name="bank" placeholder="Банк" required>
            </div>
            <div>
                <input type="text" id="phone" name="phone" placeholder="Номер телефона" required>
            </div>
            <!-- Кнопка сохранить -->
            <button type="submit">Сохранить</button>
        </form>
    </div>
</div>

<!-- Модальное окно добавление аккаунта-->
<div id="addAccountModal" class="modal2">
    <div class="modal-content2">
        <span class="close2">&times;</span>
        <h3>Добавить аккаунт</h3>
        <form id="addAccountForm">
            <input type="text" name="name" placeholder="Имя" required>
            <input type="text" name="telegramId" placeholder="ID Телеграм" required>
            <input type="number" name="percentIn" placeholder="Процент ввода" required>
            <input type="number" name="percentOut" placeholder="Процент вывода" required>

            <!-- Лимит на день с рублем в самом инпуте -->
            <div id="limitContainer" style="display: none;" class="foo">
                <input type="number" name="limitId" placeholder="&nbsp;&nbsp;Лимит на день" required>
            </div>



            <div class="checkbox-group">
                <input type="checkbox" id="verified" name="verified">
                <label for="verified">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Проверенный</label>
            </div>

            <p class="info-text">
                Вы можете создать дочерний аккаунт с разницей в процентах. С помощью него вы можете делегировать работу на своих партнеров и коллег.<br>
                Статус «проверенный» - будет работать с помощью вашего рабочего баланса.<br>
                Статус «не проверенный» - необходимо будет пополнить баланс, для того, что бы принимать активные заявки.<br>
                После создания аккаунта дроповоду отправьте ему нашего телеграмм бота
                <a href="" style="color: #40E0D0;  text-decoration: none;">@WorldMoneyTransferBot</a>
            </p>

            <button type="submit" class="submit-btn">Создать</button>
        </form>
    </div>
</div>