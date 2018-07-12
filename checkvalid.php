<?php
session_start();
$newPos = (int)$_REQUEST['newPos'];
$oldPos = (int)$_REQUEST['oldPos'];
$moves = (int)$_REQUEST['moves'];
if ($_SESSION['dist'][$oldPos][$newPos] <= $moves) {
    $answer = $moves - $_SESSION['dist'][$oldPos][$newPos];
    echo $answer;
} else {
    echo "false";
}