@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Записная книжка </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('posts.create') }}">Создать новую запись</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Id</th>
        <th>ФИО</th>
        <th>Компания</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Дата рождения</th>
        <th>Фото</th>
    </tr>
    @foreach ($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->name }}</td>
        <td>{{ $post->company }}</td>
        <td>{{ $post->phone }}</td>
        <td>{{ $post->email }}</td>
        <td>{{ $post->date }}</td>
        <td><img src="{{Storage::disk('local')->url($post->photo)}}" alt="фото контакта" width="100px" /></td>
        <td>


            <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Показать</a>
            <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Редактировать</a>
            <form action="{{ route('posts.destroy',$post->id) }}" method="POST">

                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<span>
    {{$posts->links()}}
</span>
<style>
    .w-5 {
        display: none
    }
</style>
@endsection