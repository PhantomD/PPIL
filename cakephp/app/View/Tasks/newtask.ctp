<?php
if(empty($this->request->data)){
	$tableau['name'] = "";	
}

else{

	$tasks = $this->request->data['Task'];
	$tableau['name'] = $tasks['name'];
}


?>

	<div data-role="page" data-theme="b" id="page_option">
	<div data-role="header" data-theme="a">
		<h1>Ajouter un élément</h1>
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

		echo $this->Form->input('Task.name', array('type' => 'text','value'=>$tableau['name'], 'placeholder'=>"Intitulé de l'élément"));

		?>

			<form action="newtask" method="post">
	
      <br/>
      
      <br/>
     
      <input type="submit" value="Créer l'élément" name="envoyer" />
		</div>
	</div>
</body>
