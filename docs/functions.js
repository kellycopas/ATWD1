function loadCurrPost() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("container").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "currPost.php", true);
	xhttp.send();
}

function loadCurrPut() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("container").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "currPut.php", true);
	xhttp.send();
}

function loadCurrDel() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {

		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("container").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "currDel.php", true);
	xhttp.send();
}