<?php
session_start();
//-1 for indexing errors, positions start at 1
$newPos = (int)$_REQUEST['newPos']-1;
$oldPos = (int)$_REQUEST['oldPos']-1;
$moves = (int)$_REQUEST['moves'];
if ($_SESSION['dist'][$oldPos][$newPos] <= $moves) {
    $answer = $moves - $_SESSION['dist'][$oldPos][$newPos];
    echo $answer;
} else {
    echo "false";
}