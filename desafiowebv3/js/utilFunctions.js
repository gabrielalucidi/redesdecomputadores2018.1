function addLine () {
	// get divbase
	var divbaseCount = document.getElementsByClassName("divbase").length;
	var divbaseClone = document.getElementsByClassName("divbase")[0].cloneNode(true);
	divbaseClone.children[0].name = "select" + divbaseCount;
	divbaseClone.children[1].name = "input" + divbaseCount;
	divbaseClone.children[1].value = "";
	divbaseClone.children[2].name = "" + divbaseCount;
	divbaseClone.id= "" + divbaseCount;

	var divbaseParent = document.getElementsByClassName("divbase")[0].parentElement;
	divbaseParent.appendChild(divbaseClone);
};

function delLine (num) {
	if (document.getElementsByClassName("divbase").length > 1) {
		var xDivbase = document.getElementById(num);
		document.getElementsByClassName("divContainer")[0].removeChild(xDivbase);
	};
};

function loadXMLFile(path){
  var xmlhttp;

  if (window.XMLHttpRequest)
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  else
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  

  xmlhttp.open("GET", path,false);
  xmlhttp.send();

  return xmlhttp.responseXML;
}


function uniqueArray(array) {
    var o = {}, i, l = array.length, r = [];
    for(i=0; i<l;i+=1) o[array[i]] = array[i];
    for(i in o) r.push(o[i]);
    return r;
};
