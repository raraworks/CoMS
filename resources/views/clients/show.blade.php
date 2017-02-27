@extends('main')
@section('title')
Apskatīt klientu: {{$client->title}}
@endsection
@section('content')
  @include('clients.show.topbar')
  @include('clients.show.middle')
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
@endsection
