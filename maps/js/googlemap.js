var map;
var geocoder;

function loadMap() {
	var pune = {lat: -25.2818606, lng: -57.557538};
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: pune
    });

    var marker = new google.maps.Marker({
      position: pune,
      map: map
    });

    var cdata = JSON.parse(document.getElementById('data').innerHTML);
    geocoder = new google.maps.Geocoder();  
    codeDireccion(cdata);

    var allData = JSON.parse(document.getElementById('allData').innerHTML);
    showAllMapscelula(allData)
}

function espaciar() {
 espacio = document.createTextNode("      ");
 document.getElementById("texto").appendChild(espacio);
}

function showAllMapscelula(allData) {
	var infoWind = new google.maps.InfoWindow;
	Array.prototype.forEach.call(allData, function(data){

		var content = document.createElement('div');
		var strong = document.createElement('strong');
		    

		strong.innerHTML = '<h4><p><i class="fa fa-user "></i> ' + data.nombre + '</h4> <i class="fa fa-calendar"></i> ' + data.dia + ' ' + data.hora + ' <br> <i class="fa fa-phone"> </i> <a href="https://wa.me/595' + data.telefono + '?text=Que%20tal%20le%20saluda%20del%20Dpto.%20Celulas!!">' + data.telefono + '</a><br><i class="fa fa-home"></i> ' + data.direccion +'</p>';
		content.appendChild(strong);



		/*var img = document.createElement('img');
		img.src = 'img/Leopard.jpg';
		img.style.width = '100px';
		content.appendChild(img);*/

		var marker = new google.maps.Marker({
	      position: new google.maps.LatLng(data.lat, data.lng),
	      map: map



	    });

	    marker.addListener('click', function(){
	    	infoWind.setContent(content);
	    	infoWind.open(map, marker);


	    })
	})
}

function codeDireccion(cdata) {
   Array.prototype.forEach.call(cdata, function(data){
    	var direccion = data.nombre + ' ' + data.direccion;
	    geocoder.geocode( { 'direccion': direccion}, function(results, status) {
	      if (status == 'OK') {
	        map.setCenter(results[0].geometry.location);
	        var points = {};
	        points.id = data.id;
	        points.lat = map.getCenter().lat();
	        points.lng = map.getCenter().lng();
	        updateMapscelulaWithLatLng(points);
	      } else {
	        alert('Geocode was not successful for the following reason: ' + status);
	      }
	    });
	});
}

function updateMapscelulaWithLatLng(points) {
	$.ajax({
		url:"action.php",
		method:"post",
		data: points,
		success: function(res) {
			console.log(res)
		}
	})
	
}