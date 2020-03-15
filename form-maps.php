<!DOCTYPE html>
<html>
<?php include_once 'template/head.php'; ?>
<body>
	<?php include_once 'template/nav.php'; ?>
	<?php include_once 'template/sidebar.php'; ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Kendaraan</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Lokasi</h1>
				<div class="panel">
					<br><h3><center><strong>Data Lokasi</strong></center></h3><br>
					<div class="panel-body container-fluid">
						<form action="_crud_maps" method="post" id="input-data">
							<div class="row">
								<div class="col-md-7">
									<div id="googleMap" style="width:100%;height:380px;"></div>
								</div>
								<div class="col-md-5">
									<div class="col-md-12">
										<label>Nama Lokasi</label>
										<input type="hidden" name="aksi" value="simpan">
										<input type="hidden" name="id_lokasi" value="">
										<input type="text" id="nama_lokasi" name="nama_lokasi" class="form-control" placeholder="Telusuri Lokasi">
										<label>Kendaraan</label>
										<select class="form-control" name="kendaraan" id="kendaraan">
											<option value="0">-- Pilih Kendaraan --</option>
											<?php 
											include_once 'config/dao.php';
											$dao = new Dao();
											$data = $dao->view('kendaraan');
											foreach ($data as $value) {
												echo '<option value="'.$value['id'].'">'.$value['merk'].' ('.$value['plat_nomor'].') - '.$value['pengguna'].'</option>';
											}
											 ?>
										</select>
										<label>Latitude</label>
										<input type="text" id="lat" name="lat" class="form-control" placeholder="Latitude" readonly="yes">
										<label>Longitude</label>
										<input type="text" id="lng" name="lng" class="form-control" placeholder="Longitude" readonly="yes">
										<label>Radius</label>
										<div class="input-group">
											<input type="text" id="radius" name="radius" class="form-control" placeholder="Radius" aria-describedby="basic-addon2">
											<span class="input-group-addon" id="basic-addon2">Km</span>
										</div>
									</div>
									<div class="col-md-6">
										<br>
										<a href="maps"><button class="btn btn-block btn-danger" type="button"><i class="fa fa-mail-reply"></i> Kembali</button></a>
									</div>
									<div class="col-md-6">
										<br>
										<button class="btn btn-block btn-primary" type="button" id="simpan"><i class="fa fa-save"></i> Simpan</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php include_once 'template/js.php'; ?>	
<script>
	var place;

	function initMap() {
		var map = new google.maps.Map(document.getElementById('googleMap'), {
			center: {lat: -7.782894799999976, lng: 110.36702461349182},
			zoom: 13
		});
		var input = document.getElementById('nama_lokasi');

		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);

		var marker = new google.maps.Marker({
			map: map,
			draggable: true,
			anchorPoint: new google.maps.Point(0, -29)
		});

		autocomplete.addListener('place_changed', function() {
			marker.setVisible(false);
			place = autocomplete.getPlace();

			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(15);
			}

			marker.setPosition(place.geometry.location);
			marker.setVisible(true);

			var address = '';
			if (place.address_components) {
				address = [
				(place.address_components[0] && place.address_components[0].short_name || ''),
				(place.address_components[1] && place.address_components[1].short_name || ''),
				(place.address_components[2] && place.address_components[2].short_name || '')
				].join(' ');
			}

			$('#lat').val(place.geometry.location.lat());
			$('#lng').val(place.geometry.location.lng());
			document.getElementById("radius").readOnly = false;
			google.maps.event.addListener(marker, 'dragend', function(event) {
				marker.getPosition().lat();
				$('#lat').val(marker.getPosition().lat());
				$('#lng').val(marker.getPosition().lng());   
			});
		});
	}


	function initialize() {
		var lati = document.getElementById('lat').value; 
		var longi = document.getElementById('lng').value; 
		var rad = document.getElementById('radius').value;
		var citymap = new google.maps.LatLng(lati,longi);
		var cityCircle;

		var mapOptions = {
			zoom: 15,
			center: new google.maps.LatLng(lati,longi),
		};

		var map = new google.maps.Map(document.getElementById('googleMap'),
			mapOptions);

		var marker = new google.maps.Marker({
			map: map,
			draggable: true,
			anchorPoint: new google.maps.Point(0, -29)
		});

		if (rad > 10)
			map.setZoom(11);
		else if(rad > 3)
			map.setZoom(13);
		else
			map.setZoom(15);

		marker.setPosition(place.geometry.location);
		marker.setVisible(true);

		var populationOptions = {
			strokeColor: '#6495ED',
			strokeOpacity: 0.8,
			strokeWeight: 1,
			fillColor: '#6495ED',
			fillOpacity: 0.15,
			map: map,
			center: citymap,
			radius: rad * 1000
		};
		cityCircle = new google.maps.Circle(populationOptions); 
	}

	$('#radius').keyup(function(){
		if ($('#nama_lokasi').val() != ''){
			initialize();
		}
	});

	if ($('#nama_lokasi').val() == '') {
		document.getElementById("radius").readOnly = true;
	}
	else{
		document.getElementById("radius").readOnly = false;
	}

	$('#simpan').click(function(){
		$('#input-data').submit();
	});


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuqp6YJymNF8Et7Xvd6SO3sBYqu2Bkc88&libraries=places&callback=initMap"></script>
</html>