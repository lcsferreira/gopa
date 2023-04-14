function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("mySidenav").style.boxShadow =
    "100px 0px 0px 100vw rgba(0,0,0,0.4)";
  document.getElementById("main").style.opacity = "0.4";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("mySidenav").style.boxShadow = "none";
  document.getElementById("main").style.opacity = "1.0";
}
