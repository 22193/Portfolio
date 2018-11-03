let geboortedatum = new Date('2000-06-20');
let nu = new Date();
let jaarsom = nu - geboortedatum;
let leeftijd = new Date(jaarsom).getFullYear() - 1970;
let span = document.getElementById('leeftijd');
span.innerHTML = leeftijd;

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
        document.getElementById("navbar").style.top = "0";
    } else {
        document.getElementById("navbar").style.top = "-50px";
    }
}
