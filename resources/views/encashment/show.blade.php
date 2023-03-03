@extends('layouts.main')
@section('content')
    <div>
        <div class="dashboard__last-operations operations operations--encashments">
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Время</h5>
                    <h5>Тип</h5>
                    <h5>Сумма</h5>
                    <h5>Валюта</h5>
                    <h5>Инкассатор</h5>
                </div>
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
            </div>
        </div>
    </div>
@endsection
