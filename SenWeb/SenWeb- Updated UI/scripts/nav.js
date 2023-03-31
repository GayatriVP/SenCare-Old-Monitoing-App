// function myFunction() {
// 	var x = document.getElementById("navbar");
// 	if (x.className === "navbar") {
// 	  x.className += "responsive";
// 	} else {
// 	  x.className = "navbar";
// 	}
//   }

//   function iconbar(x) {
// 	x.classList.toggle("change");
//   }

toggleIcon = document.querySelector(".toggle-icon");
toggleIcon.onclick = function(){
	navBar = document.querySelector(".nav-bar");
	navBar.classList.toggle("active");
}