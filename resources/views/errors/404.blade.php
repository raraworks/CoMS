@extends('main')
@section('content')
  <div class="row col-sm-12">
    <h1>404</h1>
    <h4>{{$exception->getMessage()}}</h4>
  </div>
@endsection
