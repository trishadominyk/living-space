<div id="map" height="460px" width="100%"></div>
<div id="form" class="">
      <h2>Add New Space</h2>
	  <table>
		<tr>
			<td>Name:</td> 
			<td><input type='text' id='name'/></td>
		</tr>
		<tr>
			<td>Description:</td> 
			<td><input type='text' id='desc'/></td>
		</tr>
		<tr>
			<td>Type:</td>
			<td>
				<select id='type'> +
				<?php 
					$list = $space->get_types();
					foreach($list as $value){
				?>
					<option value='<?php echo $value['typ_id'];?>'><?php echo $value['typ_name'];?></option>
				<?php
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Address:</td> 
			<td><input type='text' id='address'/></td>
		</tr>
		<tr>
			<td>Contact:</td> 
			<td><input type='text' id='contact'/></td>
		</tr>
		<tr>
			<td>City:</td>
			<td>
				<select id='city'> +
				<?php 
					$list = $space->get_cities();
					foreach($list as $value){
				?>
					<option value='<?php echo $value['cty_id'];?>'><?php echo $value['cty_name'];?></option>
				<?php
					}
				?>
				</select>
			</td>
		</tr>
        <tr>
			<td></td>
			<td><input type='button' value='Save' onclick='saveData()'/></td>
		</tr>
      </table>
    </div>
    <script>
      var map;
      var marker;
      var infowindow;
      var messagewindow;

      function initMap() {
        var california = {lat: 10.651469, lng: 122.977455};
        map = new google.maps.Map(document.getElementById('map'), {
          center: california,
          zoom: 13
        });

        infowindow = new google.maps.InfoWindow({
          content: document.getElementById('form')
        })

        messagewindow = new google.maps.InfoWindow({
          content: document.getElementById('message')

        });

        google.maps.event.addListener(map, 'click', function(event) {
          marker = new google.maps.Marker({
            position: event.latLng,
            map: map
          });


          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });
        });
      }

      function saveData() {
        var name = escape(document.getElementById('name').value);
        var address = escape(document.getElementById('address').value);
        var type = document.getElementById('type').value;
		var city = document.getElementById('city').value;
		var contact = document.getElementById('contact').value;
		var desc = document.getElementById('desc').value;
        var latlng = marker.getPosition();
         window.location = 'admin/process.php?action=spacenew&name=' + name + '&address=' + address +
                  '&type=' + type + '&city=' + city + '&contact=' + contact + '&desc=' + desc + '&lat=' + latlng.lat() + '&lng=' + latlng.lng();


       /* downloadUrl(url, function(data, responseCode) {

          if (responseCode == 200 && data.length <= 1) {
            infowindow.close();

            messagewindow.open(map, marker);

          }
        });*/
      }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request.responseText, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing () {
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANhmxXSotE4QlT-tAOhd_WdIYa2EYCpQc&callback=initMap">
    </script>
	