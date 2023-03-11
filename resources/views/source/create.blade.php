@extends('layouts.main')
@section('content')

    <div>
        <div class="operations operations--sources">
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Дата создания</h5>
                    <h5>Наименование</h5>
                    <h5>Действия</h5>
                </div>
                @foreach($sources as $source)
                    <div class="operations__grid-row">
                        <div>{{  date('d.m.Y H:i', strtotime($source->created_at))}}</div>
                        <div>{{  $source->title }}</div>
                        <div class="operations__item-actions actions flex-body flex-no-wrap">
                            <form action="{{ route('source.destroy', $source->id) }}" method="post">
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
    <form action="{{ route('source.store') }}" method="post" class="default-form deal-form">
        @csrf

        <div class="form-input ">
            <label for="title">Наименование</label>
            <input  type="text" class="@error('title') is-invalid @enderror" name="title" placeholder="Введите наименование" value="{{ old("title") }}" >
            @error('title')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="client_source"></label>
            <button type="submit" class="btn" >Добавить источник</button>
        </div>

    </form>
@endsection
