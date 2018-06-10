<?php
	require 'library/config.php';
	unset($_SESSION['login']);
	session_destroy();
	header('location: index.php');
