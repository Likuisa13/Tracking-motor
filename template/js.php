	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		if(window.location.href.indexOf('index') != -1){
			$('#menu-dashboard').addClass("active");
		}
		else if(window.location.href.indexOf('maps') != -1){
			$('#menu-maps').addClass("active");
		}
		else if(window.location.href.indexOf('history') != -1){
			$('#menu-history').addClass("active");
		}
		else if(window.location.href.indexOf('user') != -1){
			$('#menu-user').addClass("active");
		}
		else{
			$('#menu-alat').addClass("active");
		}

		function initMap() {
			var uluru = {lat: -7.790849, lng:  110.365101};
			var map = new google.maps.Map(document.getElementById('map'),{
				zoom: 11, 
				center: uluru
			});

			var contentString = '<div id="content"><div id="siteNotice">Yogyakarta</div></div>';

			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});

			var marker = new google.maps.Marker({
				position: uluru,
				map: map,
				title: 'Uluru (Ayers Rock)'
			});
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			});
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuqp6YJymNF8Et7Xvd6SO3sBYqu2Bkc88&callback=initMap"></script>