<?php 
echo $this->Html->script('inscription.js'); 

if(empty($this->request->data)){
	$tableau['pseudo'] = "";
	$tableau['password'] = "";
} else {
	$user = $this->request->data['User'];
	$tableau['pseudo'] = $user['pseudo'];
	$tableau['password'] =  $user['password'];
}
?>


<div data-role="page" data-theme="b" id="page_option">
		<div>
			<?php echo $this->Session->flash(); ?>
			<h1>Bienvenue</h1>
			Veuillez vous connecter pour accéder à l'application
		</div>

<?php

//creation du formulaire de connexion
echo $this->form->create('login',array('data-ajax' => 'false'));


//pseudo
	echo "<div class='pseudo'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][pseudo]','id'=>'pseudo', 'value'=>$tableau['pseudo'],'data-clear-btn' =>true, 'placeholder'=>"Pseudo"));
	if(isset($erreurs['pseudo'])){
		echo "<p class ='error'>".$erreurs['pseudo'][0]."</p>";
	}
	echo "</div>";

//mot de passe
	echo "<div class='password'>";
	echo $this->Form->input('', array('type' => 'password','name' => 'data[User][password]','id'=>'password', 'value'=> $tableau['password'],'data-clear-btn' =>true, 'placeholder'=>"mot de passe"));
	if(isset($erreurs['name'])){
		echo "<p class ='error'>".$erreurs['name'][0]."</p>";
	}
	echo "</div>";

	echo $this->form->end('Connexion');

//fin du formulaire connexion
	echo "<br/>";
	?>

<!--a faire -->
		<!--<a href data-role="button">Connexion via Google+</a> -->

		<?php	echo $this->Html->link(
    'Connexion via Facebook',
    array( 'controller' => 'Users','action' => 'inscription'),array('data-role'=>'button','style'=>'margin-left: auto;margin-right: auto;width: 70%;'));
	?> 


		<div>
			<!-- inscrition !-->
			<h3>Pas de compte ? </h3>

		<?php	echo $this->Html->link(
    'S\'inscrire au site',
    array( 'controller' => 'Users','action' => 'inscription'));
	?> 

	<!-- Fin inscrition !-->

<!--
			<h4>OU</h4>
			<a href data-role="button">Inscription via Facebook</a>
			ou
			<a href data-role="button">Inscription via Google+</a>
-->
		</div>
	</div>


