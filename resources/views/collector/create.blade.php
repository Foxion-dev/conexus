@extends('layouts.main')
@section('content')

    <div>
        <div class="operations operations--sources">
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Дата создания</h5>
                    <h5>Имя</h5>
                    <h5>Действия</h5>
                </div>
                @foreach($collectors as $collector)
                    <div class="operations__grid-row">
                        <div>{{  date('d.m.Y H:i', strtotime($collector->created_at))}}</div>
                        <div>{{  $collector->name }}</div>
                        <div class="operations__item-actions actions flex-body flex-no-wrap">
                            <form action="{{ route('collector.destroy', $collector->id) }}" method="post">
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
    <form action="{{ route('collector.store') }}" method="post" class="default-form deal-form">
        @csrf

        <div class="form-input ">
            <label for="title">Имя</label>
            <input  type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="Введите имя" value="{{ old("name") }}" >
            @error('name')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="client_source"></label>
            <button type="submit" class="btn" >Добавить инкассатора</button>
        </div>

    </form>
@endsection
