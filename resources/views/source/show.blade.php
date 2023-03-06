@extends('layouts.main')
@section('content')
    <div>
        <div class="operations operations--expense">
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Время</h5>
                    <h5>Сумма</h5>
                    <h5>Валюта</h5>
                    <h5>Комментарий</h5>
                </div>
                <div href="{{ route('expense.show', $expense->id) }}" class="operations__grid-row">
        <div>{{  date('d.m.Y H:i', strtotime($expense->created_at))}}</div>
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
            </div>
        </div>
    </div>
@endsection
