<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$connection = mysqli_connect('localhost', 'root', '', 'signsoft');
$db = mysqli_connect('localhost', 'root', '', 'signsoft');
$connect = mysqli_connect('localhost', 'root', '', 'signsoft');
$conn = mysqli_connect('localhost', 'root', '', 'signsoft');

?>