<?php
if(isset($liste) && !empty($liste)){

	$tableau['name'] = $liste['name'];
	$tableau['text'] = $liste['text'];
	$tableau['dateBegin'] = $liste['dateBegin'];
	$tableau['dateEnd'] = $liste['dateEnd'];

	$tableaudateBegin = explode("-",$tableau['dateBegin']);
	if(count($tableaudateBegin)==3){
	$tableau['dateBegin'] = $tableaudateBegin[2]."/".$tableaudateBegin[1]."/".$tableaudateBegin[0];
} else {
	$tableau['dateBegin'] ="";
}

	$tableaudateEnd = explode("-",$tableau['dateEnd']);
	if(count($tableaudateEnd)==3){
	$tableau['dateEnd'] = $tableaudateEnd[2]."/".$tableaudateEnd[1]."/".$tableaudateEnd[0];
} else {
	$tableau['dateEnd'] ="";
}



}
else{

	$todolist = $this->request->data['Todolist'];
	$tableau['name'] = $todolist['name'];
	$tableau['text'] =  $todolist['text'];
	$tableau['dateBegin'] =  $todolist['dateBegin'];
	$tableau['dateEnd'] =  $todolist['dateEnd'];
	

}
?>

<div data-role="page" data-theme="b" id="page_option">
	<div data-role="header" data-position="inline" data-theme="a">
		<h1 style="text-align:left;">
			<?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete','style'=>'vertical-align : middle'));?>
			Modification de la liste <?php echo $tableau['name']; ?>
		</h1>
		<div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">
			 <!-- <a data-role="button" data-inline="true" data-icon="recycle" data-iconpos="notext" data-mini="true" >Rafraichir</a> -->
			<a href="#popupMenu" data-role="button" data-rel="popup" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" data-transition="slidedown">Menu</a>
			<div data-role="popup" id="popupMenu" data-theme="b">
				<ul data-role="listview" data-inset="true" style="min-width:210px;">
					<li data-role="list-divider">Menu</li>
					<li><a href="afficherProfil.html">Afficher profil</a></li>
					<li><a href="#popupDisconnect" data-rel="popup" data-transition="flow">Déconnexion</a></li>
				</ul> 
			</div>
		<!--	<a href="#popupDisconnect" data-role="button" data-rel="popup" data-inline="true" data-icon="back" data-iconpos="notext" data-mini="true" >Déconnexion</a>
			<div data-role="popup" id="popupDisconnect" data-position-to="window"  data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
				<div data-role="header" data-theme="a"><h1>Déconnexion</h1></div>
				<div role="main" class="ui-content">
					<h3 class="ui-title">Voulez-vous vraiment vous déconnecter ?</h3>
					<a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>
					<a href="connexion.html" data-role="button" data-inline="true" data-icon="check">Valider</a>
				</div>
			</div> -->
		</div>
	</div>
	<div data-role="content">
		<!-- <h4 class="ui-bar ui-bar-a">Détails Todolist : <?php echo $name[0]['Todolist']['name'] ?></h4> -->

		<?php

		echo $this->Form->create('modifylist',array(
			'type'=>'post',
			'data-ajax' => 'false',
			'inputDefaults' => array(
				'label' => false,	
				)));


		echo "<div data-role='content' data-theme='c'>";
		echo $this->form->input("Todolist.name", array('type'=>'text','label'=>false,'required'=>true,'id'=>'name', 'value'=>$tableau['name']));
		?> <br><br> 

		<fieldset>
			<legend>Facultatif</legend>

			<?php
			echo $this->form->input("Todolist.text", array('type' => 'text','id'=>'text','label'=>false, 'value'=>$tableau['text'],'placeholder'=>"Commentaire"));
		
			echo $this->form->input("Todolist.dateBegin", array('type' => 'text','id'=>'dateBegin','label'=>false, 'value'=>$tableau['dateBegin'],'placeholder'=>"Date de début(JJ/MM/AAA)"));
			
			echo $this->form->input("Todolist.dateEnd", array('type' => 'text','id'=>'dateEnd','label'=>false, 'value'=>$tableau['dateEnd'],'placeholder'=>"Date de fin(JJ/MM/AAA)"));
		?>	
		<a href="#" data-role="button" data-inline="true" style ="margin-top:20px;">Ajouter un Membre</a>
				</fieldset>
	</div>
	<br/>
		<?php echo $this->form->end('enregistrer les modifications',array('id'=>'modifylist'));

		?>
	</div>
</div>
</html>