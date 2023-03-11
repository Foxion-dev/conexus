@extends('layouts.app')

@section('content')

<div class="container">

    <form method="POST" class="default-form"  action="{{ route('auth.office.data') }}">
            @csrf
            <input type="hidden" name="office_id" value="{{ $workDay->officeDay->office_id }}">
            <input type="hidden" name="work_day_id" value="{{ $workDay->id }}">
            <h2 class="default-form__title section-title">Введите остатки:</h2>
            <div class="default-form__row flex-body ">
                <div class="form-input">
                    <label for="USD">USD</label>
                    <input type="text" name="USD"  value="{{ old("USD") ?: $previousDay->leftovers->USD ?? '' }}" class="@error('USD') is-invalid @enderror" >

                    @error('USD')
                        <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="USDT">USDT</label>
                    <input type="text" name="USDT"  value="{{ old("USDT") ?: $previousDay->leftovers->USDT ?? '' }}" class="@error('USDT') is-invalid @enderror" >

                    @error('USDT')
                        <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="GEL">GEL</label>
                    <input type="text" name="GEL" value="{{ old("GEL") ?: $previousDay->leftovers->GEL ?? '' }}" class="@error('GEL') is-invalid @enderror" >

                    @error('GEL')
                        <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="KZT">KZT</label>
                    <input type="text" name="KZT"  value="{{ old("KZT") ?? $previousDay->leftovers->KZT ?? ''}}" class="@error('KZT') is-invalid @enderror" >

                    @error('KZT')
                        <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <h2 class="default-form__title section-title">Введите комиссии:</h2>
            <div class="default-form__row flex-body">
                <div class="default-form__col">
                    <h3 class="default-form__subtitle">Покупка</h3>
                    <div class="">
                        <div class="form-input">
                            <label for="buy_from_0">>= 0</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_0" value="{{ old("buy_from_0")  ?: $previousDay->commissionsBuy->from_0 ?? ''  }}" class="@error('buy_from_0') is-invalid @enderror" >

                            @error('buy_from_0')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_100">>= 100</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_100" value="{{ old("buy_from_100") ?: $previousDay->commissionsBuy->from_100 ?? '' }}" class="@error('buy_from_100') is-invalid @enderror" >

                            @error('buy_from_100')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_1000">>= 1000</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_1000" value="{{ old("buy_from_1000")  ?: $previousDay->commissionsBuy->from_1000 ?? '' }}" class="@error('buy_from_1000') is-invalid @enderror" >

                            @error('buy_from_1000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_10000">>= 10000</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_10000" value="{{ old("buy_from_10000")  ?: $previousDay->commissionsBuy->from_10000 ?? '' }}" class="@error('buy_from_10000') is-invalid @enderror" >

                            @error('buy_from_10000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_50000">>= 50000</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_50000" value="{{ old("buy_from_50000")  ?: $previousDay->commissionsBuy->from_50000 ?? '' }}" class="@error('buy_from_50000') is-invalid @enderror" >

                            @error('buy_from_0')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="buy_from_100000">>= 100000</label>
                            <input type="text" placeholder="Введите % комиссии" name="buy_from_100000" value="{{ old("buy_from_100000") ?: $previousDay->commissionsBuy->from_100000 ?? '' }}" class="@error('buy_from_100000') is-invalid @enderror" >

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
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_0" value="{{ old("sale_from_0") ?: $previousDay->commissionsSale->from_0 ?? '' }}" class="@error('sale_from_0') is-invalid @enderror" >

                            @error('sale_from_0')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_100">>= 100</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_100" value="{{ old("sale_from_100") ?: $previousDay->commissionsSale->from_100 ?? '' }}" class="@error('sale_from_100') is-invalid @enderror" >

                            @error('sale_from_100')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_1000">>= 1000</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_1000" value="{{ old("sale_from_1000")  ?: $previousDay->commissionsSale->from_1000 ?? '' }}" class="@error('sale_from_1000') is-invalid @enderror" >

                            @error('sale_from_1000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_10000">>= 10000</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_10000" value="{{ old("sale_from_10000") ?: $previousDay->commissionsSale->from_10000 ?? '' }}" class="@error('sale_from_10000') is-invalid @enderror" >

                            @error('sale_from_10000')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_50000">>= 50000</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_50000" value="{{ old("sale_from_50000")  ?: $previousDay->commissionsSale->from_50000 ?? '' }}" class="@error('sale_from_50000') is-invalid @enderror" >

                            @error('sale_from_0')
                            <span class="form-input__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="sale_from_100000">>= 100000</label>
                            <input type="text" placeholder="Введите % комиссии" name="sale_from_100000" value="{{ old("sale_from_100000") ?: $previousDay->commissionsSale->from_100000 ?? '' }}" class="@error('sale_from_100000') is-invalid @enderror" >

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
                        Дальше
                    </button>
                </div>
            </div>
        </form>
</div>

@endsection
