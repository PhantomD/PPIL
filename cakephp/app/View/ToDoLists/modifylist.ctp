<?php
if(empty($this->request->data)){

	$tableau['name'] = "";
	$tableau['text'] = "";
	$tableau['dateBegin'] = "";
	$tableau['dateEnd'] = "";
	$tableau['frequency'] = "";
}
else{

	$todolist = $this->request->data['Todolist'];
	$tableau['name'] = $todolist['name'];
	$tableau['text'] =  $todolist['text'];
	$tableau['dateBegin'] =  $todolist['dateBegin'];
	$tableau['dateEnd'] =  $todolist['dateEnd'];
	$tableau['frequency'] =  $todolist['frequency'];

}
?>

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
      <h4 class="ui-bar ui-bar-a">Détails Todolist : <?php echo $name[0]['Todolist']['name'] ?></h4>

     <?php

     echo $this->form->create(array('type'=>'post',array('action'=>'modifylist')));

     	echo "Nom : "; 
     	echo $this->form->input("", array('type' => 'text','name' => 'data[Todolist][name]','id'=>'name', 'value'=>$name[0]['Todolist']['name']));
		echo "Description : ";
		echo $this->form->input("", array('type' => 'text','name' => 'data[Todolist][text]','id'=>'text', 'value'=>$text[0]['Todolist']['text']));
		?> <br><br> <?php
		echo "Date de début : ";
		echo $this->form->input("", array('type' => 'text','name' => 'data[Todolist][dateBegin]','id'=>'dateBegin', 'value'=>$dateBegin[0]['Todolist']['dateBegin']));
		?> <br><br> <?php
		echo "Date de fin : ";
		echo $this->form->input("", array('type' => 'text','name' => 'data[Todolist][dateEnd]','id'=>'dateEnd', 'value'=>$dateEnd[0]['Todolist']['dateEnd']));
		?> <br><br> <?php
		echo $this->form->end('Valider Changement',array('id'=>'modifylist'));

		?>
		</div>
	</div>
</html>