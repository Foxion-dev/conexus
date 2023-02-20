@extends('layouts.main')
@section('content')
    <div class="dashboard">
        <h1 class="dashboard__title">Добро пожаловать, Имя</h1>

        <div class="dashboard__balances-box balance-box">
            <div class="balance-box__item">
                <div class="balance-box__item-title">Остаток USD ($)</div>
                <div class="balance-box__item-value">9999999</div>
            </div>
            <div class="balance-box__item">
                <div class="balance-box__item-title">Остаток USDT (tether)</div>
                <div class="balance-box__item-value">9999999</div>
            </div>
        </div>

        <div class="dashboard__last-operations operations">
            <h3 class="operations__title">Последние оформленные сделки</h3>
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Время</h5>
                    <h5>Тип</h5>
                    <h5>Валюта</h5>
                    <h5>Сумма</h5>
                    <h5>Процент</h5>
                    <h5>Комиссия</h5>
                    <h5>Отдали</h5>
                    <h5>Контакт</h5>
                </div>
                <div class="operations__grid-row">
                    <div>02:17</div>
                    <div>Продажа</div>
                    <div>USDT</div>
                    <div>3333</div>
                    <div>5 %</div>
                    <div>2222 $</div>
                    <div>5555</div>
                    <div>---</div>
                </div>
                <div class="operations__grid-row">
                    <div>02:17</div>
                    <div>Продажа</div>
                    <div>USDT</div>
                    <div>3333</div>
                    <div>5 %</div>
                    <div>2222 $</div>
                    <div>5555</div>
                    <div>---</div>
                </div>
                <div class="operations__grid-row">
                    <div>02:17</div>
                    <div>Продажа</div>
                    <div>USDT</div>
                    <div>3333</div>
                    <div>5 %</div>
                    <div>2222 $</div>
                    <div>5555</div>
                    <div>---</div>
                </div>
            </div>
        </div>

        <div class="dashboard__last-operations operations">
            <h3 class="operations__title">Последние расходы</h3>
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Время</h5>
                    <h5>Тип</h5>
                    <h5>Валюта</h5>
                    <h5>Сумма</h5>
                    <h5>Процент</h5>
                    <h5>Комиссия</h5>
                    <h5>Отдали</h5>
                    <h5>Контакт</h5>
                </div>
                <div class="operations__grid-row">
                    <div>02:17</div>
                    <div>Продажа</div>
                    <div>USDT</div>
                    <div>3333</div>
                    <div>5 %</div>
                    <div>2222 $</div>
                    <div>5555</div>
                    <div>---</div>
                </div>
                <div class="operations__grid-row">
                    <div>02:17</div>
                    <div>Продажа</div>
                    <div>USDT</div>
                    <div>3333</div>
                    <div>5 %</div>
                    <div>2222 $</div>
                    <div>5555</div>
                    <div>---</div>
                </div>
                <div class="operations__grid-row">
                    <div>02:17</div>
                    <div>Продажа</div>
                    <div>USDT</div>
                    <div>3333</div>
                    <div>5 %</div>
                    <div>2222 $</div>
                    <div>5555</div>
                    <div>---</div>
                </div>
            </div>
        </div>

        <div class="dashboard__last-operations operations">
            <h3 class="operations__title">Последние инкассации</h3>
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Время</h5>
                    <h5>Тип</h5>
                    <h5>Валюта</h5>
                    <h5>Сумма</h5>
                    <h5>Процент</h5>
                    <h5>Комиссия</h5>
                    <h5>Отдали</h5>
                    <h5>Контакт</h5>
                </div>
                <div class="operations__grid-row">
                    <div>02:17</div>
                    <div>Продажа</div>
                    <div>USDT</div>
                    <div>3333</div>
                    <div>5 %</div>
                    <div>2222 $</div>
                    <div>5555</div>
                    <div>---</div>
                </div>
                <div class="operations__grid-row">
                    <div>02:17</div>
                    <div>Продажа</div>
                    <div>USDT</div>
                    <div>3333</div>
                    <div>5 %</div>
                    <div>2222 $</div>
                    <div>5555</div>
                    <div>---</div>
                </div>
                <div class="operations__grid-row">
                    <div>02:17</div>
                    <div>Продажа</div>
                    <div>USDT</div>
                    <div>3333</div>
                    <div>5 %</div>
                    <div>2222 $</div>
                    <div>5555</div>
                    <div>---</div>
                </div>
            </div>
        </div>

        <div class="dashboard__buttons">
            <div class="dashboard__buttons-row">
                <a href="" class="btn btn-default"><i class="fa-solid fa-lock"></i> <span>Закрыть день</span></a>
                <a href="" class="btn btn-default"><i class="fa-solid fa-house-lock"></i> Закрыть смену</a>
            </div>
            <div class="dashboard__buttons-row">
                <a href="" class="btn btn-default"><i class="fa-solid fa-arrow-right-arrow-left"></i>Обмен валюты</a>
            </div>
            <div class="dashboard__buttons-row">
                <a href="" class="btn btn-red"><i class="fa-solid fa-triangle-exclamation"></i> Обнаружено несоответствие</a>
            </div>
        </div>
    </div>
@endsection
