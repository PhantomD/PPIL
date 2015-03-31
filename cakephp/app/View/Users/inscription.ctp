<?php 
echo $this->Html->script('inscription.js'); 

if(empty($this->request->data)){
	$tableau['pseudo'] = "";
	$tableau['nom'] = "";
	$tableau['prenom'] = "";
	$tableau['date'] = "";
	$tableau['mail'] = "";
	$tableau['gender'] = '1';
	$tableau['mailConfirmation'] = "";
	$tableau['password'] ="";
	$tableau['mdpConfirmation']="";
} else {
	$user = $this->request->data['User'];

	$tableau['pseudo'] = $user['pseudo'];
	$tableau['nom'] =  $user['name'];
	$tableau['prenom'] =  $user['firstname'];
	$tableau['date'] =  $user['birthdate'];
	$tableau['mail'] =  $user['email'];
	$tableau['gender'] = $user['gender'];
	$tableau['password'] =$user['password'];
	$tableau['mailConfirmation'] = $this->request->data['mailConfirmation'];
	$tableau['mdpConfirmation']=$this->request->data['mdpConfirmation'];

}
?>


<div data-role="page" data-theme="b" id="page_option">
	<div>
		<?php echo $this->Session->flash();  debug($erreurs);?>
		<h1>Inscription é</h1>
	</div>

	<?php

debug($this->request->data);

		echo $this->Form->create('inscription',array(
			'type'=>'post',
			'data-ajax' => 'false',
			'inputDefaults' => array(
				'label' => false,
				'data-clear-btn' =>true),
		'onsubmit' => "return verifFormulaire(this)"));


//pseudo
	echo "<div class='pseudo'>";
	echo $this->Form->input('User.pseudo', array('type' => 'text','value'=>$tableau['pseudo'], 'placeholder'=>"Pseudo", 'onblur' => 'verifPseudo(this)'));

	echo "</div>";

//nom
	echo "<div class='nom'>";
	echo $this->Form->input('User.name', array('type' => 'text','value'=> $tableau['nom'], 'placeholder'=>'Nom', 'onblur' => 'verifName(this)'));
	echo "</div>";

//prenom
	echo "<div class='prenom'>";
	echo $this->Form->input('User.firstname', array('type' => 'text','value'=>$tableau['prenom'], 'placeholder'=>'Prenom', 'onblur' => 'verifFirstname(this)'));
	echo "</div>";

//date anniversaire
	echo "<div class='date'>";
	echo $this->Form->input('User.birthdate', array('type' => 'text','value'=>$tableau['date'], 'placeholder'=>'Date de naiss.(JJ/MM/AAA)', 'onblur' => 'verifBirthdate(this)'));
	echo "</div>";

//sexe
	echo "<div class='gender'>";
	echo "<fieldset data-role='controlgroup' data-type='horizontal'>";
	$options = array('1' => 'Homme', '0' => 'Femme');
	echo $this->Form->radio('User.gender', $options, array('legend' => false,'value'=>$tableau['gender']));
	echo "</div>";
	echo "</fieldset>";

// mail
	echo "<div class='email'>";
	echo $this->Form->input('User.email', array('type' => 'text','value'=>$tableau['mail'], 'placeholder'=>'Adresse e-Mail', 'onblur' => 'verifEmail(this)'));
	echo "</div>";

// mail confirmation
	echo "<div class='emailConfirmation'>";
	echo $this->Form->input('User.mailConfirmation', array('type' => 'text','value'=>$tableau['mailConfirmation'], 'placeholder'=>'Confirmation e-Mail'));
	echo "</div>";

//mdp
	echo "<div class='passwordDiv'>";
	echo $this->Form->input('User.password', array('type' => 'password','value'=>$tableau['password'], 'placeholder'=>'mot de passe','onblur' => 'verifPassword(this)'));
	echo "</div>";


// mdp confirmation
	echo "<div class='mdpConfirmation'>";
	echo $this->Form->input('User.passwordConfirmation', array('type'=>'password','value'=>$tableau['mdpConfirmation'],'placeholder'=>'mot de passe'));
	echo "</div>";

	echo $this->Form->input('User.id', array('type' => 'hidden'));
	echo $this->form->end('Inscription',array("inscription"));

	?>


</div>