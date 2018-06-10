<div id="SUB_NAV">
	<form name="filtersearch" method="post" action="index.php?mod=spaces&sub=list">
		<div class="search">
			<div class="row">
				<select name="city" class="search-text" style="width: 100%;" required onchange="this.form.submit()">
					<?php
						$list = $space->get_cities();
						
						if($city == ''){
					?>
					<option value="" selected>ALL</option>
					<?php
						}
						else{
					?>
					<option value="">ALL</option>
					<?php
						}
					
						foreach($list as $value){
							if($value['cty_id'] == $city){
					?>
					<option value="<?php echo $value['cty_id']?>" selected><?php echo $value['cty_name'];?></option>
					<?php
							}
							else{
					?>
					<option value="<?php echo $value['cty_id']?>"><?php echo $value['cty_name'];?></option>
					<?php
							}
						}
					?>
				</select>
				<noscript><input type="submit" class="search-button" name="submit" value="Search"/></noscript>
			</div>
		</div>
		
		<div class="filter">
			<ul>
				<li>
					<b>Type</b>
					<select name="type" class="input-text" required onchange="this.form.submit()">
						<?php
							$list = $space->get_types();
							
							foreach($list as $value){
								if($value['typ_id'] == $type){
						?>
						<option value="<?php echo $value['typ_id'];?>" selected><?php echo $value['typ_name'];?></option>
						<?php
								}
								else{
						?>
						<option value="<?php echo $value['typ_id'];?>"><?php echo $value['typ_name'];?></option>
						<?php
								}
							}
							
							if($type == ''){
						?>
						<option value="" selected>ALL</option>
						<?php
							}
							else{
						?>
						<option value="">ALL</option>
						<?php
							}
						?>
					</select>
				</li>
				<li>
					<b>Sort By</b>
					<select name="sort" class="input-text" required onchange="this.form.submit()">
						<?php if($sort == 'name'){
						?>
							<option value="name" selected>NAME</option>
							<option value="price">PRICE</option>
						<?php
						}
						else if($sort == 'price'){
						?>
							<option value="price" selected>PRICE</option>
							<option value="name">NAME</option>
						<?php
						}
						else{
						?>
							<option value="name">NAME</option>
							<option value="price">PRICE</option>
						<?php
						}
						?>
						
					</select>
				</li>
			</ul>
		</div>
	</form>
</div>

<div id="SUB_CONTENT">
<script>
			var customLabel = {
				DORMITORY: {
					label: 'D'
				},
				CONDOMINIUM: {
					label: 'C'
				}
			};
			
			function initMap() {
				var map = new google.maps.Map(document.getElementById('map'), {
					center: new google.maps.LatLng(10.651469, 122.977057),
					zoom: 12
				});
				
				var infoWindow = new google.maps.InfoWindow;

				// Change this depending on the name of your PHP or XML file
				downloadUrl('map_data.php', function(data) {
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName('marker');
					Array.prototype.forEach.call(markers, function(markerElem) {
						var name = markerElem.getAttribute('name');
						var address = markerElem.getAttribute('address');
						var contact = markerElem.getAttribute('contact');
						var type = markerElem.getAttribute('type');
						var point = new google.maps.LatLng(
							parseFloat(markerElem.getAttribute('lat')),
							parseFloat(markerElem.getAttribute('lng')));

						var infowincontent = document.createElement('div');
						var strong = document.createElement('strong');
						strong.textContent = name
						infowincontent.appendChild(strong);
						infowincontent.appendChild(document.createElement('br'));

						var text = document.createElement('text');
						text.textContent = address
						infowincontent.appendChild(text);
						var icon = customLabel[type] || {};
						var marker = new google.maps.Marker({
							map: map,
							position: point,
							label: icon.label
						});
						marker.addListener('click', function() {
							infoWindow.setContent(infowincontent);
							infoWindow.open(map, marker);
						});
					});
				});
			}

			function downloadUrl(url, callback) {
				var request = window.ActiveXObject ?
				new ActiveXObject('Microsoft.XMLHTTP') :
				new XMLHttpRequest;

				request.onreadystatechange = function() {
				  if (request.readyState == 4) {
					request.onreadystatechange = doNothing;
					callback(request, request.status);
				  }
				};

				request.open('GET', url, true);
				request.send(null);
			}

				  function doNothing() {}
		</script>
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANhmxXSotE4QlT-tAOhd_WdIYa2EYCpQc&callback=initMap">
		</script>
	<div id="map"></div>
	
	<div id="info">
		<?php
			switch($sub){
				default:
					require_once 'spaces_list.php';
				break;
				case 'info':
					require_once 'spaces_info.php';
				break;
				case 'apply':
					require_once 'spaces_apply.php';
				break;
			}
		?>
	</div>
</div>