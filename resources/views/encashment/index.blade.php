@extends('layouts.main')
@section('content')
    <div>
        <div class="operations operations--encashment">
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Время</h5>
                    <h5>Сумма</h5>
                    <h5>Валюта</h5>
                    <h5>Комментарий</h5>
                </div>
                @foreach($encashments as $encashment)
                    <div href="{{ route('encashment.show', $encashment->id) }}" class="operations__grid-row">
                        <div>{{  date('d.m.Y H:i', strtotime($encashment->created_at))}}</div>
                        <div>{{  $encashment->amount }}</div>
                        <div>{{  $encashment->currency->title  }}</div>
                        <div>{{  $encashment->comment  }}</div>
                        <div class="operations__item-actions actions flex-body flex-no-wrap">
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
    </div>
@endsection
