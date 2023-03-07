@extends('layouts.main')
@section('content')

    <div>
        <div class="operations operations--offices">
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Дата создания</h5>
                    <h5>Наименование</h5>
                </div>
                @foreach($offices as $office)
                    <div class="operations__grid-row">
                        <div>{{  date('d.m.Y H:i', strtotime($office->created_at))}}</div>
                        <div>{{  $office->name }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <form action="{{ route('office.store') }}" method="post" class="default-form deal-form">
        @csrf

        <div class="form-input ">
            <label for="name">Наименование</label>
            <input  type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="Введите наименование" value="{{ old("name") }}" >
            @error('name')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="client_source"></label>
            <button type="submit" class="btn" >Добавить офис</button>
        </div>

    </form>
@endsection
