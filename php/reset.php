<?php

	include("bdd.php");
	include("session.php");

	$_SESSION["Play"]='';
	$_SESSION["counter"]='';
	
	$return_var=$_SESSION["Play"].$_SESSION["counter"];

	echo $return_var;
?>