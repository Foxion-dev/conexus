@extends('layouts.main')
@section('content')
    <form action="{{ route('deal.update', $deal->id) }}" method="post" class="default-form deal-form">
        @csrf
        @method('patch')
        <div class="deal-form__commissions">
            <input type="hidden" data-type="buy" data-from="0" data-value="{{ $workDay->commissionsBuy->from_0 }}">
            <input type="hidden" data-type="buy" data-from="100" data-value="{{ $workDay->commissionsBuy->from_100 }}">
            <input type="hidden" data-type="buy" data-from="1000" data-value="{{ $workDay->commissionsBuy->from_1000 }}">
            <input type="hidden" data-type="buy" data-from="10000" data-value="{{ $workDay->commissionsBuy->from_10000 }}">
            <input type="hidden" data-type="buy" data-from="50000" data-value="{{ $workDay->commissionsBuy->from_50000 }}">
            <input type="hidden" data-type="buy" data-from="100000" data-value="{{ $workDay->commissionsBuy->from_100000 }}">

            <input type="hidden" data-type="sale" data-from="0" data-value="{{ $workDay->commissionsSale->from_0 }}">
            <input type="hidden" data-type="sale" data-from="100" data-value="{{ $workDay->commissionsSale->from_100 }}">
            <input type="hidden" data-type="sale" data-from="1000" data-value="{{ $workDay->commissionsSale->from_1000 }}">
            <input type="hidden" data-type="sale" data-from="10000" data-value="{{ $workDay->commissionsSale->from_10000 }}">
            <input type="hidden" data-type="sale" data-from="50000" data-value="{{ $workDay->commissionsSale->from_50000 }}">
            <input type="hidden" data-type="sale" data-from="100000" data-value="{{ $workDay->commissionsSale->from_100000 }}">
        </div>
        <div class="form-input">
            <label for="deal_type_id">Тип сделки:</label>
            <select name="type_id" class="@error('type_id') is-invalid @enderror" >
                <option value="">Не выбрано</option>
                @foreach($dealTypes as $type)
                    <option {{ $type->id === $deal->deal_type_id ? ' selected': ''}}
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
            <label for="amount"></label>
            <input  type="text" class="@error('amount') is-invalid @enderror" name="amount" placeholder="Введите сумму клиента" value="{{ $deal->receiving_sum }}" >

            @error('amount')
            <span class="form-input__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <div class="form-input form-input--checkbox">
            <label for="commission_on" class="flex-body ">
                <input name="commission_on" type="checkbox" {{ $deal->commission_on == 1 ? 'checked' : '' }}  value="true">
                <span>Учитывать комиссию</span>
            </label>

            @error('commission_on')
            <span class="form-input__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="deal-form__calc deal-calculator">
            <button class="deal-calculator__btn btn" id="calc-btn">Рассчитать</button>
            <div class="deal-calculator__result show">
                <div class="deal-calculator__row flex-body">

                    <div class="form-input">
                        <label for="percent_commission"></label>
                        <input type="text" class="@error('percent_commission') is-invalid @enderror disabled" name="percent_commission" placeholder="% комиссии" value="{{ $deal->commission }}">

                        @error('percent_commission')
                        <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="form-input">
                        <label for="amount_commission"></label>
                        <input type="text" class="@error('amount_commission') is-invalid @enderror disabled" name="amount_commission" placeholder="Сумма комиссии" value="{{ $deal->commission_sum }}">

                        @error('amount_commission')
                        <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>
                <div class="deal-calculator__row flex-body">
                    <div class="form-input">
                        <label for="issuance_amount"></label>
                        <input type="text" class="@error('issuance_amount') is-invalid @enderror disabled" name="issuance_amount" placeholder="Сумма к выдачи" value="{{ $deal->return_sum }}" >

                        @error('issuance_amount')
                        <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <div class="deal-calculator__row flex-body">
                    <div class="form-input form-input--checkbox">
                        <label for="edit_commission" class="flex-body">
                            <input name="edit_commission" type="checkbox" {{ $deal->custom_commission == 1 ? 'checked' : '' }} value="true">
                            <span>Настроить комиссию вручную</span>
                        </label>

                        @error('edit_commission')
                        <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="deal-form__client client-card">
            <div class="client-card__title">Информация о клиенте</div>

            <div class="client-card__row flex-body">

                <div class="form-input">
                    <label for="client_contact"></label>
                    <input type="text" class="@error('client_contact') is-invalid @enderror" name="client_contact"value="{{ $client->contact }}" >

                    @error('client_contact')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-input">
                    <label for="client_name"></label>
                    <input type="text" class="@error('client_name') is-invalid @enderror" name="client_name" value="{{ $client->name }}" >

                    @error('client_name')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>
            <div class="client-card__row flex-body">

                <div class="form-input">
                    <label for="client_comment"></label>
                    <textarea type="text" class="@error('client_comment') is-invalid @enderror" name="client_comment">{{ $client->comment }}</textarea>

                    @error('client_comment')
                    <span class="form-input__error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-input">
                    <label for="client_source"></label>
                    <select name="client_source" class="@error('client_source') is-invalid @enderror">
                        @foreach($clientSources as $source)
                            <option
                                {{ $source->id === $client->source_id ? ' selected': ''}}
                                value="{{ $source->id }}">{{ $source->title }}
                            </option>
                        @endforeach
                    </select>

                    @error('client_source')
                    <span class="form-input__error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-input">
            <label for="client_source"></label>
            <button type="submit" class="btn" >Обновить</button>
        </div>

    </form>
@endsection
