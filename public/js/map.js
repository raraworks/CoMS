function myMap() {
var mapProp= {
    center:new google.maps.LatLng(56.946285, 24.105078),
    zoom:7,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker = new google.maps.Marker({
    position: {lat: -25.363, lng: 131.044},
    map: map,
    title: 'Hello World!'
  });
marker.setMap(map);
};
