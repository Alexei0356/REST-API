@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Новая запись</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<main class="form-signin w-100 m-auto">
    <form method="post" action="store" enctype="multipart/form-data">
        @csrf
        <br>
        <div class="form-horisontal">
            <label for="InputName">ФИО (обязательное)</label>
            <input type="Name" name="name" required class="form-control" id="InputName" placeholder="Name">
        </div>
        <br>
        <div class="form-horisontal">
            <label for="InputCompany">Компания</label>
            <input type="Name" name="company" class="form-control" id="InputCompany" placeholder="Company">
        </div>
        <br>
        <div class="form-horisontal">
            <label for="InputPhone">Телефон (обязательное)</label>
            <input type="number" name="phone" required class="form-control" id="InputPhone" placeholder="Telephone number">
        </div>
        <br>
        <div class="form-horisontal">
            <label for="InputEmail">Email (обязательное)</label>
            <input type="email" name="email" required class="form-control" id="InputEmail" placeholder="Email">
        </div>
        <br>
        <div class="form-horisontal">
            <label for="InputDate">Дата рождения </label>
            <input type="date" name="date" class="form-control" id="InputDate">
        </div>
        <br>
        <div class="form-horisontal">
            <label for="InputPhoto">Фото</label>
            <input type="file" name="photo" class="form-control" id="InputPhoto">
        </div>
        <br>
        <button class="w-20 btn btn-lg btn-primary" type="submit">Отправить</button>

    </form>
</main>

@endsection