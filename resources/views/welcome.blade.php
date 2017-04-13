@extends('layout.main')

@section('content')
    <div class = "container text-xs-center">
        <h1 class ="display-1 m-t-3">Укорачиватель!</h1>
        <p class ="lead m-b-3"></p>
        <div class="col-lg-6 offset-lg-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Ссылка">
                <span class="input-group-btn">
        <button class="btn btn-primary" type="button">Укоротить</button>
      </span>
            </div>
        </div>
    </div>
@stop