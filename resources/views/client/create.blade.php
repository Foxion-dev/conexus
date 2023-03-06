@extends('layouts.main')
@section('content')
    <form action="{{ route('client.store') }}" method="post" class="default-form deal-form" enctype="multipart/form-data">
        @csrf

        <div class="form-input ">
            <label for="name">Имя</label>
            <input  type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="Введите имя" value="{{ old("name") }}" >
            @error('name')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input ">
            <label for="name">Контакт</label>
            <input  type="text" class="@error('contact') is-invalid @enderror" name="contact" placeholder="Введите контакт" value="{{ old("contact") }}" >
            @error('contact')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input ">
            <label for="person_photo" class="file-label">Загрузить фото</label>
            <input  type="file" id="person_photo" accept="image/*" class="@error('person_photo') is-invalid @enderror" name="person_photo" placeholder="Добавить фото" value="{{ old("person_photo") }}" >
            @error('person_photo')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input ">
            <label for="person_documents"  class="file-label">Загрузить документ</label>
            <input type="file" id="person_documents" accept="image/*" class="@error('person_documents') is-invalid @enderror" name="person_documents" placeholder="Добавить документ" value="{{ old("person_documents") }}" >
            @error('person_documents')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="type">Источник:</label>
            <select name="source_id" class="@error('source_id') is-invalid @enderror">
                <option value="">Не выбрано</option>
                @foreach($sources as $source)
                    <option value="{{ $source->id }}">{{ $source->title }}</option>
                @endforeach
            </select>

            @error('source_id')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
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
            <label for="client_source"></label>
            <button type="submit" class="btn" >Добавить клиента</button>
        </div>

    </form>
@endsection
