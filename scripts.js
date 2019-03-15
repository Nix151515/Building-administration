function register() {

	var lat = document.getElementById("latitude");
	var lng = document.getElementById("longitude");
	var err = document.getElementById("err");
	if(isNaN(lat.innerHTML))
	{
		console.log("Lat : "+lat.innerHTML);
		console.log("Lng : "+lng.innerHTML);
		err.innerHTML= "Please check your address first";
		err.style.visibility = "visible";
		return;
	}

	var xmlhttp = new XMLHttpRequest();
	var name = document.getElementById("register_name").value;
	var surname = document.getElementById("register_surname").value;
	var password = document.getElementById("register_password").value;
	var email = document.getElementById("register_email").value;
	console.log(name,surname,password, email);

    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("registerResp").innerHTML = this.responseText;
	    }
	};

	xmlhttp.open("GET", 
				"register.php?register_name="+name+
			    "&register_surname="+surname+
			    "&register_password="+password+
			    "&register_email="+email+
			    "&lat="+lat.innerHTML+
			    "&lng="+lng.innerHTML
			     , true);

	xmlhttp.send();
}


function login() {
	var xmlhttp = new XMLHttpRequest();
	var name = document.getElementById("login_name").value;
	var password = document.getElementById("login_password").value;
	console.log(name,password);

	xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("loginResp").innerHTML = this.responseText;
		console.log(this.responseText);
		if(this.responseText.includes("Authentication succesful"))
			loadMainPage();
		}
	};

	xmlhttp.open("GET", "login.php?login_name="+name+
			    "&login_password="+password
			    , true);
			    xmlhttp.send();
}

function loadMainPage() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("registerDiv").innerHTML =this.responseText;
		}
	};
	xhttp.open("GET", "main_page.php", true);
	xhttp.send();
}



function initMap() {
	var latlng = new google.maps.LatLng(44, 26);
	var mapOptions = {
		zoom: 8,
		center: latlng
	};

	var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
}

function showInfo(id) {
	console.log(id);
	// Aci tre' sa ii dau un request sa iau date
}
			
function codeAddress(){
	
	var geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(44, 26);
	var user = "Gigi";

				// Initial map
	var mapOptions = {
		zoom: 8,
		center: latlng
	};

	map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
	document.getElementById('googleMap').style.height = "300px";
	document.getElementById('err').style.visibility = "hidden";


	var address = document.getElementById('address').value;
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == 'OK') {

		// Set map center based on results
			map.setCenter(results[0].geometry.location);

					        // Init map marker
			var marker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location
			});

					       // Display the user (hardcoded)
			var infowindow = new google.maps.InfoWindow({
				content:`Your address`
			});

			google.maps.event.addListener(marker,'click',function() {
				infowindow.open(map,marker);
				map.setZoom(12);
				map.setCenter(marker.getPosition());
			});

			marker.setMap(map);

			document.getElementById("latitude").innerHTML = results[0].geometry.location.lat();
			document.getElementById("longitude").innerHTML = results[0].geometry.location.lng();

		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});
}