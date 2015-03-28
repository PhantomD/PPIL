<div data-role="page" data-theme="b" id="page_inscription">

<!--
		<div>
			<h1>Inscription</h1>
		</div>

		<input type="text" name="name" id="txt_name" value="Nom"/>
		<input type="text" name="name" id="txt_firstName" value="Prénom"/>
		<input type="text" name="name" id="txt_birthDate" value="Date de naiss.(JJ/MM/AAA)"/>

		<fieldset data-role="controlgroup" data-type="horizontal">
			<input name="rc_gender" id="rc_man" value="1" type="radio">
			<label for="rc_man">Homme</label>
			<input name="rc_gender" id="rc_woman" value="0" type="radio">
			<label for="rc_woman">Femme</label>
		</fieldset>

		<input type="text" name="name" id="grimName" value="Adresse e-Mail"/>
		<input type="text" name="name" id="grimName" value="Confirmation e-Mail"/>
		<input type="text" name="name" id="grimName" value="Mot de passe"/>
		<input type="text" name="name" id="grimName" value="Confirmation Mot de passe"/>
		<a href="" data-role="button">Inscription</a>

-->

		<div>
			<h1>Inscription</h1>
		</div>

	<?php
	echo $this->form->create(array('type'=>'post','action'=>'inscription'));

echo $this->Form->input('', array('type' => 'text','name' => 'data[nom]','id'=>'nom', 'value'=>'Nom'));
echo $this->Form->input('', array('type' => 'text','name' => 'data[prenom]','id'=>'prenom','value'=>'Prénom'));
echo $this->Form->input('', array('type' => 'text','name' => 'data[date]','id'=>'date','value'=>'Date de naiss.(JJ/MM/AAA)'));

echo "<fieldset data-role='controlgroup' data-type='horizontal'>";
$options = array('H' => 'Homme', 'F' => 'Femme');
echo $this->Form->radio('genre', $options, array('legend' => false));
echo "</fieldset>";

echo $this->Form->input('', array('type' => 'text','name' => 'data[mail]','id'=>'mail','value'=>'Adresse e-Mail'));
echo $this->Form->input('', array('type' => 'text','name' => 'data[mailConfirmation]','id'=>'mailConfirmation','value'=>'Confirmation e-Mail'));
echo $this->Form->input('', array('type' => 'text','name' => 'data[mdp]','id'=>'mdp','value'=>'Mot de passe'));
echo $this->Form->input('', array('type' => 'text','name' => 'data[mdpConfirmation]','id'=>'mdpConfirmation','value'=>'Confirmation Mot de passe'));

	echo $this->form->end('Inscription',array("inscription"));


debug($this->request->data);


	?>





</div>