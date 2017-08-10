@extends('main')
@section('title')
Karte
@endsection
@section('content')
<div class="row" id="topRow">
    <div class="col-sm-10 col-sm-offset-1" id="titleArea">
        <div class="col-sm-10">
            <h1 class="display-1">
                Karte
            </h1>
        </div>
    </div>
</div>
<div class="map" id="googleMap" style="width:100%;height:400px;">
</div>
@endsection
@section('scripts')
  <script src="/js/map.js">
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAErZoobe9tSEmaWGlY5Jzt9nH44VkasVk&callback=myMap"></script>
@endsection


