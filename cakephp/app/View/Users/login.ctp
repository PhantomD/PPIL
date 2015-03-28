<?php 
echo $this->Html->script('inscription.js'); 

if(empty($this->request->data)){
	$tableau['pseudo'] = "Pseudo";
	$tableau['password'] = "Mot de passe";
} else {
	$user = $this->request->data['User'];
	$tableau['pseudo'] = $user['pseudo'];
	$tableau['password'] =  $user['password'];
}
?>



<div data-role="page" data-theme="b" id="page_inscription">
		<div>
			<?php echo $this->Session->flash(); ?>
			<h1>Bienvenue</h1>
			Veuillez vous connecter pour accéder à l'application
		</div>

<?php
debug($this->request->data);

echo $this->form->create(array('controller' => 'Users','type'=>'post','action'=>'login','label'=> false));


//pseudo
	echo "<div class='pseudo'>";
	echo $this->Form->input('', array('type' => 'text','name' => 'data[User][pseudo]','id'=>'pseudo', 'value'=>$tableau['pseudo'], 'onblur' => 'verifPseudo(this)'));
	if(isset($erreurs['pseudo'])){
		echo "<p class ='error'>".$erreurs['pseudo'][0]."</p>";
	}
	echo "</div>";

//nom
	echo "<div class='password'>";
	echo $this->Form->input('', array('type' => 'password','name' => 'data[User][password]','id'=>'password', 'value'=> $tableau['password'], 'onblur' => 'verifPassword(this)'));
	if(isset($erreurs['name'])){
		echo "<p class ='error'>".$erreurs['name'][0]."</p>";
	}
	echo "</div>";

	echo $this->form->end('Connexion');
	echo "<br/>";
	?>

<!--a faire -->
		<a href data-role="button">Connexion via Facebook</a>
		<a href data-role="button">Connexion via Google+</a>





		<div>
			<h3>Pas de compte ? </h3>

		<?php	echo $this->Html->link(
    'S\'inscrire au site',
    array( 'controller' => 'Users','action' => 'inscription'));

	?> 

			<h4>OU</h4>








<!--a faire -->


			<a href data-role="button">Inscription via Facebook</a>
			ou
			<a href data-role="button">Inscription via Google+</a>
		</div>
	</div>


