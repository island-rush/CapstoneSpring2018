<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Main Game Title</title>
    <link rel="stylesheet" type="text/css" href="style_board2.css">
    <script type="text/javascript">
        function make_big(ev, element) {
            ev.preventDefault();
        }
    </script>
</head>
<body>

<div id="game_board">
    <div class="grid">
        <div class="gridblockLeftBig"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblockRightBig"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblockEmptyLeft"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock" id="special_island" onclick="make_big(event, this)"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div class="gridblock"></div>
        <div id="bigblock1"></div>
    </div>
</div>

</body>
</html>