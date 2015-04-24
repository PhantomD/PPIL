<?php
if(isset($profil) && !empty($profil)){
	$tableauBirthday = explode("-",$profil['birthdate']);
	$profil['birthdate'] = $tableauBirthday[2]."/".$tableauBirthday[1]."/".$tableauBirthday[0];


} elseif(!empty($this->request->data)){
	$profil=$this->request->data['User'];

}
?>


<div data-role="page" data-theme="b" id="page_option">
	<div data-role="header" data-theme="a">
		<h1 style="text-align:left;">
			<?php echo $this->Html->image('icone_entete.png', array('alt' => 'icone_entete','style'=>'vertical-align : middle'));?>
			Modifier le profil
		</h1>

		<div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">
			<?php echo $this->Html->link('Page principale',array('controller' => 'Todolists','action' => 'consulterlist'), array('data-role'=>"button",'data-inline'=>"true", 'data-icon'=>"home", 'data-iconpos'=>'notext','data-mini'=>"true" )); ?>

			<a data-role="button" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" >Menu</a>
		</div>
	</div>



	<div data-role="content">

		<?php echo $this->Session->flash(); ?>
		<h1> Informations personnelles </h1>
		<?php
		echo $this->Form->create('User',array(
			'type'=>'post',
			'url'=>array('action'=>'modificationProfil','infos'),
			'data-ajax' => 'false',
			'inputDefaults' => array(
				'label' => false,
				'data-clear-btn' =>true)));

//nom
		echo $this->Form->input('User.name', array('type' => 'text','value'=> $profil['name'], 'placeholder'=>'Nom'));

//prenom
		echo $this->Form->input('User.firstname', array('type' => 'text','value'=>$profil['firstname'], 'placeholder'=>'Prenom'));

//date anniversaire
		echo $this->Form->input('User.birthdate', array('type' => 'text','value'=>$profil['birthdate'], 'placeholder'=>'Date de naiss.(JJ/MM/AAA)'));

//sexe
		echo "<fieldset data-role='controlgroup' data-type='horizontal'>";
		$options = array('1' => 'Homme', '0' => 'Femme');
		echo $this->Form->radio('User.gender',$options, array('legend' => false,'value'=>$profil['gender']));
		echo "</fieldset>";

// mail
		echo $this->Form->input('User.email', array('type' => 'text','value'=>$profil['email'], 'placeholder'=>'Adresse e-Mail'));

// mail confirmation
		echo $this->Form->input('User.mailConfirmation', array('type' => 'text','required' => false,'placeholder'=>'(mail confirmation si modification)'));

		echo $this->form->end('Enregistrer les modifications');
		?>


		<h1> Mot de passe </h1>
		<?php

		echo $this->Form->create('User',array(
			'type'=>'post',
			'url'=>array('action'=>'modificationProfil','mdp'),
			'data-ajax' => 'false',
			'inputDefaults' => array(
				'label' => false,
				'data-clear-btn' =>true)));

// ancien mot de passe
		echo $this->Form->input('User.oldpassword', array('type' => 'password','required' => true, 'placeholder'=>'ancien mot de passe'));

// nouveau mdp
		echo $this->Form->input('User.password', array('type' => 'password','required' => true,  'placeholder'=>'nouveau mot de passe'));

// mdp confirmation
		echo $this->Form->input('User.passwordConfirmation', array('type'=>'password','required' => true, 'placeholder'=>'confirmation nouveau mot de passe'));

		echo $this->form->end('changer le mot de passe');
		?>

		<h1> Désinscription </h1>


		<label>
			<!-- input name="cb_removeAcount" type="checkbox">Supprimer le compte -->
			<a href="#popupDelete" data-role="button" data-rel="popup"  style='margin-left:auto;margin-right: auto;width:70%;'>Supprimer le compte</a>
			<div data-role="popup" id="popupDelete" data-position-to="window"  data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
				<div data-role="header" data-theme="a"><h1>Supprimer le vompte</h1></div>
				<div role="main" class="ui-content">
					<h3 class="ui-title">Pour confirmer la suppression de votre compte, veuillez saisir votre mot de passe</h3>

					<?php echo $this->Form->create('User',array(
						'type'=>'post',
						'url'=>array('action'=>'desinscription'),
						'data-ajax' => 'false',
						'inputDefaults' => array(
							'label' => false,
							'data-clear-btn' =>true)));
							echo $this->Form->input('User.password', array('type' => 'password','required' => true, 'placeholder'=>'Mot de passe')); ?>
							<a href="#" data-role="button" data-inline="true" data-icon="delete" data-rel="back">Annuler</a>

							<?php echo $this->form->end(array('label'=>'Valider','data-role'=>"button",'data-inline'=>"true", 'data-icon'=>"check",'div'=>false));?>
						</div>
					</div>
				</div>
			</label>


		</div>
	</div>
