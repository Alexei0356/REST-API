@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Просмотр Записи</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('posts.index') }}"> Назад</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Id:</strong>
            <td>{{ $post->id }}</td>
            <br>
            <strong>ФИО:</strong>
            <td>{{ $post->name }}</td>
            <br>
            <strong>Компания:</strong>
            <td>{{ $post->company }}</td>
            <br>
            <strong>Телефон:</strong>
            <td>{{ $post->phone }}</td>
            <br>
            <strong>Email:</strong>
            <td>{{ $post->email }}</td>
            <br>
            <strong>Дата рождения:</strong>
            <td>{{ $post->date }}</td>
            <br>
            <strong>Фото:</strong>
            <td><img src="{{Storage::disk('local')->url($post->photo)}}" alt="фото контакта" width="200px" /></td>
            <td>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    </div>
                </div>


        </div>
        @endsection