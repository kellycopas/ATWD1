// Help came from code used in - https://stackoverflow.com/questions/31799603/show-hide-multiple-divs-javascript

var divs = ["post", "put", "delete"];
var visibleDivId = null;

function showContent(divId) {
	if(visibleDivId === divId) {
		visibleDivId = null;
	} else {
		visibleDivId = divId;
	}
	hideContent();
}

function hideContent() {
	var i, divId, div;
	for(i = 0; i < divs.length; i++) {
		divId = divs[i];
		div = document.getElementById(divId);
		if(visibleDivId === divId) {
			div.style.display = "block";
		} else {
			div.style.display = "none";
		}
	}
}