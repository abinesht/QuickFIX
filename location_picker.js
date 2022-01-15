


function initMap(lati , lngi) {

  
  var map = new google.maps.Map(document.getElementById("map"), {
    center: {
      lat: lati- 0.1615,
      lng: lngi + 0.4645
    },
    zoom: 8
  });
  
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(lati,  lngi),
    map: map,
    draggable: true
  });
  
  google.maps.event.addListener(marker, 'dragend', function () {
    map.setCenter(marker.getPosition()); geocodePosition(marker.getPosition());
    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();
  
    
    document.getElementById("lat").value = lat;
    document.getElementById("lng").value = lng;
    geocodePosition(marker.getPosition());
  });

}


function geocodePosition(pos) {
  geocoder = new google.maps.Geocoder();
  geocoder.geocode({
    latLng: pos
  },
    function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        //document.getElementById("address-label").innerHTML = results[0].formatted_address;
        document.getElementById("address-label-title").innerHTML = results[0].formatted_address;
      
        var add = results[0].formatted_address;
        document.getElementById("address").value = add;
        //var value = add.split(",");

        //count = value.length;
        //country = value[count - 1];
        //state = value[count - 2];
        //city = value[count - 3];
        //document.getElementById("country").value = country;
        //document.getElementById("state").value = state;
        //document.getElementById("city").value = city;

      } else {
        //document.getElementById("address-label").value = 'cannot find';
        document.getElementById("address-label-title").innerHTML = 'Cannot Find';
        
      }
    }
  );
}