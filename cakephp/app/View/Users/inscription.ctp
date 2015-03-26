

<?php 
echo $this->Html->script('inscription.js'); 

if(empty($this->request->data)){
$tableau['pseudo'] = "Pseudo";
$tableau['nom'] = "Nom";
$tableau['prenom'] = "Prenom";
$tableau['date'] = "Date de naiss.(JJ/MM/AAA)";
$tableau['mail'] = "Adresse e-Mail";
$tableau['mailConfirmation'] = "Confirmation e-Mail";
} else {
$user = $this->request->data['User'];

$tableau['pseudo'] = $user['pseudo'];
$tableau['nom'] =  $user['name'];
$tableau['prenom'] =  $user['firstname'];
$tableau['date'] =  $user['birthdate'];
$tableau['mail'] =  $user['pseudo'];
$tableau['mailConfirmation'] = $this->request->data['mailConfirmation'];

}
?>

<div data-role="page" data-theme="b" id="page_inscription">
		<div>

		<div data-role="main" class="ui-content">
    <a href="#pagetwo">Go to Page Two</a>
  </div>

		<?php echo $this->Session->flash(); ?>
			<h1>Inscription</h1>
		</div>

	<?php

	debug($this->request->data);
	echo $this->form->create(array('type'=>'post','action'=>'inscription','onsubmit' => "return verifFormulaire(this)",'id'=>'form1'));


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
echo "<fieldset data-role='controlgroup' data-type='horizontal'>";
$options = array('1' => 'Homme', '0' => 'Femme');
echo "<div class='gender'>";
echo $this->Form->radio('gender', $options, array('legend' => false,'name'=> 'data[User][gender]'));
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
if(isset($erreurs['mailConfirmation'])){
 echo "<p class ='error'>".$erreurs['mailConfirmation'][0]."</p>";
}
echo "</div>";

//mdp
echo "<div class='password'>";
echo $this->Form->input('', array('type' => 'password','name' => 'data[User][password]','id'=>'password','value'=>'Mot de passe', 'onblur' => 'verifPassword(this)'));
if(isset($erreurs['password'])){
 echo "<p class ='error'>".$erreurs['password'][0]."</p>";
}
echo "</div>";


// mdp confirmation
echo "<div class='mdpConfirmation'>";
echo $this->Form->input('', array('type'=>'password','name' => 'data[mdpConfirmation]','id'=>'passwordConfirmation','value'=>'confirmation Mot de passe'));
if(isset($erreurs['mdpConfirmation'])){
 echo "<p class ='error'>".$erreurs['mdpConfirmation'][0]."</p>";
}
echo "</div>";

echo $this->Form->input('User.id', array('type' => 'hidden'));
	echo $this->form->end('Inscription',array("inscription"));



debug($this->request->data);

debug($erreurs);

	?>

<div data-role="page" data-dialog="true" id="pagetwo">
  <div data-role="main" class="ui-content">
    <a href="#pageone">Go to Page One</a>
  </div>
</div>


    </div>