<?php

	session_start();
	//Si la session n'existe pas j'en ouvre une
	if(!isset($_SESSION["Play"]))
	{
		//J'injecte result_tab dans la variable de session 'Play'
		$_SESSION["Play"]=$result_tab;
		$player_tab[]=$SESSION["Play"];
	}

	//Je verifie que le nom n'est pas existant dans la variable de session
	if(!isset($_SESSION["counter"]))
	{
		$_SESSION["counter"]=array();
	}
?>