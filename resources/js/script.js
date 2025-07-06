// Navbar fixed on scroll
// Navbar sticky on scroll
window.onscroll = function () {
    const header = document.querySelector("header");
    const sticky = header.offsetTop;

    if (window.pageYOffset > sticky) {
        header.classList.add("header-fixed");
    } else {
        header.classList.remove("header-fixed");
    }
};

//Hamburger
const hamburger = document.querySelector("#hamburger");
const navMenu = document.querySelector("#nav-menu");

hamburger.addEventListener("click", function () {
    hamburger.classLis4yt.toggle("hamburger-active");
    navMenu.classList.toggle("hidden");
});
