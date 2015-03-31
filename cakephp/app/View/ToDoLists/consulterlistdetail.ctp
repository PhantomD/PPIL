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
            <!--  <li><a href="#popupDisconnect" data-rel="popup" data-transition="flow">Déconnexion</a></li> -->
          <li>   <?php echo $this->Html->link('Déconnexion',array('controller' => 'Users','action' => 'logout')); ?></li>
            </ul> 
          </div>
        <a href="#popupDisconnect" data-role="button" data-rel="popup" data-inline="true" data-icon="back" data-iconpos="notext" data-mini="true" >Déconnexion</a>
          <div data-role="popup" id="popupDisconnect" data-position-to="window"  data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
            <div data-role="header" data-theme="a"><h1>Déconnexion</h1></div>
            <div role="main" class="ui-content">
              <h3 class="ui-title">Voulez-vous vraiment vous déconnecter ?</h3>
              <a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
            <!--  <a href="connexion.html" data-role="button" data-inline="true" data-icon="check">Valider</a> -->
             <?php echo $this->Html->link('Valider',array('controller' => 'Users','action' => 'logout'),array('data-role'=>'button','data-inline'=>true,'data-icon'=>'check')); ?>
             
            </div>
          </div>
        </div>
    </div>
		<div data-role="content">
      <h4 class="ui-bar ui-bar-a">Détails Todolist : <?php echo $name[0]['Todolist']['name'] ?></h4>
     <?php
     	$url = array('controller'=>'Todolists','action'=>'modifylist',$name[0]['Todolist']['name']);
		echo "Description : ".$text[0]['Todolist']['text'];
		?> <br><br> <?php
		echo "Date de début : ".$dateBegin[0]['Todolist']['dateBegin'];
		?> <br><br> <?php
		echo "Date de fin : ".$dateEnd[0]['Todolist']['dateEnd'];
		?> <br><br> <?php
		echo "Fréquence :".$frequency[0]['Todolist']['frequency'];
		?> <br><br> <?php
		echo $this->form->button("Modifier List", array('type' => 'button','name' => 'aa','id'=>'name', 'value'=>'','onclick' => "location.href='".$this->Html->url($url)."'"));

		?>
		</div>
	</div>
</html>