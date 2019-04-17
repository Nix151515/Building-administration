
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

		function getWidths() {
		console.log("reached widths");
	 	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var week = JSON.parse(this.responseText)
			    // console.log(week.monday)

			    
			 	let mondayUsers = week.monday;
			    let tuesdayUsers = week.tuesday;
			    let wednesdayUsers = week.wednesday;
			    let thursdayUsers = week.thursday;
			    let fridayUsers = week.friday;
			    let saturdayUsers = week.saturday;
			    let sundayUsers = week.sunday;



				let blockWidth = 5;
			    let blockHeight = 10;
			    /*  Space between name and svg */
			    // let spacing  = blockHeight/8;
			    let spacing = 1;
			    let heightDifference = blockHeight/3;

			    document.getElementById("bar1").style.width = blockWidth * mondayUsers + "vw";
			    document.getElementById("bar2").style.width = blockWidth * tuesdayUsers + "vw";
			    document.getElementById("bar3").style.width = blockWidth * wednesdayUsers + "vw";
			    document.getElementById("bar4").style.width = blockWidth * thursdayUsers+ "vw";
			    document.getElementById("bar5").style.width = blockWidth * fridayUsers+ "vw";
			    document.getElementById("bar6").style.width = blockWidth * saturdayUsers+ "vw";
			    document.getElementById("bar7").style.width = blockWidth * sundayUsers+ "vw";

			    document.getElementById("text1").setAttribute("x", spacing + blockWidth * mondayUsers + "vw");
			    document.getElementById("text2").setAttribute("x", spacing + blockWidth * tuesdayUsers+ "vw");
			    document.getElementById("text3").setAttribute("x", spacing + blockWidth * wednesdayUsers+ "vw");
			    document.getElementById("text4").setAttribute("x", spacing + blockWidth * thursdayUsers+ "vw");
			    document.getElementById("text5").setAttribute("x", spacing + blockWidth * fridayUsers+ "vw");
			    document.getElementById("text6").setAttribute("x", spacing + blockWidth * saturdayUsers+ "vw");
			    document.getElementById("text7").setAttribute("x", spacing + blockWidth * sundayUsers+ "vw");

			    document.getElementById("text1").setAttribute("y", heightDifference + blockHeight * 0 + "vh");
			    document.getElementById("text2").setAttribute("y", heightDifference + blockHeight * 1+ "vh");
			    document.getElementById("text3").setAttribute("y", heightDifference + blockHeight * 2+ "vh");
			    document.getElementById("text4").setAttribute("y", heightDifference + blockHeight * 3+ "vh");
			    document.getElementById("text5").setAttribute("y", heightDifference + blockHeight * 4+ "vh");
			    document.getElementById("text6").setAttribute("y", heightDifference + blockHeight * 5+ "vh");
			    document.getElementById("text7").setAttribute("y", heightDifference + blockHeight * 6+ "vh");
			    document.getElementById("text11").setAttribute("y", heightDifference + blockHeight * 0+ "vh");
			    document.getElementById("text22").setAttribute("y", heightDifference + blockHeight * 1+ "vh");
			    document.getElementById("text33").setAttribute("y", heightDifference + blockHeight * 2+ "vh");
			    document.getElementById("text44").setAttribute("y", heightDifference + blockHeight * 3+ "vh");
			    document.getElementById("text55").setAttribute("y", heightDifference + blockHeight * 4+ "vh");
			    document.getElementById("text66").setAttribute("y", heightDifference + blockHeight * 5+ "vh");
			    document.getElementById("text77").setAttribute("y", heightDifference + blockHeight * 6+ "vh");

			    document.getElementById("bar1").setAttribute("y", blockHeight * 0 + "vh");
			    document.getElementById("bar2").setAttribute("y", blockHeight * 1 + "vh");
			    document.getElementById("bar3").setAttribute("y", blockHeight * 2 + "vh");
			    document.getElementById("bar4").setAttribute("y", blockHeight * 3 + "vh");
			    document.getElementById("bar5").setAttribute("y", blockHeight * 4 + "vh");
			    document.getElementById("bar6").setAttribute("y", blockHeight * 5 + "vh");
			    document.getElementById("bar7").setAttribute("y", blockHeight * 6 + "vh");


			    document.getElementById("text11").setAttribute("x", blockWidth * mondayUsers/2 + "vw");
			    document.getElementById("text22").setAttribute("x", blockWidth * tuesdayUsers/2 + "vw");
			    document.getElementById("text33").setAttribute("x", blockWidth * wednesdayUsers/2 + "vw");
			    document.getElementById("text44").setAttribute("x", blockWidth * thursdayUsers/2 + "vw");
			    document.getElementById("text55").setAttribute("x", blockWidth * fridayUsers/2 + "vw");
			    document.getElementById("text66").setAttribute("x", blockWidth * saturdayUsers/2 + "vw");
			    document.getElementById("text77").setAttribute("x", blockWidth * sundayUsers/2+ "vw");
			    console.log("transformed");

			    $("rect").hover(
			      function(){
			        $(this).css("opacity", ".3");
			      },
			      function(){
			        $(this).css("opacity", "1");
			    });

			    $("rect").height("10vh")

			    $("#text11").text(mondayUsers);
			    $("#text22").text(tuesdayUsers);
			    $("#text33").text(wednesdayUsers);
			    $("#text44").text(thursdayUsers);
			    $("#text55").text(fridayUsers);
			    $("#text66").text(saturdayUsers);
			    $("#text77").text(sundayUsers);

				
			}
		}
		xmlhttp.open("GET", "getChartData.php", true);
		xmlhttp.send();
    	}
