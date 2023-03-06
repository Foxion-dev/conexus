@extends('layouts.main')
@section('content')
    <form action="{{ route('client.update', $client->id) }}" method="post" class="default-form deal-form"  enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-input ">
            <label for="name">Имя</label>
            <input  type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="Введите имя" value="{{ $client->name ?? old("name") }}" >
            @error('name')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input ">
            <label for="name">Контакт</label>
            <input  type="text" class="@error('contact') is-invalid @enderror" name="contact" placeholder="Введите контакт" value="{{ $client->contact ??  old("contact") }}" >
            @error('contact')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input ">
            <img src="{{ asset('/storage/'.$client->person_photo) }}" alt="Нет изображения">
            <label for="person_photo" class="file-label">Заменить фото</label>
            <input  type="file" id="person_photo" accept="image/*" class="@error('person_photo') is-invalid @enderror" name="person_photo" placeholder="Добавить фото" value="{{  $client->person_photo ?? old("person_photo") }}" >
            @error('person_photo')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input ">
            <img src="{{ asset('/storage/'.$client->person_documents) }}" alt="Нет изображения">
            <label for="person_documents"  class="file-label">Заменить документ</label>
            <input type="file" accept="image/*" id="person_documents"  class="@error('person_documents') is-invalid @enderror" name="person_documents" placeholder="Добавить документ" value="{{  $client->person_documents ?? old("person_documents") }}" >
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
                    <option {{ $source->id === $client->source_id ? ' selected': ''}}
                        value="{{ $source->id }}">{{ $source->title }}</option>
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
            <textarea type="text" class="@error('comment') is-invalid @enderror" name="comment">{{  $client->comment ?? old("comment") }}</textarea>

            @error('comment')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="client_source"></label>
            <button type="submit" class="btn" >Изменить клиента</button>
        </div>

    </form>
@endsection
