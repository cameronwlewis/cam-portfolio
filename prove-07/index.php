<?php

session_start();
?>
<!DOCTYPE HTML>
<head>
    <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
    <script type="text/javascript" src="menuStuff.js"></script>
    <script src="jquery-3.1.1.min.js"></script>

</head>
<body>
<div id="o-wrapper" class="o-wrapper">

    <div class="c-buttons">
        <input type="image" src="menu_icon.png" id="c-button--slide-left"
               class="c-button">
    </div>

</div><!-- /o-wrapper -->

<!-- menus here -->
<nav id="c-menu--slide-left" class="c-menu c-menu--slide-left">
    <button class="c-menu__close">&larr; Close Menu</button>
    <ol class="c-menu__items">
        <li class="c-menu__item">

            <div>
                <span style="padding-left: 8%">01</span>
                <a id="mySearches" href="javascript:showHome()" onmouseover="mouseOver(this)"
                   onmouseout="mouseOut(this)" href="index.php" class="c-menu__link">Home</a>
            </div>
        </li>
        <li class="c-menu__item">

            <div>
                <span style="padding-left: 8%">02</span>
                <a id="mySearches" href="javascript:showMySearches()" onmouseover="mouseOver(this)"
                   onmouseout="mouseOut(this)" href="mySearches.php" class="c-menu__link">My
                    Searches</a>
            </div>
        </li>
        <li class="c-menu__item">

            <div>
                <span style="padding-left: 8%">03</span>
                <a id="statistics" onmouseover="mouseOver(this)"
                   onmouseout="mouseOut(this)"
                   href="javascript:showStats()" class="c-menu__link">Statistics</a>
            </div>
        </li>
    </ol>
</nav><!-- /c-menu slide-left -->

<div id="c-mask" class="c-mask"></div><!-- /c-mask -->
<script src="jquery_events.js"></script>
<script src="menu_and_events.js"></script>
<div id="main">
<form id="submit_hashtag" style="display: block">
    <p>
        <label for="input_hashtag" id="main_heading"
               class="front_page">Analyze </br>Sentiment.</label>
    <p>
        <input type="text" id="input_hashtag" class="front_page"
               placeholder="just feed me a #hashtag" oninput="validateInput(this.value)" name="input_hashtag">
    </p>
        <span id="validation"></span>
    </p>

    <input type="submit" style="color: black" class="front_page" >
</form >
    <p class="explanation">
    <a id="what_is_this" class="explanation" href="#">What is this?</a>
        <br/>
    <div id="explain_text" class="explanation">
    </div>
</div>
<div >

</div>
<div
        id="loading" style="display: none;"><img src="loading_spinner.gif"
                          style=" width: 5%"></div>
<div id="result">

</div>

</body>