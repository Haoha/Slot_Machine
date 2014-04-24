<?php
	include("bdd.php");

	session_start();
	//Si la session n'existe pas j'en ouvre une
	if(!isset($_SESSION["nouveau_joueur"]))
	{
		$_SESSION["nouveau_joueur"]=$result_tab;
	}

/*==========================/// Nouveau Joueur ///=============================*/

$maj_liste='';

	$player_name=$_POST["name_send"];

	//Je verifie que le nom n'est pas existant dans la variable de session
	if(!isset($_SESSION["nouveau_joueur"][$player_name]))
	{
		//il n'existe pas donc c'est sa premiere partie
		$counter=1;

		//Je sauvegarde le counter à l'index correspondant au nom du joueur
		//(ici on a donc un index non numérique)
		$_SESSION["nouveau_joueur"][$player_name]=array($player_name,$counter);

		//Et j'injecte le tout dans le tablau liste_joueur
		$liste_joueur_tab[]=$_SESSION["nouveau_joueur"];


		for($i=0;$i<count($liste_joueur_tab);$i++)
		{
			$maj_liste=$maj_liste.'<div class="player_list_box" id="p_box'.$i.'">'.
			'<div classe="p_line" id="p_name_box">'.$liste_joueur_tab[$player_name][0].'</div>'.
			'<div class="p_line" id="p_counter_box">'.$liste_joueur_tab[$player_name][1].'</div>';
		}			
	}

	else 
	{ 
		//normalement on précise l'index du tableau: $player_name[0], s'il y avait plusieurs elements
		$counter=$liste_joueur_tab[$player_name][1];
		$counter=$counter+1;
		$liste_joueur_tab[$player_name][1]=$counter;

		for($i=0;$i<count($liste_joueur_tab);$i++)
		{
			$maj_liste=$maj_liste.'<div class="player_list_box" id="p_box'.$i.'">'.
			'<div classe="p_line" id="p_name_box">'.$liste_joueur_tab[$player_name][0].'</div>'.
			'<div class="p_line" id="p_counter_box">'.$liste_joueur_tab[$player_name][1].'</div>';
		}
	}

	$maj_liste=$liste_joueur_tab;
	echo $maj_liste;

/*============================================================================*/
?>