
		<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Projet PPIL</title>
	<link rel="stylesheet" href="css/model.css" />
	<link rel="stylesheet" href="css/PpilBlue.min.css" />
	<link rel="stylesheet" href="css/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="css/jquery.mobile.structure-1.4.5.min.css" />
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
</body>
	<div data-role="page" data-theme="a" id="page_mainScreen">
		<div data-role="header" data-position="inline" data-theme="a">
			<h1>Accueil</h1>
			<div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">
				<a data-role="button" data-inline="true" data-icon="recycle" data-iconpos="notext" data-mini="true" >Rafraichir</a>
				<a href="addList.html" data-role="button" data-inline="true" data-icon="plus" data-iconpos="notext" data-mini="true" >Ajouter une liste</a>
				<a href="#popupMenu" data-role="button" data-rel="popup" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" data-transition="slidedown">Menu</a>
          <div data-role="popup" id="popupMenu" data-theme="b">
            <ul data-role="listview" data-inset="true" style="min-width:210px;">
              <li data-role="list-divider">Menu</li>
              <li><a href="afficherProfil.html">Afficher profil</a></li>
              <li><a href="#popupDisconnect" data-rel="popup" data-transition="flow">Déconnexion</a></li>
            </ul> 
          </div>
        <a href="#popupDisconnect" data-role="button" data-rel="popup" data-inline="true" data-icon="back" data-iconpos="notext" data-mini="true" >Déconnexion</a>
          <div data-role="popup" id="popupDisconnect" data-position-to="window"  data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
            <div data-role="header" data-theme="a"><h1>Déconnexion</h1></div>
            <div role="main" class="ui-content">
              <h3 class="ui-title">Voulez-vous vraiment vous déconnecter ?</h3>
              <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
              <a href="connexion.html" data-role="button" data-inline="true" data-icon="check">Valider</a>
            </div>
          </div>
        </div>
		</div>
		<div data-role="content">
      <h4 class="ui-bar ui-bar-a">Aujourd'hui</h4>
      <?php

		$ligne = 0;
		for ($ligne = 0; $ligne < $this->requestAction('/Todolists/taillelist'); $ligne++) {
			$name = $this->requestAction('/Todolists/consulterlist/'.($ligne));
			$url = array('controller'=>'Todolists','action'=>'consulterlistdetail',$name);
			echo $name/*$this->form->button($name, array('type' => 'button','name' => 'aa','id'=>'name', 'value'=>'','onclick' => "location.href='".$this->Html->url($url)."'"))*/;
			echo $this->form->button('f', array('type' => 'button','name' => 'aa','id'=>'name', 'value'=>'','data-inline'=>'true','data-icon'=>'carat-r','data-iconpos'=>'notext', 'data-mini'=>'true','onclick' => "location.href='".$this->Html->url($url)."'")); ?> <br> <?php
		}
		?>
 <br/>
      <h4 class="ui-bar ui-bar-a">Demain</h4>
   <br/>
		</div>
	</div>
</html>
