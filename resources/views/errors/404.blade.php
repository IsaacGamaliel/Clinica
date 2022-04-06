@extends('errors::layout')

@section('title', __('Pagina no Existe'))
@section('code', '404')
<section id="fourohfour">
    <div class='img'></div>
    <div class='text'>
      <h1>La pagina No existe</h1>
    </div>
  </section>
@section('message', 'Error 404')
