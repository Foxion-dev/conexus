@extends('layouts.app')
@section('content')
    <div class="dashboard">
        <h1 class="dashboard__title page-title">{{ auth()->user()->name }}, Ваш рабочий день в офисе "{{ $data['work_day']->officeDay->office->name }}" завершен!</h1>
        <div class="flex-body">
            <a class="btn" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                Выйти
            </a>
            <a href="{{ route('auth.start') }}" class="btn">Сменить офис</a>
        </div>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
@endsection
