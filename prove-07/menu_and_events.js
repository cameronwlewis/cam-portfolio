/**
 * Created by cameronlewis on 2/17/17.
 */
function Menu(){
    this.wrapper = '#wrapper';
    this.menuOpener = '.button';
    this.mask = '#mask';
}




function mouseOver(x) {
    x.style.color = "gray";
}

function mouseOut(x) {
    x.style.color = "black";
}

var slideLeft = new Menu({
    wrapper: '#wrapper',
    type: 'slide-left',
    menuOpenerClass: '.button',
    maskId: '#mask'
});

var slideLeftBtn = document.querySelector('#button--slide-left');

slideLeftBtn.addEventListener('click', function (e) {
    e.preventDefault();
    slideLeft.open();
});

function showHome() {
    this.body.classList.remove('has-active-menu');
    this.wrapper.classList.remove('has-' + this.options.type);
    this.menu.classList.remove('is-active');
    this.mask.classList.remove('is-active');
    this.enableMenuOpeners();

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
    var closeMenu = document.querySelector('.menu__close');
    closeMenu.close();


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



/*$('.menu__item').on('click', function(){
    $("#menu--slide-left").hide();
    $("#mask").hide();
    //$("#menu-icon").removeClass("active");
});*/

