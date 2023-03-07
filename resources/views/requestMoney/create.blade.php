@extends('layouts.main')
@section('content')
    <form action="{{ route('requestMoney.store') }}" method="post" class="default-form deal-form" enctype="multipart/form-data">
        @csrf

        <div class="form-input">
            <label for="currency_id">Валюта:</label>
            <select name="currency_id" class="@error('currency_id') is-invalid @enderror js-request-money-currency-select">
                <option value="">Не выбрано </option>
                @foreach($currencies as $currency)
                    <option {{ old('currency_id') == $currency->id ? 'selected' : '' }}
                        value="{{ $currency->id }}" {{ in_array($currency->id, $cashCurrency) ? ' data-cash=1 ' :'' }}>{{ $currency->title }}</option>
                @endforeach
            </select>

            @error('currency_id')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input ">
            <label for="amount">Сумма</label>
            <input  type="text" class="@error('amount') is-invalid @enderror" name="amount" placeholder="Введите сумму" value="{{  old("amount") }}" >
            @error('amount')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="form-input">
            <label for="request_office_id">Офис:</label>
            <select name="request_office_id" class="@error('request_office_id') is-invalid @enderror">
                <option value="">Не выбрано</option>
                @foreach($offices as $office)
                    @if($office->id !== $currentOffice->id)
                        <option {{ old('request_office_id') == $office->id ? 'selected' : '' }}
                            value="{{ $office->id }}">{{ $office->name }}</option>
                    @endif
                @endforeach
            </select>

            @error('request_office_id')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input form-input--hide ">
            <label for="collector_id">Инкассатор:</label>
            <select name="collector_id" class="@error('collector_id') is-invalid @enderror js-request-money-collector-select">
                <option value="">Не выбрано</option>
                @foreach($collectors as $collector)
                    <option {{ old('collector_id') == $collector->id ? 'selected' : '' }}
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
            <button type="submit" class="btn" >Запросить средства</button>
        </div>

    </form>
@endsection
