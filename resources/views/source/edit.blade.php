@extends('layouts.main')
@section('content')
    <form action="{{ route('expense.update', $expense->id) }}" method="post" class="default-form deal-form">
        @csrf
        @method('patch')

        <div class="form-input ">
            <label for="amount">Сумма</label>
            <input  type="text" class="@error('amount') is-invalid @enderror" name="amount" placeholder="Введите сумму клиента" value="{{ old("amount") ?: $expense->amount }}" >
            @error('amount')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="deal_type_id">Валюта:</label>
            <select name="currency_id" class="@error('currency_id') is-invalid @enderror" >
                <option value="">Не выбрано</option>
                @foreach($currencies as $currency)
                    <option {{ $currency->id === $expense->currency->id ? ' selected': ''}}
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
            <label for="comment">Комментарий</label>
            <textarea class="@error('comment') is-invalid @enderror" name="comment">{{ old("comment") ?: $expense->comment }}</textarea>

            @error('comment')
            <span class="form-input__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="form-input">
            <label for="client_source"></label>
            <button type="submit" class="btn" >Изменить расход</button>
        </div>

    </form>
@endsection
