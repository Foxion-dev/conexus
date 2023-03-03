@extends('layouts.main')
@section('content')
    <form action="{{ route('encashment.update', $encashment->id) }}" method="post" class="default-form deal-form">
        @csrf
        @method('patch')

        <div class="form-input">
            <label for="type">Тип:</label>
            <select name="type_id" class="@error('type_id') is-invalid @enderror">
                <option value="">Не выбрано</option>
                @foreach($types as $type)
                    <option {{ $type->id === $encashment->type_id ? ' selected': ''}}
                        value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>

            @error('type_id')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-input ">
            <label for="amount">Сумма</label>
            <input type="text" class="@error('amount') is-invalid @enderror" name="amount"
                   placeholder="Введите сумму" value="{{ $encashment->amount ?? old("amount") }}">
            @error('amount')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="deal_type_id">Валюта:</label>
            <select name="currency_id" class="@error('currency_id') is-invalid @enderror">
                <option value="">Не выбрано</option>
                @foreach($currencies as $currency)
                    <option  {{ $currency->id === $encashment->currency_id ? ' selected': ''}}
                        value="{{ $currency->id }}">{{ $currency->title }}</option>
                @endforeach
            </select>

            @error('currency_id')
            <span class="form-input__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="deal_type_id">Инкаcсатор:</label>
            <select name="collector_id" class="@error('collector_id') is-invalid @enderror">
                <option value="">Не выбрано</option>
                @foreach($collectors as $collector)
                    <option {{ $collector->id === $encashment->collector_id ? ' selected': ''}}
                        value="{{ $collector->id }}">{{ $collector->name }}</option>
                @endforeach
            </select>

            @error('collector_id')
            <span class="form-input__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="client_source"></label>
            <button type="submit" class="btn">Инкассация</button>
        </div>
    </form>
@endsection
