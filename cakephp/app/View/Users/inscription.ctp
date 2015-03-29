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
		<h1>Inscription</h1>
	</div>

	<?php
	echo $this->form->create(array('type'=>'post','action'=>'inscription','label'=> false, 'onsubmit' => "return verifFormulaire(this)"));


//pseudo
	echo "<div class='pseudo'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][pseudo]','id'=>'pseudo', 'value'=>$tableau['pseudo'],'data-clear-btn' =>true, 'placeholder'=>"Pseudo", 'onblur' => 'verifPseudo(this)'));
	if(isset($erreurs['pseudo'])){
		echo "<p class ='error'>".$erreurs['pseudo'][0]."</p>";
	}
	echo "</div>";

//nom
	echo "<div class='nom'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][name]','id'=>'nom', 'value'=> $tableau['nom'],'data-clear-btn' =>true, 'placeholder'=>'Nom', 'onblur' => 'verifName(this)'));
	if(isset($erreurs['name'])){
		echo "<p class ='error'>".$erreurs['name'][0]."</p>";
	}
	echo "</div>";

//prenom
	echo "<div class='prenom'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][firstname]','id'=>'prenom','value'=>$tableau['prenom'],'data-clear-btn' =>true, 'placeholder'=>'Prenom', 'onblur' => 'verifFirstname(this)'));
	if(isset($erreurs['firstname'])){
		echo "<p class ='error'>".$erreurs['firstname'][0]."</p>";
	}
	echo "</div>";

//date anniversaire
	echo "<div class='date'>";
	echo $this->Form->input('', array('type' => 'text', 'name' => 'data[User][birthdate]','id'=>'date','value'=>$tableau['date'],'data-clear-btn' =>true, 'placeholder'=>'Date de naiss.(JJ/MM/AAA)', 'onblur' => 'verifBirthdate(this)'));
	if(isset($erreurs['birthdate'])){
		echo "<p class ='error'>".$erreurs['birthdate'][0]."</p>";
	}
	echo "</div>";

//sexe
	echo "<div class='gender'>";
	echo "<fieldset data-role='controlgroup' data-type='horizontal'>";
	$options = array('1' => 'Homme', '0' => 'Femme');
	echo $this->Form->radio('gender', $options, array('legend' => false,'name'=> 'data[User][gender]','value'=>$tableau['gender']));
	if(isset($erreurs['gender'])){
		echo "<p class ='error'>".$erreurs['gender'][0]."</p>";
	}
	echo "</div>";
	echo "</fieldset>";

// mail
	echo "<div class='email'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][email]','id'=>'email','value'=>$tableau['mail'],'data-clear-btn' =>true, 'placeholder'=>'Adresse e-Mail', 'onblur' => 'verifEmail(this)'));
	if(isset($erreurs['email'])){
		echo "<p class ='error'>".$erreurs['email'][0]."</p>";
	}
	echo "</div>";

// mail confirmation
	echo "<div class='emailConfirmation'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[mailConfirmation]','id'=>'mailConfirmation','value'=>$tableau['mailConfirmation'],'data-clear-btn' =>true, 'placeholder'=>'Confirmation e-Mail'));
	if(isset($mailConfirmation)){
		echo "<p class ='error'>".$mailConfirmation."</p>";
	}
	echo "</div>";

//mdp
	echo "<div class='passwordDiv'>";
	echo $this->Form->input('', array('type' => 'password','name' => 'data[User][password]','id'=>'password','value'=>$tableau['password'], 'data-clear-btn' =>true, 'placeholder'=>'mot de passe','onblur' => 'verifPassword(this)'));
	if(isset($mdpConfirmation)){
		echo "<p class ='error'>".$mdpConfirmation."</p>";
	}
	echo "</div>";


// mdp confirmation
	echo "<div class='mdpConfirmation'>";
	echo $this->Form->input('', array('type'=>'password','name' => 'data[mdpConfirmation]','id'=>'passwordConfirmation','value'=>$tableau['mdpConfirmation'],'data-clear-btn' =>true, 'placeholder'=>'mot de passe'));
	if(isset($erreurs['mdpConfirmation'])){
		echo "<p class ='error'>".$erreurs['mdpConfirmation'][0]."</p>";
	}
	echo "</div>";

	echo $this->Form->input('User.id', array('type' => 'hidden'));
	echo $this->form->end('Inscription',array("inscription"));

	?>


</div>