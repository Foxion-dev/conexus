@extends('layouts.main')
@section('content')
    <div class="dashboard">
        <h1 class="dashboard__title page-title">Добро пожаловать, {{ auth()->user()->name }}</h1>

        <div class="dashboard__balances-box balance-box">

            <div class="balance-box__item">
                <div class="balance-box__item-title">Остаток USD ($)</div>
                <div class="balance-box__item-value">{{ $data['work_day']->officeDay->leftovers->USD ?? '???' }}</div>
            </div>
            <div class="balance-box__item">
                <div class="balance-box__item-title">Остаток USDT (tether)</div>
                <div class="balance-box__item-value">{{ $data['work_day']->officeDay->leftovers->USDT ?? '???' }}</div>
            </div>
        </div>

        @if(count($data['deals']))
            <div class="dashboard__last-operations operations">
                <h3 class="operations__title section-title">Последние оформленные сделки</h3>
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
                            <div>{{  $deal->type->title }}</div>
                            <div>{{  $deal->returnCurrency->title  }}</div>
                            <div>{{  $deal->receiving_sum  }}</div>
                            <div>{{  $deal->commission  }}</div>
                            <div>{{  $deal->commission_sum  }}</div>
                            <div>{{  $deal->return_sum }}</div>
                            <div>{{  $deal->client->name }}</div>
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
        @if(count($data['expenses']))
            <div class="dashboard__last-operations operations operations--expense">
                <h3 class="operations__title section-title">Последние расходы</h3>
                <div class="operations__grid">
                    <div class="operations__grid-titles">
                        <h5>Время</h5>
                        <h5>Сумма</h5>
                        <h5>Валюта</h5>
                        <h5>Комментарий</h5>
                        <h5>Действия</h5>
                    </div>
                    @foreach($data['expenses'] as $expense)
                        <div class="operations__grid-row">
                            <div>{{  date('H:i', strtotime($expense->created_at))}}</div>
                            <div>{{  $expense->amount }}</div>
                            <div>{{  $expense->currency->title  }}</div>
                            <div>{{  $expense->comment  }}</div>
                            <div class="operations__item-actions actions flex-body">
                                <a href="{{ route('expense.show', $expense->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-eye"></i></a>
                                <a href="{{ route('expense.edit', $expense->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('expense.destroy', $expense->id) }}" method="post">
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

        @if(count($data['encashments']))
            <div class="dashboard__last-operations operations operations--encashments">
                <h3 class="operations__title section-title">Последние инкассации</h3>
                <div class="operations__grid">
                    <div class="operations__grid-titles">
                        <h5>Время</h5>
                        <h5>Тип</h5>
                        <h5>Сумма</h5>
                        <h5>Валюта</h5>
                        <h5>Инкассатор</h5>
                        <h5>Действия</h5>
                    </div>
                    @foreach($data['encashments'] as $encashment)
                        <div class="operations__grid-row">
                            <div>{{  date('H:i', strtotime($encashment->created_at))}}</div>
                            <div>{{  $encashment->type->title }}</div>
                            <div>{{  $encashment->amount }}</div>
                            <div>{{  $encashment->currency->title  }}</div>
                            <div>{{  $encashment->collector->name  }}</div>
                            <div class="operations__item-actions actions flex-body">
                                <a href="{{ route('encashment.show', $encashment->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-eye"></i></a>
                                <a href="{{ route('encashment.edit', $encashment->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('encashment.destroy', $encashment->id) }}" method="post">
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
