function initMap() {
      var uluru = {lat: -32.954392, lng: -60.643802};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: uluru
      });
      var contentString = '<div style="color:black">' +
              '<b>BiciAmiga</b><br>' +
              'Zeballos 1341<br>' +
              '2000 - Rosario, Santa Fe, Argentina'
              '</div>';
      var infowindow = new google.maps.InfoWindow({
        content: contentString
      });
      var marker = new google.maps.Marker({
        position: uluru,
        map: map,
        title: 'BiciAmiga'
      });
      marker.addListener('click', function () {
        infowindow.open(map, marker);
      });
      infowindow.open(map, marker);
    }