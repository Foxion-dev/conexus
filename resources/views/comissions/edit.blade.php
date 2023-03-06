@extends('layouts.main')

@section('content')

<div class="container">

    <form method="POST"  class="default-form"  action="{{ route('commissions.update') }}">
            @csrf
            @method('patch')
            <h2 class="default-form__title">Введите комиссии:</h2>
            <div class="default-form__row flex-body">
                <div class="default-form__col">
                    <h3 class="default-form__subtitle">Покупка</h3>
                    <div class="">
                        <div class="form-input">
                            <label for="buy_from_0">>= 0</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_0" value="{{ old("buy_from_0")  ?: $workDay->officeDay->commissionsBuy->from_0 ?? ''  }}" class="@error('buy_from_0') is-invalid @enderror" >

                            @error('buy_from_0')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_100">>= 100</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_100" value="{{ old("buy_from_100") ?: $workDay->officeDay->commissionsBuy->from_100 ?? '' }}" class="@error('buy_from_100') is-invalid @enderror" >

                            @error('buy_from_100')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_1000">>= 1000</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_1000" value="{{ old("buy_from_1000")  ?: $workDay->officeDay->commissionsBuy->from_1000 ?? '' }}" class="@error('buy_from_1000') is-invalid @enderror" >

                            @error('buy_from_1000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_10000">>= 10000</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_10000" value="{{ old("buy_from_10000")  ?: $workDay->officeDay->commissionsBuy->from_10000 ?? '' }}" class="@error('buy_from_10000') is-invalid @enderror" >

                            @error('buy_from_10000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_50000">>= 50000</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_50000" value="{{ old("buy_from_50000")  ?: $workDay->officeDay->commissionsBuy->from_50000 ?? '' }}" class="@error('buy_from_50000') is-invalid @enderror" >

                            @error('buy_from_0')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_100000">>= 100000</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_100000" value="{{ old("buy_from_100000") ?: $workDay->officeDay->commissionsBuy->from_100000 ?? '' }}" class="@error('buy_from_100000') is-invalid @enderror" >

                            @error('buy_from_100000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="default-form__col">
                    <h3 class="default-form__subtitle">Продажа</h3>
                    <div class="">
                        <div class="form-input">
                            <label for="sale_from_0">>= 0</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_0" value="{{ old("sale_from_0") ?: $workDay->officeDay->commissionsSale->from_0 ?? '' }}" class="@error('sale_from_0') is-invalid @enderror" >

                            @error('sale_from_0')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_100">>= 100</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_100" value="{{ old("sale_from_100") ?: $workDay->officeDay->commissionsSale->from_100 ?? '' }}" class="@error('sale_from_100') is-invalid @enderror" >

                            @error('sale_from_100')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_1000">>= 1000</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_1000" value="{{ old("sale_from_1000")  ?: $workDay->officeDay->commissionsSale->from_1000 ?? '' }}" class="@error('sale_from_1000') is-invalid @enderror" >

                            @error('sale_from_1000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_10000">>= 10000</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_10000" value="{{ old("sale_from_10000") ?: $workDay->officeDay->commissionsSale->from_10000 ?? '' }}" class="@error('sale_from_10000') is-invalid @enderror" >

                            @error('sale_from_10000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_50000">>= 50000</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_50000" value="{{ old("sale_from_50000")  ?: $workDay->officeDay->commissionsSale->from_50000 ?? '' }}" class="@error('sale_from_50000') is-invalid @enderror" >

                            @error('sale_from_0')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_100000">>= 100000</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_100000" value="{{ old("sale_from_100000") ?: $workDay->officeDay->commissionsSale->from_100000 ?? '' }}" class="@error('sale_from_100000') is-invalid @enderror" >

                            @error('sale_from_100000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Обновить
                    </button>
                </div>
            </div>
        </form>
</div>

@endsection
