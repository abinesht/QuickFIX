

function initMap() {

    var map = new google.maps.Map(document.getElementById("map"), {
      center: {
        lat: 9.6615,
        lng: 80.0255
      },
      zoom: 8,
    });
  
    
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(9.6615, 80.0255),
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
          document.getElementById("address-label").innerHTML = results[0].formatted_address;
          document.getElementById("address-label-title").innerHTML = results[0].formatted_address;
          
          var add = results[0].formatted_address;
          var value = add.split(",");
  

  
        } else {
          document.getElementById("address-label").value = 'cannot find';
          document.getElementById("address-label-title").innerHTML = 'cannot find';
          
        }
      }
    );
  }