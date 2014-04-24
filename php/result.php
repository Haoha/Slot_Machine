<?php
//Relancer la machine en gardant l'historique des resultats

	include("bdd.php");
	include("session.php");

	//Je recupère le nom du joueur
	$player_name=$_POST["name_send"];

	//Je recupère dans new_result_Tab le contenu de la vartiable 'Play' envoyé par session.php
	$new_result_tab=$_SESSION["Play"];

	//Récupère la position des symbole

	$P1=$_POST["Position1"];
	$P2=$_POST["Position2"];
	$P3=$_POST["Position3"];

	$new_result_tab[]=array($player_name,$Symbole[abs($P1/100)],$Symbole[abs($P2/100)],$Symbole[abs($P3/100)]);
	
	//Je réinjecte le tableau à jour le tableau contenu dans la variable 'newphotoTab', et renvoie 'OK'
	$_SESSION["Play"]=$new_result_tab;

/*==========================/// Compteur ///==============================*/

	if(!isset($_SESSION["counter"][$player_name]))
	{
		$_SESSION["counter"][$player_name]=1;
	}

	else {$_SESSION["counter"][$player_name]=$_SESSION["counter"][$player_name]+1;}

/*=======================================================================*/
/*		$return_tab='';

		for($i=0;$i<count($new_result_tab);$i++)
	{
		$return_tab=$return_tab.'<div class="result_box" id="r_box'.$i.'">'.
		'<div id="result_box_player">'.$new_result_tab[$i][0].'</div>'.
		'<div class="r_div" id="r1">'.$new_result_tab[$i][1].'</div>
		<div class="r_div" id="r2">'.$new_result_tab[$i][2].'</div>
		<div class="r_div" id="r3">'.$new_result_tab[$i][3].'</div>
		<div class="remove" id="remove'.$i.'">x</div>
		</div>';
	}

	echo $return_tab;
*/

/* ============/// Equivalent simplifié du for en PHP /// ==============*/

	echo '<div id="details_resultats">';
	foreach($new_result_tab as $cle => $element)
	{
		echo '<div class="result_box" id="r_box'.$cle.'">'.
		'<div class="result_box_player">'.$element[0].'</div>'.
		'<div class="r_div" id="r1">'.$element[1].'</div>
		<div class="r_div" id="r2">'.$element[2].'</div>
		<div class="r_div" id="r3">'.$element[3].'</div>
		<div class="remove" id="remove'.$cle.'">x</div>
		</div>';
	}	
	echo '</div>
	
	<div id="compteur_parties" class="clearfix">
	<span id="titre_zone_nb_parties"> Nombre de Parties Jouées</span>';

	foreach($_SESSION["counter"] as $cle => $element)
	{
		echo '<div class="p_list" id="p_'.$cle.'">
		<div class="float_nom">'.$cle.'</div>
		<div class="count">'.$element.'</div></div>';
	}	

	echo '</div>'

?>