//Adaugare EventListener la incarcarea paginii verificarea valorii judetului
window.addEventListener("load", start, false);

//Adaugare EventListener la fiecare selectie de judet
function start(){
document.getElementById('parola2').addEventListener('input',verEgalitate,false);
document.getElementById('parola').addEventListener('input',verEgalitate,false);
}

function verEgalitate() {
	if(document.getElementById("parola").value == document.getElementById("parola2").value) {
	document.getElementById("chkForm1").style.backgroundColor = "green";
	document.getElementById("message").innerHTML = 'Matching';
	}
else {
	document.getElementById("chkForm1").style.backgroundColor = "red";
	document.getElementById("message").innerHTML = 'Not Matching';
}
}

/* document.getElementById('submit').onclick = function() {
   if(document.getElementById("parola").value != document.getElementById("parola2").value)
	   
}​;​*/
