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

        @if($data['deals'])
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
                        <h5>Действия</h5>
                    </div>
                    @foreach($data['deals'] as $deal)
                        <div class="operations__grid-row">
                            <div>{{  date('H:i', strtotime($deal->created_at))}}</div>
                            <div>{{  $deal->deal_type_id }}</div>
                            <div>{{  $deal->return_currency_id  }}</div>
                            <div>{{  $deal->receiving_sum  }}</div>
                            <div>{{  $deal->commission  }}</div>
                            <div>{{  $deal->commission_sum  }}</div>
                            <div>{{  $deal->return_sum }}</div>
                            <div>{{  $deal->client_id }}</div>
                            <div class="operations__item-actions actions flex-body">
                                <a href="{{ route('deal.show', $deal->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-eye"></i></a>
                                <a href="{{ route('deal.edit', $deal->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('deal.destroy', $deal->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="actions__item actions__item--del"><i class="fa-regular fa-trash-can"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
{{--        <div class="dashboard__last-operations operations">--}}
{{--            <h3 class="operations__title">Последние оформленные сделки</h3>--}}
{{--            <div class="operations__grid">--}}
{{--                <div class="operations__grid-titles">--}}
{{--                    <h5>Время</h5>--}}
{{--                    <h5>Тип</h5>--}}
{{--                    <h5>Валюта</h5>--}}
{{--                    <h5>Сумма</h5>--}}
{{--                    <h5>Процент</h5>--}}
{{--                    <h5>Комиссия</h5>--}}
{{--                    <h5>Отдали</h5>--}}
{{--                    <h5>Контакт</h5>--}}
{{--                    <h5>Действия</h5>--}}
{{--                </div>--}}
{{--                <div class="operations__grid-row">--}}
{{--                    <div>02:17</div>--}}
{{--                    <div>Продажа</div>--}}
{{--                    <div>USDT</div>--}}
{{--                    <div>3333</div>--}}
{{--                    <div>5 %</div>--}}
{{--                    <div>2222 $</div>--}}
{{--                    <div>5555</div>--}}
{{--                    <div>---</div>--}}
{{--                    <div class="operations__item-actions actions">--}}
{{--                        <a href=""  class="actions__item actions__item--edit"><i class="fa-regular fa-pen-to-square"></i></a>--}}
{{--                        <a href=""  class="actions__item actions__item--del"><i class="fa-regular fa-trash-can"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="operations__grid-row">--}}
{{--                    <div>02:17</div>--}}
{{--                    <div>Продажа</div>--}}
{{--                    <div>USDT</div>--}}
{{--                    <div>3333</div>--}}
{{--                    <div>5 %</div>--}}
{{--                    <div>2222 $</div>--}}
{{--                    <div>5555</div>--}}
{{--                    <div>---</div>--}}
{{--                </div>--}}
{{--                <div class="operations__grid-row">--}}
{{--                    <div>02:17</div>--}}
{{--                    <div>Продажа</div>--}}
{{--                    <div>USDT</div>--}}
{{--                    <div>3333</div>--}}
{{--                    <div>5 %</div>--}}
{{--                    <div>2222 $</div>--}}
{{--                    <div>5555</div>--}}
{{--                    <div>---</div>--}}
{{--                    <div class="operations__item-actions actions">--}}
{{--                        <a href=""  class="actions__item actions__item--edit"><i class="fa-regular fa-pen-to-square"></i></a>--}}
{{--                        <a href=""  class="actions__item actions__item--del"><i class="fa-regular fa-trash-can"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

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
