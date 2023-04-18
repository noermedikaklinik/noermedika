<?php 

session_start();
session_destroy();

header ("Location:..?message=Anda Telah Logout");

?>