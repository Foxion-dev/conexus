@extends('layouts.main')
@section('content')
    <div class="operations">
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

            <div  class="operations__grid-row">
                <div>{{  date('H:i', strtotime($deal->created_at))}}</div>
                <div>{{  $deal->deal_type_id }}</div>
                <div>{{  $deal->return_currency_id  }}</div>
                <div>{{  $deal->receiving_sum  }}</div>
                <div>{{  $deal->commission  }}</div>
                <div>{{  $deal->commission  }}</div>
                <div>{{  $deal->return_sum }}</div>
                <div>{{  $deal->client_id }}</div>
                <div class="operations__item-actions actions flex-body flex-no-wrap">
{{--                    <a href="{{ route('deal.show', $deal->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-eye"></i></a>--}}
                    <a href="{{ route('deal.edit', $deal->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="{{ route('deal.destroy', $deal->id) }}"  class="actions__item actions__item--del"><i class="fa-regular fa-trash-can"></i></a>
                </div>
            </div>

        </div>
    </div>
@endsection
