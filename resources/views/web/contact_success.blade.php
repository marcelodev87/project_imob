@extends('web.master.master')

@section('content')
<div class="container p-5">
    <h2 class="text-danger text-center">Seu email foi enviado com sucesso!</h2>
    <p class="text-center"><a href="{{ url()->previous() }}" class="text-front text-center">... Continuar navegando</a></p>
</div>
@endsection
