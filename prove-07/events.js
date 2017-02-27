/**
 * Created by cameronlewis on 2/17/17.
 */
function showHome() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("main").style.display = 'block';
            document.getElementById("result").innerHTML = '';
        }
    };
    xmlhttp.open("GET", "index.php", true);
    xmlhttp.send();
}

function requestPage(page) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('main').style.display = 'none';
            document.getElementById('result').innerHTML = this.responseText;
            var redirect = /Logged out|already logged/;

            if (redirect.test(this.responseText) == true) {
                setTimeout(showHome, 2200);
            }
        }
    };
    xmlhttp.open("GET", page, true);
    xmlhttp.send();
}

function showLogin() {
    requestPage('Login.php');
}

function showAccountCreation() {
    requestPage('createAccount.php');
}

function showLogout() {
    requestPage('logout.php');
}

function showStats() {
    requestPage('showStats.php');
}

function showMySearches() {
    requestPage('mySearches.php');
}

function validateInput(input) {
    if (/[&;%@!"?\- ^~:}\{()+$<>_*]/.test(input) == true)
        document.getElementById('validation').innerHTML = "Invalid characters" +
            " entered.";
    else
        document.getElementById('validation').innerHTML = "";
}

function loadingGIF(x) {
    var loading = document.getElementById('loading');
    loading.style.display = x;
}

// jQuery event listener. Gives answer to "What is this?" on hover.
$(document).on('mouseenter', '#what_is_this', function (e) {
    e.preventDefault();

    var explain = document.getElementById('explain_text');
    var what_is_this = document.getElementById('what_is_this');
    what_is_this.style.color = "gray";

    explain.innerHTML =
        'Ever had a hard time trying ' +
        'to understand if a text message was ' +
        'positive or negative? How about a tweet? Hundreds of computers ' +
        'linked together have been fed millions of pages of text to teach ' +
        'them what humans really mean when they say something. ' +
        'It\'s called machine learning, the same technology used by Siri ' +
        'and Google Assistant to make sense of the things humans tell them.' +
        '<p>Sentiment measures how positive or negative the tweets' +
        ' associated with the hashtag are, with a scale of -100% to' +
        ' positive 100%.</p>' +
        '<p>Magnitude is a measure of emotion, and scales up to 100%' +
        ' depending on how \'emotional\' these tweets are deemed to' +
        ' be.</p>';

}).on('mouseleave', '#what_is_this', function () {
    var remove_explain = document.getElementById('explain_text');
    var what_is_this = document.getElementById('what_is_this');
    what_is_this.style.color = "white";
    remove_explain.innerHTML = '';
});

$(document).on('submit', '#submit_hashtag', function (e) {
    e.preventDefault();
    var text = document.getElementById('validation').innerHTML;
    if (text == "") {
        loadingGIF('block');

        var hashtag = $('#input_hashtag').val();

        // Use AJAX to send data via POST and obtain the results of 'echo' in PHP script
        $.ajax({

            type: "POST",
            url: 'searchTweets.php',
            data: {input_hashtag: hashtag},

            success: function (response) {
                $('#result').html(response);
            },
            error: function () {
                alert('error. sorry pal');
            },
            complete: function () {
                loadingGIF('none');
            }
        });
    }
    else {
        alert('Please remove the invalid characters to submit.');
    }
});

$(document).on('submit', '#login_form', function (e) {
    e.preventDefault();
    loadingGIF('block');

    var username = $('#returningUser_name').val();
    var password = $('#returningUser_pass').val();

    var notify_bad_user = "Username not found! Click on the link below to" +
        " make an" +
        " account.";
    var notify_bad_pass = "Incorrect password. Please try again.";
    // Use AJAX to send data via POST and obtain the results of 'echo' in PHP script
    $.ajax({

        type: "POST",
        url: 'processLogin.php',
        data: {username: username, password: password},

        success: function (response) {
            var bad_user = /not found/;
            var bad_pass = /Incorrect/;
            if (bad_user.test(response) == true) {
                console.log('user not found baby');
                $('#user_notfound').html(notify_bad_user);
                $('#bad_pass').html('');
            }
            else if(bad_pass.test(response)==true){
                console.log('pass not found baby');
                $('#bad_pass').html(notify_bad_pass);
                $('#user_notfound').html('');
            }
            else {
                $('#result').html(response);
                $('#user_notfound').html('');
                $('#bad_pass').html('');
                setTimeout(showHome, 2200);
            }
        },
        error: function () {
            alert('error. Sorry pal!');
        },
        complete: function () {
            loadingGIF('none');
        }
    });
});

$(document).on('submit', '#account_creation', function (e) {
    e.preventDefault();
    loadingGIF('block');

    var username = $('#create_username').val();
    var password = $('#create_password').val();

    // Use AJAX to send data via POST and obtain the results of 'echo' in PHP script
    $.ajax({

        type: "POST",
        url: 'processLogin.php',
        data: {username: username, password: password},

        success: function (response) {
            $('#result').html(response);
            setTimeout(showHome, 2200);
        },
        error: function () {
            alert('error. Sorry pal!');
        },
        complete: function () {
            loadingGIF('none');
        }
    });
});