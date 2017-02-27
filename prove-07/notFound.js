/**
 * Created by cameronlewis on 2/27/17.
 */
var notFound = document.getElementById('user_notFound');
notFound.style.display = 'block';
notFound.style.color = 'white';
notFound.innerHTML = "<br/>Username not found! Click " +
    "<a class='login_link' href='javascript:showAccountCreation()'>here" +
    "</a>to make an account.";