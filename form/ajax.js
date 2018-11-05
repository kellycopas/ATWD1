/*function findData(str) {
	if (str.length==0) {
		document.getElementById("data").innerHTML="";
		return;
	}
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("data").innerHTML = this.responseText;
	}
}

xmlhttp.open("GET","currPost.php?q="+str,true);
xmlhttp.send();
}*/

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