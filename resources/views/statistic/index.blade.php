@extends('layouts.main')
@section('content')


    <form action="{{ route('statistic.filter') }}" method="post" class="default-form deal-form">
        @csrf

        <div class="form-input">
            <label for="user_id">Пользователь:</label>
            <select name="user_id[]" multiple class="@error('user_id') is-invalid @enderror" >
                <option value="">Не выбрано</option>
                @foreach($users as $user)
                    <option {{ isset($data['user_id']) && in_array($user->id, $data['user_id']) ? 'selected' : '' }}
                            value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            @error('user_id')
            <span class="form-input__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="office_id">Офис:</label>
            <select name="office_id[]" multiple size="5" class="@error('office_id') is-invalid @enderror" >
                <option value="">Не выбрано</option>
                @foreach($offices as $office)
                    <option {{ isset($data['office_id']) && in_array($office->id, $data['office_id']) ? 'selected' :'' }}
                            value="{{ $office->id }}">{{ $office->name }}</option>
                @endforeach
            </select>

            @error('office_id')
            <span class="form-input__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-input">
            <label for="start_interval">Интервал:</label>
            <div class="flex-body">
                <input type="date" name="start_interval" class="@error('start_interval') is-invalid @enderror" value="{{ $data['start_interval'] ?? '' }}">
                <input type="date" name="end_interval"  class="@error('end_interval') is-invalid @enderror" value="{{ $data['end_interval'] ?? ''}}">
            </div>
            @error('start_interval')
                 <span class="form-input__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @error('end_interval')
                <span class="form-input__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-input">
            <button type="submit" class="btn">Показать</button>
        </div>


    </form>

    @if(isset($statistic))
        <div>
            <div class="operations operations--stats">
                <div class="operations__grid">
                    <div class="operations__grid-titles">
                        <h5>Интервал</h5>
                        <h5>Количество сделок</h5>
                        <h5>Общий профит</h5>
                        <h5>Оборот по сделкам (приход)</h5>
                        <h5>Оборот по сделкам (расход)</h5>
                    </div>

                    @foreach($statistic['items'] as $item)
                        <div class="operations__title section-title">{{ $item['title'] }}</div>
                        <div class="operations__grid-row">
                            <div>
                                {{  $statistic['data']['start'] }} </br>
                                &#8595;</br>
                                {{  $statistic['data']['finish'] }}
                            </div>
{{--                            <div>{{  $statistic['data']['finish'] }}</div>--}}
                            <div>{{  $item['count_deals'] }}</div>
                            <div>{{  $item['profit'] }}</div>
                            <div>{{  $item['turnover_in'] }}</div>
                            <div>{{  $item['turnover_out'] }}</div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif
@endsection
