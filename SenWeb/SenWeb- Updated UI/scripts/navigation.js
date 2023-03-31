// function setActive() {
//     for (aObj = document.getElementById("navul").getElementsByTagName("a"), i = 0; i < aObj.length; i++) 0 <= document.location.href.indexOf(aObj[i].href) && (aObj[i].className += " active")
// }
// document.getElementById("navigation").innerHTML =
// '<div id="mySidebar" class="sidebar">'+
// '<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>'+
//     '<a href="#">Home</a>'+
//     '<a href="#">Profile</a>'+
//     '<a href="#">Alerts</a>'+
// '</a>'+
// '</div>'+
// '<div id="main">'+
//     '<button class="openbtn" onclick="openNav()">☰ Open Sidebar</button>'+  
//     '<h2>Collapsed Sidebar</h2>'+
//     '<p>Click on the hamburger menu/bar icon to open the sidebar, and push this content to the right.</p>'+

//             '</div>', window.onload = setActive;
// const nav = document.querySelector("nav");
// window.addEventListener("scroll", () => {
//     100 <= window.scrollY ? nav.classList.add("active_nav") : nav.classList.remove("active_nav")
// });

function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
  }