<?php
session_start();
?>

<!DOCTYPE HTML>
<head>
    <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
    <script src="jquery-3.1.1.min.js"></script>
</head>
<body>
    <div class="buttons">
        <input type="image" src="menu_icon.png" style="width: 2%;" onclick="openNav()">
    </div>

<!-- menu -->
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn"
       onclick="closeNav()">&times;</a>

    <a onmouseover="mouseOver(this)" onmouseout="mouseOut(this)"
       href="javascript:showHome()">Search</a>

    <a onmouseover="mouseOver(this)" onmouseout="mouseOut(this)"
       href="javascript:showLogin()">Login</a>

    <a onmouseover="mouseOver(this)" onmouseout="mouseOut(this)"
       href="javascript:showMySearches()">My Searches</a>

    <a onmouseover="mouseOver(this)" onmouseout="mouseOut(this)"
       href="javascript:showStats()">Statistics</a>

    <a onmouseover="mouseOver(this)" onmouseout="mouseOut(this)"
       href="javascript:showLogout()">Log Out</a>
</div>

<div id="mask" class="mask"></div><!-- /mask -->
<script src="events.js"></script>
<script src="menu.js"></script>
<div id="main">
    <form id="submit_hashtag" style="display: block">
        <p>
            <label for="input_hashtag" id="main_heading"
                   class="front_page">Analyze </br>Sentiment.</label>
        <p>
            <input size="23" type="text" id="input_hashtag" class="front_page"
                   placeholder="just feed me a #hashtag"
                   oninput="validateSearch(this.value)" name="input_hashtag">
        </p>
        <span id="validation"></span>
        </p>
        <input type="submit" style="color: black" class="front_page">
    </form>
    <p class="explanation">
        <a id="what_is_this" class="explanation" href="#">What is this?</a>
        <br/>
    <div id="explain_text" class="explanation">
    </div>
</div>
<div>

</div>
<div id="loading" style="display: none;"><img src="loading_spinner.gif"
                                              style=" width: 5%">
</div>
<div id="result"></div>
<div id="notify"></div>

</body>