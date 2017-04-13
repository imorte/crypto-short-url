@extends('layout.main')

@section('content')
    <form method="post" accept-charset="UTF-8" action="#" class="ctr" data-form>
        <div class="loader"></div>
        <input type="text" name="url">
        <div class="indicator" data-content="Ваша ссылка"></div>
    </form>
@stop