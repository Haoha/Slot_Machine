<?php
//SupPhoto.php s'occupe de suprimer la photo

	include("bdd.php");
	include("session.php");

	//Je recupère dans new_r_tab le contenu de la vartiable 'Play' envoyé par session.php
	$new_r_tab=$_SESSION["Play"];

	//Je recupère l'index à suprimer
	$indexToDel=$_POST["index"];

	//je recupère dans une variable temporaire le nom du joueur suprimé
	$nom_joueur_sup=$new_r_tab[$indexToDel][0];

	//suprime '1' element du tableau à l'index 'indexToDel'
	array_splice($new_r_tab,$indexToDel,1);

	//Je réinjecte le tableau à jour le tableau dans la variable 'Play'
	$_SESSION["Play"]=$new_r_tab;

	$n=$_SESSION["counter"][$nom_joueur_sup];
	$n=$n-1;
	$_SESSION["counter"][$nom_joueur_sup]=$n;

	if($n==0)	
	{
		unset($_SESSION["counter"][$nom_joueur_sup]);
	}
	
/*
	//Je réafiche l'historique à jour
	$return_tab='';

	for($i=0;$i<count($new_r_tab);$i++)
	{
		$return_tab=$return_tab.'<div class="result_box" id="r_box'.$i.'">'.
		'<div id="result_box_player">'.$new_r_tab[$i][0].'</div>'.
		'<div class="r_div" id="r1">'.$new_r_tab[$i][1].'</div>
		<div class="r_div" id="r2">'.$new_r_tab[$i][2].'</div>
		<div class="r_div" id="r3">'.$new_r_tab[$i][3].'</div>
		<div class="remove" id="remove'.$i.'">x</div>
		</div>';
	}

	echo $return_tab;
*/


	echo '<div id="details_resultats">';
	foreach($new_r_tab as $cle => $element)
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