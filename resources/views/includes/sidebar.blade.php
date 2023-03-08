<aside>
    <div class="logo">
        <img src="/images/logo.png" alt="logo">
    </div>
    <div class="menu-block">

        <ul>
            <li><i class="fa-solid fa-bolt"></i> <a href="{{ route('index') }}">  Главная</a></li>
            <li><i class="fa-solid fa-plus"></i><a href="{{ route('deal.create') }}">Новая сделка</a></li>
            <li><i class="fa-solid fa-minus"></i><a href="{{ route('expense.create') }}">Новый расход</a></li>
            <li><i class="fa-solid fa-cash-register"></i><a href="{{ route('encashment.create') }}">Инкассация</a></li>
            <li><i class="fa-solid fa-repeat"></i><a href="{{ route('commissions.edit') }}">Обновить комиссию</a></li>
            <li><i class="fa-solid fa-person-circle-plus"></i><a href="{{ route('client.create') }}">Добавить клиента</a></li>
            <li><i class="fa-solid fa-flag"></i><a href="{{ route('source.create') }}">Добавить источник</a></li>
            <li><i class="fa-solid fa-flag"></i><a href="{{ route('rates.index') }}">Курсы валют</a></li>
{{--            <li><i class="fa-solid fa-users-gear"></i><a href="{{ route('register') }}">Добавить оператора</a></li>--}}
        </ul>
    </div>
    <div class="menu-block">
{{--        <div class="menu-block__title">Движение средств</div>--}}
        <ul>
{{--            <li><i class="fa-solid fa-plus-minus"></i><a href="">Разное (Расход/Доход)</a></li>--}}
            <li><i class="fa-solid fa-download"></i><a href="{{ route('requestMoney.create') }}">Запросить средства</a></li>
            <li><i class="fa-solid fa-code-pull-request"></i><a href="{{ route('requestMoney.index') }}">Запросы</a></li>
            <span class="menu-block__separator"></span>
{{--            <li><i class="fa-solid fa-users-gear"></i><a href="{{ route('register') }}">Добавить оператора</a></li>--}}
            <li><i class="fa-solid fa-person-circle-plus"></i><a href="{{ route('collector.create') }}">Добавить инкассатора</a></li>
            <li><i class="fa-solid fa-house-laptop"></i><a href="{{ route('office.create') }}">Добавить офис</a></li>
            <li><i class="fa-solid fa-clock-rotate-left"></i><a href="{{ route('history') }}">История</a></li>
            <li><i class="fa-solid fa-square-poll-vertical"></i><a href="{{ route('statistic.index') }}">Статистика</a></li>
            <li><i class="fa-solid fa-people-group"></i><a href="{{ route('client.index') }}">Список клиентов</a></li>
            <li><i class="fa-solid fa-gear"></i><a href="">Настройки</a></li>
            <li><i class="fa-solid fa-right-from-bracket"></i>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   Выйти
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>

