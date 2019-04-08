
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

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {

			var user = JSON.parse(this.responseText);

			document.getElementById('userName').innerHTML = user.name;
			document.getElementById('userSurname').innerHTML = user.surname;
			document.getElementById('userConnection').innerHTML = user.time;

			var geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(user.lat, user.lng);
						
			var mapOptions = {
				zoom: 8,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.HYBRID
			};

			// la marker
			// icon:'pictures/ok.jpg',

			// la infowindow
			// content: user.name+"'s address"


			map = new google.maps.Map(document.getElementById('userMap'), mapOptions);
			document.getElementById('userMap').style.height = "60vh";
			document.getElementById('userMap').style.width = "100%";

			var marker = new google.maps.Marker({
				map: map,
				position: latlng,
				animation:google.maps.Animation.BOUNCE
			});

			var circle = new google.maps.Circle({
	            center: latlng,
	            map: map,
	            radius: 10000,          // IN METERS.
	            fillColor: '#FF6600',
	            fillOpacity: 0.3,
	            strokeColor: "#FFF",
	            strokeWeight: 0         // DON'T SHOW CIRCLE BORDER.
	        });

			var infowindow = new google.maps.InfoWindow({
				content:`Your address`
			});

			google.maps.event.addListener(marker,'click',function() {
				infowindow.open(map,marker);
				map.setZoom(12);
				map.setCenter(marker.getPosition());
			});

			// google.maps.event.addListener(map,'click',function() {
			// 	map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
			// });

			// google.maps.event.addListener(map, 'rightclick', function() {
			// 	mapTypeId: 'terrain'
			// })

			marker.setMap(map);
		}
	}

	xmlhttp.open("GET", "usersFunctions.php?id="+id, true);
	xmlhttp.send();
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
				var room = document.getElementById("register_room").value;
				console.log("Name: ",name,"Surname :",surname,"Password: ",password,"Email: ", email,"Room: ", room);

			    xmlhttp.onreadystatechange = function() {
			    	// console.log(this.readyState,this.status);
				    if (this.readyState == 4 && this.status == 200) {
				        document.getElementById("registerResp").innerHTML = this.responseText;
				        // console.log(this.responseText);
						if(this.responseText.includes("account created"))
							loadPage("loginPage.php", "mainPage");
				    }
				};

				xmlhttp.open("GET", 
							"register.php?register_name="+name+
						    "&register_surname="+surname+
						    "&register_password="+password+
						    "&register_email="+email+
						    "&lat="+lat.innerHTML+
						    "&lng="+lng.innerHTML+
						    "&register_room="+room
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
				// console.log(this.responseText);
				if(this.responseText.includes("Authentication succesful, user"))
					loadPage("userMainPage.php", "mainPage");
				if(this.responseText.includes("Authentication succesful, admin"))
					loadPage("adminMainPage.php", "mainPage");
				}
			};

			xmlhttp.open("GET", "login.php?login_name="+name+
					    "&login_password="+password
					    , true);
					    xmlhttp.send();
		}

		function loadPage(page, element) {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById(element).innerHTML =this.responseText;
					}
				};
				xhttp.open("GET", page, true);
				xhttp.send();
		}
		function changeLang(language) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				    	console.log("Language set to ",language);
				    	document.getElementById("pageContent").innerHTML = this.responseText;
				    }
				};

				xmlhttp.open("GET", "index.php?lang="+language, true);
				xmlhttp.send();
		}

		function pay(id, element, month) {
			console.log(id);
			
			

			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				    	element.disabled = true;
						element.style.backgroundColor = "green";
						str = element.value;
						element.value = str.replace("unpaid", "paid");
						// element.value += ' (ok)';
				    	console.log("payment done");
				    }
				};

			xmlhttp.open("GET", "payment.php?id="+id+"&month="+month, true);
			xmlhttp.send();
		}


		// function getUsers(element) {
		// 	console.log("laba");
		// }