

<?php 
echo $this->Html->script('inscription.js'); 

if(empty($this->request->data)){
	$tableau['pseudo'] = "Pseudo";
	$tableau['nom'] = "Nom";
	$tableau['prenom'] = "Prenom";
	$tableau['date'] = "Date de naiss.(JJ/MM/AAA)";
	$tableau['mail'] = "Adresse e-Mail";
	$tableau['gender'] = '1';
	$tableau['mailConfirmation'] = "Confirmation e-Mail";
} else {
	$user = $this->request->data['User'];

	$tableau['pseudo'] = $user['pseudo'];
	$tableau['nom'] =  $user['name'];
	$tableau['prenom'] =  $user['firstname'];
	$tableau['date'] =  $user['birthdate'];
	$tableau['mail'] =  $user['email'];
	$tableau['gender'] = $user['gender'];
	$tableau['mailConfirmation'] = $this->request->data['mailConfirmation'];

}
?>


<div data-role="page" data-theme="b" id="page_inscription">
	<div>
		<?php echo $this->Session->flash(); ?>
		<h1>Inscription</h1>
	</div>

	<?php
	echo $this->form->create(array('type'=>'post','action'=>'inscription','label'=> false, 'onsubmit' => "return verifFormulaire(this)",'id'=>'form1'));


//pseudo
	echo "<div class='pseudo'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][pseudo]','id'=>'pseudo', 'value'=>$tableau['pseudo'], 'onblur' => 'verifPseudo(this)'));
	if(isset($erreurs['pseudo'])){
		echo "<p class ='error'>".$erreurs['pseudo'][0]."</p>";
	}
	echo "</div>";

//nom
	echo "<div class='nom'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][name]','id'=>'nom', 'value'=> $tableau['nom'], 'onblur' => 'verifName(this)'));
	if(isset($erreurs['name'])){
		echo "<p class ='error'>".$erreurs['name'][0]."</p>";
	}
	echo "</div>";

//prenom
	echo "<div class='prenom'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][firstname]','id'=>'prenom','value'=>$tableau['prenom'], 'onblur' => 'verifFirstname(this)'));
	if(isset($erreurs['firstname'])){
		echo "<p class ='error'>".$erreurs['firstname'][0]."</p>";
	}
	echo "</div>";

//date anniversaire
	echo "<div class='date'>";
	echo $this->Form->input('', array('type' => 'text', 'name' => 'data[User][birthdate]','id'=>'date','value'=>$tableau['date'], 'onblur' => 'verifBirthdate(this)'));
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
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][email]','id'=>'email','value'=>$tableau['mail'], 'onblur' => 'verifEmail(this)'));
	if(isset($erreurs['email'])){
		echo "<p class ='error'>".$erreurs['email'][0]."</p>";
	}
	echo "</div>";

// mail confirmation
	echo "<div class='emailConfirmation'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[mailConfirmation]','id'=>'mailConfirmation','value'=>$tableau['mailConfirmation']));
	if(isset($mailConfirmation)){
		echo "<p class ='error'>".$mailConfirmation."</p>";
	}
	echo "</div>";

//mdp
	echo "<div class='password'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][password]','id'=>'password','value'=>'Mot de passe', 'onblur' => 'verifPassword(this)'));
	if(isset($mdpConfirmation)){
		echo "<p class ='error'>".$mdpConfirmation."</p>";
	}
	echo "</div>";


// mdp confirmation
	echo "<div class='mdpConfirmation'>";
	echo $this->Form->input('', array('type'=>'password','name' => 'data[mdpConfirmation]','id'=>'passwordConfirmation','value'=>'Mot de passe'));
	if(isset($erreurs['mdpConfirmation'])){
		echo "<p class ='error'>".$erreurs['mdpConfirmation'][0]."</p>";
	}
	echo "</div>";

	echo $this->Form->input('User.id', array('type' => 'hidden'));
	echo $this->form->end('Inscription',array("inscription"));

	?>


</div>