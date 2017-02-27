<?php
session_start();
?>
//TODO: fix the flipping menu. Gosh dangit that thing!
<!DOCTYPE HTML>
<head>
    <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
    <script src="jquery-3.1.1.min.js"></script>
</head>
<body>
<div id="wrapper" class="wrapper">

    <div class="buttons">
        <input type="image" src="menu_icon.png" id="button--slide-left"
               class="button">
    </div>

</div><!-- /wrapper -->

<!-- menu -->
<nav id="menu--slide-left" class="menu menu--slide-left">
    <button class="menu__close">&larr; Close Menu</button>
    <ol class="menu__items">
        <li class="menu__item">

            <div>
                <span style="padding-left: 8%">+</span>
                <a id="showHome" href="javascript:showHome()"
                   onmouseover="mouseOver(this)"
                   onmouseout="mouseOut(this)" href="index.php"
                   class="menu__link">Search</a>
            </div>
        </li>
        <li class="menu__item">

            <div>
                <span style="padding-left: 8%">+</span>
                <a id="statistics" onmouseover="mouseOver(this)"
                   onmouseout="mouseOut(this)"
                   href="javascript:showLogin()"
                   class="menu__link">Login</a>
            </div>
        </li>
        <li class="menu__item">

            <div>
                <span style="padding-left: 8%">+</span>
                <a id="mySearches" href="javascript:showMySearches()"
                   onmouseover="mouseOver(this)"
                   onmouseout="mouseOut(this)" href="mySearches.php"
                   class="menu__link">My
                    Searches</a>
            </div>
        </li>
        <li class="menu__item">
            <div>
                <span style="padding-left: 8%">+</span>
                <a id="showStats" onmouseover="mouseOver(this)"
                   onmouseout="mouseOut(this)"
                   href="javascript:showStats()"
                   class="menu__link">Statistics</a>
            </div>
        </li>
        <li class="menu__item">
            <div>
                <span style="padding-left: 8%">+</span>
                <a id="showLogout" onmouseover="mouseOver(this)"
                   onmouseout="mouseOut(this)"
                   href="javascript:showLogout()"
                   class="menu__link">Log Out</a>
            </div>
        </li>

    </ol>
</nav>

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
                   oninput="validateInput(this.value)" name="input_hashtag">
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