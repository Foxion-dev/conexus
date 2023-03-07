@extends('layouts.main')
@section('content')
    <div>
        @if(count($requests['inside']))
            <div class="operations operations--requests">
                <h3 class="operations__title section-title">Внутренние</h3>
                <div class="operations__grid">
                    <div class="operations__grid-titles">
                        <h5>Дата создания</h5>
                        <h5>Источник (Пользователь)</h5>
                        <h5>Источник (Офис)</h5>
                        <h5>Валюта</h5>
                        <h5>Сумма</h5>
                        <h5>Исполнитель (офис)</h5>
                        <h5>Инкассатор</h5>
                        <h5>Статус</h5>
                        <h5>Действия</h5>
                    </div>
                    @foreach($requests['inside'] as $request)
                        <div  class="operations__grid-row">
                            <div>{{  date('d.m.Y H:i', strtotime($request->created_at))}}</div>
                            <div>{{  $request->workDay->user->name }}</div>
                            <div>{{  $request->startOffice->name }}</div>
                            <div>{{  $request->currency->title }}</div>
                            <div>{{  $request->amount }}</div>
                            <div>{{  $request->requestOffice->name }}</div>
                            <div>{{  $request->collector->name ?? '-' }}</div>
                            @switch($request->status->id)
                                @case(1)
                                    <div class="blue">{{  $request->status->title }}</div>
                                @break
                                @case(2)
                                    <div class="blue">{{  $request->status->title }}</div>
                                @break
                                @case(3)
                                    <div class="green">{{  $request->status->title }}</div>
                                @break
                                @case(4)
                                    <div class="red">{{  $request->status->title }}</div>
                                @break

                                @default
                                @break
                            @endswitch

                            <div class="operations__item-actions actions flex-body">
    {{--                            <a href="{{ route('requestMoney.show', $request->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-eye"></i></a>--}}
    {{--                            <a href="{{ route('requestMoney.edit', $request->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-pen-to-square"></i></a>--}}
                                <form action="{{ route('requestMoney.destroy', $request->id) }}" method="post">
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
        @if(count($requests['outside']))
            <div class="operations operations--requests">
                <h3 class="operations__title section-title">Внешние</h3>
                <div class="operations__grid">
                    <div class="operations__grid-titles">
                        <h5>Дата создания</h5>
                        <h5>Источник (Пользователь)</h5>
                        <h5>Источник (Офис)</h5>
                        <h5>Валюта</h5>
                        <h5>Сумма</h5>
                        <h5>Исполнитель (офис)</h5>
                        <h5>Инкассатор</h5>
                        <h5>Статус</h5>
                        <h5>Действия</h5>
                    </div>
                    @foreach($requests['outside'] as $request)
                        <div  class="operations__grid-row">
                            <div>{{  date('d.m.Y H:i', strtotime($request->created_at))}}</div>
                            <div>{{  $request->workDay->user->name }}</div>
                            <div>{{  $request->startOffice->name }}</div>
                            <div>{{  $request->currency->title }}</div>
                            <div>{{  $request->amount }}</div>
                            <div>{{  $request->requestOffice->name }}</div>
                            <div>{{  $request->collector->name ?? '-' }}</div>
                            @switch($request->status->id)
                                @case(1)
                                <div class="blue">{{  $request->status->title }}</div>
                                @break
                                @case(2)
                                <div class="blue">{{  $request->status->title }}</div>
                                @break
                                @case(3)
                                <div class="green">{{  $request->status->title }}</div>
                                @break
                                @case(4)
                                <div class="red">{{  $request->status->title }}</div>
                                @break
                                @default
                                <div>{{  $request->status->title }}</div>
                                @break
                            @endswitch

                            <div class="operations__item-actions actions flex-body">
                                <form action="{{ route('requestMoney.destroy', $request->id) }}" method="post">
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
    </div>
@endsection
