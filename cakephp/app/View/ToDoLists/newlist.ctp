<?php
if(empty($this->request->data)){

	$tableau['name'] = "";
	$tableau['text'] = "";
	$tableau['dateBegin'] = "";
	$tableau['dateEnd'] = "";
	$tableau['frequency'] = "";
}
else{

	$todolist = $this->request->data['Todolist'];
	$tableau['name'] = $todolist['name'];
	$tableau['text'] =  $todolist['text'];
	$tableau['dateBegin'] =  $todolist['dateBegin'];
	$tableau['dateEnd'] =  $todolist['dateEnd'];
	$tableau['frequency'] =  $todolist['frequency'];

}
?>

<div data-role="page" data-theme="b" id="page_option">
	<div data-role="header" data-theme="a">
		<h1>Ajouter une liste</h1>
		<div data-role="controlgroup" data-type="horizontal" data-mini="true" class="ui-btn-right">
			<?php 
			$url = array('controller'=>'Todolists','action'=>'consulterlist');
			echo $this->form->button('', array('type' => 'button','data-inline'=>'true','data-icon'=>'home','data-iconpos'=>'notext', 'data-mini'=>'true','onclick' => "location.href='".$this->Html->url($url)."'")); ?>
			<a data-role="button" data-inline="true" data-icon="bars" data-iconpos="notext" data-mini="true" >Menu</a>
		</div>
	</div>
	<div data-role="content">

		<?php
		echo $this->Form->create('newlist',array(
			'type'=>'post',
			'data-ajax' => 'false',
			'inputDefaults' => array(
				'label' => false,	
				)));

		echo $this->Form->input('Todolist.name', array('type' => 'text','value'=>$tableau['name'], 'placeholder'=>"Intitulé de la liste"));

		echo "<br/> <div data-role='content' data-theme='c'>";
		echo "Facultatif";

		echo $this->Form->input('Todolist.text', array('type' => 'text','value'=>$tableau['text'], 'placeholder'=>"Commentaire"));
		
		echo $this->Form->input('Todolist.dateBegin', array('type' =>'text','value'=>$tableau['dateBegin'], 'placeholder'=>"Date de début(JJ/MM/AAA)"));

		echo $this->Form->input('Todolist.dateEnd', array('type' => 'text','label'=>false,'value'=>$tableau['dateEnd'], 'placeholder'=>"Date de fin(JJ/MM/AAA)"));

//plus tard
// echo $this->Form->input('User.id', array('type' => 'hidden'));

		?>

		<a href="#" data-role="button" data-inline="true">Ajouter un Membre</a>

	</div>
	<br/>
	<?php echo $this->form->end('Créer la liste'); ?>
</div>
</div>
