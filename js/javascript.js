/*================= /// Tableau Photos /// =================*/

//Position initial du background des roues
var position1=0;
var position2=0;
var position3=0;
var formulaire='';

//On crééé des variables qui vont contenir des intervalles utilisés comme paramèttre de cleanInterval pour arreter les roues
var interval_container_1;
var interval_container_2;
var interval_container_3;

var nom_joueur;

Jouer();

function Jouer()
{
	$('#start').click(function()
	{
		formulaire=$('#Nom_joueur').val();
		if(formulaire=='')
		{	
			document.getElementById('Nom_joueur').style.backgroundColor="#FF0000";
			setInterval(function(){document.getElementById('Nom_joueur').style.backgroundColor="#FFFFFF"},2000);
		}

		if(formulaire!='') {Lancer();}
	});
}	


/*===============================*/

function Lancer() 
{
	$('#reset').off('click');
//J'initialise les intervals à 0
	clearInterval(interval_container_1);
	clearInterval(interval_container_2);
	clearInterval(interval_container_3);

//Puis je fixe les valeurs d'intervals pour déphaser les roues	
	interval_container_1=setInterval('Tourne1();',45);
	interval_container_2=setInterval('Tourne2();',30);
	interval_container_3=setInterval('Tourne3();',15);

//J'acitve l'écoute sur le click du bouton 'stop'

	document.getElementById('stop').addEventListener('click', Arreter, false);
	document.getElementById('start').removeEventListener('click', Lancer, false);
}	

/*===============================*/

function Tourne1()
{
	position1=position1-20;
	document.getElementById('roue1').style.backgroundPosition='0px '+position1+'px';
	
	if(position1<=-600)
	{
		position1=0;
	}
}

/*===============================*/

function Tourne2()
{
	position2=position2-20;
	document.getElementById('roue2').style.backgroundPosition='0px '+position2+'px';
	
	if(position2<=-600)
	{
		position2=0;
	}
}

/*===============================*/

function Tourne3()
{
	position3=position3-20;
	document.getElementById('roue3').style.backgroundPosition='0px '+position3+'px';
	
	if(position3<=-600)
	{
		position3=0;
	}
}

/*===============================*/

function Arreter()
{
	document.getElementById('stop').removeEventListener('click', Arreter, false);
//J'arrete la roue en effaçant l'interval avant le décalage du background
	clearInterval(interval_container_1); 
//La paramètres = une variable et pas une fonction

	setTimeout("Arreter2();",500);
	setTimeout("Arreter3();",1000);

//je regarde si l'image est bien entière: modulo different de 0 = image non entière 
	if(position1%100!=0)
	{
	//Je divise et j'injecte dans check, la position par 100 pour pouvoir arrondir après
		var check=position1/100;
		check=Math.floor(check);		//Math.floor= arrondie à la valeur inférieur
	
	//Je re-multiplie par 100 'check' pour avoir la position du background (multiple de 100)
	//Je réinjecte la valeur du background position dans le HTML
		document.getElementById('roue1').style.backgroundPosition='0px '+(100*check)+'px';
	}
}

function Arreter2()
{
	clearInterval(interval_container_2);

	if(position2%100!=0)
	{
		var check=position2/100;
		check=Math.floor(check);
		document.getElementById('roue2').style.backgroundPosition='0px '+(100*check)+'px';
	}
}


function Arreter3()
{
	clearInterval(interval_container_3);

	if(position3%100!=0)
	{
		var check=position3/100;
		check=Math.floor(check);
		document.getElementById('roue3').style.backgroundPosition='0px '+(100*check)+'px';
	}

	document.getElementById('stop').removeEventListener('click', Arreter, false);
	
	Save_Combi();
	Jouer();
}

function Save_Combi()
{
	nom_joueur=$('#Nom_joueur').val();
	var Position1=$('#roue1').css('background-position').replace('0px ','');
	var Position2=$('#roue2').css('background-position').replace('0px ','');
	var Position3=$('#roue3').css('background-position').replace('0px ','');

	$.ajax
	({
		// /!\ php/result.php et non ../php/result.php le link de Mapage_Affiche le met au même niveau /!\
		url: "php/result.php",
		type: "POST",

		//val contient le numero de l'id start cliqué
		data: "name_send="+nom_joueur+"&Position1="+Position1+"&Position2="+Position2+"&Position3="+Position3,

		//ce qui est retourné par result.php est contenu dans A
		success: function(A)
		{	
			$('#resultbox').html(A);
			Remove_Result();
			Reset_Result();
		}
	});	
}

/*===// Remove Result //===*/

function Remove_Result()
{
	$('.remove').click(function()
	{
		//Pointe l'objet cliqué que je met en paramètres à 'SupElement'
		Sup_Element($(this));
	});
}

function Sup_Element(obj)
{
	//Je recupère l'attribue id de l'objet
	var index=obj.attr('id');
	//Je récupère la partie numérique de l'index que j'envoie à SupPhoto.php
	index=index.replace('remove','');

	$.ajax(
	{
		url:"php/sup_result.php",
		type: "POST",

		data:"index="+index,
		success:function(retour)
		{
			$('#resultbox').html(retour);
			Remove_Result();		
		}
	})
}

function Reset_Result()
{
	$('#reset').click(function() {Sup_All();
	});
}

function Sup_All()
{
	$.ajax(
	{
		url:"php/reset.php",
		type: "POST",

		success:function(A)
		{	
			$('#resultbox').html(A);
			document.getElementById('reset').removeEventListener('click', Reset_Result, false);	
		}
	});
}

/*===============================*/