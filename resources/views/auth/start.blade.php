@extends('layouts.app')

@section('content')

<div class="container">

    <form method="POST" class="default-form" action="{{ route('auth.office') }}">
            @csrf

            <div class="form-input">
                <label for="office_id">Выберите офис</label>
                <select name="office_id" value="{{ old("office_id") }}" class="@error('office_id') is-invalid @enderror" >
                    <option value="">Не выбрано</option>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                    @endforeach
                </select>

                @error('office_id')
                <span class="form-input__error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Дальше
                    </button>
                </div>
            </div>
        </form>
</div>

@endsection
