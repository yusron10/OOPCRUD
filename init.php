<?php 

spl_autoload_register(function ($class) {
	require_once 'Job/' . $class . '.php';
}) ;




 ?>