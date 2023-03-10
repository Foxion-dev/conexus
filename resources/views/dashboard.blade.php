@extends('layouts.main')
@section('content')
    <div class="dashboard">
        <h1 class="dashboard__title page-title">Добро пожаловать, {{ auth()->user()->name }}</h1>
        @if(session('message'))
            <h3 class="dashboard__message session-message {{ session('status') == 'error' ? ' session-message--error ' : ' ' }}">{{ session('message') }}</h3>
        @endif

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
                <a href="{{ route('office.close') }}" class="btn btn-default"><i class="fa-solid fa-lock"></i> <span>Закрыть день</span></a>
                <a href="{{ route('day.close') }}" class="btn btn-default"><i class="fa-solid fa-house-lock"></i> Закрыть смену</a>
            </div>
{{--            <div class="dashboard__buttons-row">--}}
{{--                <a href="" class="btn btn-default"><i class="fa-solid fa-arrow-right-arrow-left"></i>Обмен валюты</a>--}}
{{--            </div>--}}
            <div class="dashboard__buttons-row">
                <button class="btn btn-red js-open-warning-form"><i class="fa-solid fa-triangle-exclamation"></i> Обнаружено несоответствие</button>
            </div>
        </div>

        <form action="{{ route('warning.message') }}" method="post" enctype="multipart/form-data" class="dashboard__warning-form form-default">
            @csrf
            <div class="form-default__title section-title">Данные несоответствия</div>
            <div class="form-default__title section-title">USD</div>
            <div class="flex-body">
                <div class="form-input">
                    <label for="usd_fact">Факт</label>
                    <input type="text" class="@error('usd_fact') is-invalid @enderror" name="usd_fact" placeholder="Факт" value="">

                    @error('usd_fact')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-input">
                    <label for="usd_system">В системе</label>
                    <input type="text" class="@error('usd_system') is-invalid @enderror disabled" name="usd_system" placeholder="В системе" value="{{ $data['work_day']->officeDay->leftovers->USD ?? 0 }}">

                    @error('usd_system')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>
            <div class="form-default__title section-title">USDT</div>
            <div class="flex-body">
                <div class="form-input">
                    <label for="usdt_fact">Факт</label>
                    <input type="text" class="@error('usdt_fact') is-invalid @enderror" name="usdt_fact" placeholder="Факт" value="">

                    @error('usdt_fact')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-input">
                    <label for="usdt_system">В системе</label>
                    <input type="text" class="@error('usdt_system') is-invalid @enderror disabled" name="usdt_system" placeholder="В системе" value="{{ $data['work_day']->officeDay->leftovers->USDT ?? 0 }}">

                    @error('usdt_system')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>
            <div class="form-default__title section-title">GEL</div>
            <div class="flex-body">
                <div class="form-input">
                    <label for="gel_fact">Факт</label>
                    <input type="text" class="@error('gel_fact') is-invalid @enderror" name="gel_fact" placeholder="Факт" value="">

                    @error('gel_fact')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-input">
                    <label for="gel_system">В системе</label>
                    <input type="text" class="@error('gel_system') is-invalid @enderror disabled" name="gel_system" placeholder="В системе" value="{{ $data['work_day']->officeDay->leftovers->GEL ?? 0 }}">

                    @error('gel_system')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>
            <div class="form-default__title section-title">KZT</div>
            <div class="flex-body">
                <div class="form-input">
                    <label for="kzt_fact">Факт</label>
                    <input type="text" class="@error('kzt_fact') is-invalid @enderror" name="kzt_fact" placeholder="Факт" value="">

                    @error('kzt_fact')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-input">
                    <label for="kzt_system">В системе</label>
                    <input type="text" class="@error('kzt_system') is-invalid @enderror disabled" name="kzt_system" placeholder="В системе" value="{{ $data['work_day']->officeDay->leftovers->KZT ?? 0 }}">

                    @error('kzt_system')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

            <div class="form-input">
                <label for="comment">Комментарий</label>
                <textarea type="text" class="@error('comment') is-invalid @enderror" name="comment">{{ old("comment") }}</textarea>

                @error('comment')
                <span class="form-input__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
            <div class="form-input">
                <button type="submit" class="btn">Отправить</button>
            </div>
        </form>
    </div>
@endsection
