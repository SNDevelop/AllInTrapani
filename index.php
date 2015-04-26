<?php
require 'Logic\navigation.php';

$section = new Navigation;
$section->Nav();
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<base href="http://localhost:81/">
		<meta charset="utf-8" />
		<script type="text/javascript" src="scripts/ajax.js"></script>
				
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title><?php echo $section->Title; ?></title>
		
		<meta name="description" content="" />
		<meta name="author" content="All in Trapani.it" />
		
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		<link rel="stylesheet" type="text/css" href="style/stile.css" />				
		
    	<!-- Demo CSS -->
		<link rel="stylesheet" href="style/flexslider.css" type="text/css" media="screen" />	
	</head>

	<body>
		<!-- div popup login -->
	    <div id="loginlight" class="white_content">
	    	Modulo di Login. 
	    	<a class="hemens" href = "javascript:void(0)" 
	    		title="Chiudi"
	    		onclick = "document.getElementById('loginlight').style.display='none';
	    		document.getElementById('loginfade').style.display='none'">
	    		<div class="imgClose"></div>
	    	</a>
	    	
	    	<form method="post" action="UsersBll/LogIn">													
				<br />Email: <input class="DivPopUpInput" name="email" type="text" value="" /><br /><br />
				Password: <input class="DivPopUpInput" name="Password" type="password" value="" /><br /><br />
				<button class="DivPopUpButton" type = "submit" name = "LogIn">Accedi</button>								
			</form>				    	
	    </div>
	    <!-- fine div popup login -->
	    
	    <div id="loginfade" class="black_overlay"></div>
		
		<div id="reglight" class="white_content">
			Modulo di Registrazione. 
			<a class="hemens" href = "javascript:void(0)" 
				title="Chiudi"
				onclick = "document.getElementById('reglight').style.display='none';
				document.getElementById('regfade').style.display='none'">
				<div class="imgClose"></div>
			</a>
			<form name="RegistrationForm" onSubmit="return SubmitClick();" method="post" action="UsersBll/UserRegistration">
				<br />Email: <span id="msgEmail"></span><span class="hidden" id="resEmailCheck">0</span>
				<input name="email" onkeyup="CheckEmail();" class="DivPopUpInput" type="text" value="" /><br /><br />
			 	Nome Utente: <span id="msgUserName"></span><span class="hidden" id="resUserNameCheck">0</span>	 
				<input class="DivPopUpInput" name="UserName" onkeyup="CheckUserName();" type="text" value="" /><br /><br />
				Password: <span id="msgPassword"></span><span class="hidden" id="resPasswordCheck">0</span>
				<input class="DivPopUpInput" name="Password" onkeyup="ClearMsgPass();" type="password" value="" /><br /><br />
				Ripeti Password: <span id="msgRePassword"></span><span class="hidden" id="resRePasswordCheck">0</span>
				<input name="RePassword" onkeyup="CheckRePassword();" class="DivPopUpInput" type="password" value="" /><br /><br />
				
				<div id="informativa">
					<b>Informazioni sulla registrazione</b>
					<br/><br/>
					Tutte le informazioni inserite all'interno di questo modulo sono ritenute strettamente confidenziali.
					Abilitando la casella, dichiari di aver preso visione dell'Informativa di cui all'art.13 D.Lgs.196/03 e di accettarla.
					
					<br/><br/>
					<b>Informativa di cui all'art.13 D.Lgs.196/03</b>
					<br/><br/>
					Nel rispetto della normativa vigente in materia di protezione dei dati personali, La informiamo che All in Trapani.it,
					all'atto dell'iscrizione necessita solo dell'inserimento di un indirizzo di posta elettronica e di un nome utente a Sua scelta.
					I dati forniti da Lei o da altri soggetti, sono solo quelli strettamente necessari e sono trattati solo con le modalit&agrave;
					e procedure - effettuate anche con l'ausilio di strumenti elettronici - necessarie per i servizi forniti da All in Trapani.it,
					anche quando comunichiamo a tal fine alcuni di questi ad altri soggetti connessi ad un eventuale rapporto di lavoro di carattere temporaneo
					o continuativo, in Italia o all'estero; per taluni servizi, inoltre, utilizziamo soggetti di nostra fiducia che svolgono per nostro conto,
					in Italia o all'estero, compiti di natura tecnica, organizzativa e operativa.
					I suoi dati possono inoltre essere conosciuti dai nostri collaboratori specificatamente autorizzati, in qualit&agrave;
					di Responsabili o Incaricati, a trattarli per il perseguimento delle finalit&agrave;
					sopraindicate. I Suoi dati non sono soggetti a diffusione. Lei ha diritto di conoscere, in ogni momento, quali sono quelli archiviati
					presso di noi, la loro origine e come vengono utilizzati; ha inoltre il diritto di farli aggiornare, rettificare, integrare o cancellare,
					chiederne il blocco ed opporsi al loro trattamento.
					Sulla base di quanto sopra, iscrivendosi al servizio, Lei esprime il consenso al trattamento dei dati (eventualmente anche sensibili)
					effettuato su All in Trapani.it, alla loro comunicazione ai soggetti sopraindicati e al trattamento da parte di questi ultimi.
					<br/><br/>
					<b>Condizioni di utilizzo</b>
					<br/><br/>
					E' necessario essere maggiorenni per poter utilizzare il servizio. L'utente &egrave;
					direttamente responsabile dei contenuti che inserisce sulle pagine di All in Trapani.it e delle azioni che compie sul sito. L'utente &egrave;
					direttamente responsabile della sicurezza della propria password.
					Gli articoli pubblicati su All in Trapani.it sono segnalati dagli utenti senza alcun controllo preventivo da parte della Redazione.
					All in Trapani.it non &egrave;
					responsabile in alcun modo dei commenti scritti dai singoli utenti, in quanto non viene eseguito alcun filtro preventivo alla loro pubblicazione.
					La Redazione di All in Trapani.it si riserva di eliminare senza preavviso commenti e segnalazioni considerate offensive, illegali, a
					carattere pornografico o comunque non in linea con le policy di All in Trapani.it. La Redazione di All in Trapani si riserva di eliminare
					e bloccare senza preavviso commenti e segnalazioni considerate offensive, illegali, a carattere pornografico, spam o comunque non in linea con
					le policy di All in Trapani.
					La Redazione si riserva inoltre di modificare a propria discrezione i titoli, le descrizioni e i link delle segnalazioni,
					qualora questi rappresentino un chiaro abuso del servizio, delle policy o siano causa di problemi per il sito stesso.
					La Redazione di All in Trapani si riserva infine di modificare le condizioni di utilizzo senza preavviso, notificandone
					la modifica attraverso email o articoli sul proprio Blog.
					<br/><br/> 
				</div>
				<label><input name="iagree" type="checkbox" value="#" onclick="ClearMsgIagree();" />Accetto i termini del contratto</label><span id="msgIagree"></span><br /><br />
				<span id="RegMsg" style="color: green"></span>
				<button class="DivPopUpButton" type = "submit" name = "Registration" >Registrati</button>
			</form>
		</div>
	    <div id="regfade" class="black_overlay"></div>
			<!-- header contenete i pulsanti sociali e il login,registrazione,contatti, chi siamo e l'home -->
			<header>
				<div class="fleft">
					<a href="General/Home"><h3 class="colorB">HOME</h3></a>
					<a href="General/About"><h3>CHI SIAMO</h3></a>
					<a href="General/Contacts"><h3>CONTATTI</h3></a>
				</div>				
				
				<a href="#rss"><img class="hemens" src="style/img/rs.png" /> </a>
				<a href="#google plus"><img class="hemens" src="style/img/gplus.png" /> </a>
				<a href="#twitter"><img class="hemens" src="style/img/twit.png" /> </a>
				<a href="#facebook"><img class="hemens" src="style/img/fac.png" /> </a>
				<!-- link x div popup -->
				<?php echo $section->UserForm; ?>
			</header>
			<!-- sotto l'Header troviamo un div che contine il logo del sito linkabile e il box per la ricerca sul sito -->
			<div id="bheader">				
				<a href="General/Home"><img src="style/img/allintrapani.png" /></a>
				<input type="text"  class="hemens" name="search" value=" Cerca sul sito" />				
			</div>
			
			<!-- Il Tag NAV contiene le categorie ed il banner degli eventi attivi-->
			<nav>
				
				<p><a href="Content/History"> STORIA </a></p>
				<p><a href="Content/DoYouKnow"> SAPEVI CHE...? </a></p>
				<p><a href="Content/Events"> EVENTI </a></p>
				<p><a href="Content/Sport"> SPORT </a></p>
				<p><a href="Content/Kitchen"> CUCINA </a></p>
				<p><a href="Content/Other"> ALTRO </a></p>
				<p><a href="Content/MaelsRecipes"> LE RICETTE DI MAEL </a></p>
				
				<div class="hemens" id="EventAtt">
					<p>EVENTI</p>	
					<img src="style/img/tratBeventi.png" />
					<p>Evento da Mastro Ciccio Filliricchio Pasta CU l'Agghia!!</p>					
				</div>
			</nav>
			<!-- questo div contiene lo spazio per lo slider fotografico ed il video di youtube -->
			<div id="sliderplusvideo">	
							
				<div id="slidershow">						
					<div class="flexslider">
			          <ul class="slides">
			        	<li>			        	
			    	    <img src="style/slide/header1.jpg" alt="" />
			    		</li>
			    		<li>
			    	    <img src="style/slide/header2.jpg" alt="" />
			    		</li>
			    		<li>
			    	    <img src="style/slide/header4.jpg" alt="" />
			    		</li>
			    		<li>
			    	    <img src="style/slide/header5.jpg" alt="" />
			    		</li>
			          </ul>     					
					</div>
				</div>	 
				<iframe id="youtube" class="hemens"  src="http://www.youtube.com/embed/MwyCwLP80-4?html5=1&amprel=0"> </iframe>
			</div>
			  
					
			<div id="central">				
				<?php echo $section->Content; ?>												
			</div>
			
			<footer>
				<p>
					&copy; Copyright  by All in Trapani
				</p>
				<br/>
			</footer>
  <!-- FlexSlider -->
	<script src="scripts/jquery.min.js"></script>
	<script defer src="scripts/jquery.flexslider.js"></script>

	<script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
		        }
		      });
		   });
	 </script>

	</body>
</html>
=======
echo "pippo pippo pippo";
echo "pluto pluto pluto";
echo "pippo pippo pippo pippo";
?>
>>>>>>> origin/master
