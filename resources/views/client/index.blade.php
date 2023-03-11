@extends('layouts.main')
@section('content')
    <div>
        <div class="operations operations--clients">
            <div class="operations__grid">
                <div class="operations__grid-titles">
                    <h5>Дата создания</h5>
                    <h5>Имя</h5>
                    <h5>Контакт</h5>
                    <h5>Комментарий</h5>
                    <h5>Фото</h5>
                    <h5>Документ</h5>
                    <h5>Источник</h5>
                    <h5>Действия</h5>
                </div>
                @foreach($clients as $client)
                    <div href="{{ route('client.show', $client->id) }}" class="operations__grid-row">
                        <div>{{  date('d.m.Y H:i', strtotime($client->created_at))}}</div>
                        <div>{{  $client->name }}</div>
                        <div>{{  $client->contact }}</div>
                        <div>{{  $client->comment }}</div>
                        <div><img class="mini-img" src="{{ asset('/storage/'.$client->person_photo ) }}" alt=""></div>
                        <div><img class="mini-img" src="{{ asset('/storage/'.$client->person_documents ) }}" alt=""></div>
                        <div>{{  $client->source->title ?? '' }}</div>

                        <div class="operations__item-actions actions flex-body flex-no-wrap">
                            <a href="{{ route('client.show', $client->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-eye"></i></a>
                            <a href="{{ route('client.edit', $client->id) }}"  class="actions__item actions__item--edit"><i class="fa-regular fa-pen-to-square"></i></a>
                            <form action="{{ route('client.destroy', $client->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="actions__item actions__item--del"><i class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
