<?php
session_start();

$newPos = $_REQUEST['newPos'];
$oldPos = $_REQUEST['oldPos'];
$moves = $_REQUEST['moves'];

if ($_SESSION['dist'][$oldPos][$newPos] >= $moves) {
    echo "true";
} else {
    echo "false";
}
