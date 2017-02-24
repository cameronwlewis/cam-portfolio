/**
 * Created by cameronlewis on 2/17/17.
 */
function mouseOver(x) {
    x.style.color = "gray";
}

function mouseOut(x) {
    x.style.color = "black";
}

var slideLeft = new Menu({
    wrapper: '#o-wrapper',
    type: 'slide-left',
    menuOpenerClass: '.c-button',
    maskId: '#c-mask'
});

var slideLeftBtn = document.querySelector('#c-button--slide-left');

slideLeftBtn.addEventListener('click', function (e) {
    e.preventDefault();
    slideLeft.open();
});

function showHome() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("main").style.display = 'block';
            document.getElementById("result").innerHTML = '';
        }
    };
    xmlhttp.open("GET", "index.php", true);
    xmlhttp.send();
}

function showStats() {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("main").style.display = 'none';
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "showStats.php", true);
        xmlhttp.send();
}

function showMySearches() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("main").style.display = 'none';
            document.getElementById("result").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "mySearches.php", true);
    xmlhttp.send();
}
function validateInput(input) {
    if (/[&;%@!"?\- ^~:}\{()+$<>_*]/.test(input) == true)
        document.getElementById('validation').innerHTML = "Invalid characters" +
            " entered.";
    else
        document.getElementById('validation').innerHTML = "";
}