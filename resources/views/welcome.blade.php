@extends('layout.main')

@section('content')
    <form method="post" accept-charset="UTF-8" class="ctr" data-form>
        <div class="loader"></div>
        <input type="text" name="url" data-copy class="clip">
        <div class="indicator" data-content="Ваша ссылка"></div>
    </form>
@stop