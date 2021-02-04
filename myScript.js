
	function myFunction() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("id2").innerHTML =
				this.responseText;
			}
		};
		xhttp.open("GET", "meniu.php", true);
		xhttp.send();
	}

	function searchfunction() {
		document.getElementById("search").style.display = "block";
	}

	function loginFunction() {
		document.getElementById("login").style.display = "block";
	}
