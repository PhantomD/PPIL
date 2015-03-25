

<?php 
echo $this->Html->script('jquery.validate.js');
echo $this->Html->script('inscription.js'); ?>

<div data-role="page" data-theme="b" id="page_inscription">
		<div>

		<?php echo $this->Session->flash(); ?>
			<h1>Inscription</h1>
		</div>

	<?php
	echo $this->form->create(array('type'=>'post','action'=>'inscription','onsubmit' => "return verifFormulaire(this)",'id'=>'form1'));



echo $this->Form->input('', array('type' => 'text','name' => 'data[User][pseudo]','id'=>'pseudo', 'value'=>'Pseudo', 'onblur' => 'verifPseudo(this)'));
echo $this->Form->input('', array('type' => 'text','name' => 'data[User][name]','id'=>'nom', 'value'=>'Nom', 'onblur' => 'verifName(this)'));
echo $this->Form->input('', array('type' => 'text','name' => 'data[User][firstname]','id'=>'prenom','value'=>'Prenom', 'onblur' => 'verifFirstname(this)'));
echo $this->Form->input('', array('type' => 'text','name' => 'data[User][birthdate]','id'=>'date','value'=>'Date de naiss.(JJ/MM/AAA)', 'onclick' => 'verifBirthdate(this)'));

echo "<fieldset data-role='controlgroup' data-type='horizontal'>";
$options = array('H' => 'Homme', 'F' => 'Femme');
echo $this->Form->radio('gender', $options, array('legend' => false));
echo "</fieldset>";

echo $this->Form->input('', array('type' => 'text','name' => 'data[User][email]','id'=>'email','value'=>'Adresse e-Mail', 'onblur' => 'verifEmail(this)'));

echo $this->Form->input('', array('type' => 'text','name' => 'data[mailConfirmation]','id'=>'mailConfirmation','value'=>'Confirmation e-Mail'));
echo $this->Form->input('', array('type' => 'password','name' => 'data[User][password]','id'=>'password','value'=>'Mot de passe', 'onblur' => 'verifPassword(this)'));
echo $this->Form->input('', array('type' => 'text','name' => 'data[mdpConfirmation]','id'=>'mdpConfirmation','value'=>'Confirmation Mot de passe'));

echo $this->Form->input('User.id', array('type' => 'hidden'));
	echo $this->form->end('Inscription',array("inscription"));



debug($this->request->data);

debug($erreurs);

	?>

    </div>