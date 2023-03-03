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
            <li><i class="fa-solid fa-clock-rotate-left"></i><a href="{{ route('history') }}">История</a></li>
            <li><i class="fa-solid fa-repeat"></i><a href="{{ route('commissions.edit') }}">Обновить комиссию</a></li>
        </ul>
    </div>
    <div class="menu-block">
        <div class="menu-block__title">Движение средств</div>
        <ul>
            <li><i class="fa-solid fa-plus-minus"></i><a href="">Разное (Расход/Доход)</a></li>
            <li><i class="fa-solid fa-download"></i><a href="">Запросить средства</a></li>
            <li><i class="fa-solid fa-code-pull-request"></i><a href="">Запросы</a></li>
            <li><i class="fa-solid fa-square-poll-vertical"></i><a href="">Статистика</a></li>
            <span class="menu-block__separator"></span>
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

