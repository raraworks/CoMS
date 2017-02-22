@extends('main')
@section('title')
Apskatīt klientu: {{$client->title}}
@endsection
@section('content')
  @include('clients.show.topbar')
  @include('clients.show.middlebar')
  @include('clients.show.sectionbar')
  <div class="col-sm-2">
      {!! Html::linkRoute('clients.index', ' Atpakaļ <<', array(), array('class'=>'btn btn-default')) !!}
      {!! Html::linkRoute('sections.create', 'Pievienot sadaļu', array('client' => $client->id), array('class'=>'btn btn-default')) !!}
  </div>
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
@endsection
